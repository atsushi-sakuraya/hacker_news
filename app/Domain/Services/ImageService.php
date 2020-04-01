<?php
declare(strict_types=1);

namespace App\Domain\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService implements ImageServiceInterface
{
    /**
     * @param UploadedFile $photo
     * @param string $path
     * @return false|string
     */
    public function storeImageFile(UploadedFile $photo, string $path = 'img')
    {
        return $photo->store($path, 'public');
    }

    /**
     * 画像を削除
     * @param string $url
     */
    public function deleteImageFile(string $url)
    {
        Storage::disk('public')->delete($url);
    }
}
