@extends('layouts.store')

@section('content')
<section style="min-height:calc(100vh - 150px);display:grid;place-items:center;padding:44px 0">
    <div class="form-box" style="width:100%;max-width:560px;margin:0">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:26px">
            <span class="brandmark" style="flex:0 0 auto;color:#fff">D</span>
            <div><div style="font-weight:900;font-size:22px">ورود به DASHBOARD</div><div class="muted" style="margin-top:4px">حساب شما، خریدهای شما، همه در یک جا</div></div>
        </div>

        @if($step === 'identify')
            <div style="margin-bottom:26px"><h1 style="margin:0 0 9px;font-size:30px">خوش آمدی 👋</h1><p class="muted" style="margin:0;line-height:2">شماره موبایل و کد ملی را وارد کن.<br>اگر عضو باشی، مستقیم وارد حساب می‌شوی.</p></div>
            <form method="POST" action="{{ route('auth.identify') }}">
                @csrf
                <div class="form-group"><label for="mobile">شماره موبایل</label><input id="mobile" name="mobile" value="{{ old('mobile', $mobile) }}" inputmode="tel" autocomplete="tel" placeholder="09123456789" required autofocus></div>
                <div class="form-group"><label for="national_id">کد ملی</label><input id="national_id" name="national_id" value="{{ old('national_id', $nationalId) }}" inputmode="numeric" maxlength="10" autocomplete="off" placeholder="۱۰ رقم کد ملی" required></div>
                <button class="btn btn-primary" type="submit" style="width:100%">ادامه <span>←</span></button>
            </form>
            <div style="display:flex;gap:10px;margin-top:22px;flex-wrap:wrap"><span class="badge">🔒 اطلاعات امن</span><span class="badge">⚡ ورود سریع</span><span class="badge">✦ بدون مراحل اضافه</span></div>
        @else
            <div style="padding:15px 17px;border-radius:16px;background:#f3f1ff;border:1px solid #e4e0ff;color:#5147c8;margin-bottom:22px">حسابی با این مشخصات پیدا نشد؛ فقط چند مورد دیگر را کامل کن تا حساب ساخته شود.</div>
            <form method="POST" action="{{ route('auth.complete') }}">
                @csrf
                <input type="hidden" name="mobile" value="{{ $mobile }}"><input type="hidden" name="national_id" value="{{ $nationalId }}">
                <div class="card" style="margin-bottom:20px;background:#fafaff;box-shadow:none"><div class="muted">شماره موبایل</div><strong style="display:block;margin-top:5px;direction:ltr;text-align:right">{{ $mobile }}</strong><div class="muted" style="margin-top:12px">کد ملی</div><strong style="display:block;margin-top:5px">{{ $nationalId }}</strong></div>
                <div class="form-group"><label for="name">نام و نام خانوادگی</label><input id="name" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="نام و نام خانوادگی" required autofocus></div>
                <div class="form-group"><label for="password">رمز عبور</label><input id="password" type="password" name="password" minlength="6" autocomplete="new-password" placeholder="حداقل ۶ کاراکتر" required></div>
                <div class="form-group"><label for="password_confirmation">تکرار رمز عبور</label><input id="password_confirmation" type="password" name="password_confirmation" minlength="6" autocomplete="new-password" placeholder="رمز عبور را دوباره وارد کن" required></div>
                <button class="btn btn-primary" type="submit" style="width:100%">ساخت حساب و ورود <span>←</span></button>
            </form>
            <div style="text-align:center;margin-top:17px"><a href="{{ route('auth') }}" class="muted">← بازگشت و تغییر مشخصات</a></div>
        @endif
    </div>
</section>
@endsection
