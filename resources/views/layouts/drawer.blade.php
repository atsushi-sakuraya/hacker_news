@guest
    <ul>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    </ul>
@else
    <div id="drawer-header" class="drawer-section">
        <div id="drawer-header-wrapper">
            <div class="profile-img" style="background-image: url({{ asset('/img/profile03.jpg') }});"></div>
            <div class="profile-name">
                <div class="profile-kana">{{ Auth::user()->name }}</div>
                <div class="account-id">@sakkun_as</div>
            </div>
            <div class="friends">
                <div class="follows"><span class="bold">160</span> フォロー</div>
                <div class="followers"><span class="bold">129</span> フォロワー</div>
            </div>
        </div>
    </div>

    <div id="drawer-main" class="drawer-section">
        <ul id="profile-info">
            <li class="profile"><a href="/profile">プロフィール</a></li>
            <li class="post-lists"><a href="/my-posts">投稿リスト</a></li>
            <li class="bookmark"><a href="/bookmark">ブックマーク</a></li>
        </ul>
    </div>

    <div id="drawer-footer" class="drawer-section">
        <ul id="settings">
            <li class="setting">設定</li>
            <li class="help">ヘルプ</li>
            <li class="logout">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
@endguest
