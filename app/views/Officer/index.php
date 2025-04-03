<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="shortcut icon" href="<?= BASEURL; ?>/img/LOGO.jpg" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/homeOfficer.css">
    <link rel="shortcut icon" href="<?= BASEURL; ?>/img/LOGO.jpg" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/animate.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/css/style.css" />
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>

    <main class="container">
        <!-- Header section -->
        <header class="header-officer">
            <div class="greeting-header">
                <h1>Selamat Datang</h1>
                <p>Siap menjaga kelestarian bumi dengan mengambil sampah warga pada hari ini?</p>
                <a class="logout" href="<?= BASEURL; ?>/auth/logout">Logout</a>
            </div>
            <div class="illustration">
                <img class="logo" src="<?= BASEURL; ?>/img/ilustrastion_petugas.png" width="30%">
            </div>
        </header>


        <!--  Navigation menu -->
        <nav class="menu-nav">
            <div class="card-group">
                <a href="<?= BASEURL; ?>/officer/profile" class="card-menu">
                    <div class="icon-card">
                        <img class="icon-card-img" src="<?= BASEURL; ?>/img/person.png" alt="Profile">
                    </div>
                    <p class="teks">Profil</p>
                </a>
                <a href="<?= BASEURL; ?>/officer/pickup" class="card-menu">
                    <div class="icon-card">
                        <img class="icon-card-img" src="<?= BASEURL; ?>/img/delivery-truck.png" alt="Jemput">
                    </div>
                    <p class="teks">Jemput</p>
                </a>
                <a href="<?= BASEURL; ?>/officer/guide" class="card-menu">
                    <div class="icon-card">
                        <img class="icon-card-img" src="<?= BASEURL; ?>/img/questions.png" alt="Laporan">
                    </div>
                    <p class="teks">Panduan</p>
                </a>
                <a href="<?= BASEURL; ?>/officer/about" class="card-menu">
                    <div class="icon-card">
                        <img class="icon-card-img" src="<?= BASEURL; ?>/img/info.png" alt="Info">
                    </div>
                    <p class="teks">About</p>
                </a>
            </div>
        </nav>

        <!-- Content section -->
        <section class="content">
            <article class="text-content">
                <h1>Jaga bumi dan dia akan menjagamu</h1>
                <p>Di dalam rimba, pesona tak terungkap,
                    Gunung menjulang, sungai mengalir tiada henti,
                    Langit biru, bintang menyinari malam,
                    Di sana, keindahan alam mengundang hati untuk terpaku. Pelajari alam, dicintai alam, berdekatlah dengan alam karena alam tidak pernah mengecewakan.</p>
            </article>
            <div class="image-content">
                <img src="<?= BASEURL; ?>/img/ilustration-sampah.png" alt="Illustration Sampah">
            </div>
        </section>
    </main>  
</body>
<script src="<?= BASEURL; ?>/plugins/js/jquery-3.6.0.min.js"></script>
<script src="<?= BASEURL; ?>/plugins/js/feather.min.js"></script>
<script src="<?= BASEURL; ?>/plugins/js/jquery.slimscroll.min.js"></script>
<script src="<?= BASEURL; ?>/plugins/js/jquery.dataTables.min.js"></script>
<script src="<?= BASEURL; ?>/plugins/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BASEURL; ?>/plugins/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL; ?>/plugins/apexchart/apexcharts.min.js"></script>
<script src="<?= BASEURL; ?>/plugins/apexchart/chart-data.js"></script>
<script src="<?= BASEURL; ?>/plugins/js/script.js"></script>
</html>