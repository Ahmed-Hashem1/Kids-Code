@extends('layouts.app')

@section('title', 'ملف الطفل')

@section('content')
    <section class="card">
        <h1>{{ $child->display_name }}</h1>
        <p>الفئة العمرية: {{ $child->age_group }}</p>
        @if ($child->enrollment)
            <p>المسار: {{ $child->enrollment->pathVersion->pathway->title }}</p>
            <p>النقاط: {{ $child->enrollment->xp_total }}</p>
        @else
            <p>لا يوجد تسجيل في مسار تعليمي بعد.</p>
        @endif
    </section>
@endsection
