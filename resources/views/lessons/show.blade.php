@extends('layouts.app')

@section('title', $lesson->title)

@section('content')
    <article class="card">
        <p>
            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('learn.dashboard') }}">
                {{ auth()->user()->isAdmin() ? 'العودة إلى لوحة المدير' : 'العودة إلى مساري' }}
            </a>
        </p>
        <h1>{{ $lesson->title }}</h1>
        <div>{!! nl2br(e($lesson->body)) !!}</div>
        <h2>مواد الدرس</h2>
        @foreach ($lesson->media as $media)
            <p>
                <a href="{{ route('media.show', $media) }}" class="media">
                    {{ $media->alt_text ?: 'فتح مادة الدرس' }}
                </a>
                @if ($media->kind === 'video' && $media->duration_seconds)
                    <span>المدة: {{ $media->duration_seconds }} ثانية</span>
                @endif
            </p>
        @endforeach
        @if ($lesson->challenge)
            <section class="card">
                <h2>تحدي الدرس</h2>
                <p>{{ $lesson->challenge->prompt }}</p>
                @if ($lesson->challenge->hint)
                    <details>
                        <summary>عرض تلميح</summary>
                        <p>{{ $lesson->challenge->hint }}</p>
                    </details>
                @endif
                @if (session('challenge_result'))
                    @php($result = session('challenge_result'))
                    <p class="{{ $result['is_correct'] ? 'status' : 'error' }}" role="status">
                        @if ($result['is_correct'])
                            إجابة صحيحة! حصلت على {{ $result['stars'] }} نجوم.
                        @else
                            إجابة غير صحيحة. راجع الدرس وحاول مرة أخرى.
                        @endif
                        @if ($result['replayed'])
                            تم عرض نتيجة المحاولة المحفوظة.
                        @endif
                    </p>
                @endif

                @if (auth()->user()->isChild() && $enrollment)
                    <form method="POST" action="{{ route('learn.challenges.attempts.store', $lesson->challenge) }}" class="stack">
                        @csrf
                        <input type="hidden" name="request_key" value="{{ old('request_key', $requestKey) }}">
                        @if ($lesson->challenge->kind === 'predict')
                            <h3>ما الناتج المتوقع؟</h3>
                            <pre dir="ltr"><code>{{ $lesson->challenge->config['code'] ?? '' }}</code></pre>
                            @foreach ($lesson->challenge->config['options'] ?? [] as $option)
                                <label>
                                    <input type="radio" name="option_id" value="{{ $option['id'] }}" required style="width:auto">
                                    {{ $option['text'] }}
                                </label>
                            @endforeach
                        @elseif ($lesson->challenge->kind === 'ordering')
                            <h3>رتب خطوات الحل</h3>
                            @foreach ($lesson->challenge->config['steps'] ?? [] as $step)
                                <label for="order-{{ $loop->index }}">{{ $step['text'] }}</label>
                                <select id="order-{{ $loop->index }}" name="order[]" required>
                                    <option value="">اختر ترتيب هذه الخطوة</option>
                                    @foreach ($lesson->challenge->config['steps'] as $candidate)
                                        <option value="{{ $candidate['id'] }}">{{ $candidate['text'] }}</option>
                                    @endforeach
                                </select>
                            @endforeach
                        @elseif ($lesson->challenge->kind === 'fix')
                            <h3>اختر السطر الذي يحتاج إلى إصلاح</h3>
                            <label for="line_id">السطر</label>
                            <select id="line_id" name="line_id" required>
                                <option value="">اختر السطر</option>
                                @foreach ($lesson->challenge->config['lines'] ?? [] as $line)
                                    <option value="{{ $line['id'] }}">{{ $line['text'] }}</option>
                                @endforeach
                            </select>
                            <label for="replacement_id">التصحيح المناسب</label>
                            <select id="replacement_id" name="replacement_id" required>
                                <option value="">اختر التصحيح</option>
                                @foreach ($lesson->challenge->config['replacements'] ?? [] as $replacement)
                                    <option value="{{ $replacement['id'] }}">{{ $replacement['text'] }}</option>
                                @endforeach
                            </select>
                        @elseif ($lesson->challenge->kind === 'maze')
                            <h3>اكتب أوامر الوصول إلى الهدف</h3>
                            <p>اختر الاتجاهات بالترتيب. يمكنك استخدام ما يصل إلى 12 خطوة.</p>
                            @for ($step = 0; $step < 12; $step++)
                                <label for="command-{{ $step }}">الخطوة {{ $step + 1 }}</label>
                                <select id="command-{{ $step }}" name="commands[]">
                                    <option value="">إنهاء الأوامر هنا</option>
                                    <option value="up">أعلى</option>
                                    <option value="down">أسفل</option>
                                    <option value="left">يسار</option>
                                    <option value="right">يمين</option>
                                </select>
                            @endfor
                        @endif
                        <button type="submit">تحقق من إجابتي</button>
                    </form>
                @endif
            </section>
        @endif
    </article>
@endsection
