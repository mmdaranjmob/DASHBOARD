@extends('layouts.store')
@section('content')
<section class="section">
    <div class="section-head"><h2>محصولات</h2><div class="navlinks"><a class="btn btn-dark" href="{{ route('admin.products.create') }}">محصول جدید</a><a class="btn btn-dark" href="{{ route('admin.dashboard') }}">پنل</a></div></div>
    @forelse($products as $product)
        <div class="card" style="margin-bottom:12px;display:flex;justify-content:space-between;gap:16px;align-items:center;flex-wrap:wrap">
            <div><strong>{{ $product->name }}</strong><div class="muted">{{ $product->category->name }} — {{ number_format($product->price) }} {{ $product->currency }}</div></div>
            <div>{{ $product->is_active ? 'فعال' : 'غیرفعال' }} @if($product->is_featured) — ویژه @endif</div>
            <div class="navlinks"><a class="btn btn-dark" href="{{ route('admin.products.edit', $product) }}">ویرایش</a><form method="POST" action="{{ route('admin.products.toggle', $product) }}">@csrf<button class="btn btn-dark">{{ $product->is_active ? 'غیرفعال‌کردن' : 'فعال‌کردن' }}</button></form></div>
        </div>
    @empty <div class="empty">محصولی وجود ندارد.</div> @endforelse
    {{ $products->links() }}
</section>
@endsection
