<?php $this->extend('layout/default2') ?>
<?php $this->section('content')?>
<?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
<?php if($banners) : ?>
<div class="main-slider main-slider-1">
    <div
        class="slider-pro"
        id="main-slider"
        data-slider-width="100%"
        data-slider-height="700px"
        data-slider-arrows="true"
        data-slider-buttons="false"
    >
        <div class="sp-slides">
            <?php foreach($banners as $banner) : ?>
                <div class="sp-slide">
                    <img
                        class="sp-image"
                        src="<?= $cld->image($banner->gambar) ?>"
                        alt="slider"
                        style="width: 100% !important; height: auto !important"
                    />
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php endif ?>

<section class="section-type-2">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="section-type-2__img">
                    <img class="img-responsive" src="<?= $cld->image($profile->image) ?? 'https://via.placeholder.com/500x500' ?>" alt="foto">
                </div>
            </div>
            <div class="col-md-9">
                <div class="section-type-2__inner">
                    <div class="section-type-2__subtitle">
                        <?= $profile->deskripsi ?>
                    </div>

                    <h3>Info lebih lanjut hubungi</h3>
                    <div class="b-about-main__btns" style="margin-top:15px">
                        <a class="btn btn-primary"  href="tel:<?= $profile->no_telepon ?>">
                            <i class="icon fa fa-phone" style="font-size: 3rem; margin-top: 3px; margin-left: 5px"></i>
                        </a>
                        <a class="btn btn-primary" href="https://web.whatsapp.com/send?phone=<?= str_replace('+', '', $profile->whatsapp) ?>">
                            <i class="fa fa-whatsapp" style="font-size: 3rem; margin-top: 3px"></i>
                        </a>
                        <a class="btn btn-primary" href="mailto:<?= $profile->email ?>">
                            <i class="icon fa fa-envelope-o" style="font-size: 3rem; margin-top: 3px; margin-left: 3px"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-rent area-bg parallax" style="background-image: url(<?= base_url('front/assets') ?>/media/content/bg/bg-10.jpg)">
    <div class="area-bg__inner" style="z-index:1">
        <div class="section-rent__inner">
            <h2 class="ui-title-block">Dealer <?= getDealer('dealer_name') ?></h2>
            <div class="ui-decor"></div>
            <div class="ui-subtitle-block">
                <p><?= getDealer('company_name') ?></p>
                <div style="color:white">
                    <?= getDealer('dealer_address') ?>
                </div>
            </div>
        </div>
        <div class="rent-carousel">
            <div>
            <?= getDealer('embed_map') ?>
            </div>
        </div>
    </div>
</section>

<?php if($unit_types) : ?>
<section class="section-default">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="text-center">
          <h2 class="ui-title-block">Daftar Produk</h2>
          <div class="ui-decor"></div>
        </div>
      </div>
    </div>
  </div>
  <div
    class="featured-carousel owl-carousel owl-theme owl-theme_w-btn enable-owl-carousel"
    data-min768="2"
    data-min992="3"
    data-min1200="5"
    data-margin="30"
    data-pagination="false"
    data-navigation="true"
    data-auto-play="4000"
    data-stop-on-hover="true"
  >
    <?php foreach($unit_types as $unit_type) : ?>
      <a href="<?= route_to('detail_produk', encode($unit_type->id)) ?>">
        <div class="b-goods-feat">
          <div class="b-goods-feat__img">
            <img
              class="img-responsive"
              src="<?= $cld->image($unit_type->gambar) ?>"
              alt="foto"
            />
            <span class="b-goods-feat__label">
              DP <?= $unit_type->dp ?> Juta
            </span>
          </div>
  
          <h3 class="b-goods-feat__name">
            <?= $unit_type->tipe ?>
          </h3>
          <ul class="b-goods-feat__desc list-unstyled">
            <li class="b-goods-feat__desc-item">Tersedia <?= $unit_type->total_unit ?> Tipe</li>
          </ul>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>
<?php endif ?>
<?php $this->endSection(); ?>
