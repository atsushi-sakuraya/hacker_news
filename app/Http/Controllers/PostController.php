<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use App\Domain\Services\PostService;
use App\Domain\Entity\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $auth;

    /**
     * @var PostService
     */
    protected $postService;


    public function __construct(
        Request $request,
        PostService $postService
    ) {
        $this->request = $request;
        $this->postService = $postService;
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();
            return $next($request);
        });
    }

    /**
     * 投稿画面
     * @return View
     */
    public function index()
    {
        $auth = Auth::user();
        return view('post', compact('auth'));
    }

    /**
     * 投稿データの登録
     * @param StorePost $request
     * @return RedirectResponse|Redirector
     */
    public function post(StorePost $request)
    {
        try {
            if (empty($this->auth)) {
                return redirect('/login');
            }

            // 投稿データの更新
            $statement = [
                'user_id' => $request['user_id'],
                'content' => $request['comment'],
                'article_url' => $request['newsUrl'][0],
            ];
            Post::insert($statement);

            $imageLists = $request->file('images');
            $this->postService->saveImages($imageLists, (int) $request['user_id']);

            return redirect('/');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect('/post');
        }
    }
}
