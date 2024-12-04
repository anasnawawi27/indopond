<?php $this->extend('layout/default2') ?>
<?php $this->section('content')?>
<?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
<div class="section-title-page area-bg area-bg_dark area-bg_op_70" style="background: url('<?= base_url('front/assets') ?>/media/footer/bg.jpg'); background-size: cover; background-position: center;">
  <div class="area-bg__inner">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="b-title-page bg-primary_a">Simulasi Kredit</h1>
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
          <li class="active">Simulasi Kredit</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="section-isotope">
  <div class="b-isotope">
    <div class="container">
      <form id="form-credit" class="b-calculator" style="margin-bottom: 25px;">
        <div class="b-calculator__header">
          <i class="icon flaticon-calculator text-primary"></i>
          <div class="b-calculator__header-inner">
            <div class="b-calculator__name">Simulasi Kredit</div>
          </div>
        </div>
        <div class="b-calculator__group">
          <div class="b-calculator__label">Nama Lengkap</div>
          <input
            class="b-calculator__input form-control"
            type="text"
            name="nama"
          />
        </div>
        <div class="b-calculator__group">
          <div class="b-calculator__label">No Handphone</div>
          <input
            class="b-calculator__input form-control"
            type="number"
            name="no_handphone"
          />
        </div>
        <div class="b-calculator__group">
          <div class="b-calculator__label">Email</div>
          <input
            class="b-calculator__input form-control"
            type="email"
            name="email"
          />
        </div>
        <div class="b-calculator__group">
          <div class="b-calculator__label">Tenor</div>
          <select
            class="b-calculator__input form-control"
            name="tenor"
          >
          <option hidden>Pilih Tenor</option>
          <option value="1 Tahun">1 Tahun</option>
          <option value="2 Tahun">2 Tahun</option>
          <option value="3 Tahun">3 Tahun</option>
          <option value="4 Tahun">4 Tahun</option>
          <option value="5 Tahun">5 Tahun</option>
          <option value="6 Tahun">6 Tahun</option>
        </select>
        </div>
        <div class="b-calculator__group">
          <div class="b-calculator__label">Tipe</div>
          <select
            class="b-calculator__input form-control"
            name="tipe_id"
          >
          <option hidden>Pilih Tipe</option>
          <?php foreach($unit_types as $type) : ?>
            <option value="<?= $type->id ?>"><?= $type->tipe ?></option>
          <?php endforeach ?>
        </select>
        </div>
        <button type="button" id="submit" class="btn btn-dark">Kirim </button>
      </form>
    </div>
  </div>
</section>
<?php $this->endSection(); ?>
