<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f6f8fb">
    <title>{{ $siteName ?? config('app.name', 'DASHBOARD') }}</title>
    <style>
        :root{--bg:#f4f7fb;--surface:#fff;--text:#3f566b;--strong:#294156;--muted:#8b9aaa;--line:#e7edf2;--blue:#08a9df;--green:#24b77e;--orange:#f4a31d;--shadow:0 10px 30px rgba(38,69,95,.055)}
        *{box-sizing:border-box}
        html{background:var(--bg)}
        body{margin:0;background:var(--bg);color:var(--text);font-family:Tahoma,"Segoe UI",Arial,sans-serif;-webkit-font-smoothing:antialiased}
        a{text-decoration:none;color:inherit}
        button,input,select,textarea{font:inherit}
        .container{width:min(1270px,calc(100% - 34px));margin:auto}
        .page{min-height:calc(100vh - 118px);padding-bottom:34px}
        .site-header{height:68px;background:#fff;border-bottom:1px solid #edf1f4;position:sticky;top:0;z-index:100}
        .header-inner{height:68px;display:grid;grid-template-columns:190px minmax(0,1fr) 270px;align-items:center;gap:18px}
        .brand{display:flex;align-items:center}.brand-logo{width:142px;max-height:46px;object-fit:contain}.brand-fallback{display:flex;align-items:center;gap:9px;font-weight:900;color:#223b50;font-size:16px}.brand-mark{width:36px;height:36px;border-radius:11px;background:linear-gradient(135deg,#f4a21c,#08a9df);display:grid;place-items:center;color:#fff}
        .main-nav{display:flex;align-items:center;justify-content:center;gap:2px}.main-nav a{padding:12px 15px;border-radius:10px;color:#50687b;font-size:12px;white-space:nowrap}.main-nav a:hover,.main-nav a.active{background:#f5faff;color:#079fd3}
        .header-actions{display:flex;align-items:center;justify-content:flex-start;gap:9px}.header-pill{height:38px;display:flex;align-items:center;gap:7px;padding:0 11px;border:1px solid var(--line);background:#fff;border-radius:11px;font-size:11px;color:#587084}.balance-pill{background:#eefaf4;border-color:#daf2e6;color:#24835f;font-weight:900}.avatar-link{display:flex;align-items:center;gap:8px;color:#50687b;font-size:11px}.avatar{width:34px;height:34px;border-radius:50%;background:#abb0b5;color:#fff;display:grid;place-items:center;font-size:12px}
        .flash,.errors{margin-top:14px;padding:11px 14px;border-radius:11px;font-size:12px}.flash{background:#effaf4;border:1px solid #d9f1e4;color:#22805c}.errors{background:#fff1f2;border:1px solid #f6dadd;color:#ae484f}
        .btn{min-height:40px;display:inline-flex;align-items:center;justify-content:center;gap:7px;padding:0 15px;border-radius:10px;border:1px solid transparent;font-size:12px;font-weight:800;cursor:pointer;transition:.15s}.btn:hover{transform:translateY(-1px)}.btn-primary{background:var(--blue);border-color:var(--blue);color:#fff}.btn-dark{background:#263d50;border-color:#263d50;color:#fff}.btn-soft{background:#f4f8fb;border-color:#e5edf2;color:#587084}.btn-danger{background:#fff0f2;border-color:#f2dadd;color:#ad4a50}.btn-sm{min-height:34px;padding:0 11px;font-size:11px}.btn-block{width:100%}
        .store-page{padding-top:12px}.banner-wrap{margin-bottom:16px}.store-banner{display:block;overflow:hidden;background:#fff;border:1px solid #e2eaf0;border-radius:20px;box-shadow:0 5px 22px rgba(33,62,86,.05)}.store-banner img{display:block;width:100%;height:156px;object-fit:cover}.banner-placeholder{height:156px;display:flex;align-items:center;justify-content:center;background:linear-gradient(100deg,#e8f6fd,#fbfdff);color:#628092;font-size:16px}
        .store-main{direction:ltr;display:grid;grid-template-columns:minmax(0,1fr) 182px;gap:18px;align-items:start}.catalog-card{direction:rtl;background:#fff;border:1px solid #e6edf2;border-radius:22px;box-shadow:var(--shadow);padding:18px;min-width:0}.catalog-tabs{display:flex;align-items:flex-end;gap:8px;border-bottom:1px solid #edf1f4;overflow:auto;margin-bottom:15px}.catalog-tab{position:relative;padding:3px 10px 12px;color:#8796a4;font-size:12px;white-space:nowrap}.catalog-tab:after{content:"";position:absolute;left:0;right:0;bottom:-1px;height:2px;background:transparent}.catalog-tab.active{color:#039fd7;font-weight:900}.catalog-tab.active:after{background:#13aee3}
        .catalog-head{display:flex;align-items:center;gap:12px;margin-bottom:13px}.catalog-heading{font-size:15px;color:#496177;font-weight:800;white-space:nowrap}.search-field{flex:1}.search-field input{width:100%;height:41px;border:1px solid #dbe5ec;border-radius:9px;padding:0 13px;background:#fff;outline:none;color:#40586c;font-size:12px}.search-field input::placeholder{color:#a2adb7}.search-field input:focus{border-color:#92d9f1;box-shadow:0 0 0 3px rgba(8,169,223,.08)}
        .catalog-body{display:grid;grid-template-columns:minmax(310px,.9fr) minmax(0,1.1fr);gap:28px;min-height:510px}.service-list{padding-top:1px}.service-row{min-height:45px;display:flex;align-items:center;gap:10px;margin-bottom:8px;padding:0 10px;border:1px solid #eff2f4;background:#f7f7f8;border-radius:9px;transition:.14s}.service-row:hover{background:#f0f8fc;border-color:#dcecf3;transform:translateX(-1px)}.service-icon{width:28px;height:28px;border-radius:8px;display:grid;place-items:center;flex:0 0 auto;background:#fff;border:1px solid #e9eef2;color:#8aa0b0;font-size:12px;font-weight:900}.service-icon img{width:20px;height:20px;object-fit:contain}.service-name{font-size:12px;color:#5b6e7e;flex:1;min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.service-price{font-size:11px;color:#748798;white-space:nowrap}.service-action{width:22px;height:22px;display:grid;place-items:center;color:#a5b2bc;font-size:19px}.empty-panel{min-height:510px;display:flex;align-items:center;justify-content:center;text-align:center;padding:30px}.empty-inner{max-width:315px}.empty-illustration{width:190px;height:215px;position:relative;margin:0 auto 10px}.orb{position:absolute;left:45px;bottom:8px;width:102px;height:102px;border:4px solid #6d2f0d;border-radius:50%;background:#fff}.orb:before{content:"";position:absolute;left:-8px;top:11px;width:116px;height:36px;border-top:4px solid #6d2f0d;border-radius:50%;transform:rotate(-9deg)}.astronaut{position:absolute;top:8px;left:67px;width:60px;height:132px;border:4px solid #6d2f0d;border-radius:31px 31px 23px 23px;background:#fff;transform:rotate(8deg)}.astronaut:before{content:"";position:absolute;left:7px;top:16px;width:38px;height:29px;border:4px solid #6d2f0d;border-radius:50%;background:#fff}.astronaut:after{content:"";position:absolute;left:-12px;top:62px;width:24px;height:46px;border:4px solid #6d2f0d;border-right:0;border-radius:18px 0 0 18px;transform:rotate(-26deg)}.spark{position:absolute;color:#d9b08f;font-size:17px}.spark.s1{top:38px;right:8px}.spark.s2{bottom:60px;right:26px}.spark.s3{top:70px;left:10px}.empty-title{display:block;color:#8b5035;font-size:13px;margin-bottom:8px}.empty-copy{margin:0;color:#9b7661;font-size:11px;line-height:2}
        .category-sidebar{direction:rtl;display:flex;flex-direction:column;gap:9px}.category-item{min-height:58px;display:flex;align-items:center;justify-content:space-between;gap:8px;padding:9px 10px 9px 12px;background:#fff;border:1px solid #edf1f5;border-radius:17px;color:#6b8091;transition:.14s}.category-item:hover{border-color:#cfe9f4;transform:translateX(-2px)}.category-item.active{border-color:#11abe0;background:#f9fdff;color:#059bd2;box-shadow:0 3px 12px rgba(9,167,220,.08)}.category-label{font-size:12px;font-weight:800;line-height:1.5}.category-icon{width:39px;height:39px;border-radius:12px;display:grid;place-items:center;background:#f3f7fa;border:1px solid #e9eff3;color:#8da2b0;font-weight:900;flex:0 0 auto}.category-item.active .category-icon{background:#eefaff;border-color:#d3f1fb;color:#12aae1}.category-icon img{width:22px;height:22px;object-fit:contain}
        .store-info{margin-top:18px;display:grid;grid-template-columns:1.25fr .9fr;gap:18px}.info-card{background:#fff;border:1px solid #e7edf2;border-radius:18px;box-shadow:0 4px 18px rgba(37,64,92,.04);padding:20px}.info-title{margin:0 0 8px;color:#30495d;font-size:15px}.info-copy{margin:0;color:#7f909e;font-size:11px;line-height:2.05}.feature-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:9px;margin-top:14px}.feature{padding:12px;border:1px solid #edf1f4;border-radius:12px;background:#fbfcfd}.feature b{display:block;font-size:11px;color:#536c7e;margin-bottom:4px}.feature span{font-size:10px;color:#99a6b1;line-height:1.7}.trust-list{display:grid;grid-template-columns:repeat(2,1fr);gap:9px;margin-top:14px}.trust-item{min-height:66px;border:1px solid #edf1f4;border-radius:12px;background:#fbfcfd;display:flex;align-items:center;justify-content:center;text-align:center;color:#8a9aa7;font-size:10px;padding:10px}.floating-support{position:fixed;right:22px;bottom:20px;width:49px;height:49px;border-radius:16px;background:#fff;border:1px solid #e3eaf0;box-shadow:0 9px 25px rgba(34,61,84,.13);display:grid;place-items:center;color:var(--orange);z-index:80}.support-svg{width:24px;height:24px}
        .section{padding:22px 0}.grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px}.card{background:#fff;border:1px solid #e7edf2;border-radius:16px;box-shadow:0 4px 16px rgba(39,68,92,.04)}.form-box{width:min(700px,100%);margin:28px auto;padding:25px;background:#fff;border:1px solid #e5ecf1;border-radius:18px;box-shadow:var(--shadow)}.form-box h1,.form-box h2{margin:0 0 7px;color:#30485d}.form-group{margin-bottom:14px}.form-group label{display:block;margin-bottom:7px;color:#50687a;font-size:12px;font-weight:800}.form-group input,.form-group select,.form-group textarea{width:100%;border:1px solid #dbe4eb;border-radius:9px;padding:11px 12px;background:#fff;color:#31495e;outline:0}.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:#8ed9f2;box-shadow:0 0 0 3px rgba(18,174,231,.08)}.footer{padding:28px 0 36px;text-align:center;color:#9daab5;font-size:10px}
        .admin-section{padding:24px 0}.admin-head{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:18px}.admin-kicker{font-size:10px;color:#08a0d7;font-weight:900;margin-bottom:4px}.admin-head h1{margin:0;color:#2b4357;font-size:24px}.admin-head p{margin:7px 0 0;color:#8c9aa6;font-size:11px}.admin-panel{background:#fff;border:1px solid #e6edf2;border-radius:18px;box-shadow:0 5px 20px rgba(37,64,92,.05);padding:18px}.admin-layout{display:grid;grid-template-columns:minmax(0,1.55fr) minmax(280px,.8fr);gap:16px}.panel-title{display:flex;justify-content:space-between;gap:12px;padding-bottom:12px;border-bottom:1px solid #eef2f5;margin-bottom:4px}.panel-title strong{color:#31495e;font-size:13px}.panel-title span{display:block;margin-top:4px;color:#94a1ad;font-size:10px}.admin-list{display:flex;flex-direction:column}.admin-row{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:13px 0;border-bottom:1px solid #f0f3f5}.admin-row:last-child{border-bottom:0}.row-main{display:flex;align-items:center;gap:11px;min-width:0}.row-main strong{display:block;color:#40586d;font-size:12px}.row-main small{display:block;margin-top:4px;color:#99a6b2;font-size:10px}.admin-avatar{width:38px;height:38px;border-radius:11px;background:#f1f8fc;color:#10a9df;display:grid;place-items:center;font-weight:900;flex:0 0 auto}.row-actions{display:flex;align-items:center;gap:8px;flex:0 0 auto}.status{padding:5px 8px;border-radius:999px;font-size:10px;font-weight:800}.status-on{color:#198458;background:#effaf4}.status-off{color:#a77171;background:#fff2f2}.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:0 14px}.form-span-2{grid-column:1/-1}.form-actions{display:flex;gap:8px;margin-top:18px}.check-row{display:flex;align-items:center;gap:8px;font-size:11px;color:#607487}.check-row input{accent-color:#10abe0}.settings-preview{margin-top:10px;padding:10px;border:1px solid #e7edf2;border-radius:12px;background:#fafcfd}.settings-preview span{display:block;color:#8293a1;font-size:10px;margin-bottom:8px}.settings-preview img{display:block;width:100%;max-height:160px;object-fit:cover;border-radius:8px}.admin-nav{display:flex;gap:7px;flex-wrap:wrap;margin-bottom:16px}.admin-nav a{padding:9px 12px;border:1px solid #e5ebf0;background:#fff;border-radius:9px;color:#607486;font-size:11px}.admin-nav a:hover{border-color:#cae7f1;color:#079fd5;background:#f9fdff}
        @media(max-width:1080px){.header-inner{grid-template-columns:155px 1fr auto}.main-nav{display:none}.store-main{grid-template-columns:1fr}.category-sidebar{display:grid;grid-template-columns:repeat(4,1fr)}.catalog-body{grid-template-columns:1fr}.empty-panel{min-height:350px;order:2}.store-info{grid-template-columns:1fr}.admin-layout{grid-template-columns:1fr}.grid{grid-template-columns:repeat(2,1fr)}}
        @media(max-width:680px){.container{width:calc(100% - 18px)}.site-header,.header-inner{height:58px}.header-inner{grid-template-columns:1fr auto;gap:9px}.brand-logo{width:112px}.header-pill{height:34px;padding:0 9px}.balance-pill{display:none}.avatar-link span{display:none}.page{min-height:calc(100vh - 104px)}.store-banner img,.banner-placeholder{height:108px}.catalog-card{padding:13px}.catalog-tabs{gap:4px}.catalog-tab{font-size:11px;padding-inline:8px}.catalog-head{flex-direction:column;align-items:stretch}.catalog-heading{font-size:14px}.category-sidebar{grid-template-columns:1fr 1fr;gap:8px}.category-item{min-height:51px}.category-icon{width:35px;height:35px}.service-row{min-height:43px}.service-price{font-size:10px}.store-info{gap:12px}.feature-grid{grid-template-columns:1fr}.trust-list{grid-template-columns:1fr 1fr}.admin-head{align-items:flex-start;flex-direction:column}.admin-row{align-items:flex-start}.row-actions .status{display:none}.form-grid{grid-template-columns:1fr}.form-span-2{grid-column:auto}.grid{grid-template-columns:1fr}.floating-support{right:13px;bottom:13px;width:44px;height:44px}}
    </style>
</head>
<body>
@php($siteName = \App\Models\StoreSetting::get('site_name', 'NumberLand'))
@php($logoUrl = \App\Models\StoreSetting::get('logo_url', ''))
@php($supportUrl = \App\Models\StoreSetting::get('support_url', ''))
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}">
            @if($logoUrl)
                <img class="brand-logo" src="{{ $logoUrl }}" alt="{{ $siteName }}">
            @else
                <span class="brand-fallback"><span class="brand-mark">N</span><span>{{ $siteName }}</span></span>
            @endif
        </a>
        <nav class="main-nav" aria-label="ناوبری اصلی">
            <a class="active" href="{{ route('home') }}">خدمات</a>
            <a href="#">وبلاگ</a>
            <a href="#">راهنما</a>
            <a href="#">نمایندگی فروش</a>
            <a href="#">تماس</a>
            @auth
                <a href="{{ route('account.orders') }}">سفارش‌ها</a>
                <a href="{{ route('account.tickets') }}">پشتیبانی</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}">مدیریت</a>
                @endif
            @endauth
        </nav>
        <div class="header-actions">
            @auth
                <a class="header-pill balance-pill" href="{{ route('account.dashboard') }}">{{ number_format(auth()->user()->wallet?->balance ?? 0) }} تومان</a>
                <a class="header-pill" href="{{ route('cart.index') }}">
                    سبد خرید
                    @if(session('cart'))
                        <strong>{{ collect(session('cart'))->sum('quantity') }}</strong>
                    @endif
                </a>
                <a class="avatar-link" href="{{ route('account.profile') }}">
                    <span>{{ auth()->user()->name ?: 'کاربر' }}</span>
                    <span class="avatar">●</span>
                </a>
            @else
                <a class="header-pill" href="{{ route('auth') }}">ورود / عضویت</a>
            @endauth
        </div>
    </div>
</header>
<main class="page container">
    @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="flash">{{ session('info') }}</div>
    @endif
    @if($errors->any())
        <div class="errors">{{ $errors->first() }}</div>
    @endif
    @yield('content')
</main>
@if($supportUrl)
    <a class="floating-support" href="{{ $supportUrl }}" aria-label="پشتیبانی">
        <svg class="support-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path d="M4 12a8 8 0 0 1 16 0v4a3 3 0 0 1-3 3h-2v-6h5M4 13H2v2a3 3 0 0 0 3 3h1v-5"/>
            <path d="M8 19h2"/>
        </svg>
    </a>
@endif
<footer class="footer">© {{ now()->year }} {{ $siteName }}</footer>
</body>
</html>
