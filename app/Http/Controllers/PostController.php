<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\StorePost;
use App\Domain\Services\PostService;

class PostController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $auth;

    /**
     * @var PostService
     */
    protected $postService;


    public function __construct(
        PostService $postService
    ) {
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
        return view('post.index')
            ->with('auth', $this->auth);
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

            $request = $request->all();
            $this->postService->savePostData($request);

            return redirect('/');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect('/post');
        }
    }
}
