@extends('layouts.store')

@section('content')
<section class="hero">
    <div class="hero-box">
        <span class="eyebrow">✦ فروشگاه خدمات دیجیتال نسل جدید</span>
        <h1>هر چیزی که لازم داری،<br>سریع و حرفه‌ای تحویل بگیر.</h1>
        <p>از خرید خدمات دیجیتال تا پیگیری سفارش‌ها و مدیریت کیف پول؛ همه‌چیز در یک فضای ساده، سریع و قابل اعتماد.</p>
        <div class="hero-actions">
            @guest
                <a class="btn btn-primary" href="{{ route('auth') }}">شروع خرید</a>
                <a class="btn btn-light" href="#products">مشاهده محصولات</a>
            @else
                <a class="btn btn-primary" href="#products">مشاهده محصولات</a>
                <a class="btn btn-light" href="{{ route('account.dashboard') }}">ورود به حساب</a>
            @endguest
        </div>
    </div>
</section>

<section class="section">
    <div class="section-head">
        <div>
            <h2>دسته‌بندی‌ها</h2>
            <p>سرویس موردنیازت را سریع پیدا کن.</p>
        </div>
    </div>
    @if($categories->isEmpty())
        <div class="empty">هنوز دسته‌بندی‌ای ثبت نشده است.</div>
    @else
        <div class="grid">
            @foreach($categories as $category)
                <a class="card cat" href="#products">
                    <span class="cat-icon">✦</span>
                    <span class="cat-title">{{ $category->name }}</span>
                    <span class="muted">مشاهده محصولات →</span>
                </a>
            @endforeach
        </div>
    @endif
</section>

@if($featuredProducts->isNotEmpty())
<section class="section">
    <div class="section-head">
        <div><h2>انتخاب‌های ویژه</h2><p>محصولاتی که بیشتر دیده می‌شوند.</p></div>
        <a class="btn btn-soft" href="#products">مشاهده همه</a>
    </div>
    <div class="grid">
        @foreach($featuredProducts as $product)
            @include('store.partials.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endif

<section class="section" id="products">
    <div class="section-head">
        <div><h2>محصولات فروشگاه</h2><p>قیمت شفاف، خرید سریع و پیگیری ساده.</p></div>
    </div>
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
