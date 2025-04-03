<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= BASEURL; ?>/img/iconLogo.png">
    <title>Beranda - Aplikasi E-Sabililah</title>
    <!-- core CSS -->
    <link href="<?= BASEURL; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/animate.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/owl.carousel.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/owl.transitions.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/main.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="<?= BASEURL; ?>/img/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= BASEURL; ?>/img/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= BASEURL; ?>/img/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= BASEURL; ?>/img/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= BASEURL; ?>/img/apple-touch-icon-57-precomposed.png">
</head>

<body id="home" class="homepage">
    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= BASEURL; ?>/index.php">
                        <img class="navbar-icon" src="<?= BASEURL; ?>/img/iconLogo.png" alt="logo"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="scroll <?= $active === 'home' ? 'active' : ''; ?>"><a href="<?= BASEURL; ?>/index.php">Beranda</a></li>
                        <li class="scroll <?= $active === 'features' ? 'active' : ''; ?>"><a href="<?= BASEURL; ?>/index.php#features">Jadwal</a></li>
                        <li class="scroll <?= $active === 'services' ? 'active' : ''; ?>"><a href="<?= BASEURL; ?>/index.php#services">Prosedur</a></li>
                        <li class="scroll <?= $active === 'get-in-touch' ? 'active' : ''; ?>"><a href="<?= BASEURL; ?>/index.php#get-in-touch">Lokasi</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
