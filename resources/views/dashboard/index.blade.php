@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:42px">
    <div class="card" style="background:linear-gradient(135deg,#0b1020,#211b55);color:#fff;padding:32px;margin-bottom:20px;overflow:hidden;position:relative">
        <div style="position:absolute;width:260px;height:260px;border-radius:50%;background:radial-gradient(circle,rgba(109,93,252,.35),transparent 70%);left:-70px;top:-110px"></div>
        <div class="muted" style="color:#aeb6c8">پنل شخصی</div>
        <h1 style="margin:7px 0 8px;font-size:34px">سلام {{ $user->name ?: 'دوست عزیز' }} 👋</h1>
        <p style="color:#cbd5e1;margin:0;line-height:1.9">از اینجا خریدها، کیف پول، سفارش‌ها و پشتیبانی خودت را مدیریت کن.</p>
    </div>

    <div class="stats-grid" style="margin-bottom:20px">
        <div class="card stat"><div class="muted">موجودی کیف پول</div><div class="value">{{ number_format($user->wallet?->balance ?? 0) }}</div><div class="muted">ریال</div></div>
        <div class="card stat"><div class="muted">سفارش‌ها</div><div class="value">{{ $user->orders()->count() }}</div><div class="muted">سفارش ثبت‌شده</div></div>
        <div class="card stat"><div class="muted">شماره موبایل</div><div class="value" style="font-size:21px;direction:ltr;text-align:right">{{ $user->mobile }}</div><div class="muted">حساب فعال</div></div>
    </div>

    <div class="section-head"><div><h2>دسترسی سریع</h2><p>همه‌چیز دم دستت.</p></div></div>
    <div class="grid" style="margin-bottom:30px">
        <a class="card" href="{{ route('home') }}"><div style="font-size:25px">🛍️</div><strong style="display:block;margin-top:12px">فروشگاه</strong><div class="muted" style="margin-top:6px">خرید خدمات جدید</div></a>
        <a class="card" href="{{ route('cart.index') }}"><div style="font-size:25px">🛒</div><strong style="display:block;margin-top:12px">سبد خرید</strong><div class="muted" style="margin-top:6px">مشاهده اقلام انتخابی</div></a>
        <a class="card" href="{{ route('account.orders') }}"><div style="font-size:25px">📦</div><strong style="display:block;margin-top:12px">سفارش‌ها</strong><div class="muted" style="margin-top:6px">پیگیری سفارش‌ها</div></a>
        <a class="card" href="{{ route('account.transactions') }}"><div style="font-size:25px">💳</div><strong style="display:block;margin-top:12px">تراکنش‌ها</strong><div class="muted" style="margin-top:6px">سوابق مالی کیف پول</div></a>
        <a class="card" href="{{ route('account.tickets') }}"><div style="font-size:25px">🎧</div><strong style="display:block;margin-top:12px">پشتیبانی</strong><div class="muted" style="margin-top:6px">ثبت و پیگیری تیکت</div></a>
        <a class="card" href="{{ route('account.profile') }}"><div style="font-size:25px">✏️</div><strong style="display:block;margin-top:12px">ویرایش پروفایل</strong><div class="muted" style="margin-top:6px">اطلاعات حساب کاربری</div></a>
    </div>

    <div class="section-head"><div><h2>آخرین سفارش‌ها</h2><p>خلاصه فعالیت اخیر.</p></div><a class="btn btn-soft" href="{{ route('account.orders') }}">همه سفارش‌ها ←</a></div>
    @if($orders->isEmpty())
        <div class="empty">هنوز سفارشی ثبت نکرده‌ای. <a href="{{ route('home') }}" style="font-weight:800;color:#6355e8">شروع خرید →</a></div>
    @else
        <div class="card" style="padding:0;overflow:auto">
            <table style="width:100%;border-collapse:collapse;min-width:650px"><thead><tr style="background:#fafaff"><th style="padding:15px;text-align:right">شماره</th><th style="padding:15px;text-align:right">مبلغ</th><th style="padding:15px;text-align:right">وضعیت</th><th style="padding:15px;text-align:right">تاریخ</th><th></th></tr></thead><tbody>
            @foreach($orders as $order)<tr style="border-top:1px solid #edf0f5"><td style="padding:15px;font-weight:800">{{ $order->order_number }}</td><td style="padding:15px">{{ number_format($order->total_amount) }} ریال</td><td style="padding:15px">{{ match($order->status){'pending'=>'در انتظار','paid'=>'پرداخت‌شده','processing'=>'در حال پردازش','completed'=>'تکمیل‌شده','cancelled'=>'لغوشده','refunded'=>'مرجوع‌شده',default=>$order->status} }}</td><td style="padding:15px">{{ $order->created_at?->format('Y/m/d H:i') }}</td><td style="padding:15px"><a class="btn btn-soft" href="{{ route('account.orders.show',$order) }}">جزئیات</a></td></tr>@endforeach
            </tbody></table>
        </div>
    @endif
</section>
@endsection
