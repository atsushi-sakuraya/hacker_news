<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Entity\User;
use App\Http\Requests\StoreUsers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Domain\Services\UserService;
use App\Domain\Services\PostService;
use Illuminate\Support\Facades\Log;
use Throwable;
use Exception;

class UserController extends Controller
{

    /**
     * @var User
     */
    private $user;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var PostService
     */
    private $postService;

    /**
     * @var Authenticatable|null
     */
    private $auth;

    /**
     * UserController constructor.
     * @param User $user
     * @param UserService $userService
     * @param PostService $postService
     */
    public function __construct(
        User $user,
        UserService $userService,
        PostService $postService
    ) {
        $this->user = $user;
        $this->userService = $userService;
        $this->postService = $postService;

        // ログイン情報を取得
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();
            return $next($request);
        });

        // 未ログインユーザはログイン画面へ
        if ($this->isNotLoginUser()) {
            return redirect('/login');
        }
    }

    /**
     * @return View|RedirectResponse
     */
    public function index()
    {
        $user = $this->userService->getUser($this->auth->id);
        $posts = $this->postService->getPosts();

        return view(
            'index',
            compact('user', 'posts')
        )->with('auth', $this->auth);
    }

    /**
     * @return View|RedirectResponse
     */
    public function detail()
    {
        $user = $this->userService->getUser($this->auth->id);

        return view(
            'profile.index',
            compact('user')
        )->with('auth', $this->auth);
    }

    /**
     * @return View|RedirectResponse
     */
    public function edit()
    {
        $user = $this->userService->getUser($this->auth->id);
        return view(
            'profile.edit',
            compact('user')
        )->with('auth', $this->auth);
    }

    /**
     * @param StoreUsers $request
     * @return RedirectResponse
     */
    public function store(StoreUsers $request)
    {
        try {
            $request = $request->all();
            $this->userService->saveUserData($request);

            return redirect()->route('profile');
        } catch (Throwable $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * @return bool
     */
    private function isNotLoginUser(): bool
    {
        return $this->auth === null;
    }
}
