<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\User;
use Illuminate\Http\UploadedFile;
use App\Domain\Repositories\UserRepository;
use App\Domain\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Exception;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepository
     */
    protected $user;

    protected $imageService;

    /**
     * @var array
     */
    private $urls = [];

    /**
     * PostService constructor.
     * @param UserRepository $user
     * @param ImageService $imageService
     */
    public function __construct(
        UserRepository $user,
        ImageService $imageService
    ) {
        $this->user = $user;
        $this->imageService = $imageService;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUser(int $userId)
    {
        $user = $this->user->getUser($userId);
        $user = $this->setAbsolutePath($user);
        return $user;
    }

    /**
     * 画像の相対パスを絶対パスに変換
     * @param User $user
     * @return User
     */
    private function setAbsolutePath(User $user)
    {
        $header_url = $user->profile_header_photo;
        $icon_url = $user->profile_icon_photo;
        if (!empty($header_url)) {
            $user->profile_header_photo = env('APP_URL') . Storage::url($header_url);
        }
        if (!empty($icon_url)) {
            $user->profile_icon_photo = env('APP_URL') . Storage::url($icon_url);
        }

        return $user;
    }

    /**
     * ユーザ情報を保存
     * @param array $request
     * @throws Exception
     */
    public function saveUserData(array $request)
    {
        // CSRFトークンはDBに保存しないため削除
        $request = $this->exceptCsrfToken($request);

        // 画像保存
        $urls = [];
        if (!empty($request['profile_photo'])) {
            $urls = $this->imageService->replaceImageFiles((int)$request['id'], $request['profile_photo']);
        }

        // リクエスト保存
        $this->registerUserTable($request, $urls);
    }

    /**
     * ユーザ情報を保存
     * @param array $request
     * @param array $urls
     */
    public function registerUserTable(array $request, array $urls)
    {
        // 画像保存後のURLを格納
        if (!empty($urls)) {
            foreach ($urls as $column => $url) {
                $request[$column] = $url;
            }
        }
        $this->user->updateOrCreateUser((int)$request['id'], $request);
    }

    /**
     * CSRFトークンを削除
     * @param array $request
     * @return array
     */
    private function exceptCsrfToken(array $request): array
    {
        if (!empty($request['_token'])) {
            unset($request['_token']);
        }
        return $request;
    }
}
