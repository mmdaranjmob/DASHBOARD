@extends('layouts.store')
@section('content')
<section class="admin-section">
    <div class="admin-head">
        <div><div class="admin-kicker">ظاهر فروشگاه</div><h1>تنظیمات ویترین</h1><p>لوگو، بنر و لینک پشتیبانی صفحه اصلی را بدون تغییر کد کنترل کن.</p></div>
        <a class="btn btn-soft" href="{{ route('admin.dashboard') }}">بازگشت به پنل</a>
    </div>

    <div class="admin-panel admin-form-panel" style="max-width:900px">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group"><label>نام فروشگاه</label><input name="site_name" value="{{ old('site_name', $siteName) }}" required></div>
                <div class="form-group"><label>متن دکمه پشتیبانی</label><input name="support_label" value="{{ old('support_label', $supportLabel) }}" required></div>
                <div class="form-group form-span-2"><label>آدرس لوگو</label><input name="logo_url" value="{{ old('logo_url', $logoUrl) }}" placeholder="https://.../logo.png"></div>
                <div class="form-group form-span-2"><label>آدرس تصویر بنر</label><input name="banner_url" value="{{ old('banner_url', $bannerUrl) }}" placeholder="https://.../banner.webp"></div>
                <div class="form-group form-span-2"><label>لینک بنر</label><input name="banner_link" value="{{ old('banner_link', $bannerLink) }}" placeholder="https://..."></div>
                <div class="form-group form-span-2"><label>لینک پشتیبانی</label><input name="support_url" value="{{ old('support_url', $supportUrl) }}" placeholder="https://t.me/..."></div>
            </div>

            @if($bannerUrl)
                <div class="settings-preview"><span>پیش‌نمایش بنر</span><img src="{{ $bannerUrl }}" alt="Banner preview"></div>
            @endif
            <div class="form-actions"><button class="btn btn-dark">ذخیره تنظیمات</button><a class="btn btn-soft" href="{{ route('home') }}">مشاهده فروشگاه</a></div>
        </form>
    </div>
</section>
@endsection
