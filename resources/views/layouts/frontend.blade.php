@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <!-- SideBar -->
            <nav id="sidebar" class="col-md-2 text-center"><div id="sidebar-sticker" class="py-3">
                @section('sidebar')
                    <div id="logo">
                        <a href="{{ route('home') }}"><img class="img-fluid" style="max-height: 4rem" alt="Родные Пенаты" src="{{ asset('images/penati-logo.png') }}" /></a>
                    </div>
                @show
                <div id="sidebar-contacts" class="typography">

                    @section('sidebar-contacts')
                        <div class="mt-4 mt-md-0 hyphenate" >
                            <p class="small">Позвоните нам или приходите в гости - мы будем Вам рады:</p>
                            <p><i class="fa fa-phone mr-2 text-muted" aria-hidden="true"></i><a href="tel:+7-499-706-89-18">8&nbsp;499 706-89-18</a></p>
                            <p><i class="fa fa-map-marker mr-2 text-muted" aria-hidden="true"></i><a target="_blank" href="https://www.google.ru/maps/place/%D0%90%D0%B3%D0%B5%D0%BD%D1%82%D1%81%D1%82%D0%B2%D0%BE+%D0%BD%D0%B5%D0%B4%D0%B2%D0%B8%D0%B6%D0%B8%D0%BC%D0%BE%D1%81%D1%82%D0%B8+%22%D0%A0%D0%BE%D0%B4%D0%BD%D1%8B%D0%B5+%D0%9F%D0%B5%D0%BD%D0%B0%D1%82%D1%8B%22/@55.7089915,37.662001,17.52z/data=!4m5!3m4!1s0x46b54ada3a010e17:0x3581cb6ec3684b65!8m2!3d55.7089598!4d37.6634764">ул.&nbsp;Автозаводская, д.5, стр.1, офис&nbsp;207</a><br /> <small>(метро «Автозаводская», 300&nbsp;м пешком)</small></p>
                        </div>
                    @show

                </div>
            </div></nav>

            <!-- Main Content -->
            <div id="main-container" class="col-md-10 px-0">
                {{--<div id="header" class="col parallax"></div>--}}
                <div id="main" class="col container-fluid typography">
                    @yield('site-content')
                </div>
            </div>

        </div>
    </div>

@endsection
