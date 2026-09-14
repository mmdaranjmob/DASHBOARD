@extends('layouts.store')
@section('content')
<section class="admin-section">
    <div class="admin-head">
        <div><div class="admin-kicker">ویرایش</div><h1>{{ $category->name }}</h1><p>اطلاعات این دسته در فروشگاه را تغییر بده.</p></div>
        <a class="btn btn-soft" href="{{ route('admin.categories') }}">بازگشت</a>
    </div>

    <div class="admin-panel admin-form-panel" style="max-width:820px">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group"><label>نام</label><input name="name" value="{{ old('name', $category->name) }}" required></div>
                <div class="form-group"><label>شناسه</label><input name="slug" value="{{ old('slug', $category->slug) }}" required></div>
                <div class="form-group"><label>دسته والد</label><select name="parent_id"><option value="">بدون والد</option>@foreach(\App\Models\Category::where('id','!=',$category->id)->orderBy('name')->get() as $parent)<option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>@endforeach</select></div>
                <div class="form-group"><label>ترتیب نمایش</label><input type="number" name="sort_order" min="0" value="{{ old('sort_order', $category->sort_order) }}"></div>
                <div class="form-group form-span-2"><label>تصویر / آیکن (URL)</label><input name="image" value="{{ old('image', $category->image) }}" placeholder="https://..."></div>
                <div class="form-group form-span-2"><label>توضیحات</label><textarea name="description" rows="5">{{ old('description', $category->description) }}</textarea></div>
            </div>
            <label class="check-row"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active))> نمایش در فروشگاه</label>
            <div class="form-actions"><button class="btn btn-dark">ذخیره تغییرات</button><a class="btn btn-soft" href="{{ route('admin.categories') }}">انصراف</a></div>
        </form>
    </div>
</section>
@endsection
