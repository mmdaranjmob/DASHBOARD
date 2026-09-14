@extends('layouts.store')

@section('content')
<section class="section" style="padding-top:34px">
    <div class="section-head">
        <div><div class="muted">کیف پول</div><h1 style="margin:4px 0 0">تراکنش‌ها</h1></div>
        <a class="btn btn-dark" href="{{ route('account.dashboard') }}">داشبورد</a>
    </div>

    @if($transactions instanceof \Illuminate\Pagination\LengthAwarePaginator && $transactions->count())
        <div class="card" style="padding:0;overflow:auto">
            <table style="width:100%;border-collapse:collapse;min-width:760px">
                <thead><tr style="background:#f8fafc"><th style="padding:14px;text-align:right">نوع</th><th style="padding:14px;text-align:right">مبلغ</th><th style="padding:14px;text-align:right">موجودی بعد</th><th style="padding:14px;text-align:right">وضعیت</th><th style="padding:14px;text-align:right">شرح</th><th style="padding:14px;text-align:right">تاریخ</th></tr></thead>
                <tbody>
                @foreach($transactions as $tx)
                    <tr style="border-top:1px solid #edf0f5">
                        <td style="padding:14px">{{ match($tx->type) { 'credit', 'topup', 'refund' => 'افزایش', 'debit', 'purchase' => 'کاهش', default => $tx->type } }}</td>
                        <td style="padding:14px;font-weight:800">{{ number_format($tx->amount) }} ریال</td>
                        <td style="padding:14px">{{ number_format($tx->balance_after) }} ریال</td>
                        <td style="padding:14px">{{ $tx->status === 'completed' ? 'موفق' : $tx->status }}</td>
                        <td style="padding:14px">{{ $tx->description ?: '—' }}</td>
                        <td style="padding:14px">{{ $tx->created_at?->format('Y/m/d H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top:18px">{{ $transactions->links() }}</div>
    @else
        <div class="empty">هنوز تراکنشی برای کیف پول شما ثبت نشده است.</div>
    @endif
</section>
@endsection
