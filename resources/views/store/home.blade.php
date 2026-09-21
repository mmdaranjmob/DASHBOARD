@extends('layouts.store')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fara-reference.css') }}">

<div class="fara-ref-home">
    <div class="fara-ref-notice">تحویل سریع محصولات با ضمانت فعال‌سازی و پشتیبانی</div>

    <header class="fara-ref-header">
        <div class="fara-ref-header-inner">
            <div class="styles__logo___ZvDUC" style="flex:0 0 auto">
                <a class="styles__logo-link___qW0ki" href="{{ route('home') }}" aria-label="{{ $siteName }}">
                    @if($logoUrl)
                        <img class="styles__logo-image___yxwdN" src="{{ $logoUrl }}" alt="{{ $siteName }}" width="144" height="70">
                    @else
                        <span class="fara-ref-brand-fallback">{{ $siteName }}</span>
                    @endif
                </a>
            </div>

            <div class="fara-ref-menu">
                <ul class="styles__row___Dmbry" style="list-style:none;margin:0;padding:0">
                    <li class="styles__item___H1l0S" style="list-style:none;padding:0 8px">
                        <a class="styles__link___BZhNG" href="{{ route('home') }}" style="color:#0c0c15">صفحه اصلی</a>
                    </li>
                    <li class="styles__item___H1l0S" style="list-style:none;padding:0 8px">
                        <em class="styles__link___BZhNG" style="font-style:normal;color:#0c0c15;cursor:pointer">محصولات</em>
                        <div class="fara-ref-custom-menu-panel">
                            @foreach($categories->take(18) as $category)
                                <a href="{{ route('products.index',['category'=>$category->slug]) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="styles__item___H1l0S" style="list-style:none;padding:0 8px">
                        <a class="styles__link___BZhNG" href="{{ route('products.index') }}" style="color:#0c0c15">همه محصولات</a>
                    </li>
                    <li class="styles__item___H1l0S" style="list-style:none;padding:0 8px">
                        <a class="styles__link___BZhNG" href="#about" style="color:#0c0c15">درباره ما</a>
                    </li>
                    <li class="styles__item___H1l0S" style="list-style:none;padding:0 8px">
                        <a class="styles__link___BZhNG" href="#contact" style="color:#0c0c15">ارتباط با ما</a>
                    </li>
                    <li class="styles__item___H1l0S" style="list-style:none;padding:0 8px">
                        <a class="styles__link___BZhNG" href="#blog" style="color:#0c0c15">وبلاگ</a>
                    </li>
                </ul>
            </div>

            <div class="fara-ref-left">
                <div class="styles__search-wrapper___W0qG5"><a href="{{ route('products.index') }}" aria-label="جستجو" style="color:#0c0c15"><span class="icons__icon-search___TM52S icons__icons___db6nw"></span></a></div>
                <div class="styles__mini-cart___zlB6M"><div class="styles__inner___uaLo_"><a class="styles__link___BlD5r" href="{{ route('cart.index') }}"><div class="styles__icon___hvMlb icons__icon-orders___OFYyQ icons__icons___db6nw"></div></a></div></div>
                @auth
                    <a href="{{ route('account.dashboard') }}" aria-label="حساب کاربری" style="display:inline-flex;align-items:center;gap:6px;color:#0c0c15">حساب</a>
                @else
                    <a href="{{ route('auth') }}" aria-label="ورود" style="display:inline-flex;align-items:center;gap:6px;color:#0c0c15">ورود</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        <div class="fara-ref-slides" data-fara-ref-slider>
            @forelse($bannerSlides as $i=>$slide)
                <a href="{{ $slide['link'] ?? '#' }}" class="fara-ref-slide-item {{ $i===0?'active':'' }}" data-fara-ref-slide>
                    <img src="{{ $slide['image'] }}" alt="اسلاید {{ $i+1 }}">
                </a>
            @empty
                <div class="fara-ref-slide-item active">
                    <div style="height:420px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;color:#7b8794">برای نمایش اسلایدر، از تنظیمات فروشگاه بنر اضافه کنید.</div>
                </div>
            @endforelse
            @if($bannerSlides->count()>1)
                <button class="fara-ref-slide-arrow right" type="button" data-fara-prev aria-label="اسلاید قبلی">‹</button>
                <button class="fara-ref-slide-arrow left" type="button" data-fara-next aria-label="اسلاید بعدی">›</button>
                <div class="fara-ref-slider-dots">
                    @foreach($bannerSlides as $i=>$slide)
                        <button class="fara-ref-slider-dot {{ $i===0?'active':'' }}" type="button" data-fara-dot="{{ $i }}" aria-label="اسلاید {{ $i+1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>

        @php
            $featured = $allActiveProducts->take(8);
            $bestsellers = $allActiveProducts->skip(8)->take(8);
        @endphp

        <section class="styles__wrapper___huewR">
            <div class="styles__inner___qADzf styles__theme-blackfriday___pkbNs">
                <div class="fara-ref-section-caption" style="color:#fff;margin:0 auto 12px">محصولات ویژه فروشگاه</div>
                <div class="embla-slider__embla___mm7vY styles__carousel___ILO8k">
                    <div class="embla-slider__embla__viewport___GE_Xf">
                        <div class="embla-slider__embla__container___L6RUa" style="display:flex;align-items:stretch">
                            <div class="embla-slider__embla__slide___tJdu0 styles__slideWrapper___dfFke" style="display:flex;flex:0 0 156px;align-items:center;justify-content:center">
                                <div class="styles__titleSection___wf4sb" style="display:flex">
                                    <strong style="font-size:18px">پیشنهاد ویژه</strong>
                                    <span style="font-size:11px;color:#fff">انتخاب‌های منتخب فروشگاه</span>
                                </div>
                            </div>
                            @foreach($featured as $product)
                                <div class="embla-slider__embla__slide___tJdu0 styles__slideWrapper___dfFke">
                                    @include('store.partials.fara-product-card',['product'=>$product])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="styles__slideshow-wrapper___xmI6t">
            <div class="styles__title-wrapper___gNRuL">
                <h3 class="styles__title___qH9Sq">محصولات پرفروش</h3>
            </div>
            <div class="styles__inner___RsF_J grid__container-12___Wvcgh grid__gap___KbmCT">
                @forelse($bestsellers as $product)
                    <div class="styles__product___tP7kV grid__span-3___lhPEi grid__span-small-6___jLYuH fara-ref-card">
                        @include('store.partials.fara-product-card',['product'=>$product])
                    </div>
                @empty
                    <div class="fara-ref-empty">هنوز محصول دیگری ثبت نشده است.</div>
                @endforelse
            </div>
        </section>

        @foreach($categoryProducts as $name=>$items)
            @php($category = $items->first()?->category)
            <section class="styles__slideshow-wrapper___xmI6t">
                <div class="styles__title-wrapper___gNRuL">
                    <h3 class="styles__title___qH9Sq">
                        @if($category)<a href="{{ route('products.index',['category'=>$category->slug]) }}">{{ $name }}</a>@else{{ $name }}@endif
                    </h3>
                </div>
                <div class="styles__sliders-content___AxHmi">
                    <div class="embla-slider__embla___mm7vY styles__carousel___LY9VQ">
                        <div class="embla-slider__embla__viewport___GE_Xf">
                            <div class="embla-slider__embla__container___L6RUa" style="display:flex">
                                @foreach($items->take(8) as $product)
                                    <div class="embla-slider__embla__slide___tJdu0 embla-slider__embla__slide-default-2___zqA7U embla-slider__embla__slide-md-3____elpr embla-slider__embla__slide-lg-4___SmZpw">
                                        @include('store.partials.fara-product-card',['product'=>$product])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div style="display:flex;justify-content:space-between;pointer-events:none">
                            <span class="styles__arrow-left___r4SrN styles__arrow-circle___A82Lf">‹</span>
                            <span class="styles__arrow-right___ptDyg styles__arrow-circle___A82Lf">›</span>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach

        <section class="styles__inner___VftlY" id="blog">
            <div class="styles__title-wrapper___gNRuL"><h3 class="styles__title___qH9Sq">مطالب وبلاگ</h3></div>
            <div>
                <article class="styles__post___m5LVB general__clear___h0wo9 styles__col-3___IxFa0 grid__col-3___MVqHF">
                    <a href="#blog"><div class="styles__image-wrapper___FFLoe"><div style="height:100%;background:linear-gradient(135deg,#eef0ff,#fafafa)"></div></div><div class="styles__post-info___M9gb_"><h2>راهنمای انتخاب و خرید محصولات دیجیتال</h2><div class="styles__post-footer___ww8iU"><span class="styles__date___X59tF">آخرین مطالب فروشگاه</span></div></div></a>
                </article>
                <article class="styles__post___m5LVB general__clear___h0wo9 styles__col-3___IxFa0 grid__col-3___MVqHF">
                    <a href="#blog"><div class="styles__image-wrapper___FFLoe"><div style="height:100%;background:linear-gradient(135deg,#eef0ff,#fafafa)"></div></div><div class="styles__post-info___M9gb_"><h2>چطور اشتراک مناسب را انتخاب کنیم؟</h2><div class="styles__post-footer___ww8iU"><span class="styles__date___X59tF">راهنمای خرید</span></div></div></a>
                </article>
                <article class="styles__post___m5LVB general__clear___h0wo9 styles__col-3___IxFa0 grid__col-3___MVqHF">
                    <a href="#blog"><div class="styles__image-wrapper___FFLoe"><div style="height:100%;background:linear-gradient(135deg,#eef0ff,#fafafa)"></div></div><div class="styles__post-info___M9gb_"><h2>پشتیبانی و پیگیری سفارش‌ها</h2><div class="styles__post-footer___ww8iU"><span class="styles__date___X59tF">پشتیبانی فروشگاه</span></div></div></a>
                </article>
            </div>
        </section>
    </main>

    <footer class="fara-ref-footer" id="contact">
        <div class="styles__inner___OdCLe">
            <div class="styles__main___JA8EI">
                <div class="styles__contact-wrapper___ZzmSO">
                    <div class="styles__copyright___uYXny">
                        <span>© {{ now()->year }} - تمامی حقوق این فروشگاه محفوظ است.</span>
                    </div>
                    <div class="styles__socials___CR3lk"><ul><li><a href="#" aria-label="پشتیبانی">پشتیبانی</a></li></ul></div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
(() => {
  const root=document.querySelector('[data-fara-ref-slider]');
  if(root){
    const slides=[...root.querySelectorAll('[data-fara-ref-slide]')];
    const dots=[...root.querySelectorAll('[data-fara-dot]')];
    let index=0;
    const show=n=>{
      if(!slides.length) return;
      index=(n+slides.length)%slides.length;
      slides.forEach((s,i)=>s.classList.toggle('active',i===index));
      dots.forEach((d,i)=>d.classList.toggle('active',i===index));
    };
    root.querySelector('[data-fara-prev]')?.addEventListener('click',()=>show(index-1));
    root.querySelector('[data-fara-next]')?.addEventListener('click',()=>show(index+1));
    dots.forEach((d,i)=>d.addEventListener('click',()=>show(i)));
    if(slides.length>1)setInterval(()=>show(index+1),6000);
  }
  document.querySelectorAll('.fara-ref-home .styles__wrapper___huewR .embla-slider__embla__container___L6RUa').forEach(row=>{
    row.style.overflowX='auto';
    row.style.scrollBehavior='smooth';
    row.style.scrollbarWidth='none';
  });
})();
</script>
@endsection
