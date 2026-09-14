@extends('layouts.store')
@section('content')
<section class="section">
    <div class="section-head"><h2>پشتیبانی</h2><a class="btn btn-dark" href="{{ route('account.tickets.create') }}">تیکت جدید</a></div>
    @forelse($tickets as $ticket)
        <a class="card" href="{{ route('account.tickets.show', $ticket) }}" style="display:block;margin-bottom:10px"><strong>{{ $ticket->ticket_number }}</strong> — {{ $ticket->subject }}<div class="muted">اولویت: {{ $ticket->priority }} | وضعیت: {{ $ticket->status }} | {{ $ticket->created_at->format('Y/m/d H:i') }}</div></a>
    @empty <div class="empty">تیکتی ثبت نشده است.</div> @endforelse
    {{ $tickets->links() }}
</section>
@endsection
