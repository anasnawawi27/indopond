<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="PIXINVENT">
  <title><?php echo $title ?></title>
  <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
  <!-- <link rel="shortcut icon" type="image/x-icon" href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/app-assets/images/ico/favicon.ico"> -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">

  <!-- css template -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/vendors/css/vendors.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/vendors/css/forms/selects/select2.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/sweetalert2.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendors/pnotify/pnotify.custom.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap-extended.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/colors.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/components.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css') ?>">

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
  <?php $this->renderSection('plugin_css') ?>
  <?php $this->renderSection('custom_css') ?>
  <script>
    var siteUrl = '<?php echo base_url(); ?>';
    var slide_image_edit = null;
  </script>
  <?php if (isset($slide_image_edit)) : ?>
    <script>
      var slide_image_edit = JSON.parse('<?php echo json_decode($slide_image_edit); ?>');
    </script>
  <?php endif ?>
</head>
<?php ?>

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-secondary navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url() ?>"><img style="width: 106px;" class="brand-logo" alt="modern admin logo" src="<?php echo base_url() ?>/images/logo/logo.png">

            </a></li>
          <li class="nav-item d-none d-lg-block nav-toggle"></li>
          <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1 user-name text-bold-700"><?php echo $user->nama_lengkap ?></span>
                <?php $cld = new \Cloudinary\Cloudinary(CLD_CONFIG) ?>
                <span class="avatar avatar-online">
                  <div class="rounded-circle" style="width:36px; height:36px; background-image: url(<?php echo $user->image ? $cld->image($user->image) : "https://via.placeholder.com/30x30" ?>); background-size:cover; background-position:center"></div>
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item logout" href="javascript:void(0)"><i class="ft-power"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="navigation-header"><span></span></li>
        <li <?php echo $module == "user" && $menu == 'user' ?  'class="active"' : '' ?>>
          <a href="<?php echo route_to('user') ?>">
            <i class="la la-user"></i>
            <span class="menu-title"><?php echo lang('Users.heading') ?></span>
          </a>
        </li>
        <li <?php echo $module == "dealer" && $menu == 'dealer' ?  'class="active"' : '' ?>>
          <a href="<?php echo route_to('dealer') ?>">
            <i class="la la-building"></i>
            <span class="menu-title"><?php echo lang('Common.dealer') ?></span>
          </a>
        </li>
        <li <?php echo $module == "unit_types" && $menu == 'unit_types' ?  'class="active"' : '' ?>>
          <a href="<?php echo route_to('unit_types') ?>">
            <i class="la la-car"></i>
            <span class="menu-title"><?php echo lang('Common.unit_types') ?></span>
          </a>
        </li>
        <li <?php echo $module == "gallery" && $menu == 'gallery' ?  'class="active"' : '' ?>>
          <a href="<?php echo route_to('gallery') ?>">
            <i class="la la-image"></i>
            <span class="menu-title"><?php echo lang('Gallery.heading') ?></span>
          </a>
        </li>
        <li <?php echo $module == "banner" && $menu == 'banner' ?  'class="active"' : '' ?>>
          <a href="<?php echo route_to('banner') ?>">
            <i class="la la-file-image-o"></i>
            <span class="menu-title"><?php echo lang('Banner.heading') ?></span>
          </a>
        </li>

        <!-- Used -->
        <li <?php echo $module == "customer" && $menu == 'customer' ?  'class="active"' : '' ?>>
          <a href="<?php echo route_to('customer') ?>">
            <i class="la la-file-image-o"></i>
            <span class="menu-title"><?php echo lang('Customer.heading') ?></span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper p-0">
      <div class="content-header row"></div>
      <div class="content-body">
        <?php $this->renderSection('content') ?>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-psikotest" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      </div>
    </div>
  </div>

  <!-- js template -->
  <script src="<?php echo base_url() ?>/vendors/js/vendors.min.js"></script>
  <script src="<?php echo base_url() ?>/js/sweetalert2.min.js"></script>
  <script src="<?php echo base_url() ?>/vendors/js/forms/select/select2.full.min.js"></script>
  <script src="<?php echo base_url('vendors/pnotify/pnotify.custom.min.js'); ?>"></script>
  <script src="<?php echo base_url('vendors/js/extensions/moment.min.js'); ?>"></script>
  <script src="<?php echo base_url('vendors/feather-icons/feather.min.js'); ?>"></script>
  <script src="<?php echo base_url('js/jquery.number.min.js'); ?>"></script>
  <script src="<?php echo base_url() ?>/js/core/app-menu.min.js"></script>
  <script src="<?php echo base_url() ?>/js/core/app.min.js"></script>
  <script src="<?php echo base_url() ?>/js/app.js"></script>
  <script>
    let date = new Date('04:50:21', 'hh:mm')
    console.log(date)
  </script>
  <!-- <script src="<?php //echo base_url() 
                    ?>/js/scripts/extensions/ex-component-sweet-alerts.min.js"></script> -->

  <?php $this->renderSection('plugin_js') ?>
  <?php $this->renderSection('custom_js') ?>
  <script>
    <?php
    if (isset($_SESSION['form_response_status'])) {
      echo "new PNotify({text: '" . $_SESSION['form_response_message'] . "', type: '" . $_SESSION['form_response_status'] . "'});";
    }
    if ($alertStatus = session()->getFlashData('form_alert_status')) {
      $alertMessage = session()->getFlashData('form_alert_message');
      echo "Swal.fire({icon: '" . $alertStatus . "', html: '" . $alertMessage . "'})";
    }
    ?>
  </script>

</html>