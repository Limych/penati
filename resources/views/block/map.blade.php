<div class="block row justify-content-lg-center px-0">
    <div class="col-lg-6 px-5 py-5 py-md-6 text-center text-md-left">
        <h2>{{ $title }}</h2>
        <p class="mt-4">{{ $content }}</p>
    </div>
    <div class="col-lg-6 px-0" id="map" style="height: 35rem; max-height: 70vh"></div>
</div>

@push('scripts')
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    var myMap,
        myPlacemark;

    function init(){
        myMap = new ymaps.Map("map", {
            center: [{{ $coordinates }}],
            zoom: 16,
            controls: ["typeSelector", "zoomControl"]
        });

        myPlacemark = new ymaps.Placemark([{{ $coordinates }}]);

        myMap.geoObjects.add(myPlacemark);
        myMap.behaviors.disable('scrollZoom');
        myMap.behaviors.disable('drag');
    }
</script>
@endpush
