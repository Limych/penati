@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <!-- SideBar -->
            <nav id="sidebar" class="col-md-2 py-4 text-center">
                <img id="logo" alt="Родные Пенаты" src="{{ asset('images/penati-logo.png') }}" />
            </nav>

            <!-- Main Content -->
            <div id="main-container" class="col-md-10 px-0">
                <div id="header" class="col parallax"></div>
                <div id="main" class="col">
                    {{--<h1>{{ $offer->title }}</h1>--}}
                    @foreach($contentBlocks as $block)
                        {!! $block->html() !!}
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection
