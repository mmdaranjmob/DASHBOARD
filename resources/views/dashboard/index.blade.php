@extends('layouts.store')

@section('content')
<style>
.customer-dashboard{direction:ltr;display:grid;grid-template-columns:minmax(0,1fr) 255px;gap:22px;align-items:start;padding:24px 0 40px}
.customer-content{direction:rtl;min-width:0}
.customer-sidebar{direction:rtl;position:sticky;top:82px;background:#fff;border:1px solid #e4eaf0;border-radius:18px;padding:16px;box-shadow:0 8px 24px rgba(35,61,82,.06)}
.customer-sidebar-head{display:flex;align-items:center;gap:11px;padding:4px 4px 16px;border-bottom:1px solid #edf1f4}
.customer-sidebar-avatar{width:46px;height:46px;border-radius:14px;background:#08a9df;color:#fff;display:grid;place-items:center;font-size:17px;font-weight:900;flex:0 0 auto}
.customer-sidebar-head strong{display:block;color:#2f4659;font-size:12px;font-weight:900}.customer-sidebar-head small{display:block;margin-top:5px;color:#95a1ac;font-size:9px;direction:ltr;text-align:right}
.customer-sidebar-section{padding:17px 4px 7px;color:#a0aab3;font-size:9px;font-weight:900}
.customer-sidebar-link{display:flex;align-items:center;gap:11px;min-height:43px;padding:0 10px;margin:3px 0;border-radius:11px;color:#617486;font-size:11px;transition:.15s}
.customer-sidebar-link:hover{background:#f3f9fc;color:#079fd4}.customer-sidebar-link.active{background:#eaf8fd;color:#049ed6;font-weight:900}
.customer-sidebar-icon{width:23px;text-align:center;font-size:14px;color:#8c9ca9}.customer-sidebar-link.active .customer-sidebar-icon{color:#08a9df}
.customer-sidebar-divider{height:1px;background:#edf1f4;margin:12px 4px}
.customer-balance{margin-top:14px;padding:13px;border-radius:13px;background:#f2fbf7;border:1px solid #dcf1e7}.customer-balance span{display:block;color:#789185;font-size:9px}.customer-balance strong{display:block;margin-top:6px;color:#20865f;font-size:14px}
.customer-welcome{background:linear-gradient(135deg,#263b4f,#354e65);border-radius:18px;padding:27px 29px;color:#fff;box-shadow:0 8px 25px rgba(38,59,79,.12);margin-bottom:16px}.customer-welcome .eyebrow{color:#b9cad6;font-size:10px}.customer-welcome h1{margin:7px 0 7px;font-size:27px;color:#fff}.customer-welcome p{margin:0;color:#d9e2e8;font-size:11px;line-height:2}
.customer-stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:13px;margin-bottom:19px}.customer-stat{padding:17px 18px}.customer-stat .label{color:#8c9aa6;font-size:10px}.customer-stat .value{margin-top:8px;color:#30495d;font-size:22px;font-weight:900}.customer-stat .unit{margin-top:3px;color:#9ba7b0;font-size:9px}
.customer-heading{display:flex;align-items:center;justify-content:space-between;gap:15px;margin:0 0 11px}.customer-heading h2{margin:0;color:#334c60;font-size:15px}.customer-heading p{margin:4px 0 0;color:#97a4ae;font-size:10px}
.customer-quick{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px;margin-bottom:22px}.customer-quick-card{display:block;padding:16px;min-height:112px;transition:.15s}.customer-quick-card:hover{transform:translateY(-2px);border-color:#d7edf5}.customer-quick-icon{font-size:23px}.customer-quick-card strong{display:block;margin-top:10px;color:#40586b;font-size:11px}.customer-quick-card span{display:block;margin-top:5px;color:#9aa6b0;font-size:9px;line-height:1.7}
.customer-orders{overflow:auto}.customer-orders table{width:100%;border-collapse:collapse;min-width:650px}.customer-orders th{padding:13px 14px;background:#f8fafc;color:#7d8c98;font-size:10px;font-weight:900;text-align:right}.customer-orders td{padding:14px;border-top:1px solid #edf1f4;color:#50687a;font-size:10px}.customer-orders td:first-child{font-weight:900;color:#3f566b}
@media(max-width:980px){.customer-dashboard{grid-template-columns:1fr}.customer-sidebar{position:static;order:2}.customer-content{order:1}.customer-sidebar-nav{display:grid;grid-template-columns:repeat(2,1fr);gap:2px}.customer-stats,.customer-quick{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:600px){.customer-dashboard{padding-top:14px}.customer-welcome{padding:22px}.customer-welcome h1{font-size:22px}.customer-stats,.customer-quick{grid-template-columns:1fr}.customer-sidebar-nav{grid-template-columns:1fr}.customer-sidebar{padding:13px}}
</style>

<section class="customer-dashboard">
    <aside class="customer-sidebar">
        <div class="customer-sidebar-head">
            <div class="customer-sidebar-avatar">{{ mb_substr($user->name ?: 'ک',0,1) }}</div>
            <div><strong>{{ $user->name ?: 'کاربر' }}</strong><small>{{ $user->mobile }}</small></div>
        </div>

        <div class="customer-sidebar-nav">
            <div class="customer-sidebar-section">حساب کاربری</div>
            <a class="customer-sidebar-link active" href="{{ route('account.dashboard') }}"><span class="customer-sidebar-icon">⌂</span>داشبورد</a>
            <a class="customer-sidebar-link" href="{{ route('account.orders') }}"><span class="customer-sidebar-icon">▣</span>سفارش‌های من</a>
            <a class="customer-sidebar-link" href="{{ route('account.transactions') }}"><span class="customer-sidebar-icon">▤</span>تراکنش‌ها</a>
            <a class="customer-sidebar-link" href="{{ route('account.tickets') }}"><span class="customer-sidebar-icon">◈</span>پشتیبانی</a>
            <a class="customer-sidebar-link" href="{{ route('account.profile') }}"><span class="customer-sidebar-icon">✎</span>پروفایل</a>

            <div class="customer-sidebar-divider"></div>
            <div class="customer-sidebar-section">خرید و فروشگاه</div>
            <a class="customer-sidebar-link" href="{{ route('home') }}"><span class="customer-sidebar-icon">🛍</span>فروشگاه</a>
            <a class="customer-sidebar-link" href="{{ route('cart.index') }}"><span class="customer-sidebar-icon">🛒</span>سبد خرید</a>
        </div>

        <div class="customer-balance"><span>موجودی کیف پول</span><strong>{{ number_format($user->wallet?->balance ?? 0) }} ریال</strong></div>
    </aside>

    <div class="customer-content">
        <div class="customer-welcome">
            <div class="eyebrow">پنل کاربری</div>
            <h1>سلام {{ $user->name ?: 'دوست عزیز' }} 👋</h1>
            <p>خریدها، سفارش‌ها، کیف پول و پشتیبانی خودت را از اینجا مدیریت کن.</p>
        </div>

        <div class="customer-stats">
            <div class="card customer-stat"><div class="label">موجودی کیف پول</div><div class="value">{{ number_format($user->wallet?->balance ?? 0) }}</div><div class="unit">ریال</div></div>
            <div class="card customer-stat"><div class="label">تعداد سفارش‌ها</div><div class="value">{{ $user->orders()->count() }}</div><div class="unit">سفارش ثبت‌شده</div></div>
            <div class="card customer-stat"><div class="label">شماره موبایل</div><div class="value" style="font-size:18px;direction:ltr;text-align:right">{{ $user->mobile }}</div><div class="unit">حساب فعال</div></div>
        </div>

        <div class="customer-heading"><div><h2>دسترسی سریع</h2><p>بخش‌های پرکاربرد حساب کاربری</p></div></div>
        <div class="customer-quick">
            <a class="card customer-quick-card" href="{{ route('home') }}"><div class="customer-quick-icon">🛍️</div><strong>فروشگاه</strong><span>خرید خدمات جدید</span></a>
            <a class="card customer-quick-card" href="{{ route('cart.index') }}"><div class="customer-quick-icon">🛒</div><strong>سبد خرید</strong><span>مشاهده اقلام انتخابی</span></a>
            <a class="card customer-quick-card" href="{{ route('account.orders') }}"><div class="customer-quick-icon">📦</div><strong>سفارش‌ها</strong><span>پیگیری سفارش‌ها</span></a>
            <a class="card customer-quick-card" href="{{ route('account.transactions') }}"><div class="customer-quick-icon">💳</div><strong>تراکنش‌ها</strong><span>سوابق مالی کیف پول</span></a>
            <a class="card customer-quick-card" href="{{ route('account.tickets') }}"><div class="customer-quick-icon">🎧</div><strong>پشتیبانی</strong><span>ثبت و پیگیری تیکت</span></a>
            <a class="card customer-quick-card" href="{{ route('account.profile') }}"><div class="customer-quick-icon">✏️</div><strong>ویرایش پروفایل</strong><span>اطلاعات حساب کاربری</span></a>
        </div>

        <div class="customer-heading"><div><h2>آخرین سفارش‌ها</h2><p>خلاصه فعالیت اخیر</p></div><a class="btn btn-soft" href="{{ route('account.orders') }}">همه سفارش‌ها ←</a></div>
        @if($orders->isEmpty())
            <div class="empty">هنوز سفارشی ثبت نکرده‌ای. <a href="{{ route('home') }}" style="font-weight:800;color:#079fd3">شروع خرید →</a></div>
        @else
            <div class="card customer-orders"><table><thead><tr><th>شماره</th><th>مبلغ</th><th>وضعیت</th><th>تاریخ</th><th></th></tr></thead><tbody>
            @foreach($orders as $order)
                <tr><td>{{ $order->order_number }}</td><td>{{ number_format($order->total_amount) }} ریال</td><td>{{ match($order->status){'pending'=>'در انتظار','paid'=>'پرداخت‌شده','processing'=>'در حال پردازش','completed'=>'تکمیل‌شده','cancelled'=>'لغوشده','refunded'=>'مرجوع‌شده',default=>$order->status} }}</td><td>{{ $order->created_at?->format('Y/m/d H:i') }}</td><td><a class="btn btn-soft btn-sm" href="{{ route('account.orders.show',$order) }}">جزئیات</a></td></tr>
            @endforeach
            </tbody></table></div>
        @endif
    </div>
</section>
@endsection
