<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-pwa="true">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">


    <title><?= $title ?></title>
    <meta name="description" content="Finder - Directory &amp; Listings Bootstrap HTML Template">
    <meta name="keywords" content="directory, listings, search, car dealer, real estate, city guide, business listings, medical directories, event listings, e-commerce, market, multipurpose, ui kit, light and dark mode, bootstrap, html5, css3, javascript, gallery, slider, mobile, pwa">
    <meta name="author" content="Createx Studio">


    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="<?= base_url('assets/images/favicon/favicon.ico') ?>" />


    <link rel="preload" href="<?= base_url() ?>assets/fonts/inter-variable-latin.woff2" as="font" type="font/woff2" crossorigin="">
    <link rel="preload" href="<?= base_url() ?>assets/icons/finder-icons.woff2" as="font" type="font/woff2" crossorigin="">
    <link rel="stylesheet" href="<?= base_url() ?>assets/icons/finder-icons.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/theme.min.css" id="theme-styles">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/css/forms/selects/select2.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sweetalert2.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/pnotify/pnotify.custom.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css') ?>">
    <?php $this->renderSection('plugin_css') ?>
    <?php $this->renderSection('custom_css') ?>
    <script>
        var siteUrl = '<?php echo base_url(); ?>';
        var slide_image_edit = null;
    </script>
    <?php if (isset($image_slides_edit)) : ?>
        <script>
            var slide_image_edit = JSON.parse('<?php echo json_decode($image_slides_edit); ?>');
        </script>
    <?php endif ?>
</head>

<body>
    <?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
    <?= $this->include('navigation'); ?>

    <main class="content-wrapper bg-white">
        <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
            <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">


                <!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
                <aside class="col-lg-3" style="margin-top: -105px">
                    <div class="offcanvas-lg offcanvas-start sticky-lg-top pe-lg-3 pe-xl-4" id="accountSidebar">
                        <div class="d-none d-lg-block" style="height: 105px"></div>

                        <!-- Header -->
                        <div class="offcanvas-header d-lg-block py-3 p-lg-0">
                            <div class="d-flex flex-row flex-lg-column align-items-center align-items-lg-start">
                                <div class="flex-shrink-0 bg-body-secondary border rounded-circle overflow-hidden" style="width: 64px; height: 64px">
                                    <img src="<?= $cld->image($user->image) ?>" alt="Avatar">
                                </div>
                                <div class="pt-lg-3 ps-3 ps-lg-0">
                                    <h6 class="mb-1"><?= $user->fullname ?></h6>
                                    <p class="fs-sm mb-0"><?= $user->username ?></p>
                                </div>
                            </div>
                            <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#accountSidebar" aria-label="Close"></button>
                        </div>

                        <!-- Body (Navigation) -->
                        <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
                            <nav class="list-group list-group-borderless">
                                <a class="list-group-item list-group-item-action d-flex align-items-center <?php echo $module == "customer" && $menu == 'customer' ?  'active' : '' ?>" href="<?= route_to('customer') ?>">
                                    <i class="fi-user-check fs-base opacity-75 me-2"></i>
                                    <?= lang('Customer.heading') ?>
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center <?php echo $module == "user" && $menu == 'user' ?  'active' : '' ?>" href="<?= route_to('user') ?>">
                                    <i class="fi-user fs-base opacity-75 me-2"></i>
                                    <?= lang('Users.heading') ?>
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center <?php echo $module == "setting" && $menu == 'setting' ?  'active' : '' ?>" href="<?= route_to('setting') ?>">
                                    <i class="fi-settings fs-base opacity-75 me-2"></i>
                                    <?= lang('Setting.heading') ?>
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center <?php echo $module == "category" && $menu == 'category' ?  'active' : '' ?>" href="<?= route_to('category') ?>">
                                    <i class="fi-grid fs-base opacity-75 me-2"></i>
                                    <?= lang('Category.heading') ?>
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center <?php echo $module == "item" && $menu == 'item' ?  'active' : '' ?>" href="<?= route_to('items') ?>">
                                    <i class="fi-layers fs-base opacity-75 me-2"></i>
                                    <?= lang('Item.heading') ?>
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center <?php echo $module == "payment" && $menu == 'payment' ?  'active' : '' ?>" href="<?= route_to('payments') ?>">
                                    <i class="fi-credit-card fs-base opacity-75 me-2"></i>
                                    <?= lang('Payment.heading') ?>
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center <?php echo $module == "banner" && $menu == 'banner' ?  'active' : '' ?>" href="<?= route_to('banners') ?>">
                                    <i class="fi-image fs-base opacity-75 me-2"></i>
                                    <?= lang('Banner.heading') ?>
                                </a>
                                <a class="list-group-item list-group-item-action d-flex align-items-center <?php echo $module == "faq" && $menu == 'faq' ?  'active' : '' ?>" href="<?= route_to('faqs') ?>">
                                    <i class="fi-help-circle fs-base opacity-75 me-2"></i>
                                    <?= lang('FAQ.heading') ?>
                                </a>
                            </nav>
                            <nav class="list-group list-group-borderless pt-3">
                                <a class="list-group-item list-group-item-action d-flex align-items-center logout" href="javascript:void(0)">
                                    <i class="fi-log-out fs-base opacity-75 me-2"></i>
                                    Sign out
                                </a>
                            </nav>
                        </div>
                    </div>
                </aside>


                <!--  content -->
                <?php $this->renderSection('content') ?>
            </div>
        </div>
    </main>

    <?= $this->include('footer'); ?>


    <!-- Sidebar navigation offcanvas toggle that is visible on screens < 992px wide (lg breakpoint) -->
    <button type="button" class="fixed-bottom z-sticky w-100 btn btn-lg btn-dark border-0 border-top border-light border-opacity-10 rounded-0 pb-4 d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" aria-controls="accountSidebar" data-bs-theme="light">
        <i class="fi-sidebar fs-base me-2"></i>
        Account menu
    </button>


    <!-- Back to top button -->
    <div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
        <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
            Top
            <i class="fi-arrow-right fs-base ms-1 me-n1 animate-target"></i>
            <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
            <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 62 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x=".75" y=".75" width="60.5" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></rect>
            </svg>
        </a>
    </div>

    <script src="<?php echo base_url('assets/js/theme.min.js') ?>"></script>
    <script src="<?php echo base_url('vendors/js/vendors.min.js') ?>"></script>
    <script src="<?php echo base_url('js/sweetalert2.min.js') ?>"></script>
    <script src="<?php echo base_url('vendors/js/forms/select/select2.full.min.js') ?>"></script>
    <script src="<?php echo base_url('vendors/pnotify/pnotify.custom.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/js/extensions/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/jquery.number.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/app.js') ?>"></script>


    <?php $this->renderSection('plugin_js') ?>
    <?php $this->renderSection('custom_js') ?>
    <script>
        <?php
        if (isset($_SESSION['form_response_status'])) {
            echo "new PNotify({text: '" . $_SESSION['form_response_message'] . "', type: '" . $_SESSION['form_response_status'] . "'});";
        }
        if ($alertStatus = session()->getFlashData('form_alert_status')) {
            $alertMessage = session()->getFlashData('form_alert_message');
            echo "Swal.fire({icon: '" . $alertStatus . "', html: '" . $alertMessage . "'})";
        }
        ?>
    </script>

</body>

</html>