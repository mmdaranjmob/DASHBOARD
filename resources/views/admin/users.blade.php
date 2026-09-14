@extends('layouts.store')
@section('content')
<section class="section">
    <div class="section-head"><h2>مدیریت کاربران</h2><a class="btn btn-dark" href="{{ route('admin.dashboard') }}">بازگشت</a></div>
    <form method="GET" class="card" style="margin-bottom:16px;display:flex;gap:10px"><input name="q" value="{{ request('q') }}" placeholder="جستجوی نام، موبایل یا کد ملی" style="flex:1;padding:12px;border:1px solid #ddd;border-radius:10px"><button class="btn btn-dark">جستجو</button></form>
    @foreach($users as $user)
        <div class="card" style="margin-bottom:12px">
            <div style="display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap">
                <div><strong>{{ $user->name ?: 'بدون نام' }}</strong><div class="muted">{{ $user->mobile }} — {{ $user->national_id }}</div></div>
                <div>{{ $user->roles->pluck('name')->join('، ') ?: 'بدون نقش' }}</div>
                <div>وضعیت: {{ $user->status }}</div>
            </div>
            <form method="POST" action="{{ route('admin.users.credit', $user) }}" style="margin-top:14px;display:flex;gap:8px;flex-wrap:wrap">@csrf<input type="number" name="amount" min="1" placeholder="مبلغ شارژ به ریال" required><input name="description" placeholder="توضیح"><button class="btn btn-dark">شارژ کیف پول</button></form>
        </div>
    @endforeach
    {{ $users->links() }}
</section>
@endsection
