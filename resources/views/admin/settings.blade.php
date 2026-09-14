@extends('layouts.store')
@section('content')
<section class="admin-section">
    <div class="admin-head">
        <div><div class="admin-kicker">ظاهر فروشگاه</div><h1>تنظیمات ویترین</h1><p>لوگو، اسلایدر صفحه اصلی و لینک پشتیبانی را از همین‌جا مدیریت کن.</p></div>
        <a class="btn btn-soft" href="{{ route('admin.dashboard') }}">بازگشت به پنل</a>
    </div>

    <div class="admin-panel admin-form-panel" style="max-width:1000px">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group"><label>نام فروشگاه</label><input name="site_name" value="{{ old('site_name', $siteName) }}" required></div>
                <div class="form-group"><label>متن دکمه پشتیبانی</label><input name="support_label" value="{{ old('support_label', $supportLabel) }}" required></div>
                <div class="form-group form-span-2"><label>آدرس لوگو</label><input name="logo_url" value="{{ old('logo_url', $logoUrl) }}" placeholder="https://.../logo.png"></div>
            </div>

            <div class="slider-manager" style="margin-top:22px">
                <div class="panel-title"><div><strong>اسلایدر صفحه اصلی</strong><span>هر اسلاید یک تصویر و در صورت نیاز یک لینک دارد. اسلایدها به همان ترتیب نمایش داده می‌شوند.</span></div><button type="button" class="btn btn-soft btn-sm" id="add-slide">+ افزودن اسلاید</button></div>
                <div id="slides-list" style="display:grid;gap:12px;margin-top:12px">
                    @forelse($bannerSlides as $index => $slide)
                        <div class="slide-item" style="border:1px solid #e6edf2;border-radius:14px;padding:13px;background:#fbfcfd" data-slide>
                            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:9px"><strong style="font-size:11px;color:#40586b">اسلاید <span data-slide-number>{{ $index + 1 }}</span></strong><button type="button" class="btn btn-danger btn-sm" data-remove-slide>حذف</button></div>
                            <div class="form-grid">
                                <div class="form-group form-span-2"><label>آدرس تصویر</label><input name="slides[{{ $index }}][image]" value="{{ $slide['image'] ?? '' }}" placeholder="https://.../banner.webp" data-slide-image></div>
                                <div class="form-group form-span-2"><label>لینک هنگام کلیک (اختیاری)</label><input name="slides[{{ $index }}][link]" value="{{ $slide['link'] ?? '' }}" placeholder="https://..." data-slide-link></div>
                            </div>
                            @if(!empty($slide['image']))
                                <div class="settings-preview"><span>پیش‌نمایش</span><img src="{{ $slide['image'] }}" alt="Slide preview"></div>
                            @endif
                        </div>
                    @empty
                        <div class="slide-empty" id="slides-empty" style="padding:20px;text-align:center;border:1px dashed #d9e2e8;border-radius:14px;color:#96a3ad;font-size:11px">هنوز اسلایدی اضافه نشده است. از «افزودن اسلاید» شروع کن.</div>
                    @endforelse
                </div>
            </div>

            <div class="form-grid" style="margin-top:22px">
                <div class="form-group form-span-2"><label>لینک پشتیبانی</label><input name="support_url" value="{{ old('support_url', $supportUrl) }}" placeholder="https://t.me/..."></div>
            </div>

            <div class="form-actions"><button class="btn btn-dark">ذخیره تنظیمات</button><a class="btn btn-soft" href="{{ route('home') }}">مشاهده فروشگاه</a></div>
        </form>
    </div>
</section>

<script>
(() => {
    const list = document.getElementById('slides-list');
    const add = document.getElementById('add-slide');
    let counter = {{ count($bannerSlides) }};

    function emptyNotice() {
        if (!list.querySelector('[data-slide]')) {
            if (!document.getElementById('slides-empty')) {
                const el = document.createElement('div');
                el.id = 'slides-empty';
                el.className = 'slide-empty';
                el.style.cssText = 'padding:20px;text-align:center;border:1px dashed #d9e2e8;border-radius:14px;color:#96a3ad;font-size:11px';
                el.textContent = 'هنوز اسلایدی اضافه نشده است. از «افزودن اسلاید» شروع کن.';
                list.appendChild(el);
            }
        } else {
            document.getElementById('slides-empty')?.remove();
        }
    }

    function renumber() {
        [...list.querySelectorAll('[data-slide]')].forEach((item, i) => {
            item.querySelector('[data-slide-number]').textContent = i + 1;
            item.querySelector('[data-slide-image]').name = `slides[${i}][image]`;
            item.querySelector('[data-slide-link]').name = `slides[${i}][link]`;
        });
    }

    add.addEventListener('click', () => {
        document.getElementById('slides-empty')?.remove();
        const item = document.createElement('div');
        item.setAttribute('data-slide', '');
        item.style.cssText = 'border:1px solid #e6edf2;border-radius:14px;padding:13px;background:#fbfcfd';
        item.innerHTML = `
            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:9px"><strong style="font-size:11px;color:#40586b">اسلاید <span data-slide-number></span></strong><button type="button" class="btn btn-danger btn-sm" data-remove-slide>حذف</button></div>
            <div class="form-grid">
                <div class="form-group form-span-2"><label>آدرس تصویر</label><input placeholder="https://.../banner.webp" data-slide-image></div>
                <div class="form-group form-span-2"><label>لینک هنگام کلیک (اختیاری)</label><input placeholder="https://..." data-slide-link></div>
            </div>`;
        list.appendChild(item);
        counter++;
        renumber();
    });

    list.addEventListener('click', (event) => {
        const button = event.target.closest('[data-remove-slide]');
        if (!button) return;
        button.closest('[data-slide]')?.remove();
        renumber();
        emptyNotice();
    });

    emptyNotice();
})();
</script>
@endsection
