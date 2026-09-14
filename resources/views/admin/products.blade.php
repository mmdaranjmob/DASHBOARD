@extends('layouts.store')
@section('content')
<section class="admin-section">
    <div class="admin-head">
        <div><div class="admin-kicker">فروشگاه</div><h1>خدمات / محصولات</h1><p>هر سرویس را جداگانه ویرایش کن؛ نام، قیمت، وضعیت، فیلدها و آیکن.</p></div>
        <div class="row-actions"><a class="btn btn-primary" href="{{ route('admin.products.create') }}">محصول جدید</a><a class="btn btn-soft" href="{{ route('admin.dashboard') }}">پنل</a></div>
    </div>

    <div class="admin-panel">
        @forelse($products as $product)
            <div class="admin-row" style="align-items:flex-start">
                <div class="row-main">
                    <div class="admin-avatar">@if($product->image)<img src="{{ $product->image }}" alt="" style="width:22px;height:22px;object-fit:contain">@else{{ mb_substr($product->name,0,1) }}@endif</div>
                    <div><strong>{{ $product->name }}</strong><small>{{ $product->category->name }} · {{ number_format($product->price) }} {{ $product->currency }}{{ $product->is_featured ? ' · ویژه' : '' }}</small></div>
                </div>
                <div style="flex:1;min-width:260px">
                    <form method="POST" action="{{ route('admin.products.media.update', $product) }}" style="display:flex;gap:7px">
                        @csrf
                        <input name="image" value="{{ $product->image }}" placeholder="URL آیکن / تصویر سرویس" style="width:100%;height:34px;padding:0 10px;border:1px solid #dbe4eb;border-radius:8px;font-size:11px;outline:0">
                        <button class="btn btn-sm btn-soft">ذخیره آیکن</button>
                    </form>
                </div>
                <div class="row-actions">
                    <span class="status {{ $product->is_active ? 'status-on' : 'status-off' }}">{{ $product->is_active ? 'فعال' : 'غیرفعال' }}</span>
                    <a class="btn btn-sm btn-soft" href="{{ route('admin.products.edit', $product) }}">ویرایش کامل</a>
                    <form method="POST" action="{{ route('admin.products.toggle', $product) }}">@csrf<button class="btn btn-sm btn-soft">{{ $product->is_active ? 'خاموش' : 'فعال' }}</button></form>
                </div>
            </div>
        @empty
            <div class="empty-box">محصولی وجود ندارد.</div>
        @endforelse
    </div>
    <div style="margin-top:14px">{{ $products->links() }}</div>
</section>
@endsection
