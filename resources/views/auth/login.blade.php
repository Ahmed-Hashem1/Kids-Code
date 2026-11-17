@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
    <section class="card narrow">
        <h1>تسجيل الدخول</h1>
        <p class="muted">ولي الأمر والمدير يستخدمان البريد الإلكتروني، والطفل يستخدم اسم المستخدم.</p>
        <form method="POST" action="{{ route('login.store') }}" class="stack">
            @csrf
            <label for="identity">البريد الإلكتروني أو اسم المستخدم</label>
            <input id="identity" name="identity" value="{{ old('identity') }}" autocomplete="username" required autofocus>

            <label for="password">كلمة المرور</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>

            <label><input type="checkbox" name="remember" value="1" style="width:auto"> تذكرني</label>
            <button type="submit">دخول</button>
        </form>
        <p><a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a></p>
        <p><a href="{{ route('parent.register') }}">إنشاء حساب ولي أمر</a></p>
    </section>
@endsection
