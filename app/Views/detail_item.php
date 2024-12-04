<?php $this->extend('layout/default-home') ?>
<?php $this->section('content') ?>
<?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
<section class="container pt-4 pb-5 mb-xxl-3">

  <nav class="pb-2" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $item->name ?></li>
    </ol>
  </nav>

  <div class="d-flex justify-content-between gap-3 position-relative z-2 mb-3 mb-lg-4">
    <h1 class="mb-0"><?= $item->name ?></h1>
  </div>

  <div class="d-lg-none mb-4">
    <div class="d-flex align-items-center justify-content-between gap-3 pb-1 mb-2">
      <div class="h2 mb-0"><?= rupiah($item->display_price) ?></div>
      <div class="d-flex gap-2 mb-3">
        <span class="badge text-bg-info d-inline-flex align-items-center">
          <?= $item->category_name ?>
        </span>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8 pb-3 pb-sm-0 mb-4 mb-sm-5 mb-lg-0">

      <!-- Main slider -->
      <div class="swiper hover-effect-opacity" data-swiper="{
              &quot;spaceBetween&quot;: 16,
              &quot;loop&quot;: true,
              &quot;navigation&quot;: {
                &quot;prevEl&quot;: &quot;.btn-prev&quot;,
                &quot;nextEl&quot;: &quot;.btn-next&quot;
              },
              &quot;thumbs&quot;: {
                &quot;swiper&quot;: &quot;#thumbs&quot;
              }
            }">
        <div class="swiper-wrapper">
          <?php
          $slides = json_decode($item->image_slides);
          foreach ($slides as $slide) :
          ?>
            <div class="swiper-slide">
              <a class="hover-effect-scale hover-effect-opacity position-relative d-flex rounded overflow-hidden" style="--fn-aspect-ratio: calc(482 / 856 * 100%)" href="<?= $cld->image($slide->public_id) ?>" data-glightbox="" data-gallery="image-gallery">
                <i class="fi-zoom-in hover-effect-target fs-3 text-white position-absolute top-50 start-50 translate-middle opacity-0 z-2"></i>
                <span class="hover-effect-target position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-25 opacity-0 z-1"></span>
                <div class="ratio hover-effect-target bg-body-tertiary rounded" style="--fn-aspect-ratio: calc(450 / 856 * 100%)">
                  <img src="<?= $cld->image($slide->public_id) ?>" alt="Image" style="object-fit: contain">
                </div>
              </a>


            </div>
          <?php endforeach ?>
        </div>

        <div class="position-absolute top-50 start-0 z-2 translate-middle-y ms-3 ms-sm-4 hover-effect-target opacity-0">
          <button type="button" class="btn btn-prev btn-icon btn-secondary bg-body border-0 rounded-circle animate-slide-start" aria-label="Prev" data-bs-theme="light">
            <i class="fi-chevron-left fs-lg animate-target"></i>
          </button>
        </div>
        <div class="position-absolute top-50 end-0 z-2 translate-middle-y me-3 me-sm-4 hover-effect-target opacity-0">
          <button type="button" class="btn btn-next btn-icon btn-secondary bg-body border-0 rounded-circle animate-slide-end" aria-label="Next" data-bs-theme="light">
            <i class="fi-chevron-right fs-lg animate-target"></i>
          </button>
        </div>
      </div>

      <!-- Thumbnails slider -->
      <div class="swiper swiper-load swiper-thumbs pt-2 mt-1" id="thumbs" data-swiper="{
              &quot;loop&quot;: true,
              &quot;spaceBetween&quot;: 16,
              &quot;slidesPerView&quot;: 3,
              &quot;watchSlidesProgress&quot;: true,
              &quot;breakpoints&quot;: {
                &quot;340&quot;: {
                  &quot;slidesPerView&quot;: 4
                },
                &quot;500&quot;: {
                  &quot;slidesPerView&quot;: 5
                },
                &quot;600&quot;: {
                  &quot;slidesPerView&quot;: 6
                },
                &quot;768&quot;: {
                  &quot;slidesPerView&quot;: 4
                },
                &quot;992&quot;: {
                  &quot;slidesPerView&quot;: 5
                },
                &quot;1200&quot;: {
                  &quot;slidesPerView&quot;: 5
                }
              }
            }">
        <div class="swiper-wrapper">
          <?php foreach ($slides as $slide) : ?>
            <div class="swiper-slide swiper-thumb overflow-hidden">
              <div class="ratio bg-body-tertiary" style="--fn-aspect-ratio: calc(115 / 156 * 100%)">
                <img src="<?= $cld->image($slide->public_id) ?>" class="swiper-thumb-img" alt="Thumbnail" style="object-fit: cover">
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>

      <!-- Seller's description -->
      <h2 class="h3 pt-5 mt-sm-2">Description</h2>
      <div>
        <?= $item->description ?>
      </div>


      <div class="d-flex fs-sm text-body-secondary border-top pt-4 mt-4 mt-md-5">
        <div>Published: <span class="text-dark-emphasis"><?= date('d M Y, H:i', strtotime($item->created_at)); ?></span></div>
      </div>
    </div>

    <aside class="col-lg-4" style="margin-top: -110px">
      <div class="position-sticky top-0" style="padding-top: 110px">
        <div class="d-none d-lg-block">
          <div class="d-flex gap-2 pb-1 mb-2">
            <span class="badge text-bg-info d-inline-flex align-items-center">
              <?= $item->category_name ?>
            </span>
          </div>
          <div class="h2 pb-1 mb-2 price"><?= rupiah($item->display_price) ?></div>

          <?php if (count($variants) > 0) : ?>
            <div class="mb-4">
              <div class="d-flex flex-wrap gap-2">
                <?php foreach ($variants as $index => $val) : ?>
                  <button class="btn btn-sm btn-outline-secondary btn-variant <?= $index == '0' ? 'active-variant' : '' ?>" data-price="<?= $val->price ?>"><?= $val->variant ?></button>
                <?php endforeach ?>
              </div>
            </div>

          <?php endif ?>

          <div class="d-flex align-items-center gap-2">
            <!-- <div class="count-input">
              <button type="button" class="btn btn-icon" data-decrement aria-label="Decrement quantity">
                <i class="fi-minus"></i>
              </button>
              <input type="number" class="form-control" value="1" readonly>
              <button type="button" class="btn btn-icon" data-increment aria-label="Increment quantity">
                <i class="fi-plus"></i>
              </button>
            </div> -->
            <a class="btn btn-success w-100" target="_blank" href="https://api.whatsapp.com/send?phone=62<?= substr(setting('whatsapp_main')->value, 1) ?>&text=Halo%20CS%20Indopond%0A%0ASaya%20Mau%20Pesan%20<?= str_replace(" ", "%20", $item->name); ?>.">
              <i class="fi-whatsapp fs-base me-2"></i>
              Pesan Via Whatsapp
            </a>
          </div>

          <?php if ($item->embed_video_youtube) : ?>
            <div class="mt-4">
              <h4 class="h6">Youtube Video</h4>
              <?= $item->embed_video_youtube ?>
            </div>
          <?php endif ?>


        </div>
      </div>
    </aside>
  </div>
</section>


<!-- Similar listings -->
<section class="container py-2 py-sm-3 py-md-4 py-lg-5 my-xxl-3">
  <div class="d-flex align-items-start justify-content-between gap-4 pb-3 mb-2 mb-sm-3">
    <h2 class="mb-0">Other Item</h2>
    <div class="nav">
      <a class="nav-link position-relative text-nowrap py-1 px-0" href="<?= base_url('search?categories=' . $item->category_id) ?>">
        <span class="hover-effect-underline stretched-link me-1">View all</span>
        <i class="fi-chevron-right fs-lg"></i>
      </a>
    </div>
  </div>

  <?php if (count($other_item) > 0) : ?>
    <div class="swiper pb-5" data-swiper="{
          &quot;slidesPerView&quot;: 1,
          &quot;spaceBetween&quot;: 24,
          &quot;pagination&quot;: {
            &quot;el&quot;: &quot;.swiper-pagination&quot;,
            &quot;clickable&quot;: true
          },
          &quot;breakpoints&quot;: {
            &quot;550&quot;: {
              &quot;slidesPerView&quot;: 2
            },
            &quot;850&quot;: {
              &quot;slidesPerView&quot;: 3
            },
            &quot;1200&quot;: {
              &quot;slidesPerView&quot;: 4
            }
          }
        }">
      <div class="swiper-wrapper">

        <?php foreach ($other_item as $other) : ?>
          <div class="swiper-slide h-auto">
            <article class="card h-100 hover-effect-scale bg-body-tertiary border-0">
              <div class="card-img-top position-relative overflow-hidden">
                <div class="d-flex flex-column gap-2 align-items-start position-absolute top-0 start-0 z-1 pt-1 pt-sm-0 ps-1 ps-sm-0 mt-2 mt-sm-3 ms-2 ms-sm-3">
                  <span class="badge text-bg-warning"><?= $other->category_name ?></span>
                </div>
                <div class="ratio hover-effect-target" style="--fn-aspect-ratio: calc(204 / 306 * 100%)">
                  <img src="<?= $cld->image($other->thumbnail) ?>" alt="Image" style="object-fit: cover">
                </div>
              </div>
              <div class="card-body pb-3">

                <h3 class="h6 mb-2">
                  <a class="hover-effect-underline stretched-link me-1" href="<?= route_to('detail_item', encode($other->id)) ?>"><?= $other->name ?></a>
                </h3>
                <div class="h6 mb-0 text-success"><?= rupiah($other->display_price) ?></div>
              </div>
            </article>
          </div>
        <?php endforeach ?>
      </div>
      <div class="swiper-pagination position-static mt-3 mt-lg-4"></div>
    </div>
  <?php endif ?>

</section>
<?php $this->endSection(); ?>