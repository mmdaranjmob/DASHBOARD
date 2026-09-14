@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:34px">
    <div class="section-head">
        <div>
            <div class="muted">حساب کاربری</div>
            <h1 style="margin:4px 0 0">سلام {{ $user->name ?: 'دوست عزیز' }} 👋</h1>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
            <a class="btn btn-dark" href="{{ route('account.profile') }}">✏️ ویرایش پروفایل</a>
            <a class="btn btn-dark" href="{{ route('home') }}">بازگشت به فروشگاه</a>
        </div>
    </div>

    <div class="grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:18px">
        <div class="card"><div class="muted">موجودی کیف پول</div><div style="font-size:28px;font-weight:900;margin-top:8px">{{ number_format($user->wallet?->balance ?? 0) }}</div><div class="muted" style="margin-top:4px">ریال</div></div>
        <div class="card"><div class="muted">تعداد سفارش‌ها</div><div style="font-size:28px;font-weight:900;margin-top:8px">{{ $user->orders()->count() }}</div><div class="muted" style="margin-top:4px">سفارش ثبت‌شده</div></div>
        <div class="card"><div class="muted">شماره موبایل</div><div style="font-size:22px;font-weight:900;margin-top:8px;direction:ltr;text-align:right">{{ $user->mobile }}</div><div class="muted" style="margin-top:4px">حساب فعال</div></div>
    </div>

    <div class="grid" style="grid-template-columns:repeat(5,1fr);margin-bottom:28px">
        <a class="card" href="{{ route('home') }}"><strong>🛍️ خرید خدمات</strong><div class="muted" style="margin-top:8px">مشاهده محصولات</div></a>
        <a class="card" href="{{ route('account.orders') }}"><strong>📦 سفارش‌ها</strong><div class="muted" style="margin-top:8px">سوابق خرید</div></a>
        <a class="card" href="{{ route('account.tickets') }}"><strong>🎧 پشتیبانی</strong><div class="muted" style="margin-top:8px">ثبت و پیگیری تیکت</div></a>
        <a class="card" href="{{ route('account.transactions') }}"><strong>📒 تراکنش‌ها</strong><div class="muted" style="margin-top:8px">سوابق مالی</div></a>
        <a class="card" href="{{ route('account.profile') }}"><strong>👤 پروفایل</strong><div class="muted" style="margin-top:8px">ویرایش اطلاعات</div></a>
    </div>

    <div class="section-head"><h2>آخرین سفارش‌ها</h2><a class="muted" href="{{ route('account.orders') }}">مشاهده همه</a></div>

    @if($orders->isEmpty())
        <div class="empty">هنوز سفارشی ثبت نکرده‌اید.</div>
    @else
        <div class="card" style="padding:0;overflow:auto">
            <table style="width:100%;border-collapse:collapse;min-width:620px">
                <thead><tr style="background:#f8fafc"><th style="padding:14px;text-align:right">شماره سفارش</th><th style="padding:14px;text-align:right">مبلغ</th><th style="padding:14px;text-align:right">وضعیت</th><th style="padding:14px;text-align:right">تاریخ</th></tr></thead>
                <tbody>
                @foreach($orders as $order)
                    <tr style="border-top:1px solid #edf0f5">
                        <td style="padding:14px"><a href="{{ route('account.orders.show', $order) }}">{{ $order->order_number }}</a></td>
                        <td style="padding:14px">{{ number_format($order->total_amount) }} {{ $order->currency === 'IRR' ? 'ریال' : $order->currency }}</td>
                        <td style="padding:14px">{{ match($order->status) { 'pending' => 'در انتظار', 'paid' => 'پرداخت‌شده', 'processing' => 'در حال پردازش', 'completed' => 'تکمیل‌شده', 'cancelled' => 'لغوشده', 'refunded' => 'مرجوع‌شده', default => $order->status } }}</td>
                        <td style="padding:14px">{{ $order->created_at?->format('Y/m/d H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
@endsection
