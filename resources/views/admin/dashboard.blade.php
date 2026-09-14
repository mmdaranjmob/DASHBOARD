@extends('layouts.store')
@section('content')
<section class="admin-section">
    <div class="admin-head">
        <div><div class="admin-kicker">مدیریت فروشگاه</div><h1>پنل مدیریت</h1><p>محتوا، دسته‌ها، خدمات، سفارش‌ها و کاربران را از یکجا کنترل کن.</p></div>
        <a class="btn btn-primary" href="{{ route('home') }}">مشاهده فروشگاه</a>
    </div>

    <div class="grid" style="grid-template-columns:repeat(4,minmax(0,1fr));margin-bottom:16px">
        <div class="admin-panel"><div class="muted">کاربران</div><div style="margin-top:8px;font-size:26px;font-weight:900;color:#30485c">{{ number_format($stats['users']) }}</div></div>
        <div class="admin-panel"><div class="muted">کل سفارش‌ها</div><div style="margin-top:8px;font-size:26px;font-weight:900;color:#30485c">{{ number_format($stats['orders']) }}</div></div>
        <div class="admin-panel"><div class="muted">در انتظار</div><div style="margin-top:8px;font-size:26px;font-weight:900;color:#30485c">{{ number_format($stats['pending_orders']) }}</div></div>
        <div class="admin-panel"><div class="muted">فروش ثبت‌شده</div><div style="margin-top:8px;font-size:20px;font-weight:900;color:#30485c">{{ number_format($stats['revenue']) }} ریال</div></div>
    </div>

    <div class="admin-panel">
        <div class="panel-title"><div><strong>مدیریت سریع</strong><span>هر بخش را مستقیم باز کن.</span></div></div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:10px">
            <a class="admin-quick" style="padding:14px;border:1px solid #edf1f4;border-radius:12px;background:#fbfcfd" href="{{ route('admin.settings') }}"><b style="display:block;font-size:12px">ظاهر فروشگاه</b><span style="display:block;margin-top:5px;color:#94a1ad;font-size:10px">نام، لوگو، بنر و پشتیبانی</span></a>
            <a class="admin-quick" style="padding:14px;border:1px solid #edf1f4;border-radius:12px;background:#fbfcfd" href="{{ route('admin.categories') }}"><b style="display:block;font-size:12px">دسته‌بندی‌ها</b><span style="display:block;margin-top:5px;color:#94a1ad;font-size:10px">افزودن و ویرایش منوها</span></a>
            <a class="admin-quick" style="padding:14px;border:1px solid #edf1f4;border-radius:12px;background:#fbfcfd" href="{{ route('admin.products') }}"><b style="display:block;font-size:12px">خدمات / محصولات</b><span style="display:block;margin-top:5px;color:#94a1ad;font-size:10px">قیمت، تصویر، فیلد و وضعیت</span></a>
            <a class="admin-quick" style="padding:14px;border:1px solid #edf1f4;border-radius:12px;background:#fbfcfd" href="{{ route('admin.users') }}"><b style="display:block;font-size:12px">کاربران</b><span style="display:block;margin-top:5px;color:#94a1ad;font-size:10px">حساب‌ها و شارژ کیف پول</span></a>
            <a class="admin-quick" style="padding:14px;border:1px solid #edf1f4;border-radius:12px;background:#fbfcfd" href="{{ route('admin.orders') }}"><b style="display:block;font-size:12px">سفارش‌ها</b><span style="display:block;margin-top:5px;color:#94a1ad;font-size:10px">وضعیت و یادداشت مدیریت</span></a>
            <a class="admin-quick" style="padding:14px;border:1px solid #edf1f4;border-radius:12px;background:#fbfcfd" href="{{ route('admin.tickets') }}"><b style="display:block;font-size:12px">تیکت‌ها</b><span style="display:block;margin-top:5px;color:#94a1ad;font-size:10px">پاسخ و تغییر وضعیت</span></a>
        </div>
    </div>

    <div class="admin-panel" style="margin-top:16px">
        <div class="panel-title"><div><strong>آخرین سفارش‌ها</strong><span>۱۰ سفارش اخیر</span></div></div>
        @forelse($latestOrders as $order)
            <div class="admin-row">
                <div><strong>#{{ $order->order_number }}</strong><small>{{ $order->user->mobile }}</small></div>
                <div class="row-actions"><span class="status status-on">{{ $order->status }}</span><span class="muted">{{ number_format($order->total_amount) }} {{ $order->currency }}</span></div>
            </div>
        @empty
            <div class="empty-box">هنوز سفارشی ثبت نشده است.</div>
        @endforelse
    </div>
</section>
@endsection
