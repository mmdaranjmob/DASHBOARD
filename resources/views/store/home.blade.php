@extends('layouts.store')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fara-reference.css') }}">
<style>
    .fara-ref-home{--base-color:#0c0c15;--bg-color:#fff;--main-color:#606cec;--color-primary:#4458ff;--default-width:1200px;--normal-fonts:Shabnam,Arial,sans-serif;font-family:Shabnam,IRANYekanX,Tahoma,sans-serif}
    .fara-ref-home .styles__image-wrapper___S_UsW{background:#fafafa}
    .fara-ref-home .fara-home-slider-placeholder{height:420px;background:#f7f7f8;display:flex;align-items:center;justify-content:center;color:#6b7c93}
    .fara-ref-home .fara-menu-trigger{background:transparent;border:0;color:#fff;cursor:pointer}
    .fara-ref-home .fara-product-row-scroll{overflow-x:auto;scrollbar-width:none;display:flex}
    .fara-ref-home .fara-product-row-scroll::-webkit-scrollbar{display:none}
    .fara-ref-home .fara-product-item{flex:0 0 25%;padding:0 11.5px}
    .fara-ref-home .fara-product-item-small{flex:0 0 50%;padding:0 8px}
    .fara-ref-home .fara-product-item .styles__product___tP7kV{height:100%}
    @media(max-width:979px){
        .fara-ref-home .fara-product-item{flex-basis:50%}
    }
    @media(max-width:767px){
        .fara-ref-home .fara-product-item{flex-basis:83.333%}
    }
</style>

<div class="fara-ref-home">
    <div class="general__wrapper___B8Tdw">
        <div class="general__main___frr_l general__clear___h0wo9">

            <div class="styles__message___CQZNJ styles__blue___pWJOI styles__message-normal___xzKpF">
                <div class="styles__message-inner___hYFur">تحویل سریع محصولات با ضمانت فعال‌سازی و پشتیبانی</div>
            </div>

            <header class="styles__header-fixed___K9Hck styles__margin-bottom___HDUAb">
                <div class="styles__inner___TJfnb">
                    <div class="styles__menu-toggle___XtUSt"><button class="fara-menu-trigger" type="button" aria-label="منو">☰</button></div>

                    <div class="styles__logo___ZvDUC styles__right-side___cMZSF">
                        <a class="styles__logo-link___qW0ki" href="{{ route('home') }}" aria-label="{{ $siteName }}">
                            @if($logoUrl)
                                <img class="styles__logo-image___yxwdN" src="{{ $logoUrl }}" alt="{{ $siteName }}" width="144" height="70">
                            @else
                                <span style="color:#fff;font-size:20px;font-weight:700">{{ $siteName }}</span>
                            @endif
                        </a>
                    </div>

                    <div class="styles__menu___dpMpM styles__menu___guaAJ">
                        <div class="adaptiveMenu__top-level-scroll-wrapper___a53q6">
                            <ul class="styles__row___Dmbry" style="list-style:none;margin:0;padding:0">
                                <li class="styles__item___H1l0S" data-menu-active="true">
                                    <a class="styles__link___BZhNG" href="{{ route('home') }}">صفحه اصلی</a>
                                </li>
                                <li class="styles__item___H1l0S">
                                    <em class="styles__link___BZhNG" style="font-style:normal">محصولات</em>
                                    <div class="styles__sub-menu___Ao1KX fara-products-menu">
                                        <div class="styles__column-sub-menu___Qjd9f">
                                            <ul>
                                                @foreach($categories->take(8) as $category)
                                                    <li><a href="{{ route('products.index',['category'=>$category->slug]) }}">{{ $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                            <ul>
                                                @foreach($categories->skip(8)->take(8) as $category)
                                                    <li><a href="{{ route('products.index',['category'=>$category->slug]) }}">{{ $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="styles__item___H1l0S"><em class="styles__link___BZhNG" style="font-style:normal">درباره ما</em></li>
                                <li class="styles__item___H1l0S"><em class="styles__link___BZhNG" style="font-style:normal">ارتباط با ما</em></li>
                            </ul>
                        </div>
                    </div>

                    <div class="styles__left-side___t78rX">
                        <div class="styles__search-wrapper___W0qG5">
                            <a href="{{ route('products.index') }}" aria-label="جستجو" style="color:#fff"><span class="icons__icon-search___TM52S icons__icons___db6nw"></span></a>
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
                <div class="slick-slider styles__slideshow___tmTpF styles__fixed___QsBaC">
                    <div class="slick-list">
                        <div class="slick-track" data-fara-slides>
                            @forelse($bannerSlides as $i=>$slide)
                                <div data-fara-slide class="slick-slide {{ $i===0?'slick-active slick-current':'' }}" style="width:100%;display:{{ $i===0?'block':'none' }}">
                                    <div>
                                        <a class="styles__slide-link___fRgQO" href="{{ $slide['link'] ?? '#' }}">
                                            <img class="styles__slide___T11KV styles__centerCenter___JUO30" src="{{ $slide['image'] }}" alt="slide-image-{{ $i }}" style="display:block;width:100%;height:auto">
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="slick-slide slick-active" style="width:100%;display:block">
                                    <div class="fara-home-slider-placeholder">برای نمایش اسلایدر اصلی، از تنظیمات فروشگاه بنر اضافه کنید.</div>
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
                    <div class="styles__titleSection___wf4sb" style="display:flex">
                        <img class="styles__title___FJLb_" src="{{ asset('images/fara-amazing.svg') }}" alt="پیشنهاد ویژه">
                        <span style="color:#fff;font-size:12px">پیشنهادهای ویژه</span>
                    </div>
                    <div class="embla-slider__embla___mm7vY styles__carousel___ILO8k" style="width:100%">
                        <div class="embla-slider__embla__viewport___GE_Xf">
                            <div class="embla-slider__embla__container___L6RUa fara-product-row-scroll common__py-2___CGLEL">
                                @foreach($allActiveProducts->take(8) as $product)
                                    <div class="styles__slideWrapper___dfFke fara-product-item" style="padding:0 3px">
                                        @include('store.partials.fara-product-card',['product'=>$product])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <span class="styles__arrow-left___r4SrN styles__arrow-circle___A82Lf">‹</span>
                            <span class="styles__arrow-right___ptDyg styles__arrow-circle___A82Lf">›</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="styles__container___FKWIf">
                <div class="styles__title-wrapper___gNRuL">
                    <h3 class="styles__title___qH9Sq">محصولات پرفروش</h3>
                </div>
                <div class="styles__inner___RsF_J">
                    <div class="grid__container-12___Wvcgh grid__gap___KbmCT grid__gap-mobile-small___Q4RFo">
                        @foreach($allActiveProducts->skip(8)->take(8) as $product)
                            <div class="styles__product___tP7kV grid__span-3___lhPEi grid__span-small-6___jLYuH fara-ref-card">
                                @include('store.partials.fara-product-card',['product'=>$product])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @foreach($categoryProducts as $name=>$items)
                @php($category=$items->first()?->category)
                <div class="styles__slideshow-wrapper___xmI6t">
                    <div class="styles__title-wrapper___gNRuL">
                        <h3 class="styles__title___qH9Sq">
                            @if($category)<a href="{{ route('products.index',['category'=>$category->slug]) }}">{{ $name }}</a>@else{{ $name }}@endif
                        </h3>
                    </div>
                    <div class="styles__sliders-content___AxHmi">
                        <div class="embla-slider__embla___mm7vY styles__carousel___LY9VQ" style="width:100%">
                            <div class="embla-slider__embla__viewport___GE_Xf">
                                <div class="embla-slider__embla__container___L6RUa fara-product-row-scroll common__py-2___CGLEL">
                                    @foreach($items->take(8) as $product)
                                        <div class="embla-slider__embla__slide___tJdu0 embla-slider__embla__slide-default-2___zqA7U embla-slider__embla__slide-md-3____elpr embla-slider__embla__slide-lg-4___SmZpw" style="flex:0 0 25%;padding:0 11.5px">
                                            @include('store.partials.fara-product-card',['product'=>$product])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <span class="styles__arrow-left___r4SrN styles__arrow-circle___A82Lf">‹</span>
                                <span class="styles__arrow-right___ptDyg styles__arrow-circle___A82Lf">›</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="styles__inner___VftlY" id="blog">
                <div class="styles__title-wrapper___gNRuL"><h3 class="styles__title___qH9Sq">مطالب وبلاگ</h3></div>
                <div>
                    <div class="styles__post___m5LVB general__clear___h0wo9 styles__col-3___IxFa0 grid__col-3___MVqHF">
                        <a href="#blog">
                            <div class="styles__image-wrapper___FFLoe"><div style="height:100%;background:#f4f5f8"></div></div>
                            <div class="styles__post-info___M9gb_"><h2>راهنمای انتخاب محصولات دیجیتال</h2><div class="styles__post-footer___ww8iU"><span class="styles__date___X59tF">راهنمای خرید</span></div></div>
                        </a>
                    </div>
                    <div class="styles__post___m5LVB general__clear___h0wo9 styles__col-3___IxFa0 grid__col-3___MVqHF">
                        <a href="#blog">
                            <div class="styles__image-wrapper___FFLoe"><div style="height:100%;background:#f4f5f8"></div></div>
                            <div class="styles__post-info___M9gb_"><h2>روش خرید و فعال‌سازی</h2><div class="styles__post-footer___ww8iU"><span class="styles__date___X59tF">راهنمای مشتریان</span></div></div>
                        </a>
                    </div>
                    <div class="styles__post___m5LVB general__clear___M75EP grid__col-3___MVqHF">
                        <a href="#blog">
                            <div class="styles__image-wrapper___FFLoe"><div style="height:100%;background:#f4f5f8"></div></div>
                            <div class="styles__post-info___M9gb_"><h2>پشتیبانی و پیگیری سفارش</h2><div class="styles__post-footer___ww8iU"><span class="styles__date___X59tF">پشتیبانی</span></div></div>
                        </a>
                    </div>
                </div>
            </div>

            <footer class="styles__footer___wx1OQ styles__simple-footer___z5Zz3">
                <div class="styles__inner___OdCLe">
                    <div class="styles__main___JA8EI styles__with-namad___eoUHP">
                        <div class="styles__contact-wrapper___ZzmSO">
                            <div class="styles__socials___CR3lk">
                                <ul><li class="styles__socials-item___XGYVt"><a href="#contact" class="styles__socials-icon___guEze">پشتیبانی</a></li></ul>
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
(()=> {
    const root=document.querySelector('[data-fara-slides]');
    if(!root)return;
    const slides=[...root.querySelectorAll('[data-fara-slide]')];
    if(slides.length<2)return;
    let i=0;
    const show=n=>{i=(n+slides.length)%slides.length;slides.forEach((s,j)=>s.style.display=j===i?'block':'none');};
    root.closest('.styles__slideshow')?.querySelector('[data-fara-prev]')?.addEventListener('click',()=>show(i-1));
    root.closest('.styles__slideshow')?.querySelector('[data-fara-next]')?.addEventListener('click',()=>show(i+1));
    setInterval(()=>show(i+1),6000);
})();
</script>
@endsection
