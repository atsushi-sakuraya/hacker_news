<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hacker News</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto|Noto+Sans+JP:300,400&display=swap" rel="stylesheet">
        <style>
            body { font-weight: 300; }
            a { color: #fff; }
            .header { position: relative; padding-top: 10px; background-color: #541b86; font-family: 'Raleway', 'Noto Sans JP', sans-serif; }
            .logo { width: 100%; text-align: center; color: #fff; font-size: 18px; margin: 10px 0; position: relative; }
            .searchBtn { position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; }
            .searchBtn::before, .searchBtn::after { display: inline-block; content: ''; position: absolute; }
            .searchBtn::before { width: 100%; height: 100%; border: 2px solid #fff; border-radius: 50%; left: 0; top: 0; }
            .searchBtn::after { width: 60%; height: 2px; background-color: #fff; transform: rotate(45deg); left: 70%; top: 100%; }
            .nav { color: #fff; font-size: 14px; font-weight: bold; }
            .nav li { display: inline-block; padding: 5px 10px 10px 10px; position: relative; }
            .nav > li:nth-child(3)::after { display: block; content: ''; position: absolute; width: 80px; height: 2px; background-color: #fff; left: 50%; bottom: 5px; transform: translateX(-50%);}
            .wrapper { background-color: #f5f5f5; padding: 0; }
            .main { font-family: 'Roboto', 'Noto Sans JP', sans-serif }
            .article { padding: 0; }
            .article > li { width: 100%; border-bottom: 1px solid #eee; padding: 15px 0; margin: 10px 0; list-style-type: none; background-color: #fff; }
            .profile { position: relative; padding: 0 10px; margin-bottom: 5px; height: 30px; }
            .profile-icon { width: 25px; height: 25px; display: inline-block; margin-right: 5px; border-radius: 50%; overflow: hidden; }
            .profile-icon img { width: auto; height: 100%; }
            .profile-name { font-size: 12px; display: inline-block; position: absolute; left: 40px; top: 50%; transform: translateY(-50%); }
            .product { position: absolute; right: 40px; top: 0px; display: inline-block; padding: 4px 10px; font-size: 12px; color: white; font-weight: bold; border-radius: 3px; }
            .product.laravel { background-color: #f4645f; }
            .product.php { background-color: #4F5B93; }
            .product.css { background-color: #005A9C; }
            .menu { display: inline-block; position: absolute; right: 10px; top: 0px; }
            .eyecatch { width: 100%; max-height: 250px; overflow: hidden; }
            .eyecatch img { width: 100%; }
            .content { padding: 5px 15px; }
            .article-top { }
            .icon { width: 90px; margin: 5px 0; }
            .icon img { width: 100%; }
            .caption { font-size: 16px; font-weight: 400; margin: 10px 0; }
            .excerpt { font-size: 12px; }
            .article-comment { width: 100%; border:1px solid #eee; border-radius: 5px; padding: 10px; margin-bottom: 10px; }
            .comment { font-size: 12px; }
            .favorite, .readmore { display: block; font-size: 12px; margin: 5px 0; }
            .readmore { color: #bbb; font-weight: bold; }

        </style>
    </head>
    <body>
        <div class="container-fluid header">
            <div class="logo">Hacker's News<div class="searchBtn"></div></div>
            <ul class="nav">
                <a href="/"><li>総合トップ</li></a>
                <li>マイニュース</li>
                <li>ポートフォリオ</li>
            </ul>
        </div>
        <div class="container-fluid wrapper">
            <div class="main">
                <ul class="article">
                    <li>
                        <div class="profile">
                            <div class="profile-icon"><img src="{{ asset('/img/profile01.jpg') }}"></div>
                            <div class="profile-name">Tyler A. Odell</div>
                            <div class="product laravel">Laravel</div>
                            <div class="menu">•••</div>
                        </div>
                        <div class="eyecatch"><img src="{{ asset('/img/portfolio1.png') }}"></div>
                        <div class="content">
                            <div class="article-top">
                                <div class="icon"><img src="{{ asset('/img/icons.png') }}"></div>
                                <div class="favorite">いいね！1,356件</div>
                                <div class="caption">宮古島の紹介サイト</div>
                                <div class="excerpt">Laravel 5.7利用。制作期間3ヶ月ほど。月間Active数1,000人...</div>
                                <div class="readmore">More</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="profile">
                            <div class="profile-icon"><img src="{{ asset('/img/profile02.jpg') }}"></div>
                            <div class="profile-name">Frances J. Francois</div>
                            <div class="product css">CSS</div>
                            <div class="menu">•••</div>
                        </div>
                        <div class="eyecatch"><img src="{{ asset('/img/portfolio2.png') }}"></div>
                        <div class="content">
                            <div class="article-top">
                                <div class="icon"><img src="{{ asset('/img/icons.png') }}"></div>
                                <div class="favorite">いいね！628件</div>
                                <div class="caption">こだわったリストデザイン</div>
                                <div class="excerpt">こんな感じの書籍リストはいかがでしょうか</div>
                                <div class="readmore">More</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="profile">
                            <div class="profile-icon"><img src="{{ asset('/img/profile03.jpg') }}"></div>
                            <div class="profile-name">Rachel M. Kimball</div>
                            <div class="product php">PHP</div>
                            <div class="menu">•••</div>
                        </div>
                        <div class="eyecatch"><img src="{{ asset('/img/portfolio3.png') }}"></div>
                        <div class="content">
                            <div class="article-top">
                                <div class="icon"><img src="{{ asset('/img/icons.png') }}"></div>
                                <div class="favorite">いいね！1,356件</div>
                                <div class="caption">ユーザ投稿型ニュースサイト</div>
                                <div class="excerpt">ユーザの知見や発見をニュースとして投稿できるサイトです。</div>
                                <div class="readmore">More</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>
