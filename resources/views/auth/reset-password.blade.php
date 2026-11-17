@extends('layouts.app')

@section('title', 'تعيين كلمة مرور جديدة')

@section('content')
    <section class="card narrow">
        <h1>تعيين كلمة مرور جديدة</h1>
        <form method="POST" action="{{ route('password.store') }}" class="stack">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <label for="email">البريد الإلكتروني</label>
            <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" autocomplete="email" required>

            <label for="password">كلمة المرور الجديدة</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>

            <label for="password_confirmation">تأكيد كلمة المرور</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>

            <button type="submit">حفظ كلمة المرور</button>
        </form>
    </section>
@endsection
