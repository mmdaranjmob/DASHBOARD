@extends('layouts.store')
@section('content')
<section class="section">
    <div class="section-head"><h2>تیکت‌های پشتیبانی</h2><a class="btn btn-dark" href="{{ route('admin.dashboard') }}">پنل</a></div>
    @forelse($tickets as $ticket)
        <div class="card" style="margin-bottom:14px">
            <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap"><strong>{{ $ticket->ticket_number }}</strong><span>{{ $ticket->subject }}</span><span>{{ $ticket->user->mobile }}</span></div>
            <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}" style="display:flex;gap:8px;flex-wrap:wrap;margin-top:12px">@csrf @method('PUT')<select name="status"><option value="open" @selected($ticket->status==='open')>باز</option><option value="answered" @selected($ticket->status==='answered')>پاسخ داده‌شده</option><option value="closed" @selected($ticket->status==='closed')>بسته</option></select><select name="priority"><option value="low" @selected($ticket->priority==='low')>کم</option><option value="normal" @selected($ticket->priority==='normal')>عادی</option><option value="high" @selected($ticket->priority==='high')>زیاد</option></select><a class="btn btn-dark" href="{{ route('account.tickets.show', $ticket) }}">مشاهده و پاسخ</a><button class="btn btn-dark">ذخیره وضعیت</button></form>
        </div>
    @empty <div class="empty">تیکتی وجود ندارد.</div> @endforelse
    {{ $tickets->links() }}
</section>
@endsection
