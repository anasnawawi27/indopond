<?php $this->extend('layout/default-home') ?>
<?php $this->section('content') ?>
<div class="container pt-4 pt-sm-5 pb-5 mt-2 mt-sm-0 mt-lg-2 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10 col-xxl-9">
            <h1 class="h2 pb-2 pb-sm-3 pb-lg-4">About Us</h1>
            <hr class="mt-0">
            <?= setting('about_us')->value ?>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>