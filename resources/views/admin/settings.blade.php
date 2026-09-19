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
            <div class="header-settings" style="margin-bottom:24px;padding-bottom:22px;border-bottom:1px solid #eef2f5">
                <div class="panel-title" style="margin-bottom:15px"><div><strong>تنظیمات سربرگ سایت</strong><span>نام فروشگاه، لوگو و منوهای بالای سایت را از این بخش تغییر بده.</span></div></div>
                <div class="form-grid">
                <div class="form-group"><label>نام فروشگاه / عنوان سربرگ</label><input name="site_name" value="{{ old('site_name', $siteName) }}" required></div>
                <div class="form-group"><label>متن دکمه پشتیبانی</label><input name="support_label" value="{{ old('support_label', $supportLabel) }}" required></div>
                <div class="form-group form-span-2"><label>آدرس لوگو</label><input name="logo_url" value="{{ old('logo_url', $logoUrl) }}" placeholder="https://.../logo.png"></div>
                </div>
                <div style="margin-top:14px">
                    <div class="panel-title"><div><strong>منوی سربرگ</strong><span>عنوان و لینک هر گزینه را مشخص کن.</span></div><button type="button" class="btn btn-soft btn-sm" id="add-menu-item">+ افزودن گزینه</button></div>
                    <div id="header-menu-list" style="display:grid;gap:9px;margin-top:12px">
                        @foreach($headerMenu as $index => $item)
                        <div data-menu-item style="display:grid;grid-template-columns:1fr 1.6fr auto;gap:8px;align-items:end;padding:10px;border:1px solid #e6edf2;border-radius:11px;background:#fbfcfd">
                            <div class="form-group" style="margin:0"><label>عنوان</label><input name="header_menu[{{ $index }}][label]" value="{{ $item['label'] }}" data-menu-label></div>
                            <div class="form-group" style="margin:0"><label>لینک</label><input name="header_menu[{{ $index }}][url]" value="{{ $item['url'] }}" placeholder="/blog یا https://..." data-menu-url></div>
                            <button type="button" class="btn btn-danger btn-sm" data-remove-menu>حذف</button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="slider-manager" style="margin-top:22px">
                <div class="panel-title"><div><strong>اسلایدر صفحه اصلی</strong><span>هر اسلاید یک تصویر و در صورت نیاز یک لینک دارد. اسلایدها به همان ترتیب نمایش داده می‌شوند.</span></div><button type="button" class="btn btn-soft btn-sm" id="add-slide">+ افزودن اسلاید</button></div>
                <div id="slides-list" style="display:grid;gap:12px;margin-top:12px">
                    @forelse($bannerSlides as $index => $slide)
                        <div class="slide-item" style="border:1px solid #e6edf2;border-radius:14px;padding:13px;background:#fbfcfd" data-slide>
                            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:9px"><strong style="font-size:11px;color:#40586b">اسلاید <span data-slide-number>{{ $index + 1 }}</span></strong><button type="button" class="btn btn-danger btn-sm" data-remove-slide>حذف</button></div>
                            <div class="form-grid">
                                <div class="form-group form-span-2">
<label>تصویر اسلاید</label>
<div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
<input name="slides[{{ $index }}][image]" value="{{ $slide['image'] ?? '' }}" placeholder="https://.../banner.webp" data-slide-image style="flex:1;min-width:240px">
<label class="btn btn-soft btn-sm" style="cursor:pointer">انتخاب از سیستم<input type="file" accept="image/jpeg,image/png,image/webp,image/gif" data-slide-file style="display:none"></label>
</div>
<small style="display:block;color:#94a1ad;font-size:9px;margin-top:6px">می‌توانی لینک تصویر بدهی یا فایل را مستقیماً از کامپیوتر انتخاب کنی.</small>
</div>
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
    let menuCounter = {{ count($headerMenu) }};

    const menuList = document.getElementById('header-menu-list');
    const addMenu = document.getElementById('add-menu-item');

    function renumberMenu() {
        [...menuList.querySelectorAll('[data-menu-item]')].forEach((item, i) => {
            item.querySelector('[data-menu-label]').name = `header_menu[${i}][label]`;
            item.querySelector('[data-menu-url]').name = `header_menu[${i}][url]`;
        });
    }

    addMenu?.addEventListener('click', () => {
        const i = menuList.querySelectorAll('[data-menu-item]').length;
        const item = document.createElement('div');
        item.setAttribute('data-menu-item', '');
        item.style.cssText = 'display:grid;grid-template-columns:1fr 1.6fr auto;gap:8px;align-items:end;padding:10px;border:1px solid #e6edf2;border-radius:11px;background:#fbfcfd';
        item.innerHTML = `
            <div class="form-group" style="margin:0"><label>عنوان</label><input name="header_menu[${i}][label]" placeholder="عنوان منو" data-menu-label></div>
            <div class="form-group" style="margin:0"><label>لینک</label><input name="header_menu[${i}][url]" placeholder="/page یا https://..." data-menu-url></div>
            <button type="button" class="btn btn-danger btn-sm" data-remove-menu>حذف</button>`;
        menuList.appendChild(item);
        renumberMenu();
    });

    menuList?.addEventListener('click', e => {
        if (!e.target.closest('[data-remove-menu]')) return;
        e.target.closest('[data-menu-item]')?.remove();
        renumberMenu();
    });

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

    async function uploadImage(file, input, button) {
        if (!file) return;
        const form = new FormData();
        form.append('_token', '{{ csrf_token() }}');
        form.append('image', file);
        const oldText = button.textContent;
        button.textContent = 'در حال آپلود...';
        button.style.pointerEvents = 'none';
        try {
            const response = await fetch('{{ route('admin.settings.slider-image') }}', { method: 'POST', body: form });
            if (!response.ok) throw new Error('upload failed');
            const data = await response.json();
            input.value = data.url;
            input.dispatchEvent(new Event('input', {bubbles:true}));
            button.textContent = 'آپلود شد ✓';
            setTimeout(() => { button.textContent = oldText; button.style.pointerEvents = ''; }, 1200);
        } catch (error) {
            alert('آپلود تصویر انجام نشد. دوباره تلاش کن.');
            button.textContent = oldText;
            button.style.pointerEvents = '';
        }
    }

    function bindFileInputs(root = list) {
        root.querySelectorAll('[data-slide-file]').forEach(fileInput => {
            if (fileInput.dataset.bound) return;
            fileInput.dataset.bound = '1';
            fileInput.addEventListener('change', () => {
                const item = fileInput.closest('[data-slide]');
                const imageInput = item?.querySelector('[data-slide-image]');
                const button = fileInput.closest('label');
                if (fileInput.files[0] && imageInput) uploadImage(fileInput.files[0], imageInput, button);
            });
        });
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
                <div class="form-group form-span-2">
<label>تصویر اسلاید</label>
<div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
<input placeholder="https://.../banner.webp" data-slide-image style="flex:1;min-width:240px">
<label class="btn btn-soft btn-sm" style="cursor:pointer">انتخاب از سیستم<input type="file" accept="image/jpeg,image/png,image/webp,image/gif" data-slide-file style="display:none"></label>
</div>
<small style="display:block;color:#94a1ad;font-size:9px;margin-top:6px">می‌توانی لینک تصویر بدهی یا فایل را مستقیماً از کامپیوتر انتخاب کنی.</small>
</div>
                <div class="form-group form-span-2"><label>لینک هنگام کلیک (اختیاری)</label><input placeholder="https://..." data-slide-link></div>
            </div>`;
        list.appendChild(item);
        counter++;
        renumber();
        bindFileInputs(item);
    });

    list.addEventListener('click', (event) => {
        const button = event.target.closest('[data-remove-slide]');
        if (!button) return;
        button.closest('[data-slide]')?.remove();
        renumber();
        bindFileInputs();
    emptyNotice();
    });

    renumberMenu();
    emptyNotice();
})();
</script>
@endsection
