@extends('layouts.store')

@section('content')
<style>
    .dashboard-shell{
        direction:ltr;
        display:grid;
        grid-template-columns:minmax(0,1fr) 250px;
        gap:20px;
        align-items:stretch;
        min-height:calc(100vh - 150px);
        padding:24px 0 40px;
    }
    .dashboard-main{
        direction:rtl;
        min-width:0;
    }
    .dashboard-sidebar{
        direction:rtl;
        background:#fff;
        border:1px solid #e5ebf0;
        border-radius:18px;
        padding:16px;
        min-height:620px;
        box-shadow:0 6px 22px rgba(37,64,92,.05);
    }
    .dashboard-sidebar-title{
        padding:6px 8px 16px;
        margin-bottom:10px;
        border-bottom:1px solid #edf1f4;
        color:#2f465a;
        font-size:14px;
        font-weight:900;
    }
    .dashboard-sidebar-menu{
        display:flex;
        flex-direction:column;
        gap:4px;
    }
    .dashboard-sidebar-link{
        display:flex;
        align-items:center;
        gap:10px;
        min-height:44px;
        padding:0 11px;
        border-radius:11px;
        color:#647789;
        font-size:11px;
        transition:.15s;
    }
    .dashboard-sidebar-link:hover{
        background:#f3f9fc;
        color:#079fd4;
    }
    .dashboard-sidebar-link.active{
        background:#eaf8fd;
        color:#079fd4;
        font-weight:900;
    }
    .dashboard-sidebar-icon{
        width:22px;
        text-align:center;
        font-size:14px;
        color:#8b9aa7;
    }
    .dashboard-sidebar-link.active .dashboard-sidebar-icon{
        color:#08a9df;
    }
    @media(max-width:900px){
        .dashboard-shell{grid-template-columns:1fr;}
        .dashboard-sidebar{order:2;min-height:0;}
        .dashboard-main{order:1;}
    }
</style>

<section class="dashboard-shell">
    <main class="dashboard-main"></main>

    <aside class="dashboard-sidebar">
        <div class="dashboard-sidebar-title">حساب کاربری</div>
        <nav class="dashboard-sidebar-menu">
            <a class="dashboard-sidebar-link active" href="{{ route('account.dashboard') }}">
                <span class="dashboard-sidebar-icon">⌂</span>
                <span>داشبورد</span>
            </a>
            <a class="dashboard-sidebar-link" href="{{ route('account.orders') }}">
                <span class="dashboard-sidebar-icon">▣</span>
                <span>سفارش‌های من</span>
            </a>
            <a class="dashboard-sidebar-link" href="{{ route('account.transactions') }}">
                <span class="dashboard-sidebar-icon">▤</span>
                <span>تراکنش‌ها</span>
            </a>
            <a class="dashboard-sidebar-link" href="{{ route('account.tickets') }}">
                <span class="dashboard-sidebar-icon">◈</span>
                <span>پشتیبانی</span>
            </a>
            <a class="dashboard-sidebar-link" href="{{ route('account.profile') }}">
                <span class="dashboard-sidebar-icon">✎</span>
                <span>پروفایل</span>
            </a>
        </nav>
    </aside>
</section>
@endsection
