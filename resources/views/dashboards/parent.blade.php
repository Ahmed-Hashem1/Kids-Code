@extends('layouts.app')

@section('title', 'لوحة ولي الأمر')

@section('content')
    <section class="card">
        <h1>لوحة ولي الأمر</h1>
        <p>مرحباً {{ auth()->user()->name }}.</p>
        <h2>حسابات الأطفال</h2>
        @forelse ($children as $child)
            <article class="card">
                <h3>{{ $child->display_name }}</h3>
                <p>الفئة العمرية: {{ $child->age_group }}</p>
                <a class="button" href="{{ route('parent.children.show', $child) }}">عرض التقدم</a>
            </article>
        @empty
            <p>لا توجد حسابات أطفال مرتبطة بهذا الحساب.</p>
        @endforelse
    </section>
@endsection
