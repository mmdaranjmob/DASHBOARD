<article class="card product">
    <div class="product-img">
        @if($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->name }}">
        @else
            محصول
        @endif
    </div>
    <div class="muted">{{ $product->category?->name }}</div>
    <strong>{{ $product->name }}</strong>
    <div class="price">
        {{ number_format($product->price) }} {{ $product->currency === 'IRR' ? 'ریال' : $product->currency }}
        @if($product->old_price)<span class="old">{{ number_format($product->old_price) }}</span>@endif
    </div>
    <a class="btn btn-dark" href="{{ route('product.show', $product) }}">مشاهده محصول</a>
</article>
