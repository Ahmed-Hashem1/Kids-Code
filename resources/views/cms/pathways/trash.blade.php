@extends('cms.dashboard')

@section('title', 'عرض صفحة الارشيف')
@section('sub_title', 'عرض صفحة الارشيف')
@section('main_title', 'عرض صفحة الارشيف')

@section('style')
<style>
  .pathway-table-card {
    border: 1px solid rgba(148, 163, 184, 0.16);
    border-radius: 1.15rem;
    box-shadow: 0 10px 26px -6px rgba(15, 23, 42, 0.06);
    overflow: hidden;
  }

  .pathway-table-card .card-header {
    background-color: transparent;
    border-bottom: 1px solid rgba(148, 163, 184, 0.15);
    padding: 1rem 1.35rem;
  }

  .pathway-table thead th {
    font-size: 0.83rem;
    font-weight: 800;
    padding: 0.9rem 1.1rem;
    white-space: nowrap;
  }

  .pathway-table tbody td {
    padding: 0.95rem 1.1rem;
  }

  /* تباين واضح للأعمار في النهار والليل */
  .pathway-age-badge {
    background-color: #e0f2fe;
    color: #0369a1;
    border: 1px solid #bae6fd;
    font-size: 0.8rem;
    font-weight: 700;
    padding: 0.38rem 0.75rem;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
  }

  [data-bs-theme='dark'] .pathway-age-badge {
    background-color: rgba(14, 165, 233, 0.18);
    color: #7dd3fc;
    border-color: rgba(125, 211, 252, 0.28);
  }

  /* تباين واضح للمعرف (slug) في النهار والليل */
  .pathway-slug-badge {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 0.8rem;
    font-weight: 700;
    padding: 0.35rem 0.7rem;
    border-radius: 0.55rem;
    background-color: #f1f5f9;
    color: #0f172a;
    border: 1px solid #cbd5e1;
    display: inline-block;
  }

  [data-bs-theme='dark'] .pathway-slug-badge {
    background-color: #1e293b;
    color: #e2e8f0;
    border-color: #475569;
  }

  .pathway-action-btns .btn {
    border-radius: 0.65rem !important;
    font-weight: 700;
    font-size: 0.8rem;
    padding: 0.35rem 0.7rem;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
  }
</style>
@endsection

@section('contact')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
      <i class="bi bi-check-circle-fill me-1"></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
  @endif

  <div class="card kody-card">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
      <h3 class="card-title fw-bold mb-0">
        <i class="bi bi-archive-fill text-warning me-1"></i>
        المسارات المحذوفة مؤقتًا
      </h3>
      <a href="{{ route('pathways.index') }}" class="btn btn-sm btn-outline-secondary rounded-3 fw-bold">
        <i class="bi bi-arrow-right me-1"></i> رجوع لقائمة المسارات
      </a>
    </div>

    <div class="card-body p-0">
      <table class="table table-hover kody-table mb-0">
        <thead>
          <tr>
            <th style="width: 48px;">#</th>
            <th>المسار</th>
            <th>الفئة العمرية</th>
            <th>الوصف</th>
            <th>تاريخ الحذف</th>
            <th class="text-end">إجراءات</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pathways as $pathway)
            <tr>
              <td class="text-muted">{{ $pathway->id }}</td>
              <td>
                <span class="d-inline-flex align-items-center gap-2">
                  <span class="d-inline-flex align-items-center justify-content-center rounded-3 text-white" style="width: 34px; height: 34px; background: {{ $pathway->color ?? '#2563eb' }};">
                    <i class="bi {{ $pathway->icon ?? 'bi-signpost-split-fill' }}"></i>
                  </span>
                  <span class="fw-bold">{{ $pathway->name }}</span>
                </span>
                @if ($pathway->slug)
                  <small class="d-block text-muted" dir="ltr">{{ $pathway->slug }}</small>
                @endif
              </td>
              <td><span class="badge text-bg-info rounded-pill">{{ $pathway->age_group }} سنوات</span></td>
              <td class="text-muted">{{ $pathway->description ?: '-' }}</td>
              <td class="text-muted">{{ $pathway->deleted_at }}</td>
              <td>
                <div class="d-flex gap-1 justify-content-end">
                  <form action="{{ route('admin.pathways.restore', $pathway->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-success rounded-3" title="استعادة">
                      <i class="bi bi-arrow-counterclockwise"></i> استعادة
                    </button>
                  </form>

                  <form action="{{ route('admin.pathways.forceDelete', $pathway->id) }}" method="POST" class="d-inline" onsubmit="return confirm('حذف نهائي؟ لن يمكن استرجاعه.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="حذف نهائي">
                      <i class="bi bi-trash"></i> حذف نهائي
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted py-4">لا توجد مسارات محذوفة مؤقتًا</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($pathways->hasPages())
      <div class="card-footer d-flex justify-content-center">
        {{ $pathways->links('pagination::bootstrap-5') }}
      </div>
    @endif
  </div>
@endsection

@section('script')
@endsection
