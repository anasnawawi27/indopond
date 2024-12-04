<?php $this->extend('layout/default2') ?>
<?php $this->section('content')?>
<style>
  .b-car-info__desc {
    margin-bottom: 25px;
    padding: 40px 37px 23px;
    text-transform: uppercase;
  }

  .b-car-info__desc-dt {
    width: 130px;
    font-weight: 500;
    text-align: left;
    color: #888;
  }

  .b-car-info__desc-dd {
    margin-bottom: 22px;
    margin-left: 0;
    padding-bottom: 13px;
    padding-left: 130px;
    font-weight: 600;
    text-align: right;
    color: #222;
    border-bottom: 1px solid #ddd;
  }

  dt,
  dd {
    line-height: 1;
  }
</style>

<div class="section-title-page area-bg area-bg_dark area-bg_op_70" style="background: url('<?= base_url('front/assets') ?>/media/footer/bg.jpg'); background-size: cover; background-position: center;">
  <div class="area-bg__inner">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="b-title-page bg-primary_a">Daftar Harga</h1>
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
          <li class="active">Daftar Harga</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
<?php if($unit_types) : ?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <main class="l-main-content">
        <div class="goods-group-2 list-goods">
          <?php foreach($unit_types as $unit_type) : ?>
          <section class="b-goods-1">
            <div class="row">
              <div class="b-goods-1__img">
                <a
                  class="js-zoom-images"
                  href="<?= $cld->image($unit_type->gambar) ?>"
                >
                  <img
                    class="img-responsive"
                    src="<?= $cld->image($unit_type->gambar) ?>"
                    alt="foto"
                    style="width: 100%"
                  />
                </a>
                <h4 style="margin-top: 20px;"><?= $unit_type->tipe ?></h4>
              </div>
              <?php
              $db = db_connect();
              $units = $db->table('unit')->where('id_tipe', $unit_type->id)->get()->getResult();
              ?>
              <div class="b-goods-1__inner">
                <span class="b-goods-1__price hidden-th">
                  Tersedia <?= count($units) ?> Tipe
                </span>
                <div class="b-goods-1__info">
                  <dl class="b-car-info__desc dl-horizontal bg-grey" style="margin-top:30px">
                    <?php foreach($units as $unit) : ?>
                      <dt class="b-car-info__desc-dt"><?= $unit->nama_unit ?></dt>
                      <dd class="b-car-info__desc-dd"><?= number($unit->harga,0, 'Rp. ') ?></dd>
                    <?php endforeach ?>
                  </dl>
                </div>
              </div>
            </div>
          </section>
          <?php endforeach; ?>
        </div>
    </div>
  </div>
</div>
<?php endif ?>
<?php $this->endSection(); ?>
