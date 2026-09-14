@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:34px">
    <div class="form-box" style="margin-top:10px">
        <div class="muted">حساب کاربری</div>
        <h1 style="margin:5px 0 22px">ویرایش پروفایل</h1>
        <p class="muted" style="line-height:1.8">اطلاعات حساب خودت را می‌توانی از این بخش اصلاح کنی.</p>

        <form method="POST" action="{{ route('account.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group"><label for="name">نام و نام خانوادگی</label><input id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="نام شما"></div>
            <div class="form-group"><label for="mobile">شماره موبایل</label><input id="mobile" name="mobile" value="{{ old('mobile', $user->mobile) }}" maxlength="20" required dir="ltr"></div>
            <div class="form-group"><label for="national_id">کد ملی</label><input id="national_id" name="national_id" value="{{ old('national_id', $user->national_id) }}" maxlength="10" required dir="ltr"></div>
            <div class="form-group"><label for="email">ایمیل</label><input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" placeholder="example@email.com" dir="ltr"></div>

            <button class="btn btn-dark" type="submit">ذخیره تغییرات</button>
            <a class="btn" href="{{ route('account.dashboard') }}">انصراف</a>
        </form>
    </div>
</section>
@endsection
