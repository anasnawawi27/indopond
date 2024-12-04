<?php $this->extend('layout/default2') ?>
<?php $this->section('content')?>
<?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
<div class="section-title-page area-bg area-bg_dark area-bg_op_70" style="background: url('<?= base_url('front/assets') ?>/media/footer/bg.jpg'); background-size: cover; background-position: center;">
  <div class="area-bg__inner">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="b-title-page bg-primary_a">Galeri Pengiriman</h1>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="bg-grey">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="<?= base_url() ?>"><i class="icon fa fa-home"></i></a>
          </li>
          <li class="active">Galeri Pengiriman</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="section-isotope">
  <div class="b-isotope">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul class="b-isotope-filter list-inline">
            <li class="current">
              <a href="" data-filter="*">
                Kepercayaan Kustomer Semangat Kami!
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <ul class="b-isotope-grid grid list-unstyled">
      <li class="grid-sizer"></li>
      <?php foreach($galleries as $gallery) : ?>
      <li class="b-isotope-grid__item grid-item top mercedes">
        <a
          class="b-isotope-grid__inner js-zoom-images"
          href="<?= $cld->image($gallery->gambar) ?>"
        >
          <img
            src="<?= $cld->image($gallery->gambar) ?>"
            alt="foto"
          />
        </a>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
</section>
<?php $this->endSection(); ?>
