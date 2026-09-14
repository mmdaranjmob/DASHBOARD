@extends('layouts.store')
@section('content')
<div class="form-box"><h2>ثبت تیکت</h2><form method="POST" action="{{ route('account.tickets.store') }}">@csrf<div class="form-group"><label>موضوع</label><input name="subject" value="{{ old('subject') }}" required></div><div class="form-group"><label>اولویت</label><select name="priority"><option value="normal">عادی</option><option value="low">کم</option><option value="high">زیاد</option></select></div><div class="form-group"><label>پیام</label><textarea name="message" rows="8" required>{{ old('message') }}</textarea></div><button class="btn btn-dark">ثبت تیکت</button></form></div>
@endsection
