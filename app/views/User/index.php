<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Aplikasi E-Sabililah</title>
  <link rel="shortcut icon" href="<?= BASEURL; ?>/img/LOGO.jpg" type="image/x-icon">
  <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/animate.css" />
  <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/select2/css/select2.min.css" />
  <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/fontawesome/css/fontawesome.min.css" />
  <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/fontawesome/css/all.min.css" />
  <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/style.css" />
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/homeUser.css">
</head>

<body>
  <div id="global-loader">
    <div class="whirly-loader"></div>
  </div>

  <!-- Header Section -->
  <div class="header">
    <div class="logo-header">
      <div class="brand">
        <img class="brand-logo" src="<?= BASEURL; ?>/img/LOGO.jpg" alt="logo" />
      </div>
    </div>
    <ul class="nav user-menu">
      <li class="nav-item dropdown">
      <li class="nav-item dropdown has-arrow main-drop">
        <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
          <span class="user-img"><img src="<?= BASEURL; ?>/img/user.png" alt="" />
            <span class="status online"></span></span>
        </a>
        <div class="dropdown-menu menu-drop-user">
          <div class="profilename">
            <div class="profileset">
              <span class="user-img"><img src="<?= BASEURL; ?>/img/user.png" alt="" />
                <span class="status online"></span></span>
              <div class="profilesets">
                <h6>Hi, <?= ucfirst(explode(' ', $data['name'])[0]) ?></h6>
                <h5>Warga</h5>
              </div>
            </div>
            <hr class="m-0" />
            <a class="dropdown-item" href="<?= BASEURL; ?>/user/profile">
              <i class="me-2" data-feather="user"></i> My Profile</a>
            <a class="dropdown-item" href="<?= BASEURL; ?>/user/about"><i class="me-2" data-feather="book-open"></i>About Us</a>
            <hr class="m-0" />
            <a class="dropdown-item logout pb-0" href="<?=BASEURL?>/auth/logout"><img src="<?= BASEURL; ?>/plugins/img/log-out.svg" class="me-2" alt="img" />Logout</a>
          </div>
        </div>
      </li>
    </ul>

    <div class="dropdown mobile-user-menu">
      <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="<?= BASEURL; ?>/user/profile">My Profile</a>
        <a class="dropdown-item" href="<?= BASEURL; ?>/user/about">About Us</a>
        <a class="dropdown-item" href="<?=BASEURL?>/auth/logout">Log out</a>
      </div>
    </div>
  </div>

  <!-- Main Wrapper -->
  <div class="wrapper">
    <!-- Earning Section -->
    <div class="earning">
      <h1>Saldo Anda</h1>
      <div class="card-total-earning">
        <div class="nominal">
          <span class="currency">Rp. <?php echo " " . number_format(floatval($data['balance']), 2, ",", "."); ?></span>
          <span class="total-earning"></span>
        </div>
        <a href="#" class="withdraw-balance">Tarik Saldo </a>
      </div>
    </div>

    <!-- Navigation Cards -->
    <div class="card-navigation">
      <a href="<?= BASEURL; ?>/user/sell" class="card-menu">
        <div class="card-icon" id="exchange">
          <img class="icon-image" src="<?= BASEURL; ?>/img/selling.png" alt="Tukar">
        </div>
        <p>Tukar</p>
      </a>
      <a href="<?= BASEURL; ?>/user/history" class="card-menu">
        <div class="card-icon" id="history">
          <img class="icon-image" src="<?= BASEURL; ?>/img/time-past.png" alt="Riwayat">
        </div>
        <p>Riwayat</p>
      </a>
      <a href="<?= BASEURL; ?>/user/guide" class="card-menu">
        <div class="card-icon" id="info">
          <img class="icon-image" src="<?= BASEURL; ?>/img/questions.png" alt="Informasi">
        </div>
        <p>Panduan</p>
      </a>
    </div>
  </div>

  <!-- Main Content Section -->
  <div class="content">
    <div class="card-content">
      <div class="text-card-content">
        <div class="title-card">
          <h1>Ubahlah Sampah Anorganik Anda Menjadi Uang Sekarang!</h1>
        </div>
        <div class="description-card">Terdapat beberapa pilihan kategori sampah yang dapat anda tukar. Untuk melihat info lebih lanjut, anda bisa melihat halaman panduan untuk langkah langkah dan kategori sampah yang dapat ditukar.</div>
      </div>
      <div class="illustration-card">
        <img src="<?= BASEURL; ?>/img/ilustration-trashcan.png" alt="Ilustrasi Tempat Sampah">
      </div>
    </div>
  </div>

  <script src="<?= BASEURL; ?>/plugins/js/jquery-3.6.0.min.js"></script>
  <script src="<?= BASEURL; ?>/plugins/js/feather.min.js"></script>
  <script src="<?= BASEURL; ?>/plugins/js/jquery.slimscroll.min.js"></script>
  <script src="<?= BASEURL; ?>/plugins/js/jquery.dataTables.min.js"></script>
  <script src="<?= BASEURL; ?>/plugins/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= BASEURL; ?>/plugins/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASEURL; ?>/plugins/apexchart/apexcharts.min.js"></script>
  <script src="<?= BASEURL; ?>/plugins/apexchart/chart-data.js"></script>
  <script src="<?= BASEURL; ?>/plugins/js/script.js"></script>
</body>

</html>