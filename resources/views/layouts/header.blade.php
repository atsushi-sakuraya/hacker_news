<header class="clearfix">
    <div id="main-header">
        <div class="searchBtn"></div>
        <div class="logo"><a href="/">Hacker's News</a></div>
        <div id="drawer">
            <input type="checkbox" id="drawer-input" class="drawer-hidden">
            <label for="drawer-input" id="drawer-icon" style="background-image: url({{ asset('/img/profile03.jpg') }});"></label>
            <label for="drawer-input" id="drawer-bg" class="drawer-hidden"></label>
            <div id="drawer-contents">@include('layouts.drawer')</div>
        </div>
        <div class="auth">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </div>
    </div>
</header>
<nav>
    <ul class="menu">
        <a href="/"><li>総合トップ</li></a>
        <a href="/"><li>マイニュース</li></a>
        <a href="portfolio"><li>ポートフォリオ</li></a>
    </ul>
</nav>
