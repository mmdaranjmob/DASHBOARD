<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DASHBOARD') }}</title>
    <style>
        *{box-sizing:border-box}body{margin:0;font-family:Tahoma,Arial,sans-serif;background:#f6f7fb;color:#171923}a{text-decoration:none;color:inherit}.container{width:min(1120px,92%);margin:auto}.nav{background:#111827;color:#fff;border-bottom:1px solid #20293a}.navin{height:72px;display:flex;align-items:center;justify-content:space-between;gap:20px}.brand{font-size:22px;font-weight:800}.navlinks{display:flex;align-items:center;gap:10px;flex-wrap:wrap}.navlinks a,.navlinks button{color:#e5e7eb;padding:9px 12px;border-radius:10px;background:transparent;border:0;font:inherit;cursor:pointer}.navlinks a:hover,.navlinks button:hover{background:#1f2937}.hero{padding:54px 0 30px}.hero-box{background:linear-gradient(135deg,#111827,#24324d);border-radius:28px;padding:42px;color:#fff;box-shadow:0 20px 50px rgba(17,24,39,.16)}.hero h1{font-size:38px;margin:0 0 14px}.hero p{color:#cbd5e1;line-height:1.9;max-width:700px}.btn{display:inline-block;padding:12px 18px;border-radius:12px;font-weight:700;border:0;cursor:pointer}.btn-primary{background:#fff;color:#111827}.btn-dark{background:#111827;color:#fff}.section{padding:22px 0 42px}.section-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}.section h2{margin:0;font-size:23px}.grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}.card{background:#fff;border:1px solid #e8eaf0;border-radius:20px;padding:18px;box-shadow:0 8px 24px rgba(0,0,0,.04)}.cat{min-height:110px;display:flex;flex-direction:column;justify-content:center}.cat-title{font-weight:800;font-size:18px}.muted{color:#6b7280}.product{display:flex;flex-direction:column;gap:10px}.product-img{height:150px;background:#eef1f7;border-radius:14px;display:flex;align-items:center;justify-content:center;color:#9ca3af;overflow:hidden}.product-img img{width:100%;height:100%;object-fit:cover}.price{font-size:19px;font-weight:800}.old{font-size:13px;color:#9ca3af;text-decoration:line-through;margin-right:8px}.flash{margin:18px 0;padding:14px 16px;border-radius:12px;background:#ecfdf5;color:#047857}.errors{margin:18px 0;padding:14px 16px;border-radius:12px;background:#fef2f2;color:#b91c1c}.form-box{max-width:520px;margin:50px auto;background:#fff;padding:28px;border-radius:22px;border:1px solid #e8eaf0}.form-group{margin:0 0 16px}.form-group label{display:block;margin-bottom:7px;font-weight:700}.form-group input,.form-group textarea,.form-group select{width:100%;padding:13px 14px;border:1px solid #d9dde7;border-radius:12px;outline:none;font:inherit}.form-group input:focus,.form-group textarea:focus,.form-group select:focus{border-color:#111827}.footer{padding:35px 0;color:#6b7280;text-align:center}.empty{padding:25px;text-align:center;color:#6b7280;background:#fff;border-radius:18px;border:1px dashed #d8dbe5}@media(max-width:900px){.grid{grid-template-columns:repeat(2,1fr)}.hero h1{font-size:30px}}@media(max-width:560px){.grid{grid-template-columns:1fr}.navin{height:auto;padding:14px 0;align-items:flex-start;flex-direction:column}.hero-box{padding:28px}.hero{padding-top:24px}}
    </style>
</head>
<body>
<nav class="nav">
    <div class="container navin">
        <a class="brand" href="{{ route('home') }}">DASHBOARD</a>
        <div class="navlinks">
            <a href="{{ route('home') }}">فروشگاه</a>
            <a href="{{ route('cart.index') }}">🛒 سبد خرید <span style="display:inline-flex;min-width:22px;height:22px;align-items:center;justify-content:center;border-radius:999px;background:#374151;font-size:12px">{{ collect(session('cart', []))->sum(fn($item) => (int) ($item['quantity'] ?? 0)) }}</span></a>
            @auth
                <a href="{{ route('account.dashboard') }}">حساب من</a>
                <a href="{{ route('account.orders') }}">سفارش‌ها</a>
                <a href="{{ route('account.tickets') }}">پشتیبانی</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}">مدیریت</a>
                @endif
                <span style="color:#9ca3af">کیف پول: {{ number_format(auth()->user()->wallet?->balance ?? 0) }} ریال</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button type="submit">خروج</button></form>
            @else
                <a href="{{ route('auth') }}">ورود / عضویت</a>
            @endauth
        </div>
    </div>
</nav>
<main class="container">
    @if(session('success')) <div class="flash">{{ session('success') }}</div> @endif
    @if(session('info')) <div class="flash">{{ session('info') }}</div> @endif
    @if($errors->any()) <div class="errors">{{ $errors->first() }}</div> @endif
    @yield('content')
</main>
<footer class="footer">© {{ now()->year }} DASHBOARD — فروش امن و سریع خدمات دیجیتال</footer>
</body>
</html>