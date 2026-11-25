@extends('cms.dashboard')

@section('title', 'عرض المسارات')
@section('sub_title', 'عرض المسارات')
@section('main_title', 'عرض المسارات')

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

  .pathway-action-btns .btn,
  .pathway-action-btns form .btn {
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
<div class="row">
  <div class="col-md-12">

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <div class="fw-bold">{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
      </div>
    @endif

    <div class="card pathway-table-card mb-4">
      <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-signpost-split-fill text-primary fs-5"></i>
          <h3 class="card-title mb-0 fw-bold">جدول المسارات</h3>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
          <a href="{{ route('admin.pathways.trash') }}" class="btn btn-outline-secondary btn-sm rounded-3 fw-bold px-3 py-2 d-inline-flex align-items-center gap-1">
            <i class="bi bi-archive"></i>
            <span>صفحة الأرشيف</span>
          </a>

          <a href="{{ route('pathways.create') }}" class="btn btn-primary btn-sm rounded-3 fw-bold px-3 py-2 shadow-sm d-inline-flex align-items-center gap-1">
            <i class="bi bi-plus-lg"></i>
            <span>اضافة مسار جديد</span>
          </a>
        </div>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0 pathway-table">
            <thead class="table-light">
              <tr>
                <th style="width: 70px">الرقم التسلسلي</th>
                <th>الاعمار</th>
                <th>العنوان</th>
                <th>المعرف</th>
                <th style="width: 230px" class="text-center">الاجراءات</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($pathways as $pathway)
                <tr class="align-middle">
                  <td class="fw-bold text-secondary">#{{ $pathway->id }}</td>
                  <td>
                    <span class="pathway-age-badge">
                      <i class="bi bi-people-fill"></i>
                      <span>{{ $pathway->age_group }}</span>
                    </span>
                  </td>
                  <td class="fw-bold">{{ $pathway->title }}</td>
                  <td>
                    <span class="pathway-slug-badge" dir="ltr">
                      {{ $pathway->slug }}
                    </span>
                  </td>
                  <td class="text-center">
                    <div class="d-inline-flex align-items-center justify-content-center gap-1.5 pathway-action-btns" role="group" aria-label="إجراءات المسار">
                      <button type="button" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-square"></i>
                        <span>تعديل</span>
                      </button>

                      <form action="{{ route('admin.pathways.destroy', $pathway) }}" method="POST" class="d-inline-block m-0" onsubmit="return confirm('نقل المسار إلى الأرشيف؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                          <i class="bi bi-trash3"></i>
                          <span>حذف</span>
                        </button>
                      </form>

                    <a href="{{ route('pathways.show', $pathway) }}"
                          class="btn btn-outline-success"
                          title="عرض تفاصيل المسار">
                          <i class="bi bi-eye"></i>
                                 <span>عرض</span>
                                </a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-5 text-muted fw-bold">
                    <i class="bi bi-inbox fs-3 d-block mb-2 opacity-50"></i>
                    لا توجد مسارات مضافة حالياً.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @if (method_exists($pathways, 'hasPages') && $pathways->hasPages())
        <div class="card-footer bg-transparent border-top d-flex flex-wrap justify-content-between align-items-center gap-2 px-4 py-3">
          <span class="text-muted small fw-semibold">
            عرض {{ $pathways->firstItem() }} إلى {{ $pathways->lastItem() }} من أصل {{ $pathways->total() }} مسار
          </span>
          <div class="mb-0">
            {{ $pathways->links() }}
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection

@section('script')
@endsection