<?php

namespace Tests\Feature\Domain\Services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * 画像ファイルの保存テスト
     */
    public function testSaveImagesOnStorage()
    {
        $img = file_get_contents('tests/img/test_icon.jpg', true);
//        dd($img);
    }
}
