<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Repositories\PostRepository;
use Illuminate\Support\Collection;

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
            $storedUrls['image' . $i] = $this->imageService->storeImageFile(
                $photo,
                (string)config('const.storage.img.post')
            );
        }
        return $storedUrls;
    }

    /**
     * 投稿情報を取得
     * @return Collection
     */
    public function getPosts()
    {
        $posts = $this->post->getPosts();
        return $this->setTimeDifference($posts);
    }

    /**
     * ユーザの投稿情報を取得
     * @param int $userId
     * @return \App\Domain\Entity\Post
     */
    public function getUserPosts(int $userId)
    {
        return $this->post->getUserPosts($userId);
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

    /**
     * 現在日時との差分を出力
     * @param Collection $posts
     * @return Collection
     */
    private function setTimeDifference(Collection $posts)
    {
        $now = now();
        $posts = $posts->map(function ($post) use ($now) {
            if ($diff = $now->diffInYears($post->created_at)) {
                $post->time_difference = $diff . '年前';
            } elseif ($diff = $now->diffInMonths($post->created_at)) {
                $post->time_difference = $diff . '月前';
            } elseif ($diff = $now->diffInDays($post->created_at)) {
                $post->time_difference = $diff . '日前';
            } elseif ($diff = $now->diffInHours($post->created_at)) {
                $post->time_difference = $diff . '時間前';
            } elseif ($diff = $now->diffInMinutes($post->created_at)) {
                $post->time_difference = $diff . '分前';
            } elseif ($diff = $now->diffInSeconds($post->created_at)) {
                $post->time_difference = $diff . '秒前';
            } else {
                $post->time_difference = 'ただ今';
            }
            return $post;
        });

        return $posts;
    }
}
