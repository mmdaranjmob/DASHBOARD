@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:34px">
    <div class="section-head">
        <div><div class="muted">حساب کاربری</div><h1 style="margin:4px 0 0">سفارش‌های من</h1></div>
        <a class="btn btn-dark" href="{{ route('account.dashboard') }}">داشبورد</a>
    </div>

    @if($orders->isEmpty())
        <div class="empty">هنوز سفارشی ثبت نکرده‌اید.</div>
    @else
        <div class="card" style="padding:0;overflow:auto">
            <table style="width:100%;border-collapse:collapse;min-width:720px">
                <thead><tr style="background:#f8fafc">
                    <th style="padding:14px;text-align:right">شماره سفارش</th>
                    <th style="padding:14px;text-align:right">محصول</th>
                    <th style="padding:14px;text-align:right">مبلغ</th>
                    <th style="padding:14px;text-align:right">وضعیت</th>
                    <th style="padding:14px;text-align:right">تاریخ</th>
                    <th style="padding:14px"></th>
                </tr></thead>
                <tbody>
                @foreach($orders as $order)
                    <tr style="border-top:1px solid #edf0f5">
                        <td style="padding:14px">{{ $order->order_number }}</td>
                        <td style="padding:14px">{{ $order->items->first()?->product_name ?? '—' }}</td>
                        <td style="padding:14px">{{ number_format($order->total_amount) }} {{ $order->currency === 'IRR' ? 'ریال' : $order->currency }}</td>
                        <td style="padding:14px">{{ match($order->status) { 'pending' => 'در انتظار', 'processing' => 'در حال پردازش', 'completed' => 'تکمیل‌شده', 'failed' => 'ناموفق', 'refunded' => 'مرجوع‌شده', default => $order->status } }}</td>
                        <td style="padding:14px">{{ $order->created_at?->format('Y/m/d H:i') }}</td>
                        <td style="padding:14px"><a class="btn btn-dark" href="{{ route('account.orders.show', $order) }}">جزئیات</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top:18px">{{ $orders->links() }}</div>
    @endif
</section>
@endsection
