@extends('layouts.store')
@section('content')
<style>
.admin-dashboard{direction:rtl;min-height:calc(100vh - 40px);background:#07090d;color:#eef2f7;padding:28px;max-width:1400px;margin:auto}
.admin-dashboard *{box-sizing:border-box}.ad-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px}.ad-title h1{margin:0;font-size:27px;color:#f4f6f8}.ad-title p{margin:7px 0 0;color:#747e8e;font-size:11px}.ad-actions{display:flex;gap:8px}.ad-btn{display:inline-flex;align-items:center;text-decoration:none;padding:10px 14px;border-radius:10px;border:1px solid #252b35;color:#cdd4de;background:#10141b;font-size:11px;font-weight:700}.ad-btn.primary{background:#f0f3f6;color:#090b10;border-color:#f0f3f6}
.ad-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:13px}.ad-card{background:#0d1118;border:1px solid #202630;border-radius:15px}.stat{padding:17px;min-height:125px}.stat .lab{color:#737d8d;font-size:10px}.stat .val{font-size:26px;font-weight:850;margin:12px 0 6px}.stat .sub{font-size:10px;color:#62d29a}.stat .sub.warn{color:#e6b66b}.stat .ico{float:left;width:35px;height:35px;border-radius:10px;background:#171c25;display:grid;place-items:center;color:#cfd5dd}
.ad-main{display:grid;grid-template-columns:1.55fr .9fr;gap:13px;margin-top:13px}.head{padding:16px 17px;border-bottom:1px solid #1c222b;display:flex;justify-content:space-between;align-items:center}.head h2{font-size:13px;margin:0}.head span,.head a{color:#707a8a;font-size:9px;text-decoration:none}.body{padding:15px 17px}.quick{display:grid;grid-template-columns:repeat(2,1fr);gap:9px}.quick a{display:block;text-decoration:none;color:#d8dee6;padding:14px;border:1px solid #202630;border-radius:11px;background:#10141b}.quick a:hover{background:#151a22}.qico{display:inline-grid;place-items:center;width:30px;height:30px;border-radius:8px;background:#171c25;margin-left:8px}.quick b{font-size:10px}.quick small{display:block;color:#6f7989;font-size:8px;margin-top:6px}.orders{padding:0 17px}.order{display:flex;justify-content:space-between;align-items:center;padding:13px 0;border-bottom:1px solid #181e27;gap:12px}.order:last-child{border-bottom:0}.user{display:flex;gap:9px;align-items:center}.ava{width:34px;height:34px;border-radius:9px;background:#171c25;display:grid;place-items:center;color:#d9dfe6;font-size:11px;font-weight:800}.user b{display:block;font-size:10px}.user small{display:block;color:#6f7989;font-size:8px;margin-top:4px}.meta{display:flex;align-items:center;gap:9px}.amount{font-size:9px;color:#aeb7c3}.pill{font-size:8px;padding:5px 8px;border-radius:20px;background:#15241d;color:#69d49b}.pill.pending{background:#292419;color:#e5b96b}.pill.cancel{background:#29191b;color:#e78b8b}.empty{text-align:center;padding:35px;color:#697486;font-size:10px}.note{margin-top:12px;padding:14px;border:1px solid #202630;border-radius:11px;color:#788293;font-size:9px;line-height:1.9}
@media(max-width:1050px){.ad-stats{grid-template-columns:repeat(2,1fr)}.ad-main{grid-template-columns:1fr}}@media(max-width:650px){.admin-dashboard{padding:16px 12px}.ad-top{align-items:flex-start;gap:10px}.ad-actions .ad-btn:first-child{display:none}.ad-stats{grid-template-columns:1fr 1fr}.stat{min-height:108px;padding:13px}.stat .val{font-size:21px}.ad-main{grid-template-columns:1fr}.quick{grid-template-columns:1fr}.order{align-items:flex-start;flex-direction:column}.meta{width:100%;justify-content:space-between}}
</style>
<section class="admin-dashboard">
<div class="ad-top"><div class="ad-title"><h1>داشبورد مدیریت</h1><p>مرکز کنترل فروشگاه، کاربران، سفارش‌ها و پشتیبانی</p></div><div class="ad-actions"><a class="ad-btn" href="{{ route('home') }}">↗ مشاهده فروشگاه</a><a class="ad-btn primary" href="{{ route('admin.products.create') }}">＋ افزودن محصول</a></div></div>
<div class="ad-stats">
<div class="ad-card stat"><span class="ico">♙</span><div class="lab">کاربران</div><div class="val">{{ number_format($stats['users']) }}</div><div class="sub">حساب ثبت‌شده</div></div>
<div class="ad-card stat"><span class="ico">▣</span><div class="lab">کل سفارش‌ها</div><div class="val">{{ number_format($stats['orders']) }}</div><div class="sub">تمام سفارش‌ها</div></div>
<div class="ad-card stat"><span class="ico">◷</span><div class="lab">سفارش‌های در جریان</div><div class="val">{{ number_format($stats['pending_orders']) }}</div><div class="sub warn">نیازمند بررسی</div></div>
<div class="ad-card stat"><span class="ico">◈</span><div class="lab">فروش ثبت‌شده</div><div class="val" style="font-size:20px">{{ number_format($stats['revenue']) }}</div><div class="sub">ریال</div></div>
</div>
<div class="ad-main">
<div class="ad-card"><div class="head"><h2>آخرین سفارش‌ها</h2><a href="{{ route('admin.orders') }}">مشاهده همه ←</a></div><div class="orders">
@forelse($latestOrders as $order)
@php $map=['pending'=>['در انتظار','pending'],'paid'=>['پرداخت‌شده',''],'processing'=>['در حال پردازش',''],'completed'=>['تکمیل‌شده',''],'cancelled'=>['لغوشده','cancel'],'refunded'=>['مرجوع‌شده','cancel']]; [$st,$cl]=$map[$order->status]??[$order->status,'pending']; @endphp
<div class="order"><div class="user"><div class="ava">{{ mb_substr($order->user?->name ?: 'ک',0,1) }}</div><div><b>#{{ $order->order_number }}</b><small>{{ $order->user?->mobile ?: '---' }}</small></div></div><div class="meta"><span class="amount">{{ number_format($order->total_amount) }} {{ $order->currency }}</span><span class="pill {{ $cl }}">{{ $st }}</span></div></div>
@empty<div class="empty">هنوز سفارشی ثبت نشده است.</div>@endforelse
</div></div>
<div class="ad-card"><div class="head"><h2>دسترسی سریع</h2><span>مدیریت</span></div><div class="body"><div class="quick">
<a href="{{ route('admin.products') }}"><span class="qico">▤</span><b>محصولات</b><small>قیمت، موجودی و وضعیت</small></a>
<a href="{{ route('admin.users') }}"><span class="qico">♙</span><b>کاربران</b><small>حساب و کیف پول</small></a>
<a href="{{ route('admin.orders') }}"><span class="qico">▣</span><b>سفارش‌ها</b><small>پیگیری و وضعیت</small></a>
<a href="{{ route('admin.categories') }}"><span class="qico">☷</span><b>دسته‌بندی‌ها</b><small>ساختار فروشگاه</small></a>
<a href="{{ route('admin.tickets') }}"><span class="qico">◈</span><b>تیکت‌ها</b><small>پشتیبانی مشتریان</small></a>
<a href="{{ route('admin.settings') }}"><span class="qico">⚙</span><b>تنظیمات</b><small>ظاهر و تنظیمات سایت</small></a>
</div><div class="note">از این صفحه می‌توانی بخش‌های اصلی فروشگاه را مدیریت کنی. آمارها مستقیماً از داده‌های فعلی سیستم خوانده می‌شوند.</div></div></div>
</div>
</section>
@endsection
