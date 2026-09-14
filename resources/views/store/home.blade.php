@extends('layouts.store')

@section('content')
<section class="store-page">
    <div class="banner-wrap">
        @if($bannerUrl)
            <a class="store-banner" href="{{ $bannerLink ?: '#' }}" @if(!$bannerLink) aria-label="بنر فروشگاه" @endif>
                <img src="{{ $bannerUrl }}" alt="بنر {{ $siteName }}">
            </a>
        @else
            <div class="store-banner banner-placeholder">{{ $siteName }} — خدمات دیجیتال با تحویل سریع</div>
        @endif
    </div>

    <div class="store-main">
        <section class="catalog-card">
            <div class="catalog-tabs" role="tablist" aria-label="دسته‌های خدمات">
                @forelse($tabs as $tab)
                    <a class="catalog-tab {{ $selectedTab?->id === $tab->id ? 'active' : '' }}" href="{{ route('home', ['category' => $selectedCategory->slug, 'tab' => $tab->slug]) }}">{{ $tab->name }}</a>
                @empty
                    <span class="catalog-tab active">{{ $selectedCategory?->name ?: 'خدمات' }}</span>
                @endforelse
            </div>

            <div class="catalog-head">
                <div class="catalog-heading">{{ $selectedTab?->name ?: ($selectedCategory?->name ?: 'خدمات') }}</div>
                <form class="search-field" method="GET" action="{{ route('home') }}">
                    @if($selectedCategory)<input type="hidden" name="category" value="{{ $selectedCategory->slug }}">@endif
                    @if($selectedTab)<input type="hidden" name="tab" value="{{ $selectedTab->slug }}">@endif
                    <input name="q" value="{{ request('q') }}" placeholder="جستجو در سرویس‌ها" aria-label="جستجو در سرویس‌ها">
                </form>
            </div>

            <div class="catalog-body">
                <div class="service-list">
                    @forelse($products as $product)
                        <a class="service-row" href="{{ route('product.show', $product) }}">
                            <span class="service-icon">
                                @if($product->image)
                                    <img src="{{ $product->image }}" alt="">
                                @else
                                    {{ mb_substr($product->name, 0, 1) }}
                                @endif
                            </span>
                            <span class="service-name">{{ $product->name }}</span>
                            <span class="service-price">{{ number_format($product->price) }} {{ $product->currency === 'IRR' ? 'ریال' : $product->currency }}</span>
                            <span class="service-action" aria-hidden="true">‹</span>
                        </a>
                    @empty
                        <div class="empty-box">برای این بخش هنوز سرویسی ثبت نشده است.</div>
                    @endforelse
                </div>

                <div class="empty-panel">
                    <div class="empty-inner">
                        <div class="empty-illustration" aria-hidden="true">
                            <span class="spark s1">✦</span><span class="spark s2">✦</span><span class="spark s3">•</span>
                            <div class="astronaut"></div><div class="orb"></div>
                        </div>
                        <strong class="empty-title">{{ $products->isEmpty() ? 'شماره فعالی برای نمایش وجود ندارد' : 'خدمات مورد نیازت را انتخاب کن' }}</strong>
                        <p class="empty-copy">سرویس موردنظر را از فهرست انتخاب کن. سفارش‌های قبلی و وضعیت تحویل همیشه از حساب کاربری قابل پیگیری هستند.</p>
                    </div>
                </div>
            </div>
        </section>

        <aside class="category-sidebar" aria-label="دسته‌های فروشگاه">
            @forelse($categories as $category)
                <a class="category-item {{ $selectedCategory?->id === $category->id ? 'active' : '' }}" href="{{ route('home', ['category' => $category->slug]) }}">
                    <span class="category-label">{{ $category->name }}</span>
                    <span class="category-icon">
                        @if($category->image)<img src="{{ $category->image }}" alt="">@else{{ mb_substr($category->name, 0, 1) }}@endif
                    </span>
                </a>
            @empty
                <div class="empty-box">دسته‌ای ثبت نشده است.</div>
            @endforelse
            @if($supportUrl)
                <a class="category-item" href="{{ $supportUrl }}"><span class="category-label">{{ $supportLabel }}</span><span class="category-icon">?</span></a>
            @endif
        </aside>
    </div>

    <div class="store-info">
        <section class="info-card">
            <h2 class="info-title">شماره مجازی ارزان و اختصاصی</h2>
            <p class="info-copy">برای ثبت‌نام در سرویس‌های آنلاین و شبکه‌های اجتماعی، شماره مناسب خودت را انتخاب کن. خدمات با دسته‌بندی مشخص، قیمت شفاف و مسیر خرید ساده در دسترس هستند.</p>
            <div class="feature-grid">
                <div class="feature"><b>تحویل سریع</b><span>سفارش‌های خودکار در سریع‌ترین زمان ممکن پردازش می‌شوند.</span></div>
                <div class="feature"><b>پرداخت آنلاین</b><span>موجودی کیف پول و سفارش‌ها در حساب کاربری ثبت می‌شوند.</span></div>
                <div class="feature"><b>پشتیبانی آنلاین</b><span>در صورت نیاز از بخش پشتیبانی با کارشناسان در ارتباط باش.</span></div>
            </div>
        </section>
        <section class="info-card">
            <h2 class="info-title">با خیال راحت خرید کن</h2>
            <p class="info-copy">اطلاعات سفارش‌ها، تراکنش‌ها و حساب کاربری در پنل شخصی قابل مشاهده است.</p>
            <div class="trust-list">
                <div class="trust-item">پرداخت امن</div>
                <div class="trust-item">پشتیبانی آنلاین</div>
                <div class="trust-item">تحویل سریع</div>
                <div class="trust-item">سفارش قابل پیگیری</div>
            </div>
        </section>
    </div>
</section>
@endsection
