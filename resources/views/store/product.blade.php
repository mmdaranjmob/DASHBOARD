@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:42px">
    <div class="card" style="max-width:850px;margin:auto">
        <div class="product-img" style="height:260px;margin-bottom:22px">
            @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}">
            @else
                محصول
            @endif
        </div>
        <div class="muted">{{ $product->category?->name }}</div>
        <h1>{{ $product->name }}</h1>
        @if($product->description)<p class="muted" style="line-height:2">{{ $product->description }}</p>@endif
        <div class="price" style="margin:18px 0">{{ number_format($product->price) }} {{ $product->currency === 'IRR' ? 'ریال' : $product->currency }}</div>

        @if($errors->has('purchase'))
            <div class="errors">{{ $errors->first('purchase') }}</div>
        @endif

        <div class="card" style="background:#f8fafc;border:1px solid #e7eaf0;margin-top:18px">
            <h3 style="margin-top:0">سبد خرید</h3>
            <form method="POST" action="{{ route('cart.add', $product) }}">
                @csrf
                <div class="form-group">
                    <label for="quantity">تعداد</label>
                    <input id="quantity" type="number" name="quantity" value="1" min="1" max="20">
                </div>
                <button class="btn btn-dark" type="submit">🛒 افزودن به سبد خرید</button>
                <a class="btn" href="{{ route('cart.index') }}">مشاهده سبد</a>
            </form>
        </div>

        @auth
            <form method="POST" action="{{ route('product.purchase', $product) }}" class="card" style="background:#fff;border:1px solid #e7eaf0;margin-top:14px">
                @csrf
                <input type="hidden" name="idempotency_key" value="{{ (string) \Illuminate\Support\Str::uuid() }}">
                @if($product->fields->isNotEmpty())
                    <h3 style="margin-top:0">خرید فوری با کیف پول</h3>
                    @foreach($product->fields as $field)
                        <div class="form-group">
                            <label for="field_{{ $field->key }}">{{ $field->name }} @if($field->is_required)<span style="color:#b91c1c">*</span>@endif</label>
                            @if($field->type === 'select')
                                <select id="field_{{ $field->key }}" name="fields[{{ $field->key }}]" style="width:100%;padding:13px 14px;border:1px solid #d9dde7;border-radius:12px" @required($field->is_required)>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($field->options->where('is_active', true) as $option)
                                        <option value="{{ $option->value }}" @selected(old('fields.' . $field->key) === $option->value)>{{ $option->label }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input id="field_{{ $field->key }}" type="text" name="fields[{{ $field->key }}]" value="{{ old('fields.' . $field->key) }}" @required($field->is_required)>
                            @endif
                            @if($field->description)<div class="muted" style="margin-top:6px">{{ $field->description }}</div>@endif
                        </div>
                    @endforeach
                @endif
                <button class="btn btn-dark" type="submit">خرید مستقیم با کیف پول</button>
                <a class="btn" href="{{ route('account.dashboard') }}">کیف پول: {{ number_format(auth()->user()->wallet?->balance ?? 0) }} ریال</a>
            </form>
        @else
            <p class="muted" style="margin-top:18px">برای ثبت سفارش مستقیم با کیف پول، ابتدا وارد حساب شوید.</p>
        @endauth
        <a class="btn" href="{{ route('home') }}">بازگشت به فروشگاه</a>
    </div>
</section>
@endsection
