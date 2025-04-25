<?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
<header class="navbar pt-0 navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0 flex-column" data-sticky-element="">
    <div class="bg-dark w-100 px-4 py-2 d-flex">
        <div class="w-75 d-none d-lg-flex gap-3">
            <div class="d-flex align-items-center text-light">
                <i class="fi-home"></i>
                <small class="ms-2 mb-0"><?= setting('company_name')->value ?></small>
            </div>

            <div class="d-none d-lg-flex align-items-center text-light">
                <i class="fi-mail"></i>
                <small class="ms-2 mb-0"><?= setting('email')->value ?></small>
            </div>

            <div class="d-none d-lg-flex align-items-center text-light">
                <i class="fi-phone"></i>
                <small class="ms-2 mb-0"><?= setting('phone')->value ?></small>
            </div>
        </div>
        <div class="w-lg-25 w-lg-75 d-flex gap-3">
            <?php if (setting('tokopedia')) : ?>
                <a target="_blank" href="<?= setting('tokopedia')->other_value ?>" class="d-flex align-items-center cursor-pointer text-light">
                    <img style="width: 2rem" src="<?= base_url() ?>assets/images/logo/tokopedia-logo.svg">
                    <small class="ms-2 mb-0"><?= setting('tokopedia')->value ?></small>
                </a>
            <?php endif ?>
            <?php if (setting('shopee')) : ?>
                <a target="_blank" href="<?= setting('shopee')->other_value ?>" class="d-flex align-items-center cursor-pointer text-light">
                    <img style="width: 1.5rem" src="<?= base_url() ?>assets/images/logo/shopee-logo.svg">
                    <small class="ms-2 mb-0"><?= setting('shopee')->value ?></small>
                </a>
            <?php endif ?>
        </div>



    </div>
    <div class="container pt-2">

        <!-- Mobile offcanvas menu toggler (Hamburger) -->
        <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar brand (Logo) -->
        <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0" href="<?= base_url() ?>">
            <span class="d-none d-sm-flex flex-shrink-0 text-primary rtl-flip me-2">
                <img style="width: 12rem" src="<?= base_url() ?>assets/images/logo/indopond-logo.svg">
            </span>
        </a>

        <!-- Main navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
        <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
            <div class="offcanvas-header py-3">
                <h5 class="offcanvas-title" id="navbarNavLabel">Browse Finder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">
                <ul class="navbar-nav position-relative">
                    <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown position-static py-lg-2 me-lg-n1 me-xl-0">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">Categories</a>
                        <div class="dropdown-menu rounded-4 p-4 w-100 col-12">
                            <div class="row">
                                <?php foreach ($categories_nav as $nav) : ?>
                                    <div class="col-4">
                                        <div class="h6 mb-2"><?= $nav['category']->name ?></div>
                                        <ul class="nav flex-column gap-2 mt-0">
                                            <?php foreach ($nav['data'] as $item) : ?>
                                                <li class="pt-1">
                                                    <a class="nav-link hover-effect-underline d-inline fw-normal p-0" href="<?= route_to('detail_item', encode($item->id)) ?>"><?= $item->name ?></a>
                                                </li>
                                            <?php endforeach ?>
                                            <?php if (count($nav['data']) > 0) : ?>
                                                <li class="pt-1">
                                                    <a class="nav-link d-inline fw-normal p-0 fw-bold text-primary" href="<?= route_to('search') . '?categories=' . $nav['category']->id ?>">More...</a>
                                                </li>
                                            <?php endif ?>

                                        </ul>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                        <a class="nav-link" href="<?= route_to('contact') ?>">Contact</a>
                    </li>
                    <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                        <a class="nav-link" href="<?= route_to('faq') ?>">FAQ</a>
                    </li>
                    <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                        <a target="_blank" class="nav-link" href="https://api.whatsapp.com/send?phone=62<?= substr(setting('whatsapp_main')->value, 1) ?>&text=Hello%20CS%20Indopond,%20saya%20dapat%20info%20dari%20Website.%20Ada%20yang%20ingin%20saya%20tanyakan">Request Quotation</a>
                    </li>
                    <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                        <div class="position-relative ms-3">
                            <i class="fi-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                            <input type="search" class="docs-search form-control form-icon-start" placeholder="Cari Produk" id="search-input">
                            <button class="btn btn-sm btn-outline-secondary w-auto border-0 p-1 position-absolute top-50 end-0 translate-middle-y me-2 opacity-0">
                                <i class="fi-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="d-flex gap-sm-1">
            <?php if (logged_in()) : ?>
                <div class="dropdown pe-1 me-2">
                    <a class="btn btn-icon hover-effect-scale position-relative bg-body-secondary border rounded-circle overflow-hidden" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="My account">
                        <img src="<?= $cld->image($user->image) ?>" class="hover-effect-target position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Avatar">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="--fn-dropdown-spacer: .5rem">
                        <li><span class="h6 dropdown-header"><?= $user->fullname ?></span></li>
                        <li>
                            <a class="dropdown-item" href="<?= route_to('user') ?>">
                                <i class="fi-user opacity-75 me-2"></i>
                                <?= lang('Users.heading') ?>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= route_to('setting') ?>">
                                <i class="fi-settings opacity-75 me-2"></i>
                                <?= lang('Setting.heading') ?>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item logout" href="javascript:void(0)">
                                <i class="fi-log-out opacity-75 me-2"></i>
                                Sign out
                            </a>
                        </li>
                    </ul>
                </div>
            <?php else : ?>
                <!-- <a class="btn btn-outline-dark animate-shake" href="<?= route_to('login') ?>">
                    <i class="fi-user fs-base animate-target ms-n1 me-1 me-sm-2"></i>
                    Sign in
                </a> -->
            <?php endif ?>

        </div>
    </div>
</header>