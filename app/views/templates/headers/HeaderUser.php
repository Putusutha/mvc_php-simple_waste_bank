<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?> - Aplikasi E-Sabililah</title>
    <link rel="shortcut icon" href="<?= BASEURL; ?>/img/LOGO.jpg" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/animate.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/headerUser.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/style.css" /> 
    <link href="<?= BASEURL; ?>/css/sweetalert.css" rel="stylesheet" type="text/css">
    <script src="<?= BASEURL; ?>/js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/<?=$data['file']?>.css" />
</head>

<body>

    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>

    <!-- Header -->
    <div class="header-user">
        <a class="icon-back" href="<?= BASEURL . $data['url'] ?>">
            <img class="header-logo" src="<?= BASEURL; ?>/img/arrow-left.svg" alt="">
        </a>
        <!-- Page title -->
        <h1 class="header-user-title"><?= $data['title'] ?></h1>
    </div>