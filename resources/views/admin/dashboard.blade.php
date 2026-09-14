@extends('layouts.store')
@section('content')
<style>
.admin-dashboard{direction:rtl;max-width:1250px;margin:0 auto}
.admin-topbar{display:flex;align-items:center;justify-content:space-between;gap:18px;margin-bottom:24px}
.admin-title-wrap h1{margin:0;color:#263d50;font-size:27px;font-weight:900;letter-spacing:-.3px}.admin-title-wrap p{margin:8px 0 0;color:#8b99a5;font-size:11px}
.admin-top-actions{display:flex;gap:9px}.admin-action{height:40px;display:inline-flex;align-items:center;justify-content:center;padding:0 14px;border-radius:11px;border:1px solid #e1e8ee;background:#fff;color:#617789;font-size:11px;font-weight:800}.admin-action.primary{background:#08a9df;border-color:#08a9df;color:#fff;box-shadow:0 7px 18px rgba(8,169,223,.16)}
.admin-metrics{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:18px}
.admin-metric{position:relative;overflow:hidden;background:#fff;border:1px solid #e5ebf0;border-radius:16px;padding:18px;box-shadow:0 5px 18px rgba(38,69,95,.045)}
.admin-metric:before{content:"";position:absolute;right:0;top:0;width:4px;height:100%;background:#08a9df}.admin-metric.green:before{background:#24b77e}.admin-metric.orange:before{background:#f4a31d}.admin-metric.purple:before{background:#7768e8}
.metric-head{display:flex;align-items:center;justify-content:space-between;gap:8px}.metric-label{color:#8796a2;font-size:10px;font-weight:800}.metric-icon{width:34px;height:34px;border-radius:10px;background:#f1f8fc;display:grid;place-items:center;color:#0aa6da;font-size:15px}.green .metric-icon{background:#eefaf5;color:#23a773}.orange .metric-icon{background:#fff8ea;color:#da941b}.purple .metric-icon{background:#f3f1ff;color:#7565e5}
.metric-value{margin-top:12px;color:#2d4558;font-size:25px;font-weight:900;line-height:1.2}.metric-sub{margin-top:5px;color:#a0abb4;font-size:9px}
.admin-main-grid{display:grid;grid-template-columns:minmax(0,1.55fr) minmax(300px,.85fr);gap:16px}
.admin-card{background:#fff;border:1px solid #e5ebf0;border-radius:16px;box-shadow:0 5px 18px rgba(38,69,95,.04);overflow:hidden}.admin-card-head{display:flex;align-items:center;justify-content:space-between;padding:17px 18px;border-bottom:1px solid #edf1f4}.admin-card-head h2{margin:0;color:#324b5f;font-size:13px}.admin-card-head span{color:#9aa6b0;font-size:9px}.admin-card-body{padding:14px 18px}
.quick-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:9px}.quick-item{display:flex;align-items:center;gap:10px;padding:13px;border:1px solid #edf1f4;border-radius:12px;background:#fbfcfd;transition:.15s}.quick-item:hover{border-color:#cfeaf4;background:#f7fcfe;transform:translateY(-1px)}.quick-icon{width:37px;height:37px;border-radius:10px;background:#eef8fc;color:#09a7dc;display:grid;place-items:center;font-size:15px;flex:0 0 auto}.quick-item strong{display:block;color:#42596b;font-size:10px}.quick-item small{display:block;margin-top:4px;color:#9da8b1;font-size:8px}
.admin-orders{padding:0 18px}.admin-order{display:flex;align-items:center;justify-content:space-between;gap:15px;padding:14px 0;border-bottom:1px solid #eff2f4}.admin-order:last-child{border-bottom:0}.order-user{display:flex;align-items:center;gap:10px;min-width:0}.order-avatar{width:36px;height:36px;border-radius:11px;background:#f1f7fb;color:#0ba5d9;display:grid;place-items:center;font-weight:900;flex:0 0 auto}.order-user strong{display:block;color:#42586a;font-size:10px;white-space:nowrap}.order-user small{display:block;margin-top:4px;color:#9aa6b0;font-size:8px;direction:ltr;text-align:right}.order-meta{display:flex;align-items:center;gap:9px;flex:0 0 auto}.order-amount{color:#526a7c;font-size:9px;font-weight:800;white-space:nowrap}.order-status{padding:5px 8px;border-radius:999px;font-size:8px;font-weight:900;white-space:nowrap}.status-pending{background:#fff8e9;color:#bf8417}.status-paid{background:#eefaf4;color:#1f8e64}.status-processing{background:#eef8fc;color:#078db8}.status-completed{background:#eefaf4;color:#1f8e64}.status-cancelled,.status-refunded{background:#fff1f3;color:#ad4c55}
.admin-empty{padding:36px 20px;text-align:center;color:#9da8b1;font-size:10px}
.admin-mini-list{display:flex;flex-direction:column;gap:8px}.admin-mini{display:flex;align-items:center;gap:10px;padding:11px;border:1px solid #edf1f4;border-radius:11px;background:#fbfcfd}.admin-mini b{display:block;color:#4a6172;font-size:10px}.admin-mini span{display:block;margin-top:4px;color:#a0abb4;font-size:8px}.mini-dot{width:9px;height:9px;border-radius:50%;background:#08a9df;flex:0 0 auto}.mini-dot.green{background:#24b77e}.mini-dot.orange{background:#f4a31d}
.admin-note{margin-top:16px;padding:15px 16px;border-radius:13px;background:linear-gradient(135deg,#f5fbfe,#fbfdff);border:1px solid #e1f0f6}.admin-note strong{display:block;color:#3e586b;font-size:11px}.admin-note p{margin:6px 0 0;color:#8f9ca7;font-size:9px;line-height:1.9}
@media(max-width:1050px){.admin-metrics{grid-template-columns:repeat(2,minmax(0,1fr))}.admin-main-grid{grid-template-columns:1fr}}
@media(max-width:650px){.admin-topbar{align-items:stretch;flex-direction:column}.admin-top-actions{width:100%}.admin-action{flex:1}.admin-metrics{grid-template-columns:1fr}.quick-grid{grid-template-columns:1fr}.admin-order{align-items:flex-start;flex-direction:column}.order-meta{width:100%;justify-content:space-between}.admin-card-head{padding-inline:14px}.admin-card-body{padding-inline:14px}.admin-orders{padding-inline:14px}}
</style>

<section class="admin-dashboard">
    <div class="admin-topbar">
        <div class="admin-title-wrap">
            <h1>داشبورد مدیریت</h1>
            <p>نمای کلی فروشگاه، کاربران، سفارش‌ها و پشتیبانی</p>
        </div>
        <div class="admin-top-actions">
            <a class="admin-action" href="{{ route('home') }}">مشاهده فروشگاه</a>
            <a class="admin-action primary" href="{{ route('admin.products') }}">مدیریت خدمات</a>
        </div>
    </div>

    <div class="admin-metrics">
        <div class="admin-metric">
            <div class="metric-head"><span class="metric-label">کاربران</span><span class="metric-icon">♙</span></div>
            <div class="metric-value">{{ number_format($stats['users']) }}</div>
            <div class="metric-sub">حساب‌های ثبت‌شده</div>
        </div>
        <div class="admin-metric green">
            <div class="metric-head"><span class="metric-label">کل سفارش‌ها</span><span class="metric-icon">▣</span></div>
            <div class="metric-value">{{ number_format($stats['orders']) }}</div>
            <div class="metric-sub">تمام سفارش‌های ثبت‌شده</div>
        </div>
        <div class="admin-metric orange">
            <div class="metric-head"><span class="metric-label">سفارش‌های در جریان</span><span class="metric-icon">◷</span></div>
            <div class="metric-value">{{ number_format($stats['pending_orders']) }}</div>
            <div class="metric-sub">نیازمند بررسی یا پردازش</div>
        </div>
        <div class="admin-metric purple">
            <div class="metric-head"><span class="metric-label">فروش ثبت‌شده</span><span class="metric-icon">◈</span></div>
            <div class="metric-value" style="font-size:20px">{{ number_format($stats['revenue']) }}</div>
            <div class="metric-sub">ریال</div>
        </div>
    </div>

    <div class="admin-main-grid">
        <div>
            <div class="admin-card">
                <div class="admin-card-head"><h2>آخرین سفارش‌ها</h2><span>۱۰ سفارش اخیر</span></div>
                <div class="admin-orders">
                    @forelse($latestOrders as $order)
                        @php
                            $statusMap = [
                                'pending' => ['در انتظار','status-pending'],
                                'paid' => ['پرداخت‌شده','status-paid'],
                                'processing' => ['در حال پردازش','status-processing'],
                                'completed' => ['تکمیل‌شده','status-completed'],
                                'cancelled' => ['لغوشده','status-cancelled'],
                                'refunded' => ['مرجوع‌شده','status-refunded'],
                            ];
                            [$statusText,$statusClass] = $statusMap[$order->status] ?? [$order->status,'status-pending'];
                        @endphp
                        <div class="admin-order">
                            <div class="order-user">
                                <div class="order-avatar">{{ mb_substr($order->user?->name ?: 'ک',0,1) }}</div>
                                <div>
                                    <strong>#{{ $order->order_number }}</strong>
                                    <small>{{ $order->user?->mobile ?: '---' }}</small>
                                </div>
                            </div>
                            <div class="order-meta">
                                <span class="order-amount">{{ number_format($order->total_amount) }} {{ $order->currency }}</span>
                                <span class="order-status {{ $statusClass }}">{{ $statusText }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="admin-empty">هنوز سفارشی ثبت نشده است.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div>
            <div class="admin-card">
                <div class="admin-card-head"><h2>دسترسی سریع</h2><span>مدیریت سریع فروشگاه</span></div>
                <div class="admin-card-body">
                    <div class="quick-grid">
                        <a class="quick-item" href="{{ route('admin.settings') }}"><span class="quick-icon">⚙</span><span><strong>ظاهر فروشگاه</strong><small>لوگو، بنر و تنظیمات</small></span></a>
                        <a class="quick-item" href="{{ route('admin.categories') }}"><span class="quick-icon">☷</span><span><strong>دسته‌بندی‌ها</strong><small>مدیریت دسته‌ها</small></span></a>
                        <a class="quick-item" href="{{ route('admin.products') }}"><span class="quick-icon">▤</span><span><strong>خدمات / محصولات</strong><small>قیمت و موجودی</small></span></a>
                        <a class="quick-item" href="{{ route('admin.users') }}"><span class="quick-icon">♙</span><span><strong>کاربران</strong><small>حساب و کیف پول</small></span></a>
                        <a class="quick-item" href="{{ route('admin.orders') }}"><span class="quick-icon">▣</span><span><strong>سفارش‌ها</strong><small>پیگیری و وضعیت</small></span></a>
                        <a class="quick-item" href="{{ route('admin.tickets') }}"><span class="quick-icon">◈</span><span><strong>تیکت‌ها</strong><small>پشتیبانی مشتریان</small></span></a>
                    </div>
                    <div class="admin-note">
                        <strong>نکته مدیریتی</strong>
                        <p>از منوی سمت راست می‌توانی تمام بخش‌های فروشگاه را بدون خروج از محیط مدیریت کنترل کنی.</p>
                    </div>
                </div>
            </div>

            <div class="admin-card" style="margin-top:16px">
                <div class="admin-card-head"><h2>وضعیت کلی</h2><span>اطلاعات لحظه‌ای</span></div>
                <div class="admin-card-body">
                    <div class="admin-mini-list">
                        <div class="admin-mini"><span class="mini-dot green"></span><div><b>فروشگاه فعال است</b><span>خدمات فعال در ویترین قابل خرید هستند.</span></div></div>
                        <div class="admin-mini"><span class="mini-dot orange"></span><div><b>سفارش‌های در انتظار: {{ number_format($stats['pending_orders']) }}</b><span>در صورت نیاز از بخش سفارش‌ها بررسی کن.</span></div></div>
                        <div class="admin-mini"><span class="mini-dot"></span><div><b>تیکت‌های باز: {{ number_format($stats['open_tickets']) }}</b><span>در بخش پشتیبانی پاسخ بده.</span></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
