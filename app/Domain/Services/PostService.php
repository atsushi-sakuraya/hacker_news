<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\Image;
use Throwable;
use Exception;

class PostService implements PostServiceInterface
{
    /**
     * @var array
     */
    protected $urls;

    /**
     * @var Image
     */
    protected $image;

    /**
     * PostService constructor.
     * @param Image $image
     */
    public function __construct(
        Image $image
    ) {
        $this->urls = [];
        $this->image = $image;
    }

    /**
     * @param array $imageLists
     * @param int $userId
     * @return void
     * @throws Exception
     */
    public function saveImages(array $imageLists, int $userId)
    {
        try {
            $this->saveImagesOnStorage($imageLists);
            $this->saveImageUrls($userId);
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param array $imageLists
     * @return void
     * @throws Exception
     */
    public function saveImagesOnStorage(array $imageLists)
    {
        try {
            // 画像をstorage/app/imgに保存
            if ($imageLists->isNotEmpty()) {
                foreach ($imageLists as $image) {
                    // 画像データの保存
                    $this->urls[] = $image->store('img');
                }
            }

            if (empty($this->urls)) {
                throw new Exception('画像をストレージに保存できませんでした。');
            }
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param int $userId
     * @return void
     * @throws Exception
     */
    public function saveImageUrls(int $userId)
    {
        try {
            // 画像URLの更新
            $setImages = [];
            foreach ($this->urls as $url) {
                $setImages[] = [
                    'user_id' => $userId,
                    'type' => config('const.post_type.post'),
                    'url' => $url,
                ];
            }
            $this->image->insert($setImages);
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
}
