@extends('layouts.store')
@section('content')
<section class="section">
    <div class="form-box" style="max-width:760px;margin:30px auto">
        <h2>{{ $product ? 'ویرایش محصول' : 'محصول جدید' }}</h2>
        <form method="POST" action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}">
            @csrf @if($product) @method('PUT') @endif
            <div class="form-group"><label>دسته‌بندی</label><select name="category_id" required>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id', $product?->category_id) == $category->id)>{{ $category->name }}</option>@endforeach</select></div>
            <div class="form-group"><label>نام محصول</label><input name="name" value="{{ old('name', $product?->name) }}" required></div>
            <div class="form-group"><label>شناسه (slug)</label><input name="slug" value="{{ old('slug', $product?->slug) }}" required></div>
            <div class="form-group"><label>توضیحات</label><textarea name="description" rows="4">{{ old('description', $product?->description) }}</textarea></div>
            <div class="form-group"><label>قیمت</label><input type="number" name="price" min="0" value="{{ old('price', $product?->price ?? 0) }}" required></div>
            <div class="form-group"><label>قیمت قبلی</label><input type="number" name="old_price" min="0" value="{{ old('old_price', $product?->old_price) }}"></div>
            <div class="form-group"><label>واحد پول</label><input name="currency" value="{{ old('currency', $product?->currency ?? 'IRR') }}" required></div>
            <div class="form-group"><label>نوع تحویل</label><select name="delivery_type"><option value="automatic" @selected(old('delivery_type', $product?->delivery_type) === 'automatic')>خودکار</option><option value="manual" @selected(old('delivery_type', $product?->delivery_type) === 'manual')>دستی</option></select></div>
            <div class="form-group"><label>زمان تحویل (دقیقه)</label><input type="number" name="delivery_minutes" min="0" value="{{ old('delivery_minutes', $product?->delivery_minutes) }}"></div>
            <div class="form-group"><label>موجودی</label><input type="number" name="inventory" min="0" value="{{ old('inventory', $product?->inventory) }}"></div>
            <div class="form-group"><label>ترتیب نمایش</label><input type="number" name="sort_order" min="0" value="{{ old('sort_order', $product?->sort_order ?? 0) }}"></div>
            <label style="display:block;margin:12px 0"><input type="checkbox" name="has_inventory" value="1" @checked(old('has_inventory', $product?->has_inventory ?? false))> مدیریت موجودی</label>
            <label style="display:block;margin:12px 0"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product?->is_active ?? true))> فعال</label>
            <label style="display:block;margin:12px 0"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product?->is_featured ?? false))> ویژه</label>
            <button class="btn btn-dark">ذخیره</button>
            <a class="btn btn-dark" href="{{ route('admin.products') }}">لغو</a>
        </form>
    </div>
</section>
@endsection
