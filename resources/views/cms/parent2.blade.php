<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كودي | منصة تعليم البرمجة للأطفال</title>
    <!-- خط تجوال العربي من Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Tajawal', 'sans-serif'],
                    },
                    colors: {
                        brandBlue: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#2563eb',
                            600: '#1d4ed8',
                            700: '#1e40af',
                        },
                        brandMint: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 30px -5px rgba(37, 99, 235, 0.08), 0 4px 12px -2px rgba(16, 185, 129, 0.05)',
                        'card': '0 15px 35px -5px rgba(15, 23, 42, 0.06)',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8fafc;
            scroll-behavior: smooth;
        }
        .page-section {
            display: none;
            animation: fadeIn 0.35s ease-in-out;
        }
        .page-section.active {
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hover-scale {
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
        }
        .hover-scale:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body class="text-slate-800 antialiased selection:bg-brandMint-400 selection:text-white">

    <!-- ==================== شريط التنقل العلوي (Navbar) ==================== -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <!-- الشعار (كودي) -->
                <div class="flex items-center gap-3 cursor-pointer hover-scale" onclick="navigateTo('home')">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-brandBlue-600 to-brandMint-500 flex items-center justify-center text-white shadow-soft">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-black bg-gradient-to-l from-brandBlue-600 to-brandMint-600 bg-clip-text text-transparent">كودي</span>
                        <span class="block text-xs font-bold text-slate-400 -mt-1">نبرمج المستقبل بمرح</span>
                    </div>
                </div>

                <!-- روابط التنقل (Desktop) -->
                <div class="hidden md:flex items-center gap-2 bg-slate-50 p-1.5 rounded-2xl border border-slate-100">
                    <button onclick="navigateTo('home')" id="nav-home" class="nav-link px-4 py-2 rounded-xl text-sm font-bold transition-all bg-white text-brandBlue-600 shadow-sm">الرئيسية</button>
                    <button onclick="navigateTo('tracks')" id="nav-tracks" class="nav-link px-4 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-brandBlue-600 transition-all">المسارات التعليمية</button>
                    <button onclick="navigateTo('placement')" id="nav-placement" class="nav-link px-4 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-brandBlue-600 transition-all">تحديد المستوى</button>
                  </div>

                <a href="{{ route('login') }}" class="hover-scale bg-slate-100 hover:bg-brandBlue-50 text-slate-700 hover:text-brandBlue-600 font-extrabold px-4 py-3 rounded-2xl transition-all text-sm hidden sm:flex items-center gap-2 border border-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>دخول</span>
                </a>

                <!-- زر احجز الآن + زر القائمة للموبايل -->
                <div class="flex items-center gap-3">
                    <button onclick="openBookingModal()" class="hover-scale bg-gradient-to-l from-brandBlue-600 to-brandMint-500 hover:from-brandBlue-700 hover:to-brandMint-600 text-white font-extrabold px-6 py-3 rounded-2xl shadow-soft text-sm sm:text-base flex items-center gap-2">
                        <span>احجز الآن</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button onclick="toggleMobileMenu()" class="md:hidden p-2.5 rounded-2xl bg-slate-100 text-slate-700 hover:bg-brandBlue-50 hover:text-brandBlue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- قائمة الموبايل المنسدلة -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100 px-4 pt-3 pb-5 space-y-2 shadow-lg">
            <button onclick="navigateTo('home'); toggleMobileMenu()" class="block w-full text-right px-4 py-2.5 rounded-xl font-bold text-brandBlue-600 bg-brandBlue-50">الرئيسية</button>
            <button onclick="navigateTo('tracks'); toggleMobileMenu()" class="block w-full text-right px-4 py-2.5 rounded-xl font-bold text-slate-600 hover:bg-slate-50">المسارات التعليمية (7-15 سنة)</button>
            <button onclick="navigateTo('placement'); toggleMobileMenu()" class="block w-full text-right px-4 py-2.5 rounded-xl font-bold text-slate-600 hover:bg-slate-50">اختبار تحديد المستوى</button>
        </div>
    </nav>

    <!-- ==================== 1. الصفحة الرئيسية (Home) ==================== -->
    <section id="page-home" class="page-section active">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-b from-brandBlue-50/70 via-white to-brandMint-50/40 pt-12 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- النصوص -->
                    <div class="space-y-6 text-center lg:text-right">
                        <div class="inline-flex items-center gap-2 bg-brandMint-100 text-brandMint-600 px-4 py-2 rounded-full text-sm font-extrabold">
                            <span>🚀</span>
                            <span>منصة عربية آمنة لتعليم البرمجة للأعمار من 7 إلى 15 سنة</span>
                        </div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-tight">
                            حوّل شغف طفلك بالألعاب إلى <span class="text-brandBlue-600">إبداع برمجي</span> حقيقي!
                        </h1>
                        <p class="text-lg sm:text-xl text-slate-600 font-medium leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            يتعلم طفلك في <strong>كودي</strong> أساسيات التفكير المنطقي، ثم ينتقل لقراءة وفهم كود <strong>Python</strong> و <strong>Java</strong> من خلال فيديوهات قصيرة، شروحات مصوّرة، وتحديات ذكية بدون تعقيد.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-2">
                            <button onclick="openBookingModal()" class="hover-scale bg-brandBlue-600 hover:bg-brandBlue-700 text-white font-extrabold px-8 py-4 rounded-2xl shadow-soft text-lg">
                                احجز مقعد طفلك الآن
                            </button>
                            <button onclick="navigateTo('placement')" class="hover-scale bg-white hover:bg-brandMint-50 text-brandMint-600 border-2 border-brandMint-500 font-extrabold px-8 py-4 rounded-2xl shadow-sm text-lg">
                                جرّب اختبار تحديد المستوى
                            </button>
                        </div>

                        <!-- إحصائيات سريعة حسب التحليل -->
                        <div class="grid grid-cols-3 gap-4 pt-6 max-w-lg mx-auto lg:mx-0">
                            <div class="bg-white p-4 rounded-2xl shadow-card border border-slate-100 text-center">
                                <div class="text-2xl font-black text-brandBlue-600">3 مسارات</div>
                                <div class="text-xs font-bold text-slate-500">حسب الفئة العمرية</div>
                            </div>
                            <div class="bg-white p-4 rounded-2xl shadow-card border border-slate-100 text-center">
                                <div class="text-2xl font-black text-brandMint-500">27 درساً</div>
                                <div class="text-xs font-bold text-slate-500">تفاعلياً ومصوّراً</div>
                            </div>
                            <div class="bg-white p-4 rounded-2xl shadow-card border border-slate-100 text-center">
                                <div class="text-2xl font-black text-amber-500">4 تحديات</div>
                                <div class="text-xs font-bold text-slate-500">تقييم فوري آمن</div>
                            </div>
                        </div>
                    </div>

                    <!-- بطاقة تفاعلية بصرية للطفل -->
                    <div class="relative">
                        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-card border-2 border-brandBlue-100 hover-scale">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-brandMint-100 text-brandMint-600 flex items-center justify-center text-2xl">🤖</div>
                                    <div>
                                        <h3 class="font-extrabold text-slate-900">تحدي إصلاح الخطأ (Python)</h3>
                                        <span class="text-xs font-bold text-brandBlue-600 bg-brandBlue-50 px-2.5 py-1 rounded-lg">الفئة: 10 - 12 سنة</span>
                                    </div>
                                </div>
                                <span class="bg-amber-100 text-amber-700 font-extrabold text-xs px-3 py-1.5 rounded-xl">+10 XP ⭐</span>
                            </div>

                            <!-- محاكي كود بسيط -->
                            <div dir="ltr" class="bg-slate-900 text-slate-100 p-5 rounded-2xl font-mono text-sm space-y-2 text-left shadow-inner">
                                <div class="flex gap-1.5 mb-3">
                                    <span class="w-3 h-3 rounded-full bg-rose-400"></span>
                                    <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                                    <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                                </div>
                                <p class="text-slate-400"># أطبع رسالة ترحيب في كودي</p>
                                <p><span class="text-emerald-400">name</span> = <span class="text-amber-300">"أحمد"</span></p>
                                <p><span class="text-sky-400">print</span>(<span class="text-amber-300">"مرحباً يا "</span> + name)</p>
                            </div>

                            <!-- خطوات إكمال الدرس الثلاثة من SRS -->
                            <div class="mt-6 grid grid-cols-3 gap-3">
                                <div class="bg-brandMint-50 border border-brandMint-200 p-3 rounded-2xl text-center">
                                    <div class="text-lg">🎬</div>
                                    <div class="text-xs font-extrabold text-brandMint-700 mt-1">1. فيديو قصير</div>
                                    <div class="text-[11px] text-slate-500">اعتماد عند 90%</div>
                                </div>
                                <div class="bg-brandBlue-50 border border-brandBlue-200 p-3 rounded-2xl text-center">
                                    <div class="text-lg">📖</div>
                                    <div class="text-xs font-extrabold text-brandBlue-700 mt-1">2. شرح مصوّر</div>
                                    <div class="text-[11px] text-slate-500">بسيط وممتع</div>
                                </div>
                                <div class="bg-amber-50 border border-amber-200 p-3 rounded-2xl text-center">
                                    <div class="text-lg">🧩</div>
                                    <div class="text-xs font-extrabold text-amber-700 mt-1">3. تحدٍ عملي</div>
                                    <div class="text-[11px] text-slate-500">حتى 3 نجوم</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- قسم المسارات العمرية المختصر -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-brandMint-600 font-extrabold text-sm bg-brandMint-50 px-4 py-1.5 rounded-full">منهج متدرج ومعتمد</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3">3 مسارات تعليمية تناسب عمر طفلك</h2>
                <p class="text-slate-600 mt-2 font-medium">يختار ولي الأمر الفئة العمرية، ويبدأ الطفل من المستوى المناسب له بعد اختبار تحديد المستوى.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- المسار الأول: 7-9 -->
                <div class="bg-white rounded-3xl p-7 shadow-card border border-slate-100 hover-scale flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-brandMint-100 text-brandMint-600 flex items-center justify-center text-3xl mb-5">🧩</div>
                        <span class="bg-brandMint-50 text-brandMint-600 text-xs font-extrabold px-3 py-1 rounded-xl">الفئة العمرية: 7 - 9 سنوات</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-3">المستكشف الصغير (منطق بصري)</h3>
                        <p class="text-slate-600 text-sm mt-2 leading-relaxed">بناء التفكير المنطقي بدون كتابة كود معقد عبر الألغاز البصرية والحركة.</p>
                        <ul class="mt-5 space-y-2.5 text-sm font-bold text-slate-700">
                            <li class="flex items-center gap-2"><span class="text-brandMint-500">✔</span> المستوى 1: التسلسل المنطقي</li>
                            <li class="flex items-center gap-2"><span class="text-brandMint-500">✔</span> المستوى 2: التكرار والعد</li>
                            <li class="flex items-center gap-2"><span class="text-brandMint-500">✔</span> المستوى 3: الشرط وتتبع الناتج</li>
                        </ul>
                    </div>
                    <button onclick="navigateTo('tracks')" class="mt-7 w-full py-3 rounded-2xl bg-brandMint-50 hover:bg-brandMint-500 text-brandMint-600 hover:text-white font-extrabold transition-colors">استكشف تفاصيل المسار</button>
                </div>

                <!-- المسار الثاني: 10-12 -->
                <div class="bg-white rounded-3xl p-7 shadow-card border-2 border-brandBlue-500 hover-scale flex flex-col justify-between relative">
                    <span class="absolute -top-3.5 left-6 bg-brandBlue-600 text-white text-xs font-extrabold px-4 py-1 rounded-full shadow-sm">الأكثر طلباً</span>
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-brandBlue-100 text-brandBlue-600 flex items-center justify-center text-3xl mb-5">🐍</div>
                        <span class="bg-brandBlue-50 text-brandBlue-600 text-xs font-extrabold px-3 py-1 rounded-xl">الفئة العمرية: 10 - 12 سنة</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-3">مبرمج بايثون (Python)</h3>
                        <p class="text-slate-600 text-sm mt-2 leading-relaxed">الانتقال السلس لقراءة وفهم لغة بايثون وتوقع مخرجاتها وإصلاح أخطائها.</p>
                        <ul class="mt-5 space-y-2.5 text-sm font-bold text-slate-700">
                            <li class="flex items-center gap-2"><span class="text-brandBlue-600">✔</span> المستوى 1: الطباعة print والمتغيرات</li>
                            <li class="flex items-center gap-2"><span class="text-brandBlue-600">✔</span> المستوى 2: الجمل الشرطية if / else</li>
                            <li class="flex items-center gap-2"><span class="text-brandBlue-600">✔</span> المستوى 3: الحلقات التكرارية for / while</li>
                        </ul>
                    </div>
                    <button onclick="navigateTo('tracks')" class="mt-7 w-full py-3 rounded-2xl bg-brandBlue-600 hover:bg-brandBlue-700 text-white font-extrabold transition-colors">استكشف تفاصيل المسار</button>
                </div>

                <!-- المسار الثالث: 13-15 -->
                <div class="bg-white rounded-3xl p-7 shadow-card border border-slate-100 hover-scale flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-3xl mb-5">☕</div>
                        <span class="bg-emerald-50 text-emerald-600 text-xs font-extrabold px-3 py-1 rounded-xl">الفئة العمرية: 13 - 15 سنة</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-3">مهندس المستقبل (Python & Java)</h3>
                        <p class="text-slate-600 text-sm mt-2 leading-relaxed">تعميق الخوارزميات بلغة بايثون ثم التعرف على بنية لغة Java والمقارنة بينهما.</p>
                        <ul class="mt-5 space-y-2.5 text-sm font-bold text-slate-700">
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✔</span> المستوى 1: القوائم والدوال (Python)</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✔</span> المستوى 2: خوارزميات صغيرة</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500">✔</span> المستوى 3: بنية وأنواع Java والمقارنة</li>
                        </ul>
                    </div>
                    <button onclick="navigateTo('tracks')" class="mt-7 w-full py-3 rounded-2xl bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white font-extrabold transition-colors">استكشف تفاصيل المسار</button>
                </div>
            </div>
        </div>

        <!-- خصوصية وأمان الأطفال (من قسم قواعد العمل في SRS) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="bg-gradient-to-l from-brandBlue-600 to-brandMint-600 rounded-3xl p-8 sm:p-12 text-white shadow-soft">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    <div class="md:col-span-2 space-y-3">
                        <h3 class="text-2xl sm:text-3xl font-black">بيئة تعليمية آمنة 100% تحترم خصوصية طفلك 🛡️</h3>
                        <p class="text-blue-50 font-medium leading-relaxed">
                            في منصة <strong>كودي</strong>، لا نطلب تاريخ ميلاد الطفل أو صوره الشخصية؛ يكتفي ولي الأمر باختيار الفئة العمرية واسم مستعار وأفاتار كرتوني. كما لا توجد دردشة مفتوحة أو لوحات شرف للمقارنة المحبطة، بل تحفيز ذاتي عبر نقاط XP والأوسمة!
                        </p>
                    </div>
                    <div class="text-center md:text-left">
                        <button onclick="openBookingModal()" class="hover-scale bg-white text-brandBlue-600 font-black px-8 py-4 rounded-2xl shadow-lg text-base">
                            أنشئ حساب ولي الأمر مجاناً
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 2. صفحة المسارات التعليمية (Tracks) ==================== -->
    <section id="page-tracks" class="page-section py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="bg-white rounded-3xl p-8 shadow-card border border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h2 class="text-3xl font-black text-slate-900">المنهج التعليمي والمسارات المعتمدة</h2>
                    <p class="text-slate-600 mt-1 font-medium">كل مسار يتكون من 3 مستويات، وكل مستوى يحتوي على دروس تفاعلية + اختبار نهاية مستوى (النجاح 80%).</p>
                </div>
                <button onclick="navigateTo('placement')" class="hover-scale bg-brandMint-500 hover:bg-brandMint-600 text-white font-extrabold px-6 py-3.5 rounded-2xl shadow-soft shrink-0">
                    ابدأ اختبار تحديد المستوى (9 أسئلة)
                </button>
            </div>

            <!-- جدول المنهج الكامل من القسم 2 في SRS -->
            <div class="grid grid-cols-1 gap-8">
                <!-- مسار 7-9 -->
                <div class="bg-white rounded-3xl p-8 shadow-card border border-slate-100">
                    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-5 mb-6">
                        <div class="flex items-center gap-4">
                            <span class="w-12 h-12 rounded-2xl bg-brandMint-100 text-brandMint-600 flex items-center justify-center text-2xl font-black">1</span>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">مسار البراعم (7 - 9 سنوات)</h3>
                                <span class="text-sm font-bold text-brandMint-600">اللغة المستخدمة: تفكير منطقي بصري (بدون كود نصي)</span>
                            </div>
                        </div>
                        <button onclick="openBookingModal('7-9')" class="bg-brandMint-500 text-white font-bold px-5 py-2.5 rounded-xl hover:bg-brandMint-600">التسجيل في هذا المسار</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-xs font-extrabold text-brandBlue-600 bg-brandBlue-50 px-3 py-1 rounded-lg">المستوى الأول</span>
                            <h4 class="text-lg font-black mt-2">التسلسل (Sequence)</h4>
                            <p class="text-sm text-slate-600 mt-1">ترتيب الخطوات والأوامر المنطقية لتحريك الشخصية والوصول للهدف.</p>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-xs font-extrabold text-brandBlue-600 bg-brandBlue-50 px-3 py-1 rounded-lg">المستوى الثاني</span>
                            <h4 class="text-lg font-black mt-2">التكرار والعد (Loops)</h4>
                            <p class="text-sm text-slate-600 mt-1">اكتشاف الأنماط المتكررة واختصار الأوامر باستخدام الحلقات البصرية.</p>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-xs font-extrabold text-brandBlue-600 bg-brandBlue-50 px-3 py-1 rounded-lg">المستوى الثالث</span>
                            <h4 class="text-lg font-black mt-2">الشرط وتتبع الناتج</h4>
                            <p class="text-sm text-slate-600 mt-1">اتخاذ القرارات البسيطة (إذا حدث كذا افعل كذا) وتوقع النتيجة.</p>
                        </div>
                    </div>
                </div>

                <!-- مسار 10-12 -->
                <div class="bg-white rounded-3xl p-8 shadow-card border border-slate-100">
                    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-5 mb-6">
                        <div class="flex items-center gap-4">
                            <span class="w-12 h-12 rounded-2xl bg-brandBlue-100 text-brandBlue-600 flex items-center justify-center text-2xl font-black">2</span>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">مسار المبرمج الواعد (10 - 12 سنة)</h3>
                                <span class="text-sm font-bold text-brandBlue-600">اللغة المستخدمة: Python (قراءة وتوقع وإصلاح الأخطاء)</span>
                            </div>
                        </div>
                        <button onclick="openBookingModal('10-12')" class="bg-brandBlue-600 text-white font-bold px-5 py-2.5 rounded-xl hover:bg-brandBlue-700">التسجيل في هذا المسار</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-xs font-extrabold text-brandMint-600 bg-brandMint-50 px-3 py-1 rounded-lg">المستوى الأول</span>
                            <h4 class="text-lg font-black mt-2">print والمتغيرات</h4>
                            <p class="text-sm text-slate-600 mt-1">فهم طريقة تخزين البيانات في المتغيرات وإظهار المخرجات على الشاشة.</p>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-xs font-extrabold text-brandMint-600 bg-brandMint-50 px-3 py-1 rounded-lg">المستوى الثاني</span>
                            <h4 class="text-lg font-black mt-2">الشروط if / else</h4>
                            <p class="text-sm text-slate-600 mt-1">قراءة الشروط المنطقية والمقارنات وتحديد المسار الذي سينفذه البرنامج.</p>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-xs font-extrabold text-brandMint-600 bg-brandMint-50 px-3 py-1 rounded-lg">المستوى الثالث</span>
                            <h4 class="text-lg font-black mt-2">التكرار for / while</h4>
                            <p class="text-sm text-slate-600 mt-1">تتبع العدادات وحساب عدد مرات تنفيذ الكود واكتشاف الأخطاء المنطقية.</p>
                        </div>
                    </div>
                </div>

                <!-- مسار 13-15 -->
                <div class="bg-white rounded-3xl p-8 shadow-card border border-slate-100">
                    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-5 mb-6">
                        <div class="flex items-center gap-4">
                            <span class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl font-black">3</span>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900">مسار المحترفين (13 - 15 سنة)</h3>
                                <span class="text-sm font-bold text-emerald-600">اللغة المستخدمة: Python ثم Java</span>
                            </div>
                        </div>
                        <button onclick="openBookingModal('13-15')" class="bg-emerald-600 text-white font-bold px-5 py-2.5 rounded-xl hover:bg-emerald-700">التسجيل في هذا المسار</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-xs font-extrabold text-brandBlue-600 bg-brandBlue-50 px-3 py-1 rounded-lg">المستوى الأول</span>
                            <h4 class="text-lg font-black mt-2">قوائم ودوال (Python)</h4>
                            <p class="text-sm text-slate-600 mt-1">التعامل مع المصفوفات والقوائم واستدعاء الدوال وتمرير المعاملات.</p>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-xs font-extrabold text-brandBlue-600 bg-brandBlue-50 px-3 py-1 rounded-lg">المستوى الثاني</span>
                            <h4 class="text-lg font-black mt-2">خوارزميات صغيرة</h4>
                            <p class="text-sm text-slate-600 mt-1">تحليل خوارزميات البحث والفرز البسيطة وتوقع نواتجها خطوة بخطوة.</p>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-xs font-extrabold text-brandBlue-600 bg-brandBlue-50 px-3 py-1 rounded-lg">المستوى الثالث</span>
                            <h4 class="text-lg font-black mt-2">بنية وأنواع Java</h4>
                            <p class="text-sm text-slate-600 mt-1">فهم الأنواع الصارمة (int, String) ومقارنة كتابة الكود بين Java و Python.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 3. صفحة اختبار تحديد المستوى (Placement Test) ==================== -->
    <section id="page-placement" class="page-section py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-card border border-slate-100">
                <div class="flex items-center justify-between border-b border-slate-100 pb-6 mb-6">
                    <div>
                        <span class="text-xs font-extrabold bg-brandBlue-50 text-brandBlue-600 px-3 py-1 rounded-full">قاعدة العمل BR-02</span>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2">اختبار تحديد المستوى الذكي</h2>
                        <p class="text-sm text-slate-500 mt-1">أجب عن الأسئلة لنحدد لك نقطة البداية المثالية (المستوى 1 أو 2 أو 3).</p>
                    </div>
                    <div class="text-3xl">🎯</div>
                </div>

                <!-- نموذج اختبار تفاعلي -->
                <form id="placement-form" onsubmit="evaluatePlacement(event)" class="space-y-6">
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                        <p class="font-extrabold text-slate-800 mb-3">1. ما هو ناتج الكود التالي في بايثون: <code dir="ltr" class="bg-slate-200 px-2 py-0.5 rounded text-brandBlue-700">print(3 + 4 * 2)</code> ؟</p>
                        <div class="space-y-2 text-sm font-bold">
                            <label class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 cursor-pointer hover:border-brandBlue-500">
                                <input type="radio" name="q1" value="0" required class="accent-brandBlue-600 w-4 h-4">
                                <span>14</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 cursor-pointer hover:border-brandBlue-500">
                                <input type="radio" name="q1" value="3" class="accent-brandBlue-600 w-4 h-4">
                                <span>11 (الضرب يسبق الجمع)</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                        <p class="font-extrabold text-slate-800 mb-3">2. ماذا تطبع الجملة الشرطية إذا كانت <code dir="ltr" class="bg-slate-200 px-2 py-0.5 rounded text-brandBlue-700">x = 10</code>: <code dir="ltr" class="bg-slate-200 px-2 py-0.5 rounded">if x > 5: print("نعم") else: print("لا")</code> ؟</p>
                        <div class="space-y-2 text-sm font-bold">
                            <label class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 cursor-pointer hover:border-brandBlue-500">
                                <input type="radio" name="q2" value="3" required class="accent-brandBlue-600 w-4 h-4">
                                <span>نعم</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 cursor-pointer hover:border-brandBlue-500">
                                <input type="radio" name="q2" value="0" class="accent-brandBlue-600 w-4 h-4">
                                <span>لا</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                        <p class="font-extrabold text-slate-800 mb-3">3. كم مرة تتكرر الحلقة: <code dir="ltr" class="bg-slate-200 px-2 py-0.5 rounded text-brandBlue-700">for i in range(4):</code> ؟</p>
                        <div class="space-y-2 text-sm font-bold">
                            <label class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 cursor-pointer hover:border-brandBlue-500">
                                <input type="radio" name="q3" value="3" required class="accent-brandBlue-600 w-4 h-4">
                                <span>4 مرات (من 0 إلى 3)</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 cursor-pointer hover:border-brandBlue-500">
                                <input type="radio" name="q3" value="0" class="accent-brandBlue-600 w-4 h-4">
                                <span>5 مرات</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full hover-scale bg-gradient-to-l from-brandBlue-600 to-brandMint-500 text-white font-black py-4 rounded-2xl shadow-soft text-lg">
                        اعتماد النتيجة وتحديد مستوى البداية
                    </button>
                </form>

                <!-- نتيجة الاختبار -->
                <div id="placement-result" class="hidden mt-8 bg-brandMint-50 border-2 border-brandMint-400 rounded-3xl p-6 text-center space-y-4">
                    <div class="text-4xl">🎉</div>
                    <h3 id="placement-title" class="text-2xl font-black text-slate-900"></h3>
                    <p id="placement-desc" class="text-slate-700 font-medium"></p>
                    <button onclick="navigateTo('child-dashboard')" class="bg-brandBlue-600 text-white font-extrabold px-8 py-3 rounded-2xl shadow-sm hover:bg-brandBlue-700">
                        الانتقال إلى لوحة الطفل وبدء التعلم
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 4. لوحة الطفل وصفحة الدرس والتحدي (Child Dashboard & Lesson) ==================== -->
    <section id="page-child-dashboard" class="page-section py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- شريط حالة الطفل (XP، الرتبة، الأوسمة، زر تابع التعلم) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-card border border-slate-100 flex flex-col lg:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-brandBlue-500 to-brandMint-400 text-white flex items-center justify-center text-3xl shadow-soft">🦊</div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-2xl font-black text-slate-900">أهلاً يا بطل، أسامة!</h2>
                            <span id="child-rank-badge" class="bg-brandMint-100 text-brandMint-700 text-xs font-extrabold px-3 py-1 rounded-full">رتبة: مبرمج واعد</span>
                        </div>
                        <p class="text-sm text-slate-500 font-bold mt-1">المسار: مبرمج بايثون (10 - 12 سنة) • المستوى الحالي: 1</p>
                    </div>
                </div>

                <!-- عداد نقاط الخبرة XP -->
                <div class="flex flex-wrap items-center gap-4">
                    <div class="bg-brandBlue-50 px-5 py-3 rounded-2xl text-center border border-brandBlue-100">
                        <div class="text-xs font-bold text-brandBlue-600">نقاط الخبرة (XP)</div>
                        <div id="xp-counter" class="text-2xl font-black text-brandBlue-700">120 XP</div>
                    </div>
                    <div class="bg-amber-50 px-5 py-3 rounded-2xl text-center border border-amber-100">
                        <div class="text-xs font-bold text-amber-600">الأوسمة المكتسبة</div>
                        <div class="text-2xl font-black text-amber-600">🏅 3 أوسمة</div>
                    </div>
                    <a href="#active-lesson-box" class="hover-scale bg-brandMint-500 hover:bg-brandMint-600 text-white font-black px-6 py-4 rounded-2xl shadow-soft">
                        تابع التعلم ▶
                    </a>
                </div>
            </div>

            <!-- خريطة الدروس بالحالات الأربعة (مكتمل، متاح، مقفل، متجاوز) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border-2 border-brandMint-400 shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-extrabold bg-brandMint-100 text-brandMint-700 px-2.5 py-1 rounded-lg">مكتمل ✔</span>
                        <span class="text-amber-400 text-sm">⭐⭐⭐</span>
                    </div>
                    <h4 class="font-black text-slate-800">الدرس 1: ما هي البرمجة؟</h4>
                    <p class="text-xs text-slate-500 mt-1">+10 XP مكتسبة</p>
                </div>

                <div class="bg-white p-5 rounded-2xl border-2 border-brandBlue-500 shadow-soft">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-extrabold bg-brandBlue-100 text-brandBlue-700 px-2.5 py-1 rounded-lg">متاح الآن 🔥</span>
                        <span class="text-slate-300 text-sm">☆☆☆</span>
                    </div>
                    <h4 class="font-black text-slate-800">الدرس 2: المتغيرات و print</h4>
                    <p class="text-xs text-brandBlue-600 font-bold mt-1">قيد التعلم حالياً</p>
                </div>

                <div class="bg-slate-100/80 p-5 rounded-2xl border border-slate-200 opacity-75">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-extrabold bg-slate-200 text-slate-600 px-2.5 py-1 rounded-lg">مقفل 🔒</span>
                    </div>
                    <h4 class="font-bold text-slate-600">الدرس 3: العمليات الحسابية</h4>
                    <p class="text-xs text-slate-500 mt-1">يُفتح بعد إكمال الدرس 2</p>
                </div>

                <div class="bg-slate-100/80 p-5 rounded-2xl border border-slate-200 opacity-75">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-extrabold bg-amber-100 text-amber-700 px-2.5 py-1 rounded-lg">اختبار المستوى 🏆</span>
                    </div>
                    <h4 class="font-bold text-slate-600">اختبار نهاية المستوى 1</h4>
                    <p class="text-xs text-slate-500 mt-1">5 أسئلة (النجاح 80%)</p>
                </div>
            </div>

            <!-- صفحة الدرس التفاعلية (شروط الإكمال الثلاثة: فيديو 90% + قراءة + تحدٍ) -->
            <div id="active-lesson-box" class="bg-white rounded-3xl p-6 sm:p-8 shadow-card border border-slate-100 space-y-8">
                <div class="flex flex-wrap justify-between items-center gap-4 border-b border-slate-100 pb-5">
                    <div>
                        <span class="text-xs font-extrabold text-brandBlue-600 bg-brandBlue-50 px-3 py-1 rounded-lg">المستوى 1 • الدرس 2</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-2">المتغيرات وأمر الطباعة <code dir="ltr" class="text-brandBlue-600">print()</code> في Python</h3>
                    </div>
                    <!-- مؤشر شروط إكمال الدرس الثلاثة -->
                    <div class="flex items-center gap-2 text-xs font-extrabold">
                        <span id="step-video-badge" class="px-3 py-1.5 rounded-xl bg-slate-100 text-slate-500">1. الفيديو (0%)</span>
                        <span id="step-read-badge" class="px-3 py-1.5 rounded-xl bg-slate-100 text-slate-500">2. القراءة</span>
                        <span id="step-challenge-badge" class="px-3 py-1.5 rounded-xl bg-slate-100 text-slate-500">3. التحدي</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- العمود الأول: الفيديو + الشرح المصور -->
                    <div class="space-y-6">
                        <!-- محاكي مشغل الفيديو (يتطلب 90% حسب FR-08) -->
                        <div class="bg-slate-900 rounded-3xl p-6 text-white space-y-4 relative overflow-hidden">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold bg-white/10 px-3 py-1 rounded-full">🎬 شرح الفيديو القصير (دقيقتان)</span>
                                <span id="video-percent-text" class="text-xs font-extrabold text-brandMint-400">نسبة المشاهدة الفريدة: 0%</span>
                            </div>
                            <div class="h-44 rounded-2xl bg-gradient-to-tr from-brandBlue-700 to-brandMint-600 flex flex-col items-center justify-center text-center p-4">
                                <div class="text-5xl mb-2">▶️</div>
                                <p class="font-extrabold text-lg">كيف نخزّن الأسماء والأرقام داخل صندوق المتغير؟</p>
                            </div>
                            <div class="w-full bg-slate-700 h-2.5 rounded-full overflow-hidden">
                                <div id="video-progress-bar" class="bg-brandMint-400 h-full transition-all duration-500" style="width: 0%"></div>
                            </div>
                            <button onclick="simulateVideoWatch()" class="w-full bg-brandMint-500 hover:bg-brandMint-600 text-white font-extrabold py-2.5 rounded-xl text-sm transition-colors">
                                محاكاة إتمام مشاهدة 90% من الفيديو
                            </button>
                        </div>

                        <!-- الشرح المصور وزر قرأت الدرس (FR-09) -->
                        <div class="bg-brandBlue-50/60 border border-brandBlue-100 rounded-3xl p-6 space-y-4">
                            <h4 class="font-black text-lg text-brandBlue-700">📖 الشرح المصوّر:</h4>
                            <p class="text-sm text-slate-700 leading-relaxed font-medium">
                                تخيّل <strong>المتغير (Variable)</strong> كصندوق صغير نضع عليه اسماً (مثل <code class="bg-white px-1.5 py-0.5 rounded font-bold">score</code>) ونحفظ بداخله قيمة (مثل <code class="bg-white px-1.5 py-0.5 rounded font-bold">100</code>). وعندما نريد عرض ما بداخل الصندوق نستخدم الأمر <code class="bg-white px-1.5 py-0.5 rounded font-bold">print(score)</code>.
                            </p>
                            <button id="btn-mark-read" onclick="markLessonRead()" class="bg-brandBlue-600 hover:bg-brandBlue-700 text-white font-extrabold px-5 py-2.5 rounded-xl text-sm transition-all">
                                ✔ قرأت الدرس وفهمت الشرح
                            </button>
                        </div>
                    </div>

                    <!-- العمود الثاني: محرك التحديات الأربعة (FR-10) -->
                    <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6 flex flex-col justify-between space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="bg-amber-100 text-amber-800 text-xs font-extrabold px-3 py-1 rounded-xl">🧩 تحدي الدرس (توقع الناتج - Predict)</span>
                                <span class="text-xs font-bold text-slate-500">حتى 3 نجوم ⭐⭐⭐</span>
                            </div>
                            <h4 class="font-black text-lg text-slate-900">ماذا سيطبع الكود التالي على الشاشة؟</h4>

                            <div dir="ltr" class="bg-slate-900 text-slate-100 p-4 rounded-2xl font-mono text-sm text-left">
                                <p><span class="text-emerald-400">stars</span> = <span class="text-amber-300">5</span></p>
                                <p><span class="text-emerald-400">stars</span> = stars + <span class="text-amber-300">3</span></p>
                                <p><span class="text-sky-400">print</span>(stars)</p>
                            </div>

                            <div class="space-y-2.5 pt-2">
                                <button onclick="submitChallenge(5)" class="w-full text-right p-3.5 rounded-2xl bg-white border-2 border-slate-200 hover:border-brandBlue-500 font-bold text-sm transition-all">
                                    أ) سيطبع الرقم 5
                                </button>
                                <button onclick="submitChallenge(8)" class="w-full text-right p-3.5 rounded-2xl bg-white border-2 border-slate-200 hover:border-brandBlue-500 font-bold text-sm transition-all">
                                    ب) سيطبع الرقم 8
                                </button>
                                <button onclick="submitChallenge(53)" class="w-full text-right p-3.5 rounded-2xl bg-white border-2 border-slate-200 hover:border-brandBlue-500 font-bold text-sm transition-all">
                                    ج) سيطبع 53
                                </button>
                            </div>

                            <!-- التغذية الراجعة العربية الفورية -->
                            <div id="challenge-feedback" class="hidden p-4 rounded-2xl text-sm font-bold"></div>
                        </div>

                        <!-- إشعار إكمال الدرس التلقائي (FR-11) -->
                        <div id="lesson-completed-banner" class="hidden bg-gradient-to-l from-brandMint-500 to-brandBlue-600 text-white p-5 rounded-2xl text-center space-y-2 shadow-soft">
                            <div class="text-2xl">🎊 أحسنت! اكتمل الدرس بنجاح!</div>
                            <p class="text-xs font-bold">تمت إضافة +10 XP إلى رصيدك وفتح الدرس الثالث تلقائياً.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 5. لوحة ولي الأمر (Parent Dashboard) ==================== -->
    <section id="page-parent-dashboard" class="page-section py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white rounded-3xl p-8 shadow-card border border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <span class="text-xs font-extrabold bg-brandMint-50 text-brandMint-600 px-3 py-1 rounded-full">حساب ولي أمر مؤكَّد ✔</span>
                    <h2 class="text-3xl font-black text-slate-900 mt-2">لوحة متابعة الأبناء</h2>
                    <p class="text-slate-600 text-sm font-medium mt-1">يمكنك إضافة ملفات أطفالك، متابعة تقدمهم، وإعادة تعيين كلمات المرور المؤقتة الخاصة بهم.</p>
                </div>
                <button onclick="openBookingModal()" class="hover-scale bg-brandBlue-600 hover:bg-brandBlue-700 text-white font-extrabold px-6 py-3.5 rounded-2xl shadow-soft">
                    + إضافة ملف طفل جديد
                </button>
            </div>

            <!-- قائمة الأطفال المرتبطين بولي الأمر -->
            <div id="parent-children-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- بطاقة الطفل 1 -->
                <div class="bg-white rounded-3xl p-7 shadow-card border border-slate-100 space-y-5">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-brandBlue-100 text-3xl flex items-center justify-center">🦊</div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900">أسامة (اسم مستعار)</h3>
                                <p class="text-xs font-bold text-slate-500">اسم الدخول: <span class="text-brandBlue-600">osama_code</span> • الفئة: 10-12 سنة</p>
                            </div>
                        </div>
                        <span class="bg-brandMint-100 text-brandMint-700 text-xs font-extrabold px-3 py-1 rounded-full">نشط</span>
                    </div>

                    <!-- شريط نسبة الإنجاز (BR-06) -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm font-extrabold">
                            <span class="text-slate-700">تقدم المسار (Python)</span>
                            <span class="text-brandBlue-600">66% (4 من 6 دروس)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                            <div class="bg-gradient-to-l from-brandBlue-600 to-brandMint-500 h-full rounded-full" style="width: 66%"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 text-center bg-slate-50 p-4 rounded-2xl">
                        <div>
                            <div class="text-xs text-slate-500 font-bold">نقاط XP</div>
                            <div class="text-lg font-black text-brandBlue-600">120</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-bold">الرتبة</div>
                            <div class="text-sm font-black text-brandMint-600 mt-1">مبرمج واعد</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-bold">آخر نشاط</div>
                            <div class="text-xs font-extrabold text-slate-700 mt-1">اليوم، 10:00 ص</div>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button onclick="navigateTo('child-dashboard')" class="flex-1 bg-brandBlue-50 hover:bg-brandBlue-100 text-brandBlue-700 font-extrabold py-2.5 rounded-xl text-sm">معاينة لوحة الطفل</button>
                        <button onclick="alert('تم إنشاء كلمة مرور مؤقتة جديدة للطفل: Kody@2026 (يجب تغييرها عند أول دخول)')" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-4 py-2.5 rounded-xl text-sm">إعادة تعيين كلمة المرور</button>
                    </div>
                </div>

                <!-- بطاقة الطفل 2 -->
                <div class="bg-white rounded-3xl p-7 shadow-card border border-slate-100 space-y-5">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-brandMint-100 text-3xl flex items-center justify-center">🐼</div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900">سارة (اسم مستعار)</h3>
                                <p class="text-xs font-bold text-slate-500">اسم الدخول: <span class="text-brandMint-600">sara_star</span> • الفئة: 7-9 سنوات</p>
                            </div>
                        </div>
                        <span class="bg-brandMint-100 text-brandMint-700 text-xs font-extrabold px-3 py-1 rounded-full">نشط</span>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between text-sm font-extrabold">
                            <span class="text-slate-700">تقدم المسار (منطق بصري)</span>
                            <span class="text-brandMint-600">33% (3 من 9 دروس)</span>
                        </div>
                        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                            <div class="bg-brandMint-500 h-full rounded-full" style="width: 33%"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 text-center bg-slate-50 p-4 rounded-2xl">
                        <div>
                            <div class="text-xs text-slate-500 font-bold">نقاط XP</div>
                            <div class="text-lg font-black text-brandBlue-600">60</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-bold">الرتبة</div>
                            <div class="text-sm font-black text-amber-600 mt-1">مستكشف</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-bold">آخر نشاط</div>
                            <div class="text-xs font-extrabold text-slate-700 mt-1">أمس</div>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button onclick="navigateTo('child-dashboard')" class="flex-1 bg-brandMint-50 hover:bg-brandMint-100 text-brandMint-700 font-extrabold py-2.5 rounded-xl text-sm">معاينة لوحة الطفل</button>
                        <button onclick="alert('تم إنشاء كلمة مرور مؤقتة جديدة للطفلة: Sara@2026')" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-4 py-2.5 rounded-xl text-sm">إعادة تعيين كلمة المرور</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 6. لوحة المدير (Admin Dashboard) ==================== -->
    <section id="page-admin-dashboard" class="page-section py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white rounded-3xl p-8 shadow-card border border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <span class="text-xs font-extrabold bg-brandBlue-50 text-brandBlue-600 px-3 py-1 rounded-full">إدارة النظام والمحتوى (FR-19 / FR-20)</span>
                    <h2 class="text-3xl font-black text-slate-900 mt-2">لوحة تحكم المدير</h2>
                    <p class="text-slate-600 text-sm font-medium mt-1">إدارة المسارات التعليمية، نسخ المحتوى (مسودة / منشور / مؤرشف)، وتقارير الأداء.</p>
                </div>
                <button onclick="alert('تم إنشاء نسخة مسودة جديدة (Draft v2.1) للتعديل دون التأثير على الطلاب المسجلين حالياً!')" class="hover-scale bg-brandMint-500 hover:bg-brandMint-600 text-white font-extrabold px-6 py-3.5 rounded-2xl shadow-soft">
                    + إنشاء نسخة مسودة جديدة
                </button>
            </div>

            <!-- تقارير مجمعة (FR-22) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-3xl shadow-card border border-slate-100">
                    <div class="text-sm font-bold text-slate-500">إجمالي الأطفال المسجلين</div>
                    <div class="text-3xl font-black text-brandBlue-600 mt-2">342 طفل</div>
                    <span class="text-xs font-bold text-brandMint-600">+18% هذا الشهر</span>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-card border border-slate-100">
                    <div class="text-sm font-bold text-slate-500">المسارات المنشورة</div>
                    <div class="text-3xl font-black text-brandMint-600 mt-2">3 مسارات</div>
                    <span class="text-xs font-bold text-slate-400">27 درساً معتمداً</span>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-card border border-slate-100">
                    <div class="text-sm font-bold text-slate-500">نسبة إتمام الدروس</div>
                    <div class="text-3xl font-black text-emerald-600 mt-2">84%</div>
                    <span class="text-xs font-bold text-emerald-600">معدل تفاعل مرتفع</span>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-card border border-slate-100">
                    <div class="text-sm font-bold text-slate-500">الأوسمة الممنوحة</div>
                    <div class="text-3xl font-black text-amber-500 mt-2">1,290 وسام</div>
                    <span class="text-xs font-bold text-slate-400">تلقائياً عبر محرك التلعيب</span>
                </div>
            </div>

            <!-- جدول إدارة نسخ المسارات (Path Versions) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-card border border-slate-100 overflow-x-auto">
                <h3 class="text-xl font-black text-slate-900 mb-5">إدارة نسخ المسارات (نظام الإصدارات الثابتة BR-07)</h3>
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 text-xs font-extrabold text-slate-400">
                            <th class="pb-4">المسار والفئة</th>
                            <th class="pb-4">رقم النسخة</th>
                            <th class="pb-4">الحالة</th>
                            <th class="pb-4">عدد المستويات / الدروس</th>
                            <th class="pb-4">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm font-bold">
                        <tr>
                            <td class="py-4 text-slate-900">مسار البراعم (7 - 9 سنوات)</td>
                            <td class="py-4 text-brandBlue-600">v1.0</td>
                            <td class="py-4"><span class="bg-brandMint-100 text-brandMint-700 px-3 py-1 rounded-full text-xs">منشور (Published)</span></td>
                            <td class="py-4 text-slate-600">3 مستويات / 9 دروس</td>
                            <td class="py-4"><button onclick="alert('النسخة منشورة وثابتة للطلاب المسجلين.')" class="text-brandBlue-600 hover:underline">معاينة</button></td>
                        </tr>
                        <tr>
                            <td class="py-4 text-slate-900">مسار بايثون (10 - 12 سنة)</td>
                            <td class="py-4 text-brandBlue-600">v1.2</td>
                            <td class="py-4"><span class="bg-brandMint-100 text-brandMint-700 px-3 py-1 rounded-full text-xs">منشور (Published)</span></td>
                            <td class="py-4 text-slate-600">3 مستويات / 9 دروس</td>
                            <td class="py-4"><button onclick="alert('النسخة منشورة وثابتة للطلاب المسجلين.')" class="text-brandBlue-600 hover:underline">معاينة</button></td>
                        </tr>
                        <tr>
                            <td class="py-4 text-slate-900">مسار المحترفين (13 - 15 سنة)</td>
                            <td class="py-4 text-amber-600">v2.0</td>
                            <td class="py-4"><span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs">مسودة (Draft)</span></td>
                            <td class="py-4 text-slate-600">3 مستويات / 9 دروس</td>
                            <td class="py-4">
                                <button onclick="alert('تم التحقق من اكتمال 3 مستويات والاختبارات، وتم نشر النسخة v2.0 وأرشفة السابقة!')" class="bg-brandBlue-600 text-white px-3 py-1.5 rounded-xl text-xs hover:bg-brandBlue-700">نشر النسخة</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- ==================== نافذة الحجز وإضافة طفل (Booking & Registration Modal) ==================== -->
    <div id="booking-modal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative animate-[fadeIn_0.25s_ease-out]">
            <button onclick="closeBookingModal()" class="absolute top-6 left-6 w-9 h-9 rounded-full bg-slate-100 text-slate-600 hover:bg-rose-100 hover:text-rose-600 flex items-center justify-center font-bold">✕</button>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-brandMint-100 text-brandMint-600 flex items-center justify-center text-2xl">🚀</div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900">احجز مقعد طفلك في كودي</h3>
                    <p class="text-xs font-bold text-slate-500">خطوة واحدة لإنشاء حساب ولي الأمر وملف الطفل الآمن</p>
                </div>
            </div>

            <form onsubmit="handleBookingSubmit(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">البريد الإلكتروني لولي الأمر</label>
                    <input type="email" required placeholder="parent@example.com" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 mb-1">الاسم المستعار للطفل</label>
                        <input id="modal-child-name" type="text" required placeholder="مثال: البطل زيد" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold">
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 mb-1">اسم دخول فريد للطفل</label>
                        <input id="modal-child-username" type="text" required placeholder="zaid_2026" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 mb-1">الفئة العمرية (بدون تاريخ ميلاد)</label>
                        <select id="modal-age-group" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold bg-white">
                            <option value="7-9">7 - 9 سنوات (منطق بصري)</option>
                            <option value="10-12" selected>10 - 12 سنة (Python)</option>
                            <option value="13-15">13 - 15 سنة (Python & Java)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 mb-1">اختر الأفاتار الجاهز</label>
                        <select id="modal-avatar" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold bg-white">
                            <option value="🦁">🦁 الأسد الذكي</option>
                            <option value="🤖">🤖 الروبوت كودي</option>
                            <option value="🚀">🚀 رائد الفضاء</option>
                            <option value="🦄">🦄 المبرمج المبدع</option>
                        </select>
                    </div>
                </div>

                <div class="bg-brandBlue-50 p-3.5 rounded-2xl text-xs font-bold text-brandBlue-700">
                    🔒 سيتم توليد كلمة مرور مؤقتة للطفل يغيّرها عند أول تسجيل دخول، وتسجيله تلقائياً في أحدث نسخة منشورة لمساره.
                </div>

                <button type="submit" class="w-full hover-scale bg-gradient-to-l from-brandBlue-600 to-brandMint-500 text-white font-black py-3.5 rounded-2xl shadow-soft text-base">
                    تأكيد الحجز وإنشاء الحساب الآن
                </button>
            </form>
        </div>
    </div>

    <!-- ==================== تذييل الصفحة (Footer) ==================== -->
    <footer class="bg-white border-t border-slate-100 mt-16 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-brandBlue-600 text-white flex items-center justify-center font-black">C</div>
                <span class="font-black text-lg text-slate-900">منصة كودي لتعليم البرمجة للأطفال</span>
            </div>
            <p class="text-sm text-slate-500 font-bold">جميع الحقوق محفوظة © 2026 • مصمم وفق مواصفات تحليل النظام (SRS)</p>
        </div>
    </footer>

    <!-- ==================== أكواد التفاعل (JavaScript) ==================== -->
    <script>
        // 1. التنقل بين الصفحات (SPA Multi-page Simulation)
        function navigateTo(pageId) {
            document.querySelectorAll('.page-section').forEach(sec => sec.classList.remove('active'));
            const target = document.getElementById('page-' + pageId);
            if (target) target.classList.add('active');

            // تحديث حالة أزرار الناف بار
            document.querySelectorAll('.nav-link').forEach(btn => {
                btn.classList.remove('bg-white', 'text-brandBlue-600', 'shadow-sm');
                btn.classList.add('text-slate-600');
            });
            const activeBtn = document.getElementById('nav-' + pageId);
            if (activeBtn) {
                activeBtn.classList.add('bg-white', 'text-brandBlue-600', 'shadow-sm');
                activeBtn.classList.remove('text-slate-600');
            }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }

        // 2. التحكم بنافذة الحجز وإضافة طفل
        function openBookingModal(ageGroup = '10-12') {
            document.getElementById('modal-age-group').value = ageGroup;
            document.getElementById('booking-modal').classList.remove('hidden');
        }

        function closeBookingModal() {
            document.getElementById('booking-modal').classList.add('hidden');
        }

        function handleBookingSubmit(e) {
            e.preventDefault();
            const name = document.getElementById('modal-child-name').value;
            const username = document.getElementById('modal-child-username').value;
            const age = document.getElementById('modal-age-group').value;
            const avatar = document.getElementById('modal-avatar').value;

            const grid = document.getElementById('parent-children-grid');
            const cardHTML = `
                <div class="bg-white rounded-3xl p-7 shadow-card border-2 border-brandMint-400 space-y-5 animate-[fadeIn_0.35s_ease-out]">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-brandMint-100 text-3xl flex items-center justify-center">${avatar}</div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900">${name} (جديد)</h3>
                                <p class="text-xs font-bold text-slate-500">اسم الدخول: <span class="text-brandBlue-600">${username}</span> • الفئة: ${age} سنة</p>
                            </div>
                        </div>
                        <span class="bg-brandBlue-100 text-brandBlue-700 text-xs font-extrabold px-3 py-1 rounded-full">بانتظار اختبار التحديد</span>
                    </div>
                    <div class="bg-brandMint-50 p-3.5 rounded-2xl text-xs font-bold text-brandMint-700">
                        ✔ تم الحجز بنجاح! كلمة المرور المؤقتة: <span dir="ltr">Kody#99</span>
                    </div>
                    <button onclick="navigateTo('placement')" class="w-full bg-brandBlue-600 text-white font-extrabold py-2.5 rounded-xl text-sm hover:bg-brandBlue-700">
                        بدء اختبار تحديد المستوى للطفل الآن
                    </button>
                </div>
            `;
            grid.insertAdjacentHTML('afterbegin', cardHTML);
            closeBookingModal();
            navigateTo('parent-dashboard');
        }

        // 3. تقييم اختبار تحديد المستوى (BR-02)
        function evaluatePlacement(e) {
            e.preventDefault();
            const q1 = parseInt(document.querySelector('input[name="q1"]:checked').value);
            const q2 = parseInt(document.querySelector('input[name="q2"]:checked').value);
            const q3 = parseInt(document.querySelector('input[name="q3"]:checked').value);
            const score = q1 + q2 + q3; // الدرجة من 9

            let levelText = '';
            let descText = '';
            if (score <= 3) {
                levelText = 'مستوى البداية المحدد لك: المستوى الأول (1)';
                descText = 'حصلت على ' + score + ' من 9 نقاط. سنبدأ معك من الأساسيات خطوة بخطوة لبناء قاعدة صلبة!';
            } else if (score <= 6) {
                levelText = 'مستوى البداية المحدد لك: المستوى الثاني (2)';
                descText = 'رائع! حصلت على ' + score + ' من 9 نقاط. تم تجاوز المستوى الأول بنجاح وستبدأ من المستوى الثاني.';
            } else {
                levelText = 'مستوى البداية المحدد لك: المستوى الثالث (3)';
                descText = 'مذهل يا عبقري! حصلت على ' + score + ' من 9 نقاط. تم فتح المستوى الثالث لك مباشرة.';
            }

            document.getElementById('placement-title').textContent = levelText;
            document.getElementById('placement-desc').textContent = descText;
            document.getElementById('placement-result').classList.remove('hidden');
        }

        // 4. منطق إكمال الدرس الثلاثي (فيديو 90% + قراءة + تحدٍ) حسب FR-08, FR-09, FR-11
        let lessonState = { video: false, read: false, challenge: false, xpAwarded: false };

        function simulateVideoWatch() {
            document.getElementById('video-progress-bar').style.width = '92%';
            document.getElementById('video-percent-text').textContent = 'نسبة المشاهدة الفريدة: 92% ✔';
            const badge = document.getElementById('step-video-badge');
            badge.textContent = '1. الفيديو (92%) ✔';
            badge.className = 'px-3 py-1.5 rounded-xl bg-brandMint-100 text-brandMint-700';
            lessonState.video = true;
            checkLessonCompletion();
        }

        function markLessonRead() {
            const btn = document.getElementById('btn-mark-read');
            btn.textContent = '✔ تم تأكيد قراءة الدرس';
            btn.classList.replace('bg-brandBlue-600', 'bg-brandMint-500');
            const badge = document.getElementById('step-read-badge');
            badge.textContent = '2. القراءة ✔';
            badge.className = 'px-3 py-1.5 rounded-xl bg-brandMint-100 text-brandMint-700';
            lessonState.read = true;
            checkLessonCompletion();
        }

        function submitChallenge(answer) {
            const fb = document.getElementById('challenge-feedback');
            fb.classList.remove('hidden', 'bg-brandMint-100', 'text-brandMint-800', 'bg-amber-100', 'text-amber-800');

            if (answer === 8) {
                fb.classList.add('bg-brandMint-100', 'text-brandMint-800');
                fb.innerHTML = '🌟 إجابة صحيحة 100%! قيمة stars كانت 5 وأضفنا إليها 3 فأصبحت 8. حصلت على 3 نجوم ⭐⭐⭐';
            } else {
                fb.classList.add('bg-amber-100', 'text-amber-800');
                fb.innerHTML = '💡 محاولة جيدة! تذكّر أن المتغير stars تغيّرت قيمته في السطر الثاني بجمع 3. تم احتساب محاولتك ويمكنك الإعادة للحصول على 3 نجوم!';
            }

            const badge = document.getElementById('step-challenge-badge');
            badge.textContent = '3. التحدي ✔';
            badge.className = 'px-3 py-1.5 rounded-xl bg-brandMint-100 text-brandMint-700';
            lessonState.challenge = true;
            checkLessonCompletion();
        }

        function checkLessonCompletion() {
            if (lessonState.video && lessonState.read && lessonState.challenge && !lessonState.xpAwarded) {
                lessonState.xpAwarded = true;
                document.getElementById('lesson-completed-banner').classList.remove('hidden');
                const xpEl = document.getElementById('xp-counter');
                xpEl.textContent = '130 XP';
            }
        }
    </script>
</body>
</html>