<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= BASEURL; ?>/img/LOGO.jpg" type="image/x-icon">
    <title><?= $data['title'] ?> - Aplikasi E-Sabililah</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/animate.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/select2/css/select2.min.css" />
    <linkrel="stylesheet" href="<?= BASEURL; ?>/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/style.css" />
    <link href="<?= BASEURL; ?>/css/sweetalert.css" rel="stylesheet" type="text/css">
    <script src="<?= BASEURL; ?>/js/sweetalert.min.js"></script>
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left active">
                <a href="index.html" class="logo">
                    <img src="<?= BASEURL; ?>/img/LOGO.jpg" alt="" />
                </a>
                <a href="index.html" class="logo-small">
                    <img src="<?= BASEURL; ?>/img/logo-small.png" alt="" />
                </a>
                <a id="toggle_btn" href="javascript:void(0);"> </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

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
                                    <h6>Hi, <?= ucfirst(explode(' ', $_SESSION['name'])[0]) ?></h6>
                                    <h5>Admin</h5>
                                </div>
                            </div>
                            <hr class="m-0" />
                            <a class="dropdown-item" href="profile.html">
                                <i class="me-2" data-feather="user"></i> My Profile</a>
                            <a class="dropdown-item" href="<?=BASEURL?>/admin/about"><i class="me-2" data-feather="book-open"></i>About Us</a>
                            <hr class="m-0" />
                            <a class="dropdown-item logout pb-0" href="<?=BASEURL?>/auth/logout"><img src="<?= BASEURL; ?>/plugins/img/log-out.svg" class="me-2" alt="img" />Logout</a>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="<?=BASEURL?>/admin/about">About Us</a>
                    <a class="dropdown-item" href="<?=BASEURL?>/auth/logout">Logout</a>
                </div>
            </div>
        </div>

       