@extends('layouts.app')

@section('title', 'لوحة المدير')

@section('content')
    <section class="card">
        <h1>لوحة مدير المنصة</h1>
        <p>مرحباً {{ auth()->user()->name }}.</p>
    </section>
@endsection
