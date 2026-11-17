<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كودي || @yield('title')<</title>
    <!-- خط تجوال العربي من Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    @yield('style')
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
@yield('contact')
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
    @yield('script')
</body>
</html>