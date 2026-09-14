@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:34px">
    <div class="section-head">
        <div><div class="muted">سفارش {{ $order->order_number }}</div><h1 style="margin:4px 0 0">جزئیات سفارش</h1></div>
        <a class="btn btn-dark" href="{{ route('account.orders') }}">سفارش‌های من</a>
    </div>

    <div class="card" style="margin-bottom:18px">
        <div class="grid" style="grid-template-columns:repeat(3,1fr)">
            <div><div class="muted">مبلغ</div><strong style="font-size:21px">{{ number_format($order->total_amount) }} {{ $order->currency === 'IRR' ? 'ریال' : $order->currency }}</strong></div>
            <div><div class="muted">وضعیت</div><strong>{{ match($order->status) { 'pending' => 'در انتظار', 'processing' => 'در حال پردازش', 'completed' => 'تکمیل‌شده', 'failed' => 'ناموفق', 'refunded' => 'مرجوع‌شده', default => $order->status } }}</strong></div>
            <div><div class="muted">تاریخ</div><strong>{{ $order->created_at?->format('Y/m/d H:i') }}</strong></div>
        </div>
    </div>

    <div class="card">
        <h2 style="margin-top:0">اقلام سفارش</h2>
        @foreach($order->items as $item)
            <div style="padding:15px 0;border-top:1px solid #edf0f5;display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap">
                <div><strong>{{ $item->product_name }}</strong><div class="muted">تعداد: {{ $item->quantity }}</div></div>
                <div style="font-weight:800">{{ number_format($item->total_price) }} {{ $order->currency === 'IRR' ? 'ریال' : $order->currency }}</div>
            </div>
        @endforeach
    </div>
</section>
@endsection
