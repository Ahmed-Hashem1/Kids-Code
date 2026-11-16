<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة كودي (Codey) | تعلم البرمجة للأطفال بأسلوب ممتع</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Cairo', 'sans-serif'],
                    },
                    colors: {
                        brandBlue: '#0066FF',
                        brandBlueDark: '#0052CC',
                        brandOrange: '#FF7A00',
                        brandOrangeDark: '#E66E00',
                        brandEmerald: '#10B981',
                        brandEmeraldLight: '#D1FAE5',
                    },
                    boxShadow: {
                        'soft': '0 10px 30px -5px rgba(0, 102, 255, 0.08)',
                        'card': '0 8px 24px rgba(15, 23, 42, 0.06)',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #F8FAFC;
            scroll-behavior: smooth;
        }
        .page-view {
            display: none;
            animation: fadeIn 0.35s ease-out;
        }
        .page-view.active {
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hover-scale {
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
        }
        .hover-scale:hover {
            transform: scale(1.03);
        }
        .map-line::before {
            content: '';
            position: absolute;
            top: 2rem;
            bottom: 2rem;
            right: 50%;
            width: 6px;
            background: repeating-linear-gradient(to bottom, #CBD5E1 0, #CBD5E1 12px, transparent 12px, transparent 22px);
            transform: translateX(50%);
            z-index: 0;
        }
    </style>
</head>
<body class="text-slate-800 antialiased selection:bg-brandBlue selection:text-white">

    <!-- ================= NAVBAR ================= -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Logo: كودي -->
                <a href="#" onclick="navigateTo('home')" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-brandBlue to-blue-400 flex items-center justify-center text-white shadow-md group-hover:scale-105 transition-transform">
                        <span class="text-2xl font-black">&lt;/&gt;</span>
                    </div>
                    <div>
                        <span class="text-2xl font-black text-brandBlue tracking-tight">كودي</span>
                        <span class="block text-[11px] font-bold text-brandEmerald -mt-1">منصة مبرمجي المستقبل</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-2 bg-slate-50 p-1.5 rounded-2xl border border-slate-100">
                    <button onclick="navigateTo('home')" data-nav="home" class="nav-btn px-4 py-2 rounded-xl text-sm font-bold transition-all bg-brandBlue text-white shadow-sm">
                        الرئيسية
                    </button>
                    <button onclick="navigateTo('tracks')" data-nav="tracks" class="nav-btn px-4 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-brandBlue transition-all">
                        المسارات التعليمية
                    </button>
                    <button onclick="navigateTo('kid-portal')" data-nav="kid-portal" class="nav-btn px-4 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-brandBlue transition-all flex items-center gap-1.5">
                        <span>واجهة الطفل</span>
                        <span class="bg-brandEmerald/15 text-brandEmerald text-[10px] px-2 py-0.5 rounded-full">مباشر</span>
                    </button>
                    <button onclick="navigateTo('parent-dashboard')" data-nav="parent-dashboard" class="nav-btn px-4 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-brandBlue transition-all">
                        لوحة ولي الأمر
                    </button>
                    <button onclick="navigateTo('staff-dashboard')" data-nav="staff-dashboard" class="nav-btn px-4 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-brandBlue transition-all">
                        المعلم والإدارة
                    </button>
                </nav>

                <!-- CTA Button: احجز الآن + Mobile Toggle -->
                <div class="flex items-center gap-3">
                    <button onclick="openBookingModal()" class="hover-scale bg-brandOrange hover:bg-brandOrangeDark text-white font-extrabold text-sm sm:text-base px-6 py-3 rounded-2xl shadow-md shadow-orange-200 flex items-center gap-2 cursor-pointer">
                        <span>احجز الآن</span>
                        <i data-lucide="sparkles" class="w-4 h-4"></i>
                    </button>
                    <button onclick="toggleMobileMenu()" class="lg:hidden p-2.5 rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-slate-100 px-4 pt-3 pb-5 space-y-2 shadow-lg">
            <button onclick="navigateTo('home'); toggleMobileMenu()" class="block w-full text-right px-4 py-3 rounded-xl font-bold text-slate-700 hover:bg-blue-50 hover:text-brandBlue">🏠 الرئيسية</button>
            <button onclick="navigateTo('tracks'); toggleMobileMenu()" class="block w-full text-right px-4 py-3 rounded-xl font-bold text-slate-700 hover:bg-blue-50 hover:text-brandBlue">🧭 المسارات التعليمية</button>
            <button onclick="navigateTo('kid-portal'); toggleMobileMenu()" class="block w-full text-right px-4 py-3 rounded-xl font-bold text-slate-700 hover:bg-blue-50 hover:text-brandBlue">🚀 واجهة الطفل (التلعيب)</button>
            <button onclick="navigateTo('parent-dashboard'); toggleMobileMenu()" class="block w-full text-right px-4 py-3 rounded-xl font-bold text-slate-700 hover:bg-blue-50 hover:text-brandBlue">👨‍👩‍👧‍👦 لوحة ولي الأمر</button>
            <button onclick="navigateTo('staff-dashboard'); toggleMobileMenu()" class="block w-full text-right px-4 py-3 rounded-xl font-bold text-slate-700 hover:bg-blue-50 hover:text-brandBlue">🎓 لوحة المعلم والمدير</button>
        </div>
    </header>

    <!-- ================= PAGE 1: HOME (الرئيسية) ================= -->
    <main id="page-home" class="page-view active">
        <section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28 bg-gradient-to-b from-blue-50/70 via-white to-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <div class="lg:col-span-7 text-center lg:text-right space-y-6">
                        <div class="inline-flex items-center gap-2 bg-white border border-blue-100 px-4 py-2 rounded-full shadow-sm">
                            <span class="w-2.5 h-2.5 rounded-full bg-brandEmerald animate-ping"></span>
                            <span class="text-xs sm:text-sm font-extrabold text-brandBlue">بيئة تعليمية آمنة ومعتمدة للأعمار من 6 إلى 15 سنة</span>
                        </div>

                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-tight">
                            حوّل شغف طفلك بالألعاب إلى 
                            <span class="text-brandBlue relative inline-block">
                                إبداع برمجي
                                <svg class="w-full h-3 text-brandOrange/40 absolute -bottom-1 right-0" viewBox="0 0 200 12" fill="none"><path d="M2 10C50 2 150 2 198 10" stroke="currentColor" stroke-width="5" stroke-linecap="round"/></svg>
                            </span>
                        </h1>

                        <p class="text-base sm:text-lg text-slate-600 font-medium max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                            منصة <strong class="text-slate-900">كودي</strong> تقدم رحلة تعلم تفاعلية قائمة على التلعيب (Gamification)، خرائط المراحل، ونقاط الخبرة XP لتنمية التفكير المنطقي ومهارات المستقبل خطوة بخطوة.
                        </p>

                        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                            <button onclick="openBookingModal()" class="hover-scale bg-brandOrange hover:bg-brandOrangeDark text-white font-black text-base sm:text-lg px-8 py-4 rounded-2xl shadow-lg shadow-orange-200 flex items-center gap-2 cursor-pointer">
                                <span>احجز مقعد طفلك الآن</span>
                                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            </button>
                            <button onclick="navigateTo('kid-portal')" class="hover-scale bg-white hover:bg-blue-50 text-brandBlue border-2 border-brandBlue/20 font-extrabold text-base sm:text-lg px-7 py-4 rounded-2xl shadow-soft flex items-center gap-2 cursor-pointer">
                                <span>جرب عالم الطفل التفاعلي</span>
                                <span>🎮</span>
                            </button>
                        </div>

                        <div class="grid grid-cols-3 gap-4 pt-6 max-w-lg mx-auto lg:mx-0">
                            <div class="bg-white p-3.5 rounded-2xl shadow-card border border-slate-100 text-center">
                                <span class="block text-2xl font-black text-brandBlue">+3</span>
                                <span class="text-xs font-bold text-slate-500">مسارات عمرية</span>
                            </div>
                            <div class="bg-white p-3.5 rounded-2xl shadow-card border border-slate-100 text-center">
                                <span class="block text-2xl font-black text-brandEmerald">100%</span>
                                <span class="text-xs font-bold text-slate-500">حماية وخصوصية</span>
                            </div>
                            <div class="bg-white p-3.5 rounded-2xl shadow-card border border-slate-100 text-center">
                                <span class="block text-2xl font-black text-brandOrange">XP & أوسمة</span>
                                <span class="text-xs font-bold text-slate-500">نظام تحفيز ذكي</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border-2 border-blue-100 relative hover-scale">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-brandEmeraldLight text-brandEmerald flex items-center justify-center text-2xl">🤖</div>
                                    <div>
                                        <h3 class="font-black text-slate-900">تحدي الروبوت الذكي</h3>
                                        <span class="text-xs font-bold text-slate-400">المستوى الأول • التفكير المنطقي</span>
                                    </div>
                                </div>
                                <span class="bg-orange-100 text-brandOrange font-black text-xs px-3 py-1.5 rounded-xl">+50 XP</span>
                            </div>

                            <div class="space-y-3 bg-slate-50 p-4 rounded-2xl border border-slate-100 mb-6">
                                <div class="bg-brandBlue text-white font-bold text-sm px-4 py-3 rounded-xl shadow-sm flex items-center justify-between">
                                    <span>1. تحرك للأمام خطوتين ⬆️</span>
                                    <span class="text-xs bg-white/20 px-2 py-0.5 rounded">Step 1</span>
                                </div>
                                <div class="bg-brandEmerald text-white font-bold text-sm px-4 py-3 rounded-xl shadow-sm flex items-center justify-between">
                                    <span>2. انعطف نحو اليمين ➡️</span>
                                    <span class="text-xs bg-white/20 px-2 py-0.5 rounded">Step 2</span>
                                </div>
                                <div class="bg-brandOrange text-white font-bold text-sm px-4 py-3 rounded-xl shadow-sm flex items-center justify-between">
                                    <span>3. التقط نجمة الطاقة ⭐</span>
                                    <span class="text-xs bg-white/20 px-2 py-0.5 rounded">Win!</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                                <span>تقدم الطفل: 85%</span>
                                <span class="text-brandEmerald">جاهز للانتقال للمرحلة التالية ✓</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- System Roles Architecture Section -->
        <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-brandBlue font-black text-sm bg-blue-50 px-4 py-1.5 rounded-full">معمارية النظام المتكاملة</span>
                <h2 class="text-3xl font-black text-slate-900 mt-3">تجربة مصممة لكل فرد في العملية التعليمية</h2>
                <p class="text-slate-500 text-sm mt-2 font-medium">فصل كامل للصلاحيات بين الطفل المتعلم، ولي الأمر المشرف، المعلم، ومدير النظام.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div onclick="navigateTo('kid-portal')" class="hover-scale cursor-pointer bg-white rounded-3xl p-6 shadow-card border-2 border-transparent hover:border-brandBlue transition-all">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-brandBlue flex items-center justify-center text-3xl mb-4">🧒</div>
                    <h3 class="text-lg font-black text-slate-900 mb-2">الطفل المتعلم</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-4">دخول سريع برمز PIN، خريطة مراحل متسلسلة، حل الألغاز البرمجية، وجمع النقاط والأوسمة.</p>
                    <span class="text-brandBlue font-extrabold text-xs flex items-center gap-1">دخول الواجهة <i data-lucide="chevron-left" class="w-4 h-4"></i></span>
                </div>

                <div onclick="navigateTo('parent-dashboard')" class="hover-scale cursor-pointer bg-white rounded-3xl p-6 shadow-card border-2 border-transparent hover:border-brandEmerald transition-all">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-brandEmerald flex items-center justify-center text-3xl mb-4">👨‍👩‍👧‍👦</div>
                    <h3 class="text-lg font-black text-slate-900 mb-2">ولي الأمر</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-4">إنشاء ملفات متعددة للأبناء، تسجيلهم في المسارات المناسبة لأعمارهم، ومتابعة تقارير الإنجاز.</p>
                    <span class="text-brandEmerald font-extrabold text-xs flex items-center gap-1">لوحة المتابعة <i data-lucide="chevron-left" class="w-4 h-4"></i></span>
                </div>

                <div onclick="navigateTo('staff-dashboard')" class="hover-scale cursor-pointer bg-white rounded-3xl p-6 shadow-card border-2 border-transparent hover:border-brandOrange transition-all">
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 text-brandOrange flex items-center justify-center text-3xl mb-4">👨‍🏫</div>
                    <h3 class="text-lg font-black text-slate-900 mb-2">المعلم / المدرب</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-4">بناء الدورات والوحدات، تصميم الاختبارات التفاعلية مع التلميحات، وتقييم مشاريع الأطفال.</p>
                    <span class="text-brandOrange font-extrabold text-xs flex items-center gap-1">بوابة المعلم <i data-lucide="chevron-left" class="w-4 h-4"></i></span>
                </div>

                <div onclick="navigateTo('staff-dashboard')" class="hover-scale cursor-pointer bg-white rounded-3xl p-6 shadow-card border-2 border-transparent hover:border-slate-800 transition-all">
                    <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-800 flex items-center justify-center text-3xl mb-4">🛡️</div>
                    <h3 class="text-lg font-black text-slate-900 mb-2">مدير النظام</h3>
                    <p class="text-xs text-slate-500 leading-relaxed mb-4">الإشراف الشامل، اعتماد الدورات قبل النشر (Published)، وضبط قواعد التلعيب والأوسمة.</p>
                    <span class="text-slate-800 font-extrabold text-xs flex items-center gap-1">الإدارة والرقابة <i data-lucide="chevron-left" class="w-4 h-4"></i></span>
                </div>
            </div>
        </section>
    </main>

    <!-- ================= PAGE 2: TRACKS ================= -->
    <section id="page-tracks" class="page-view py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="bg-emerald-100 text-brandEmerald font-black text-xs px-4 py-1.5 rounded-full">مناهج مقسمة حسب الفئة العمرية</span>
            <h2 class="text-3xl font-black text-slate-900 mt-3">اختر المسار البرمجي المناسب لعمر طفلك</h2>
            <p class="text-slate-500 text-sm mt-2">مسارات متدرجة الصعوبة (مبتدئ، متوسط، متقدم) معتمدة من خبراء التعليم.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <button onclick="filterTracks('all')" class="track-filter-btn active px-6 py-2.5 rounded-2xl font-extrabold text-sm bg-brandBlue text-white shadow-sm transition">جميع الأعمار (6 - 15 سنة)</button>
            <button onclick="filterTracks('6-8')" class="track-filter-btn px-6 py-2.5 rounded-2xl font-extrabold text-sm bg-white text-slate-600 border border-slate-200 hover:border-brandBlue transition">المستكشف الصغير (6 - 8 سنوات)</button>
            <button onclick="filterTracks('9-11')" class="track-filter-btn px-6 py-2.5 rounded-2xl font-extrabold text-sm bg-white text-slate-600 border border-slate-200 hover:border-brandBlue transition">المبرمج الواعد (9 - 11 سنة)</button>
            <button onclick="filterTracks('12-15')" class="track-filter-btn px-6 py-2.5 rounded-2xl font-extrabold text-sm bg-white text-slate-600 border border-slate-200 hover:border-brandBlue transition">مطور المستقبل (12 - 15 سنة)</button>
        </div>

        <div id="tracks-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div data-age="6-8" class="track-card hover-scale bg-white rounded-3xl overflow-hidden shadow-card border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="h-40 bg-gradient-to-tr from-brandBlue to-cyan-400 p-6 flex items-center justify-between text-white">
                        <div>
                            <span class="bg-white/20 backdrop-blur-sm text-xs font-extrabold px-3 py-1 rounded-full">6 - 8 سنوات</span>
                            <h3 class="text-xl font-black mt-2">أساسيات التفكير المنطقي</h3>
                        </div>
                        <span class="text-5xl">🧩</span>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center gap-2 text-xs font-bold">
                            <span class="bg-emerald-50 text-brandEmerald px-2.5 py-1 rounded-lg">مستوى: مبتدئ</span>
                            <span class="bg-orange-50 text-brandOrange px-2.5 py-1 rounded-lg">12 درس تفاعلي</span>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">تعلم تسلسل الأوامر، الأنماط، وحل المشكلات دون الحاجة للكتابة المعقدة عبر الألغاز البصرية.</p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <button onclick="openBookingModal('أساسيات التفكير المنطقي (6-8 سنوات)')" class="w-full bg-brandBlue hover:bg-brandBlueDark text-white font-extrabold py-3.5 rounded-2xl shadow-sm transition cursor-pointer">
                        سجل طفلك في المسار
                    </button>
                </div>
            </div>

            <div data-age="9-11" class="track-card hover-scale bg-white rounded-3xl overflow-hidden shadow-card border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="h-40 bg-gradient-to-tr from-brandOrange to-amber-400 p-6 flex items-center justify-between text-white">
                        <div>
                            <span class="bg-white/20 backdrop-blur-sm text-xs font-extrabold px-3 py-1 rounded-full">9 - 11 سنة</span>
                            <h3 class="text-xl font-black mt-2">برمجة الألعاب بـ Scratch</h3>
                        </div>
                        <span class="text-5xl">🎮</span>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center gap-2 text-xs font-bold">
                            <span class="bg-blue-50 text-brandBlue px-2.5 py-1 rounded-lg">مستوى: متوسط</span>
                            <span class="bg-emerald-50 text-brandEmerald px-2.5 py-1 rounded-lg">16 درس + مشروع</span>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">بناء الألعاب التفاعلية والقصص المتحركة باستخدام المكعبات البرمجية والحلقات التكرارية والشروط.</p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <button onclick="openBookingModal('برمجة الألعاب بـ Scratch (9-11 سنة)')" class="w-full bg-brandOrange hover:bg-brandOrangeDark text-white font-extrabold py-3.5 rounded-2xl shadow-sm transition cursor-pointer">
                        سجل طفلك في المسار
                    </button>
                </div>
            </div>

            <div data-age="12-15" class="track-card hover-scale bg-white rounded-3xl overflow-hidden shadow-card border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="h-40 bg-gradient-to-tr from-brandEmerald to-teal-400 p-6 flex items-center justify-between text-white">
                        <div>
                            <span class="bg-white/20 backdrop-blur-sm text-xs font-extrabold px-3 py-1 rounded-full">12 - 15 سنة</span>
                            <h3 class="text-xl font-black mt-2">مقدمة في لغة Python والويب</h3>
                        </div>
                        <span class="text-5xl">💻</span>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center gap-2 text-xs font-bold">
                            <span class="bg-orange-50 text-brandOrange px-2.5 py-1 rounded-lg">مستوى: متقدم</span>
                            <span class="bg-blue-50 text-brandBlue px-2.5 py-1 rounded-lg">20 درس تطبيقي</span>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">الانتقال من البرمجة المرئية إلى كتابة الأكواد الحقيقية بلغة بايثون وبناء صفحات الويب الأولى.</p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <button onclick="openBookingModal('مقدمة في لغة Python (12-15 سنة)')" class="w-full bg-brandEmerald hover:bg-emerald-600 text-white font-extrabold py-3.5 rounded-2xl shadow-sm transition cursor-pointer">
                        سجل طفلك في المسار
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= PAGE 3: KID PORTAL ================= -->
    <section id="page-kid-portal" class="page-view py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="kid-pin-screen" class="max-w-md mx-auto bg-white rounded-3xl p-8 shadow-xl border-2 border-blue-100 text-center my-8">
            <span class="bg-blue-50 text-brandBlue text-xs font-black px-3.5 py-1.5 rounded-full">بوابة الدخول الآمن للأطفال</span>
            <h2 class="text-2xl font-black text-slate-900 mt-3">من البطل الذي سيتعلم اليوم؟</h2>
            <p class="text-xs text-slate-500 mt-1 mb-6">اختر صورتك الرمزية وأدخل رمز PIN المكون من 4 أرقام</p>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <button onclick="selectKidAvatar('يزن', '🦁', '1234')" id="avatar-yazan" class="kid-avatar-btn p-4 rounded-2xl border-2 border-brandBlue bg-blue-50/50 transition text-center cursor-pointer">
                    <span class="text-4xl block mb-1">🦁</span>
                    <span class="font-black text-slate-800 text-sm">يزن (9 سنوات)</span>
                </button>
                <button onclick="selectKidAvatar('لينا', '🦄', '5678')" id="avatar-lina" class="kid-avatar-btn p-4 rounded-2xl border-2 border-slate-100 hover:border-brandBlue transition text-center cursor-pointer">
                    <span class="text-4xl block mb-1">🦄</span>
                    <span class="font-black text-slate-800 text-sm">لينا (7 سنوات)</span>
                </button>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-500 mb-2">رمز الدخول السريع (PIN تجريبي: <span id="hint-pin" class="text-brandBlue font-black">1234</span>)</label>
                <input type="password" id="kid-pin-input" maxlength="4" value="1234" class="w-48 mx-auto text-center text-2xl font-black tracking-[0.5em] py-3 rounded-2xl border-2 border-slate-200 focus:border-brandBlue focus:outline-none bg-slate-50">
            </div>
            <p id="pin-error" class="text-xs font-bold text-red-500 mb-3 hidden">⚠️ رمز PIN غير صحيح، حاول مرة أخرى!</p>

            <button onclick="unlockKidDashboard()" class="w-full hover-scale bg-brandEmerald hover:bg-emerald-600 text-white font-black py-3.5 rounded-2xl shadow-md transition cursor-pointer">
                انطلق إلى خريطة المغامرات 🚀
            </button>
        </div>

        <div id="kid-learning-area" class="hidden space-y-8">
            <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-card border border-blue-100 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div id="active-kid-avatar" class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-brandBlue to-blue-400 flex items-center justify-center text-4xl shadow-md text-white">🦁</div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 id="active-kid-name" class="text-xl font-black text-slate-900">أهلاً يا يزن!</h2>
                            <span id="kid-level-badge" class="bg-brandEmeraldLight text-brandEmerald text-xs font-black px-3 py-1 rounded-full">المستوى 1</span>
                        </div>
                        <p class="text-xs text-slate-500 font-bold mt-1">مسار: أساسيات التفكير المنطقي والخوارزميات</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="bg-orange-50 border border-orange-200 px-4 py-2 rounded-2xl text-center">
                        <span class="block text-[10px] font-bold text-orange-600">نقاط الخبرة</span>
                        <span id="kid-xp-display" class="text-lg font-black text-brandOrange">80 XP</span>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 px-4 py-2 rounded-2xl text-center">
                        <span class="block text-[10px] font-bold text-brandBlue">الأوسمة</span>
                        <span id="kid-badges-count" class="text-lg font-black text-brandBlue">1 🏅</span>
                    </div>
                    <button onclick="lockKidDashboard()" class="p-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold">
                        تبديل 🔄
                    </button>
                </div>
            </div>

            <div class="relative map-line max-w-xl mx-auto space-y-8 py-4">
                <div class="relative z-10 bg-white border-2 border-brandEmerald rounded-3xl p-5 shadow-card flex items-center justify-between hover-scale">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-brandEmerald text-white flex items-center justify-center text-2xl font-black shadow-sm">✓</div>
                        <div>
                            <span class="text-xs font-extrabold text-brandEmerald">المرحلة 1 • مكتملة (⭐⭐⭐)</span>
                            <h3 class="text-lg font-black text-slate-900">ما هي الخوارزمية؟</h3>
                        </div>
                    </div>
                    <span class="bg-emerald-50 text-brandEmerald text-xs font-black px-3 py-1.5 rounded-xl">+30 XP</span>
                </div>

                <div id="stage-2-card" class="relative z-10 bg-gradient-to-l from-brandBlue to-blue-500 text-white rounded-3xl p-6 shadow-xl border-4 border-blue-200 hover-scale">
                    <div class="flex items-center justify-between mb-2">
                        <span class="bg-white/20 text-xs font-black px-3 py-1 rounded-full animate-pulse">المرحلة الحالية • متاحة الآن</span>
                        <span class="bg-brandOrange text-white text-xs font-black px-3 py-1 rounded-xl">+50 XP</span>
                    </div>
                    <h3 class="text-xl font-black mb-1">ترتيب الخطوات المنطقية (Sequencing)</h3>
                    <p class="text-blue-100 text-xs mb-4">شاهد الشرح المبسط ثم حل اللغز البرمجي لفتح المرحلة الثالثة والحصول على وسام "المبرمج الواعد"!</p>
                    <button onclick="openLessonQuizModal()" class="w-full bg-brandOrange hover:bg-brandOrangeDark text-white font-black py-3.5 rounded-2xl shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                        <span>ابدأ الدرس والتحدي التفاعلي</span>
                        <span>🎯</span>
                    </button>
                </div>

                <div id="stage-3-card" class="relative z-10 bg-slate-100 border-2 border-slate-200 rounded-3xl p-5 flex items-center justify-between opacity-80 transition-all">
                    <div class="flex items-center gap-4">
                        <div id="stage-3-icon" class="w-14 h-14 rounded-2xl bg-slate-300 text-slate-600 flex items-center justify-center text-2xl">🔒</div>
                        <div>
                            <span id="stage-3-status" class="text-xs font-bold text-slate-500">المرحلة 3 • مغلقة</span>
                            <h3 class="text-lg font-black text-slate-700">الحلقات التكرارية (Loops)</h3>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-slate-400">+70 XP</span>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-card border border-slate-100">
                <h3 class="text-lg font-black text-slate-900 mb-4">خزانة الأوسمة والإنجازات 🏆</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-center">
                        <span class="text-3xl block mb-1">🌟</span>
                        <span class="font-black text-xs text-slate-800 block">الخطوة الأولى</span>
                        <span class="text-[10px] font-bold text-brandEmerald">مكتسب ✓</span>
                    </div>
                    <div id="badge-promising" class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-center opacity-50 transition-all">
                        <span class="text-3xl block mb-1">🚀</span>
                        <span class="font-black text-xs text-slate-800 block">المبرمج الواعد</span>
                        <span id="badge-promising-text" class="text-[10px] font-bold text-slate-400">يتطلب 100 XP</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= PAGE 4: PARENT DASHBOARD ================= -->
    <section id="page-parent-dashboard" class="page-view py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-4 bg-white p-6 rounded-3xl shadow-card border border-slate-100 mb-8">
            <div>
                <span class="text-xs font-black text-brandEmerald bg-emerald-50 px-3 py-1 rounded-full">حساب ولي الأمر المشرف (Multi-Kid Profiles)</span>
                <h2 class="text-2xl font-black text-slate-900 mt-2">مرحباً بك، أ. أحمد (لوحة متابعة الأبناء)</h2>
                <p class="text-xs text-slate-500 mt-1">راقب تقدم أطفالك، أضف ملفات جديدة، وحمّل شهادات الإنجاز المعتمدة.</p>
            </div>
            <button onclick="openAddKidModal()" class="hover-scale bg-brandBlue hover:bg-brandBlueDark text-white font-extrabold text-sm px-6 py-3.5 rounded-2xl shadow-md flex items-center gap-2 cursor-pointer">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
                <span>إضافة ملف طفل جديد</span>
            </button>
        </div>

        <div id="parent-kids-grid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-3xl p-6 shadow-card border border-slate-100 space-y-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-4xl">🦁</div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">يزن أحمد</h3>
                            <span class="text-xs font-bold text-slate-500">العمر: 9 سنوات • رمز الدخول PIN: <strong class="text-brandBlue">1234</strong></span>
                        </div>
                    </div>
                    <span class="bg-emerald-50 text-brandEmerald font-black text-xs px-3 py-1.5 rounded-xl">نشط اليوم</span>
                </div>

                <div>
                    <div class="flex justify-between text-xs font-extrabold mb-1.5">
                        <span class="text-slate-600">إنجاز مسار أساسيات التفكير المنطقي</span>
                        <span class="text-brandBlue">65%</span>
                    </div>
                    <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                        <div class="bg-brandBlue h-full rounded-full" style="width: 65%"></div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 bg-slate-50 p-3.5 rounded-2xl text-center">
                    <div>
                        <span class="block text-base font-black text-brandOrange">80 XP</span>
                        <span class="text-[11px] font-bold text-slate-500">نقاط الخبرة</span>
                    </div>
                    <div>
                        <span class="block text-base font-black text-brandEmerald">4 دروس</span>
                        <span class="text-[11px] font-bold text-slate-500">مكتملة</span>
                    </div>
                    <div>
                        <span class="block text-base font-black text-brandBlue">1 وسام</span>
                        <span class="text-[11px] font-bold text-slate-500">مكتسب</span>
                    </div>
                </div>

                <div class="flex gap-3 pt-1">
                    <button onclick="navigateTo('kid-portal')" class="flex-1 bg-brandBlue/10 hover:bg-brandBlue hover:text-white text-brandBlue font-extrabold text-xs py-3 rounded-xl transition cursor-pointer">
                        الدخول كطفل (تبديل الجلسة)
                    </button>
                    <button onclick="alert('📄 جاري توليد شهادة الإنجاز المعتمدة بصيغة PDF للطالب يزن...')" class="px-4 bg-emerald-50 hover:bg-brandEmerald hover:text-white text-brandEmerald font-extrabold text-xs py-3 rounded-xl transition cursor-pointer">
                        تحميل الشهادة 🎓
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-card border border-slate-100 space-y-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-orange-100 flex items-center justify-center text-4xl">🦄</div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">لينا أحمد</h3>
                            <span class="text-xs font-bold text-slate-500">العمر: 7 سنوات • رمز الدخول PIN: <strong class="text-brandBlue">5678</strong></span>
                        </div>
                    </div>
                    <span class="bg-blue-50 text-brandBlue font-black text-xs px-3 py-1.5 rounded-xl">مسجلة حديثاً</span>
                </div>

                <div>
                    <div class="flex justify-between text-xs font-extrabold mb-1.5">
                        <span class="text-slate-600">إنجاز مسار المستكشف الصغير</span>
                        <span class="text-brandEmerald">30%</span>
                    </div>
                    <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                        <div class="bg-brandEmerald h-full rounded-full" style="width: 30%"></div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 bg-slate-50 p-3.5 rounded-2xl text-center">
                    <div>
                        <span class="block text-base font-black text-brandOrange">40 XP</span>
                        <span class="text-[11px] font-bold text-slate-500">نقاط الخبرة</span>
                    </div>
                    <div>
                        <span class="block text-base font-black text-brandEmerald">2 درس</span>
                        <span class="text-[11px] font-bold text-slate-500">مكتملة</span>
                    </div>
                    <div>
                        <span class="block text-base font-black text-brandBlue">1 وسام</span>
                        <span class="text-[11px] font-bold text-slate-500">مكتسب</span>
                    </div>
                </div>

                <div class="flex gap-3 pt-1">
                    <button onclick="navigateTo('kid-portal')" class="flex-1 bg-brandBlue/10 hover:bg-brandBlue hover:text-white text-brandBlue font-extrabold text-xs py-3 rounded-xl transition cursor-pointer">
                        الدخول كطفل (تبديل الجلسة)
                    </button>
                    <button onclick="alert('📄 جاري توليد تقرير التقدم الأسبوعي للطالبة لينا...')" class="px-4 bg-orange-50 hover:bg-brandOrange hover:text-white text-brandOrange font-extrabold text-xs py-3 rounded-xl transition cursor-pointer">
                        التقرير الأسبوعي 📊
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= PAGE 5: INSTRUCTOR & ADMIN DASHBOARD ================= -->
    <section id="page-staff-dashboard" class="page-view py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white p-6 rounded-3xl shadow-card border border-slate-100 flex flex-wrap items-center justify-between gap-4">
            <div>
                <span class="text-xs font-black text-brandOrange bg-orange-50 px-3 py-1 rounded-full">إدارة المحتوى والاعتماد الأكاديمي (SRS Workflow)</span>
                <h2 class="text-2xl font-black text-slate-900 mt-2">لوحة المعلم ومدير النظام</h2>
                <p class="text-xs text-slate-500 mt-1">يقوم المعلم بإنشاء الدورة، ويقوم مدير النظام بمراجعتها واعتمادها (Pending ➔ Published).</p>
            </div>
            <button onclick="addNewDemoCourse()" class="hover-scale bg-brandOrange hover:bg-brandOrangeDark text-white font-extrabold text-sm px-5 py-3 rounded-2xl shadow-sm cursor-pointer">
                + إضافة دورة جديدة (محاكاة المعلم)
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-card border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h3 class="font-black text-lg text-slate-900">قائمة الدورات وحالة الاعتماد (Courses Status)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs font-extrabold border-b border-slate-100">
                            <th class="py-4 px-6">عنوان الدورة</th>
                            <th class="py-4 px-6">الفئة العمرية</th>
                            <th class="py-4 px-6">المستوى</th>
                            <th class="py-4 px-6">حالة الدورة</th>
                            <th class="py-4 px-6">إجراء مدير النظام</th>
                        </tr>
                    </thead>
                    <tbody id="courses-table-body" class="divide-y divide-slate-100 text-sm font-bold">
                        <tr>
                            <td class="py-4 px-6 text-slate-900">أساسيات التفكير المنطقي</td>
                            <td class="py-4 px-6 text-slate-600">6-8 سنوات</td>
                            <td class="py-4 px-6"><span class="bg-blue-50 text-brandBlue px-2.5 py-1 rounded-lg text-xs">مبتدئ</span></td>
                            <td class="py-4 px-6"><span class="bg-emerald-100 text-brandEmerald px-3 py-1 rounded-full text-xs">منشورة (Published)</span></td>
                            <td class="py-4 px-6 text-xs text-slate-400">تم الاعتماد ✓</td>
                        </tr>
                        <tr id="pending-course-row">
                            <td class="py-4 px-6 text-slate-900">تصميم الروبوتات الذكية</td>
                            <td class="py-4 px-6 text-slate-600">9-11 سنة</td>
                            <td class="py-4 px-6"><span class="bg-orange-50 text-brandOrange px-2.5 py-1 rounded-lg text-xs">متوسط</span></td>
                            <td class="py-4 px-6" id="pending-status-cell"><span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs">قيد المراجعة (Pending)</span></td>
                            <td class="py-4 px-6" id="pending-action-cell">
                                <button onclick="approveCourse()" class="bg-brandEmerald hover:bg-emerald-600 text-white text-xs font-black px-4 py-2 rounded-xl transition cursor-pointer">
                                    اعتماد ونشر ✓
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- ================= MODAL 1: INTERACTIVE LESSON QUIZ ================= -->
    <div id="quiz-modal" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border-2 border-blue-100 relative">
            <button onclick="closeLessonQuizModal()" class="absolute top-5 left-5 w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 font-bold">✕</button>
            
            <span class="bg-blue-50 text-brandBlue text-xs font-black px-3 py-1 rounded-full">تحدي الدرس الثاني • +50 XP</span>
            <h3 class="text-xl font-black text-slate-900 mt-3 mb-2">لغز توجيه الروبوت كودي 🤖</h3>
            <p class="text-sm text-slate-600 mb-5">يريد الروبوت الوصول إلى الكنز أمامه مباشرة ثم الالتفاف لفتحه. ما هو الترتيب المنطقي الصحيح للأوامر؟</p>

            <div class="space-y-3 mb-6">
                <label class="flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-100 hover:border-brandBlue cursor-pointer transition">
                    <input type="radio" name="robot_quiz" value="wrong" class="w-5 h-5 text-brandBlue">
                    <span class="text-sm font-bold text-slate-800">أ) افتح الصندوق ➔ تحرك للأمام</span>
                </label>
                <label class="flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-100 hover:border-brandBlue cursor-pointer transition">
                    <input type="radio" name="robot_quiz" value="correct" class="w-5 h-5 text-brandBlue">
                    <span class="text-sm font-bold text-slate-800">ب) تحرك للأمام ➔ افتح الصندوق</span>
                </label>
            </div>

            <div id="quiz-result-box" class="hidden p-3.5 rounded-2xl text-center text-sm font-black mb-4"></div>

            <button onclick="checkKidQuizAnswer()" class="w-full bg-brandBlue hover:bg-brandBlueDark text-white font-black py-3.5 rounded-2xl shadow-md transition cursor-pointer">
                تحقق من الإجابة الفورية ✨
            </button>
        </div>
    </div>

    <!-- ================= MODAL 2: BOOKING MODAL ================= -->
    <div id="booking-modal" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border-2 border-orange-100 relative">
            <button onclick="closeBookingModal()" class="absolute top-5 left-5 w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 font-bold">✕</button>
            
            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-brandOrange flex items-center justify-center text-3xl mb-4">🚀</div>
            <h3 class="text-2xl font-black text-slate-900">احجز حصة تجريبية مجانية</h3>
            <p class="text-xs text-slate-500 mt-1 mb-6">سجل بياناتك وسيقوم فريق كودي بالتواصل معك لتحديد المسار الأنسب لطفلك.</p>

            <form onsubmit="submitBookingForm(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">اسم ولي الأمر</label>
                    <input type="text" required placeholder="مثال: محمد العلي" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-brandBlue focus:outline-none text-sm font-bold">
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">رقم الجوال (واتساب)</label>
                    <input type="tel" required placeholder="05xxxxxxxx" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-brandBlue focus:outline-none text-sm font-bold">
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">المسار / الفئة العمرية</label>
                    <select id="booking-track-select" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-brandBlue focus:outline-none text-sm font-bold bg-white">
                        <option>أساسيات التفكير المنطقي (6-8 سنوات)</option>
                        <option>برمجة الألعاب بـ Scratch (9-11 سنة)</option>
                        <option>مقدمة في لغة Python (12-15 سنة)</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-brandOrange hover:bg-brandOrangeDark text-white font-black py-3.5 rounded-2xl shadow-md transition cursor-pointer">
                    تأكيد الحجز الآن 🎉
                </button>
            </form>
        </div>
    </div>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-white border-t border-slate-100 mt-20 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <span class="w-9 h-9 rounded-xl bg-brandBlue text-white font-black flex items-center justify-center">&lt;/&gt;</span>
                <span class="font-black text-xl text-slate-900">كودي (Codey)</span>
            </div>
            <p class="text-xs font-bold text-slate-500 text-center">تم التصميم والتطوير وفق وثيقة التحليل الفني ومواصفات النظام (SRS) • HTML5 & Tailwind CSS</p>
            <div class="flex gap-4 text-xs font-extrabold text-brandBlue">
                <button onclick="navigateTo('home')">الرئيسية</button>
                <button onclick="navigateTo('tracks')">المسارات</button>
                <button onclick="openBookingModal()">احجز الآن</button>
            </div>
        </div>
    </footer>

    <!-- ================= JAVASCRIPT INTERACTIVITY ================= -->
    <script>
        lucide.createIcons();

        function navigateTo(pageId) {
            document.querySelectorAll('.page-view').forEach(page => page.classList.remove('active'));
            const target = document.getElementById('page-' + pageId);
            if (target) target.classList.add('active');

            document.querySelectorAll('.nav-btn').forEach(btn => {
                if (btn.dataset.nav === pageId) {
                    btn.classList.add('bg-brandBlue', 'text-white', 'shadow-sm');
                    btn.classList.remove('text-slate-600');
                } else {
                    btn.classList.remove('bg-brandBlue', 'text-white', 'shadow-sm');
                    btn.classList.add('text-slate-600');
                }
            });
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }

        function filterTracks(ageGroup) {
            document.querySelectorAll('.track-filter-btn').forEach(btn => {
                btn.classList.remove('bg-brandBlue', 'text-white', 'shadow-sm');
                btn.classList.add('bg-white', 'text-slate-600');
            });
            event.target.classList.add('bg-brandBlue', 'text-white', 'shadow-sm');
            event.target.classList.remove('bg-white', 'text-slate-600');

            document.querySelectorAll('.track-card').forEach(card => {
                card.style.display = (ageGroup === 'all' || card.dataset.age === ageGroup) ? 'flex' : 'none';
            });
        }

        let selectedKid = { name: 'يزن', avatar: '🦁', pin: '1234', xp: 80 };

        function selectKidAvatar(name, avatar, pin) {
            selectedKid = { name, avatar, pin, xp: name === 'يزن' ? 80 : 40 };
            document.getElementById('hint-pin').innerText = pin;
            document.getElementById('kid-pin-input').value = pin;
            
            document.querySelectorAll('.kid-avatar-btn').forEach(b => {
                b.classList.remove('border-brandBlue', 'bg-blue-50/50');
                b.classList.add('border-slate-100');
            });
            event.currentTarget.classList.add('border-brandBlue', 'bg-blue-50/50');
        }

        function unlockKidDashboard() {
            const enteredPin = document.getElementById('kid-pin-input').value;
            const err = document.getElementById('pin-error');
            if (enteredPin === selectedKid.pin) {
                err.classList.add('hidden');
                document.getElementById('kid-pin-screen').classList.add('hidden');
                document.getElementById('kid-learning-area').classList.remove('hidden');
                document.getElementById('active-kid-name').innerText = 'أهلاً يا ' + selectedKid.name + '!';
                document.getElementById('active-kid-avatar').innerText = selectedKid.avatar;
                document.getElementById('kid-xp-display').innerText = selectedKid.xp + ' XP';
            } else {
                err.classList.remove('hidden');
            }
        }

        function lockKidDashboard() {
            document.getElementById('kid-learning-area').classList.add('hidden');
            document.getElementById('kid-pin-screen').classList.remove('hidden');
        }

        function openLessonQuizModal() {
            document.getElementById('quiz-modal').classList.remove('hidden');
        }
        function closeLessonQuizModal() {
            document.getElementById('quiz-modal').classList.add('hidden');
        }

        function checkKidQuizAnswer() {
            const choice = document.querySelector('input[name="robot_quiz"]:checked');
            const resBox = document.getElementById('quiz-result-box');
            resBox.classList.remove('hidden', 'bg-emerald-50', 'text-brandEmerald', 'bg-red-50', 'text-red-600');

            if (!choice) {
                resBox.classList.add('bg-orange-50', 'text-brandOrange');
                resBox.innerText = '⚠️ اختر إجابة أولاً يا بطل!';
                return;
            }

            if (choice.value === 'correct') {
                resBox.classList.add('bg-emerald-50', 'text-brandEmerald');
                resBox.innerText = '🎉 أحسنت! +50 XP وتم فتح المرحلة الثالثة وترقيتك للمستوى 2!';
                
                selectedKid.xp += 50;
                document.getElementById('kid-xp-display').innerText = selectedKid.xp + ' XP';
                document.getElementById('kid-level-badge').innerText = 'المستوى 2 ⭐';
                document.getElementById('kid-badges-count').innerText = '2 🏅';

                const s3 = document.getElementById('stage-3-card');
                s3.classList.remove('bg-slate-100', 'opacity-80', 'border-slate-200');
                s3.classList.add('bg-white', 'border-brandBlue', 'shadow-card');
                document.getElementById('stage-3-icon').innerText = '🔓';
                document.getElementById('stage-3-icon').classList.replace('bg-slate-300', 'bg-brandBlue');
                document.getElementById('stage-3-icon').classList.add('text-white');
                document.getElementById('stage-3-status').innerText = 'المرحلة 3 • مفتوحة الآن!';
                document.getElementById('stage-3-status').classList.replace('text-slate-500', 'text-brandBlue');

                const badge = document.getElementById('badge-promising');
                badge.classList.remove('opacity-50', 'bg-slate-50');
                badge.classList.add('bg-orange-50', 'border-orange-200');
                document.getElementById('badge-promising-text').innerText = 'مكتسب حديثاً 🎉';
                document.getElementById('badge-promising-text').classList.replace('text-slate-400', 'text-brandOrange');

                setTimeout(closeLessonQuizModal, 1800);
            } else {
                resBox.classList.add('bg-red-50', 'text-red-600');
                resBox.innerText = '❌ تلميح: يجب أن يصل الروبوت إلى الصندوق أولاً قبل فتحه!';
            }
        }

        function openBookingModal(trackName) {
            if (trackName) {
                document.getElementById('booking-track-select').value = trackName;
            }
            document.getElementById('booking-modal').classList.remove('hidden');
        }
        function closeBookingModal() {
            document.getElementById('booking-modal').classList.add('hidden');
        }
        function submitBookingForm(e) {
            e.preventDefault();
            alert('✅ تم استلام طلب الحجز في منصة كودي بنجاح! سيتواصل معك فريقنا قريباً.');
            closeBookingModal();
        }

        function openAddKidModal() {
            const name = prompt('أدخل اسم الطفل الجديد:');
            if (!name) return;
            const age = prompt('أدخل عمر الطفل (من 6 إلى 15):', '8');
            const pin = Math.floor(1000 + Math.random() * 9000);
            const grid = document.getElementById('parent-kids-grid');
            const card = `
                <div class="bg-white rounded-3xl p-6 shadow-card border-2 border-brandEmerald space-y-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center text-4xl">🐼</div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900">${name}</h3>
                                <span class="text-xs font-bold text-slate-500">العمر: ${age} سنوات • رمز PIN: <strong class="text-brandBlue">${pin}</strong></span>
                            </div>
                        </div>
                        <span class="bg-emerald-50 text-brandEmerald font-black text-xs px-3 py-1.5 rounded-xl">ملف جديد ✓</span>
                    </div>
                    <p class="text-xs text-slate-500 font-bold">جاهز للبدء في المسار التعليمي المناسب لعمره.</p>
                </div>
            `;
            grid.insertAdjacentHTML('beforeend', card);
        }

        function approveCourse() {
            document.getElementById('pending-status-cell').innerHTML = '<span class="bg-emerald-100 text-brandEmerald px-3 py-1 rounded-full text-xs">منشورة (Published)</span>';
            document.getElementById('pending-action-cell').innerHTML = '<span class="text-xs text-brandEmerald font-black">تم الاعتماد والنشر ✓</span>';
        }
        function addNewDemoCourse() {
            const tbody = document.getElementById('courses-table-body');
            const row = `
                <tr>
                    <td class="py-4 px-6 text-slate-900">بناء تطبيقات الذكاء الاصطناعي</td>
                    <td class="py-4 px-6 text-slate-600">12-15 سنة</td>
                    <td class="py-4 px-6"><span class="bg-orange-50 text-brandOrange px-2.5 py-1 rounded-lg text-xs">متقدم</span></td>
                    <td class="py-4 px-6"><span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs">قيد المراجعة (Pending)</span></td>
                    <td class="py-4 px-6"><button onclick="this.parentElement.previousElementSibling.innerHTML='<span class=\\'bg-emerald-100 text-brandEmerald px-3 py-1 rounded-full text-xs\\'>منشورة (Published)</span>'; this.parentElement.innerHTML='<span class=\\'text-xs text-brandEmerald font-black\\'>تم الاعتماد ✓</span>'" class="bg-brandEmerald text-white text-xs font-black px-4 py-2 rounded-xl cursor-pointer">اعتماد ونشر ✓</button></td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
        }
    </script>
</body>
</html>