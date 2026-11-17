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
    <meta name="theme-color" content="#0d6efd" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
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

    <!--begin::Fonts (Tajawal Arabic Font + Source Sans 3)-->
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
    <!-- Fallback CDN for standalone preview without Laravel asset() -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.rtl.min.css"
      onerror="this.remove()"
    />
    <!--end::Required Plugin(AdminLTE)-->

    <style>
      :root {
        --bs-body-font-family: 'Tajawal', system-ui, -apple-system, sans-serif;
        --kody-blue: #2563eb;
        --kody-mint: #10b981;
      }

      body {
        font-family: 'Tajawal', sans-serif !important;
      }

      /* تحسين شعار كودي في القائمة الجانبية */
      .kody-brand-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 1rem;
        text-decoration: none;
        transition: all 0.25s ease;
      }

      .kody-brand-link:hover {
        transform: translateY(-1px);
      }

      .kody-logo-badge {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb 0%, #10b981 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
        flex-shrink: 0;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      .kody-brand-link:hover .kody-logo-badge {
        transform: rotate(-6deg) scale(1.06);
      }

      .kody-brand-title {
        font-size: 1.45rem;
        font-weight: 900;
        background: linear-gradient(90deg, #60a5fa 0%, #34d399 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.1;
        letter-spacing: -0.3px;
      }

      .kody-brand-subtitle {
        font-size: 0.72rem;
        font-weight: 700;
        color: #94a3b8;
        display: block;
        margin-top: 2px;
      }

      /* تحسين البطاقات والـ Sidebar */
      .app-sidebar {
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%) !important;
      }

      .sidebar-menu .nav-link {
        border-radius: 0.75rem;
        margin: 0.15rem 0.5rem;
        font-weight: 600;
        transition: all 0.2s ease;
      }

      .sidebar-menu .nav-link.active {
        background: linear-gradient(135deg, #2563eb 0%, #10b981 100%) !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
      }

      .kody-stat-card {
        border: none;
        border-radius: 1.1rem;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        overflow: hidden;
      }

      .kody-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(37, 99, 235, 0.12);
      }

      .kody-card {
        border: none;
        border-radius: 1.1rem;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.05);
      }

      .kody-card .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(148, 163, 184, 0.15);
        padding: 1rem 1.25rem;
        font-weight: 800;
      }

      .navbar-search-field {
        position: relative;
        width: 280px;
      }

      .navbar-search-field .form-control {
        border-radius: 0.85rem;
        padding-left: 2.5rem;
      }

      .navbar-search-submit {
        position: absolute;
        left: 0.65rem;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #64748b;
      }
    </style>
  </head>
  <!--end::Head-->

  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body border-bottom">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav align-items-center">
            <li class="nav-item">
              <a
                class="nav-link"
                data-lte-toggle="sidebar"
                href="#"
                role="button"
                aria-label="تبديل القائمة الجانبية"
              >
                <i class="bi bi-list fs-4"></i>
              </a>
            </li>

            <li class="nav-item d-none d-md-block">
              <a href="{{ route('parent') }}" class="nav-link fw-bold text-primary">
                <i class="bi bi-globe2 me-1" aria-hidden="true"></i>
                معاينة المنصة
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="#" class="nav-link fw-semibold">
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
                class="nav-link"
                href="{{route('login')}}"
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
                class="nav-link"
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
                class="nav-link position-relative"
                data-bs-toggle="dropdown"
                href="#"
                aria-label="الإشعارات"
              >
                <i class="bi bi-bell-fill fs-5"></i>
                <span class="navbar-badge badge rounded-pill text-bg-success">5</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow border-0 rounded-4">
                <span class="dropdown-item dropdown-header fw-bold">5 إشعارات جديدة</span>
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
                class="nav-link"
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
                class="nav-link"
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
                style="--bs-dropdown-min-width: 9rem"
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
              <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                <div
                  class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold shadow-sm"
                  style="width: 34px; height: 34px"
                >
                  م
                </div>
                <span class="d-none d-xl-inline fw-bold">مدير النظام</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow border-0 rounded-4 overflow-hidden">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary py-4">
                  <div
                    class="rounded-circle bg-white text-primary d-inline-flex align-items-center justify-content-center fw-black fs-3 shadow mb-2"
                    style="width: 64px; height: 64px"
                  >
                    <i class="bi bi-shield-lock-fill"></i>
                  </div>
                  <p class="fw-bold mb-0">
                    مدير منصة كودي
                    <small class="d-block opacity-75">إدارة المحتوى والمسارات التعليمية</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Footer-->
                <li class="user-footer d-flex justify-content-between p-3 bg-body-tertiary">
                  <a href="#" class="btn btn-sm btn-outline-primary rounded-3 fw-bold">الملف الشخصي</a>
                  <a href="#" class="btn btn-sm btn-outline-danger rounded-3 fw-bold">تسجيل الخروج</a>
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
        <!--begin::Sidebar Brand (شعار كودي المحسّن مع أيقونة برمجية)-->
        <div class="sidebar-brand border-bottom border-secondary border-opacity-25">
          <a href="{{ url('/admin') }}" class="kody-brand-link">
            <div class="kody-logo-badge" aria-hidden="true">
              <!-- أيقونة SVG مخصصة تجمع بين وسوم البرمجة </> والصاروخ التعليمي -->
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
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-grid-1x2-fill"></i>
                  <p>لوحة التحكم الرئيسية</p>
                </a>
              </li>

              <li class="nav-header text-uppercase fs-7 text-secondary mt-2">إدارة المحتوى التعليمي</li>

              <!-- المسارات والفئات العمرية -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-signpost-split-fill text-info"></i>
                  <p>
                    المسارات والفئات العمرية
                    <span class="nav-badge badge text-bg-info me-3">3</span>
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>مسار البراعم (7 - 9 سنوات)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>مسار بايثون (10 - 12 سنة)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>مسار المحترفين (13 - 15 سنة)</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- الدورات والدروس -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-journal-code text-success"></i>
                  <p>
                    الدروس والتحديات
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>قائمة الدروس (27 درساً)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>بنك التحديات الأربعة</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>إدارة نسخ النشر (Versions)</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- الاختبارات والتقييم -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-patch-check-fill text-warning"></i>
                  <p>
                    الاختبارات والتقييم
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>اختبار تحديد المستوى</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>اختبارات نهاية المستوى</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-header text-uppercase fs-7 text-secondary mt-2">المستخدمون والتحفيز</li>

              <!-- أولياء الأمور والطلاب -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-people-fill text-primary"></i>
                  <p>
                    أولياء الأمور والأطفال
                    <i class="nav-arrow bi bi-chevron-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>إدارة أولياء الأمور</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>ملفات الأطفال المسجلين</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- الأوسمة ونقاط الخبرة -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-trophy-fill text-warning"></i>
                  <p>
                    الأوسمة ونظام التلعيب
                  </p>
                </a>
              </li>

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
                      <i class="nav-icon bi bi-circle"></i>
                      <p>الإعدادات العامة والهوية</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>قواعد التلعيب والنقاط (XP)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
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
                class="btn btn-sm btn-outline-info w-100 d-flex align-items-center justify-content-center gap-2 rounded-3 fw-bold"
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
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row align-items-center">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3 fw-black">@yield('sub_title', 'نظرة عامة على المنصة')</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">كودي</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لوحة التحكم</li>
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
            @yield('content')

            <!--begin::Stat Boxes Row (محتوى افتراضي متكامل للعرض الفوري)-->
            <div class="row g-3 mb-4">
              <div class="col-lg-3 col-6">
                <div class="card kody-stat-card text-bg-primary h-100">
                  <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                      <h3 class="fs-2 fw-black mb-1">342</h3>
                      <p class="mb-0 fw-semibold opacity-90">الأطفال المسجلون</p>
                    </div>
                    <i class="bi bi-emoji-smile-fill fs-1 opacity-50"></i>
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
                <div class="card kody-stat-card text-bg-success h-100">
                  <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                      <h3 class="fs-2 fw-black mb-1">27</h3>
                      <p class="mb-0 fw-semibold opacity-90">الدروس المنشورة</p>
                    </div>
                    <i class="bi bi-code-square fs-1 opacity-50"></i>
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
                <div class="card kody-stat-card text-bg-info text-white h-100">
                  <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                      <h3 class="fs-2 fw-black mb-1">198</h3>
                      <p class="mb-0 fw-semibold opacity-90">أولياء الأمور</p>
                    </div>
                    <i class="bi bi-people-fill fs-1 opacity-50"></i>
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
                <div class="card kody-stat-card text-bg-warning text-dark h-100">
                  <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                      <h3 class="fs-2 fw-black mb-1">1,290</h3>
                      <p class="mb-0 fw-bold opacity-90">الأوسمة الممنوحة</p>
                    </div>
                    <i class="bi bi-award-fill fs-1 opacity-50"></i>
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
            <div class="row g-4">
              <!-- رسم بياني لتقدم الطلاب -->
              <div class="col-lg-7">
                <div class="card kody-card h-100">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fs-5 fw-bold">
                      <i class="bi bi-graph-up-arrow text-primary me-2"></i>
                      نشاط إتمام الدروس والتحديات الأسبوعي
                    </h3>
                    <span class="badge text-bg-success rounded-pill">+18% نمو</span>
                  </div>
                  <div class="card-body">
                    <div style="height: 280px">
                      <canvas id="revenue-chart"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <!-- حالة نسخ المسارات -->
              <div class="col-lg-5">
                <div class="card kody-card h-100">
                  <div class="card-header">
                    <h3 class="card-title mb-0 fs-5 fw-bold">
                      <i class="bi bi-layers-fill text-success me-2"></i>
                      حالة المسارات التعليمية
                    </h3>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                          <tr>
                            <th>المسار</th>
                            <th>النسخة</th>
                            <th>الحالة</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="fw-bold">البراعم (7-9 سنوات)</td>
                            <td><span class="badge text-bg-light border">v1.0</span></td>
                            <td><span class="badge text-bg-success">منشور</span></td>
                          </tr>
                          <tr>
                            <td class="fw-bold">بايثون (10-12 سنة)</td>
                            <td><span class="badge text-bg-light border">v1.2</span></td>
                            <td><span class="badge text-bg-success">منشور</span></td>
                          </tr>
                          <tr>
                            <td class="fw-bold">المحترفين (13-15 سنة)</td>
                            <td><span class="badge text-bg-light border">v2.0</span></td>
                            <td><span class="badge text-bg-warning">مسودة</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end::Main Charts & Tables Row-->
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
          <a href="#" class="text-decoration-none text-primary fw-bold">منصة كودي لتعليم البرمجة للأطفال</a>.
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
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
