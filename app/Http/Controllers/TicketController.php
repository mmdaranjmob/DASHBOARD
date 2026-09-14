<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(): View
    {
        $tickets = Ticket::where('user_id', auth()->id())->latest()->paginate(15);
        return view('tickets.index', compact('tickets'));
    }

    public function create(): View
    {
        return view('tickets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'priority' => ['required', 'in:low,normal,high'],
            'message' => ['required', 'string', 'max:10000'],
        ]);

        $ticket = Ticket::create([
            'ticket_number' => 'TKT-'.strtoupper(Str::random(10)),
            'user_id' => auth()->id(),
            'subject' => $data['subject'],
            'priority' => $data['priority'],
            'status' => 'open',
        ]);
        $ticket->messages()->create(['user_id' => auth()->id(), 'message' => $data['message']]);

        return redirect()->route('account.tickets.show', $ticket)->with('success', 'تیکت با موفقیت ثبت شد.');
    }

    public function show(Ticket $ticket): View
    {
        abort_unless($ticket->user_id === auth()->id() || auth()->user()->isAdmin(), 403);
        $ticket->load(['messages.user', 'user']);
        return view('tickets.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket): RedirectResponse
    {
        abort_unless($ticket->user_id === auth()->id() || auth()->user()->isAdmin(), 403);
        $data = $request->validate(['message' => ['required', 'string', 'max:10000']]);
        $ticket->messages()->create(['user_id' => auth()->id(), 'message' => $data['message']]);
        if (auth()->user()->isAdmin()) $ticket->update(['status' => 'answered']);
        return back()->with('success', 'پیام ارسال شد.');
    }
}
