@extends('layouts.app')

@section('title', 'تغيير كلمة المرور')

@section('content')
    <section class="card narrow">
        <h1>اختر كلمة مرور جديدة</h1>
        <p>يجب تغيير كلمة المرور المؤقتة قبل متابعة التعلم.</p>
        <form method="POST" action="{{ route('password.change.update') }}" class="stack">
            @csrf
            @method('PUT')
            <label for="password">كلمة المرور الجديدة</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>

            <label for="password_confirmation">تأكيد كلمة المرور</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>

            <button type="submit">حفظ ومتابعة</button>
        </form>
    </section>
@endsection
