@extends('layouts.app')

@section('title', 'استعادة كلمة المرور')

@section('content')
    <section class="card narrow">
        <h1>استعادة كلمة المرور</h1>
        <p>أدخل بريد ولي الأمر المسجل لإرسال رابط إعادة التعيين.</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label for="email">البريد الإلكتروني</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
            <p><button type="submit">إرسال رابط الاستعادة</button></p>
        </form>
        <a href="{{ route('login') }}">العودة لتسجيل الدخول</a>
    </section>
@endsection
