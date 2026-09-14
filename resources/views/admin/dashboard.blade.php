@extends('layouts.store')
@section('content')
<section class="admin-section">
    <div class="admin-head">
        <div><div class="admin-kicker">مدیریت فروشگاه</div><h1>پنل مدیریت</h1><p>محتوا، دسته‌ها، خدمات، سفارش‌ها و کاربران را از یکجا کنترل کن.</p></div>
        <a class="btn btn-primary" href="{{ route('home') }}">مشاهده فروشگاه</a>
    </div>

    <div class="grid" style="grid-template-columns:repeat(4,minmax(0,1fr));margin-bottom:16px">
        <div class="admin-panel"><div class="muted">کاربران</div><div class="stat-number">{{ number_format($stats['users']) }}</div></div>
        <div class="admin-panel"><div class="muted">کل سفارش‌ها</div><div class="stat-number">{{ number_format($stats['orders']) }}</div></div>
        <div class="admin-panel"><div class="muted">در انتظار</div><div class="stat-number">{{ number_format($stats['pending_orders']) }}</div></div>
        <div class="admin-panel"><div class="muted">فروش ثبت‌شده</div><div class="stat-number">{{ number_format($stats['revenue']) }} ریال</div></div>
    </div>

    <div class="admin-panel">
        <div class="panel-title"><div><strong>مدیریت سریع</strong><span>هر بخش را مستقیم باز کن.</span></div></div>
        <div class="admin-quick-grid">
            <a class="admin-quick" href="{{ route('admin.settings') }}"><b>ظاهر فروشگاه</b><span>نام، لوگو، بنر و پشتیبانی</span></a>
            <a class="admin-quick" href="{{ route('admin.categories') }}"><b>دسته‌بندی‌ها</b><span>افزودن و ویرایش منوها</span></a>
            <a class="admin-quick" href="{{ route('admin.products') }}"><b>خدمات / محصولات</b><span>قیمت، تصویر، فیلد و وضعیت</span></a>
            <a class="admin-quick" href="{{ route('admin.users') }}"><b>کاربران</b><span>حساب‌ها و شارژ کیف پول</span></a>
            <a class="admin-quick" href="{{ route('admin.orders') }}"><b>سفارش‌ها</b><span>وضعیت و یادداشت مدیریت</span></a>
            <a class="admin-quick" href="{{ route('admin.tickets') }}"><b>تیکت‌ها</b><span>پاسخ و تغییر وضعیت</span></a>
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
