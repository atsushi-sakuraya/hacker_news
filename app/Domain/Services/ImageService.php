<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\User;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Storage;
use Exception;
use Throwable;

class ImageService implements ImageServiceInterface
{
    /**
     * @var array
     */
    protected $urls = [];

    /**
     * @var User
     */
    protected $user;

    /**
     * ImageService constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $photos
     * @return array
     * @throws Exception
     */
    public function storeImages(array $photos)
    {
        try {
            // 画像保存処理
            if (!empty($photos['header'])) {
                $this->urls['profile_header_photo'] = $photos['header']->store('img', 'public');
            }

            if (!empty($photos['icon'])) {
                $this->urls['profile_icon_photo'] = $photos['icon']->store('img', 'public');
            }

            if (empty($this->urls)) {
                throw new Exception('画像をストレージに保存できませんでした。');
            }

            return $this->urls;
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * ユーザの古い画像を削除
     * @param int $userId
     * @throws Exception
     */
    public function deleteOldImages(int $userId)
    {
        try {
            $user = $this->user->getUser($userId);

            // 画像保存が成功していたら、古い画像を削除
            if (!empty($this->urls)) {
                foreach ($this->urls as $column => $uploadedUrl) {
                    // 既存画像が存在しない場合はスキップ
                    if ($user->$column === null) {
                        continue;
                    }

                    $this->deleteImageFile($user->$column);
                }
            }
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 画像を削除
     * @param string $url
     * @throws Exception
     */
    public function deleteImageFile(string $url)
    {
        try {
            Storage::disk('public')->delete($url);
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
}
