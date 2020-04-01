<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Repositories\PostRepository;
use Throwable;
use Exception;

class PostService implements PostServiceInterface
{
    /**
     * @var ImageService
     */
    private $imageService;

    /**
     * @var PostRepository
     */
    private $post;

    /**
     * PostService constructor.
     * @param ImageService $imageService
     * @param PostRepository $post
     */
    public function __construct(
        ImageService $imageService,
        PostRepository $post
    ) {
        $this->imageService = $imageService;
        $this->post = $post;
    }

    /**
     * 投稿情報を保存
     * @param array $request
     */
    public function savePostData(array $request)
    {
        if (!empty($request['images'])) {
            $storedUrls = $this->storeImageFiles($request['images']);
            $request = array_replace($request, $storedUrls);
        }

        // CSRFトークンはDBに保存しないため削除
        $request = $this->exceptCsrfToken($request);

        // 投稿データの更新
        $this->post->create($request);
    }

    /**
     * 画像保存
     * @param array $photos
     * @return mixed
     */
    public function storeImageFiles(array $photos)
    {
        $storedUrls = [];
        foreach ($photos as $i => $photo) {
            $storedUrls[$i] = $this->imageService->storeImageFile(
                $photo,
                (string)config('const.storage.img.post')
            );
        }
        return $storedUrls;
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
