<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | منصة كودي لتعليم البرمجة</title>
    <!-- خط تجوال العربي -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Tajawal', 'sans-serif'] },
                    colors: {
                        brandBlue: { 500: '#2563eb', 600: '#1d4ed8', 700: '#1e40af' },
                        brandMint: { 400: '#34d399', 500: '#10b981', 600: '#059669' }
                    },
                    boxShadow: {
                        'soft': '0 15px 35px -5px rgba(37, 99, 235, 0.08), 0 5px 15px -3px rgba(16, 185, 129, 0.05)'
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Tajawal', sans-serif; background-color: #f8fafc; }
        .tab-content { display: none; animation: fadeIn 0.3s ease-in-out; }
        .tab-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex flex-col justify-between py-10 px-4">

    <!-- شعار المنصة العلوي -->
    <div class="max-w-md mx-auto text-center mb-6">
        <a href="#" class="inline-flex items-center gap-3 group">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-brandBlue-600 to-brandMint-500 flex items-center justify-center text-white shadow-soft group-hover:scale-105 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
            </div>
            <div class="text-right">
                <span class="text-2xl font-black bg-gradient-to-l from-brandBlue-600 to-brandMint-600 bg-clip-text text-transparent">كودي</span>
                <span class="block text-xs font-bold text-slate-400 -mt-1">بوابة الدخول الموحدة</span>
            </div>
        </a>
    </div>

    <!-- صندوق تسجيل الدخول الرئيسي -->
    <main class="max-w-md w-full mx-auto bg-white rounded-3xl p-8 shadow-soft border border-slate-100">

        <!-- أزرار اختيار نوع المستخدم (Tabs) -->
        <div class="grid grid-cols-3 gap-1 bg-slate-100 p-1.5 rounded-2xl mb-8">
            <button onclick="switchTab('parent')" id="tab-parent" class="tab-btn py-2.5 rounded-xl text-xs font-extrabold transition-all bg-white text-brandBlue-600 shadow-sm">ولي الأمر</button>
            <button onclick="switchTab('child')" id="tab-child" class="tab-btn py-2.5 rounded-xl text-xs font-extrabold transition-all text-slate-600 hover:text-brandBlue-600">الطفل 🦊</button>
            <button onclick="switchTab('admin')" id="tab-admin" class="tab-btn py-2.5 rounded-xl text-xs font-extrabold transition-all text-slate-600 hover:text-brandBlue-600">المدير 🛡️</button>
        </div>

        <!-- 1. نموذج تسجيل دخول ولي الأمر -->
        <div id="content-parent" class="tab-content active space-y-5">
            <div class="space-y-1">
                <h2 class="text-xl font-black text-slate-900">تسجيل دخول ولي الأمر</h2>
                <p class="text-xs text-slate-500 font-bold">أدخل بريدك الإلكتروني وكلمة المرور لمتابعة أطفالك.</p>
            </div>
            <form onsubmit="handleLogin(event, 'لوحة ولي الأمر')" class="space-y-4">
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">البريد الإلكتروني المؤكد</label>
                    <input type="email" required placeholder="parent@example.com" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold bg-slate-50/50">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="text-xs font-extrabold text-slate-700">كلمة المرور</label>
                        <a href="#" class="text-xs font-bold text-brandBlue-600 hover:underline">هل نسيت كلمة المرور؟</a>
                    </div>
                    <input type="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandBlue-500 focus:outline-none text-sm font-bold bg-slate-50/50">
                </div>
                <button type="submit" class="w-full bg-brandBlue-600 hover:bg-brandBlue-700 text-white font-extrabold py-3.5 rounded-2xl shadow-md text-sm transition-transform active:scale-98">
                    دخول لوحة ولي الأمر
                </button>
            </form>
        </div>

        <!-- 2. نموذج تسجيل دخول الطفل (حسب FR-03: اسم مستخدم وكلمة مرور مؤقتة وتغييرها عند أول دخول) -->
        <div id="content-child" class="tab-content space-y-5">
            <div class="space-y-1">
                <h2 class="text-xl font-black text-slate-900">دخول الطفل المبرمج</h2>
                <p class="text-xs text-slate-500 font-bold">أدخل اسم المستخدم وكلمة المرور المؤقتة التي أنشأها ولي الأمر.</p>
            </div>
            <form onsubmit="handleLogin(event, 'لوحة تفاعلات الطفل')" class="space-y-4">
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">اسم المستخدم الفريد للطفل</label>
                    <input type="text" required placeholder="osama_code" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandMint-500 focus:outline-none text-sm font-bold bg-slate-50/50" dir="ltr">
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">كلمة المرور المؤقتة</label>
                    <input type="password" required placeholder="Kody#2026" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brandMint-500 focus:outline-none text-sm font-bold bg-slate-50/50" dir="ltr">
                </div>
                <div class="bg-brandMint-50 p-3 rounded-2xl border border-brandMint-200 text-xs font-bold text-brandMint-800">
                    💡 ملاحظة: عند أول دخول، سيطلب منك النظام تغيير كلمة المرور المؤقتة إلى كلمة مرور جديدة خاصة بك (قاعدة FR-03).
                </div>
                <button type="submit" class="w-full bg-brandMint-500 hover:bg-brandMint-600 text-white font-extrabold py-3.5 rounded-2xl shadow-md text-sm transition-transform active:scale-98">
                    ابدأ رحلة التعلم 🚀
                </button>
            </form>
        </div>

        <!-- 3. نموذج تسجيل دخول المدير -->
        <div id="content-admin" class="tab-content space-y-5">
            <div class="space-y-1">
                <h2 class="text-xl font-black text-slate-900">دخول المدير / المشرف</h2>
                <p class="text-xs text-slate-500 font-bold">إدارة المسارات والمحتوى والنشر والحسابات[cite: 3, 15].</p>
            </div>
            <form onsubmit="handleLogin(event, 'لوحة تحكم المدير')" class="space-y-4">
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">البريد الإداري</label>
                    <input type="email" required placeholder="admin@kody.com" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-slate-800 focus:outline-none text-sm font-bold bg-slate-50/50" dir="ltr">
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">كلمة المرور الإدارية الآمنة</label>
                    <input type="password" required placeholder="••••••••••••" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-slate-800 focus:outline-none text-sm font-bold bg-slate-50/50" dir="ltr">
                </div>
                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-extrabold py-3.5 rounded-2xl shadow-md text-sm transition-transform active:scale-98">
                    الدخول إلى لوحة المدير 🛡️
                </button>
            </form>
        </div>

    </main>

    <!-- تذييل الصفحة -->
    <footer class="text-center mt-6 text-xs text-slate-400 font-bold">
        منصة كودي لتعليم البرمجة للأطفال © 2026 • حماية تامة وآمنة للبيانات[cite: 15, 20]
    </footer>

    <!-- جافاسكريبت للتحويل والتفاعل -->
    <script>
        function switchTab(role) {
            // إخفاء كافة المحتويات
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            // إزالة الأنماط النشطة عن الأزرار
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-brandBlue-600', 'shadow-sm');
                btn.classList.add('text-slate-600');
            });

            // إظهار المحتوى المطلوب وتفعيل الزر
            document.getElementById('content-' + role).classList.add('active');
            const activeBtn = document.getElementById('tab-' + role);
            activeBtn.classList.add('bg-white', 'text-brandBlue-600', 'shadow-sm');
            activeBtn.classList.remove('text-slate-600');
        }

        function handleLogin(e, dashboardName) {
            e.preventDefault();
            alert('تم التحقق بنجاح! سيتم توجيهك الآن إلى ' + dashboardName + '.');
        }
    </script>
</body>
</html>
