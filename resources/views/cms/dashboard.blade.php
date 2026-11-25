<!doctype html>
<html lang="ar" dir="rtl">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>كودي | لوحة التحكم @yield('title')</title>

    <!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
    <script>
      (() => {
        'use strict';
        const root = document.documentElement;

        if (root.getAttribute('data-lte-color-mode') === 'off') {
          return;
        }

        const STORAGE_KEY = 'lte-theme';
        let stored = null;
        try {
          stored = localStorage.getItem(STORAGE_KEY);
        } catch {
          // localStorage may be unavailable
        }
        const authored = root.getAttribute('data-bs-theme');
        let resolved = 'light';
        if (stored === 'dark' || stored === 'light') {
          resolved = stored;
        } else if (authored === 'dark' || authored === 'light') {
          resolved = authored;
        } else if (globalThis.matchMedia('(prefers-color-scheme: dark)').matches) {
          resolved = 'dark';
        }
        root.setAttribute('data-bs-theme', resolved);
        root.style.colorScheme = resolved;
        if (resolved !== authored) {
          root.setAttribute('data-lte-theme-resolved', '');
        }
      })();
    </script>
    <!--end::Theme Init-->

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#2563eb" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#0f172a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="كودي | لوحة تحكم منصة تعليم البرمجة للأطفال" />
    <meta name="author" content="كودي - Kody" />
    <meta
      name="description"
      content="لوحة تحكم الإدارة لمنصة كودي لتعليم البرمجة للأطفال - إدارة المسارات، الدورات، أولياء الأمور، والأوسمة."
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('cms/css/adminlte.rtl.css') }}" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts (Tajawal Arabic Font)-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap"
      rel="stylesheet"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.16.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE RTL)-->
    <link rel="stylesheet" href="{{ asset('cms/css/adminlte.rtl.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->

    <style>
      :root {
        --bs-body-font-family: 'Tajawal', system-ui, -apple-system, sans-serif;
        --kody-blue: #2563eb;
        --kody-indigo: #4f46e5;
        --kody-mint: #10b981;
        --kody-amber: #f59e0b;
        --kody-shadow: 0 8px 24px -6px rgba(15, 23, 42, 0.06), 0 2px 8px -2px rgba(15, 23, 42, 0.04);
      }

      [data-bs-theme='dark'] {
        --kody-shadow: 0 12px 28px -8px rgba(0, 0, 0, 0.45);
      }

      body {
        font-family: 'Tajawal', sans-serif !important;
        letter-spacing: -0.01em;
      }

      /* شريط علوي عصري متناسق */
      .app-header.navbar {
        backdrop-filter: blur(12px);
        background-color: rgba(var(--bs-body-bg-rgb), 0.9) !important;
        border-bottom: 1px solid rgba(148, 163, 184, 0.16) !important;
      }

      /* شعار كودي في القائمة الجانبية */
      .kody-brand-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.9rem 1rem;
        text-decoration: none;
        transition: transform 0.25s ease;
      }

      .kody-brand-link:hover {
        transform: translateX(-2px);
      }

      .kody-logo-badge {
        width: 42px;
        height: 42px;
        border-radius: 13px;
        background: linear-gradient(135deg, #2563eb 0%, #10b981 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        box-shadow: 0 8px 18px rgba(16, 185, 129, 0.32);
        flex-shrink: 0;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      .kody-brand-link:hover .kody-logo-badge {
        transform: rotate(-7deg) scale(1.06);
      }

      .kody-brand-title {
        font-size: 1.48rem;
        font-weight: 900;
        background: linear-gradient(90deg, #60a5fa 0%, #34d399 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.1;
      }

      .kody-brand-subtitle {
        font-size: 0.72rem;
        font-weight: 700;
        color: #94a3b8;
        display: block;
        margin-top: 2px;
      }

      /* القائمة الجانبية */
      .app-sidebar {
        background: linear-gradient(180deg, #0b1120 0%, #162033 55%, #0f172a 100%) !important;
      }

      .sidebar-menu .nav-header {
        font-size: 0.71rem;
        font-weight: 800;
        letter-spacing: 0.04em;
        color: #64748b !important;
        padding: 0.85rem 1.1rem 0.25rem;
      }

      .sidebar-menu .nav-link {
        border-radius: 0.75rem;
        margin: 0.16rem 0.6rem;
        padding: 0.56rem 0.85rem;
        font-weight: 600;
        color: #cbd5e1;
        transition: all 0.2s ease;
      }

      .sidebar-menu .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.07);
        color: #ffffff;
        transform: translateX(-2px);
      }

      .sidebar-menu .nav-link.active {
        background: linear-gradient(135deg, #2563eb 0%, #10b981 100%) !important;
        color: #ffffff !important;
        font-weight: 700;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.32);
      }

      .sidebar-menu .nav-treeview .nav-link {
        padding-top: 0.42rem;
        padding-bottom: 0.42rem;
        font-size: 0.89rem;
      }

      /* بطاقات الإحصائيات المتدرجة */
      .kody-stat-card {
        border: none;
        border-radius: 1.15rem;
        box-shadow: var(--kody-shadow);
        transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.25s ease;
        overflow: hidden;
        position: relative;
      }

      .kody-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 30px -8px rgba(15, 23, 42, 0.16);
      }

      .kody-stat-card.kody-grad-blue {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
      }

      .kody-stat-card.kody-grad-mint {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
      }

      .kody-stat-card.kody-grad-indigo {
        background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
        color: #fff;
      }

      .kody-stat-card.kody-grad-amber {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        color: #1e293b;
      }

      .kody-stat-icon-box {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }

      .kody-stat-card.kody-grad-amber .kody-stat-icon-box {
        background: rgba(15, 23, 42, 0.1);
      }

      /* البطاقات العامة والجداول */
      .kody-card {
        border: 1px solid rgba(148, 163, 184, 0.15);
        border-radius: 1.15rem;
        box-shadow: var(--kody-shadow);
      }

      .kody-card .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(148, 163, 184, 0.14);
        padding: 1rem 1.3rem;
      }

      .kody-table thead th {
        font-size: 0.82rem;
        font-weight: 800;
        padding: 0.85rem 1.15rem;
        border-bottom-width: 1px;
      }

      .kody-table tbody td {
        padding: 0.95rem 1.15rem;
      }

      .kody-table tbody tr:last-child td {
        border-bottom: none;
      }

      /* حقل البحث العلوي */
      .navbar-search-field {
        position: relative;
        width: 300px;
      }

      .navbar-search-field .form-control {
        border-radius: 0.85rem;
        padding-left: 2.5rem;
        border-color: rgba(148, 163, 184, 0.28);
      }

      .navbar-search-field .form-control:focus {
        border-color: var(--kody-blue);
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
      }

      .navbar-search-submit {
        position: absolute;
        left: 0.65rem;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #64748b;
        transition: color 0.2s ease;
      }

      .navbar-search-submit:hover {
        color: var(--kody-blue);
      }

      /* أدوات مساعدة غير موجودة في Bootstrap افتراضياً */
      .fw-black {
        font-weight: 900 !important;
      }

      .fs-7 {
        font-size: 0.875rem !important;
      }

      .fs-8 {
        font-size: 0.75rem !important;
      }
    </style>

    @yield('style')
  </head>
  <!--end::Head-->

  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand sticky-top">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav align-items-center gap-1">
            <li class="nav-item">
              <a
                class="nav-link rounded-3"
                data-lte-toggle="sidebar"
                href="#"
                role="button"
                aria-label="تبديل القائمة الجانبية"
              >
                <i class="bi bi-list fs-4"></i>
              </a>
            </li>

            <li class="nav-item d-none d-md-block">
              <a href="{{ route('cms/home') }}" class="nav-link fw-bold text-primary rounded-3 px-3">
                <i class="bi bi-globe2 me-1" aria-hidden="true"></i>
                معاينة المنصة
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="{{ route('cms/Paths') }}" class="nav-link fw-semibold rounded-3 px-3">
                <i class="bi bi-diagram-3 me-1" aria-hidden="true"></i>
                المسارات التعليمية
              </a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::Navbar Search-->
          <form class="navbar-search d-none d-xl-block ms-3" role="search" action="#">
            <label for="navbar-search-input" class="visually-hidden">بحث</label>
            <div class="navbar-search-field">
              <input
                type="search"
                id="navbar-search-input"
                name="q"
                class="form-control form-control-sm"
                placeholder="ابحث عن طالب، دورة، أو ولي أمر..."
                autocomplete="off"
              />
              <button class="navbar-search-submit" type="submit" aria-label="بحث">
                <i class="bi bi-search" aria-hidden="true"></i>
              </button>
            </div>
          </form>
          <!--end::Navbar Search-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto align-items-center gap-1">
            <!--begin::Login Page Link Button-->
            <li class="nav-item">
              <a
                class="nav-link rounded-3"
                href="{{ url('/login') }}"
                title="صفحة تسجيل الدخول"
                aria-label="صفحة تسجيل الدخول"
              >
                <i class="bi bi-box-arrow-in-left fs-5 text-primary"></i>
              </a>
            </li>
            <!--end::Login Page Link Button-->

            <!--begin::Platform Settings Button-->
            <li class="nav-item">
              <a
                class="nav-link rounded-3"
                href="#platform-settings"
                title="إعدادات المنصة"
                aria-label="إعدادات المنصة"
              >
                <i class="bi bi-gear-fill fs-5 text-secondary"></i>
              </a>
            </li>
            <!--end::Platform Settings Button-->

            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a
                class="nav-link position-relative rounded-3"
                data-bs-toggle="dropdown"
                href="#"
                aria-label="الإشعارات"
              >
                <i class="bi bi-bell-fill fs-5"></i>
                <span class="navbar-badge badge rounded-pill text-bg-success">5</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow border-0 rounded-4">
                <span class="dropdown-item dropdown-header fw-bold d-flex justify-content-between align-items-center">
                  <span>5 إشعارات جديدة</span>
                  <span class="badge text-bg-primary rounded-pill">اليوم</span>
                </span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item py-2">
                  <i class="bi bi-person-plus-fill text-primary me-2"></i> تسجيل ولي أمر جديد
                  <span class="float-end text-secondary fs-7">منذ 5 دقائق</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item py-2">
                  <i class="bi bi-journal-check text-success me-2"></i> دورة جديدة بانتظار الاعتماد
                  <span class="float-end text-secondary fs-7">منذ ساعة</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item py-2">
                  <i class="bi bi-award-fill text-warning me-2"></i> طفل اجتاز اختبار المستوى
                  <span class="float-end text-secondary fs-7">منذ 3 ساعات</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer fw-bold text-primary">
                  عرض جميع الإشعارات
                </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a
                class="nav-link rounded-3"
                href="#"
                data-lte-toggle="fullscreen"
                aria-label="ملء الشاشة"
              >
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::Color Mode Toggle-->
            <li class="nav-item dropdown">
              <a
                class="nav-link rounded-3"
                href="#"
                id="bd-theme"
                aria-label="تبديل المظهر"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
              </a>
              <ul
                class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3"
                aria-labelledby="bd-theme"
                style="--bs-dropdown-min-width: 9.5rem"
              >
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="light"
                    aria-pressed="false"
                  >
                    <i class="bi bi-sun-fill me-2 text-warning"></i>
                    وضع نهاري
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="dark"
                    aria-pressed="false"
                  >
                    <i class="bi bi-moon-fill me-2 text-primary"></i>
                    وضع ليلي
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center active"
                    data-bs-theme-value="auto"
                    aria-pressed="true"
                  >
                    <i class="bi bi-circle-half me-2"></i>
                    تلقائي
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
              </ul>
            </li>
            <!--end::Color Mode Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2 rounded-3" data-bs-toggle="dropdown">
                <div
                  class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold shadow-sm"
                  style="width: 34px; height: 34px; background: linear-gradient(135deg, #2563eb 0%, #10b981 100%)"
                >
                  {{ mb_substr(auth()->user()->name ?? 'م', 0, 1) }}
                </div>
                <span class="d-none d-xl-inline fw-bold">{{ auth()->user()->name ?? 'مدير النظام' }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow border-0 rounded-4 overflow-hidden">
                <!--begin::User Image-->
                <li class="user-header text-white py-4" style="background: linear-gradient(135deg, #2563eb 0%, #10b981 100%)">
                  <div
                    class="rounded-circle bg-white text-primary d-inline-flex align-items-center justify-content-center fw-black fs-3 shadow mb-2"
                    style="width: 64px; height: 64px"
                  >
                    <i class="bi bi-shield-lock-fill"></i>
                  </div>
                  <p class="fw-bold mb-0">
                    {{ auth()->user()->name ?? 'مدير منصة كودي' }}
                    <small class="d-block opacity-90">إدارة المحتوى والمسارات التعليمية</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Footer-->
                <li class="user-footer d-flex justify-content-between p-3 bg-body-tertiary">
                  {{-- ضع رابط صفحة الملف الشخصي هنا عند توفرها --}}
                  <a href="#" class="btn btn-sm btn-outline-primary rounded-3 fw-bold">الملف الشخصي</a>
                  <form action="{{ url('/logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 fw-bold">تسجيل الخروج</button>
                  </form>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->

      <!--begin::Sidebar-->
      <aside class="app-sidebar shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand (شعار كودي المحسّن)-->
        <div class="sidebar-brand border-bottom border-secondary border-opacity-25">
          <a href="{{ url('/admin') }}" class="kody-brand-link">
            <div class="kody-logo-badge" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="16 18 22 12 16 6"></polyline>
                <polyline points="8 6 2 12 8 18"></polyline>
                <line x1="14" y1="4" x2="10" y2="20"></line>
              </svg>
            </div>
            <div class="brand-text">
              <span class="kody-brand-title">كودي</span>
              <span class="kody-brand-subtitle">نبرمج المستقبل بمرح</span>
            </div>
          </a>
        </div>
        <!--end::Sidebar Brand-->

        <!--begin::Sidebar Search-->
        <div class="sidebar-search px-3 pt-3" role="search">
          <label for="sidebar-search-input" class="visually-hidden">تصفية القائمة</label>
          <input
            type="search"
            id="sidebar-search-input"
            class="form-control form-control-sm rounded-3 bg-dark border-secondary border-opacity-50 text-white"
            placeholder="بحث سريع في القائمة..."
            autocomplete="off"
            data-lte-toggle="sidebar-search"
            data-lte-target="#navigation"
          />
          <p class="fs-7 text-secondary mt-2 mb-0" data-lte-search-empty role="status" hidden>
            لا توجد صفحات مطابقة.
          </p>
        </div>
        <!--end::Sidebar Search-->

        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2" aria-label="القائمة الرئيسية">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              data-accordion="false"
              id="navigation"
            >
              <!-- الرئيسية -->
              <li class="nav-item">
                <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-grid-1x2-fill"></i>
                  <p>لوحة التحكم الرئيسية</p>
                </a>
              </li>

              <li class="nav-header text-uppercase">إدارة المحتوى التعليمي</li>

              <!-- جدول pathways -->
              <li class="nav-item {{ request()->routeIs('admin.pathways.*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->routeIs('admin.pathways.*') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-signpost-split-fill text-info"></i>
                  <p>
                    المسارات والتصنيفات
                    <span class="nav-badge badge rounded-pill text-bg-info me-3">3</span>
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('pathways.index') }}" class="nav-link {{ request()->routeIs('pathways.*') ? 'active' : '' }}">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>قائمة المسارات</p>
                    </a>
                  </li>
                  {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>مسار البراعم (7 - 9 سنوات)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>مسار بايثون (10 - 12 سنة)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>مسار المحترفين (13 - 15 سنة)</p>
                    </a>
                  </li> --}}
                </ul>
              </li>

              <!-- جدول courses -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-journal-bookmark-fill text-primary"></i>
                  <p>
                    الدورات
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>قائمة الدورات</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>بانتظار الاعتماد</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>الدورات المنشورة</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>الدورات المرفوضة</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- جدول lessons -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-journal-code text-success"></i>
                  <p>
                    الدروس
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>قائمة الدروس</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>إضافة درس جديد</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- جدول quizzes -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-patch-question-fill text-warning"></i>
                  <p>
                    الاختبارات والتحديات
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>قائمة الاختبارات</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>اختيار من متعدد (MCQ)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>سحب وإفلات (Drag & Drop)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>ترتيب الخطوات (Reorder)</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-header text-uppercase">المستخدمون والتحفيز</li>

              <!-- جدول users -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-people-fill text-primary"></i>
                  <p>
                    المستخدمون
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>المديرون</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>المعلمون</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>أولياء الأمور</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- جدول kid_profiles -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-emoji-smile-fill text-success"></i>
                  <p>ملفات الأطفال</p>
                </a>
              </li>

              <!-- جدول kid_lesson_progress -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-stars text-info"></i>
                  <p>تقدم التعلم والنجوم</p>
                </a>
              </li>

              <!-- جدولا badges و kid_badges -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-trophy-fill text-warning"></i>
                  <p>
                    الأوسمة ونظام التلعيب
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>قائمة الأوسمة</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>الأوسمة الممنوحة للأطفال</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-header text-uppercase">النظام</li>

              <!-- إعدادات المنصة -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-gear-fill text-secondary"></i>
                  <p>
                    إعدادات المنصة
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>الإعدادات العامة والهوية</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>قواعد التلعيب والنقاط (XP)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle-fill fs-8"></i>
                      <p>الأمان والخصوصية</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- التقارير -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-bar-chart-line-fill text-info"></i>
                  <p>التقارير والإحصائيات</p>
                </a>
              </li>

              <!-- تسجيل الدخول -->
              <li class="nav-item">
                <a href="{{ url('/login') }}" class="nav-link">
                  <i class="nav-icon bi bi-box-arrow-in-left text-primary"></i>
                  <p>صفحة تسجيل الدخول</p>
                </a>
              </li>
            </ul>
<!--end::Sidebar Menu-->

            <!-- Docs CTA (bottom of sidebar) -->
            <div class="p-3 mt-4 border-top border-secondary border-opacity-25">
              <a
                href="#"
                class="btn btn-sm btn-outline-info w-100 d-flex align-items-center justify-content-center gap-2 rounded-3 fw-bold py-2"
              >
                <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
                وثيقة تحليل النظام (SRS)
              </a>
            </div>
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header py-3">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row align-items-center g-2">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3 fw-black">@yield('sub_title', 'نظرة عامة على المنصة')</h1>
              </div>
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-end gap-3">
                <div class="d-none d-md-flex gap-2">
                  <a href="#" class="btn btn-primary btn-sm rounded-3 fw-bold px-3 shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i> درس جديد
                  </a>
                  <a href="#" class="btn btn-outline-success btn-sm rounded-3 fw-bold px-3">
                    <i class="bi bi-award me-1"></i> الأوسمة
                  </a>
                </div>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none fw-semibold">كودي</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('main_title' , 'لوحة التحكم')</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            @yield('contact')

          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline text-muted small">{{ env('APP_VERSION', 'v1.0') }}</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          جميع الحقوق محفوظة &copy; {{ now()->year }}&nbsp;
          <a href="{{ route('cms/home') }}" class="text-decoration-none text-primary fw-bold">منصة كودي لتعليم البرمجة للأطفال</a>.
        </strong>
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.16.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('cms/js/adminlte.js') }}"></script>

    <!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        const isMobile = window.innerWidth <= 992;

        if (
          sidebarWrapper &&
          globalThis.OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
          !isMobile
        ) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->

    <!--begin::Third Party Plugin(Chart.js)-->
    <script
      src="https://cdn.jsdelivr.net/npm/chart.js@4.5.1/dist/chart.umd.min.js"
      integrity="sha256-SERKgtTty1vsDxll+qzd4Y2cF9swY9BCq62i9wXJ9Uo="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(Chart.js)-->

    <!--begin::Chart.js theme preset-->
    <script>
      (() => {
        'use strict';
        const { Chart } = globalThis;
        if (!Chart) {
          return;
        }

        const root = document.documentElement;
        const cssVar = (name, fallback = '') =>
          getComputedStyle(root).getPropertyValue(name).trim() || fallback;

        const alpha = (color, opacity) => {
          let hex = String(color).trim().replace(/^#/, '');
          if (!/^[\da-f]{3}([\da-f]{3})?$/i.test(hex)) {
            return color;
          }
          if (hex.length === 3) {
            hex = [...hex].map((c) => c + c).join('');
          }
          const [r, g, b] = [0, 2, 4].map((i) => Number.parseInt(hex.slice(i, i + 2), 16));
          return `rgba(${r}, ${g}, ${b}, ${opacity})`;
        };

        const areaFill =
          (color, from = 0.35, to = 0) =>
          (context) => {
            const { ctx, chartArea } = context.chart;
            if (!chartArea) {
              return alpha(color, from);
            }
            const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
            gradient.addColorStop(0, alpha(color, from));
            gradient.addColorStop(1, alpha(color, to));
            return gradient;
          };

        let applied = [];

        const apply = () => {
          const text = cssVar('--bs-secondary-color', '#6c757d');
          const body = cssVar('--bs-body-color', '#212529');
          const surface = cssVar('--bs-body-bg', '#fff');
          const grid = `rgba(${cssVar('--bs-emphasis-color-rgb', '0, 0, 0')}, 0.08)`;
          const rtl = root.getAttribute('dir') === 'rtl';
          const d = Chart.defaults;
          applied = [text, grid];

          d.font.family = "'Tajawal', sans-serif";
          d.font.size = 13;
          d.color = text;
          d.borderColor = grid;
          d.maintainAspectRatio = false;

          d.scale.grid.color = grid;
          d.scale.border.color = grid;
          d.scale.ticks.padding = 8;
          d.set('scales.linear', { border: { display: false } });
          d.set('scales.category', { grid: { display: false } });

          d.elements.line.borderWidth = 2.5;
          d.elements.point.radius = 3;
          d.elements.point.hoverRadius = 6;
          d.elements.point.borderColor = surface;
          d.elements.bar.borderRadius = 6;

          const { legend, tooltip } = d.plugins;
          legend.position = 'bottom';
          legend.rtl = rtl;
          Object.assign(legend.labels, {
            color: body,
            usePointStyle: true,
            pointStyle: 'circle',
            boxWidth: 8,
            boxHeight: 8,
            padding: 16,
          });

          Object.assign(tooltip, {
            rtl,
            backgroundColor: surface,
            borderColor: cssVar('--bs-border-color', '#dee2e6'),
            borderWidth: 1,
            titleColor: cssVar('--bs-emphasis-color', '#000'),
            bodyColor: body,
            titleFont: { weight: '700' },
            padding: 10,
            cornerRadius: 8,
            usePointStyle: true,
          });
        };

        const forgetThemeColors = (options, stale) => {
          for (const [key, value] of Object.entries(options)) {
            if (value && typeof value === 'object' && !Array.isArray(value)) {
              forgetThemeColors(value, stale);
            } else if (/color$/i.test(key) && stale.includes(value)) {
              delete options[key];
            }
          }
        };

        const refresh = () => {
          const stale = applied;
          apply();
          for (const chart of Object.values(Chart.instances)) {
            forgetThemeColors(chart.config.options.scales || {}, stale);
            chart.update('none');
          }
        };

        apply();
        new MutationObserver(refresh).observe(root, {
          attributes: true,
          attributeFilter: ['data-bs-theme', 'dir'],
        });
        document.fonts?.addEventListener('loadingdone', refresh);

        globalThis.lteChartTheme = { cssVar, alpha, areaFill, refresh };
      })();
    </script>
    <!--end::Chart.js theme preset-->

    <!--end::Script-->

    @yield('script')
  </body>
  <!--end::Body-->
</html>
