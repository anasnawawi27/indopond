<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-pwa="true">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

    <!-- SEO Meta Tags -->
    <title><?= $title ?></title>
    <meta name="description" content="Finder - Directory &amp; Listings Bootstrap HTML Template">
    <meta name="keywords" content="directory, listings, search, car dealer, real estate, city guide, business listings, medical directories, event listings, e-commerce, market, multipurpose, ui kit, light and dark mode, bootstrap, html5, css3, javascript, gallery, slider, mobile, pwa">
    <meta name="author" content="Createx Studio">

    <!-- Webmanifest + Favicon / App icons -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="<?= base_url('assets/images/favicon/favicon.ico') ?>" />

    <!-- Theme switcher (color modes) -->
    <script src="<?= base_url() ?>assets/js/theme-switcher.js"></script>

    <!-- Preloaded local web font (Inter) -->
    <link rel="preload" href="<?= base_url() ?>assets/fonts/inter-variable-latin.woff2" as="font" type="font/woff2" crossorigin="">

    <!-- Font icons -->
    <link rel="preload" href="<?= base_url() ?>assets/icons/finder-icons.woff2" as="font" type="font/woff2" crossorigin="">
    <link rel="stylesheet" href="<?= base_url() ?>assets/icons/finder-icons.min.css">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/glightbox/glightbox.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/choices.js/choices.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/simplebar/simplebar.min.css">

    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="<?= base_url() ?>assets/css/theme.min.css" as="style">
    <link rel="preload" href="<?= base_url() ?>assets/css/theme.rtl.min.css" as="style">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/theme.min.css" id="theme-styles">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/styles.css" id="styles">

</head>


<!-- Body -->

<body>


    <!-- Navigation -->
    <?= $this->include('navigation'); ?>


    <!-- Page content -->
    <main class="content-wrapper">
        <?php $this->renderSection('content') ?>


    </main>


    <!-- Page footer -->
    <?= $this->include('footer'); ?>


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

    <div class="fab">
        <!-- FAB Button -->
        <button class="btn btn-icon btn-success rounded-circle btn-lg" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fi-whatsapp" style="font-size: 1.7rem"></i>
        </button>

        <!-- Dropdown Menu -->
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" target="_blank" href="https://api.whatsapp.com/send?phone=62<?= substr(setting('whatsapp_1')->value, 1) ?>&text=Hello%20CS%20Indopond,%20saya%20dapat%20info%20dari%20Website.%20Ada%20yang%20ingin%20saya%20tanyakan">Customer Service 1</a></li>
            <li><a class="dropdown-item" target="_blank" href="https://api.whatsapp.com/send?phone=62<?= substr(setting('whatsapp_2')->value, 1) ?>&text=Hello%20CS%20Indopond,%20saya%20dapat%20info%20dari%20Website.%20Ada%20yang%20ingin%20saya%20tanyakan">Customer Service 2</a></li>
            <li><a class="dropdown-item" target="_blank" href="https://api.whatsapp.com/send?phone=62<?= substr(setting('whatsapp_3')->value, 1) ?>&text=Hello%20CS%20Indopond,%20saya%20dapat%20info%20dari%20Website.%20Ada%20yang%20ingin%20saya%20tanyakan">Customer Service 3</a></li>
            <li><a class="dropdown-item" target="_blank" href="https://api.whatsapp.com/send?phone=62<?= substr(setting('whatsapp_4')->value, 1) ?>&text=Hello%20CS%20Indopond,%20saya%20dapat%20info%20dari%20Website.%20Ada%20yang%20ingin%20saya%20tanyakan">Customer Service 4</a></li>
        </ul>
    </div>


    <script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
    <script src="<?= base_url() ?>assets/vendor/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/choices.js/choices.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/nouislider/nouislider.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/glightbox/glightbox.min.js"></script>
    <script src="<?= base_url() ?>assets/js/theme.min.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>


</body>

</html>