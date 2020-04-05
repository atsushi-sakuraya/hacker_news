<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\User;
use App\Domain\Repositories\UserRepository;
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
     */
    public function saveUserData(array $request)
    {
        // 画像保存
        if (!empty($request['profile_photo'])) {
            $storedUrls = $this->updateImageFiles((int)$request['id'], $request['profile_photo']);
            $request = array_replace($request, $storedUrls);
        }

        // CSRFトークンはDBに保存しないため削除
        $request = $this->filteringStatement($request);

        // リクエスト保存
        $this->user->updateOrCreateUser((int)$request['id'], $request);
    }

    /**
     * 画像ファイルを更新する
     * @param int $userId
     * @param array $photos
     * @return array
     */
    public function updateImageFiles(int $userId, array $photos)
    {
        $storedUrls = [];
        foreach ($photos as $column => $photo) {
            $storedUrls[$column] = $this->imageService->storeImageFile(
                $photo,
                (string)config('const.storage.img.user')
            );

            $deleteTarget = $this->user->getUser($userId);
            if (!empty($deleteTarget->$column)) {
                $this->imageService->deleteImageFile($deleteTarget->$column);
            }
        }
        return $storedUrls;
    }

    /**
     * CSRFトークンを削除
     * @param array $request
     * @return array
     */
    private function filteringStatement(array $request): array
    {
        if (!empty($request['_token'])) {
            unset($request['_token']);
        }
        if (!empty($request['profile_photo'])) {
            unset($request['profile_photo']);
        }
        return $request;
    }
}
