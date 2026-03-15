<!DOCTYPE html>
<html lang="en">
<head>
    <base href="">
    <title><?= htmlspecialchars($pageTitle ?? 'My App') ?> | Metronic</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="<?= BASE_URL ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= BASE_URL ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/media/logos/favicon.ico" />
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">

        <!-- SIDEBAR for frontend user -->
        <div id="kt_aside" class="aside aside-dark aside-hoverable"
             data-kt-drawer="true" data-kt-drawer-name="aside"
             data-kt-drawer-activate="{default: true, lg: false}"
             data-kt-drawer-overlay="true"
             data-kt-drawer-width="{default:'200px', '300px': '250px'}"
             data-kt-drawer-direction="start"
             data-kt-drawer-toggle="#kt_aside_mobile_toggle">

            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                <a href="<?= BASE_URL ?>/dashboard">
                    <img alt="Logo" src="<?= BASE_URL ?>/assets/media/logos/logo-1-dark.svg" class="h-25px logo" />
                </a>
                <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                     data-kt-toggle="true" data-kt-toggle-state="active"
                     data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                    <span class="svg-icon svg-icon-1 rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black"/>
                            <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black"/>
                        </svg>
                    </span>
                </div>
            </div>

            <div class="aside-menu flex-column-fluid">
                <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper"
                     data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                     data-kt-scroll-height="auto"
                     data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                     data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                         id="#kt_aside_menu" data-kt-menu="true">

                        <div class="menu-item">
                            <div class="menu-content pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Navigation</span>
                            </div>
                        </div>

                        <!-- Dashboard always visible -->
                        <div class="menu-item">
                            <a class="menu-link <?= strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false ? 'active' : '' ?>"
                               href="<?= BASE_URL ?>/dashboard">
                                <span class="menu-icon"><span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black"/>
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"/>
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"/>
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"/>
                                    </svg>
                                </span></span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>

                        <?php if (!empty($features)): ?>
                        <div class="menu-item">
                            <div class="menu-content pt-8 pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">My Features</span>
                            </div>
                        </div>
                        <?php foreach ($features as $fKey => $feature): ?>
                        <div class="menu-item">
                            <a class="menu-link <?= strpos($_SERVER['REQUEST_URI'], $feature['feature_route']) !== false ? 'active' : '' ?>"
                               href="<?= BASE_URL . $feature['feature_route'] ?>">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title"><?= htmlspecialchars($feature['feature_label']) ?></span>
                            </a>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
                <div class="d-flex align-items-center px-2 py-2" style="background:rgba(255,255,255,0.05);border-radius:8px;">
                    <div class="symbol symbol-40px me-3">
                        <img src="<?= BASE_URL ?>/assets/media/avatars/150-1.jpg" alt=""/>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-white fw-bold fs-7"><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></div>
                        <div class="text-muted fs-8"><?= htmlspecialchars($_SESSION['email'] ?? '') ?></div>
                    </div>
                    <a href="<?= BASE_URL ?>/logout" class="btn btn-sm btn-icon btn-active-color-primary" title="Logout">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="4" y="11" width="12" height="2" rx="1" fill="white"/>
                                <path d="M5.86875 11.6927L7.62435 10.2297C8.09457 9.84876 8.12683 9.15839 7.69401 8.73751C7.30798 8.36197 6.69863 8.36743 6.31949 8.75061L3.65721 11.2531C3.26765 11.6436 3.26765 12.2768 3.65721 12.6673L6.31949 15.1698C6.69863 15.553 7.30798 15.5585 7.69401 15.1829C8.12683 14.762 8.09457 14.0717 7.62435 13.6907L5.86875 12.2277C5.61667 12.0178 5.61667 11.9026 5.86875 11.6927Z" fill="white"/>
                                <path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6V5C10 3.34315 11.3431 2 13 2H15C16.6569 2 18 3.34315 18 5V19C18 20.6569 16.6569 22 15 22H13C11.3431 22 10 20.6569 10 19V18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 21.7614 10.2386 24 13 24H15C17.7614 24 20 21.7614 20 19V5C20 2.23858 17.7614 0 15 0H13C10.2386 0 8 2.23858 8 5Z" fill="white" opacity="0.5"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <!-- end Aside -->

        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!-- Header -->
            <div id="kt_header" class="header align-items-stretch">
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1">
                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                            <span class="svg-icon svg-icon-2x mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black"/>
                                    <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <div class="d-flex align-items-center">
                            <h3 class="text-dark fw-bolder my-1 fs-3"><?= htmlspecialchars($pageTitle ?? '') ?></h3>
                        </div>
                        <div class="d-flex align-items-stretch flex-shrink-0">
                            <div class="d-flex align-items-center ms-1 ms-lg-3">
                                <a href="<?= BASE_URL ?>/profile" class="d-flex align-items-center" style="text-decoration:none;">
                                    <div class="symbol symbol-30px me-3">
                                        <img src="<?= BASE_URL ?>/assets/media/avatars/150-1.jpg" alt=""/>
                                    </div>
                                    <span class="fw-bolder fs-7 text-dark text-hover-primary">
                                        <?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toolbar -->
            <div class="toolbar" id="kt_toolbar">
                <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                    <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                            <?= htmlspecialchars($pageTitle ?? '') ?>
                            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                            <small class="text-muted fs-7 fw-bold my-1 ms-1">User Panel</small>
                        </h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">

                        <?= $content ?>

                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-bold me-1">2024©</span>
                        <span class="text-gray-800">Metronic App</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?= BASE_URL ?>/assets/js/scripts.bundle.js"></script>
</body>
</html>
