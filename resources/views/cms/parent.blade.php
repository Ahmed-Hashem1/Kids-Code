<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'تعليم البرمجة للأطفال') | كودي</title>
    <meta name="description" content="منصة كودي العربية الآمنة لتعليم البرمجة للأطفال من 7 إلى 15 سنة: منطق بصري، Python و Java عبر فيديوهات قصيرة وتحديات تفاعلية.">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🤖</text></svg>">

    <!-- خط تجوال العربي من Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS عبر CDN: مناسب للتطوير فقط، استبدله ببناء Vite قبل النشر للإنتاج -->
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

    {{-- أنماط الصفحات الفرعية: بعد Tailwind حتى تتغلّب على الأنماط الافتراضية --}}
    @yield('style')

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
        .nav-icon-wrap {
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), background-color 0.2s ease;
        }
        .nav-item-btn:hover .nav-icon-wrap {
            transform: scale(1.12) rotate(-4deg);
        }
        /* الحالة النشطة لعناصر التنقل (يضبطها الجافاسكربت عبر setActiveNav) */
        .nav-link.nav-active {
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
        }
        .mobile-nav-link.nav-active {
            background-color: #eff6ff;
            color: #1d4ed8;
        }
    </style>
</head>
<body class="text-slate-800 antialiased selection:bg-brandMint-400 selection:text-white">

    <!-- ==================== شريط التنقل العلوي (Navbar) ==================== -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <!-- الشعار (كودي) -->
                <button type="button" onclick="navigateTo('home')" aria-label="العودة إلى الرئيسية" class="flex items-center gap-3 cursor-pointer hover-scale">
                    <span class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-brandBlue-600 to-brandMint-500 flex items-center justify-center text-white shadow-soft">
                        <svg aria-hidden="true" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </span>
                    <span class="text-right">
                        <span class="block text-2xl font-black bg-gradient-to-l from-brandBlue-600 to-brandMint-600 bg-clip-text text-transparent leading-none">كودي</span>
                        <span class="block text-xs font-bold text-slate-400 mt-1">نبرمج المستقبل بمرح</span>
                    </span>
                </button>
                     <!-- روابط التنقل (Desktop) -->
                <div class="hidden md:flex items-center gap-1.5 bg-slate-50/90 p-1.5 rounded-2xl border border-slate-200/70">
                    <!-- 1. الرئيسية -->
                    <a href="{{ route('cms/home') }}" class="nav-link nav-item-btn px-3.5 py-2 rounded-xl text-sm font-bold text-brandBlue-600 hover:bg-white transition-all flex items-center gap-2 {{ request()->routeIs('cms/home') ? 'bg-white' : '' }}">
                        <span class="nav-icon-wrap w-7 h-7 rounded-xl bg-brandBlue-100 text-brandBlue-600 flex items-center justify-center">
                            <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5V20a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-9.5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21v-5.5l2.5-1V21" />
                            </svg>
                        </span>
                        <span class="font-extrabold">الرئيسية</span>
                    </a>

                    <!-- 2. المسارات التعليمية -->
                    <a href="{{ route('cms/Paths') }}" class="nav-link nav-item-btn px-3.5 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-brandMint-600 hover:bg-white transition-all flex items-center gap-2 {{ request()->routeIs('cms/Paths') ? 'bg-white' : '' }}">
                        <span class="nav-icon-wrap w-7 h-7 rounded-xl bg-brandMint-100 text-brandMint-600 flex items-center justify-center">
                            <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </span>
                        <span>المسارات التعليمية</span>
                    </a>

                    <!-- 3. تحديد المستوى -->
                    <a href="{{ route('cms/placementTest') }}" class="nav-link nav-item-btn px-3.5 py-2 rounded-xl text-sm font-bold text-slate-600 hover:text-amber-600 hover:bg-white transition-all flex items-center gap-2 {{ request()->routeIs('cms/placementTest') ? 'bg-white' : '' }}">
                        <span class="nav-icon-wrap w-7 h-7 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                            <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="8" />
                                <circle cx="12" cy="12" r="3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M2 12h2m16 0h2" />
                            </svg>
                        </span>
                        <span>تحديد المستوى</span>
                    </a>
                </div>

               

                @guest
                    <a href="{{ route('login') }}" class="hover-scale bg-slate-100 hover:bg-brandBlue-50 text-slate-700 hover:text-brandBlue-600 font-extrabold px-4 py-3 rounded-2xl transition-all text-sm hidden sm:flex items-center gap-2 border border-slate-200">
                        <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>دخول</span>
                    </a>
                @else
                    <button type="button" onclick="navigateTo('parent-dashboard')" class="hover-scale bg-slate-100 hover:bg-brandBlue-50 text-slate-700 hover:text-brandBlue-600 font-extrabold px-4 py-3 rounded-2xl transition-all text-sm hidden sm:flex items-center gap-2 border border-slate-200">
                        <span>لوحة ولي الأمر</span>
                    </button>
                @endguest



</div>
    </nav>


    <!-- ==================== نافذة الحجز وإضافة طفل (Booking & Registration Modal) ==================== -->
    <!-- ملاحظة: هذا النموذج تجريبي يعمل بالجافاسكربت فقط. في النسخة الحقيقية يجب إرساله إلى مسار POST في الخادم مع @csrf، وتوليد كلمة المرور المؤقتة في الخادم وإرسالها إلى بريد ولي الأمر. -->
    <div id="booking-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4" role="dialog" aria-modal="true" aria-labelledby="booking-modal-title" onclick="if (event.target === this) closeBookingModal()">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative animate-[fadeIn_0.25s_ease-out] max-h-[90vh] overflow-y-auto">
            <button type="button" onclick="closeBookingModal()" aria-label="إغلاق نافذة الحجز" class="absolute top-6 left-6 w-9 h-9 rounded-full bg-slate-100 text-slate-600 hover:bg-rose-100 hover:text-rose-600 flex items-center justify-center font-bold">✕</button>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-brandMint-100 text-brandMint-600 flex items-center justify-center text-2xl" aria-hidden="true">🚀</div>
                <div>
                    <h3 id="booking-modal-title" class="text-2xl font-black text-slate-900">احجز مقعد طفلك في كودي</h3>
                    <p class="text-xs font-bold text-slate-500">خطوة واحدة لإنشاء حساب ولي الأمر وملف الطفل الآمن</p>
                </div>
            </div>

            <form onsubmit="handleBookingSubmit(event)" class="space-y-4">
                <div>
                    <label for="modal-parent-email" class="block text-xs font-extrabold text-slate-700 mb-1">البريد الإلكتروني لولي الأمر</label>
                    <input id="modal-parent-email" type="email" required placeholder="parent@example.com" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="modal-child-name" class="block text-xs font-extrabold text-slate-700 mb-1">الاسم المستعار للطفل</label>
                        <input id="modal-child-name" type="text" required placeholder="مثال: البطل زيد" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold">
                    </div>
                    <div>
                        <label for="modal-child-username" class="block text-xs font-extrabold text-slate-700 mb-1">اسم دخول فريد للطفل</label>
                        <input id="modal-child-username" type="text" required placeholder="zaid_2026" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="modal-age-group" class="block text-xs font-extrabold text-slate-700 mb-1">الفئة العمرية (بدون تاريخ ميلاد)</label>
                        <select id="modal-age-group" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold bg-white">
                            <option value="7-9">7 - 9 سنوات (منطق بصري)</option>
                            <option value="10-12" selected>10 - 12 سنة (Python)</option>
                            <option value="13-15">13 - 15 سنة (Python & Java)</option>
                        </select>
                    </div>
                    <div>
                        <label for="modal-avatar" class="block text-xs font-extrabold text-slate-700 mb-1">اختر الأفاتار الجاهز</label>
                        <select id="modal-avatar" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold bg-white">
                            <option value="🦁">🦁 الأسد الذكي</option>
                            <option value="🤖">🤖 الروبوت كودي</option>
                            <option value="🚀">🚀 رائد الفضاء</option>
                            <option value="🦄">🦄 المبرمج المبدع</option>
                        </select>
                    </div>
                </div>

                <div class="bg-brandBlue-50 p-3.5 rounded-2xl text-xs font-bold text-brandBlue-700">
                    🔒 سيتم إرسال كلمة مرور مؤقتة إلى بريد ولي الأمر، يغيّرها الطفل عند أول تسجيل دخول، وسيُسجَّل تلقائياً في أحدث نسخة منشورة لمساره.
                </div>

                <button type="submit" class="w-full hover-scale bg-gradient-to-l from-brandBlue-600 to-brandMint-500 text-white font-black py-3.5 rounded-2xl shadow-soft text-base">
                    تأكيد الحجز وإنشاء الحساب الآن
                </button>
            </form>
        </div>
    </div>

    <main>
    


    <!-- ==================== 4. لوحة ولي الأمر (Parent Dashboard) ==================== -->
    {{-- <section id="page-parent-dashboard" class="page-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
                <div>
                    <h2 class="text-3xl font-black text-slate-900">لوحة ولي الأمر</h2>
                    <p class="text-slate-600 font-medium mt-1">تابع تقدم أطفالك، وأضف طفلاً جديداً في أي وقت.</p>
                </div>
                <button type="button" onclick="openBookingModal()" class="hover-scale bg-gradient-to-l from-brandBlue-600 to-brandMint-500 text-white font-extrabold px-6 py-3 rounded-2xl shadow-soft text-sm">
                    + إضافة طفل جديد
                </button>
            </div>

            <div id="parent-children-grid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div id="no-children-empty" class="bg-white rounded-3xl p-8 shadow-card border border-dashed border-slate-200 text-center md:col-span-2">
                    <div class="text-4xl mb-3" aria-hidden="true">👨‍👩‍👧</div>
                    <h3 class="font-extrabold text-slate-900 text-lg">لا يوجد أطفال مسجلون بعد</h3>
                    <p class="text-slate-500 text-sm font-medium mt-1">احجز مقعداً لطفلك وسيظهر ملفه هنا مع تقدمه ونتائجه.</p>
                    <button type="button" onclick="openBookingModal()" class="mt-5 hover-scale bg-brandBlue-600 hover:bg-brandBlue-700 text-white font-extrabold px-6 py-3 rounded-2xl shadow-soft text-sm">
                        احجز مقعد طفلك الآن
                    </button>
                </div>
            </div>
        </div>
    </section> --}}


    @yield('contact')

    <!-- ==================== تذييل الصفحة (Footer) ==================== -->
    <footer class="bg-white border-t border-slate-100 mt-16 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-brandBlue-600 text-white flex items-center justify-center font-black">C</div>
                <span class="font-black text-lg text-slate-900">منصة كودي لتعليم البرمجة للأطفال</span>
            </div>
            <p class="text-sm text-slate-500 font-bold">جميع الحقوق محفوظة © {{ date('Y') }} • مصمم وفق مواصفات تحليل النظام (SRS)</p>
        </div>
    </footer>

    <!-- ==================== أكواد التفاعل (JavaScript) ==================== -->
    <script>
        // 1. التنقل بين الصفحات (SPA Multi-page Simulation)
        function setActiveNav(pageId) {
            document.querySelectorAll('[data-nav]').forEach(el => {
                el.classList.toggle('nav-active', el.dataset.nav === pageId);
            });
        }

        function navigateTo(pageId) {
            const target = document.getElementById('page-' + pageId);
            if (!target) {
                console.warn('الصفحة غير موجودة: page-' + pageId);
                return;
            }
            document.querySelectorAll('.page-section').forEach(sec => sec.classList.remove('active'));
            target.classList.add('active');
            setActiveNav(pageId);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const btn = document.getElementById('mobile-menu-btn');
            const isHidden = menu.classList.toggle('hidden');
            btn.setAttribute('aria-expanded', String(!isHidden));
        }

        // 2. التحكم بنافذة الحجز وإضافة طفل
        let lastFocusedElement = null;

        function openBookingModal(ageGroup = '10-12') {
            lastFocusedElement = document.activeElement;
            document.getElementById('modal-age-group').value = ageGroup;
            const modal = document.getElementById('booking-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.documentElement.style.overflow = 'hidden';
            document.getElementById('modal-parent-email').focus();
        }

        function closeBookingModal() {
            const modal = document.getElementById('booking-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.documentElement.style.overflow = '';
            if (lastFocusedElement) lastFocusedElement.focus();
        }

        // إغلاق النافذة بزر Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !document.getElementById('booking-modal').classList.contains('hidden')) {
                closeBookingModal();
            }
        });

        // تنظيف مدخلات المستخدم قبل إدخالها في HTML (منع ثغرات XSS)
        function escapeHtml(value) {
            return String(value)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#39;');
        }

        function handleBookingSubmit(e) {
            e.preventDefault();
            const name = document.getElementById('modal-child-name').value.trim();
            const username = document.getElementById('modal-child-username').value.trim();
            const age = document.getElementById('modal-age-group').value;
            const avatar = document.getElementById('modal-avatar').value;

            const grid = document.getElementById('parent-children-grid');
            if (!grid) {
                closeBookingModal();
                return;
            }
            const emptyState = document.getElementById('no-children-empty');
            if (emptyState) emptyState.remove();

            const cardHTML = `
                <div class="bg-white rounded-3xl p-7 shadow-card border-2 border-brandMint-400 space-y-5 animate-[fadeIn_0.35s_ease-out]">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-brandMint-100 text-3xl flex items-center justify-center">${escapeHtml(avatar)}</div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900">${escapeHtml(name)} (جديد)</h3>
                                <p class="text-xs font-bold text-slate-500">اسم الدخول: <span class="text-brandBlue-600">${escapeHtml(username)}</span> • الفئة: ${escapeHtml(age)} سنة</p>
                            </div>
                        </div>
                        <span class="bg-brandBlue-100 text-brandBlue-700 text-xs font-extrabold px-3 py-1 rounded-full">بانتظار اختبار التحديد</span>
                    </div>
                    <div class="bg-brandMint-50 p-3.5 rounded-2xl text-xs font-bold text-brandMint-700">
                        ✔ تم الحجز بنجاح! تم إرسال كلمة المرور المؤقتة إلى بريد ولي الأمر.
                    </div>
                    <button type="button" onclick="navigateTo('placement')" class="w-full bg-brandBlue-600 text-white font-extrabold py-2.5 rounded-xl text-sm hover:bg-brandBlue-700">
                        بدء اختبار تحديد المستوى للطفل الآن
                    </button>
                </div>
            `;
            grid.insertAdjacentHTML('afterbegin', cardHTML);
            e.target.reset();
            closeBookingModal();
            navigateTo('parent-dashboard');
        }

        // 3. تقييم اختبار تحديد المستوى (BR-02)
        function evaluatePlacement(e) {
            e.preventDefault();
            const q1 = document.querySelector('input[name="q1"]:checked');
            const q2 = document.querySelector('input[name="q2"]:checked');
            const q3 = document.querySelector('input[name="q3"]:checked');
            const resultBox = document.getElementById('placement-result');

            if (!q1 || !q2 || !q3) {
                document.getElementById('placement-title').textContent = 'لم تكتمل الإجابات بعد';
                document.getElementById('placement-desc').textContent = 'يرجى الإجابة عن جميع الأسئلة الثلاثة لعرض نتيجتك.';
                resultBox.classList.remove('hidden');
                return;
            }

            const score = parseInt(q1.value, 10) + parseInt(q2.value, 10) + parseInt(q3.value, 10); // الدرجة من 9

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
            resultBox.classList.remove('hidden');
            resultBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
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

            if (Number(answer) === 8) {
                fb.classList.add('bg-brandMint-100', 'text-brandMint-800');
                fb.innerHTML = '🌟 إجابة صحيحة 100%! قيمة stars كانت 5 وأضفنا إليها 3 فأصبحت 8. حصلت على 3 نجوم ⭐⭐⭐';
                const badge = document.getElementById('step-challenge-badge');
                badge.textContent = '3. التحدي ✔';
                badge.className = 'px-3 py-1.5 rounded-xl bg-brandMint-100 text-brandMint-700';
                lessonState.challenge = true;
                checkLessonCompletion();
            } else {
                fb.classList.add('bg-amber-100', 'text-amber-800');
                fb.innerHTML = '💡 محاولة جيدة! تذكّر أن المتغير stars تغيّرت قيمته في السطر الثاني بجمع 3. تم احتساب محاولتك ويمكنك الإعادة للحصول على 3 نجوم!';
            }
        }

        function checkLessonCompletion() {
            if (lessonState.video && lessonState.read && lessonState.challenge && !lessonState.xpAwarded) {
                lessonState.xpAwarded = true;
                document.getElementById('lesson-completed-banner').classList.remove('hidden');
                const xpEl = document.getElementById('xp-counter');
                xpEl.textContent = '130 XP ⭐';
            }
        }

        // الحالة الابتدائية: الرئيسية مفعّلة في التنقل
        setActiveNav('home');
    </script>
    @yield('script')
</body>
</html>
