<article class="card product">
    <a class="product-img" href="{{ route('product.show', $product) }}">
        @if($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->name }}">
        @else
            <span style="font-size:44px;font-weight:900;color:#8277f2">✦</span>
        @endif
    </a>
    <div class="product-meta">
        <span class="badge">{{ $product->category?->name ?? 'محصول دیجیتال' }}</span>
        @if($product->is_featured)<span class="badge" style="background:#f0efff;color:#6355e8">ویژه</span>@endif
    </div>
    <a class="product-name" href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
    <div class="price-row">
        <span class="price">{{ number_format($product->price) }} <small style="font-size:12px;color:#64748b">{{ $product->currency === 'IRR' ? 'ریال' : $product->currency }}</small></span>
        @if($product->old_price)<span class="old">{{ number_format($product->old_price) }}</span>@endif
    </div>
    <a class="btn btn-dark" href="{{ route('product.show', $product) }}">مشاهده و خرید <span>←</span></a>
</article>
