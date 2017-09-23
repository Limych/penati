<div class="block row justify-content-center py-5 py-md-6">
    <h2 class="text-center">{{ $title }}</h2>
    @if(! empty($summary))
        <p class="my-4">{{ $summary }}</p>
    @endif
    <div class="container-fluid">
        <div class="row mt-5 px-2">
            @foreach($content as $item)
            <div class="col-sm-6 col-lg-4 p-2">
                <img src="{{ $item }}" class="img-fluid rounded" />
            </div>
            @endforeach
        </div>
    </div>
</div>
