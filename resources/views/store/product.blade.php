@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:44px">
    <div style="display:grid;grid-template-columns:1.05fr .95fr;gap:24px;align-items:start">
        <div class="card" style="padding:14px">
            <div class="product-img" style="height:520px;border-radius:20px">
                @if($product->image)<img src="{{ $product->image }}" alt="{{ $product->name }}">@else<span style="font-size:70px;font-weight:900;color:#8277f2">✦</span>@endif
            </div>
        </div>
        <div class="card" style="padding:30px">
            <div class="product-meta"><span class="badge">{{ $product->category?->name ?? 'محصول دیجیتال' }}</span><span class="badge">{{ $product->delivery_type === 'automatic' ? 'تحویل خودکار' : 'تحویل دستی' }}</span></div>
            <h1 style="font-size:38px;line-height:1.3;margin:18px 0 12px;letter-spacing:-1px">{{ $product->name }}</h1>
            @if($product->description)<p class="muted" style="font-size:16px;line-height:2.1;margin:0 0 20px">{{ $product->description }}</p>@endif
            <div class="price" style="font-size:32px;margin:18px 0">{{ number_format($product->price) }} <small style="font-size:14px;color:#64748b">{{ $product->currency === 'IRR' ? 'ریال' : $product->currency }}</small></div>
            @if($product->old_price)<div class="muted" style="text-decoration:line-through;margin-top:-12px;margin-bottom:20px">{{ number_format($product->old_price) }} {{ $product->currency }}</div>@endif

            <div class="card" style="background:#fafaff;box-shadow:none;margin-top:20px">
                <div style="font-weight:900;margin-bottom:14px">🛒 افزودن به سبد</div>
                <form method="POST" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <div style="display:flex;gap:10px;align-items:end">
                        <div class="form-group" style="flex:0 0 120px;margin:0"><label for="quantity">تعداد</label><input id="quantity" type="number" name="quantity" value="1" min="1" max="20"></div>
                        <button class="btn btn-primary" style="flex:1" type="submit">افزودن به سبد خرید</button>
                    </div>
                </form>
                <a class="btn btn-soft" style="width:100%;margin-top:10px" href="{{ route('cart.index') }}">مشاهده سبد خرید</a>
            </div>

            @auth
                <form method="POST" action="{{ route('product.purchase', $product) }}" class="card" style="background:#fff;box-shadow:none;margin-top:12px">
                    @csrf
                    <input type="hidden" name="idempotency_key" value="{{ (string) \Illuminate\Support\Str::uuid() }}">
                    @if($product->fields->isNotEmpty())
                        <h3 style="margin-top:0">اطلاعات سفارش</h3>
                        @foreach($product->fields as $field)
                            <div class="form-group"><label for="field_{{ $field->key }}">{{ $field->name }} @if($field->is_required)<span style="color:#be123c">*</span>@endif</label>
                                @if($field->type === 'select')
                                    <select id="field_{{ $field->key }}" name="fields[{{ $field->key }}]" @required($field->is_required)><option value="">انتخاب کنید</option>@foreach($field->options->where('is_active',true) as $option)<option value="{{ $option->value }}">{{ $option->label }}</option>@endforeach</select>
                                @else<input id="field_{{ $field->key }}" type="text" name="fields[{{ $field->key }}]" @required($field->is_required)>@endif
                                @if($field->description)<div class="muted" style="margin-top:6px">{{ $field->description }}</div>@endif
                            </div>
                        @endforeach
                    @endif
                    <button class="btn btn-dark" type="submit" style="width:100%">خرید مستقیم با کیف پول</button>
                    <div class="muted" style="text-align:center;margin-top:10px">موجودی کیف پول: {{ number_format(auth()->user()->wallet?->balance ?? 0) }} ریال</div>
                </form>
            @else
                <a class="btn btn-dark" style="width:100%;margin-top:14px" href="{{ route('auth') }}">ورود / عضویت برای خرید</a>
            @endauth
            <a class="muted" style="display:block;text-align:center;margin-top:18px" href="{{ route('home') }}">← بازگشت به فروشگاه</a>
        </div>
    </div>
</section>
<style>@media(max-width:780px){section .card+ .card{padding:22px}section .section>div{grid-template-columns:1fr!important}.product-img{height:360px!important}}
</style>
@endsection
