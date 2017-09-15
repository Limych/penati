<div class="block row justify-content-center py-5 py-md-6 px-3">
    <h2 class="w-100">{{ $title }}</h2>
    @if(! empty($content))
        <p class="w-100 my-4">{{ $content }}</p>
    @endif
    <p class="w-100 mt-5" style="font-size: 280%; font-weight: lighter">{{ $price }}</p>
</div>