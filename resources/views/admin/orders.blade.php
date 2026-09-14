@extends('layouts.store')
@section('content')
<section class="section">
    <div class="section-head"><h2>مدیریت سفارش‌ها</h2><a class="btn btn-dark" href="{{ route('admin.dashboard') }}">پنل</a></div>
    @foreach($orders as $order)
        <div class="card" style="margin-bottom:14px">
            <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap"><strong>#{{ $order->order_number }}</strong><span>{{ $order->user->mobile }}</span><span>{{ number_format($order->total_amount) }} {{ $order->currency }}</span></div>
            <div class="muted" style="margin:8px 0">محصول: {{ $order->items->pluck('product_name')->join('، ') }}</div>
            <form method="POST" action="{{ route('admin.orders.update', $order) }}" style="display:grid;gap:8px"><div style="display:flex;gap:8px;flex-wrap:wrap"><select name="status"><option value="pending" @selected($order->status==='pending')>در انتظار</option><option value="paid" @selected($order->status==='paid')>پرداخت‌شده</option><option value="processing" @selected($order->status==='processing')>در حال پردازش</option><option value="completed" @selected($order->status==='completed')>تکمیل‌شده</option><option value="cancelled" @selected($order->status==='cancelled')>لغوشده</option><option value="refunded" @selected($order->status==='refunded')>مرجوع‌شده</option></select><input name="admin_note" value="{{ $order->admin_note }}" placeholder="یادداشت مدیر" style="flex:1"><button class="btn btn-dark">ذخیره</button></div>@csrf @method('PUT')</form>
        </div>
    @endforeach
    {{ $orders->links() }}
</section>
@endsection
