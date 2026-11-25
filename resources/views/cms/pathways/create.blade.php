@extends('cms.dashboard')

@section('title', 'إضافة مسار جديد')
@section('sub_title', 'إضافة مسار جديد')
@section('main_title', 'إضافة مسار جديد')

@section('style')
<style>
  .pathway-form-card {
    border: 1px solid rgba(148, 163, 184, 0.16);
    border-radius: 1.15rem;
    box-shadow: 0 10px 26px -6px rgba(15, 23, 42, 0.06);
    overflow: hidden;
  }

  .pathway-form-card .card-header {
    background-color: transparent;
    border-bottom: 1px solid rgba(148, 163, 184, 0.15);
    padding: 1rem 1.35rem;
  }

  .pathway-form-card .form-label {
    font-weight: 700;
    font-size: 0.88rem;
  }

  .pathway-form-card .form-control,
  .pathway-form-card .form-select {
    border-radius: 0.7rem;
    padding: 0.62rem 0.85rem;
  }
</style>
@endsection

@section('contact')
<div class="row justify-content-center">
  <div class="col-lg-8 col-md-12">

    @if (session('success'))
      <div id="created-alert" class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm d-flex align-items-center justify-content-between gap-2 mb-3" role="alert">
        <div class="d-flex align-items-center gap-2 fw-bold">
          <i class="bi bi-check-circle-fill fs-5"></i>
          <span>{{ session('success') !== true ? session('success') : 'تم الإنشاء بنجاح، جاري نقلك إلى قائمة المسارات...' }}</span>
        </div>
        <a href="{{ route('apathways.index') }}" class="btn btn-sm btn-success fw-bold d-inline-flex align-items-center gap-1">
          <i class="bi bi-arrow-right-circle"></i>
          <span>الانتقال الآن</span>
        </a>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger rounded-3 shadow-sm mb-3" role="alert">
        <div class="fw-bold mb-1">
          <i class="bi bi-exclamation-triangle-fill me-1"></i>
          يرجى التحقق من البيانات المدخلة:
        </div>
        <ul class="mb-0 small">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card pathway-form-card mb-4">
      <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-plus-circle-fill text-primary fs-5"></i>
          <h3 class="card-title mb-0 fw-bold">إنشاء مسار تعليمي جديد</h3>
        </div>

        {{-- أيقونة ورابط الرجوع إلى صفحة index --}}
        <a href="{{ route('pathways.index') }}" class="btn btn-outline-secondary btn-sm rounded-3 fw-bold px-3 py-2 d-inline-flex align-items-center gap-1" title="الرجوع إلى جدول المسارات">
          <i class="bi bi-arrow-right-short fs-5 lh-1"></i>
          <i class="bi bi-list-ul"></i>
          <span>العودة إلى المسارات</span>
        </a>
      </div>

      <form action="{{ route('pathways.store') }}" method="POST">
        @csrf
        <div class="card-body p-4">
          <div class="row g-3">

            <!-- الأعمار (age_group) -->
            <div class="col-md-6">
      <label for="age_group" class="form-label">
    <i class="bi bi-people-fill text-info me-1"></i>
    الأعمار <span class="text-danger">*</span>
      </label>
      <select
        name="age_group"
        id="age_group"
        class="form-select @error('age_group') is-invalid @enderror"
        required
      >
    <option value="" disabled {{ old('age_group') ? '' : 'selected' }}>اختر الفئة العمرية</option>
    <option value="7-9" {{ old('age_group') == '7-9' ? 'selected' : '' }}>7-9 سنوات</option>
    <option value="10-12" {{ old('age_group') == '10-12' ? 'selected' : '' }}>10-12 سنة</option>
    <option value="13-15" {{ old('age_group') == '13-15' ? 'selected' : '' }}>13-15 سنة</option>
      </select>
      @error('age_group')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
            </div>

            <!-- المعرف (slug) -->
            <div class="col-md-6">
              <label for="slug" class="form-label">
                <i class="bi bi-link-45deg text-secondary me-1"></i>
                المعرف (Slug) <span class="text-danger">*</span>
              </label>
              <input
                type="text"
                name="slug"
                id="slug"
                dir="ltr"
                value="{{ old('slug') }}"
                class="form-control @error('slug') is-invalid @enderror"
                placeholder="مثال: visual-programming-7-9"
                required
              />
              @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- العنوان (title) -->
            <div class="col-12">
              <label for="title" class="form-label">
                <i class="bi bi-type text-primary me-1"></i>
                العنوان <span class="text-danger">*</span>
              </label>
              <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title') }}"
                class="form-control @error('title') is-invalid @enderror"
                placeholder="أدخل عنوان المسار التعليمي"
                required
              />
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

          </div>
        </div>

        <div class="card-footer bg-transparent border-top d-flex flex-wrap justify-content-between align-items-center gap-2 px-4 py-3">
          <a href="{{ route('pathways.index') }}" class="btn btn-light border rounded-3 fw-bold px-3 py-2 d-inline-flex align-items-center gap-1">
            <i class="bi bi-arrow-right"></i>
            <span>رجوع</span>
          </a>

          <button type="submit" class="btn btn-primary rounded-3 fw-bold px-4 py-2 shadow-sm d-inline-flex align-items-center gap-1">
            <i class="bi bi-check-lg"></i>
            <span>حفظ المسار</span>
          </button>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // تحويل تلقائي إلى صفحة index إذا تم عرض رسالة نجاح داخل هذه الصفحة
    @if (session('success'))
      setTimeout(function () {
        window.location.href = "{{ route('pathways.index') }}";
      }, 1200);
    @endif
  });
</script>
@endsection
