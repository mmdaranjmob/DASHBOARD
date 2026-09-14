@extends('layouts.store')

@section('content')
<div class="form-box">
    <h1 style="margin-top:0">ساخت حساب</h1>
    <p class="muted">برای شروع خرید، اطلاعات خود را وارد کنید.</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group"><label for="name">نام و نام خانوادگی</label><input id="name" name="name" value="{{ old('name') }}"></div>
        <div class="form-group"><label for="mobile">شماره موبایل</label><input id="mobile" name="mobile" value="{{ old('mobile') }}" required></div>
        <div class="form-group"><label for="national_id">کد ملی</label><input id="national_id" name="national_id" value="{{ old('national_id') }}" maxlength="10" required></div>
        <div class="form-group"><label for="password">رمز عبور</label><input id="password" type="password" name="password" required></div>
        <div class="form-group"><label for="password_confirmation">تکرار رمز عبور</label><input id="password_confirmation" type="password" name="password_confirmation" required></div>
        <button class="btn btn-dark" type="submit">ثبت‌نام</button>
    </form>
    <p class="muted" style="margin-bottom:0">قبلاً ثبت‌نام کرده‌اید؟ <a href="{{ route('login') }}" style="font-weight:700">ورود</a></p>
</div>
@endsection
