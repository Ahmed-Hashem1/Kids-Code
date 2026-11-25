@extends('cms.dashboard')

@section('title', 'تفاصيل المسار')
@section('sub_title', 'تفاصيل المسار')
@section('main_title', 'تفاصيل المسار')

@section('style')
<style>
  .pathway-show-card {
    border: 1px solid rgba(148, 163, 184, 0.16);
    border-radius: 1.15rem;
    box-shadow: 0 10px 26px -6px rgba(15, 23, 42, 0.06);
    overflow: hidden;
  }

  .pathway-show-card .card-header {
    background-color: transparent;
    border-bottom: 1px solid rgba(148, 163, 184, 0.15);
    padding: 1rem 1.35rem;
  }

  .pathway-show-card .form-label {
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 0.45rem;
  }

  .pathway-readonly-box {
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
    border: 1px solid rgba(148, 163, 184, 0.28);
    background-color: rgba(248, 250, 252, 0.92);
    font-weight: 600;
    min-height: 46px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    word-break: break-word;
  }

  [data-bs-theme='dark'] .pathway-readonly-box {
    background-color: rgba(30, 41, 59, 0.65);
    border-color: rgba(148, 163, 184, 0.2);
  }
</style>
@endsection

@section('contact')
<div class="row justify-content-center">
  <div class="col-lg-8 col-md-12">

    <div class="card pathway-show-card mb-4">
      <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-eye-fill text-success fs-5"></i>
          <h3 class="card-title mb-0 fw-bold">عرض تفاصيل المسار التعليمي</h3>
        </div>

        {{-- أيقونة ورابط الرجوع إلى صفحة index --}}
        <a href="{{ route('pathways.index') }}"
           class="btn btn-outline-secondary btn-sm rounded-3 fw-bold px-3 py-2 d-inline-flex align-items-center gap-1"
           title="الرجوع إلى جدول المسارات">
          <i class="bi bi-arrow-right-short fs-5 lh-1"></i>
          <i class="bi bi-list-ul"></i>
          <span>العودة إلى المسارات</span>
        </a>
      </div>

      <div class="card-body p-4">
        <div class="row g-3">

          <!-- العنوان (title) -->
          <div class="col-12">
            <label class="form-label text-muted">
              <i class="bi bi-type text-primary me-1"></i>
              العنوان
            </label>
            <div class="pathway-readonly-box fw-bold fs-6">
              <span>{{ $pathway->title }}</span>
            </div>
          </div>

          <!-- الأعمار (age_group) -->
          <div class="col-12">
            <label class="form-label text-muted">
              <i class="bi bi-people-fill text-info me-1"></i>
              الأعمار
            </label>
            <div class="pathway-readonly-box">
              <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle fs-6 px-3 py-1">
                {{ $pathway->age_group }}
              </span>
            </div>
          </div>

          <!-- المعرف (slug) -->
          <div class="col-12">
            <label class="form-label text-muted">
              <i class="bi bi-link-45deg text-secondary me-1"></i>
              المعرف (Slug)
            </label>
            <div class="pathway-readonly-box font-monospace" dir="ltr">
              <span id="pathway-slug-text">{{ $pathway->slug }}</span>
              <button type="button"
                      id="copy-slug-btn"
                      class="btn btn-sm btn-outline-secondary rounded-2 py-1 px-2"
                      title="نسخ المعرف"
                      aria-label="نسخ المعرف">
                <i class="bi bi-clipboard"></i>
              </button>
            </div>
          </div>

          <!-- تاريخ الإنشاء -->
          @if (!empty($pathway->created_at))
            <div class="col-12">
              <label class="form-label text-muted">
                <i class="bi bi-calendar-plus text-success me-1"></i>
                تاريخ الإنشاء
              </label>
              <div class="pathway-readonly-box small font-monospace" dir="ltr">
                <span>{{ \Illuminate\Support\Carbon::parse($pathway->created_at)->format('Y-m-d H:i') }}</span>
              </div>
            </div>
          @endif

          <!-- آخر تحديث -->
          @if (!empty($pathway->updated_at))
            <div class="col-12">
              <label class="form-label text-muted">
                <i class="bi bi-calendar-check text-primary me-1"></i>
                آخر تحديث
              </label>
              <div class="pathway-readonly-box small font-monospace" dir="ltr">
                <span>{{ \Illuminate\Support\Carbon::parse($pathway->updated_at)->format('Y-m-d H:i') }}</span>
              </div>
            </div>
          @endif

        </div>
      </div>

      <div class="card-footer bg-transparent border-top d-flex flex-wrap justify-content-between align-items-center gap-2 px-4 py-3">
        <a href="{{ route('pathways.index') }}"
           class="btn btn-primary rounded-3 fw-bold px-3 py-2 d-inline-flex align-items-center gap-1">
          <i class="bi bi-arrow-right"></i>
          <span>رجوع إلى المسارات</span>
        </a>

        @if (\Illuminate\Support\Facades\Route::has('pathways.edit'))
          <a href="{{ route('pathways.edit', $pathway) }}"
             class="btn btn-outline-primary rounded-3 fw-bold px-3 py-2 d-inline-flex align-items-center gap-1">
            <i class="bi bi-pencil-square"></i>
            <span>تعديل المسار</span>
          </a>
        @endif
      </div>
    </div>

  </div>
</div>
@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const copyBtn = document.getElementById('copy-slug-btn');
    const slugText = document.getElementById('pathway-slug-text');

    if (copyBtn && slugText && navigator.clipboard) {
      copyBtn.addEventListener('click', function () {
        navigator.clipboard.writeText(slugText.textContent.trim()).then(function () {
          const icon = copyBtn.querySelector('i');
          if (icon) {
            icon.className = 'bi bi-check-lg text-success';
            setTimeout(function () {
              icon.className = 'bi bi-clipboard';
            }, 1500);
          }
        });
      });
    }
  });
</script>
@endsection