@php($service_mode = !empty($service_mode) || !empty($auth_mode))
@if(!empty($auth_mode))
    @php(Meta::setMetaRobots('none'))
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
{{--    {!! Meta::render() !!}--}}
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
@hasSection('meta-robots')
    <meta name="robots" content="@yield('meta-robots')"/>
@endif

    <link rel="canonical" href="{{ URL::current() }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title') - Родные Пенаты, Центр Недвижимости</title>
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="@yield('og.type')" />
    <meta property="og:site_name" content="Центр Недвижимости &laquo;Родные Пенаты&raquo;" />

    <!-- Styles -->
    <link href="{{ mix('css/fonts.css') }}" rel="stylesheet" />
    @auth
        <link href="{{ mix('css/admin.css') }}" rel="stylesheet" />
    @else
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
        @hasSection('auth-mode')
            <link rel="prefetch" href="{{ mix('css/admin.css') }}" />
        @endif
    @endif
    @stack('styles')

</head><body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden @yield('body-classes')">

{{-- top bar  --}}
@auth
    <header class="app-header navbar">
        @include(AdminTemplate::getViewPath('_partials.header'))
    </header>
@elseif(empty($service_mode))
    <nav id="navbar-login" class="navbar navbar-light">
        <a class="btn btn-sm btn-light" href="{{ route('login') }}" role="button"
           data-toggle="modal" data-target="#dlgLogin" title="Sign In">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
        </a>
    </nav>
    @include('auth.modal-login')
@endif

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
            $('#dlgLoginEmail').focus();
        });
        @if(!empty($errors) && $errors->count())
        $('#dlgLogin').modal('show');
        @endif
    });
</script>
@stack('scripts')
</body></html>
