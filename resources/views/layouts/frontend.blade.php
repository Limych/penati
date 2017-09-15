@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <!-- SideBar -->
            <nav id="sidebar" class="col-md-2 text-center"><div id="sidebar-sticker" class="py-3">
                @section('sidebar')
                    <div id="logo">
                        <img class="img-fluid" style="max-height: 4rem" alt="Родные Пенаты" src="{{ asset('images/penati-logo.png') }}" />
                    </div>
                @show
                <div id="sidebar-contacts">
                    @yield('sidebar-contacts')
                </div>
            </div></nav>

            <!-- Main Content -->
            <div id="main-container" class="col-md-10 text-center px-0">
                {{--<div id="header" class="col parallax"></div>--}}
                <div id="main" class="col">
                    @yield('site-content')
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        (function() {
            var tp = new Typograf({locale: ['{{ app()->getLocale() }}', 'en-US']});
            var elem = document.querySelector('#main');
            elem.innerHTML = tp.execute(elem.innerHTML);
        })();
    </script>
@endpush