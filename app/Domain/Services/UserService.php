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

    public function testinaba()
    {

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
     * @param array $statement
     * @throws Exception
     */
    public function saveUser(array $statement)
    {
        // CSRFトークンはDBに保存しないため削除
        $statement = $this->exceptCsrfToken($statement);

        // 画像保存
        if (!empty($statement['profile_photo'])) {
            $this->urls = $this->imageService->storeImages($statement['profile_photo']);
            $this->imageService->deleteOldImages((int) $statement['id']);
        }

        $this->registerUserTable((int) $statement['id'], $statement);
    }

    /**
     * ユーザ情報を保存
     * @param int $userId
     * @param array $statement
     */
    public function registerUserTable(int $userId, array $statement)
    {
        // 画像保存後のURLを格納
        if (!empty($this->urls)) {
            foreach ($this->urls as $column => $url) {
                $statement[$column] = $url;
            }
        }
        $this->user->updateOrCreateUser($userId, $statement);
    }

    /**
     * CSRFトークンを削除
     * @param array $statement
     * @return array
     */
    private function exceptCsrfToken(array $statement): array
    {
        if (!empty($statement['_token'])) {
            unset($statement['_token']);
        }
        return $statement;
    }
}
