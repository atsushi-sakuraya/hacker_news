<?php
declare(strict_types=1);

namespace App\Infrastructure\RepositoryImplements;

use App\Domain\Entity\Post;
use App\Domain\Repositories\PostRepository;

class PostRepositoryImplement implements PostRepository
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * PostRepositoryImplement constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @param int $postId
     * @return Post
     */
    public function getPost(int $postId)
    {
        return $this->post->find($postId);
    }

    /**
     * @param array $statement
     * @return Post|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $statement)
    {
        return $this->post->create($statement);
    }

    /**
     * @param int $postId
     * @param array $statement
     */
    public function updateOrCreatePost(int $postId, array $statement)
    {
        $this->post->updateOrCreate(['id' => $postId], $statement);
    }

}
