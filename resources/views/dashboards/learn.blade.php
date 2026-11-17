@extends('layouts.app')

@section('title', 'رحلتي التعليمية')

@section('content')
    <section class="card">
        <h1>مرحباً {{ auth()->user()->childProfile->display_name }}</h1>
        <p>مسارك: {{ $enrollment->pathVersion->pathway->title }}</p>
        <p>نقاطك: {{ $enrollment->xp_total }} — رتبتك: {{ $enrollment->rank }}</p>
        <p>إنجاز الدروس: {{ $completedLessons }} من {{ $totalLessons }}</p>
        <progress value="{{ $completedLessons }}" max="{{ max(1, $totalLessons) }}" aria-label="تقدم الدروس"></progress>
    </section>

    <section class="card">
        <h2>رحلة التعلم</h2>
        @foreach ($enrollment->pathVersion->levels as $level)
            <section class="card">
                <h3>المستوى {{ $level->position }}: {{ $level->title }}</h3>
                <div class="grid">
                    @foreach ($level->lessons as $lesson)
                        @php
                            $progress = $lesson->progress->first();
                        @endphp
                        <article class="card">
                            <h4>{{ $lesson->title }}</h4>
                            @if ($progress?->completed_at)
                                <p class="status">أكملت هذا الدرس</p>
                            @else
                                <p class="muted">لم يكتمل بعد</p>
                            @endif
                            @if ($lesson->challenge)
                                <p>تحدي: {{ $lesson->challenge->kind }}</p>
                            @endif
                            <a class="button" href="{{ route('learn.lessons.show', $lesson) }}">
                                {{ $progress?->completed_at ? 'راجع الدرس' : 'ابدأ الدرس' }}
                            </a>
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach
    </section>

    <section class="card">
        <h2>أوسمتي</h2>
        @forelse ($badges as $childBadge)
            <article class="card">
                <h3>{{ $childBadge->badge->name }}</h3>
                <p>{{ $childBadge->badge->rule_value }}</p>
            </article>
        @empty
            <p>واصل التعلم لتحصل على أوسمتك الأولى.</p>
        @endforelse
    </section>
@endsection
