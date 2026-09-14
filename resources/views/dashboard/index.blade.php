@extends('layouts.store')

@section('content')
<style>
.dashboard-shell{display:grid;grid-template-columns:minmax(0,1fr) 260px;gap:20px;direction:ltr;min-height:calc(100vh - 130px);padding:24px 0 40px}
.dashboard-main{direction:rtl;min-width:0;background:#fff;border:1px solid #e6edf2;border-radius:18px;min-height:620px}
.dashboard-sidebar{direction:rtl;background:#fff;border:1px solid #e6edf2;border-radius:18px;padding:14px;min-height:620px;box-shadow:0 6px 22px rgba(35,61,82,.05)}
.dashboard-sidebar-title{padding:8px 10px 14px;font-size:13px;font-weight:900;color:#31495d;border-bottom:1px solid #edf1f4}
.dashboard-sidebar-link{display:flex;align-items:center;gap:10px;height:44px;margin:5px 0;padding:0 12px;border-radius:11px;color:#637789;font-size:11px}
.dashboard-sidebar-link:hover{background:#f3f9fc;color:#079fd4}
.dashboard-sidebar-link.active{background:#eaf8fd;color:#079fd4;font-weight:900}
.dashboard-sidebar-icon{width:22px;text-align:center;font-size:15px}
.dashboard-placeholder{padding:28px}
.dashboard-placeholder h1{margin:0;color:#30485d;font-size:24px}
.dashboard-placeholder p{margin:8px 0 0;color:#94a1ad;font-size:11px}
@media(max-width:900px){.dashboard-shell{grid-template-columns:1fr}.dashboard-sidebar{order:1;min-height:auto}.dashboard-main{order:2;min-height:420px}}
</style>

<section class="dashboard-shell">
    <main class="dashboard-main">
        <div class="dashboard-placeholder">
            <h1>داشبورد</h1>
            <p>محتوای داشبورد در این بخش قرار می‌گیرد.</p>
        </div>
    </main>

    <aside class="dashboard-sidebar">
        <div class="dashboard-sidebar-title">حساب کاربری</div>
        <a class="dashboard-sidebar-link active" href="{{ route('account.dashboard') }}"><span class="dashboard-sidebar-icon">⌂</span>داشبورد</a>
        <a class="dashboard-sidebar-link" href="{{ route('account.orders') }}"><span class="dashboard-sidebar-icon">▣</span>سفارش‌های من</a>
        <a class="dashboard-sidebar-link" href="{{ route('account.transactions') }}"><span class="dashboard-sidebar-icon">▤</span>تراکنش‌ها</a>
        <a class="dashboard-sidebar-link" href="{{ route('account.tickets') }}"><span class="dashboard-sidebar-icon">◈</span>پشتیبانی</a>
        <a class="dashboard-sidebar-link" href="{{ route('account.profile') }}"><span class="dashboard-sidebar-icon">✎</span>پروفایل</a>
    </aside>
</section>
@endsection
