<?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
<footer class="footer bg-body border-top" data-bs-theme="dark">
    <div class="container pb-md-2 pt-4">

        <!-- <div class="border-bottom pt-5 pb-3">
            <div class="row row-cols-2 row-cols-md-4 gy-2">
                <div class="col d-flex justify-content-center justify-content-md-start pb-3">
                    <i class="fi-copy fs-4 text-light-emphasis"></i>
                    <div class="h6 text-body-secondary ps-1 ms-2 mb-0">Over 1 million listings</div>

                </div>
                <div class="col d-flex justify-content-center justify-content-md-start pb-3">
                    <i class="fi-document-search fs-4 text-light-emphasis"></i>
                    <div class="h6 text-body-secondary ps-1 ms-2 mb-0">Personalized search</div>
                </div>
                <div class="col d-flex justify-content-center justify-content-md-start pb-3">
                    <i class="fi-money-check fs-4 text-light-emphasis"></i>
                    <div class="h6 text-body-secondary ps-1 ms-2 mb-0">Online car appraisal</div>
                </div>
                <div class="col d-flex justify-content-center justify-content-md-start pb-3">
                    <i class="fi-lightbulb fs-4 text-light-emphasis"></i>
                    <div class="h6 text-body-secondary ps-1 ms-2 mb-0">Non-stop innovation</div>
                </div>
            </div>
        </div> -->

        <div class="pt-sm-2 pt-md-3 pt-lg-4">
            <div class="accordion row pb-5 mb-sm-2 mb-md-3 mb-lg-4" id="footerLinks">
                <div class="col-sm-5 col-md-4 col-lg-3">
                    <a class="d-inline-flex align-items-center text-dark-emphasis text-decoration-none mb-4" href="index.html">
                        <img src="<?= base_url() ?>assets/images/logo/indopond-logo-white.svg" class="w-50">
                    </a>
                    <ul class="list-unstyled gap-3">
                        <li>
                            <div class="position-relative d-flex align-items-center">
                                <i class="fi-mail fs-lg text-body me-2"></i>
                                <a class="text-dark-emphasis text-decoration-none hover-effect-underline stretched-link" href="mailto:<?= setting('email')->value ?>"><?= setting('email')->value ?></a>
                            </div>
                        </li>
                        <li>
                            <div class="position-relative d-flex align-items-center">
                                <i class="fi-phone-call fs-lg text-body me-2"></i>
                                <a class="text-dark-emphasis text-decoration-none hover-effect-underline stretched-link" href="tel:<?= setting('phone')->value ?>"><?= setting('phone')->value ?></a>
                            </div>
                        </li>
                        <li>
                            <div class="position-relative d-flex align-items-center">
                                <i class="fi-briefcase fs-lg text-body me-2"></i>
                                <div class="text-dark-emphasis text-decoration-none hover-effect-underline stretched-link"><?= setting('working_hour')->value ?></div>
                            </div>
                        </li>
                    </ul>

                    <div class="d-flex gap-3 pt-2 pt-md-3">
                        <?php if (setting('media_facebook')->value) : ?>
                            <a class="btn btn-icon btn-sm btn-secondary rounded-circle" target="_blank" href="<?= setting('media_facebook')->value ?>" aria-label="Follow us on Facebook">
                                <i class="fi-facebook fs-sm"></i>
                            </a>
                        <?php endif ?>
                        <?php if (setting('media_instagram')->value) : ?>
                            <a class="btn btn-icon btn-sm btn-secondary rounded-circle" target="_blank" href="<?= setting('media_instagram')->value ?>" aria-label="Follow us on Instagram">
                                <i class="fi-instagram fs-sm"></i>
                            </a>
                        <?php endif ?>
                        <?php if (setting('media_youtube')->value) : ?>
                            <a class="btn btn-icon btn-sm btn-secondary rounded-circle" target="_blank" href="<?= setting('media_youtube')->value ?>" aria-label="Follow us on Youtube">
                                <i class="fi-youtube fs-sm"></i>
                            </a>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Columns with links that are turned into accordion on screens < 500px wide (sm breakpoint) -->
                <div class="accordion-item col-sm-4 col-lg-3 border-0">
                    <h6 class="accordion-header" id="quickLinksHeading">
                        <span class="h5 d-none d-sm-block">Categories</span>
                        <button type="button" class="accordion-button collapsed py-3 d-sm-none" data-bs-toggle="collapse" data-bs-target="#quickLinks" aria-expanded="false" aria-controls="quickLinks">Quick links</button>
                    </h6>
                    <div class="accordion-collapse collapse d-sm-block" id="quickLinks" aria-labelledby="quickLinksHeading" data-bs-parent="#footerLinks">
                        <ul class="nav flex-column gap-2 pt-sm-1 pt-lg-2 pb-3 pb-sm-0 mt-n1 mb-1 mb-sm-0">
                            <?php foreach ($category_list as $category) : ?>
                                <li class="pt-1">
                                    <a class="nav-link hover-effect-underline d-inline text-body fw-normal p-0" href="<?= base_url('search?categories=' . $category->id) ?>"><?= $category->name ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <hr class="d-sm-none my-0">
                </div>
                <div class="accordion-item col-sm-3 col-lg-2 col-xxl-3 border-0">
                    <h6 class="accordion-header" id="profileLinksHeading">
                        <span class="h5 d-none d-sm-block">Quick Link</span>
                        <button type="button" class="accordion-button collapsed py-3 d-sm-none" data-bs-toggle="collapse" data-bs-target="#profileLinks" aria-expanded="false" aria-controls="profileLinks">Profile</button>
                    </h6>
                    <div class="accordion-collapse collapse d-sm-block" id="profileLinks" aria-labelledby="profileLinksHeading" data-bs-parent="#footerLinks">
                        <ul class="nav flex-column gap-2 pt-sm-1 pt-lg-2 pb-3 pb-sm-0 mt-n1 mb-1 mb-sm-0">
                            <li class="pt-1">
                                <a class="nav-link hover-effect-underline d-inline text-body fw-normal p-0" href="<?= route_to('contact') ?>">Contact</a>
                            </li>
                            <li class="pt-1">
                                <a class="nav-link hover-effect-underline d-inline text-body fw-normal p-0" href="<?= route_to('faq') ?>">Frequently Ask Question</a>
                            </li>
                            <li class="pt-1">
                                <a class="nav-link hover-effect-underline d-inline text-body fw-normal p-0" href="<?= route_to('about') ?>">About Us</a>
                            </li>
                        </ul>
                    </div>
                    <hr class="d-sm-none my-0">
                </div>

                <!-- Subscription form -->
                <div class="col-lg-4 col-xxl-3 pt-4 pt-md-5 pt-lg-0 mt-3 mt-md-0">
                    <h6 class="pb-1 pb-lg-0 mb-lg-4">
                        <span class="h5 d-none d-sm-block mb-0">Location</span>
                        <span class="d-sm-none">Location</span>
                    </h6>
                    <p class="fs-sm text-body-secondary pt-md-1"> <?= setting('company_address')->value ?></p>
                    <div style="height: 100%; overflow: hidden">
                        <?= str_replace('iframe', 'iframe class="border rounded"', str_replace('height="450"', 'height="350"', setting('embed_map')->value))
                        ?>

                    </div>
                </div>
            </div>


        </div>

        <div class="border-top pt-2 pb-md-2">
            <div class="row align-items-center py-4">
                <div class="col-lg-4 text-center text-lg-start mb-3 mb-lg-0">
                    <div class="h5 d-none d-sm-block mb-0">
                        Acceptance Payment
                    </div>
                    <div class="h6 d-sm-none mb-0">
                        Acceptance Payment
                    </div>
                </div>
                <div class="col-lg-3 col-xl-4 d-flex justify-content-center mb-3 mb-lg-0">
                    <div class="d-flex gap-2 gap-sm-3 justify-content-center ms-md-auto mb-4 mb-md-0 order-md-2">
                        <?php foreach ($payments as $payment) : ?>
                            <div class="bg-white w-50 d-flex align-items-center justify-content-center p-1 px-2 rounded">
                                <img src="<?= $cld->image($payment->image) ?>" alt="<?= $payment->note ?>">
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4 d-lg-flex justify-content-end">
                    <p class="text-body-secondary fs-sm text-center text-lg-start mb-0">© Indopond Jaya Mandiri</p>
                </div>
            </div>
        </div>

    </div>
</footer>