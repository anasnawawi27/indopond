<?php $this->extend('layout/auth') ?>
<?php $this->section('content') ?>
<div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
    <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
        <div class="card-header border-0">
            <div class="card-title text-center">
                <img class="w-50" src="<?php echo base_url('assets/images/logo/indopond-logo.svg') ?>" alt="branding logo">
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="mt-2" id="message"></div>
                <form class="form-horizontal" id="login" method="post">
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" name="username" placeholder="<?php echo lang('Auth.username') ?>">
                        <div class="form-control-position">
                            <i class="la la-user"></i>
                        </div>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control" name="password" placeholder="<?php echo lang('Auth.password') ?>">
                        <div class="form-control-position">
                            <i class="la la-key"></i>
                        </div>
                    </fieldset>
                    <button type="submit" name="submit" class="btn btn-danger btn-lighten-5 text-white btn-block btn-glow btn-shadow submit">
                        <i class="ft-unlock"></i> <?php echo lang('Auth.btn_login') ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>

<?php $this->section('custom_js'); ?>
<script src="<?php echo base_url('js/modules/auth.js?v=' . $_ENV['ASSETV']); ?>"></script>
<?php $this->endSection(); ?>