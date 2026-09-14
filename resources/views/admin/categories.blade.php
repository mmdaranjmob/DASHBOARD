@extends('layouts.store')
@section('content')
<section class="admin-section">
    <div class="admin-head">
        <div><div class="admin-kicker">فروشگاه</div><h1>دسته‌بندی‌ها</h1><p>دسته‌های اصلی و زیر‌دسته‌های نمایش‌داده‌شده در فروشگاه را مدیریت کن.</p></div>
        <a class="btn btn-dark" href="{{ route('admin.dashboard') }}">بازگشت به پنل</a>
    </div>

    <div class="admin-layout">
        <div class="admin-panel">
            <div class="panel-title"><div><strong>دسته‌های فعلی</strong><span>هر دسته را جداگانه ویرایش کن.</span></div></div>
            <div class="admin-list">
                @forelse($categories as $category)
                    <div class="admin-row">
                        <div class="row-main">
                            <div class="admin-avatar">{{ mb_substr($category->name, 0, 1) }}</div>
                            <div><strong>{{ $category->name }}</strong><small>{{ $category->slug }} · {{ $category->products_count }} محصول{{ $category->parent_id ? ' · زیرمجموعه' : '' }}</small></div>
                        </div>
                        <div class="row-actions">
                            <span class="status {{ $category->is_active ? 'status-on' : 'status-off' }}">{{ $category->is_active ? 'فعال' : 'خاموش' }}</span>
                            <a class="btn btn-sm btn-soft" href="{{ route('admin.categories.edit', $category) }}">ویرایش</a>
                        </div>
                    </div>
                @empty
                    <div class="empty">هنوز دسته‌ای ایجاد نشده است.</div>
                @endforelse
            </div>
        </div>

        <aside class="admin-panel admin-form-panel">
            <div class="panel-title"><div><strong>دسته جدید</strong><span>برای منوی فروشگاه یک دسته بساز.</span></div></div>
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="form-group"><label>نام</label><input name="name" placeholder="مثلاً شماره مجازی" required></div>
                <div class="form-group"><label>شناسه</label><input name="slug" placeholder="virtual-number" required></div>
                <div class="form-group"><label>زیرمجموعه دسته</label><select name="parent_id"><option value="">بدون والد</option>@foreach($categories as $parent)<option value="{{ $parent->id }}">{{ $parent->name }}</option>@endforeach</select></div>
                <div class="form-group"><label>تصویر / آیکن (URL)</label><input name="image" placeholder="https://..."></div>
                <div class="form-group"><label>ترتیب نمایش</label><input type="number" name="sort_order" min="0" value="0"></div>
                <div class="form-group"><label>توضیحات</label><textarea name="description" rows="3"></textarea></div>
                <label class="check-row"><input type="checkbox" name="is_active" value="1" checked> فعال باشد</label>
                <button class="btn btn-dark btn-block">افزودن دسته</button>
            </form>
        </aside>
    </div>
</section>
@endsection
