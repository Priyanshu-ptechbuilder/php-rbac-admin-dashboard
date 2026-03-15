<!DOCTYPE html>
<html lang="en">

<head>
    <base href="">
    <title>
        <?= htmlspecialchars($pageTitle ?? 'Admin Panel')?> | Metronic Admin
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--begin::Fonts (From Metronic index.html)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle (From Metronic index.html line ~20)-->
    <link href="<?= BASE_URL?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= BASE_URL?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <link rel="shortcut icon" href="<?= BASE_URL?>/assets/media/logos/favicon.ico" />
    <style>
        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #009ef7;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
        }

        .feature-toggle-card {
            border: 1px solid #e4e6ef;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 10px;
            transition: border-color 0.2s;
        }

        .feature-toggle-card:hover {
            border-color: #009ef7;
        }
    </style>
</head>
<!--begin::Body (class from Metronic index.html body tag)-->

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">

            <!-- ===================== ASIDE / SIDEBAR (from Metronic index.html ~line 38) ===================== -->
            <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
                data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">

                <!-- Aside Logo (from Metronic index.html) -->
                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <a href="<?= BASE_URL?>/admin" class="d-flex align-items-center" style="text-decoration: none;">
                        <img alt="Logo" src="<?= BASE_URL?>/assets/media/logos/logo-1-dark.svg" class="h-25px logo" />
                    </a>
                    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                        data-kt-toggle-name="aside-minimize">
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.5"
                                    d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                    fill="black" />
                                <path
                                    d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                    fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <!-- end Aside Logo -->

                <!-- Aside Menu (from Metronic index.html ~line 75) -->
                <div class="aside-menu flex-column-fluid">
                    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                        data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">

                        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                            id="#kt_aside_menu" data-kt-menu="true">

                            <!-- Dashboard Section -->
                            <div class="menu-item">
                                <div class="menu-content pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
                                </div>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(strpos($_SERVER['REQUEST_URI'], '/admin') !== false && !strpos($_SERVER['REQUEST_URI'], 'users')) ? 'active' : ''?>"
                                    href="<?= BASE_URL?>/admin">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                    fill="black" />
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                    fill="black" />
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </div>

                            <!-- Users Section -->
                            <div class="menu-item">
                                <div class="menu-content pt-8 pb-2">
                                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Management</span>
                                </div>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?=(strpos($_SERVER['REQUEST_URI'], '/admin/users') !== false) ? 'active' : ''?>"
                                    href="<?= BASE_URL?>/admin/users">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                    fill="black" />
                                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">All Users</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="<?= BASE_URL?>/admin/users/create">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                                    transform="rotate(-90 11.364 20.364)" fill="black" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Add User</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Aside Menu -->

                <!-- Aside Footer -->
                <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
                    <div class="d-flex align-items-center px-2 py-2"
                        style="background:rgba(255,255,255,0.05);border-radius:8px;">
                        <div class="symbol symbol-40px me-3">
                            <img src="<?= BASE_URL?>/assets/media/avatars/150-26.jpg" alt="" />
                        </div>
                        <div class="flex-grow-1">
                            <div class="text-white fw-bold fs-7">
                                <?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin')?>
                            </div>
                            <div class="text-muted fs-8">Administrator</div>
                        </div>
                        <a href="<?= BASE_URL?>/logout" class="btn btn-sm btn-icon btn-active-color-primary"
                            title="Logout">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.3" x="4" y="11" width="12" height="2" rx="1" fill="white" />
                                    <path
                                        d="M5.86875 11.6927L7.62435 10.2297C8.09457 9.84876 8.12683 9.15839 7.69401 8.73751C7.30798 8.36197 6.69863 8.36743 6.31949 8.75061L3.65721 11.2531C3.26765 11.6436 3.26765 12.2768 3.65721 12.6673L6.31949 15.1698C6.69863 15.553 7.30798 15.5585 7.69401 15.1829C8.12683 14.762 8.09457 14.0717 7.62435 13.6907L5.86875 12.2277C5.61667 12.0178 5.61667 11.9026 5.86875 11.6927Z"
                                        fill="white" />
                                    <path
                                        d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6V5C10 3.34315 11.3431 2 13 2H15C16.6569 2 18 3.34315 18 5V19C18 20.6569 16.6569 22 15 22H13C11.3431 22 10 20.6569 10 19V18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 21.7614 10.2386 24 13 24H15C17.7614 24 20 21.7614 20 19V5C20 2.23858 17.7614 0 15 0H13C10.2386 0 8 2.23858 8 5Z"
                                        fill="white" opacity="0.5" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <!-- end Aside Footer -->
            </div>
            <!-- end Aside -->

            <!-- ===================== WRAPPER ===================== -->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <!-- ===================== HEADER (from Metronic index.html ~line 375) ===================== -->
                <div id="kt_header" class="header align-items-stretch">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <!-- Mobile aside toggle -->
                        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                id="kt_aside_mobile_toggle">
                                <span class="svg-icon svg-icon-2x mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <!-- Page Title -->
                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                            <div class="d-flex align-items-center" id="kt_header_nav">
                                <h3 class="text-dark fw-bolder my-1 fs-3 me-2">
                                    <?= htmlspecialchars($pageTitle ?? 'Admin Panel')?>
                                </h3>
                            </div>
                            <!-- Topbar -->
                            <div class="d-flex align-items-stretch flex-shrink-0">
                                <!-- Search -->
                                <div class="d-flex align-items-center ms-1 ms-lg-3">
                                    <div
                                        class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <!-- Chat -->
                                <div class="d-flex align-items-center ms-1 ms-lg-3">
                                    <div
                                        class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px position-relative">
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                    fill="black" />
                                                <rect x="6" y="12" width="7" height="2" rx="1" fill="black" />
                                                <rect x="6" y="7" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <span
                                            class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
                                    </div>
                                </div>

                                <!-- Notifications -->
                                <div class="d-flex align-items-center ms-1 ms-lg-3">
                                    <div
                                        class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z"
                                                    fill="black" />
                                                <path
                                                    d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <!-- Layouts/Apps -->
                                <div class="d-flex align-items-center ms-1 ms-lg-3">
                                    <div
                                        class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                    fill="black" />
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                    fill="black" />
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <!-- Profile -->
                                <div class="d-flex align-items-center ms-1 ms-lg-3">
                                    <div class="d-flex align-items-center p-2 rounded"
                                        style="background: rgba(245,248,250,0.8);">
                                        <a href="<?= BASE_URL ?>/admin/profile" class="d-flex align-items-center" style="text-decoration:none;">
                                            <div class="symbol symbol-30px me-2">
                                                <img src="<?= BASE_URL?>/assets/media/avatars/150-26.jpg" alt="" />
                                            </div>
                                            <span class="fw-bolder text-dark text-hover-primary fs-7 me-3 d-none d-md-inline">
                                                <?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin')?>
                                            </span>
                                        </a>
                                        <a href="<?= BASE_URL?>/logout" class="btn btn-sm btn-light-danger px-3 py-1">
                                            Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Header -->

                <!-- ===================== TOOLBAR (from Metronic index.html ~line 470) ===================== -->
                <div class="toolbar" id="kt_toolbar">
                    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                                <?= htmlspecialchars($pageTitle ?? 'Admin Panel')?>
                                <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                                <small class="text-muted fs-7 fw-bold my-1 ms-1">Admin Panel</small>
                            </h1>
                        </div>
                        <?php if (isset($toolbarActions)): ?>
                        <div class="d-flex align-items-center py-1">
                            <?= $toolbarActions?>
                        </div>
                        <?php
endif; ?>
                    </div>
                </div>
                <!-- end Toolbar -->

                <!-- ===================== CONTENT AREA ===================== -->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">

                            <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success d-flex align-items-center p-5 mb-5">
                                <span class="svg-icon svg-icon-2hx svg-icon-success me-4">✅</span>
                                <div>
                                    <?= htmlspecialchars($_GET['success'])?>
                                </div>
                            </div>
                            <?php
endif; ?>

                            <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger d-flex align-items-center p-5 mb-5">
                                <span class="me-4">❌</span>
                                <div>
                                    <?= htmlspecialchars($_GET['error'])?>
                                </div>
                            </div>
                            <?php
endif; ?>

                            <!-- ===== PAGE CONTENT INJECTED HERE ===== -->
                            <?= $content?>
                            <!-- ===== END PAGE CONTENT ===== -->

                        </div>
                    </div>
                </div>
                <!-- end Content -->

                <!-- ===================== FOOTER (from Metronic index.html ~line 3800) ===================== -->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2024©</span>
                            <span class="text-gray-800">Metronic Admin — Core PHP MVC</span>
                        </div>
                        <!-- <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                        <li class="menu-item">
                            <a href="<?= BASE_URL?>/admin" class="menu-link px-2">Dashboard</a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= BASE_URL?>/admin/users" class="menu-link px-2">Users</a>
                        </li>
                    </ul> -->
                    </div>
                </div>
                <!-- end Footer -->

            </div>
            <!-- end Wrapper -->

        </div>
    </div>

    <!-- ===================== JS BUNDLES (from Metronic index.html bottom scripts) ===================== -->
    <script src="<?= BASE_URL?>/assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?= BASE_URL?>/assets/js/scripts.bundle.js"></script>
    <!-- end JS Bundles -->

</body>

</html>