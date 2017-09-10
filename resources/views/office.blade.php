<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"><head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Родные Пенаты</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        #sidebar:after    {
            content: "";
            position: absolute;
            top: -1.5em;
            right: 0;
            width: 1px;
            height: 100vh;
            background: #EEE;
        }
        .full-height {
            min-height: 90vh;
        }
    </style>

</head><body><div class="container-fluid my-4">
    <div class="row full-height">

        <!-- SideBar -->
        <nav id="sidebar" class="col-md-2">
            <img alt="Родные Пенаты" src="/images/Penati-Logo.png" style="max-width: 100%" />
        </nav>

        <!-- Main Content -->
        <div id="main" class="col-md-10 align-self-center text-center">
            <p>Извините, в&nbsp;данный момент сайт на&nbsp;реконструкции.</p>
            <p>Но&nbsp;компания продолжает работать!</p>
            <p>Звоните нам: <strong><a href="tel:+7-499-706-89-18">8&nbsp;499 706-89-18</a></strong> или&nbsp;приходите в&nbsp;гости: <strong><a target="_blank" href="https://www.google.ru/maps/place/%D0%90%D0%B3%D0%B5%D0%BD%D1%82%D1%81%D1%82%D0%B2%D0%BE+%D0%BD%D0%B5%D0%B4%D0%B2%D0%B8%D0%B6%D0%B8%D0%BC%D0%BE%D1%81%D1%82%D0%B8+%22%D0%A0%D0%BE%D0%B4%D0%BD%D1%8B%D0%B5+%D0%9F%D0%B5%D0%BD%D0%B0%D1%82%D1%8B%22/@55.7089915,37.662001,17.52z/data=!4m5!3m4!1s0x46b54ada3a010e17:0x3581cb6ec3684b65!8m2!3d55.7089598!4d37.6634764">ул.Автозаводская, д.5, стр.1, офис&nbsp;207</a></strong> (метро «Автозаводская», 300&nbsp;м пешком).</p>
            <p>Мы всегда Вам рады.</p>
        </div>

    </div>
</div>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-289367-18', 'auto');
    ga('send', 'pageview');
</script>
</body></html>
