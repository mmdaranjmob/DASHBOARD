@extends('layouts.store')

@section('content')
<section class="store-page">
    <div class="banner-wrap">
        @if($bannerUrl)
            <a class="store-banner" href="{{ $bannerLink ?: '#' }}" @if(!$bannerLink) aria-label="بنر فروشگاه" @endif>
                <img src="{{ $bannerUrl }}" alt="بنر {{ $siteName }}">
            </a>
        @else
            <div class="store-banner banner-placeholder"><strong>{{ $siteName }} — خدمات دیجیتال با تحویل سریع</strong></div>
        @endif
    </div>

    <div class="store-shell">
        <aside class="category-sidebar" aria-label="دسته‌های خدمات">
            @forelse($categories as $category)
                <a class="category-item {{ $selectedCategory?->id === $category->id ? 'active' : '' }}" href="{{ route('home', ['category' => $category->slug]) }}">
                    <span class="category-label">{{ $category->name }}</span>
                    <span class="category-icon">
                        @if($category->image)<img src="{{ $category->image }}" alt="" style="width:22px;height:22px;object-fit:contain">@else{{ mb_substr($category->name,0,1) }}@endif
                    </span>
                </a>
            @empty
                <div class="empty-box">هنوز دسته‌ای در فروشگاه ثبت نشده است.</div>
            @endforelse

            @auth
                @if(\App\Models\StoreSetting::get('support_url', ''))
                    <a class="category-item" href="{{ \App\Models\StoreSetting::get('support_url') }}"><span class="category-label">{{ \App\Models\StoreSetting::get('support_label', 'پشتیبانی') }}</span><span class="category-icon">?</span></a>
                @endif
            @endauth
        </aside>

        <section class="catalog-card">
            <div class="tabs" role="tablist" aria-label="نوع خدمات">
                @forelse($tabs as $tab)
                    <a class="tab {{ $selectedTab?->id === $tab->id ? 'active' : '' }}" href="{{ route('home', ['category' => $selectedCategory->slug, 'tab' => $tab->slug]) }}">{{ $tab->name }}</a>
                @empty
                    <span class="tab active">{{ $selectedCategory?->name ?: 'خدمات' }}</span>
                @endforelse
            </div>

            <div class="catalog-top">
                <div class="catalog-title">{{ $selectedTab?->name ?: ($selectedCategory?->name ?: 'خدمات') }}</div>
                <form class="search-box" method="GET" action="{{ route('home') }}">
                    @if($selectedCategory)<input type="hidden" name="category" value="{{ $selectedCategory->slug }}">@endif
                    @if($selectedTab)<input type="hidden" name="tab" value="{{ $selectedTab->slug }}">@endif
                    <input name="q" value="{{ request('q') }}" placeholder="جستجو در سرویس‌ها" aria-label="جستجو در سرویس‌ها">
                </form>
            </div>

            <div class="service-layout">
                <div class="empty-panel">
                    <div class="empty-inner">
                        <div class="empty-art" aria-hidden="true"><div class="empty-stars"></div><div class="empty-astronaut"></div><div class="empty-planet"></div></div>
                        <div class="empty-text"><strong>{{ $products->isEmpty() ? 'شماره فعال برای نمایش وجود ندارد' : 'سرویس‌های موجود در این بخش' }}</strong><p>دسته یا سرویس موردنظر را انتخاب کن. خریدهای قبلی از قسمت تاریخچه قابل مشاهده هستند.</p></div>
                    </div>
                </div>

                <div class="service-list">
                    @if($products->isEmpty())
                        <div class="empty-box">برای این دسته هنوز سرویسی ثبت نشده است.</div>
                    @else
                        @foreach($products as $product)
                            <a class="service-row" href="{{ route('product.show', $product) }}">
                                <span class="service-icon">
                                    @if($product->image)<img src="{{ $product->image }}" alt="" style="width:18px;height:18px;object-fit:contain">@else{{ mb_substr($product->name,0,1) }}@endif
                                </span>
                                <span class="service-name">{{ $product->name }}</span>
                                <span class="service-price">{{ number_format($product->price) }} {{ $product->currency === 'IRR' ? 'ریال' : $product->currency }}</span>
                                <span class="service-action">‹</span>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </div>
</section>
@endsection
