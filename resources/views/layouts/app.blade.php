<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title') - Родные Пенаты, Центр Недвижимости</title>
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="@yield('og.type')" />
    <meta property="og:site_name" content="Центр Недвижимости &laquo;Родные Пенаты&raquo;" />

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head><body>
<div id="app">

    {{-- top bar  --}}
    @auth
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                @if (env('APP_DEBUG'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Models
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('/_dev/agent') }}">Agents</a>
                        <a class="dropdown-item" href="{{ url('/_dev/offer') }}">Offers</a>
                    </div>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
        </div>

    </nav>
    @else
    <nav id="navbar-login" class="navbar navbar-light">
        <a class="btn btn-sm btn-light" href="{{ route('login') }}" role="button"
           -data-toggle="modal" -data-target="#dlgLogin" title="Sign In">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
        </a>
    </nav>
    @endauth

    @yield('content')

    <style>
        footer {
            font-size: smaller;
        }
    </style>
    <footer class="bg-dark text-light text-right p-3 pt-4 typografy">
        <p>Copyright © 2017, «Центр Недвижимости “Родные Пенаты”». Все права защищены</p>
        <ul class="list-inline">
            <li class="list-inline-item ml-4"><a href="{{ route('about_personal-data') }}" class="text-light">Обработка персональных данных и&nbsp;правовая информация</a></li>
            <li class="list-inline-item ml-4"><a href="{{ route('about_cookies') }}" class="text-light">Информация о&nbsp;cookie-файлах</a></li>
            {{--<li class="list-inline-item ml-4"><a href="" class="text-light">Написать нам</a></li>--}}
        </ul>
    </footer>

</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script>
    $(function() {
        var tp = new Typograf({locale: ['{{ app()->getLocale() }}', 'en-US']});
        $('.typography').each(function () {
            $(this).html(tp.execute($(this).html()));
        });
        $('.hyphenate').hyphenate();
        $('.parallax').parallax();
    });
</script>
@stack('scripts')
</body></html>
