@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <!-- SideBar -->
            <nav id="sidebar" class="col-md-2 text-center"><div id="sidebar-sticker" class="py-3">
                @section('sidebar')
                <img id="logo" alt="Родные Пенаты" src="{{ asset('images/penati-logo.png') }}" />
                <div class="" style="border: 1px dashed red">
                    test
                </div>
                @show
            </div></nav>

            <!-- Main Content -->
            <div id="main-container" class="col-md-10 text-center px-0">
                <div id="header" class="col parallax"></div>
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