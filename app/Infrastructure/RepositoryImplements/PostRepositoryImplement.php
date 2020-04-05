<?php
declare(strict_types=1);

namespace App\Infrastructure\RepositoryImplements;

use App\Domain\Entity\Post;
use App\Domain\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;

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
     * @return \Illuminate\Support\Collection
     */
    public function getPosts()
    {
        return $this->post->limit(10)->get();
    }

    /**
     * @param int $userId
     * @return Post[]|Collection
     */
    public function getUserPosts(int $userId)
    {
        return $this->post->where('user_id', $userId)->get();
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
