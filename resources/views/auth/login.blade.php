@extends('layouts.store')

@section('content')
<div class="form-box">
    <h1 style="margin-top:0">ورود به حساب</h1>
    <p class="muted">با شماره موبایل وارد حساب خود شوید.</p>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group"><label for="mobile">شماره موبایل</label><input id="mobile" name="mobile" value="{{ old('mobile') }}" required autofocus></div>
        <div class="form-group"><label for="password">رمز عبور</label><input id="password" type="password" name="password" required></div>
        <label style="display:block;margin-bottom:16px"><input type="checkbox" name="remember" value="1"> مرا به خاطر بسپار</label>
        <button class="btn btn-dark" type="submit">ورود</button>
    </form>
    <p class="muted" style="margin-bottom:0">حساب ندارید؟ <a href="{{ route('register') }}" style="font-weight:700">ثبت‌نام کنید</a></p>
</div>
@endsection
