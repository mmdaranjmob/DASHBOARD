@php
    $currency = $product->currency === 'IRR' ? 'تومان' : ($product->currency ?: 'تومان');
    $hasDiscount = ($product->original_price ?? null) && $product->original_price > $product->price;\n    $promo = $promo ?? false;\n    $compact = $compact ?? false;
@endphp
<div class="styles__product___tP7kV grid__span-1___sEgUc {{ $compact ? 'styles__two-columns___X1oD5' : '' }} {{ $promo ? 'styles__product___KsPB7' : '' }}">
    <a class="styles__link___DUbrB general__clear___h0wo9" href="{{ route('product.show',$product) }}">
        @if($hasDiscount)
            <span class="smartTextColor__wrapper___BmwOo smartTextColor__accent___o6C0X smartTextColor__normal____fdpD smartTextColor__background___g52rg styles__discount-tag___nlxNa">تخفیف</span>
        @endif
        <div class="styles__image-wrapper___S_UsW">
            <div class="styles__image-align___n2xW0 styles__fade-in___hoGoh">
                @if($product->image)
                    <img class="styles__image___iqiuI" src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">
                @else
                    <span class="styles__image-placeholder___RGWnq"><span style="font-size:52px;color:#d9dce5">✦</span></span>
                @endif
            </div>
        </div>
        <h3 class="styles__title___WnfBA" dir="auto">{{ $product->name }}</h3>
        <div class="styles__info___Gst2W">
            <div>
                @if($hasDiscount)
                    <span class="styles__raw-price___A6vj_">{{ number_format($product->original_price) }}</span>
                @endif
                <span class="styles__price___nJwcR js-price">{{ number_format($product->price) }} <span>{{ $currency }}</span></span>
            </div>
        </div>
    </a>
</div>