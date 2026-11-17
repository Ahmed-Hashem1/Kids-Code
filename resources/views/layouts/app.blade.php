<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'منصة أبطال البرمجة')</title>
    <style>
        :root { color-scheme: light; font-family: Tahoma, Arial, sans-serif; color: #172554; background: #f8fafc; }
        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; }
        a { color: #075985; }
        a:focus-visible, button:focus-visible, input:focus-visible { outline: 3px solid #f59e0b; outline-offset: 2px; }
        header { background: #12355b; color: #fff; padding: 1rem; }
        header a { color: #fff; }
        .header-inner, main { width: min(100% - 2rem, 72rem); margin-inline: auto; }
        .header-inner { display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        main { padding-block: 2rem; }
        .card { background: #fff; border: 1px solid #cbd5e1; border-radius: .75rem; padding: 1.25rem; margin-block: 1rem; box-shadow: 0 2px 6px #0f172a0d; }
        .narrow { max-width: 32rem; margin-inline: auto; }
        h1, h2 { line-height: 1.4; }
        label { display: block; font-weight: 700; margin-block: .9rem .35rem; }
        input { width: 100%; padding: .7rem; border: 1px solid #64748b; border-radius: .4rem; font: inherit; }
        button, .button { display: inline-block; border: 0; border-radius: .4rem; background: #075985; color: #fff; padding: .7rem 1rem; font: inherit; font-weight: 700; text-decoration: none; cursor: pointer; }
        .button-secondary { background: #334155; }
        .inline { display: inline; }
        .inline button { padding: .35rem .7rem; }
        .error, .status { padding: .75rem; border-radius: .4rem; margin-block: .75rem; }
        .error { background: #fee2e2; color: #7f1d1d; }
        .status { background: #dcfce7; color: #14532d; }
        .error ul { margin-block: .25rem; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 16rem), 1fr)); gap: 1rem; }
        .muted { color: #475569; }
        .stack > * + * { margin-top: .75rem; }
        .media { display: block; max-width: 100%; margin-block: .5rem; }
        @media (max-width: 480px) {
            .header-inner { align-items: flex-start; flex-direction: column; }
            main { padding-block: 1rem; }
            .card { padding: 1rem; }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-inner">
            <a href="{{ route('home') }}"><strong>منصة أبطال البرمجة</strong></a>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="button-secondary">تسجيل الخروج</button>
                </form>
            @else
                <nav aria-label="التنقل">
                    <a href="{{ route('login') }}">دخول</a>
                    <span aria-hidden="true"> | </span>
                    <a href="{{ route('parent.register') }}">تسجيل ولي أمر</a>
                </nav>
            @endauth
        </div>
    </header>
    <main>
        @if (session('status'))
            <p class="status" role="status">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div class="error" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
