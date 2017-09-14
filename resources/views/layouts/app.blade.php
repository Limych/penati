<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"><head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .block:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
        }
        .block-py {
            padding-top: 7rem !important;
            padding-bottom: 7rem !important;
        }
    </style>
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

</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
</body></html>