<?php $this->extend('layout/default-home') ?>
<?php $this->section('content') ?>
<?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
<div class="container pt-4 pb-5 mb-xxl-3">

    <nav class="pb-2" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Search Result</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center gap-3 border-bottom pb-2 mb-4">
        <div class="fs-sm text-nowrap pb-3"><span class="d-none d-md-inline">Showing</span> <?= $totalResults ?> results</div>
        <div class="w-100 pb-3 overflow-x-auto">
            <div class="d-flex gap-2">
                <?php if ($search) : ?>
                    <button type="button" class="btn btn-sm btn-secondary rounded-pill remove-filter" data-type="search" data-value="<?= $search ?>">
                        <i class="fi-close fs-sm me-1 ms-n1"></i>
                        <?= $search ?>
                    </button>
                <?php endif ?>
                <?php foreach ($category_filter as $filter) : ?>
                    <button type="button" class="btn btn-sm btn-secondary rounded-pill remove-filter" data-type="category" data-value="<?= $filter->id ?>">
                        <i class="fi-close fs-sm me-1 ms-n1"></i>
                        <?= $filter->name ?>
                    </button>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <div class="row pt-md-2 pt-lg-3 pb-2 pb-sm-3 pb-md-4 pb-lg-5">
        <aside class="col-lg-3">
            <div class="offcanvas-lg offcanvas-start pe-lg-2 pe-xl-3 pe-xxl-4" id="filterSidebar">
                <div class="offcanvas-header border-bottom py-3">
                    <h3 class="h5 offcanvas-title">Filters</h3>
                    <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#filterSidebar" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-block">

                    <div class="pb-4 mb-2 mb-xl-3">
                        <h4 class="h6">Categories</h4>
                        <div style="height: 202px" data-simplebar="" data-simplebar-auto-hide="false">
                            <div class="d-flex flex-column gap-2">
                                <?php foreach ($categories as $category) : ?>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input filter-category" id="<?= $category->id ?>" value="<?= $category->id ?>" <?= in_array($category->id, $category_selected) ? 'checked' : '' ?>>
                                        <label class="form-check-label fs-sm" for="<?= $category->id ?>"><?= $category->name ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="pb-4 mb-2 mb-xl-3">
                        <div class="form-check form-switch mb-0">
                            <input type="checkbox" class="form-check-input" role="switch" id="negotiate">
                            <label for="negotiate" class="form-check-label">Negotiated price</label>
                        </div>
                    </div> -->

                </div>
            </div>
        </aside>

        <div class="col-lg-9">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-2 row-cols-xl-3 g-4 g-sm-3 g-lg-4">
                <?php foreach ($items as $item) : ?>
                    <div class="col">
                        <article class="card h-100 hover-effect-scale bg-body-tertiary border-0">
                            <div class="card-img-top position-relative overflow-hidden">
                                <div class="d-flex flex-column gap-2 align-items-start position-absolute top-0 start-0 z-1 pt-1 pt-sm-0 ps-1 ps-sm-0 mt-2 mt-sm-3 ms-2 ms-sm-3">
                                    <span class="badge text-bg-warning"><?= $item->category_name ?></span>
                                </div>
                                <div class="ratio hover-effect-target bg-body-secondary" style="--fn-aspect-ratio: calc(204 / 306 * 100%)">
                                    <img src="<?= $cld->image($item->thumbnail) ?>" alt="Image" style="object-fit: cover">
                                </div>
                            </div>
                            <div class="card-body pb-3">
                                <h3 class="h6 mb-2">
                                    <a class="hover-effect-underline stretched-link me-1" href="single-entry-cars.html"><?= $item->name ?></a>
                                </h3>
                                <div class="h6 mb-0 text-success"><?= rupiah($item->display_price) ?></div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>

                <?php if (count($items) < 1) : ?>
                    <div class="text-center w-100 p-5">
                        <i class="fi-document-search h1"></i>
                        <p class="text-muted">Data Tidak Ditemukan</p>
                    </div>

                <?php endif ?>
            </div>

            <nav class="pt-3 mt-3" aria-label="Listings pagination">
                <?= $pager->links('items', 'bootstrap_pagination') ?>
            </nav>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>