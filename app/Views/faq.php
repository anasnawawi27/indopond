<?php $this->extend('layout/default-home') ?>
<?php $this->section('content') ?>
<section class="bg-body-tertiary py-5">
    <div class="container py-2 py-sm-3 py-md-4 py-lg-5">
        <div class="row">
            <div class="col-md-4 col-xl-3 mb-2 mb-sm-3 mb-md-0" style="margin-top: -120px">
                <div class="sticky-md-top pe-md-4 pe-lg-5 pe-xl-0" style="padding-top: 120px;">
                    <h2>Popular FAQs</h2>
                    <p>Pertanyaan yang paling sering ditanyakan.</p>
                </div>
            </div>
            <div class="col-md-8 offset-xl-1">
                <div class="accordion" id="faq">

                    <?php foreach ($faqs as $index => $faq) : ?>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqHeading-<?= $index ?>">
                                <button type="button" class="accordion-button hover-effect-underline collapsed" data-bs-toggle="collapse" data-bs-target="#faqCollapse-<?= $index ?>" aria-expanded="false" aria-controls="faqCollapse-<?= $index ?>">
                                    <span class="me-2"><?= $faq->question ?></span>
                                </button>
                            </h3>
                            <div class="accordion-collapse collapse" id="faqCollapse-<?= $index ?>" aria-labelledby="faqHeading-<?= $index ?>" data-bs-parent="#faq">
                                <div class="accordion-body"><?= $faq->answer ?></div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection(); ?>