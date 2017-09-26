@extends('layouts.frontend')

@section('title')Добро пожаловать@endsection

@section('site-content')

    <div class="row block align-items-center" style="background: no-repeat center / cover url({{ asset('/images/intro-bg.jpg') }}); min-height: 30vh">
        <h1 class="col my-5 text-center">Центр Недвижимости<br/> «Родные Пенаты»</h1>
    </div>

    <div class="row block px-sm-5 pb-5">
        <h2 class="mt-5">Наши ценности</h2>

        <div class="container-fluid text-justify hyphenate">
            <div class="row my-3 align-items-center">
                <div class="col-sm-5 order-sm-12"><img class="img-fluid rounded" src="{{ asset('images/gallery.jpg') }}" /></div>
                <div class="col-sm-7 order-sm-1 mt-2">
                    <p>Мы считаем, что недвижимость – основа семьи и полноценной жизни. Такой же основой является культура народа. Как недвижимость объединяет людей, которые в ней живут, так и культура объединяет людей, живущих в этой стране.</p>
                </div>
            </div>
            <div class="row my-3 align-items-center">
                <div class="col-sm-5"><img class="img-fluid rounded" src="{{ asset('images/innovation.jpg') }}" /></div>
                <div class="col-sm-7 mt-2">
                    <p>Мы верим, что в современном мире бизнес не может жить и процветать без инноваций и творческого подхода руководства компании и каждого члена коллектива. Именно поэтому:
                        <ul>
                            <li>наш слоган «Бизнес – стабильность, инновации, творчество»;</li>
                            <li>мы провели три Московских (2004, 2005, 2007 гг) и три Международных фестивалей творчества профессионалов рынка недвижимости «Вдохновение» (2011, 2012, 2013 гг);</li>
                            <li>мы провели форум «Инновации. Творчество. Бизнес» в 2012 году.</li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="row my-3 align-items-center">
                <div class="col-sm-5 order-sm-12"><img class="img-fluid rounded" src="{{ asset('images/realtor.jpg') }}" /></div>
                <div class="col-sm-7 order-sm-1 mt-2">
                    <p>Мы понимаем, что недвижимость – один из главных факторов, определяющих стиль жизни любого человека. От того каковы жилищные условия, где  живет человек и в каком окружении зависит <strong>как</strong> он живет. И именно поэтому:   задача консультанта  в сфере недвижимости, брокера и риэлтора помочь клиенту понять какой именно образ жизни будет для него максимально комфортным на данном этапе жизни и достичь этого идеального образа жизни наикратчайшим путем, в том числе через сделки с недвижимостью.</p>
                </div>
            </div>
        </div>
    </div>

@endsection
