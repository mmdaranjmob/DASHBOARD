@extends('layouts.store')

@section('content')
<div class="form-box" style="max-width:560px">
    <div style="text-align:center;margin-bottom:26px">
        <div style="font-size:38px;margin-bottom:8px">👋</div>
        <h1 style="margin:0 0 10px">ورود / عضویت</h1>
        @if($step === 'identify')
            <p class="muted" style="margin:0;line-height:1.9">شماره موبایل و کد ملی خود را وارد کنید.<br>اگر قبلاً عضو شده باشید، مستقیم وارد حساب می‌شوید.</p>
        @else
            <p class="muted" style="margin:0;line-height:1.9">حسابی با این مشخصات پیدا نشد.<br>اطلاعات زیر را برای ساخت حساب تکمیل کنید.</p>
        @endif
    </div>

    @if(session('info'))
        <div class="flash">{{ session('info') }}</div>
    @endif

    @if($step === 'identify')
        <form method="POST" action="{{ route('auth.identify') }}">
            @csrf
            <div class="form-group">
                <label for="mobile">شماره موبایل</label>
                <input id="mobile" name="mobile" value="{{ old('mobile', $mobile) }}" inputmode="tel" autocomplete="tel" placeholder="مثلاً 09123456789" required autofocus>
            </div>
            <div class="form-group">
                <label for="national_id">کد ملی</label>
                <input id="national_id" name="national_id" value="{{ old('national_id', $nationalId) }}" inputmode="numeric" maxlength="10" autocomplete="off" placeholder="۱۰ رقم کد ملی" required>
            </div>
            <button class="btn btn-dark" type="submit" style="width:100%">ادامه</button>
        </form>
    @else
        <form method="POST" action="{{ route('auth.complete') }}">
            @csrf
            <input type="hidden" name="mobile" value="{{ $mobile }}">
            <input type="hidden" name="national_id" value="{{ $nationalId }}">

            <div class="card" style="margin-bottom:18px;background:#f8fafc">
                <div class="muted" style="font-size:13px">مشخصات واردشده</div>
                <div style="margin-top:6px;font-weight:800;direction:ltr;text-align:right">{{ $mobile }}</div>
                <div style="margin-top:4px;font-weight:800">کد ملی: {{ $nationalId }}</div>
            </div>

            <div class="form-group">
                <label for="name">نام و نام خانوادگی</label>
                <input id="name" name="name" value="{{ old('name') }}" autocomplete="name" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">رمز عبور</label>
                <input id="password" type="password" name="password" minlength="6" autocomplete="new-password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">تکرار رمز عبور</label>
                <input id="password_confirmation" type="password" name="password_confirmation" minlength="6" autocomplete="new-password" required>
            </div>
            <button class="btn btn-dark" type="submit" style="width:100%">ساخت حساب و ورود</button>
        </form>
        <div style="text-align:center;margin-top:16px">
            <a href="{{ route('auth') }}" class="muted">بازگشت</a>
        </div>
    @endif
</div>
@endsection
