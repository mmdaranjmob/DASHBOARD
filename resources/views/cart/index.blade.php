@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:42px">
    <div class="section-head"><div><div class="muted">مرکز خرید</div><h1 style="margin:4px 0 0;font-size:34px">سبد خرید</h1></div><a class="btn btn-soft" href="{{ route('home') }}">← ادامه خرید</a></div>
    @if($items->isEmpty())
        <div class="empty" style="padding:70px 24px"><div style="font-size:52px;margin-bottom:12px">🛒</div><div style="font-size:20px;font-weight:900;color:#0f172a">سبد خریدت خالیه</div><div style="margin:8px 0 20px">محصولات موردنظرت را انتخاب کن و برگرد اینجا.</div><a class="btn btn-primary" href="{{ route('home') }}">مشاهده فروشگاه</a></div>
    @else
        <div style="display:grid;grid-template-columns:1fr 350px;gap:20px;align-items:start">
            <div style="display:grid;gap:14px">
                @foreach($items as $item)
                    <div class="card" style="display:flex;gap:18px;align-items:center;justify-content:space-between">
                        <div style="display:flex;gap:16px;align-items:center;min-width:0">
                            <a href="{{ route('product.show', $item['product']) }}" class="product-img" style="width:110px;height:94px;flex:0 0 110px">
                                @if($item['product']->image)<img src="{{ $item['product']->image }}" alt="{{ $item['product']->name }}">@else<span style="font-size:34px;color:#8277f2">✦</span>@endif
                            </a>
                            <div style="min-width:0"><a href="{{ route('product.show', $item['product']) }}" style="font-weight:900;font-size:18px">{{ $item['product']->name }}</a><div class="muted" style="margin-top:6px">{{ $item['product']->category?->name }}</div><div style="margin-top:10px;font-weight:900">{{ number_format($item['total']) }} <span class="muted">ریال</span></div></div>
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:flex-end">
                            <form method="POST" action="{{ route('cart.update', $item['product']) }}" style="display:flex;gap:7px;align-items:center">@csrf @method('PUT')<input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="20" style="width:78px;padding:11px;border:1px solid #dfe3eb;border-radius:12px;font:inherit"><button class="btn btn-soft" type="submit">به‌روزرسانی</button></form>
                            <form method="POST" action="{{ route('cart.remove', $item['product']) }}">@csrf @method('DELETE')<button class="btn" type="submit" style="color:#be123c">حذف</button></form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card" style="position:sticky;top:100px;padding:26px;background:linear-gradient(145deg,#fff,#faf9ff)">
                <div class="muted">خلاصه سفارش</div>
                <div style="display:flex;justify-content:space-between;margin:16px 0 10px"><span>تعداد اقلام</span><strong>{{ collect($items)->sum('quantity') }}</strong></div>
                <div style="height:1px;background:#e9ebf2;margin:16px 0"></div>
                <div class="muted">مبلغ نهایی</div><div style="font-size:31px;font-weight:900;margin-top:8px">{{ number_format($total) }} <small style="font-size:13px;color:#64748b">ریال</small></div>
                @auth
                    <a class="btn btn-primary" href="{{ route('account.dashboard') }}" style="width:100%;margin-top:20px">ادامه و ثبت سفارش ←</a>
                @else
                    <a class="btn btn-primary" href="{{ route('auth') }}" style="width:100%;margin-top:20px">ورود / عضویت ←</a>
                @endauth
            </div>
        </div>
    @endif
</section>
<style>@media(max-width:820px){section .section~*{}section>div[style*="grid-template-columns:1fr 350px"]{grid-template-columns:1fr!important}.card[style*="position:sticky"]{position:static!important}.card[style*="display:flex"]{align-items:flex-start!important;flex-direction:column}.card[style*="display:flex"]>div{width:100%}}</style>
@endsection
