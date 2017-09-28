@hasSection('auth-mode')
    @section('meta-robots')none @endsection
    @push('styles')
        <style>
            .app {
                background-color: #e4e5e6;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                min-height: 100vh;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
            }
        </style>
    @endpush
@endif
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
@hasSection('meta-robots')
    <meta name="robots" content="@yield('meta-robots')"/>
@endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title') - Родные Пенаты, Центр Недвижимости</title>
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="@yield('og.type')" />
    <meta property="og:site_name" content="Центр Недвижимости &laquo;Родные Пенаты&raquo;" />

    <!-- Styles -->
    <link href="{{ mix('css/fonts.css') }}" rel="stylesheet" />
    @auth
        <link href="{{ mix('css/dashboard.css') }}" rel="stylesheet" />
    @else
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
        @hasSection('auth-mode')
            <link rel="prefetch" href="{{ mix('css/dashboard.css') }}" />
        @endif
    @endif
    @stack('styles')

</head><body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden @yield('body-classes')">

{{-- top bar  --}}
@auth
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
        <a class="navbar-brand" href="{{ route('dashboard') }}"></a>
        <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>

        <ul class="nav navbar-nav d-md-down-none">
            {{--<li class="nav-item px-3">--}}
                {{--<a class="nav-link" href="#">Dashboard</a>--}}
            {{--</li>--}}
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
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-down-none">
                <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
            </li>
            {{--<li class="nav-item d-md-down-none">--}}
                {{--<a class="nav-link" href="#"><i class="icon-list"></i></a>--}}
            {{--</li>--}}
            {{--<li class="nav-item d-md-down-none">--}}
                {{--<a class="nav-link" href="#"><i class="icon-location-pin"></i></a>--}}
            {{--</li>--}}
            <li class="nav-item dropdown">
                <a id="account-menu" class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ gravatar(Auth::user()->email)->setDefaultImage('mm')->setExtension('jpg')->setSize(35) }}" class="img-avatar" aria-hidden="true">
                    <span class="d-md-down-none">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{--<div class="dropdown-header text-center">--}}
                        {{--<strong>Account</strong>--}}
                    {{--</div>--}}
                    {{--<a class="dropdown-item" href="#"><i class="fa fa-bell-o mr-2"></i>Updates<span class="badge badge-info">42</span></a>--}}
                    {{--<a class="dropdown-item" href="#"><i class="fa fa-envelope-o mr-2"></i>Messages<span class="badge badge-success">42</span></a>--}}
                    {{--<a class="dropdown-item" href="#"><i class="fa fa-tasks mr-2"></i>Tasks<span class="badge badge-danger">42</span></a>--}}
                    {{--<a class="dropdown-item" href="#"><i class="fa fa-comments mr-2"></i>Comments<span class="badge badge-warning">42</span></a>--}}
                    {{--<div class="dropdown-header text-center">--}}
                        {{--<strong>Settings</strong>--}}
                    {{--</div>--}}
                    {{--<a class="dropdown-item" href="#"><i class="fa fa-user mr-2"></i>Profile</a>--}}
                    {{--<a class="dropdown-item" href="#"><i class="fa fa-wrench mr-2"></i>Settings</a>--}}
                    {{--<a class="dropdown-item" href="#"><i class="fa fa-usd mr-2"></i>Payments<span class="badge badge-secondary">42</span></a>--}}
                    {{--<div class="divider"></div>--}}
                    <a class="dropdown-item" href="#"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out mr-2"></i>Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">{{ csrf_field() }}</form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler aside-menu-toggler" type="button">☰</button>

    </header>
@else
    @hasSection('auth-mode')
    @else
        <nav id="navbar-login" class="navbar navbar-light">
            <a class="btn btn-sm btn-light" href="{{ route('login') }}" role="button"
               data-toggle="modal" data-target="#dlgLogin" title="Sign In">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
            </a>
        </nav>
        @include('auth.modal-login')
    @endif
@endauth

@yield('content')

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

        $('#dlgLogin').on('shown.bs.modal', function () {
            $('#dlgLoginEmail').focus()
        })
        @if($errors->count())
        $('#dlgLogin').modal('show');
        @endif
    });
</script>
@stack('scripts')
</body></html>
