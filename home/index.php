<?php
session_start();
require '../config.php';
require '../lib/database.php';

if (isset($_SESSION['user'])) {
    header("Location: " . $config['web']['url']);
} else {

    //Count Users
    $total_pengguna = mysqli_num_rows($conn->query("SELECT * FROM users"));

    //Total Pemesanan
    $total_pemesanan_sosmed = $conn->query("SELECT SUM(harga) AS total FROM pembelian_sosmed");
    $data_pesanan = $total_pemesanan_sosmed->fetch_assoc();

    //Total Layanan
    $total_layanan = mysqli_num_rows($conn->query("SELECT * FROM layanan_sosmed"));
   // background-image: linear-gradient(130deg, #4922b3 15%, #5b2be0 40%, #5b2be0 60%, #7c55e6 100%) !important;
?>
    <!doctype html>
    <html lang="en" data-bs-theme="light">

    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Title  -->
        <title><?php echo $data['short_title']; ?></title>
        <meta name="author" content="<?php echo $data['short_title']; ?>">
        <meta name="keywords" content="social media marketing, smm panel indonesia, panel sosmed, panel social media, tambah followers instagram, panel sosial media, autolikes instagram, panel sosial media terbaik, panel sosial media termurah, jasa tambah followers">

        <!--Plugins Styles-->
        <link rel="stylesheet" href="/home/src/plugins/aos/dist/aos.css">
        <link rel="stylesheet" href="/home/src/plugins/lightgallery.min.css">
        <link rel="stylesheet" href="/home/src/plugins/flickity/dist/flickity.min.css">

        <!--Styles-->
        <link rel="stylesheet" href="/home/src/css/theme.css">

        <!-- PWA Optimize -->
        <link rel="manifest" href="/home/src/js/pwa/manifest.json">
        <meta name="theme-color" content="#5b2be0">
        <link rel="apple-touch-icon" href="<?php echo $data['logo_web']; ?>">

        <!-- google font -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&amp;display=swap" rel="stylesheet">

        <!-- Favicon  -->
        <link rel="icon" href="<?php echo $data['logo_web']; ?>">
    </head>

    <body id="top">
        <!--Skippy-->
        <a id="skippy" class="visually-hidden-focusable" href="#content">
            <div class="container">
                <span class="skiplink-text">Skip to main content</span>
            </div>
        </a>

        <!-- progress scroll -->
        <progress id="progress-bar" class="progress-one" max="100">
            <span class="progress-container">
                <span class="progress-bar"></span>
            </span>
        </progress>

        <!-- ========== { HEADER }==========  -->
        <header>
            <!-- Navbar -->
            <nav class="main-nav navbar navbar-expand-lg hover-navbar dark-to-light fixed-top navbar-dark">
                <div class="container">
                    <a class="navbar-brand main-logo" href="#">
                        <!-- <span class="h2 text-white fw-bold mt-2">Onekit</span> -->
                        <img class="logo-light" src="<?php echo $data['logo_web']; ?>" alt="LOGO">
                        <img class="logo-dark" src="<?php echo $data['logo_web']; ?>" alt="LOGO">
                    </a>

                    <!-- navbar toggler -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo" aria-controls="navbarTogglerDemo" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- collapse menu -->
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="/">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/halaman/daftar-harga.php">Harga Layanan</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarmd" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Lainnya</a>

                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-lg-center p-4" aria-labelledby="navbarmd">
                                    <div class="list-group list-group-flush">
                                        <a class="list-group-item dropdown-item bg-tansparent d-flex align-item-center" href="/halaman/kontak-kami">
                                            <!-- Icon -->
                                            <div class="align-self-center text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" viewBox="0 0 512 512">
                                                    <path d="M451,374c-15.88-16-54.34-39.35-73-48.76C353.7,313,351.7,312,332.6,326.19c-12.74,9.47-21.21,17.93-36.12,14.75s-47.31-21.11-75.68-49.39-47.34-61.62-50.53-76.48,5.41-23.23,14.79-36c13.22-18,12.22-21,.92-45.3-8.81-18.9-32.84-57-48.9-72.8C119.9,44,119.9,47,108.83,51.6A160.15,160.15,0,0,0,83,65.37C67,76,58.12,84.83,51.91,98.1s-9,44.38,23.07,102.64,54.57,88.05,101.14,134.49S258.5,406.64,310.85,436c64.76,36.27,89.6,29.2,102.91,23s22.18-15,32.83-31a159.09,159.09,0,0,0,13.8-25.8C465,391.17,468,391.17,451,374Z" style="fill:none;stroke:currentColor;stroke-miterlimit:10;stroke-width:32px" />
                                                </svg>
                                            </div>

                                            <!-- Content -->
                                            <div class="ms-4 align-self-center">
                                                <h6 class="text-uppercase mb-1">
                                                    Kontak
                                                </h6>
                                                <p class="text-muted mb-0">
                                                    Informasi Bantuan
                                                </p>
                                            </div>
                                        </a>

                                        <a class="list-group-item dropdown-item bg-tansparent d-flex align-item-center" href="/halaman/FAQ&TOS">
                                            <!-- Icon -->
                                            <div class="align-self-center text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" viewBox="0 0 512 512">
                                                    <polyline points="464 128 240 384 144 288" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                                    <line x1="144" y1="384" x2="48" y2="288" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                                    <line x1="368" y1="128" x2="232" y2="284" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                                </svg>
                                            </div>

                                            <!-- Content -->
                                            <div class="ms-4 align-self-center">
                                                <h6 class="text-uppercase mb-1">
                                                    FAQ & TOS
                                                </h6>
                                                <p class="text-muted mb-0">
                                                    Ketentuan Layanan
                                                </p>
                                            </div>
                                        </a>

                                        <a class="list-group-item dropdown-item bg-tansparent d-flex align-item-center" href="/halaman/api-dokumentasi-sosmed">
                                            <!-- Icon -->
                                            <div class="align-self-center text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512">
                                                    <polyline stroke="currentColor" points="160 368 32 256 160 144" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline>
                                                    <polyline stroke="currentColor" points="352 368 480 256 352 144" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline>
                                                    <line stroke="currentColor" x1="304" y1="96" x2="208" y2="416" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line>
                                                </svg>
                                            </div>

                                            <!-- Content -->
                                            <div class="ms-4 align-self-center">
                                                <h6 class="text-uppercase mb-1">
                                                    Api Dokumentasi
                                                </h6>
                                                <p class="text-muted mb-0">
                                                    Intregrasi Api
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="d-grid d-lg-block my-3 my-lg-0 ms-0 ms-lg-4">
                            <a class="btn btn-warning btn-sm" target="_blank" rel="noopener" href="/auth/login">
                                Masuk
                            </a>
                        </div>
                    </div><!-- end collapse menu -->
                </div>
            </nav><!-- End Navbar -->
        </header><!-- end header -->

        <!-- =========={ MAIN }==========  -->
        <main id="content">
            <!-- =========={ HERO }==========  -->
            <div id="hero" class="section bg-gradient-primary py-8 py-lg-9 overflow-hidden">
                <!-- background overlay -->
                <div class="overlay bg-gradient-primary opacity-90 z-index-n1"></div>

                <!-- rocket moving up animation -->
                <div class="particle">
                    <div class="particle-move-up d-none d-lg-block particle-move-up-1 text-light z-index-n1 opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                    </div>
                    <div class="particle-move-up particle-move-up-2 text-light z-index-n1 opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1rem" height="1rem" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                    </div>
                    <div class="particle-move-up d-none d-sm-block particle-move-up-3 text-light z-index-n1 opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1.2rem" height="1.2rem" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                    </div>
                    <div class="particle-move-up d-none d-xl-block particle-move-up-4 text-light z-index-n1 opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1rem" height="1rem" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                    </div>
                    <div class="particle-move-up d-none d-sm-block particle-move-up-5 text-light z-index-n1 opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1.2rem" height="1.2rem" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                    </div>
                    <div class="particle-move-up border-success text-light particle-move-up-6 z-index-n1 opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                    </div>
                    <div class="particle-move-up particle-move-up-7 z-index-n1 text-light opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1.2rem" height="1.2rem" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                    </div>
                    <div class="particle-move-up particle-move-up-8 z-index-n1 text-light opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1.2rem" height="1.2rem" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                    </div>
                    <div class="particle-move-up particle-move-up-9 z-index-n1 text-light opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        </svg>
                    </div>
                </div>

                <!-- scribble -->
                <figure class="scribble scale-4 opacity-10 top-50 start-0 z-index-n1" data-aos="fade-up-right" data-aos-delay="300">
                    <svg class="text-secondary" width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M42.5,-66.2C57.1,-56.7,72.5,-48.4,81.1,-35.3C89.8,-22.2,91.8,-4.4,89.6,13C87.3,30.4,80.7,47.4,69.5,60.1C58.3,72.9,42.4,81.5,25.9,84.6C9.5,87.8,-7.4,85.4,-22.7,79.8C-37.9,74.1,-51.5,65.2,-60.9,53.3C-70.4,41.4,-75.8,26.6,-79,10.8C-82.1,-5,-83.1,-21.7,-77.7,-36.4C-72.4,-51,-60.7,-63.7,-46.7,-73.5C-32.7,-83.3,-16.4,-90.1,-1.2,-88.2C13.9,-86.3,27.8,-75.7,42.5,-66.2Z" transform="translate(100 100)" />
                    </svg>
                </figure>

                <!-- scribble -->
                <figure class="scribble scale-5 opacity-10 top-50 start-0 z-index-n1" data-aos="fade-up-right" data-aos-delay="200">
                    <svg class="text-secondary" width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M42.5,-66.2C57.1,-56.7,72.5,-48.4,81.1,-35.3C89.8,-22.2,91.8,-4.4,89.6,13C87.3,30.4,80.7,47.4,69.5,60.1C58.3,72.9,42.4,81.5,25.9,84.6C9.5,87.8,-7.4,85.4,-22.7,79.8C-37.9,74.1,-51.5,65.2,-60.9,53.3C-70.4,41.4,-75.8,26.6,-79,10.8C-82.1,-5,-83.1,-21.7,-77.7,-36.4C-72.4,-51,-60.7,-63.7,-46.7,-73.5C-32.7,-83.3,-16.4,-90.1,-1.2,-88.2C13.9,-86.3,27.8,-75.7,42.5,-66.2Z" transform="translate(100 100)" />
                    </svg>
                </figure>

                <!-- scribble -->
                <figure class="scribble scale-6 opacity-10 top-50 start-0 z-index-n1" data-aos="fade-up-right" data-aos-delay="100">
                    <svg class="text-secondary" width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M42.5,-66.2C57.1,-56.7,72.5,-48.4,81.1,-35.3C89.8,-22.2,91.8,-4.4,89.6,13C87.3,30.4,80.7,47.4,69.5,60.1C58.3,72.9,42.4,81.5,25.9,84.6C9.5,87.8,-7.4,85.4,-22.7,79.8C-37.9,74.1,-51.5,65.2,-60.9,53.3C-70.4,41.4,-75.8,26.6,-79,10.8C-82.1,-5,-83.1,-21.7,-77.7,-36.4C-72.4,-51,-60.7,-63.7,-46.7,-73.5C-32.7,-83.3,-16.4,-90.1,-1.2,-88.2C13.9,-86.3,27.8,-75.7,42.5,-66.2Z" transform="translate(100 100)" />
                    </svg>
                </figure>

                <!-- scribble -->
                <figure class="scribble scale-7 opacity-10 top-50 start-0 z-index-n1" data-aos="fade-up-right">
                    <svg class="text-secondary" width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M42.5,-66.2C57.1,-56.7,72.5,-48.4,81.1,-35.3C89.8,-22.2,91.8,-4.4,89.6,13C87.3,30.4,80.7,47.4,69.5,60.1C58.3,72.9,42.4,81.5,25.9,84.6C9.5,87.8,-7.4,85.4,-22.7,79.8C-37.9,74.1,-51.5,65.2,-60.9,53.3C-70.4,41.4,-75.8,26.6,-79,10.8C-82.1,-5,-83.1,-21.7,-77.7,-36.4C-72.4,-51,-60.7,-63.7,-46.7,-73.5C-32.7,-83.3,-16.4,-90.1,-1.2,-88.2C13.9,-86.3,27.8,-75.7,42.5,-66.2Z" transform="translate(100 100)" />
                    </svg>
                </figure>

                <div class="container">
                    <!-- row -->
                    <div class="row justify-content-center">
                        <!-- hero content -->
                        <div class="col-md-9 col-lg-6 align-self-center pe-lg-5" data-aos="flip-up">
                            <div class="text-center text-lg-start mt-4 mt-lg-0">
                                <div class="mb-3">
                                    <span class="badge bg-secondary rounded">#</span>
                                    <span class="text-light ms-1">Smm Panel & PPOB Termurah Di Indonesia</span>
                                </div>
                                <div class="mb-5">
                                    <h1 class="display-5 fw-bold text-white mb-3"><span class="text-warning">No 1</span> <?php echo $data['title']; ?> <span data-toggle="typed" data-options='{"strings": ["Terpercaya", "Terlengkap", "Terbaik", "Di Indonesia"]}'></span>
                                    </h1>
                                    <p class="lead text-light"><?php echo $data['deskripsi_web']; ?></p>
                                </div>
                                <a class="btn btn-white hover-button-up" href="/auth/login">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                                        <path d="M304,336v40a40,40,0,0,1-40,40H104a40,40,0,0,1-40-40V136a40,40,0,0,1,40-40H256c22.09,0,48,17.91,48,40v40" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                        <polyline points="368 336 448 256 368 176" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                        <line x1="176" y1="256" x2="432" y2="256" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                    </svg> Masuk
                                </a>
                                <a class="btn btn-warning hover-button-up" href="/auth/register">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                                        <line x1="256" y1="112" x2="256" y2="400" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                        <line x1="400" y1="256" x2="112" y2="256" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                    </svg> Daftar
                                </a>
                            </div>
                        </div>
                        <!-- hero image -->
                        <div class="col-md-9 col-lg-6 align-self-center">
                            <div class="px-3 px-sm-7 px-md-2 px-xl-7 mt-5 mt-lg-0 mb-n9" data-aos="fade-up" data-aos-delay="100">
                                <img class="img-fluid animated-up-down" src="/home/src/astronauts.png" alt="images title">
                            </div>
                        </div>
                    </div><!-- end row -->
                </div>

                <!-- waves start -->
                <figure class="waves-bottom-center text-light-dark mb-lg-n4 z-index-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path class="opacity-20 translate-top-2" fill="currentColor" fill-opacity="1" d="M0,160L60,186.7C120,213,240,267,360,245.3C480,224,600,128,720,106.7C840,85,960,139,1080,149.3C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                        <path class="opacity-30 translate-top-1" fill="currentColor" fill-opacity="1" d="M0,160L60,186.7C120,213,240,267,360,245.3C480,224,600,128,720,106.7C840,85,960,139,1080,149.3C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                        <path fill="currentColor" fill-opacity="1" d="M0,160L60,186.7C120,213,240,267,360,245.3C480,224,600,128,720,106.7C840,85,960,139,1080,149.3C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                    </svg>
                </figure>
            </div><!-- end hero -->

            <!-- =========={ FEATURES }==========  -->
            <div id="features" class="section pt-5 pb-4 pb-md-5 bg-light-dark">
                <div class="container">
                    <div class="position-relative">
                        <!-- scribble -->
                        <figure class="scribble scale-2 d-none d-md-block top-0 end-0 mt-md-n4 mt-lg-n7 me-lg-7 z-index-n1">
                            <svg class="text-secondary opacity-90" width="76" height="72" viewBox="0 0 193.000000 184.000000" xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(0.000000,184.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none">
                                    <path d="M633 1723 c-3 -10 -19 -51 -35 -91 -33 -84 -34 -103 -10 -124 28 -24
                53 -29 88 -18 35 12 55 48 48 91 -2 13 -6 46 -9 72 -9 69 -65 117 -82 70z"></path>
                                    <path d="M1330 1613 c-27 -54 -49 -107 -48 -117 5 -37 47 -55 111 -47 80 10
                84 16 69 103 -15 85 -45 158 -66 158 -9 0 -36 -40 -66 -97z"></path>
                                    <path d="M973 1513 c-3 -10 -21 -54 -39 -98 -40 -95 -41 -109 -12 -129 29 -20
                143 -22 151 -3 6 16 1 48 -19 139 -20 86 -65 137 -81 91z"></path>
                                    <path d="M261 1328 c-5 -13 -21 -49 -35 -81 -32 -72 -33 -92 -2 -113 32 -20
                134 -10 144 14 10 28 -27 145 -55 174 -32 34 -41 35 -52 6z"></path>
                                    <path d="M605 1306 c-8 -19 -20 -66 -26 -106 -15 -91 -6 -103 79 -103 32 0 64
                3 71 8 19 11 9 72 -23 142 -46 100 -77 118 -101 59z"></path>
                                    <path d="M1319 1253 c-7 -15 -29 -66 -50 -111 -22 -46 -39 -89 -39 -96 0 -7
                11 -23 25 -36 22 -20 27 -22 55 -10 16 7 39 10 49 7 11 -3 28 1 37 8 16 11 17
                21 6 111 -16 129 -57 192 -83 127z"></path>
                                    <path d="M1680 1058 c-5 -13 -25 -63 -45 -113 -20 -49 -38 -95 -41 -102 -5
                -10 9 -27 48 -59 22 -18 124 -27 148 -14 18 9 21 18 17 43 -12 70 -48 204 -63
                235 -20 38 -50 42 -64 10z"></path>
                                    <path d="M903 901 c-27 -81 -28 -92 -16 -116 9 -17 20 -25 30 -21 8 3 29 6 47
                6 18 0 41 6 51 14 17 12 18 17 6 57 -54 181 -74 191 -118 60z"></path>
                                    <path d="M141 913 c-15 -30 -41 -125 -41 -153 0 -50 74 -87 114 -57 19 14 19
                20 8 102 -11 86 -29 125 -58 125 -7 0 -17 -8 -23 -17z"></path>
                                    <path d="M1324 813 c-4 -16 -17 -49 -30 -75 -28 -56 -29 -75 -6 -105 15 -20
                23 -21 67 -15 47 7 50 9 53 38 3 35 -24 152 -40 172 -17 20 -37 14 -44 -15z"></path>
                                    <path d="M537 688 c-20 -46 -37 -90 -37 -99 0 -22 26 -43 45 -35 8 3 15 1 15
                -4 0 -15 43 -12 84 5 43 18 45 34 15 123 -19 57 -47 92 -74 92 -6 0 -28 -37
                -48 -82z"></path>
                                    <path d="M995 620 c-7 -11 -55 -186 -55 -199 0 -17 42 -51 63 -51 42 0 96 21
                101 38 6 19 -29 135 -58 190 -16 32 -39 41 -51 22z"></path>
                                    <path d="M1379 330 c-25 -77 -31 -105 -23 -118 11 -18 56 -36 116 -47 32 -6
                36 -4 42 18 7 30 -20 180 -40 219 -10 18 -22 28 -38 28 -20 0 -27 -12 -57
                -100z"></path>
                                    <path d="M566 290 c-20 -51 -30 -113 -22 -144 7 -29 49 -46 112 -46 44 0 44 0
                44 35 0 40 -41 149 -67 177 -26 29 -49 22 -67 -22z"></path>
                                </g>
                            </svg>
                        </figure>
                    </div>

                    <!-- section header -->
                    <header class="text-center mx-auto mb-5">
                        <h2 class="h3 fw-bold">Tentang Kami</h2>
                        <hr class="divider my-4 mx-auto bg-warning border-warning">
                        <p class="lead text-muted">Mengapa Harus Memilih <?php echo $data['short_title']; ?></p>
                    </header>

                    <!-- row -->
                    <div class="row text-center">
                        <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up">
                            <!-- service block -->
                            <div class="p-4 mb-5 rounded-3 bg-body shadow-sm hover-box-up">
                                <div class="text-primary mb-3">
                                    <!-- icon -->
                                    <!-- <i class="fab fa-bootstrap"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                                        <path d="M39.93,149.25l197.4,95.32c5.14,2.45,12,3.73,18.79,3.73s13.65-1.28,18.78-3.73l197.4-95.32c10.38-5,10.38-13.18,0-18.2L274.9,35.73c-5.13-2.45-12-3.73-18.78-3.73s-13.65,1.28-18.79,3.73L39.93,131.05C29.55,136.07,29.55,144.23,39.93,149.25Z" />
                                        <path d="M472.3,246.9s-36.05-17.38-40.83-19.72-6.07-2.21-11.09.12-145.6,70.23-145.6,70.23A45.71,45.71,0,0,1,256,301.27c-6.77,0-13.65-1.29-18.78-3.74,0,0-136.85-66-143.27-69.18C87,225,85,225,78.67,228l-39,18.78c-10.38,5-10.38,13.19,0,18.2L237.1,360.3c5.13,2.45,12,3.73,18.78,3.73s13.65-1.28,18.79-3.73L472.07,265C482.68,260.08,482.68,251.92,472.3,246.9Z" />
                                        <path d="M472.3,362.75S436.25,345.37,431.47,343s-6.07-2.21-11.09.12S274.9,413.5,274.9,413.5a45.74,45.74,0,0,1-18.78,3.73c-6.77,0-13.65-1.28-18.79-3.73,0,0-136.85-66-143.26-69.18-7-3.39-9-3.39-15.29-.35l-39,18.78c-10.39,5-10.39,13.18,0,18.2l197.4,95.32c5.13,2.56,12,3.73,18.78,3.73s13.65-1.28,18.78-3.73L472.18,381C482.68,375.93,482.68,367.77,472.3,362.75Z" />
                                    </svg>
                                </div>
                                <h3 class="h5">Layanan Terbaik</h3>
                                <p class="text-muted">Kami menyediakan berbagai layanan terbaik untuk kebutuhan Anda seperti like, views, followers dll.</p>
                            </div> <!-- end service block -->
                        </div>

                        <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up" data-aos-delay="100">
                            <!-- service block -->
                            <div class="p-4 mb-5 rounded-3 bg-body shadow-sm hover-box-up">
                                <div class="text-primary mb-3">
                                    <!-- icon -->
                                    <!-- <i class="fab fa-"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                                        <path d="M112.91,128A191.85,191.85,0,0,0,64,254c-1.18,106.35,85.65,193.8,192,194,106.2.2,192-85.83,192-192,0-104.54-83.55-189.61-187.5-192A4.36,4.36,0,0,0,256,68.37V152" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                        <path d="M233.38,278.63l-79-113a8.13,8.13,0,0,1,11.32-11.32l113,79a32.5,32.5,0,0,1-37.25,53.26A33.21,33.21,0,0,1,233.38,278.63Z" />
                                    </svg>

                                </div>
                                <h3 class="h5">Proses Cepat & Otomatis</h3>
                                <p class="text-muted">Pesanan Di Proses Secara Otomatis dan Instant,langsung kepada Server kami.</p>
                            </div><!-- end service block -->
                        </div>

                        <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up" data-aos-delay="200">
                            <!-- service block -->
                            <div class="p-4 mb-5 rounded-3 bg-body shadow-sm hover-box-up">
                                <div class="text-primary mb-3">
                                    <!-- icon -->
                                    <!-- <i class="fab fa-npm"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                                        <rect x="48" y="96" width="416" height="320" rx="56" ry="56" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                        <line x1="48" y1="192" x2="464" y2="192" style="fill:none;stroke:currentColor;stroke-linejoin:round;stroke-width:60px" />
                                        <rect x="128" y="300" width="48" height="20" style="fill:none;stroke:currentColor;stroke-linejoin:round;stroke-width:60px" />
                                    </svg>

                                </div>
                                <h3 class="h5">Metode Deposit</h3>
                                <p class="text-muted">Berbagai metode deposit paling lengkap dan otomatis seperti BANK, QRIS dan EWALLET Lainya</p>
                            </div><!-- end service block -->
                        </div>

                        <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up">
                            <!-- service block -->
                            <div class="p-4 mb-5 rounded-3 bg-body shadow-sm hover-box-up">
                                <div class="text-primary mb-3">
                                    <!-- icon -->
                                    <!-- <i class="fab fa-bootstrap"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                                        <path d="M87.48,380c1.2-4.38-1.43-10.47-3.94-14.86A42.63,42.63,0,0,0,81,361.34a199.81,199.81,0,0,1-33-110C47.64,139.09,140.72,48,255.82,48,356.2,48,440,117.54,459.57,209.85A199,199,0,0,1,464,251.49c0,112.41-89.49,204.93-204.59,204.93-18.31,0-43-4.6-56.47-8.37s-26.92-8.77-30.39-10.11a31.14,31.14,0,0,0-11.13-2.07,30.7,30.7,0,0,0-12.08,2.43L81.5,462.78A15.92,15.92,0,0,1,76.84,464a9.61,9.61,0,0,1-9.58-9.74,15.85,15.85,0,0,1,.6-3.29Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" />
                                        <circle cx="160" cy="256" r="32" />
                                        <circle cx="256" cy="256" r="32" />
                                        <circle cx="352" cy="256" r="32" />
                                    </svg>
                                </div>
                                <h3 class="h5">Layanan Bantuan</h3>
                                <p class="text-muted">Kami siap 24/Jam online, untuk membantu anda jika mengalami masalah atau kesulitan lainnya melalui tiket bantuan / kontak yang di sediakan</p>
                            </div> <!-- end service block -->
                        </div>

                        <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up" data-aos-delay="100">
                            <!-- service block -->
                            <div class="p-4 mb-5 rounded-3 bg-body shadow-sm hover-box-up">
                                <div class="text-primary mb-3">
                                    <!-- icon -->
                                    <!-- <i class="fab fa-"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                                        <rect x="32" y="64" width="448" height="320" rx="32" ry="32" style="fill:none;stroke:currentColor;stroke-linejoin:round;stroke-width:32px" />
                                        <polygon points="304 448 296 384 216 384 208 448 304 448" style="stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                        <line x1="368" y1="448" x2="144" y2="448" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                        <path d="M32,304v48a32.09,32.09,0,0,0,32,32H448a32.09,32.09,0,0,0,32-32V304Zm224,64a16,16,0,1,1,16-16A16,16,0,0,1,256,368Z" />
                                    </svg>
                                </div>
                                <h3 class="h5">Desain Responsive</h3>
                                <p class="text-muted">Kami Menggunakan Desain Website Yang Dapat Diakses Dari Berbagai Device, Daik Smartphone Android Maupun Desktop.</p>
                            </div> <!-- end service block -->
                        </div>

                        <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up" data-aos-delay="200">
                            <!-- service block -->
                            <div class="p-4 mb-5 rounded-3 bg-body shadow-sm hover-box-up">
                                <div class="text-primary mb-3">
                                    <!-- icon -->
                                    <!-- <i class="fab fa-html5"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="3rem" height="3rem" fill="currentColor" viewBox="0 0 512 512">
                                        <polyline points="160 368 32 256 160 144" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                        <polyline points="352 368 480 256 352 144" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                        <line x1="304" y1="96" x2="208" y2="416" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                    </svg>

                                </div>
                                <h3 class="h5">Api Dokumentasi</h3>
                                <p class="text-muted">Kami Menyediakan / support pemesanan via API, Sangat Cocok Untuk Anda Pengguna H2H / operan..</p>
                            </div><!-- end service block -->
                        </div>

                    </div><!-- end row -->
                </div>
            </div><!-- End features -->

            <!-- =========={ STATISTIC }==========  -->
            <div id="counters" class="section pt-6 pt-md-7 pb-5 pb-md-6 bg-dark jarallax">
                <!-- background parallax -->
                <img class="jarallax-img" src="/home/src/bg-planet.jpg" alt="title">
                <!-- background overlay -->
                <div class="overlay bg-primary opacity-80 z-index-n1"></div>
                <!--DATA PENGGUNA REAL-->
                <!--<p><h3><span>89<?php echo $total_pengguna; ?></span></h3> Total Pengguna</p><br />
        <p><h3><span><?php echo number_format($data_pesanan_sosmed['total'], 0, ',', '.'); ?></span></h3> Total Pemesanan</p><br />
        <p><h3><span><?php echo $total_layanan; ?></span></h3> Total Layanan</p>-->

                <div class="container">
                    <!-- row -->
                    <div class="row text-center text-uppercase way-refresh">
                        <div class="col-lg-3 col-sm-6">
                            <div class="p-4 bg-body rounded-3 border position-relative mb-4">
                                <div class="display-4 mb-1 text-primary">
                                    <span class="counter"><?php echo $Data_User_layanan['pengguna']; ?></span><span class="small">+</span>
                                </div>
                                <small class="d-block text-uppercase text-primary">Pengguna</small>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="p-4 bg-body rounded-3 border position-relative mb-4">
                                <div class="display-4 mb-1 text-primary">
                                    <span class="counter"><?php echo $Data_User_layanan['pesanan']; ?></span><span class="small">+</span>
                                </div>
                                <small class="d-block text-uppercase text-primary">Pemesanan</small>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="p-4 bg-body rounded-3 border position-relative mb-4">
                                <div class="display-4 mb-1 text-primary">
                                    <span class="counter"><?php echo $Data_User_layanan['layanan']; ?></span><span class="small">+</span>
                                </div>
                                <small class="d-block text-uppercase text-primary">Layanan</small>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="p-4 bg-body rounded-3 border position-relative mb-4">
                                <div class="display-4 mb-1 text-primary">
                                    <span class="counter"><?php echo number_format($data_pesanan_sosmed['total'], 0, ',', '.'); ?></span><span class="small">+</span>
                                </div>
                                <small class="d-block text-uppercase text-primary">Complete Orders</small>
                            </div>
                        </div>
                    </div><!-- end row -->
                </div>
            </div><!-- End Statistic -->

            <!-- =========={ FEATURES }==========  -->
            <div id="features2" class="section pt-6 pt-md-7 pb-4 pb-md-5 bg-body">
                <div class="container">
                    <!-- section header -->
                    <header class="text-center mx-auto mb-5">
                        <h2 class="h3 fw-bold">Unggulan</h2>
                        <hr class="divider my-4 mx-auto bg-warning border-warning">
                        <p class="lead text-muted">Beberapa Fitur Unggulan Server Kami</p>
                    </header>

                    <!-- row -->
                    <div class="row">
                        <!-- features images -->
                        <div class="col-lg-4 text-center order-lg-2" data-aos="fade-up">
                            <div class="px-6 px-md-7 px-lg-3 px-xl-6 mb-5 mb-lg-0">
                                <!-- Android potrait -->
                                <figure class="position-relative">
                                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480.000000 906.000000">
                                        <!-- Clip path image -->
                                        <defs>
                                            <clipPath id="svgf">
                                                <rect x="50" y="16.5" width="480" height="1066" />
                                            </clipPath>
                                        </defs>
                                        <!-- Phone screen -->
                                        <!-- Phone cover -->
                                        <image xlink:href="src/smmm-phone.png" height="100%" width="100%"></image>
                                    </svg>
                                </figure>
                            </div>
                        </div>
                        <!-- features align left -->
                        <div class="col-lg-4 order-lg-1" data-aos="fade-right" data-aos-delay="100">
                            <div class="three-features pb-4 position-relative features-end text-start text-lg-end">
                                <!-- icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="features-icon text-primary" width="3.5rem" height="3.5rem" viewBox="0 0 512 512">
                                    <rect stroke="currentColor" x="48" y="48" width="176" height="176" rx="20" ry="20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                    <rect stroke="currentColor" x="288" y="48" width="176" height="176" rx="20" ry="20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                    <rect stroke="currentColor" x="48" y="288" width="176" height="176" rx="20" ry="20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                    <rect stroke="currentColor" x="288" y="288" width="176" height="176" rx="20" ry="20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                </svg>
                                <!-- <i class="fas fa-shipping-fast features-icon text-primary"></i> -->

                                <h3 class="h5">Layanan Terlengkap</h3>
                                <p class="text-muted">Kami Menyediakan Layanan Social Media Terlengkap Followers, Likes, Views, Subscriber Dan Masih Banyak Lagi.</p>
                            </div>
                            <div class="three-features pb-4 position-relative features-end text-start text-lg-end">
                                <!-- icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="features-icon text-primary" width="3.5rem" height="3.5rem" viewBox="0 0 512 512">
                                    <rect stroke="currentColor" x="64" y="176" width="384" height="256" rx="28.87" ry="28.87" style="fill:none;stroke-linejoin:round;stroke-width:32px" />
                                    <line stroke="currentColor" x1="144" y1="80" x2="368" y2="80" style="stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" />
                                    <line stroke="currentColor" x1="112" y1="128" x2="400" y2="128" style="stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" />
                                </svg>
                                <!-- <i class="fas fa-chart-pie features-icon text-primary"></i> -->

                                <h3 class="h5">Layanan Gratis</h3>
                                <p class="text-muted">Beberapa Layanan Kami Sediakan Secara Gratis Dan Tentunya Bisa Anda Order Tanpa Biaya Seperpun.</p>
                            </div>
                        </div>

                        <!-- features align right -->
                        <div class="col-lg-4 order-lg-3" data-aos="fade-left" data-aos-delay="100">
                            <div class="three-features pb-4 position-relative text-start text-md-end text-lg-start">
                                <!-- icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="features-icon text-primary rtl-270" width="3.5rem" height="3.5rem" viewBox="0 0 512 512">
                                    <path stroke="currentColor" d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                    <path stroke="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                </svg>
                                <!-- <i class="fas fa-shopping-bag features-icon text-primary"></i> -->

                                <h3 class="h5">Maximum Spedd Services</h3>
                                <p class="text-muted">Kecepatan Prosses Pemesanan Super Cepat Untuk Meningkatan Akun Sosial Media Anda Secara Instan Tanpa Berkendala.</p>
                            </div>
                            <div class="three-features pb-4 position-relative text-start text-md-end text-lg-start">
                                <!-- icon -->
                                <svg width="3rem" class="features-icon text-primary rtl-270" height="3rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 6a6 6 0 1112 0A6 6 0 010 6z"></path>
                                    <path d="M12.93 5h1.57a.5.5 0 01.5.5v9a.5.5 0 01-.5.5h-9a.5.5 0 01-.5-.5v-1.57a6.953 6.953 0 01-1-.22v1.79A1.5 1.5 0 005.5 16h9a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0014.5 4h-1.79c.097.324.17.658.22 1z"></path>
                                </svg>
                                <!-- <i class="fas fa-file-invoice features-icon text-primary"></i> -->

                                <h3 class="h5">Harga Super Murah</h3>
                                <p class="text-muted">Bagi Pengguna Api Dan Pribadi Tetaplah Sama, Semua Layanan Kami Berikan Dengan Harga Super Murah.</p>
                            </div>
                        </div>
                    </div><!-- end row -->
                </div>
            </div> <!-- end features -->

            <!-- =========={ FAQ }==========  -->
            <div id="faq" class="section py-6 py-md-7 bg-body">
                <div class="container">
                    <!-- section header -->
                    <header class="text-center mx-auto mb-5">
                        <h2 class="h3 fw-bold">Pertanyaam Umum</h2>
                        <hr class="divider my-4 mx-auto bg-warning border-warning">
                    </header>

                    <!-- row -->
                    <div class="row justify-content-center">
                        <div class="accordion-list col-md-8">
                            <div id="Accordione" class="accordion">
                                <!-- faq list -->
                                <div class="card mb-3 border-0 collapse-shadow" data-aos="fade-up">
                                    <div class="card-header py-2 mb-0 bg-body" id="HeadingOnee">
                                        <div class="d-grid mb-0">
                                            <button class="btn btn-link text-black-white btn-block btn-accordion fw-medium d-flex px-0 justify-content-between" data-bs-toggle="collapse" data-bs-target="#CollapseOnee" aria-expanded="true" aria-controls="CollapseOnee">
                                                Apa Itu <?php echo $data['short_title']; ?>?
                                                <span class="collapse-arrow-end">
                                                    <svg class="bi bi-chevron-down" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="CollapseOnee" class="collapse show" aria-labelledby="HeadingOnee" data-bs-parent="#Accordione">
                                        <div class="card-body">
                                            <p><?php echo $data['short_title']; ?> adalah penyedia layanan optimasi & otomatisasi digital berteknologi AI, berkualitas, cepat & aman. Kami berkomitmen mempopulerkan bisnis Anda di internet. Layanan unggulan kami dapat melakukan Optimasi Sosial Media Seperti Followers, Likes, Views, Subscriber dll</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- faq list -->
                                <div class="card mb-3 border-0 collapse-shadow" data-aos="fade-up" data-aos-delay="100">
                                    <div class="card-header py-2 mb-0 bg-body" id="HeadingTwoe">
                                        <div class="d-grid mb-0">
                                            <button class="btn btn-link text-black-white btn-block btn-accordion fw-medium d-flex px-0 justify-content-between collapsed" data-bs-toggle="collapse" data-bs-target="#CollapseTwoe" aria-expanded="false" aria-controls="CollapseTwoe">
                                                Apakah Layanan <?php echo $data['short_title']; ?> Gratiss?
                                                <span class="collapse-arrow-end">
                                                    <svg class="bi bi-chevron-down" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="CollapseTwoe" class="collapse" aria-labelledby="HeadingTwoe" data-bs-parent="#Accordione">
                                        <div class="card-body">
                                            <p>Akses layanan gratis untuk semua pengguna dengan sistem Penambahan Saldo & giveaway. Lama waktu layanan gratis mengikuti aturan yang ditetapkan, kami memberikan layanan gratis apabila ada event tertentu, fitur baru, atau perayaan momen spesial.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- faq list -->
                                <div class="card mb-3 border-0 collapse-shadow" data-aos="fade-up" data-aos-delay="200">
                                    <div class="card-header py-2 mb-0 bg-body" id="HeadingThreee">
                                        <div class="d-grid mb-0">
                                            <button class="btn btn-link text-black-white btn-block btn-accordion fw-medium d-flex px-0 justify-content-between collapsed" data-bs-toggle="collapse" data-bs-target="#CollapseThreee" aria-expanded="false" aria-controls="CollapseThreee">
                                                Bagaimana Cara Order Layanan <?php echo $data['short_title']; ?>?
                                                <span class="collapse-arrow-end">
                                                    <svg class="bi bi-chevron-down" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="CollapseThreee" class="collapse" aria-labelledby="HeadingThreee" data-bs-parent="#Accordione">
                                        <div class="card-body">
                                            <p>Untuk melakukan order Anda harus memiliki saldo yang cukup. Klik Dasboard atau menu Order Baru, pilih Kategori, pilih Produk/Layanan, masukkan jumlah orderan, lalu klik Order. Setelah itu akan muncul status order, Anda juga bisa melihat informasi pemesanan pada menu Riwayat Order.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- faq list -->
                                <div class="card mb-3 border-0 collapse-shadow" data-aos="fade-up" data-aos-delay="300">
                                    <div class="card-header py-2 mb-0 bg-body" id="HeadingFoure">
                                        <div class="d-grid mb-0">
                                            <button class="btn btn-link text-black-white btn-block btn-accordion fw-medium d-flex px-0 justify-content-between collapsed" data-bs-toggle="collapse" data-bs-target="#CollapseFoure" aria-expanded="false" aria-controls="CollapseFoure">
                                                Bagaimana Jika Statur Error/Partial Atau Tidak Masuk?
                                                <span class="collapse-arrow-end">
                                                    <svg class="bi bi-chevron-down" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="CollapseFoure" class="collapse" aria-labelledby="HeadingFoure" data-bs-parent="#Accordione">
                                        <div class="card-body">
                                            <p>Dari semua layanan, pada kondisi tertentu respon server kami tidak dapat memproses orderan hingga sukses. Ini karena relasi server tersebut maintenance. Jika Status Order terjadi Partial/Error, sistem akan otomatis mengembalikan dana/refund detik itu juga.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end row -->
                </div>
            </div><!-- End FAQ -->

            <!-- =========={ REVIEWS }==========  -->
            <div id="reviews" class="section py-6 py-md-7 bg-light-dark">
                <div class="container">
                    <!-- section header -->
                    <header class="text-center mx-auto mb-5">
                        <h2 class="h3 fw-bold">Testimonials</h2>
                        <hr class="divider my-4 mx-auto bg-warning border-warning">
                        <p class="lead text-muted">Beberapa Testi Kepuasan Pelanggan Kami <?php echo $data['short_title']; ?>!</p>
                    </header> <!-- end section header -->

                    <!-- row -->
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <!-- review slider -->
                            <div class="nav-dark-button" data-flickity='{ "cellAlign": "left", "wrapAround": true, "adaptiveHeight": true, "pageDots": false }'>
                                <!-- item -->
                                <div class="col-12 col-md-6 px-3 px-lg-5">
                                    <!-- Reviews -->
                                    <blockquote class="reviews-one rounded-3 mb-5">
                                        <p>Sejak memakai layanan smm panel ini akun social media saya viral. Jasa layanan paling mantap dan lengkap</p>
                                        <ul class="ratings my-2 text-muted">
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                        </ul>
                                    </blockquote>
                                    <div class="d-flex">
                                        <img class="d-flex align-self-center rounded-circle reviews-one-thumb shadow-md mx-3 mt-2" src="/home/src/img2-small.jpg" alt="Image description">
                                        <div class="align-self-center">
                                            <p class="mb-0">
                                                <strong class="d-block">Jessica Ramos</strong>
                                                <span class="text-muted fs-75">Member</span>
                                            </p>
                                        </div>
                                    </div><!-- End Reviews -->
                                </div>

                                <!-- item -->
                                <div class="col-12 col-md-6 px-3 px-lg-5">
                                    <!-- Reviews -->
                                    <blockquote class="reviews-one rounded-3 mb-5">
                                        <p>respon admin cepat ada sedikit kendala langsung bisa di atasi . terimakasih ya.</p>
                                        <ul class="ratings my-2 text-muted">
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                        </ul>
                                    </blockquote>
                                    <div class="d-flex">
                                        <img class="d-flex align-self-center rounded-circle reviews-one-thumb shadow-md mx-3 mt-2" src="/home/src/img3-small.jpg" alt="Image description">
                                        <div class="align-self-center">
                                            <p class="mb-0">
                                                <strong class="d-block">Sebastion Doe</strong>
                                                <span class="text-muted fs-75">Reseller </span>
                                            </p>
                                        </div>
                                    </div><!-- End Reviews -->
                                </div>

                                <!-- item -->
                                <div class="col-12 col-md-6 px-3 px-lg-5">
                                    <!-- Reviews -->
                                    <blockquote class="reviews-one rounded-3 mb-5">
                                        <p>Layanan cepat dan murah, saya sangat senang bisa bekerjasama dengan smm panel ini karna terpercaya.</p>
                                        <ul class="ratings my-2 text-muted">
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                            <li class="active">
                                                <!-- icon -->
                                                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill="currentColor" viewBox='0 0 512 512'>
                                                    <path class="rating-svg" d='M394,480a16,16,0,0,1-9.39-3L256,383.76,127.39,477a16,16,0,0,1-24.55-18.08L153,310.35,23,221.2A16,16,0,0,1,32,192H192.38l48.4-148.95a16,16,0,0,1,30.44,0l48.4,149H480a16,16,0,0,1,9.05,29.2L359,310.35l50.13,148.53A16,16,0,0,1,394,480Z' />
                                                </svg>
                                                <!-- <i class="fa fa-star"></i> -->
                                            </li>
                                        </ul>
                                    </blockquote>
                                    <div class="d-flex">
                                        <img class="d-flex align-self-center rounded-circle reviews-one-thumb shadow-md mx-3 mt-2" src="/home/src/img1-small.jpg" alt="Image description">
                                        <div class="align-self-center">
                                            <p class="mb-0">
                                                <strong class="d-block">Tom Robert</strong>
                                                <span class="text-muted fs-75">Member</span>
                                            </p>
                                        </div>
                                    </div><!-- End Reviews -->
                                </div>
                            </div><!-- end review slider -->
                        </div>
                    </div><!-- end row -->
                </div>
            </div><!-- End Reviews -->

        </main><!-- end main -->

        <!-- =========={ FOOTER }==========  -->
        <footer class="bg-secondary">
            <!--Start footer copyright-->
            <div class="footer-dark">
                <div class="container py-4 border-top border-smooth">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="d-block my-3">Copyright &copy; <?php echo $data['short_title']; ?></p>
                        </div>
                    </div>
                </div>
            </div><!--End footer copyright-->
        </footer><!-- End Footer -->

        <!-- =========={ SCROLL TO TOP }==========  -->
        <a href="#top" class="p-3 border bg-body position-fixed end-1 bottom-1 z-index-10 back-top" title="Scroll To Top">
            <!-- <i class="fas fa-arrow-up"></i> -->
            <svg class="bi bi-arrow-up" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd"></path>
                <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L8 3.707 5.354 6.354a.5.5 0 11-.708-.708l3-3z" clip-rule="evenodd"></path>
            </svg>
        </a>

        <!-- =========={ JAVASCRIPT }==========  -->
        <!-- Popper and Bootstrap js -->
        <script src="/home/src/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Plugin js -->
        <script src="/home/src/plugins/jarallax/dist/jarallax.min.js"></script>
        <script src="/home/src/plugins/jarallax/dist/jarallax-video.min.js"></script>

        <script src="/home/src/plugins/demo/js/lightgallery.min.js"></script>
        <!--<script src="/home/src/plugins/demo/js/lg-thumbnail.min.js"></script>-->
        <!--<script src="/home/src/plugins/demo/js/lg-video.js"></script>-->

        <script src="/home/src/plugins/aos/dist/aos.js"></script>
        <script src="/home/src/plugins/waypoints/lib/noframework.waypoints.min.js"></script>
        <script src="/home/src/plugins/counterup2/dist/index.js"></script>
        <script src="/home/src/plugins/flickity/dist/flickity.pkgd.min.js"></script>
        <script src="/home/src/plugins/typed.min.js"></script>
        <script src="/home/src/plugins/isotope.pkgd.min.js"></script>
        <script src="/home/src/plugins/smooth-scroll.polyfills.min.js"></script>
        <script src="/home/src/plugins/lazyload.min.js"></script>
        <script src="/home/src/plugins/hc-sticky.js"></script>

        <!-- Theme js -->
        <script src="/home/src/js/theme.js"></script>

        <!-- JS Optimize -->
        <!-- <script src="dist/js/bundle.min.js"></script> -->
    </body>

    </html>
<?php } ?>