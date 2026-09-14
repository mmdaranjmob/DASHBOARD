@extends('layouts.store')

@section('content')
<style>
.dashboard-page{direction:rtl;display:grid;grid-template-columns:1fr 255px;gap:20px;padding:22px 0 40px;align-items:start}
.dashboard-side{background:#fff;border:1px solid #e5ebf0;border-radius:18px;padding:14px;position:sticky;top:82px;box-shadow:0 6px 22px rgba(35,61,82,.05)}
.dashboard-side-head{display:flex;align-items:center;gap:10px;padding:6px 5px 15px;border-bottom:1px solid #edf1f4}
.dashboard-avatar{width:44px;height:44px;border-radius:13px;background:#08a9df;color:#fff;display:grid;place-items:center;font-size:16px;font-weight:900}
.dashboard-side-head strong{display:block;color:#30485d;font-size:12px}.dashboard-side-head small{display:block;margin-top:4px;color:#93a0aa;font-size:9px}
.dashboard-side-title{padding:17px 8px 7px;color:#a0aab3;font-size:9px;font-weight:900}
.dashboard-tab{width:100%;border:0;background:transparent;display:flex;align-items:center;gap:10px;height:43px;padding:0 11px;margin:3px 0;border-radius:11px;color:#647788;font-size:11px;text-align:right;cursor:pointer;font-family:inherit}
.dashboard-tab:hover{background:#f3f9fc;color:#079fd4}.dashboard-tab.active{background:#eaf8fd;color:#049ed6;font-weight:900}
.dashboard-tab-icon{width:22px;text-align:center;font-size:15px}
.dashboard-side-divider{height:1px;background:#edf1f4;margin:12px 5px}
.dashboard-logout{width:100%;height:42px;border:1px solid #f1dadd;background:#fff4f5;color:#b1535a;border-radius:11px;font-family:inherit;font-size:11px;cursor:pointer;margin-top:12px}
.dashboard-content{min-width:0}
.dashboard-panel{display:none}.dashboard-panel.active{display:block}
.dashboard-hero{background:linear-gradient(135deg,#263b4f,#3b566d);border-radius:18px;padding:28px;color:#fff;box-shadow:0 8px 24px rgba(38,59,79,.12);margin-bottom:16px}
.dashboard-hero small{color:#c4d2dc;font-size:10px}.dashboard-hero h1{margin:7px 0;color:#fff;font-size:27px}.dashboard-hero p{margin:0;color:#dce5ea;font-size:11px;line-height:2}
.dashboard-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:13px}.dashboard-card{background:#fff;border:1px solid #e5ebf0;border-radius:16px;box-shadow:0 5px 18px rgba(35,61,82,.04);padding:18px}
.dashboard-stat-label{color:#8b9aa6;font-size:10px}.dashboard-stat-value{margin-top:8px;color:#30485d;font-size:22px;font-weight:900}.dashboard-stat-unit{margin-top:3px;color:#9aa6b0;font-size:9px}
.dashboard-section{margin-top:18px}.dashboard-section-title{margin:0 0 10px;color:#334c60;font-size:14px}.dashboard-section-sub{margin:-4px 0 12px;color:#98a5ae;font-size:10px}
.dashboard-empty{background:#fff;border:1px dashed #dfe7ec;border-radius:15px;padding:40px;text-align:center;color:#9aa7b0;font-size:11px}
.dashboard-list{display:flex;flex-direction:column}.dashboard-row{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 0;border-bottom:1px solid #edf1f4}.dashboard-row:last-child{border-bottom:0}.dashboard-row strong{color:#40586b;font-size:11px}.dashboard-row small{display:block;margin-top:4px;color:#98a5ae;font-size:9px}.dashboard-badge{padding:5px 9px;border-radius:999px;background:#effaf4;color:#198458;font-size:9px;font-weight:800}
.dashboard-form{max-width:700px}.dashboard-form .form-group{margin-bottom:14px}.dashboard-form label{display:block;margin-bottom:6px;color:#526a7c;font-size:10px;font-weight:800}.dashboard-form input,.dashboard-form textarea{width:100%;border:1px solid #dbe5ec;border-radius:10px;padding:11px 12px;background:#fff;color:#30485d;outline:0;font-family:inherit;font-size:11px}.dashboard-form textarea{min-height:110px;resize:vertical}
.dashboard-actions{margin-top:16px;display:flex;gap:8px}.dashboard-button{min-height:38px;border:0;border-radius:10px;background:#08a9df;color:#fff;padding:0 15px;font-family:inherit;font-size:10px;font-weight:800;cursor:pointer}
@media(max-width:900px){.dashboard-page{grid-template-columns:1fr}.dashboard-side{position:static;order:2}.dashboard-content{order:1}.dashboard-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:580px){.dashboard-grid{grid-template-columns:1fr}.dashboard-side{padding:12px}}
</style>

<section class="dashboard-page">
    <main class="dashboard-content">
        <section class="dashboard-panel active" data-panel="dashboard">
            <div class="dashboard-hero">
                <small>پنل کاربری</small>
                <h1>سلام {{ $user->name ?: 'دوست عزیز' }} 👋</h1>
                <p>همه بخش‌های حساب کاربری از همین صفحه در دسترس تو هستند.</p>
            </div>
            <div class="dashboard-grid">
                <div class="dashboard-card"><div class="dashboard-stat-label">موجودی کیف پول</div><div class="dashboard-stat-value">{{ number_format($user->wallet?->balance ?? 0) }}</div><div class="dashboard-stat-unit">ریال</div></div>
                <div class="dashboard-card"><div class="dashboard-stat-label">تعداد سفارش‌ها</div><div class="dashboard-stat-value">{{ $user->orders()->count() }}</div><div class="dashboard-stat-unit">سفارش ثبت‌شده</div></div>
                <div class="dashboard-card"><div class="dashboard-stat-label">شماره موبایل</div><div class="dashboard-stat-value" style="font-size:18px;direction:ltr;text-align:right">{{ $user->mobile }}</div><div class="dashboard-stat-unit">حساب فعال</div></div>
            </div>
            <div class="dashboard-section">
                <h2 class="dashboard-section-title">آخرین سفارش‌ها</h2>
                <p class="dashboard-section-sub">خلاصه فعالیت اخیر</p>
                @if($orders->isEmpty())
                    <div class="dashboard-empty">هنوز سفارشی ثبت نکرده‌ای.</div>
                @else
                    <div class="dashboard-card dashboard-list">
                        @foreach($orders->take(5) as $order)
                            <div class="dashboard-row"><div><strong>#{{ $order->order_number }}</strong><small>{{ number_format($order->total_amount) }} ریال</small></div><span class="dashboard-badge">{{ match($order->status){'pending'=>'در انتظار','paid'=>'پرداخت‌شده','processing'=>'در حال پردازش','completed'=>'تکمیل‌شده','cancelled'=>'لغوشده','refunded'=>'مرجوع‌شده',default=>$order->status} }}</span></div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="dashboard-panel" data-panel="orders">
            <div class="dashboard-card"><h2 class="dashboard-section-title">سفارش‌های من</h2><p class="dashboard-section-sub">همه سفارش‌های حساب کاربری</p>
                @if($orders->isEmpty())<div class="dashboard-empty">هنوز سفارشی ثبت نشده است.</div>@else<div class="dashboard-list">@foreach($orders as $order)<div class="dashboard-row"><div><strong>#{{ $order->order_number }}</strong><small>{{ $order->created_at?->format('Y/m/d H:i') }} · {{ number_format($order->total_amount) }} ریال</small></div><a class="dashboard-button" style="text-decoration:none;display:inline-flex;align-items:center" href="{{ route('account.orders.show',$order) }}">جزئیات</a></div>@endforeach</div>@endif
            </div>
        </section>

        <section class="dashboard-panel" data-panel="transactions">
            <div class="dashboard-card"><h2 class="dashboard-section-title">تراکنش‌ها</h2><p class="dashboard-section-sub">سوابق مالی کیف پول</p>
                <div class="dashboard-empty">تراکنش‌ها در همین پنل نمایش داده می‌شوند.</div>
            </div>
        </section>

        <section class="dashboard-panel" data-panel="wallet">
            <div class="dashboard-grid" style="grid-template-columns:1fr 2fr">
                <div class="dashboard-card"><div class="dashboard-stat-label">موجودی فعلی</div><div class="dashboard-stat-value">{{ number_format($user->wallet?->balance ?? 0) }}</div><div class="dashboard-stat-unit">ریال</div></div>
                <div class="dashboard-card"><h2 class="dashboard-section-title">کیف پول</h2><p class="dashboard-section-sub">شارژ و مدیریت موجودی از این بخش انجام می‌شود.</p><div class="dashboard-empty">بخش شارژ کیف پول در همین داشبورد قرار می‌گیرد.</div></div>
            </div>
        </section>

        <section class="dashboard-panel" data-panel="tickets">
            <div class="dashboard-card"><h2 class="dashboard-section-title">پشتیبانی</h2><p class="dashboard-section-sub">تیکت‌ها و پیام‌های پشتیبانی</p><div class="dashboard-empty">تیکت‌ها در همین پنل نمایش داده می‌شوند.</div></div>
        </section>

        <section class="dashboard-panel" data-panel="profile">
            <div class="dashboard-card dashboard-form"><h2 class="dashboard-section-title">پروفایل</h2><p class="dashboard-section-sub">اطلاعات حساب کاربری</p>
                <form method="POST" action="{{ route('account.profile.update') }}">@csrf @method('PUT')
                    <div class="form-group"><label>نام</label><input name="name" value="{{ old('name',$user->name) }}"></div>
                    <div class="form-group"><label>شماره موبایل</label><input value="{{ $user->mobile }}" disabled></div>
                    <div class="form-group"><label>کد ملی</label><input value="{{ $user->national_id }}" disabled></div>
                    <div class="form-group"><label>ایمیل</label><input name="email" value="{{ old('email',$user->email) }}"></div>
                    <div class="dashboard-actions"><button class="dashboard-button" type="submit">ذخیره تغییرات</button></div>
                </form>
            </div>
        </section>
    </main>

    <aside class="dashboard-side">
        <div class="dashboard-side-head"><div class="dashboard-avatar">{{ mb_substr($user->name ?: 'ک',0,1) }}</div><div><strong>{{ $user->name ?: 'کاربر' }}</strong><small>{{ $user->mobile }}</small></div></div>
        <div class="dashboard-side-title">حساب کاربری</div>
        <button class="dashboard-tab active" type="button" data-target="dashboard"><span class="dashboard-tab-icon">⌂</span>داشبورد</button>
        <button class="dashboard-tab" type="button" data-target="orders"><span class="dashboard-tab-icon">▣</span>سفارش‌های من</button>
        <button class="dashboard-tab" type="button" data-target="transactions"><span class="dashboard-tab-icon">▤</span>تراکنش‌ها</button>
        <button class="dashboard-tab" type="button" data-target="wallet"><span class="dashboard-tab-icon">◉</span>کیف پول</button>
        <button class="dashboard-tab" type="button" data-target="tickets"><span class="dashboard-tab-icon">◈</span>پشتیبانی</button>
        <button class="dashboard-tab" type="button" data-target="profile"><span class="dashboard-tab-icon">✎</span>پروفایل</button>
        <div class="dashboard-side-divider"></div>
        <a class="dashboard-tab" href="{{ route('home') }}"><span class="dashboard-tab-icon">🛍</span>فروشگاه</a>
        <a class="dashboard-tab" href="{{ route('cart.index') }}"><span class="dashboard-tab-icon">🛒</span>سبد خرید</a>
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="dashboard-logout" type="submit">خروج از حساب</button></form>
    </aside>
</section>

<script>
document.querySelectorAll('.dashboard-tab[data-target]').forEach(function(tab){
    tab.addEventListener('click',function(){
        var target=this.dataset.target;
        document.querySelectorAll('.dashboard-tab[data-target]').forEach(function(item){item.classList.toggle('active',item===tab);});
        document.querySelectorAll('.dashboard-panel').forEach(function(panel){panel.classList.toggle('active',panel.dataset.panel===target);});
        window.scrollTo({top:0,behavior:'smooth'});
    });
});
</script>
@endsection
