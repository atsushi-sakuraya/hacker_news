<?php
declare(strict_types=1);

namespace App\Infrastructure\RepositoryImplements;

use App\Domain\Entity\User;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Storage;

class UserRepositoryImplement implements UserRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserRepositoryImplement constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUser(int $userId)
    {
        return $this->user->find($userId);
    }

    /**
     * @param int $userId
     * @param array $statement
     */
    public function updateOrCreateUser(int $userId, array $statement)
    {
        $this->user->updateOrCreate(['id' => $userId], $statement);
    }

}
