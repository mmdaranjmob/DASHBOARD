@extends('layouts.store')

@section('content')
<section class="hero">
    <div class="hero-card">
        <span class="eyebrow">فروشگاه خدمات دیجیتال</span>
        <h1>خرید ساده.<br>تحویل سریع.</h1>
        <p>خدمات دیجیتال موردنیازت را با قیمت شفاف انتخاب کن، سفارش بده و همه‌چیز را از یک حساب مدیریت کن.</p>
        <div class="hero-actions">
            @guest
                <a class="btn btn-light" href="{{ route('auth') }}">ورود / عضویت</a>
                <a class="btn btn-ghost" style="color:#fff;border-color:#3a3a3a" href="#products">مشاهده محصولات</a>
            @else
                <a class="btn btn-light" href="#products">مشاهده محصولات</a>
                <a class="btn btn-ghost" style="color:#fff;border-color:#3a3a3a" href="{{ route('account.dashboard') }}">حساب کاربری</a>
            @endguest
        </div>
    </div>
</section>

<section class="section">
    <div class="section-head">
        <div class="section-title"><h2>دسته‌بندی‌ها</h2><p>انتخاب سریع بر اساس نوع خدمات</p></div>
    </div>
    @if($categories->isEmpty())
        <div class="empty">هنوز دسته‌بندی‌ای ثبت نشده است.</div>
    @else
        <div class="grid">
            @foreach($categories as $category)
                <a class="card card-link category-card" href="#products">
                    <span class="category-icon">{{ mb_substr($category->name,0,1) }}</span>
                    <span class="category-title">{{ $category->name }}</span>
                    <span class="muted">مشاهده محصولات</span>
                </a>
            @endforeach
        </div>
    @endif
</section>

@if($featuredProducts->isNotEmpty())
<section class="section">
    <div class="section-head">
        <div class="section-title"><h2>انتخاب‌های ویژه</h2><p>محصولات منتخب فروشگاه</p></div>
        <a class="btn btn-soft" href="#products">همه محصولات</a>
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
        <div class="section-title"><h2>محصولات</h2><p>قیمت شفاف، خرید سریع و پیگیری سفارش</p></div>
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
