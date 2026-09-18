<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'NOVA SHOP') }}</title>
<meta name="description" content="فروشگاه آنلاین مدرن، سریع و ساده برای پیدا کردن محصولات منتخب.">
@vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<a class="skip-link" href="#main-content">پرش به محتوای اصلی</a>
<div class="topbar"><div class="container topbar-inner"><span>ارسال رایگان برای سفارش‌های بالای ۲ میلیون تومان</span><span><span class="topbar-accent">پرداخت امن</span> • پشتیبانی هر روز ۹ تا ۲۱</span></div></div>
<header class="navbar"><div class="container nav-inner">
<a class="brand" href="#home" aria-label="NOVA SHOP، صفحه اصلی"><span class="brand-mark" aria-hidden="true">N</span><span>NOVA SHOP</span></a>
<nav class="nav-links" aria-label="منوی اصلی"><a href="#home" aria-current="page">خانه</a><a href="#categories">دسته‌بندی‌ها</a><a href="#products">محصولات</a><a href="#services">مزایای خرید</a></nav>
<div class="actions"><button class="icon-btn" type="button" data-search aria-label="جستجوی محصول" title="جستجو"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg></button><div class="relative"><button class="icon-btn" type="button" data-cart-button aria-label="سبد خرید خالی" title="سبد خرید"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M6 8h12l1 12H5L6 8Z"/><path d="M9 8a3 3 0 0 1 6 0"/></svg></button><span class="cart-count" data-cart-count>۰</span></div></div>
</div></header>
<main id="main-content">
<section class="hero" id="home"><div class="container hero-shell"><div class="hero-grid">
<div class="hero-copy"><span class="eyebrow"><span class="eyebrow-dot" aria-hidden="true"></span>کالکشن جدید ۱۴۰۵</span><h1>خرید آنلاین، ساده‌تر از همیشه.</h1><p>محصولات منتخب روزمره، دیجیتال و سبک زندگی را با تجربه‌ای سریع، مرتب و بدون شلوغی پیدا کن.</p><div class="cta-row"><a class="btn btn-primary" href="#products">مشاهده محصولات</a><a class="btn btn-secondary" href="#categories">کشف دسته‌بندی‌ها</a></div><div class="hero-proof" aria-label="مزایای خرید"><span class="proof-item"><span class="check-icon" aria-hidden="true">✓</span><span><strong>ارسال سریع</strong><br>رهگیری آسان</span></span><span class="proof-item"><span class="check-icon" aria-hidden="true">✓</span><span><strong>پرداخت امن</strong><br>فرآیند شفاف</span></span><span class="proof-item"><span class="check-icon" aria-hidden="true">✓</span><span><strong>پشتیبانی</strong><br>پاسخ‌گویی واقعی</span></span></div></div>
<div class="hero-art" aria-label="پیش‌نمایش فروشگاه"><span class="blob blob-a" aria-hidden="true"></span><span class="blob blob-b" aria-hidden="true"></span><div class="device"><div class="device-screen"><div class="screen-header"><span class="screen-title">انتخاب‌های امروز</span><span class="screen-chip">پرفروش</span></div><div class="mock-products" aria-hidden="true"><div class="mock-card"><div class="mock-img"></div><div class="mock-line"></div><div class="mock-price"></div></div><div class="mock-card"><div class="mock-img"></div><div class="mock-line" style="width:70%"></div><div class="mock-price"></div></div><div class="mock-card"><div class="mock-img"></div><div class="mock-line" style="width:58%"></div><div class="mock-price"></div></div><div class="mock-card"><div class="mock-img"></div><div class="mock-line"></div><div class="mock-price"></div></div></div></div></div></div></div>
</div></section>
<section class="section" id="categories" aria-labelledby="categories-title"><div class="container"><div class="section-head"><div><h2 id="categories-title">دسته‌بندی‌های محبوب</h2><p>شروع خرید از جایی که بیشتر به کارت می‌آید.</p></div><a class="link-more" href="#products">مشاهده همه محصولات ←</a></div><div class="categories">
<a class="category" href="#products"><div class="category-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 6h16M4 12h16M4 18h10"/></svg></div><b>مد و پوشاک</b><span>۲۴۰ محصول</span></a>
<a class="category" href="#products"><div class="category-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="5" y="4" width="14" height="16" rx="2"/><path d="M9 8h6M9 12h6M9 16h3"/></svg></div><b>دیجیتال</b><span>۱۱۸ محصول</span></a>
<a class="category" href="#products"><div class="category-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 10h16v10H4zM7 10V6h10v4"/></svg></div><b>خانه و زندگی</b><span>۱۸۶ محصول</span></a>
<a class="category" href="#products"><div class="category-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="12" r="7"/><path d="M9 15c1-2 5-2 6 0M10 9h.01M14 9h.01"/></svg></div><b>زیبایی و سلامت</b><span>۹۴ محصول</span></a>
<a class="category" href="#products"><div class="category-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="m12 3 8 8-8 10-8-10 8-8Z"/><path d="m8 11 4 4 4-4"/></svg></div><b>لوازم کاربردی</b><span>۱۵۲ محصول</span></a>
</div></div></section>
<section class="section" id="products" aria-labelledby="products-title"><div class="container"><div class="section-head"><div><h2 id="products-title">محصولات منتخب</h2><p>محصولات محبوب این هفته را سریع پیدا و به سبد اضافه کن.</p></div><label class="search-box" aria-label="جستجوی محصولات"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg><input data-search-input type="search" autocomplete="off" placeholder="جستجوی محصول..." aria-label="جستجوی محصول"></label></div>
@php $products=[
['p1','هدفون بی‌سیم نویزکنسلینگ','صدای شفاف • باتری ۳۰ ساعت',3490000,3990000,'پرفروش'],
['p2','ساعت هوشمند مینیمال','نمایشگر AMOLED • ضدآب',2890000,3290000,'جدید'],
['p3','کوله‌پشتی شهری پریمیوم','پارچه مقاوم • لپ‌تاپ ۱۵ اینچ',1790000,2190000,'تخفیف'],
['p4','چراغ رومیزی هوشمند','نور قابل تنظیم • USB-C',1250000,1490000,'محبوب'],
['p5','کیف دستی روزمره','چرم گیاهی • طراحی سبک',1590000,1890000,'جدید'],
['p6','اسپیکر قابل حمل','صدای ۳۶۰ درجه • ۱۲ ساعت پخش',2190000,2490000,'پرفروش'],
['p7','کیبورد بی‌سیم کم‌حجم','اتصال چندگانه • تایپ نرم',1980000,2290000,'تخفیف'],
['p8','ماگ حرارتی استیل','نگهداری دما • درب ضدنشت',790000,950000,'محبوب']
]; @endphp
<div class="products">@foreach($products as $product)<article class="product" data-product><div class="product-media"><span class="product-badge">{{ $product[5] }}</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.1" aria-hidden="true"><rect x="5" y="5" width="14" height="14" rx="3"/><path d="M8 15l2.8-3.2 2.2 2.3 1.5-1.6L18 16M9 9h.01"/></svg></div><div class="product-body"><div class="rating" aria-label="امتیاز ۴.۸ از ۵">★★★★★ <span>۴.۸</span></div><h3>{{ $product[1] }}</h3><div class="product-meta">{{ $product[2] }}</div><div class="price-row"><div class="price">{{ number_format($product[3]) }} <span class="price-unit">تومان</span><span class="old-price">{{ number_format($product[4]) }}</span></div><button class="add-btn" type="button" data-add="{{ $product[0] }}" data-title="{{ $product[1] }}" data-price="{{ $product[3] }}" aria-label="افزودن {{ $product[1] }} به سبد خرید" title="افزودن به سبد خرید"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg></button></div></div></article>@endforeach</div>
<div class="empty-state" data-empty role="status">محصولی با این عبارت پیدا نشد. عبارت دیگری را امتحان کن.</div>
</div></section>
<section class="container promo" aria-labelledby="promo-title"><div class="promo-inner"><div><h3 id="promo-title">۱۰٪ تخفیف برای خرید اول</h3><p>کد تخفیف را هنگام پرداخت وارد کن و اولین سفارش را با قیمت بهتری ثبت کن.</p></div><div class="promo-code" aria-label="کد تخفیف">NOVAFIRST10</div></div></section>
<section class="section" id="services" aria-labelledby="services-title"><div class="container"><div class="section-head"><div><h2 id="services-title">چرا NOVA SHOP؟</h2><p>جزئیات مهم خرید را از همان ابتدا واضح می‌بینی.</p></div></div><div class="features">
<article class="feature"><div class="feature-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 7h11v10H3zM14 10h4l3 3v4h-7z"/><circle cx="7" cy="19" r="1.5"/><circle cx="18" cy="19" r="1.5"/></svg></div><div><h4>ارسال سریع</h4><p>سفارش‌ها با بسته‌بندی مرتب و رهگیری آسان ارسال می‌شوند.</p></div></article>
<article class="feature"><div class="feature-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="4" y="6" width="16" height="12" rx="2"/><path d="M4 10h16M8 14h3"/></svg></div><div><h4>پرداخت امن</h4><p>فرآیند پرداخت شفاف و ساده، آماده اتصال به درگاه واقعی.</p></div></article>
<article class="feature"><div class="feature-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M5 5h14v10H5z"/><path d="M8 20h8M12 15v5"/></svg></div><div><h4>پشتیبانی واقعی</h4><p>برای سوال‌های قبل و بعد از خرید، مسیر ارتباطی واضح داری.</p></div></article>
</div></div></section>
</main>
<footer class="footer"><div class="container footer-inner"><div><div class="footer-brand">NOVA SHOP</div><p>تجربه‌ای مدرن و مینیمال برای خرید روزمره؛ با تمرکز روی خوانایی، سرعت و اعتماد.</p></div><div><h4>دسترسی سریع</h4><a href="#home">خانه</a><br><a href="#categories">دسته‌بندی‌ها</a><br><a href="#products">محصولات</a></div><div><h4>راهنما</h4><a href="#services">مزایای خرید</a><br><a href="#services">پشتیبانی</a><br><a href="#services">شرایط ارسال</a></div><div><h4>سبد خرید</h4><p>تعداد اقلام: <strong data-cart-count>۰</strong></p><p>جمع فعلی: <strong data-cart-total>۰ تومان</strong></p></div></div><div class="container footer-bottom"><span>© ۱۴۰۵ NOVA SHOP</span><span>رابط کاربری فارسی و RTL</span></div></footer>
<div class="toast" data-toast role="status" aria-live="polite"></div>
</body>
</html>