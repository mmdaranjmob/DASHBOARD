@extends('layouts.store')

@section('content')
<style>
.home-slider{position:relative;margin-bottom:16px;overflow:hidden;border-radius:20px;border:1px solid #e2eaf0;background:#fff;box-shadow:0 5px 22px rgba(33,62,86,.05)}
.home-slide{display:none;position:relative}.home-slide.active{display:block}.home-slide img{display:block;width:100%;height:190px;object-fit:cover}.home-slide-link{display:block}.home-slider-empty{height:156px;display:flex;align-items:center;justify-content:center;background:linear-gradient(100deg,#e8f6fd,#fbfdff);color:#628092;font-size:16px}
.home-slider-arrow{position:absolute;top:50%;transform:translateY(-50%);width:38px;height:38px;border:1px solid rgba(255,255,255,.7);border-radius:50%;background:rgba(25,43,57,.38);color:#fff;display:grid;place-items:center;cursor:pointer;font-size:20px;z-index:2}.home-slider-prev{right:14px}.home-slider-next{left:14px}.home-slider-dots{position:absolute;bottom:12px;left:50%;transform:translateX(-50%);display:flex;gap:6px;z-index:2}.home-slider-dot{width:7px;height:7px;border:0;border-radius:50%;padding:0;background:rgba(255,255,255,.65);cursor:pointer}.home-slider-dot.active{width:20px;border-radius:10px;background:#fff}
@media(max-width:680px){.home-slide img{height:125px}.home-slider-arrow{width:32px;height:32px;font-size:17px}.home-slider-prev{right:9px}.home-slider-next{left:9px}}
</style>

<section class="store-page">
    <div class="banner-wrap">
        @if($bannerSlides->isNotEmpty())
            <div class="home-slider" data-home-slider>
                @foreach($bannerSlides as $index => $slide)
                    @php($slideLink = trim((string) ($slide['link'] ?? '')))
                    <div class="home-slide {{ $index === 0 ? 'active' : '' }}" data-slide>
                        @if($slideLink)
                            <a class="home-slide-link" href="{{ $slideLink }}">
                                <img src="{{ $slide['image'] }}" alt="بنر {{ $siteName }}">
                            </a>
                        @else
                            <img src="{{ $slide['image'] }}" alt="بنر {{ $siteName }}">
                        @endif
                    </div>
                @endforeach
                @if($bannerSlides->count() > 1)
                    <button type="button" class="home-slider-arrow home-slider-prev" data-prev aria-label="اسلاید قبلی">›</button>
                    <button type="button" class="home-slider-arrow home-slider-next" data-next aria-label="اسلاید بعدی">‹</button>
                    <div class="home-slider-dots" aria-label="انتخاب اسلاید">
                        @foreach($bannerSlides as $index => $slide)
                            <button type="button" class="home-slider-dot {{ $index === 0 ? 'active' : '' }}" data-dot="{{ $index }}" aria-label="اسلاید {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
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

@if($bannerSlides->count() > 1)
<script>
(() => {
    const slider = document.querySelector('[data-home-slider]');
    if (!slider) return;
    const slides = [...slider.querySelectorAll('[data-slide]')];
    const dots = [...slider.querySelectorAll('[data-dot]')];
    let index = 0;
    let timer;
    const show = (next) => {
        index = (next + slides.length) % slides.length;
        slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
        dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
    };
    const restart = () => {
        clearInterval(timer);
        timer = setInterval(() => show(index + 1), 5000);
    };
    slider.querySelector('[data-prev]')?.addEventListener('click', () => { show(index - 1); restart(); });
    slider.querySelector('[data-next]')?.addEventListener('click', () => { show(index + 1); restart(); });
    dots.forEach(dot => dot.addEventListener('click', () => { show(Number(dot.dataset.dot)); restart(); }));
    restart();
})();
</script>
@endif
@endsection
