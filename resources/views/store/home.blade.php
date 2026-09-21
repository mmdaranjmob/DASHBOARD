@extends('layouts.store')

@section('content')
<style>
    .fara-home{
        --fara-primary:#606cec;
        --fara-primary-dark:#4e5add;
        --fara-bg:#fff;
        --fara-ink:#0c0c15;
        --fara-muted:#6b7c93;
        --fara-light:#f1f3f5;
        --fara-soft:#f8f9fb;
        --fara-green:#3ecf8e;
        --fara-width:1200px;
        position:relative;
        width:100vw;
        margin-right:calc(50% - 50vw);
        margin-left:calc(50% - 50vw);
        background:#fff;
        color:var(--fara-ink);
        direction:rtl;
        font-family:Shabnam,IRANYekanX,IRANSans,Tahoma,sans-serif;
    }
    .fara-home *{box-sizing:border-box}
    .fara-home a{text-decoration:none;color:inherit}
    .fara-wrap{width:min(var(--fara-width),92%);margin:0 auto}
    .fara-notice{height:38px;background:var(--fara-primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600}
    .fara-header{height:88px;background:#fff;border-bottom:1px solid #eceef2;position:sticky;top:0;z-index:90}
    .fara-header-inner{height:88px;display:grid;grid-template-columns:150px minmax(0,1fr) 265px;align-items:center;gap:22px}
    .fara-logo{display:flex;align-items:center;min-width:0}
    .fara-logo img{display:block;max-width:144px;max-height:70px;width:auto;height:auto;object-fit:contain}
    .fara-logo-fallback{font-weight:900;font-size:19px;color:var(--fara-ink);display:flex;gap:9px;align-items:center}
    .fara-logo-fallback b{width:34px;height:34px;border-radius:10px;background:var(--fara-primary);color:#fff;display:grid;place-items:center}
    .fara-nav{display:flex;align-items:center;justify-content:center;gap:3px}
    .fara-nav>a,.fara-drop>button{border:0;background:transparent;padding:13px 14px;border-radius:8px;font-size:14px;color:#394457;cursor:pointer}
    .fara-nav>a:hover,.fara-drop:hover>button,.fara-nav>a.active{background:#f3f4ff;color:var(--fara-primary)}
    .fara-drop{position:relative}
    .fara-drop-panel{position:absolute;right:0;top:48px;width:360px;padding:17px;background:#fff;border:1px solid #eceef2;border-radius:10px;box-shadow:0 15px 45px rgba(24,33,56,.13);display:none;grid-template-columns:1fr 1fr;gap:8px;z-index:20}
    .fara-drop:hover .fara-drop-panel{display:grid}
    .fara-drop-panel a{padding:9px 10px;border-radius:7px;color:#6b7c93;font-size:12px;line-height:1.6}
    .fara-drop-panel a:hover{background:#f5f6ff;color:var(--fara-primary)}
    .fara-actions{display:flex;justify-content:flex-start;align-items:center;gap:8px}
    .fara-action{height:40px;min-width:40px;border:1px solid #e3e6eb;background:#fff;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;gap:6px;font-size:12px;color:#424b59;padding:0 11px}
    .fara-action:hover{border-color:#cfd4ff;color:var(--fara-primary)}
    .fara-action.primary{background:var(--fara-primary);color:#fff;border-color:var(--fara-primary)}
    .fara-main{padding:0 0 65px}
    .fara-hero{padding:26px 0 0}
    .fara-hero-shell{position:relative;overflow:hidden;border-radius:10px;background:#f3f5f8;box-shadow:0 10px 35px rgba(30,41,59,.08)}
    .fara-hero-slide{display:block;position:relative;aspect-ratio:1200/420;min-height:250px}
    .fara-hero-slide img{display:block;width:100%;height:100%;object-fit:cover}
    .fara-hero-placeholder{height:100%;min-height:250px;display:flex;align-items:center;justify-content:center;text-align:center;color:#7d8796;background:linear-gradient(110deg,#eef1ff,#fafafa);font-size:15px}
    .fara-hero-arrow{position:absolute;top:50%;transform:translateY(-50%);width:45px;height:45px;border:0;border-radius:50%;background:#fff;color:#343d4d;box-shadow:0 8px 25px rgba(15,23,42,.14);font-size:20px;cursor:pointer;z-index:3}
    .fara-hero-prev{right:18px}.fara-hero-next{left:18px}
    .fara-dots{position:absolute;left:50%;bottom:16px;transform:translateX(-50%);display:flex;gap:6px;z-index:4}
    .fara-dot{width:8px;height:8px;border:0;padding:0;border-radius:50%;background:#fff8;cursor:pointer}.fara-dot.active{background:var(--fara-primary)}
    .fara-section{padding:52px 0 0}
    .fara-section-title{display:flex;align-items:flex-end;justify-content:space-between;gap:15px;margin-bottom:25px}
    .fara-section-title h2{margin:0;font-size:22px;font-weight:800;line-height:1.5}
    .fara-section-title p{margin:5px 0 0;color:var(--fara-muted);font-size:12px}
    .fara-see-all{color:var(--fara-primary);font-size:12px;font-weight:700}
    .fara-category-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:12px}
    .fara-category{min-height:95px;border:1px solid #eceff3;border-radius:10px;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;transition:.2s}
    .fara-category:hover{border-color:#cfd3ff;transform:translateY(-3px);box-shadow:0 10px 26px rgba(52,64,102,.08)}
    .fara-category-icon{width:44px;height:44px;border-radius:50%;display:grid;place-items:center;background:#f3f4ff;color:var(--fara-primary);font-size:18px}
    .fara-category strong{font-size:11px;color:#4b5563}
    .fara-promo{background:#0c0c15;color:#fff;border-radius:10px;padding:24px;overflow:hidden}
    .fara-promo-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
    .fara-promo-head h2{margin:0;font-size:19px}
    .fara-promo-head span{font-size:11px;color:#bcc3d2}
    .fara-product-row{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px}
    .fara-promo .fara-card{background:#fff}
    .fara-card{position:relative;background:#fff;border:1px solid #ebedf1;border-radius:9px;overflow:hidden;transition:.2s}
    .fara-card:hover{transform:translateY(-4px);box-shadow:0 14px 35px rgba(27,39,74,.11)}
    .fara-card-media{height:190px;background:#f7f8fa;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative}
    .fara-card-media img{width:100%;height:100%;object-fit:contain}
    .fara-card-badge{position:absolute;top:10px;right:10px;padding:5px 8px;border-radius:999px;background:#fff;color:var(--fara-primary);font-size:10px;font-weight:800;box-shadow:0 4px 12px rgba(0,0,0,.08)}
    .fara-card-body{padding:14px}
    .fara-card-category{font-size:10px;color:var(--fara-primary);margin-bottom:5px}
    .fara-card h3{font-size:13px;line-height:1.8;margin:0;height:48px;overflow:hidden;color:#252c37;font-weight:800}
    .fara-card-desc{font-size:10px;line-height:1.8;color:#8a95a3;height:36px;overflow:hidden;margin:6px 0 10px}
    .fara-card-bottom{display:flex;align-items:center;justify-content:space-between;gap:10px}
    .fara-price{font-size:12px;font-weight:900;color:#202631}
    .fara-price small{font-size:9px;color:#8b95a2;font-weight:500}
    .fara-buy{height:34px;min-width:34px;border-radius:8px;background:#f2f3ff;color:var(--fara-primary);display:inline-flex;align-items:center;justify-content:center;font-size:15px}
    .fara-buy:hover{background:var(--fara-primary);color:#fff}
    .fara-products-title{margin-top:48px}
    .fara-feature-strip{display:grid;grid-template-columns:repeat(4,1fr);gap:12px}
    .fara-feature{border-top:1px solid #eceff3;border-bottom:1px solid #eceff3;padding:18px 10px;display:flex;gap:12px;align-items:center}
    .fara-feature-icon{width:43px;height:43px;flex:0 0 auto;border-radius:50%;background:#f1f3f5;color:var(--fara-primary);display:grid;place-items:center;font-size:18px}
    .fara-feature b{display:block;font-size:11px;margin-bottom:4px}.fara-feature span{font-size:9px;color:#8490a0;line-height:1.8}
    .fara-blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
    .fara-blog{border:1px solid #ebedf1;border-radius:9px;overflow:hidden;background:#fff}
    .fara-blog-cover{height:185px;background:linear-gradient(135deg,#eef0ff,#fafafa);display:grid;place-items:center;color:#818b9a;font-size:12px}
    .fara-blog-body{padding:17px}.fara-blog-body h3{margin:0;font-size:14px;line-height:1.7}.fara-blog-body p{margin:9px 0 0;color:#7b8795;font-size:10px;line-height:1.9}
    .fara-footer{background:#0c0c15;color:#fff;margin-top:65px}
    .fara-footer-main{padding:46px 0 42px;display:grid;grid-template-columns:1.35fr 1fr 1fr 1fr;gap:30px}
    .fara-footer h3{margin:0 0 15px;font-size:13px}.fara-footer p,.fara-footer a{font-size:10px;color:#c4cad4;line-height:2.2;margin:0}.fara-footer a:hover{color:#fff}
    .fara-footer-brand{font-size:20px;font-weight:900}.fara-footer-brand span{color:var(--fara-primary)}
    .fara-footer-bottom{background:#171723;padding:17px;text-align:center;color:#aeb6c4;font-size:9px}
    @media(max-width:1050px){
        .fara-header-inner{grid-template-columns:130px 1fr 210px}
        .fara-nav>a,.fara-drop>button{padding-inline:9px;font-size:12px}
        .fara-category-grid{grid-template-columns:repeat(3,1fr)}
        .fara-product-row{grid-template-columns:repeat(3,1fr)}
        .fara-product-row .fara-card:nth-child(4){display:none}
        .fara-feature-strip{grid-template-columns:repeat(2,1fr)}
    }
    @media(max-width:760px){
        .fara-notice{height:34px;font-size:10px;padding:0 10px;text-align:center}
        .fara-header,.fara-header-inner{height:68px}
        .fara-header-inner{grid-template-columns:1fr auto}
        .fara-nav{display:none}
        .fara-actions{justify-content:flex-start}.fara-action span{display:none}.fara-action{padding:0 10px}
        .fara-wrap{width:calc(100% - 24px)}
        .fara-hero{padding-top:14px}.fara-hero-slide{min-height:175px}
        .fara-section{padding-top:34px}.fara-section-title h2{font-size:18px}
        .fara-category-grid{grid-template-columns:repeat(2,1fr)}
        .fara-promo{padding:16px}.fara-product-row{display:flex;overflow:auto;scroll-snap-type:x mandatory;padding-bottom:3px}
        .fara-product-row .fara-card,.fara-promo .fara-card{min-width:245px;scroll-snap-align:start}
        .fara-product-row .fara-card:nth-child(4){display:block}
        .fara-feature-strip,.fara-blog-grid,.fara-footer-main{grid-template-columns:1fr}
        .fara-blog-cover{height:155px}
    }
</style>

<div class="fara-home">
    <div class="fara-notice">تحویل سریع اشتراک‌های بین‌المللی با ضمانت فعال‌سازی و پشتیبانی</div>

    <header class="fara-header">
        <div class="fara-wrap fara-header-inner">
            <a class="fara-logo" href="{{ route('home') }}">
                @if(!empty($logoUrl))
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}">
                @else
                    <span class="fara-logo-fallback"><b>{{ mb_substr($siteName,0,1) }}</b><span>{{ $siteName }}</span></span>
                @endif
            </a>

            <nav class="fara-nav" aria-label="منوی اصلی">
                <a class="active" href="{{ route('home') }}">صفحه اصلی</a>
                <div class="fara-drop">
                    <button type="button">محصولات⌄</button>
                    <div class="fara-drop-panel">
                        @foreach($categories->take(12) as $category)
                            <a href="{{ route('products.index',['category'=>$category->slug]) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('products.index') }}">همه محصولات</a>
                <a href="#about">درباره ما</a>
                <a href="#contact">ارتباط با ما</a>
                <a href="#blog">وبلاگ</a>
            </nav>

            <div class="fara-actions">
                <a class="fara-action" href="{{ route('products.index') }}" title="جستجو">⌕<span>جستجو</span></a>
                <a class="fara-action" href="{{ route('cart.index') }}" title="سبد خرید">🛒<span>سبد</span>@if(session('cart'))<b>{{ collect(session('cart'))->sum('quantity') }}</b>@endif</a>
                @auth
                    <a class="fara-action primary" href="{{ route('account.dashboard') }}">حساب</a>
                @else
                    <a class="fara-action primary" href="{{ route('auth') }}">ورود</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="fara-main">
        <section class="fara-hero fara-wrap">
            <div class="fara-hero-shell" data-fara-slider>
                @if($bannerSlides->isNotEmpty())
                    @foreach($bannerSlides as $i=>$slide)
                        <a class="fara-hero-slide" data-fara-slide href="{{ $slide['link'] ?? '#' }}" style="display:{{ $i===0 ? 'block':'none' }}">
                            <img src="{{ $slide['image'] }}" alt="بنر فروشگاه {{ $siteName }}">
                        </a>
                    @endforeach
                    @if($bannerSlides->count()>1)
                        <button class="fara-hero-arrow fara-hero-prev" type="button" aria-label="قبلی">›</button>
                        <button class="fara-hero-arrow fara-hero-next" type="button" aria-label="بعدی">‹</button>
                        <div class="fara-dots">
                            @foreach($bannerSlides as $i=>$slide)
                                <button class="fara-dot {{ $i===0?'active':'' }}" type="button" data-fara-dot="{{ $i }}" aria-label="اسلاید {{ $i+1 }}"></button>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="fara-hero-placeholder">برای نمایش اسلاید اصلی، از بخش «تنظیمات فروشگاه» بنر اضافه کنید.</div>
                @endif
            </div>
        </section>

        <section class="fara-section fara-wrap">
            <div class="fara-section-title">
                <div>
                    <h2>دسته‌بندی محصولات</h2>
                    <p>تمام سرویس‌های فروشگاه را سریع و ساده پیدا کن.</p>
                </div>
                <a class="fara-see-all" href="{{ route('products.index') }}">مشاهده همه ←</a>
            </div>
            <div class="fara-category-grid">
                @forelse($categories->take(12) as $category)
                    <a class="fara-category" href="{{ route('products.index',['category'=>$category->slug]) }}">
                        <span class="fara-category-icon">✦</span>
                        <strong>{{ $category->name }}</strong>
                    </a>
                @empty
                    <div class="fara-category">هنوز دسته‌بندی فعالی ثبت نشده است.</div>
                @endforelse
            </div>
        </section>

        <section class="fara-section fara-wrap">
            <div class="fara-promo">
                <div class="fara-promo-head">
                    <div>
                        <h2>محصولات ویژه</h2>
                        <span>انتخابی از سرویس‌های فعال فروشگاه</span>
                    </div>
                    <a class="fara-see-all" style="color:#fff" href="{{ route('products.index') }}">مشاهده همه ←</a>
                </div>
                <div class="fara-product-row">
                    @forelse($allActiveProducts->take(4) as $product)
                        <a class="fara-card" href="{{ route('product.show',$product) }}">
                            <div class="fara-card-media">
                                @if($product->image)<img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">@else<span style="font-size:42px;color:#c5cad3">✦</span>@endif
                                <span class="fara-card-badge">ویژه</span>
                            </div>
                            <div class="fara-card-body">
                                <div class="fara-card-category">{{ $product->category?->name ?: 'محصول دیجیتال' }}</div>
                                <h3>{{ $product->name }}</h3>
                                <div class="fara-card-bottom">
                                    <div class="fara-price">{{ number_format($product->price) }} <small>{{ $product->currency==='IRR'?'تومان':$product->currency }}</small></div>
                                    <span class="fara-buy">🛒</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div style="padding:35px;color:#c4cad4">هنوز محصول فعالی ثبت نشده است.</div>
                    @endforelse
                </div>
            </div>
        </section>

        @foreach($categoryProducts as $name=>$items)
            @php($category = $items->first()?->category)
            <section class="fara-section fara-wrap">
                <div class="fara-section-title">
                    <div>
                        <h2>{{ $name }}</h2>
                        <p>محصولات این دسته را ببین و برای خرید انتخاب کن.</p>
                    </div>
                    @if($category)
                        <a class="fara-see-all" href="{{ route('products.index',['category'=>$category->slug]) }}">مشاهده همه ←</a>
                    @endif
                </div>
                <div class="fara-product-row">
                    @foreach($items->take(4) as $product)
                        <a class="fara-card" href="{{ route('product.show',$product) }}">
                            <div class="fara-card-media">
                                @if($product->image)<img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">@else<span style="font-size:42px;color:#c5cad3">✦</span>@endif
                            </div>
                            <div class="fara-card-body">
                                <div class="fara-card-category">{{ $name }}</div>
                                <h3>{{ $product->name }}</h3>
                                <p class="fara-card-desc">{{ $product->description ?: 'خدمات و محصول دیجیتال با تحویل سریع و پشتیبانی.' }}</p>
                                <div class="fara-card-bottom">
                                    <div class="fara-price">{{ number_format($product->price) }} <small>{{ $product->currency==='IRR'?'تومان':$product->currency }}</small></div>
                                    <span class="fara-buy">🛒</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach

        <section class="fara-section fara-wrap" id="about">
            <div class="fara-feature-strip">
                <div class="fara-feature"><span class="fara-feature-icon">✓</span><div><b>تحویل سریع</b><span>سفارش‌ها با سرعت بالا پردازش و تحویل می‌شوند.</span></div></div>
                <div class="fara-feature"><span class="fara-feature-icon">◈</span><div><b>پرداخت امن</b><span>پرداخت و کیف پول داخل حساب کاربری انجام می‌شود.</span></div></div>
                <div class="fara-feature"><span class="fara-feature-icon">♧</span><div><b>پشتیبانی</b><span>برای پیگیری سفارش و سوالاتت از پشتیبانی استفاده کن.</span></div></div>
                <div class="fara-feature"><span class="fara-feature-icon">★</span><div><b>محصولات متنوع</b><span>دسته‌بندی‌های فروشگاه قابل مدیریت از پنل ادمین هستند.</span></div></div>
            </div>
        </section>

        <section class="fara-section fara-wrap" id="blog">
            <div class="fara-section-title">
                <div><h2>آخرین مطالب</h2><p>بخش وبلاگ با ظاهر مشابه فروشگاه مرجع.</p></div>
                <a class="fara-see-all" href="#">مشاهده همه ←</a>
            </div>
            <div class="fara-blog-grid">
                <article class="fara-blog"><div class="fara-blog-cover">تصویر مطلب</div><div class="fara-blog-body"><h3>راهنمای انتخاب اشتراک مناسب</h3><p>در این بخش می‌توانی آموزش‌ها و مقالات فروشگاه را نمایش بدهی.</p></div></article>
                <article class="fara-blog"><div class="fara-blog-cover">تصویر مطلب</div><div class="fara-blog-body"><h3>روش خرید و فعال‌سازی خدمات</h3><p>ساختار این قسمت آماده اتصال به سیستم واقعی وبلاگ است.</p></div></article>
                <article class="fara-blog"><div class="fara-blog-cover">تصویر مطلب</div><div class="fara-blog-body"><h3>پرسش‌های متداول مشتریان</h3><p>محتوای این بخش را هم می‌توان بعداً از پنل مدیریت کنترل کرد.</p></div></article>
            </div>
        </section>
    </main>

    <footer class="fara-footer" id="contact">
        <div class="fara-wrap fara-footer-main">
            <div>
                <div class="fara-footer-brand">{{ $siteName }}<span>.</span></div>
                <p style="margin-top:12px">فروش و تحویل محصولات و سرویس‌های دیجیتال با پشتیبانی.</p>
            </div>
            <div>
                <h3>دسترسی سریع</h3>
                <a href="{{ route('home') }}">صفحه اصلی</a>
                <a href="{{ route('products.index') }}">محصولات</a>
                <a href="{{ route('cart.index') }}">سبد خرید</a>
            </div>
            <div>
                <h3>حساب کاربری</h3>
                @auth
                    <a href="{{ route('account.dashboard') }}">حساب من</a>
                    <a href="{{ route('account.orders') }}">سفارش‌های من</a>
                    <a href="{{ route('account.tickets') }}">پشتیبانی</a>
                @else
                    <a href="{{ route('auth') }}">ورود / ثبت‌نام</a>
                @endauth
            </div>
            <div>
                <h3>ارتباط با ما</h3>
                @if($supportUrl)<a href="{{ $supportUrl }}">{{ $supportUrl }}</a>@else<a href="#contact">پشتیبانی آنلاین</a>@endif
                <p style="margin-top:8px">پاسخ‌گویی و پیگیری سفارش از حساب کاربری.</p>
            </div>
        </div>
        <div class="fara-footer-bottom">© {{ now()->year }} {{ $siteName }} — تمامی حقوق محفوظ است.</div>
    </footer>
</div>

<script>
(() => {
    const root = document.querySelector('[data-fara-slider]');
    if (!root) return;
    const slides = [...root.querySelectorAll('[data-fara-slide]')];
    const dots = [...root.querySelectorAll('[data-fara-dot]')];
    if (slides.length < 2) return;
    let index = 0;
    const show = (n) => {
        index = (n + slides.length) % slides.length;
        slides.forEach((el, i) => el.style.display = i === index ? 'block' : 'none');
        dots.forEach((el, i) => el.classList.toggle('active', i === index));
    };
    root.querySelector('.fara-hero-prev')?.addEventListener('click', () => show(index + 1));
    root.querySelector('.fara-hero-next')?.addEventListener('click', () => show(index - 1));
    dots.forEach(dot => dot.addEventListener('click', () => show(Number(dot.dataset.faraDot))));
    setInterval(() => show(index + 1), 5500);
})();
</script>
@endsection
