@extends('layouts.frontend')

@section('site-content')

    {{--<h1>{{ $offer->title }}</h1>--}}
    @foreach($contentBlocks as $block)
        {!! $block->html() !!}
    @endforeach

@endsection
