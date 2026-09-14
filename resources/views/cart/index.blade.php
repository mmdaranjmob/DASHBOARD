@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:36px">
    <div class="section-head">
        <div>
            <div class="muted">خرید</div>
            <h1 style="margin:4px 0 0">🛒 سبد خرید</h1>
        </div>
        <a class="btn btn-dark" href="{{ route('home') }}">ادامه خرید</a>
    </div>

    @if($items->isEmpty())
        <div class="empty">سبد خرید شما خالی است.</div>
    @else
        <div style="display:grid;grid-template-columns:1fr 330px;gap:18px;align-items:start">
            <div style="display:grid;gap:14px">
                @foreach($items as $item)
                    <div class="card" style="display:flex;gap:16px;align-items:center;justify-content:space-between">
                        <div style="display:flex;gap:14px;align-items:center;min-width:0">
                            <div class="product-img" style="width:105px;height:85px;flex:0 0 105px">
                                @if($item['product']->image)
                                    <img src="{{ $item['product']->image }}" alt="{{ $item['product']->name }}">
                                @else
                                    محصول
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('product.show', $item['product']) }}" style="font-weight:800;font-size:18px">{{ $item['product']->name }}</a>
                                <div class="muted" style="margin-top:7px">{{ number_format($item['product']->price) }} {{ $item['product']->currency === 'IRR' ? 'ریال' : $item['product']->currency }} برای هر عدد</div>
                                <div style="margin-top:10px;font-weight:800">جمع: {{ number_format($item['total']) }} {{ $item['product']->currency === 'IRR' ? 'ریال' : $item['product']->currency }}</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:flex-end">
                            <form method="POST" action="{{ route('cart.update', $item['product']) }}" style="display:flex;gap:6px;align-items:center">
                                @csrf @method('PUT')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="20" style="width:85px;padding:10px;border:1px solid #d9dde7;border-radius:10px">
                                <button class="btn btn-dark" type="submit">بروزرسانی</button>
                            </form>
                            <form method="POST" action="{{ route('cart.remove', $item['product']) }}">
                                @csrf @method('DELETE')
                                <button class="btn" type="submit">حذف</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card" style="position:sticky;top:20px">
                <div class="muted">خلاصه سبد</div>
                <div style="font-size:30px;font-weight:900;margin:10px 0">{{ number_format($total) }}</div>
                <div class="muted">ریال</div>
                @auth
                    <a class="btn btn-dark" href="{{ route('account.dashboard') }}" style="width:100%;text-align:center;margin-top:16px">ادامه برای ثبت سفارش</a>
                @else
                    <a class="btn btn-dark" href="{{ route('login') }}" style="width:100%;text-align:center;margin-top:16px">ورود / عضویت</a>
                @endauth
            </div>
        </div>
    @endif
</section>
@endsection
