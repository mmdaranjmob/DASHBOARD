@extends('layouts.store')
@section('content')
<section class="section"><div class="section-head"><div><h2>{{ $ticket->subject }}</h2><div class="muted">{{ $ticket->ticket_number }} — {{ $ticket->status }}</div></div><a class="btn btn-dark" href="{{ route('account.tickets') }}">همه تیکت‌ها</a></div>
<div class="card" style="margin-bottom:16px">
@foreach($ticket->messages as $message)
    <div style="padding:14px 0;border-bottom:1px solid #eee"><strong>{{ $message->user_id === $ticket->user_id ? 'شما' : ($message->user->name ?: 'پشتیبانی') }}</strong><div style="white-space:pre-wrap;line-height:1.9;margin-top:6px">{{ $message->message }}</div><div class="muted">{{ $message->created_at->format('Y/m/d H:i') }}</div></div>
@endforeach
</div>
@if($ticket->status !== 'closed')<div class="card"><form method="POST" action="{{ route('account.tickets.reply', $ticket) }}">@csrf<div class="form-group"><label>پاسخ</label><textarea name="message" rows="6" required></textarea></div><button class="btn btn-dark">ارسال پاسخ</button></form></div>@endif
</section>
@endsection
