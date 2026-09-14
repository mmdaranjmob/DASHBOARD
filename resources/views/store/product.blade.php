@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:42px">
    <div class="card" style="max-width:850px;margin:auto">
        <div class="product-img" style="height:260px;margin-bottom:22px">
            @if($product->image)<img src="{{ $product->image }}" alt="{{ $product->name }}">@else>محصول@endif
        </div>
        <div class="muted">{{ $product->category?->name }}</div>
        <h1>{{ $product->name }}</h1>
        @if($product->description)<p class="muted" style="line-height:2">{{ $product->description }}</p>@endif
        <div class="price" style="margin:18px 0">{{ number_format($product->price) }} {{ $product->currency === 'IRR' ? 'ریال' : $product->currency }}</div>
        @if($product->fields->isNotEmpty())
            <h3>اطلاعات موردنیاز</h3>
            @foreach($product->fields as $field)
                <div style="padding:10px 0"><strong>{{ $field->name }}</strong><div class="muted">{{ $field->description }}</div></div>
            @endforeach
        @endif
        @auth
            <button class="btn btn-dark" disabled>خرید — به‌زودی</button>
        @else
            <a class="btn btn-dark" href="{{ route('login') }}">ورود برای خرید</a>
        @endauth
        <a class="btn" href="{{ route('home') }}">بازگشت به فروشگاه</a>
    </div>
</section>
@endsection
