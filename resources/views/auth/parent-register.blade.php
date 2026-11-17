@extends('layouts.app')

@section('title', 'تسجيل ولي أمر')

@section('content')
    <section class="card narrow">
        <h1>إنشاء حساب ولي أمر</h1>
        <p>سنرسل إلى بريدك رابطاً لتأكيد الحساب.</p>
        <form method="POST" action="{{ route('parent.register.store') }}" class="stack">
            @csrf
            <label for="name">الاسم</label>
            <input id="name" name="name" value="{{ old('name') }}" autocomplete="name" required>

            <label for="email">البريد الإلكتروني</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>

            <label for="password">كلمة المرور</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>

            <label for="password_confirmation">تأكيد كلمة المرور</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>

            <button type="submit">إنشاء الحساب</button>
        </form>
        <p><a href="{{ route('login') }}">لديك حساب؟ سجل الدخول</a></p>
    </section>
@endsection
