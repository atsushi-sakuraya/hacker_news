<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\User;
use App\Domain\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
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
     * 画像保存、旧画像を削除
     * @param int $userId
     * @param array $photos
     * @return mixed
     */
    public function replaceImageFiles(int $userId, array $photos)
    {
        $urls = [];
        foreach ($photos as $key => $photo) {
            $urls[$key] = $this->storeImageFile($photo);
            $this->deleteOldUserImage($userId, $key);
        }
        return $urls;
    }

    /**
     * @param UploadedFile $photo
     * @return false|string
     */
    public function storeImageFile(UploadedFile $photo)
    {
        return $photo->store('img', 'public');
    }

    /**
     * ユーザの古い画像を削除
     * @param int $userId
     * @param string $column
     */
    public function deleteOldUserImage(int $userId, string $column)
    {
        $url = $this->user->getUser($userId)->get($column);
        $this->deleteImageFile($url);
    }

    /**
     * 画像を削除
     * @param Collection $url
     */
    public function deleteImageFile(Collection $url)
    {
        Storage::disk('public')->delete($url);
    }
}
