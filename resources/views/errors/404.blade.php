@extends('layouts.frontend')

@section('title')

    404 (Not Found)

@endsection

@section('site-content')

    <div class="mx-md-5">
        <div class="text-right">
            <div class="mt-5 d-inline-block text-left">
                <p> «Куда ты ведёшь нас?.. не&nbsp;видно ни&nbsp;зги!&nbsp;—<br />
                Сусанину с сердцем вскричали враги,&nbsp;—<br />
                Мы вязнем и&nbsp;тонем в&nbsp;сугробинах снега;<br />
                Нам, знать, не&nbsp;добраться с&nbsp;тобой до&nbsp;ночлега.<br />
                Ты сбился, брат, верно, нарочно с&nbsp;пути;<br />
                Но&nbsp;тем Михаила тебе не&nbsp;спасти!..»</p>
                <p class="text-right"><nobr>К. Ф. Рылеев,</nobr> «Иван Сусанин»</p>
            </div>
        </div>

        <h1 class="mt-5 h4">Ресурс не найден</h1>

        <hr />

        <h3 class="h5">Что это значит?</h3>

        <p>
            Мы не смогли найти страницу, которую вы запросили на наших серверах.
            Нам очень жаль, что так вышло. Это наша вина. Мы будем много работать,
            чтобы создать эту страницу как можно скорее.
        </p>

        <p>Возможно, вы хотели бы перейти на нашу <a href="{{ URL::route('home') }}">начальную страницу</a>?</p>
    </div>

@endsection
