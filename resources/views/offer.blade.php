@extends('_layout.frontend')

@section('title'){{ $offer->title }} ({{ $offer->address }})@endsection

@section('sidebar-contacts')

    <div class="d-none d-md-block">
        <p class="small">Я&nbsp;с&nbsp;радостью отвечу на&nbsp;Ваши вопросы по&nbsp;этому объекту</p>
        <div>
            <img src="/images/dummy-portrait.png" class="img-fluid my-2" style="max-height: 7rem" />
        </div>
        <p>{{ $agent->displayName }}</p>
        @foreach(explode("\n", $agent->contactUris) as $contact)
            @if(preg_match('/^tel:(.+)/', $contact, $matches))
                <p><a href="{{ $matches[0] }}">{{ $matches[1] }}</a></p>
            @endif
        @endforeach
    </div>
    <div class="d-block d-md-none mt-4">
        @foreach(explode("\n", $agent->contactUris) as $contact)
            @if(preg_match('/^tel:(.+)/', $contact, $matches))
                <p><a href="{{ $matches[0] }}">{{ $matches[1] }}</a></p>
                @break
            @endif
        @endforeach
        <p>Ваш помощник: {{ $agent->displayName }}</p>
    </div>

@endsection

@section('site-content')

    {{--<h1>{{ $offer->title }}</h1>--}}
    @foreach($contentBlocks as $block)
        {!! $block->html() !!}
    @endforeach

    <div class="d-block d-md-none block row justify-content-center py-5 py-md-6 px-3 text-center">
        <p class="small">Я&nbsp;с&nbsp;радостью отвечу на&nbsp;Ваши вопросы по&nbsp;этому объекту</p>
        <div>
            <img src="/images/dummy-portrait.png" class="img-fluid my-2" style="max-height: 7rem" />
        </div>
        <p>{{ $agent->displayName }}</p>
        @foreach(explode("\n", $agent->contactUris) as $contact)
            @if(preg_match('/^tel:(.+)/', $contact, $matches))
                <p><a href="{{ $matches[0] }}">{{ $matches[1] }}</a></p>
            @endif
        @endforeach
    </div>
    <div class="block row justify-content-center py-5 py-md-6 px-3 text-center">
        <p class="w-100">Пожалуйста, поделитесь этой страницей с друзьями. Возможно, это та недвижимость, которую ищет ваш друг.</p>
        <div class="w-100">
            <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8" async="async"></script>
            <div class="ya-share2" data-services="facebook,vkontakte,twitter,odnoklassniki,viber,whatsapp,skype,telegram" data-counter=""></div>
        </div>
    </div>

@endsection
