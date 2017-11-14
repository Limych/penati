@extends('_layout.frontend')

@section('title')Рекламные пакеты@endsection

@section('site-content')

    <div class="row block align-items-center" style="background: no-repeat center / cover url({{ asset('/images/intro-bg.jpg') }}); min-height: 30vh">
        <h1 class="col my-5 text-center">Рекламные пакеты</h1>
    </div>

    <div class="row block px-sm-4 py-4">
        <div class="col-12 col-md">
            <h2>Старт</h2>
            <p>Для любых объектов и без предоплаты</p>
            <ul class="fa-ul">
                <li><i class="fa-li fa fa-check text-success"></i>Рекомендации по предпродажной подготовке объекта</li>
                <li><i class="fa-li fa fa-check text-success"></i>Реклама в ЦИАН (базовый тариф)</li>
                <li><i class="fa-li fa fa-check text-success"></i>Реклама на Авито (базовый тариф)</li>
                <li><i class="fa-li fa fa-check text-success"></i>Реклама на 27 иных площадках</li>
            </ul>
            <p class="text-right">Бесплатно</p>
        </div>
        <div class="col-12 col-md">
            <h2>Эконом</h2>
            <p>рекомендуется для объектов стоимостью до 10 млн.&nbsp;₽</p>
            <ul class="fa-ul">
                <li><i class="fa-li fa fa-check text-success"></i>Рекомендации по предпродажной подготовке объекта</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Фотосъёмка объекта риэлтором</li>
                <li><i class="fa-li fa fa-check text-success"></i>Реклама в ЦИАН (базовый тариф)</li>
                <li><i class="fa-li fa fa-check text-success"></i>Реклама на Авито (базовый тариф)</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Реклама на 50 иных площадках</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Размещение на объекте рекламного баннера</li>
            </ul>
            <p class="text-right">5000&nbsp;₽</p>
        </div>
        <div class="col-12 col-md">
            <h2>Комфортный</h2>
            <p>рекомендуется для объектов стоимостью от 10 до 25 млн.&nbsp;₽</p>
            <ul class="fa-ul">
                <li><i class="fa-li fa fa-check text-success"></i>Рекомендации по предпродажной подготовке объекта</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Фотосъёмка объекта профессиональным фотографом</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Видеосъёмка объекта (ролик 3 мин.)</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Реклама в ЦИАН</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Реклама на Авито</li>
                <li><i class="fa-li fa fa-check text-success"></i>Реклама на 50 иных площадках</li>
                <li><i class="fa-li fa fa-check text-success"></i>Размещение на объекте рекламного баннера</li>
            </ul>
            <p class="text-right">15&nbsp;000&nbsp;₽</p>
        </div>
        <div class="col-12 col-md">
            <h2>Премиальный</h2>
            <p>рекомендуется для объектов стоимостью от 25 до 50 млн.&nbsp;₽</p>
            <ul class="fa-ul">
                <li><i class="fa-li fa fa-check text-success"></i>Рекомендации по предпродажной подготовке объекта</li>
                <li><i class="fa-li fa fa-check text-success"></i>Фотосъёмка объекта профессиональным фотографом</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Видеосъёмка объекта</li>
                <li><i class="fa-li fa fa-check text-success"></i>Реклама в ЦИАН</li>
                <li><i class="fa-li fa fa-check text-success"></i>Реклама на Авито</li>
                <li><i class="fa-li fa fa-check text-success"></i>Реклама на 50 иных площадках</li>
                <li><i class="fa-li fa fa-check text-success"></i>Размещение на объекте рекламного баннера</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Продвижение объекта в YouTube</li>
                <li><i class="fa-li fa fa-plus text-success"></i>Создание лендинг-страницы объекта (по желанию)</li>
            </ul>
            <p class="text-right">30&nbsp;000&nbsp;₽</p>
        </div>
        <div class="col-12 col-md">
            <h2>Элит</h2>
            <p>рекомендуется для объектов стоимостью от 50 млн.&nbsp;₽</p>
            <ul class="fa-ul">
            </ul>
            <p class="text-right">40&nbsp;000&nbsp;₽</p>
        </div>
    </div>

@endsection
