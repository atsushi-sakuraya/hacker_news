<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Entity\Post;

interface PostRepository
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getPosts();

    /**
     * @param int $userId
     * @return Post
     */
    public function getUserPosts(int $userId);

    /**
     * @param array $statement
     * @return mixed
     */
    public function create(array $statement);

    /**
     * @param int $postId
     * @param array $statement
     */
    public function updateOrCreatePost(int $postId, array $statement);
}
