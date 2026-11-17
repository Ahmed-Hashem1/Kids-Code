@extends('layouts.app')

@section('title', 'تأكيد البريد الإلكتروني')

@section('content')
    <section class="card narrow">
        <h1>أكد بريدك الإلكتروني</h1>
        <p>أرسلنا رابط التأكيد إلى بريدك. افتح الرابط لإكمال التسجيل.</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">إعادة إرسال رابط التأكيد</button>
        </form>
    </section>
@endsection
