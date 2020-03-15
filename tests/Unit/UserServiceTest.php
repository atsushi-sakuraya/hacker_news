<?php

namespace Tests\Unit;

use App\Domain\Entity\User;
use App\Domain\Services\UserService;
use App\Domain\Repositories\UserRepository;
use App\Domain\Services\ImageService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{

    /**
     * unko
     */
    public function setUp() :void
    {
        parent::setUp();
    }

    /**
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testGetUser()
    {
//        $userService = new UserService(
//            new UserRepository(),
//            new ImageService()
//        );
//        $userService = $this->app->make('UserService');
        $userModel = new User();
        dd($userModel->find(1));

        //        $user = $this->userService->getUser(1);

        // 名前
        $this->assertSame('あつはる', $user);
    }
}
