@extends('layouts.store')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fara-reference.css') }}">
<style>
    body{background:#fff!important}
    .fara-ref-home{--base-color:#0c0c15;--bg-color:#fff;--main-color:#606cec;--color-primary:#4458ff;--default-width:1200px;--normal-fonts:shabnam,Arial,sans-serif;font-family:Shabnam,IRANYekanX,Tahoma,sans-serif;background:#fff;color:#0c0c15;min-height:100vh}
    .fara-ref-home img{max-width:100%}
    .fara-ref-home .styles__image-wrapper___S_UsW{background:#f9f9f9}
    .fara-ref-home .styles__image___iqiuI{display:block;width:100%;height:auto;object-fit:contain}
    .fara-ref-home .fara-home-slider{position:relative;overflow:hidden}
    .fara-ref-home .fara-home-slide{display:none}
    .fara-ref-home .fara-home-slide.is-active{display:block}
    .fara-ref-home .fara-home-slide img{display:block;width:100%;height:auto}
    .fara-ref-home .fara-menu-trigger{background:none;border:0;color:#fff;cursor:pointer;padding:0;font-size:20px}
    .fara-ref-home .fara-product-scroll{display:flex;overflow-x:auto;scrollbar-width:none}
    .fara-ref-home .fara-product-scroll::-webkit-scrollbar{display:none}
    .fara-ref-home .promo-slide{min-width:0}
    .fara-ref-home .promo-scroll{scroll-snap-type:x mandatory}
    .fara-ref-home .promo-scroll>.styles__slideWrapper___dfFke{scroll-snap-align:start}
    .fara-ref-home .category-scroll{display:flex;overflow-x:auto;scrollbar-width:none}
    .fara-ref-home .category-scroll::-webkit-scrollbar{display:none}
    .fara-ref-home .category-slide{flex:0 0 25%;padding:8px 11.5px}
    .fara-ref-home .product-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:23px}
    .fara-ref-home .blog-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:23px}
    .fara-ref-home .fara-link-muted{color:#6b7c93}
    .fara-ref-home .fara-link-muted:hover{color:var(--color-primary)}
    @media(max-width:1223px){.fara-ref-home .styles__inner___TJfnb{width:95%}.fara-ref-home .product-grid,.fara-ref-home .blog-grid{width:95%;margin-left:auto;margin-right:auto}}
    @media(max-width:979px){
        .fara-ref-home .styles__inner___TJfnb{height:92px;padding:20px 0;width:92%}
        .fara-ref-home .styles__left-side___t78rX{gap:14px}
        .fara-ref-home .styles__mini-cart___zlB6M{margin-left:0}
        .fara-ref-home .styles__search-wrapper___W0qG5{margin:0}
        .fara-ref-home .category-slide{flex-basis:50%}
        .fara-ref-home .product-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
        .fara-ref-home .blog-grid{grid-template-columns:1fr}
    }
    @media(max-width:600px){
        .fara-ref-home .category-slide{flex-basis:83.333%}
        .fara-ref-home .product-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:10px}
    }
</style>

<div class="fara-ref-home">
    <div class="general__wrapper___B8Tdw p-home">
        <div class="general__main___frr_l general__clear___h0wo9">

            <div class="styles__message___CQZNJ styles__blue___pWJOI styles__message-normal___xzKpF">
                <div class="styles__message-inner___hYFur">تحویل سریع اشتراک‌های بین‌المللی با ضمانت فعال‌سازی و پشتیبانی</div>
            </div>

            <header class="styles__header-fixed___K9Hck styles__margin-bottom___HDUAb">
                <div class="styles__inner___TJfnb">
                    <div class="styles__menu-toggle___XtUSt">
                        <button class="fara-menu-trigger" type="button" aria-label="منو">☰</button>
                    </div>

                    <div class="styles__logo___ZvDUC styles__right-side___cMZSF">
                        <a class="styles__logo-link___qW0ki" href="{{ route('home') }}" aria-label="{{ $siteName }}">
                            @if($logoUrl)
                                <img class="styles__logo-image___yxwdN" src="{{ $logoUrl }}" alt="{{ $siteName }}" width="144" height="70">
                            @else
                                <span style="color:#fff;font-size:20px;font-weight:700">{{ $siteName }}</span>
                            @endif
                        </a>
                    </div>

                    <div class="styles__menu___dpMpM general__clear___h0wo9 adaptiveMenu__menu-container___uJkRf adaptiveMenu__standard-menu-container___vY7S4 styles__menu___guaAJ">
                        <span class="styles__close-menu___oyVo7 icons__icon-close___rlPjl icons__icons___db6nw"></span>
                        <div class="adaptiveMenu__top-level-scroll-wrapper___a53q6">
                            <ul class="styles__row___Dmbry adaptiveMenu__top-level-scroll-row___hRQQy" style="list-style:none;margin:0;padding:0">
                                <li class="styles__item___H1l0S" data-menu-active="true">
                                    <a class="styles__link___BZhNG" href="{{ route('home') }}" title="صفحه اصلی">صفحه اصلی</a>
                                </li>
                                <li class="styles__item___H1l0S">
                                    <em class="styles__link___BZhNG">محصولات</em>
                                    <button type="button" class="fara-nav-arrow" aria-label="باز کردن زیرمنوی محصولات">⌄</button>
                                    <div class="styles__column-sub-menu___Qjd9f styles__sub-menu___Ao1KX">
                                        <ul>
                                            @foreach($categories->take(8) as $category)
                                                <li><a class="styles__link___BZhNG" href="{{ route('products.index',['category'=>$category->slug]) }}">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                        <ul>
                                            @foreach($categories->skip(8)->take(8) as $category)
                                                <li><a class="styles__link___BZhNG" href="{{ route('products.index',['category'=>$category->slug]) }}">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li class="styles__item___H1l0S">
                                    <em class="styles__link___BZhNG">درباره ما</em>
                                    <button type="button" class="fara-nav-arrow" aria-label="باز کردن زیرمنوی درباره ما">⌄</button>
                                    <div class="styles__list-sub-menu___dEUKs styles__sub-menu___Ao1KX">
                                        <ul><li><a class="styles__link___BZhNG" href="#" onclick="return false">درباره ما</a></li></ul>
                                    </div>
                                </li>
                                <li class="styles__item___H1l0S">
                                    <em class="styles__link___BZhNG">ارتباط با ما</em>
                                    <button type="button" class="fara-nav-arrow" aria-label="باز کردن زیرمنوی ارتباط با ما">⌄</button>
                                    <div class="styles__list-sub-menu___dEUKs styles__sub-menu___Ao1KX">
                                        <ul>
                                            @if($supportUrl)<li><a class="styles__link___BZhNG" href="{{ $supportUrl }}">پشتیبانی</a></li>@endif
                                            <li><a class="styles__link___BZhNG" href="{{ route('cart.index') }}">پیگیری سفارش / سبد خرید</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="styles__left-side___t78rX">
                        <div class="styles__search-wrapper___W0qG5">
                            <a href="{{ route('products.index') }}" aria-label="جستجو" style="color:#fff">
                                <span class="icons__icon-search___TM52S icons__icons___db6nw"></span>
                            </a>
                        </div>
                        <div class="styles__mini-cart___zlB6M">
                            <div class="styles__inner___uaLo_">
                                <a class="styles__link___BlD5r" href="{{ route('cart.index') }}" aria-label="سبد خرید">
                                    <div class="styles__icon___hvMlb icons__icon-orders___OFYyQ icons__icons___db6nw"></div>
                                </a>
                            </div>
                        </div>
                        <div class="styles__user-auth___MYSNw">
                            @auth
                                <a href="{{ route('account.dashboard') }}" style="color:#fff">حساب کاربری</a>
                            @else
                                <a href="{{ route('auth') }}" style="color:#fff">ورود / ثبت‌نام</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <div class="styles__slideshow-main-wrapper___z0PWo">
                <div class="slick-slider styles__slideshow___tmTpF styles__fixed___QsBaC fara-home-slider" data-fara-main-slider>
                    <div class="slick-list">
                        <div class="slick-track">
                            @forelse($bannerSlides as $i=>$slide)
                                <div class="slick-slide fara-home-slide {{ $i===0 ? 'is-active slick-current' : '' }}" data-fara-slide style="width:100%">
                                    <a class="styles__slide-link___fRgQO" href="{{ $slide['link'] ?? '#' }}">
                                        <img class="styles__slide___T11KV styles__centerCenter___JUO30" src="{{ $slide['image'] }}" alt="slide-image-{{ $i }}">
                                    </a>
                                </div>
                            @empty
                                <div class="slick-slide fara-home-slide is-active" style="width:100%">
                                    <div style="height:420px;display:grid;place-items:center;background:#f9f9f9;color:#6b7c93">برای نمایش اسلایدر، از تنظیمات فروشگاه بنر اضافه کنید.</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @if($bannerSlides->count()>1)
                        <button class="styles__arrow___oG6mu styles__arrow-right___p7MWj" type="button" data-fara-prev aria-label="اسلاید قبلی">‹</button>
                        <button class="styles__arrow___oG6mu styles__arrow-left___NW9k2" type="button" data-fara-next aria-label="اسلاید بعدی">›</button>
                    @endif
                </div>
            </div>

            <div class="styles__wrapper___huewR">
                <div class="styles__inner___qADzf styles__theme-blackfriday___pkbNs">
                    <div class="embla-slider__embla___mm7vY styles__carousel___ILO8k">
                        <div class="embla-slider__embla__viewport___GE_Xf">
                            <div class="embla-slider__embla__container___L6RUa">
                                <div class="embla-slider__embla__slide___tJdu0 styles__slideWrapper___dfFke promo-slide">
                                    <div class="styles__titleSection___wf4sb">
                                        <img class="styles__title___FJLb_" src="{{ asset('images/fara-percent.svg') }}" alt="پیشنهاد ویژه">
                                        <strong style="font-size:14px">پیشنهاد ویژه</strong>
                                        <span style="font-size:11px">تخفیف‌های این فروشگاه</span>
                                    </div>
                                </div>
                                @foreach($allActiveProducts->take(4) as $product)
                                    <div class="embla-slider__embla__slide___tJdu0 styles__slideWrapper___dfFke promo-slide">
                                        @include('store.partials.fara-product-card',['product'=>$product])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <span class="styles__arrow-left___r4SrN styles__arrow-circle___A82Lf" aria-label="اسلاید قبلی">‹</span>
                            <span class="styles__arrow-right___ptDyg styles__arrow-circle___A82Lf" aria-label="اسلاید بعدی">›</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="styles__container___FKWIf">
                <div class="styles__title-wrapper___gNRuL">
                    <h3 class="styles__title___qH9Sq">محصولات پر فروش</h3>
                </div>
                <div class="styles__inner___RsF_J">
                    <div class="product-grid">
                        @foreach($allActiveProducts->skip(4)->take(8) as $product)
                            @include('store.partials.fara-product-card',['product'=>$product,'compact'=>true])
                        @endforeach
                    </div>
                </div>
            </div>

            @foreach($categoryProducts as $name=>$items)
                @php($category=$items->first()?->category)
                <div class="styles__slideshow-wrapper___xmI6t">
                    <div class="styles__title-wrapper___gNRuL">
                        <h3 class="styles__title___qH9Sq">
                            @if($category)
                                <a class="fara-link-muted" href="{{ route('products.index',['category'=>$category->slug]) }}">{{ $name }}</a>
                            @else
                                {{ $name }}
                            @endif
                        </h3>
                    </div>
                    <div class="styles__sliders-content___AxHmi">
                        <div class="embla-slider__embla___mm7vY styles__carousel___LY9VQ">
                            <div class="embla-slider__embla__viewport___GE_Xf">
                                <div class="embla-slider__embla__container___L6RUa category-scroll">
                                    @foreach($items->take(8) as $product)
                                        <div class="embla-slider__embla__slide___tJdu0 styles__slide___VjvxH category-slide">
                                            @include('store.partials.fara-product-card',['product'=>$product])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <span class="styles__arrow-left___r4SrN styles__arrow-circle___A82Lf" aria-label="اسلاید قبلی">‹</span>
                                <span class="styles__arrow-right___ptDyg styles__arrow-circle___A82Lf" aria-label="اسلاید بعدی">›</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="styles__inner___VftlY general__clear___h0wo9">
                <div>
                    <div class="styles__title-wrapper___gNRuL">
                        <h3 class="styles__title___qH9Sq">مطالب وبلاگ</h3>
                    </div>
                    <div class="blog-grid">
                        @php
                            $blogPosts = [
                                ['img'=>'https://oss.sazito.com/apiuploads/faralicense49/uploads/image/rootimage/889/98443376eb77b76d153b17deb1e761d8.webp?w=382&h=382&q=90','title'=>'چطور با هوش مصنوعی یک ویدیوی سینمایی بسازیم؟ از ایده تا خروجی نهایی','date'=>'راهنمای خرید'],
                                ['img'=>'https://oss.sazito.com/apiuploads/faralicense49/uploads/image/rootimage/870/2b2d583766b59cf1ec48ac9448f3ed8a.webp?w=382&h=382&q=90','title'=>'۷ ابزار هوش مصنوعی برای آنلاین‌شاپ‌ها؛ از ساخت عکس محصول تا سئو و افزایش فروش','date'=>'آموزش'],
                                ['img'=>'https://oss.sazito.com/apiuploads/faralicense49/uploads/image/rootimage/856/43afe7a6657110c88379ee7ccc8301af.webp?w=382&h=382&q=90','title'=>'پیش بینی قیمت طلا در سال ۱۴۰۵؛ هوش مصنوعی چه می‌گوید؟','date'=>'دانستنی‌ها'],
                            ];
                        @endphp
                        @foreach($blogPosts as $post)
                            <div class="styles__post___m5LVB general__clear___h0wo9">
                                <a href="#blog">
                                    <div class="styles__image-wrapper___FFLoe">
                                        <img class="styles__image___Aepjh" src="{{ $post['img'] }}" alt="{{ $post['title'] }}" loading="lazy">
                                    </div>
                                    <div class="styles__post-info___M9gb_">
                                        <h2>{{ $post['title'] }}</h2>
                                        <div class="styles__post-footer___ww8iU general__clear___h0wo9">
                                            <span class="styles__date___X59tF">{{ $post['date'] }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <footer class="styles__footer___wx1OQ styles__simple-footer___z5Zz3">
                <div class="styles__inner___OdCLe">
                    <div class="styles__main___JA8EI styles__with-namad___eoUHP">
                        <div class="styles__contact-wrapper___ZzmSO">
                            <div class="styles__socials___CR3lk">
                                <ul>
                                    <li class="styles__socials-item___XGYVt">
                                        <a href="{{ $supportUrl ?: route('account.dashboard') }}" class="styles__socials-icon___guEze">پشتیبانی</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="styles__contact-info___xtaf0">
                                @if($supportUrl)
                                    <a class="styles__contact-info-item___JyNfF" href="{{ $supportUrl }}">{{ $supportUrl }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="styles__copyright___uYXny">
                            <span>© {{ now()->year }} - تمامی حقوق این فروشگاه محفوظ است.</span>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>
</div>

<script>
(() => {
    const root = document.querySelector('[data-fara-main-slider]');
    if (!root) return;
    const slides = [...root.querySelectorAll('[data-fara-slide]')];
    if (slides.length < 2) return;
    let current = 0;
    const render = (next) => {
        current = (next + slides.length) % slides.length;
        slides.forEach((slide, i) => slide.classList.toggle('is-active', i === current));
    };
    root.querySelector('[data-fara-prev]')?.addEventListener('click', () => render(current - 1));
    root.querySelector('[data-fara-next]')?.addEventListener('click', () => render(current + 1));
    setInterval(() => render(current + 1), 6000);
})();
</script>
@endsection