@extends('cms.parent')

@section('title' , 'المسارات التعليمية')

@section('style')

@endsection
@section('contact')
<!-- ==================== 2. صفحة المسارات التعليمية (Tracks) ==================== -->
    {{-- <section id="page-tracks" class="page-section py-12">
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
    </section> --}}

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
                        <div class="w-14 h-14 rounded-2xl bg-brandMint-100 text-brandMint-600 flex items-center justify-center text-3xl mb-5" aria-hidden="true">🧩</div>
                        <span class="bg-brandMint-50 text-brandMint-600 text-xs font-extrabold px-3 py-1 rounded-xl">الفئة العمرية: 7 - 9 سنوات</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-3">المستكشف الصغير (منطق بصري)</h3>
                        <p class="text-slate-600 text-sm mt-2 leading-relaxed">بناء التفكير المنطقي بدون كتابة كود معقد عبر الألغاز البصرية والحركة.</p>
                        <ul class="mt-5 space-y-2.5 text-sm font-bold text-slate-700">
                            <li class="flex items-center gap-2"><span class="text-brandMint-500" aria-hidden="true">✔</span> المستوى 1: التسلسل المنطقي</li>
                            <li class="flex items-center gap-2"><span class="text-brandMint-500" aria-hidden="true">✔</span> المستوى 2: التكرار والعد</li>
                            <li class="flex items-center gap-2"><span class="text-brandMint-500" aria-hidden="true">✔</span> المستوى 3: الشرط وتتبع الناتج</li>
                        </ul>
                    </div>
                    <button type="button" onclick="navigateTo('tracks')" class="mt-7 w-full py-3 rounded-2xl bg-brandMint-50 hover:bg-brandMint-500 text-brandMint-600 hover:text-white font-extrabold transition-colors">استكشف تفاصيل المسار</button>
                </div>

                <!-- المسار الثاني: 10-12 -->
                <div class="bg-white rounded-3xl p-7 shadow-card border-2 border-brandBlue-500 hover-scale flex flex-col justify-between relative">
                    <span class="absolute -top-3.5 left-6 bg-brandBlue-600 text-white text-xs font-extrabold px-4 py-1 rounded-full shadow-sm">الأكثر طلباً</span>
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-brandBlue-100 text-brandBlue-600 flex items-center justify-center text-3xl mb-5" aria-hidden="true">🐍</div>
                        <span class="bg-brandBlue-50 text-brandBlue-600 text-xs font-extrabold px-3 py-1 rounded-xl">الفئة العمرية: 10 - 12 سنة</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-3">مبرمج بايثون (Python)</h3>
                        <p class="text-slate-600 text-sm mt-2 leading-relaxed">الانتقال السلس لقراءة وفهم لغة بايثون وتوقع مخرجاتها وإصلاح أخطائها.</p>
                        <ul class="mt-5 space-y-2.5 text-sm font-bold text-slate-700">
                            <li class="flex items-center gap-2"><span class="text-brandBlue-600" aria-hidden="true">✔</span> المستوى 1: الطباعة print والمتغيرات</li>
                            <li class="flex items-center gap-2"><span class="text-brandBlue-600" aria-hidden="true">✔</span> المستوى 2: الجمل الشرطية if / else</li>
                            <li class="flex items-center gap-2"><span class="text-brandBlue-600" aria-hidden="true">✔</span> المستوى 3: الحلقات التكرارية for / while</li>
                        </ul>
                    </div>
                    <button type="button" onclick="navigateTo('tracks')" class="mt-7 w-full py-3 rounded-2xl bg-brandBlue-600 hover:bg-brandBlue-700 text-white font-extrabold transition-colors">استكشف تفاصيل المسار</button>
                </div>

                <!-- المسار الثالث: 13-15 -->
                <div class="bg-white rounded-3xl p-7 shadow-card border border-slate-100 hover-scale flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-3xl mb-5" aria-hidden="true">☕</div>
                        <span class="bg-emerald-50 text-emerald-600 text-xs font-extrabold px-3 py-1 rounded-xl">الفئة العمرية: 13 - 15 سنة</span>
                        <h3 class="text-2xl font-black text-slate-900 mt-3">مهندس المستقبل (Python & Java)</h3>
                        <p class="text-slate-600 text-sm mt-2 leading-relaxed">تعميق الخوارزميات بلغة بايثون ثم التعرف على بنية لغة Java والمقارنة بينهما.</p>
                        <ul class="mt-5 space-y-2.5 text-sm font-bold text-slate-700">
                            <li class="flex items-center gap-2"><span class="text-emerald-500" aria-hidden="true">✔</span> المستوى 1: القوائم والدوال (Python)</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500" aria-hidden="true">✔</span> المستوى 2: خوارزميات صغيرة</li>
                            <li class="flex items-center gap-2"><span class="text-emerald-500" aria-hidden="true">✔</span> المستوى 3: بنية وأنواع Java والمقارنة</li>
                        </ul>
                    </div>
                    <button type="button" onclick="navigateTo('tracks')" class="mt-7 w-full py-3 rounded-2xl bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white font-extrabold transition-colors">استكشف تفاصيل المسار</button>
                </div>
            </div>
        </div>

    @section('script')

    @endsection
@endsection
