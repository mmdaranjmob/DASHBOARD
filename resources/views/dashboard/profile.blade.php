@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:34px">
    <div class="form-box" style="margin-top:10px">
        <div class="muted">حساب کاربری</div>
        <h1 style="margin:5px 0 22px">پروفایل</h1>
        <form method="POST" action="{{ route('account.profile.update') }}">
            @csrf
            @method('PUT')
            <div class="form-group"><label>نام و نام خانوادگی</label><input name="name" value="{{ old('name', $user->name) }}" placeholder="نام شما"></div>
            <div class="form-group"><label>شماره موبایل</label><input value="{{ $user->mobile }}" disabled dir="ltr"></div>
            <div class="form-group"><label>کد ملی</label><input value="{{ $user->national_id }}" disabled dir="ltr"></div>
            <div class="form-group"><label>ایمیل</label><input name="email" type="email" value="{{ old('email', $user->email) }}" placeholder="example@email.com" dir="ltr"></div>
            <button class="btn btn-dark" type="submit">ذخیره تغییرات</button>
            <a class="btn" href="{{ route('account.dashboard') }}">انصراف</a>
        </form>
    </div>
</section>
@endsection
