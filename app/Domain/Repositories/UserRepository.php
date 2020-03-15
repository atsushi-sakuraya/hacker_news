<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Entity\User;

interface UserRepository
{
    /**
     * @param int $userId
     * @return User
     */
    public function getUser(int $userId);

    /**
     * @param int $userId
     * @param array $statement
     */
    public function updateOrCreateUser(int $userId, array $statement);
}
