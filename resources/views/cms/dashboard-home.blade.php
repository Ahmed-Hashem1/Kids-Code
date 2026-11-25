{{--
  الصفحة الرئيسية للوحة التحكم (تُفتح على /admin).
  ترث قالب لوحة التحكم وتضع محتواها في @section('content').

  الأرقام: مرّرها من الـ route أو الكنترولر بهذا الشكل، وعدّل أسماء
  الموديلات حسب مشروعك:
      return view('cms.dashboard-home', [
          'childrenCount' => Child::count(),
          'lessonsCount'  => Lesson::count(),
          'parentsCount'  => User::where('role', 'parent')->count(),
          'badgesCount'   => Badge::count(),
      ]);
  وإن لم تمرّرها ستظهر القيم التجريبية المكتوبة هنا.
--}}
@extends('cms.dashboard')
{{-- إن كان ملف القالب في مسار آخر، عدّل السطر أعلاه، مثلاً: @extends('admin.dashboard') --}}

@section('sub_title', 'نظرة عامة على المنصة')

@section('content')
  <!--begin::Stat Boxes Row-->
  <div class="row g-3 mb-4">
    <div class="col-lg-3 col-6">
      <div class="card kody-stat-card kody-grad-blue h-100">
        <div class="card-body d-flex justify-content-between align-items-center gap-2">
          <div>
            <span class="badge bg-white bg-opacity-20 text-white rounded-pill mb-2">+14% هذا الشهر</span>
            <h3 class="fs-2 fw-black mb-1">{{ number_format($childrenCount ?? 342) }}</h3>
            <p class="mb-0 fw-semibold opacity-90 small">الأطفال المسجلون</p>
          </div>
          <div class="kody-stat-icon-box">
            <i class="bi bi-emoji-smile-fill fs-3"></i>
          </div>
        </div>
        <div class="card-footer bg-black bg-opacity-10 border-0 py-2">
          <a href="#" class="text-white text-decoration-none fs-7 fw-bold d-flex justify-content-between align-items-center">
            <span>عرض التفاصيل</span>
            <i class="bi bi-arrow-left-circle"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="card kody-stat-card kody-grad-mint h-100">
        <div class="card-body d-flex justify-content-between align-items-center gap-2">
          <div>
            <span class="badge bg-white bg-opacity-20 text-white rounded-pill mb-2">3 مسارات نشطة</span>
            <h3 class="fs-2 fw-black mb-1">{{ number_format($lessonsCount ?? 27) }}</h3>
            <p class="mb-0 fw-semibold opacity-90 small">الدروس المنشورة</p>
          </div>
          <div class="kody-stat-icon-box">
            <i class="bi bi-code-square fs-3"></i>
          </div>
        </div>
        <div class="card-footer bg-black bg-opacity-10 border-0 py-2">
          <a href="#" class="text-white text-decoration-none fs-7 fw-bold d-flex justify-content-between align-items-center">
            <span>إدارة الدروس</span>
            <i class="bi bi-arrow-left-circle"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="card kody-stat-card kody-grad-indigo h-100">
        <div class="card-body d-flex justify-content-between align-items-center gap-2">
          <div>
            <span class="badge bg-white bg-opacity-20 text-white rounded-pill mb-2">+9% هذا الشهر</span>
            <h3 class="fs-2 fw-black mb-1">{{ number_format($parentsCount ?? 198) }}</h3>
            <p class="mb-0 fw-semibold opacity-90 small">أولياء الأمور</p>
          </div>
          <div class="kody-stat-icon-box">
            <i class="bi bi-people-fill fs-3"></i>
          </div>
        </div>
        <div class="card-footer bg-black bg-opacity-10 border-0 py-2">
          <a href="#" class="text-white text-decoration-none fs-7 fw-bold d-flex justify-content-between align-items-center">
            <span>قائمة الحسابات</span>
            <i class="bi bi-arrow-left-circle"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="card kody-stat-card kody-grad-amber h-100">
        <div class="card-body d-flex justify-content-between align-items-center gap-2">
          <div>
            <span class="badge bg-dark bg-opacity-10 text-dark rounded-pill mb-2">+22% تفاعل</span>
            <h3 class="fs-2 fw-black mb-1">{{ number_format($badgesCount ?? 1290) }}</h3>
            <p class="mb-0 fw-bold opacity-90 small">الأوسمة الممنوحة</p>
          </div>
          <div class="kody-stat-icon-box">
            <i class="bi bi-award-fill fs-3"></i>
          </div>
        </div>
        <div class="card-footer bg-black bg-opacity-10 border-0 py-2">
          <a href="#" class="text-dark text-decoration-none fs-7 fw-bold d-flex justify-content-between align-items-center">
            <span>سجل التلعيب</span>
            <i class="bi bi-arrow-left-circle"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--end::Stat Boxes Row-->

  <!--begin::Main Charts & Tables Row-->
  <div class="row g-3 mb-4">
    <div class="col-lg-7">
      <div class="card kody-card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title fw-bold mb-0">
            <i class="bi bi-graph-up-arrow text-primary me-1"></i>
            نشاط التعلم خلال الأسبوع
          </h3>
          <span class="badge text-bg-primary rounded-pill">آخر 7 أيام</span>
        </div>
        <div class="card-body">
          {{-- ارتفاع ثابت ضروري: الرسم البياني مضبوط على maintainAspectRatio: false --}}
          <div style="height: 320px;">
            <canvas id="revenue-chart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="card kody-card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title fw-bold mb-0">
            <i class="bi bi-person-check-fill text-success me-1"></i>
            أحدث التسجيلات
          </h3>
          <a href="#" class="btn btn-sm btn-outline-primary rounded-3 fw-bold">عرض الكل</a>
        </div>
        <div class="card-body p-0">
          {{-- بيانات تجريبية: استبدلها لاحقاً بحلقة @foreach على بيانات قاعدة البيانات --}}
          <table class="table table-hover kody-table mb-0">
            <thead>
              <tr>
                <th>الطفل</th>
                <th>المسار</th>
                <th>الحالة</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <span class="fw-bold">🦊 بطل الكود</span>
                  <small class="d-block text-muted">المستوى 1</small>
                </td>
                <td><span class="badge text-bg-info rounded-pill">البراعم (7-9)</span></td>
                <td><span class="badge text-bg-success rounded-pill">نشط</span></td>
              </tr>
              <tr>
                <td>
                  <span class="fw-bold">🚀 نجمة بايثون</span>
                  <small class="d-block text-muted">المستوى 2</small>
                </td>
                <td><span class="badge text-bg-success rounded-pill">بايثون (10-12)</span></td>
                <td><span class="badge text-bg-success rounded-pill">نشط</span></td>
              </tr>
              <tr>
                <td>
                  <span class="fw-bold">🐍 صائد الأكواد</span>
                  <small class="d-block text-muted">المستوى 1</small>
                </td>
                <td><span class="badge text-bg-success rounded-pill">بايثون (10-12)</span></td>
                <td><span class="badge text-bg-warning rounded-pill">جديد</span></td>
              </tr>
              <tr>
                <td>
                  <span class="fw-bold">⭐ عبقري الجافا</span>
                  <small class="d-block text-muted">المستوى 3</small>
                </td>
                <td><span class="badge text-bg-primary rounded-pill">المحترفين (13-15)</span></td>
                <td><span class="badge text-bg-success rounded-pill">نشط</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--end::Main Charts & Tables Row-->
@endsection

@section('script')
  <!-- Chart.js Demo Initialization -->
  <script>
    const chartCanvas = document.querySelector('#revenue-chart');
    if (chartCanvas && globalThis.lteChartTheme) {
      const { areaFill } = globalThis.lteChartTheme;
      new Chart(chartCanvas, {
        type: 'line',
        data: {
          labels: ['السبت', 'الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'],
          datasets: [
            {
              label: 'الدروس المكتملة',
              data: [42, 58, 65, 79, 94, 110, 128],
              borderColor: '#2563eb',
              backgroundColor: areaFill('#2563eb'),
              pointBackgroundColor: '#2563eb',
              fill: true,
              tension: 0.4,
            },
            {
              label: 'التحديات المحلولة',
              data: [35, 49, 60, 72, 88, 102, 118],
              borderColor: '#10b981',
              backgroundColor: areaFill('#10b981'),
              pointBackgroundColor: '#10b981',
              fill: true,
              tension: 0.4,
            },
          ],
        },
        options: {
          scales: {
            y: { beginAtZero: true },
          },
        },
      });
    }
  </script>
@endsection
