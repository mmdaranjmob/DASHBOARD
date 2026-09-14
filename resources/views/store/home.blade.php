@extends('layouts.store')

@section('content')
<section class="hero">
    <div class="hero-box">
        <h1>خدمات دیجیتال، سریع و ساده</h1>
        <p>محصول موردنظر خود را انتخاب کنید، هزینه را از کیف پول پرداخت کنید و سفارش خود را پیگیری کنید.</p>
        @guest
            <a class="btn btn-primary" href="{{ route('register') }}">شروع کنید</a>
        @else
            <a class="btn btn-primary" href="#products">مشاهده محصولات</a>
        @endguest
    </div>
</section>

<section class="section">
    <div class="section-head"><h2>دسته‌بندی‌ها</h2></div>
    @if($categories->isEmpty())
        <div class="empty">هنوز دسته‌بندی‌ای ثبت نشده است.</div>
    @else
        <div class="grid">
            @foreach($categories as $category)
                <a class="card cat" href="#products"><span class="cat-title">{{ $category->name }}</span><span class="muted">مشاهده محصولات</span></a>
            @endforeach
        </div>
    @endif
</section>

@if($featuredProducts->isNotEmpty())
<section class="section">
    <div class="section-head"><h2>پیشنهادهای ویژه</h2></div>
    <div class="grid">
        @foreach($featuredProducts as $product)
            @include('store.partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endif

<section class="section" id="products">
    <div class="section-head"><h2>محصولات</h2></div>
    @if($products->isEmpty())
        <div class="empty">محصولی برای نمایش وجود ندارد.</div>
    @else
        <div class="grid">
            @foreach($products as $product)
                @include('store.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    @endif
</section>
@endsection
