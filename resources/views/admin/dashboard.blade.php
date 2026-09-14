@extends('layouts.store')
@section('content')
<section class="section">
    <div class="section-head"><h2>پنل مدیریت</h2><a class="btn btn-dark" href="{{ route('home') }}">مشاهده فروشگاه</a></div>
    <div class="grid" style="grid-template-columns:repeat(4,1fr)">
        <div class="card"><div class="muted">کاربران</div><div class="price">{{ number_format($stats['users']) }}</div></div>
        <div class="card"><div class="muted">کل سفارش‌ها</div><div class="price">{{ number_format($stats['orders']) }}</div></div>
        <div class="card"><div class="muted">سفارش‌های در انتظار</div><div class="price">{{ number_format($stats['pending_orders']) }}</div></div>
        <div class="card"><div class="muted">فروش ثبت‌شده</div><div class="price">{{ number_format($stats['revenue']) }} ریال</div></div>
    </div>
    <div class="card" style="margin-top:18px">
        <div class="navlinks" style="margin-bottom:18px">
            <a class="btn btn-dark" href="{{ route('admin.users') }}">کاربران</a>
            <a class="btn btn-dark" href="{{ route('admin.products') }}">محصولات</a>
            <a class="btn btn-dark" href="{{ route('admin.categories') }}">دسته‌بندی‌ها</a>
            <a class="btn btn-dark" href="{{ route('admin.orders') }}">سفارش‌ها</a>
        </div>
        <h3>آخرین سفارش‌ها</h3>
        @forelse($latestOrders as $order)
            <div style="padding:12px 0;border-bottom:1px solid #eee;display:flex;justify-content:space-between;gap:12px">
                <span>#{{ $order->order_number }} — {{ $order->user->mobile }}</span>
                <span>{{ number_format($order->total_amount) }} {{ $order->currency }} — {{ $order->status }}</span>
            </div>
        @empty <div class="empty">هنوز سفارشی ثبت نشده است.</div> @endforelse
    </div>
</section>
@endsection
