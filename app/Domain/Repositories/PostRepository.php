<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Entity\Post;

interface PostRepository
{
    /**
     * @param int $postId
     * @return Post
     */
    public function getPost(int $postId);

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
