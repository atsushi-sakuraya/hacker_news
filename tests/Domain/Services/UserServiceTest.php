<?php
declare(strict_types=1);

namespace Tests\Domain\Services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\Services\UserService;

class UserServiceTest extends TestCase
{
    public function testGetUser()
    {
        $userService = $this->app->make('UserService');
        dd($userService->getUser(1));

        //        $user = $this->userService->getUser(1);

        // 名前
        $this->assertSame('あつはる', $user);
    }
}
