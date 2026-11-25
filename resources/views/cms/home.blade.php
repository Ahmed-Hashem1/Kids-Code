@extends('cms.parent');

@section('title' , 'الرئيسية')

@section('style')

@endsection
@section('contact')
<!-- ==================== 1. الصفحة الرئيسية (Home) ==================== -->
    <section id="page-home" class="page-section active">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-b from-brandBlue-50/70 via-white to-brandMint-50/40 pt-12 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- النصوص -->
                    <div class="space-y-6 text-center lg:text-right">
                        <div class="inline-flex items-center gap-2 bg-brandMint-100 text-brandMint-600 px-4 py-2 rounded-full text-sm font-extrabold">
                            <span aria-hidden="true">🚀</span>
                            <span>منصة عربية آمنة لتعليم البرمجة للأعمار من 7 إلى 15 سنة</span>
                        </div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-tight">
                            حوّل شغف طفلك بالألعاب إلى <span class="text-brandBlue-600">إبداع برمجي</span> حقيقي!
                        </h1>
                        <p class="text-lg sm:text-xl text-slate-600 font-medium leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            يتعلم طفلك في <strong>كودي</strong> أساسيات التفكير المنطقي، ثم ينتقل لقراءة وفهم كود <strong>Python</strong> و <strong>Java</strong> من خلال فيديوهات قصيرة، شروحات مصوّرة، وتحديات ذكية بدون تعقيد.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-2">
                            <button type="button" onclick="openBookingModal()" class="hover-scale bg-brandBlue-600 hover:bg-brandBlue-700 text-white font-extrabold px-8 py-4 rounded-2xl shadow-soft text-lg">
                                احجز مقعد طفلك الآن
                            </button>
                            <a href="{{ route('cms/placementTest') }}" class="hover-scale bg-white hover:bg-brandMint-50 text-brandMint-600 border-2 border-brandMint-500 font-extrabold px-8 py-4 rounded-2xl shadow-sm text-lg">
                                جرّب اختبار تحديد المستوى
                            </a>
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
                                    <div class="w-12 h-12 rounded-2xl bg-brandMint-100 text-brandMint-600 flex items-center justify-center text-2xl" aria-hidden="true">🤖</div>
                                    <div>
                                        <h3 class="font-extrabold text-slate-900">تحدي إصلاح الخطأ (Python)</h3>
                                        <span class="text-xs font-bold text-brandBlue-600 bg-brandBlue-50 px-2.5 py-1 rounded-lg">الفئة: 10 - 12 سنة</span>
                                    </div>
                                </div>
                                <span class="bg-amber-100 text-amber-700 font-extrabold text-xs px-3 py-1.5 rounded-xl">+10 XP ⭐</span>
                            </div>

                            <!-- محاكي كود بسيط -->
                            <div dir="ltr" class="bg-slate-900 text-slate-100 p-5 rounded-2xl font-mono text-sm space-y-2 text-left shadow-inner">
                                <div class="flex gap-1.5 mb-3" aria-hidden="true">
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
                                    <div class="text-lg" aria-hidden="true">🎬</div>
                                    <div class="text-xs font-extrabold text-brandMint-700 mt-1">1. فيديو قصير</div>
                                    <div class="text-[11px] text-slate-500">اعتماد عند 90%</div>
                                </div>
                                <div class="bg-brandBlue-50 border border-brandBlue-200 p-3 rounded-2xl text-center">
                                    <div class="text-lg" aria-hidden="true">📖</div>
                                    <div class="text-xs font-extrabold text-brandBlue-700 mt-1">2. شرح مصوّر</div>
                                    <div class="text-[11px] text-slate-500">بسيط وممتع</div>
                                </div>
                                <div class="bg-amber-50 border border-amber-200 p-3 rounded-2xl text-center">
                                    <div class="text-lg" aria-hidden="true">🧩</div>
                                    <div class="text-xs font-extrabold text-amber-700 mt-1">3. تحدٍ عملي</div>
                                    <div class="text-[11px] text-slate-500">حتى 3 نجوم</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- قسم المسارات العمرية المختصر -->
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
        </div> --}}

        <!-- خصوصية وأمان الأطفال (من قسم قواعد العمل في SRS) -->
        {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="bg-gradient-to-l from-brandBlue-600 to-brandMint-600 rounded-3xl p-8 sm:p-12 text-white shadow-soft">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    <div class="md:col-span-2 space-y-3">
                        <h3 class="text-2xl sm:text-3xl font-black">بيئة تعليمية آمنة 100% تحترم خصوصية طفلك 🛡️</h3>
                        <p class="text-blue-50 font-medium leading-relaxed">
                            في منصة <strong>كودي</strong>، لا نطلب تاريخ ميلاد الطفل أو صوره الشخصية؛ يكتفي ولي الأمر باختيار الفئة العمرية واسم مستعار وأفاتار كرتوني. كما لا توجد دردشة مفتوحة أو لوحات شرف للمقارنة المحبطة، بل تحفيز ذاتي عبر نقاط XP والأوسمة!
                        </p>
                    </div>
                    <div class="text-center md:text-left">
                        <button type="button" onclick="openBookingModal()" class="hover-scale bg-white text-brandBlue-600 font-black px-8 py-4 rounded-2xl shadow-lg text-base">
                            أنشئ حساب ولي الأمر مجاناً
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}
    </section> 


@section('script')

@endsection

@endsection
