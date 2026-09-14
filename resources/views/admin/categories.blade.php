@extends('layouts.store')
@section('content')
<section class="section">
    <div class="section-head"><h2>دسته‌بندی‌ها</h2><a class="btn btn-dark" href="{{ route('admin.dashboard') }}">پنل</a></div>
    <div class="card" style="margin-bottom:18px"><h3>دسته جدید</h3><form method="POST" action="{{ route('admin.categories.store') }}" style="display:grid;gap:10px">@csrf<input name="name" placeholder="نام دسته" required><input name="slug" placeholder="slug انگلیسی" required><textarea name="description" placeholder="توضیحات"></textarea><button class="btn btn-dark">افزودن</button></form></div>
    @foreach($categories as $category)
        <div class="card" style="margin-bottom:10px;display:flex;justify-content:space-between"><span><strong>{{ $category->name }}</strong><span class="muted"> — {{ $category->slug }}</span></span><span>{{ $category->products_count }} محصول</span></div>
    @endforeach
</section>
@endsection
