<article class="card product-card">
    <a href="{{ route('product.show', $product) }}" class="card-link">
        <div class="product-image">
            @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}">
            @else
                <span style="font-size:34px;font-weight:900">{{ mb_substr($product->name, 0, 1) }}</span>
            @endif
        </div>
    </a>
    <div class="product-body">
        <div class="product-meta">
            <span class="badge">{{ $product->category?->name ?? 'محصول دیجیتال' }}</span>
            @if($product->is_featured)<span class="badge">ویژه</span>@endif
        </div>
        <a class="product-name" href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
        <div class="price-row">
            <span class="price">{{ number_format($product->price) }} <small style="font-size:11px">{{ $product->currency === 'IRR' ? 'ریال' : $product->currency }}</small></span>
            @if($product->old_price)<span class="old">{{ number_format($product->old_price) }}</span>@endif
        </div>
        <div class="product-actions">
            <a class="btn btn-primary" href="{{ route('product.show', $product) }}">جزئیات</a>
            <form method="POST" action="{{ route('cart.add', $product) }}" style="flex:1">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button class="btn btn-soft" type="submit" style="width:100%">افزودن</button>
            </form>
        </div>
    </div>
</article>
