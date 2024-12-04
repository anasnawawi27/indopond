<!DOCTYPE html>
<html lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?= $title ?></title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="HandheldFriendly" content="true" />
    <link rel="stylesheet" href="<?= base_url('front/assets') ?>/css/master.css" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url() ?>/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url() ?>/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url() ?>/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url() ?>/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url() ?>/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url() ?>/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url() ?>/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url() ?>/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>/favicon/favicon-16x16.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/sweetalert2.min.css">
    <script>
      var siteUrl = '<?php echo base_url(); ?>';
    </script>
    <style>
      
      .section-type-2__subtitle {
        margin-bottom: 20px;
        font-family: Poppins;
        font-size: 18px;
        font-weight: 300;
        color: #222;
    }

    .floating-action{
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      /* height: 56px; */
      width: 100%;
      z-index: 2;
      background: black;
      text-align: center;
    }

    .floating-action a{
      margin-top: 4px; width: calc(100%/3.1)
    }

    .spinner-border {
      width: 2rem;
      height: 2rem;
      border: 0.25em solid currentColor;
      border-right-color: transparent;
      border-radius: 50%;
      animation: spinner-border 0.75s linear infinite;
    }
    .spinner-border-sm {
      width: 1rem;
      height: 1rem;
      border-width: 0.2em;
    }

    .spinner-border {
      display: inline-block;
      vertical-align: text-bottom;
    }
    @keyframes spinner-border {
      to {
        transform: rotate(360deg);
      }
    }

    </style>
  </head>

  <body>
    <!-- Loader-->
    <div id="page-preloader">
      <span class="spinner border-t_second_b border-t_prim_a"></span>
    </div>

    <div data-off-canvas="mobile-slidebar left overlay">
      <a class="navbar-brand scroll" href="<?= route_to('home') ?>">
        <img
          class="normal-logo img-resonsive visible-xs visible-sm"
          src="<?= base_url('front/assets') ?>/media/general/logo.png"
          alt="logo"
          style="width: 155px; margin-left: 15px; margin-bottom: 30px;"
        />
        <img
          class="scroll-logo img-resonsive hidden-xs hidden-sm"
          src="<?= base_url('front/assets') ?>/media/general/logo-dark.png"
          alt="logo"
          style="width: 155px; margin-left: 15px;margin-bottom: 30px;"
        />
      </a>     

      <ul class="nav navbar-nav">
        <li><a href="<?= route_to('home') ?>">Beranda</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" href="#" data-toggle="dropdown">
            Produk<b class="caret"></b>
          </a>
          <?php 
            $db = db_connect();
            $unitTypes = $db->table('tipe_unit')->get()->getResult();
          ?>
          <ul class="dropdown-menu" role="menu">
            <?php foreach($unitTypes as $type) : ?>
              <li><a href="<?= route_to('detail_produk', encode($type->id)) ?>" tabindex="-1"><?= $type->tipe ?></a></li>
            <?php endforeach?>
          </ul>
        </li><li><a href="<?= route_to('pricelist') ?>">Daftar Harga</a></li>
        <li><a href="<?= route_to('gallery_delivery') ?>">Gallery Pengiriman</a></li>
      </ul>
    </div>
    <div
      class="l-theme animated-css"
      data-header="sticky"
      data-header-top="200"
      data-canvas="container"
    >
      <header class="header header-boxed-width navbar-fixed-top header-background-white header-color-black header-topbar-dark header-logo-black header-topbarbox-1-left header-topbarbox-2-right header-navibox-1-left header-navibox-2-right header-navibox-3-right header-navibox-4-right">
          <div class="container container-boxed-width">
              <div class="top-bar">
                  <div class="container">
                      <div class="header-topbarbox-1">
                          <ul>
                              <li>
                                  <i class="icon fa fa-clock-o"></i>
                                  <?= getDealer('dealer_name') ?> : <?= getDealer('working_time') ?> WIB
                              </li>
                              <li>
                                  <i class="icon fa fa-phone"></i>
                                  <a href="tel:<?= $profile->no_telepon ?>"><?= $profile->no_telepon ?></a>
                              </li>
                              <li>
                                  <i class="icon fa fa-whatsapp"></i>
                                  <a href="https://web.whatsapp.com/send?phone=<?= str_replace('+', '', $profile->whatsapp) ?>"><?= $profile->whatsapp ?></a>
                              </li>
                              <li>
                                  <i class="icon fa fa-envelope-o"></i>
                                  <a href="mailto:<?= $profile->email ?>"><?= $profile->email ?></a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
              <nav class="navbar" id="nav">
                  <div class="container">
                      <div class="header-navibox-1">

                      <button class="menu-mobile-button visible-xs-block js-toggle-mobile-slidebar toggle-menu-button">
                          <i class="toggle-menu-button-icon"
                          ><span></span><span></span><span></span><span></span
                          ><span></span><span></span
                          ></i>
                      </button>

                      <a class="navbar-brand scroll" href="<?= route_to('home') ?>">
                          <img
                              class="normal-logo img-responsive"
                              src="<?= base_url('front/assets') ?>/media/general/logo.png"
                              alt="logo"
                          />
                          <img
                              class="scroll-logo hidden-xs img-responsive"
                              src="<?= base_url('front/assets') ?>/media/general/logo-dark.png"
                              alt="logo"
                              style="height: 50px"
                          />
                      </a>
                      </div>
                      <div class="header-navibox-2">
                          <ul class="yamm main-menu nav navbar-nav">
                              <li><a href="<?= route_to('home') ?>">Beranda</a></li>
                              <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                  Produk<b class="caret"></b>
                                </a>
                                <?php 
                                  $db = db_connect();
                                  $unitTypes = $db->table('tipe_unit')->get()->getResult();
                                ?>
                                <ul class="dropdown-menu" role="menu">
                                  <?php foreach($unitTypes as $type) : ?>
                                    <li><a href="<?= route_to('detail_produk', encode($type->id)) ?>" tabindex="-1"><?= $type->tipe ?></a></li>
                                  <?php endforeach?>
                                </ul>
                              </li>
                              <li><a href="<?= route_to('pricelist') ?>">Daftar Harga</a></li>
                              <li><a href="<?= route_to('gallery_delivery') ?>">Gallery Pengiriman</a></li>
                          </ul>
                      </div>
                  </div>
              </nav>
          </div>
      </header>
      
      <?php $this->renderSection('content') ?>
      <div class="floating-action">
          <a class="btn btn-primary"  href="tel:<?= $profile->no_telepon ?>">
              <i class="icon fa fa-phone" style="font-size: 3rem; margin-top: 3px; margin-left: 5px"></i>
          </a>
          <a class="btn btn-primary" href="https://web.whatsapp.com/send?phone=<?= str_replace('+', '', $profile->whatsapp) ?>">
              <i class="fa fa-whatsapp" style="font-size: 3rem; margin-top: 3px"></i>
          </a>
          <a class="btn btn-primary" href="<?= route_to('credit') ?>">
              <i class="icon flaticon-calculator" style="font-size: 2.5rem; margin-left: 3px"></i>
            </a>
      </div>
      <footer class="footer area-bg" style="background: url('<?= base_url('front/assets') ?>/media/footer/bg.jpg');background-position: center">
        <div class="area-bg__inner">
          <div class="footer__main">
            <div class="container">
              <div class="row">
                <div class="col-md-3">
                  <div class="footer-section">
                    <a class="footer__logo" href="<?= route_to('home') ?>">
                      <img
                        class="img-responsive"
                        src="<?= base_url('front/assets') ?>/media/general/logo.png"
                        alt="Logo"
                        style="    width: 200px;"
                      />
                    </a>
                    <section class="footer-section">
                      <div class="footer-contact footer-contact_lg">
                        Hubungi Kami<span class="text-primary"> <?= $profile->no_telepon ?></span>
                      </div>
                      <div class="footer-contact">
                        <i class="icon icon-xs fa fa-envelope-o"></i>
                        <?= $profile->email ?>
                      </div>
                      <div class="footer-contact">
                        <i class="icon icon-lg fa fa-map-marker"></i><?= getDealer('dealer_name') ?>
                      </div>
                      <div class="footer-contact">
                        <i class="icon fa fa-clock-o"></i><?= getDealer('working_time') ?>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="copyright">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  Copyrights &copy; <?= date('Y') ?> | Develop By Nas Dev
                </div>
              </div>
            </div>
          </div>
          <span class="btn-up" id="toTop">TOP</span>
        </div>
      </footer>
    </div>

    <script src="<?= base_url('front/assets') ?>/libs/jquery-1.12.4.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/libs/jquery-migrate-1.2.1.js"></script>
    <script src="<?= base_url('front/assets') ?>/libs/bootstrap/bootstrap.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/js/custom.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/headers/slidebar.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/headers/header.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/switcher/js/dmss.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/jqBootstrapValidation.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/isotope/imagesLoaded.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/rendro-easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/rendro-easy-pie-chart/waypoints.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/noUiSlider/nouislider.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/noUiSlider/wNumb.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/scrollreveal/scrollreveal.min.js"></script>
    <script src="<?= base_url('front/assets') ?>/plugins/slider-pro/jquery.sliderPro.js"></script>
    <script src="<?php echo base_url() ?>/js/sweetalert2.min.js"></script>
    <script>
      $('#submit').on('click', function(){
        var loadingButtonText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span style="display:inline-block; margin-left:5px">Loading...</span>';
        const form = $('#form-credit').serializeArray();
        $(this).attr('disabled', true)
        $(this).html(loadingButtonText)

        $.ajax({
          type: 'post',
          data: form,
          url: siteUrl + 'simulasi-kredit',
          success: function(res){
            console.log(res)
            response = JSON.parse(res);
            if (response.redirect) {
              window.location = response.redirect;
            } else {
              if (response.message) {
                if (response.status == "success") {
                  successMessage(response.message);
                } else if (response.status == "error") {
                  errorMessage(response.message);
                }

                $('#submit').removeAttr('disabled')
                $('#submit').html("Kirim")
              }
            }
          }
        })
      })

      function successMessage(message) {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 6000,
        });
        Toast.fire({
          icon: "success",
          title: message,
        });
      }

      function errorMessage(message = "") {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          html: message ? message : "Something went wrong!",
        });
      }
    </script>
    <script>
    <?php
    if ($alertStatus = session()->getFlashData('form_alert_status')) {
      $alertMessage = session()->getFlashData('form_alert_message');
      echo "Swal.fire({icon: '" . $alertStatus . "', html: '" . $alertMessage . "'})";
    }
    ?>
  </script>
  </body>
</html>
