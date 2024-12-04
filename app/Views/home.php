<?php $this->extend('layout/default-home') ?>
<?php $this->section('content') ?>
<?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
<div class="swiper swiper-hero position-relative">
    <div class="swiper-wrapper z-2">
        <?php foreach ($banners as $banner) : ?>
            <div class="swiper-slide w-full bg-dark position-relative" style="height:35rem">
                <div class="row position-absolute z-2" style="left: 100px; bottom: 30%">
                    <div class="col-7">
                        <h1 class="display-5 pb-md-2"><?= $banner->title ?></h1>
                        <p class="fs-lg mb-0"><?= $banner->text ?></p>
                        <a href="<?= route_to('search') ?>" class="btn btn-primary mt-4">
                            <i class="fi-shopping-cart"></i> &nbsp;
                            Belanja Sekarang</a>
                    </div>
                </div>
                <!-- <div class="backdrop-hero"></div> -->
                <img src="<?= $cld->image($banner->image) ?>" style="width: 100%; object-fit: cover; position: absolute">
            </div>
        <?php endforeach ?>
    </div>

    <div class="swiper-pagination"></div>

    <button type="button" class="btn btn-icon btn-outline-secondary animate-slide-start bg-body rounded-circle position-absolute" style="z-index: 10; left: 20px; bottom: 50%" id="hero-prev" aria-label="Prev">
        <i class="fi-chevron-left fs-lg animate-target"></i>
    </button>
    <button type="button" class="btn btn-icon btn-outline-secondary animate-slide-end bg-body rounded-circle position-absolute" style="z-index: 11; right: 20px; bottom: 50%" id="hero-next" aria-label="Next">
        <i class="fi-chevron-right fs-lg animate-target"></i>
    </button>
    <div class="swiper-scrollbar"></div>
</div>

<?php foreach ($items as $index => $item) : ?>
    <section class="container pt-2 pt-sm-3 pt-md-4 pt-lg-5 pb-5 my-xxl-3">
        <div class="row align-items-center">

            <!-- Banner -->
            <aside class="col-lg-4 d-none d-lg-block">
                <div>

                    <div class="position-relative" style="max-width: 306px">
                        <div class="d-flex gap-2 position-relative z-3 p-4">
                            <button type="button" class="btn btn-icon btn-outline-secondary animate-slide-start bg-body rounded-circle me-1" id="prev-by-category-<?= $index ?>" aria-label="Prev">
                                <i class="fi-chevron-left fs-lg animate-target"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-outline-secondary animate-slide-end bg-body rounded-circle" id="next-by-category-<?= $index ?>" aria-label="Next">
                                <i class="fi-chevron-right fs-lg animate-target"></i>
                            </button>
                        </div>
                        <div class="position-relative h-100 z-1 p-5 mb-3">
                            <h3 class="mb-2">
                                <?= $item['category']->name ?>
                            </h3>
                            <a href="<?= route_to('search') . '?categories=' . $item['category']->id ?>" class="mt-2 btn btn-success">Beli Sekarang</a>
                        </div>
                        <a class="d-block position-relative z-1 pb-4 ps-xl-5 ms-lg-n3 ms-xl-0" href="#!">
                            <div class="ratio mb-2" style="width: 400px; --fn-aspect-ratio: calc(221 / 324 * 100%)">
                                <?php if ($item['category']->image) : ?>
                                    <img src="<?= $cld->image($item['category']->image) ?>" alt="Image" style="object-fit: contain">
                                <?php endif ?>

                            </div>
                        </a>
                        <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded overflow-hidden d-none-dark">
                            <span class="position-absolute top-100 start-0 translate-middle-y bg-white bg-opacity-50 rounded-circle mt-n5 ms-n5 ms-xl-4" style="width: 480px; height: 480px"></span>
                        </span>
                        <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-tertiary rounded overflow-hidden d-none d-block-dark">
                            <span class="position-absolute top-100 start-0 translate-middle-y bg-white bg-opacity-10 rounded-circle mt-n5 ms-n5 ms-xl-4" style="width: 480px; height: 480px"></span>
                        </span>
                    </div>
                </div>
            </aside>

            <div class="col-lg-8">
                <div class="mx-n2" style="height: 30rem">
                    <div class="swiper px-2 pb-4" data-swiper="{
                            &quot;slidesPerView&quot;: 3,
                            &quot;slidesPerColumn&quot;: 3,
                            &quot;slidesPerGroup&quot;: 3,
                            &quot;spaceBetween&quot;: 20,
                            &quot;navigation&quot;: {
                            &quot;prevEl&quot;: &quot;#prev-by-category-<?= $index ?>&quot;,
                            &quot;nextEl&quot;: &quot;#next-by-category-<?= $index ?>&quot;
                            },
                            &quot;grid&quot;: {
                            &quot;rows&quot;: 2,
                            &quot;fill&quot;: &quot;row&quot;
                            },
                            &quot;pagination&quot;: {
                            &quot;el&quot;: &quot;.swiper-pagination&quot;,
                            &quot;clickable&quot;: true
                            }
                        }">
                        <div class=" swiper-wrapper">

                            <?php foreach ($item['data'] as $data) : ?>
                                <div class="swiper-slide h-auto">
                                    <article class="card h-100 hover-effect-scale hover-effect-opacity shadow">
                                        <div class="bg-body-secondary rounded overflow-hidden">
                                            <div class="ratio hover-effect-target" style="--fn-aspect-ratio: calc(250 / 416 * 100%)">
                                                <img src="<?= $cld->image($data->thumbnail) ?>" alt="Item" style="object-fit: cover">
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <h6 class="h6 pt-1 mb-2">
                                                <a class="hover-effect-underline stretched-link" href="<?= route_to('detail_item', encode($data->id)) ?>"><?= $data->name ?></a>
                                            </h6>
                                            <small class="text-info mb-0 fw-bold"><?= rupiah($data->display_price) ?></small>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="swiper-pagination position-static mt-3 mt-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endforeach ?>

<section class="bg-body-tertiary py-5 mt-5">
    <div class="container pt-2 pb-sm-2 pt-sm-3 py-md-4 py-lg-5 my-xxl-3">
        <h2 class="h1 text-center pb-sm-2 pb-md-3 mb-lg-4">Our Customers</h2>

        <div class="swiper" data-swiper="{
            &quot;slidesPerView&quot;: 1,
            &quot;spaceBetween&quot;: 0,
            &quot;loop&quot;: true,
            &quot;pagination&quot;: {
              &quot;el&quot;: &quot;.swiper-pagination&quot;,
              &quot;clickable&quot;: true
            },
            &quot;autoplay&quot;: {
              &quot;delay&quot;: 2000
            },
            &quot;breakpoints&quot;: {
              &quot;400&quot;: {
                &quot;slidesPerView&quot;: 2
              },
              &quot;600&quot;: {
                &quot;slidesPerView&quot;: 3,
                &quot;spaceBetween&quot;: 0
              },
              &quot;900&quot;: {
                &quot;slidesPerView&quot;: 4,
                &quot;spaceBetween&quot;: 16
              },
              &quot;1200&quot;: {
                &quot;slidesPerView&quot;: 5,
                &quot;spaceBetween&quot;: 16
              },
              &quot;1400&quot;: {
                &quot;slidesPerView&quot;: 5,
                &quot;spaceBetween&quot;: 24
              }
            }
          }">
            <div class="swiper-wrapper">

                <?php foreach ($customers as $customer) : ?>
                    <div class="swiper-slide d-flex align-items-center">
                        <div class="nav align-items-center justify-content-center p-4">
                            <div style="
                                height: 7rem;
                                width: 12rem;
                                background: url('<?= $cld->image($customer->image) ?>');
                                background-repeat: no-repeat;
                                background-position: center;
                                background-size: contain;
                            "></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination position-static mt-sm-2"></div>
        </div>
    </div>
</section>

<!-- Property cost calculator -->
<section class="container pt-2 pt-sm-3 pt-md-4 pt-lg-5 pb-5 my-xxl-3">
    <div class="bg-info rounded py-5 py-lg-4 px-4 px-sm-5 px-lg-0">
        <div class="row align-items-center justify-content-center justify-content-lg-start py-lg-3">
            <div class="col-10 col-sm-8 col-md-7 col-lg-3 offset-lg-1 pb-3 pb-lg-0 mb-3 mb-lg-0">
                <div class="ratio mx-auto mx-lg-0" style="max-width: 479px; --fn-aspect-ratio: calc(300 / 479 * 100%)">
                    <img src="<?= base_url('assets/images/quote-illustration.svg') ?>" alt="Image">
                </div>
            </div>
            <div class="col-lg-8 text-center text-lg-start py-lg-4 pe-4 position-relative">
                <img src="<?= base_url('assets/images/quote-mark.svg') ?>" style="width: 2.5rem;">
                <h4 class="text-white ms-3 mt-3"><?= setting('motivational_text')->value ?></h4>
            </div>
        </div>
    </div>
</section>

<section class="container py-2 py-sm-3 py-md-4 py-lg-5 mb-xxl-3">
    <div class="swiper pb-5" data-swiper="{
          &quot;slidesPerView&quot;: 1,
          &quot;spaceBetween&quot;: 24,
          &quot;pagination&quot;: {
            &quot;el&quot;: &quot;.swiper-pagination&quot;,
            &quot;clickable&quot;: true
          },
          &quot;breakpoints&quot;: {
            &quot;450&quot;: {
              &quot;slidesPerView&quot;: 2
            },
            &quot;800&quot;: {
              &quot;slidesPerView&quot;: 4
            }
          }
        }">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <i class="fi-money-check" style="font-size: 3rem"></i>
                <h3 class="h5 pt-3 pt-md-4 mb-2">Competitive Price</h3>
                <p class="mb-0">Harga Terjangkau</p>
            </div>
            <div class="swiper-slide">
                <i class="fi-check-shield" style="font-size: 3rem"></i>
                <h3 class="h5 pt-3 pt-md-4 mb-2">Guarantee</h3>
                <p class="mb-0">Hasil Berkualitas</p>
            </div>
            <div class="swiper-slide">
                <i class="fi-rocket" style="font-size: 3rem"></i>
                <h3 class="h5 pt-3 pt-md-4 mb-2">Fast Delivery</h3>
                <p class="mb-0">Pengiriman Cepat</p>
            </div>
            <div class="swiper-slide">
                <i class="fi-credit-card" style="font-size: 3rem"></i>
                <h3 class="h5 pt-3 pt-md-4 mb-2">Secure Online Payment</h3>
                <p class="mb-0">Pembayaran aman via Online</p>
            </div>
        </div>
        <div class="swiper-pagination position-static mt-3"></div>
    </div>
</section>
<?php $this->endSection(); ?>