<div class="block justify-content-lg-center text-center block-py">
    <h2>{{ $title }}</h2>
    @if($summary)
    <p class="my-4">{{ $summary }}</p>
    @endif
    <div class="mt-5 row px-2">
        @foreach($content as $item)
        <div class="col-sm-6 col-lg-4 p-2">
            <img src="{{ $item }}" class="img-fluid" />
        </div>
        @endforeach
    </div>
</div>