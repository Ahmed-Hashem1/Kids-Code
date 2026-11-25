@extends('cms.parent')

@section('title', 'تحديد المستوى')

@section('contact')
    {{-- النسخة القديمة من الاختبار (معلّقة بالكامل فلا تظهر).
         تنبيه: إن أزلت التعليق عنها ستتكرر المعرفات page-placement و placement-result و placement-title و placement-desc
         مع النسخة الظاهرة أسفلها، فيتعطل التقييم — احذف إحدى النسختين أولاً. --}}
    {{-- <section id="page-placement" class="page-section py-12">
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
    </section> --}}

    <!-- ==================== اختبار تحديد المستوى (Placement) ==================== -->
    <section id="page-placement">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-10">
                <span class="text-amber-600 font-extrabold text-sm bg-amber-50 px-4 py-1.5 rounded-full">اختبار سريع من 3 أسئلة</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3">اختبار تحديد المستوى</h2>
                <p class="text-slate-600 mt-2 font-medium">أجب عن الأسئلة التالية لنحدد المستوى الأنسب لطفلك داخل مساره، بدون ضغط أو درجات محبطة.</p>
            </div>

            <form onsubmit="evaluatePlacement(event)" class="bg-white rounded-3xl p-6 sm:p-8 shadow-card border border-slate-100 space-y-8">
                <!-- السؤال الأول -->
                <fieldset>
                    <legend class="font-extrabold text-slate-900 mb-3">1. ما ناتج تنفيذ الكود التالي؟</legend>
                    <div dir="ltr" class="bg-slate-900 text-slate-100 p-4 rounded-2xl font-mono text-sm text-left mb-3">
                        <p><span class="text-emerald-400">x</span> = <span class="text-amber-300">3</span></p>
                        <p><span class="text-sky-400">print</span>(x + <span class="text-amber-300">2</span>)</p>
                    </div>
                    <div class="space-y-2">
                        <label class="flex items-center gap-3 bg-slate-50 hover:bg-brandBlue-50 border border-slate-200 rounded-2xl px-4 py-3 cursor-pointer text-sm font-bold text-slate-700 transition-colors">
                            <input type="radio" name="q1" value="1" required class="w-4 h-4 accent-blue-600"> <span dir="ltr">32</span>
                        </label>
                        <label class="flex items-center gap-3 bg-slate-50 hover:bg-brandBlue-50 border border-slate-200 rounded-2xl px-4 py-3 cursor-pointer text-sm font-bold text-slate-700 transition-colors">
                            <input type="radio" name="q1" value="3" class="w-4 h-4 accent-blue-600"> <span dir="ltr">5</span>
                        </label>
                        <label class="flex items-center gap-3 bg-slate-50 hover:bg-brandBlue-50 border border-slate-200 rounded-2xl px-4 py-3 cursor-pointer text-sm font-bold text-slate-700 transition-colors">
                            <input type="radio" name="q1" value="2" class="w-4 h-4 accent-blue-600"> <span dir="ltr">3</span>
                        </label>
                    </div>
                </fieldset>

                <!-- السؤال الثاني -->
                <fieldset>
                    <legend class="font-extrabold text-slate-900 mb-3">2. ما الرقم التالي في التسلسل: 2، 4، 6، 8، ...؟</legend>
                    <div class="space-y-2">
                        <label class="flex items-center gap-3 bg-slate-50 hover:bg-brandBlue-50 border border-slate-200 rounded-2xl px-4 py-3 cursor-pointer text-sm font-bold text-slate-700 transition-colors">
                            <input type="radio" name="q2" value="1" required class="w-4 h-4 accent-blue-600"> <span dir="ltr">9</span>
                        </label>
                        <label class="flex items-center gap-3 bg-slate-50 hover:bg-brandBlue-50 border border-slate-200 rounded-2xl px-4 py-3 cursor-pointer text-sm font-bold text-slate-700 transition-colors">
                            <input type="radio" name="q2" value="3" class="w-4 h-4 accent-blue-600"> <span dir="ltr">10</span>
                        </label>
                        <label class="flex items-center gap-3 bg-slate-50 hover:bg-brandBlue-50 border border-slate-200 rounded-2xl px-4 py-3 cursor-pointer text-sm font-bold text-slate-700 transition-colors">
                            <input type="radio" name="q2" value="2" class="w-4 h-4 accent-blue-600"> <span dir="ltr">12</span>
                        </label>
                    </div>
                </fieldset>

                <!-- السؤال الثالث -->
                <fieldset>
                    <legend class="font-extrabold text-slate-900 mb-3">3. ماذا سيطبع الكود التالي؟</legend>
                    <div dir="ltr" class="bg-slate-900 text-slate-100 p-4 rounded-2xl font-mono text-sm text-left mb-3">
                        <p><span class="text-emerald-400">age</span> = <span class="text-amber-300">12</span></p>
                        <p><span class="text-fuchsia-400">if</span> age &gt;= <span class="text-amber-300">10</span>:</p>
                        <p class="pl-4"><span class="text-sky-400">print</span>(<span class="text-amber-300">"كبير"</span>)</p>
                        <p><span class="text-fuchsia-400">else</span>:</p>
                        <p class="pl-4"><span class="text-sky-400">print</span>(<span class="text-amber-300">"صغير"</span>)</p>
                    </div>
                    <div class="space-y-2">
                        <label class="flex items-center gap-3 bg-slate-50 hover:bg-brandBlue-50 border border-slate-200 rounded-2xl px-4 py-3 cursor-pointer text-sm font-bold text-slate-700 transition-colors">
                            <input type="radio" name="q3" value="1" required class="w-4 h-4 accent-blue-600"> <span>صغير</span>
                        </label>
                        <label class="flex items-center gap-3 bg-slate-50 hover:bg-brandBlue-50 border border-slate-200 rounded-2xl px-4 py-3 cursor-pointer text-sm font-bold text-slate-700 transition-colors">
                            <input type="radio" name="q3" value="3" class="w-4 h-4 accent-blue-600"> <span>كبير</span>
                        </label>
                        <label class="flex items-center gap-3 bg-slate-50 hover:bg-brandBlue-50 border border-slate-200 rounded-2xl px-4 py-3 cursor-pointer text-sm font-bold text-slate-700 transition-colors">
                            <input type="radio" name="q3" value="2" class="w-4 h-4 accent-blue-600"> <span>سيظهر خطأ</span>
                        </label>
                    </div>
                </fieldset>

                <button type="submit" class="w-full hover-scale bg-gradient-to-l from-brandBlue-600 to-brandMint-500 text-white font-black py-3.5 rounded-2xl shadow-soft text-base">
                    اعرض نتيجتي
                </button>
            </form>

            <div id="placement-result" class="hidden mt-6 bg-brandMint-50 border border-brandMint-200 rounded-3xl p-6 text-center">
                <h3 id="placement-title" class="text-xl font-black text-brandMint-700"></h3>
                <p id="placement-desc" class="text-slate-600 font-medium mt-2"></p>
                {{-- عدّل الرابط حسب الـ URI المعرّف في web.php، أو استخدم route('cms.tracks') إن سمّيت المسار --}}
                <a href="{{ url('cms/tracks') }}" class="mt-5 inline-block hover-scale bg-brandBlue-600 hover:bg-brandBlue-700 text-white font-extrabold px-6 py-3 rounded-2xl shadow-soft text-sm">
                    استكشف مسارك التعليمي
                </a>
            </div>
        </div>
    </section>
@endsection

@section('script')
    {{-- سكربتات خاصة بصفحة تحديد المستوى (إن وُجدت) --}}
@endsection
