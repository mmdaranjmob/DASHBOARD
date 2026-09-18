<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="NOVA SHOP؛ فروشگاهی مدرن برای خرید سریع و ساده محصولات منتخب.">
    <title>{{ config('app.name', 'NOVA SHOP') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#main-content">رفتن به محتوای اصلی</a>

    <div class="topbar">
        <div class="container topbar-inner">
            <span class="topbar-item">
                <span class="topbar-dot" aria-hidden="true"></span>
                ارسال رایگان برای سفارش‌های بالای ۲ میلیون تومان
            </span>
            <div class="topbar-meta">
                <span>پشتیبانی ۹ تا ۲۱</span>
                <span aria-hidden="true">•</span>
                <span>پرداخت امن و سریع</span>
            </div>
        </div>
    </div>

    <header class="navbar" data-header>
        <div class="container nav-inner">
            <a class="brand" href="#home" aria-label="NOVA SHOP، صفحه اصلی">
                <span class="brand-mark" aria-hidden="true">N</span>
                <span class="brand-copy">
                    <strong>NOVA SHOP</strong>
                    <small>shopping, made simple</small>
                </span>
            </a>

            <nav class="nav-links" aria-label="منوی اصلی">
                <a class="active" href="#home">خانه</a>
                <a href="#categories">دسته‌بندی‌ها</a>
                <a href="#products">محصولات</a>
                <a href="#services">مزایای خرید</a>
            </nav>

            <div class="actions">
                <button class="icon-btn" type="button" data-search aria-label="رفتن به جستجوی محصولات">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-4-4"></path></svg>
                </button>

                <button class="cart-trigger" type="button" data-cart-trigger aria-label="سبد خرید">
                    <span class="cart-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M6 8h12l1 12H5L6 8Z"></path><path d="M9 8a3 3 0 0 1 6 0"></path></svg>
                    </span>
                    <span>سبد خرید</span>
                    <span class="cart-count" data-cart-count aria-label="تعداد اقلام">۰</span>
                </button>
            </div>
        </div>
    </header>

    <main id="main-content">
        <section class="hero" id="home">
            <div class="container hero-shell">
                <div class="hero-glow hero-glow-one" aria-hidden="true"></div>
                <div class="hero-glow hero-glow-two" aria-hidden="true"></div>

                <div class="hero-grid">
                    <div class="hero-copy reveal">
                        <span class="eyebrow">
                            <span class="eyebrow-mark" aria-hidden="true">✦</span>
                            انتخاب‌های تازه برای ۱۴۰۵
                        </span>

                        <h1>
                            خریدی که
                            <span>ساده‌تر</span>
                            و شیک‌تر از همیشه است.
                        </h1>

                        <p>
                            محصولات منتخب روزمره، دیجیتال و سبک زندگی را با تجربه‌ای سریع،
                            مرتب و بدون حواس‌پرتی پیدا کن؛ از کشف محصول تا اضافه‌کردن به سبد.
                        </p>

                        <div class="cta-row">
                            <a class="btn btn-primary" href="#products">
                                شروع خرید
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M19 12H5"></path><path d="m11 18-6-6 6-6"></path></svg>
                            </a>
                            <a class="btn btn-secondary" href="#categories">
                                کشف دسته‌بندی‌ها
                            </a>
                        </div>

                        <div class="hero-trust">
                            <span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 4 4L19 6"></path></svg> پرداخت امن</span>
                            <span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 7h11v10H3z"></path><path d="M14 10h4l3 3v4h-7z"></path><circle cx="7" cy="18" r="1.5"></circle><circle cx="18" cy="18" r="1.5"></circle></svg> ارسال رهگیری‌شده</span>
                            <span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7v5h5"></path><path d="M20 17v-5h-5"></path><path d="M5 12a7 7 0 0 0 12 4"></path><path d="M19 12a7 7 0 0 0-12-4"></path></svg> ۷ روز بازگشت</span>
                        </div>
                    </div>

                    <div class="hero-visual reveal" aria-label="پیش‌نمایش محصولات منتخب">
                        <div class="visual-orbit visual-orbit-a" aria-hidden="true"></div>
                        <div class="visual-orbit visual-orbit-b" aria-hidden="true"></div>

                        <div class="product-stack">
                            <article class="float-card float-card-back">
                                <div class="mini-media mini-media-orange"></div>
                                <div>
                                    <strong>نسخه‌ی جدید</strong>
                                    <span>هفته‌ی فروش</span>
                                </div>
                            </article>

                            <article class="showcase-device">
                                <div class="showcase-top">
                                    <div class="showcase-brand">
                                        <span class="tiny-mark" aria-hidden="true">N</span>
                                        <span>NOVA</span>
                                    </div>
                                    <span class="showcase-chip">منتخب</span>
                                </div>

                                <div class="showcase-main">
                                    <div class="showcase-product-art" aria-hidden="true">
                                        <span class="product-ring"></span>
                                        <span class="product-orb"></span>
                                        <span class="product-shadow"></span>
                                    </div>

                                    <div class="showcase-info">
                                        <span class="showcase-kicker">پرفروش این هفته</span>
                                        <strong>هدفون بی‌سیم نویزکنسلینگ</strong>
                                        <span class="showcase-rating">
                                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 3 2.7 5.5 6.1.9-4.4 4.3 1 6.1-5.4-2.9-5.4 2.9 1-6.1L3.2 9.4l6.1-.9L12 3Z"></path></svg>
                                            ۴.۸ از ۵
                                        </span>
                                    </div>

                                    <div class="showcase-price">
                                        <span>۳٬۴۹۰٬۰۰۰</span>
                                        <small>تومان</small>
                                    </div>
                                </div>
                            </article>

                            <article class="float-card float-card-front">
                                <div class="mini-check" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="m6 12 4 4 8-9"></path></svg>
                                </div>
                                <div>
                                    <strong>سبد خرید آماده</strong>
                                    <span>سریع و ساده</span>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-tight" id="categories">
            <div class="container">
                <div class="section-head reveal">
                    <div>
                        <span class="section-eyebrow">دسته‌بندی‌ها</span>
                        <h2>از همین‌جا شروع کن</h2>
                        <p>دسته موردنظرت را انتخاب کن و سریع‌تر به محصول مناسب برس.</p>
                    </div>
                    <a class="text-link" href="#products">مشاهده همه <span aria-hidden="true">←</span></a>
                </div>

                <div class="category-grid">
                    <a class="category-card category-card-wide reveal" href="#products" data-category="مد و پوشاک">
                        <span class="category-number">۰۱</span>
                        <span class="category-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m7 5 2-2h6l2 2 3 2-3 6v8H7v-8L4 7l3-2Z"></path><path d="M9 3c.4 2 1.4 3 3 3s2.6-1 3-3"></path></svg>
                        </span>
                        <div>
                            <strong>مد و پوشاک</strong>
                            <span>۲۴۰ محصول</span>
                        </div>
                        <span class="category-arrow" aria-hidden="true">↗</span>
                    </a>

                    <a class="category-card reveal" href="#products" data-category="دیجیتال">
                        <span class="category-number">۰۲</span>
                        <span class="category-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="5" width="16" height="14" rx="2"></rect><path d="M9 9h6M8 14h8"></path></svg>
                        </span>
                        <div>
                            <strong>دیجیتال</strong>
                            <span>۱۱۸ محصول</span>
                        </div>
                        <span class="category-arrow" aria-hidden="true">↗</span>
                    </a>

                    <a class="category-card reveal" href="#products" data-category="خانه و زندگی">
                        <span class="category-number">۰۳</span>
                        <span class="category-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m4 11 8-7 8 7"></path><path d="M6 10v9h12v-9"></path><path d="M10 19v-5h4v5"></path></svg>
                        </span>
                        <div>
                            <strong>خانه و زندگی</strong>
                            <span>۱۸۶ محصول</span>
                        </div>
                        <span class="category-arrow" aria-hidden="true">↗</span>
                    </a>

                    <a class="category-card reveal" href="#products" data-category="زیبایی و سلامت">
                        <span class="category-number">۰۴</span>
                        <span class="category-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20s-7-4.4-7-10A4 4 0 0 1 12 8a4 4 0 0 1 7 2c0 5.6-7 10-7 10Z"></path><path d="M8.5 12h7"></path><path d="M12 8.5v7"></path></svg>
                        </span>
                        <div>
                            <strong>زیبایی و سلامت</strong>
                            <span>۹۴ محصول</span>
                        </div>
                        <span class="category-arrow" aria-hidden="true">↗</span>
                    </a>

                    <a class="category-card reveal" href="#products" data-category="لوازم کاربردی">
                        <span class="category-number">۰۵</span>
                        <span class="category-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 5h14v14H5z"></path><path d="M8 12h8M12 8v8"></path></svg>
                        </span>
                        <div>
                            <strong>لوازم کاربردی</strong>
                            <span>۱۵۲ محصول</span>
                        </div>
                        <span class="category-arrow" aria-hidden="true">↗</span>
                    </a>
                </div>
            </div>
        </section>

        <section class="section" id="products">
            <div class="container">
                <div class="section-head products-head reveal">
                    <div>
                        <span class="section-eyebrow">انتخاب سردبیر</span>
                        <h2>محصولات منتخب</h2>
                        <p>ویترین تازه‌ی این هفته، با تمرکز روی کاربرد و ارزش خرید.</p>
                    </div>

                    <div class="search-shell">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-4-4"></path></svg>
                        <label class="sr-only" for="product-search">جستجوی محصول</label>
                        <input id="product-search" data-search-input type="search" autocomplete="off" placeholder="نام محصول را جستجو کن...">
                        <button class="search-clear" type="button" data-search-clear aria-label="پاک کردن جستجو" hidden>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m7 7 10 10M17 7 7 17"></path></svg>
                        </button>
                    </div>
                </div>

                @php
                    $products = [
                        ['p1','هدفون بی‌سیم نویزکنسلینگ','صدای شفاف • باتری ۳۰ ساعت',3490000,3990000,'پرفروش','دیجیتال'],
                        ['p2','ساعت هوشمند مینیمال','نمایشگر AMOLED • ضدآب',2890000,3290000,'جدید','دیجیتال'],
                        ['p3','کوله‌پشتی شهری پریمیوم','پارچه مقاوم • لپ‌تاپ ۱۵ اینچ',1790000,2190000,'تخفیف','مد و پوشاک'],
                        ['p4','چراغ رومیزی هوشمند','نور قابل تنظیم • USB-C',1250000,1490000,'محبوب','خانه و زندگی'],
                        ['p5','کیف دستی روزمره','چرم گیاهی • طراحی سبک',1590000,1890000,'جدید','مد و پوشاک'],
                        ['p6','اسپیکر قابل حمل','صدای ۳۶۰ درجه • ۱۲ ساعت پخش',2190000,2490000,'پرفروش','دیجیتال'],
                        ['p7','کیبورد بی‌سیم کم‌حجم','اتصال چندگانه • تایپ نرم',1980000,2290000,'تخفیف','دیجیتال'],
                        ['p8','ماگ حرارتی استیل','نگهداری دما • درب ضدنشت',790000,950000,'محبوب','خانه و زندگی'],
                    ];
                @endphp

                <div class="products" data-products>
                    @foreach($products as $product)
                        @php $discount = max(0, round((1 - ($product[3] / $product[4])) * 100)); @endphp
                        <article class="product-card reveal" data-product data-product-category="{{ $product[6] }}">
                            <div class="product-media">
                                <span class="product-badge badge-{{ $product[5] === 'تخفیف' ? 'accent' : 'brand' }}">{{ $product[5] }}</span>
                                @if($discount > 0)
                                    <span class="discount-badge">٪{{ $discount }}-</span>
                                @endif

                                <div class="product-art product-art-{{ $loop->iteration }}" aria-hidden="true">
                                    <span class="art-shadow"></span>
                                    <span class="art-shape art-shape-main"></span>
                                    <span class="art-shape art-shape-small"></span>
                                    <span class="art-line"></span>
                                </div>

                                <button
                                    class="quick-add"
                                    type="button"
                                    data-add="{{ $product[0] }}"
                                    data-title="{{ $product[1] }}"
                                    data-price="{{ $product[3] }}"
                                    aria-label="افزودن {{ $product[1] }} به سبد خرید"
                                >
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>
                                    افزودن
                                </button>
                            </div>

                            <div class="product-body">
                                <div class="product-topline">
                                    <span class="product-category">{{ $product[6] }}</span>
                                    <span class="rating">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 3 2.7 5.5 6.1.9-4.4 4.3 1 6.1-5.4-2.9-5.4 2.9 1-6.1L3.2 9.4l6.1-.9L12 3Z"></path></svg>
                                        ۴.۸
                                    </span>
                                </div>

                                <h3>{{ $product[1] }}</h3>
                                <p>{{ $product[2] }}</p>

                                <div class="price-row">
                                    <div class="price-block">
                                        <strong>{{ number_format($product[3]) }}</strong>
                                        <span>تومان</span>
                                    </div>
                                    <span class="old-price">{{ number_format($product[4]) }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="empty-state" data-empty-state hidden>
                    <div class="empty-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-4-4"></path></svg>
                    </div>
                    <strong>محصولی با این عبارت پیدا نشد.</strong>
                    <p>عبارت کوتاه‌تری امتحان کن یا جستجو را پاک کن.</p>
                    <button class="btn btn-secondary" type="button" data-search-reset>پاک کردن جستجو</button>
                </div>
            </div>
        </section>

        <section class="container promo-section reveal">
            <div class="promo-panel">
                <div class="promo-copy">
                    <span class="promo-eyebrow">برای خرید اول</span>
                    <h2>۱۰٪ تخفیف روی سفارش اول</h2>
                    <p>کد تخفیف را هنگام پرداخت وارد کن و اولین خریدت را با قیمت بهتری شروع کن.</p>
                    <div class="promo-actions">
                        <button class="promo-code" type="button" data-copy-code="NOVAFIRST10" aria-label="کپی کد تخفیف NOVAFIRST10">
                            <span>NOVAFIRST10</span>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="9" y="9" width="10" height="10" rx="2"></rect><path d="M6 15H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1"></path></svg>
                        </button>
                        <a class="text-link light" href="#products">انتخاب محصول <span aria-hidden="true">←</span></a>
                    </div>
                </div>

                <div class="promo-visual" aria-hidden="true">
                    <span class="promo-disc promo-disc-one"></span>
                    <span class="promo-disc promo-disc-two"></span>
                    <div class="promo-card">
                        <span class="promo-card-top">NOVA</span>
                        <strong>FIRST<br>10%</strong>
                        <span class="promo-card-bottom">YOUR FIRST ORDER</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="services">
            <div class="container">
                <div class="section-head reveal">
                    <div>
                        <span class="section-eyebrow">چرا NOVA?</span>
                        <h2>جزئیات کوچک، تجربه‌ی بهتر</h2>
                        <p>همه‌چیز برای خریدی مطمئن و کم‌دردسر چیده شده است.</p>
                    </div>
                </div>

                <div class="feature-grid">
                    <article class="feature-card reveal">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h11v10H4z"></path><path d="M15 10h3l2 2v5h-5z"></path><circle cx="8" cy="18" r="1.5"></circle><circle cx="17" cy="18" r="1.5"></circle></svg>
                        </span>
                        <div>
                            <strong>ارسال سریع</strong>
                            <p>سفارش‌ها با بسته‌بندی مرتب و مسیر رهگیری روشن ارسال می‌شوند.</p>
                        </div>
                    </article>

                    <article class="feature-card reveal">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="6" width="16" height="12" rx="2"></rect><path d="M4 10h16"></path><path d="M8 14h3"></path></svg>
                        </span>
                        <div>
                            <strong>پرداخت امن</strong>
                            <p>فرآیند پرداخت ساده و شفاف است و برای اتصال به درگاه واقعی آماده می‌ماند.</p>
                        </div>
                    </article>

                    <article class="feature-card reveal">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 5 6v5c0 4.5 2.7 7.9 7 10 4.3-2.1 7-5.5 7-10V6l-7-3Z"></path><path d="m9 12 2 2 4-4"></path></svg>
                        </span>
                        <div>
                            <strong>اعتماد بیشتر</strong>
                            <p>اطلاعات محصول، قیمت و وضعیت سفارش در جای درست و با خوانایی بالا نمایش داده می‌شوند.</p>
                        </div>
                    </article>

                    <article class="feature-card reveal">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"></circle><path d="M12 8v4l3 2"></path></svg>
                        </span>
                        <div>
                            <strong>پشتیبانی واقعی</strong>
                            <p>برای سؤال‌های قبل و بعد از خرید، مسیر مشخصی برای دریافت کمک در نظر گرفته شده است.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-grid">
            <div class="footer-brand-block">
                <a class="brand footer-brand" href="#home">
                    <span class="brand-mark" aria-hidden="true">N</span>
                    <span class="brand-copy">
                        <strong>NOVA SHOP</strong>
                        <small>shopping, made simple</small>
                    </span>
                </a>
                <p>یک تجربه‌ی فروشگاهی مدرن و مینیمال؛ با تمرکز روی سرعت، خوانایی و اعتماد.</p>
            </div>

            <div>
                <h3>دسترسی سریع</h3>
                <a href="#home">خانه</a>
                <a href="#categories">دسته‌بندی‌ها</a>
                <a href="#products">محصولات</a>
            </div>

            <div>
                <h3>راهنما</h3>
                <a href="#services">مزایای خرید</a>
                <a href="#services">پشتیبانی</a>
                <a href="#services">شرایط ارسال</a>
            </div>

            <div class="footer-cart">
                <h3>سبد خرید</h3>
                <div class="footer-stat">
                    <span>تعداد اقلام</span>
                    <strong data-cart-count>۰</strong>
                </div>
                <div class="footer-stat">
                    <span>جمع فعلی</span>
                    <strong data-cart-total>۰ تومان</strong>
                </div>
            </div>
        </div>

        <div class="container footer-bottom">
            <span>© ۱۴۰۵ NOVA SHOP</span>
            <span>رابط طراحی‌شده با رویکرد UI/UX Pro Max</span>
        </div>
    </footer>

    <div class="toast" data-toast role="status" aria-live="polite"></div>
</body>
</html>