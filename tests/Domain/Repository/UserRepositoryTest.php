<?php
declare(strict_types=1);

namespace Tests\Domain\Repository;

use App\Domain\Repositories\UserRepository;
use App\Domain\Entity\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testGetUser()
    {
        $userFactory = factory(User::class)->create();

        $userRepository = $this->app->make(UserRepository::class);
        $actual = $userRepository->getUser($userFactory->id);

        $this->assertEquals($userFactory->name, $actual->name);
        $this->assertEquals($userFactory->self_produce, $actual->self_produce);
        $this->assertEquals($userFactory->birth_year, $actual->birth_year);
        $this->assertEquals($userFactory->birth_month, $actual->birth_month);
        $this->assertEquals($userFactory->birth_day, $actual->birth_day);
        $this->assertEquals($userFactory->follow, $actual->follow);
        $this->assertEquals($userFactory->follower, $actual->follower);
        $this->assertEquals($userFactory->email, $actual->email);
        $this->assertEquals($userFactory->email_verified_at, $actual->email_verified_at);
        $this->assertEquals($userFactory->password, $actual->password);
        $this->assertEquals($userFactory->remember_token, $actual->remember_token);
    }

}
