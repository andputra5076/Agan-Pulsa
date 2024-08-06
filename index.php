<?php
session_start();
require("config.php");
if (!isset($_SESSION['user'])) {
    exit(header("Location: " . $config['web']['url'] . "home/"));
} else {
    require("lib/header.php");
    $sess_username = $_SESSION['user']['username'];
    $session_usernya    = session_id();
    $time_nya      = time();
    $time_check = $time_nya - 300;     //We Have Set Time 5 Minutes
    $tbl_name   = "online_users";

    $sql    = "SELECT * FROM $tbl_name WHERE session='$session_usernya'";
    $result = mysqli_query($conn, $sql);
    $count  = mysqli_num_rows($result);

    //If count is 0 , then enter the values
    if ($count == "0") {
        $sql1    = "INSERT INTO $tbl_name(session, time)VALUES('$session_usernya', '$time_nya')";
        $result1 = mysqli_query($conn, $sql1);
    } else {
        $sql2    = "UPDATE $tbl_name SET time='$time_nya' WHERE session = '$session_usernya'";
        $result2 = mysqli_query($conn, $sql2);
    }

    $sql3              = "SELECT * FROM $tbl_name";
    $result3           = mysqli_query($conn, $sql3);
    $count_user_online = mysqli_num_rows($result3);

    // after 5 minutes, session will be deleted 
    $sql4    = "DELETE FROM $tbl_name WHERE time<$time_check";
    $result4 = mysqli_query($conn, $sql4);
?>
    <!-- import library chart menggunakan cdn -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    </head>
    <?php
    require "alert.php"
    ?>
    <div class="row" id="beranda">
        <!--START COL1-->
        <div class="col-sm-12 col-lg-6">
            <!--DATA USER-->
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-6">
                                <strong>
                                    <div class="mb-0 text-primary" style="margin-top: -5px !important; margin-bottom: -10px !important;"><i class="ti-wallet"></i> Total Saldo </div>
                                </strong>
                            </div>
                            <div class="col-6 text-right" style="margin-top: -10px !important; margin-bottom: -10px !important;"><i class=""></i><b>Rp <?php echo number_format($data_user['saldo'], 0, ',', '.'); ?> </b></br>
                            </div>
                            <br></br>
                            <div class="col-6">
                                <strong>
                                    <div class="mb-0 text-primary" style="margin-top: -5px !important; margin-bottom: -10px !important;"><i class="fa fa-bank"></i> Total Deposit </div>
                                </strong>
                            </div>
                            <div class="col-6 text-right" style="margin-top: -10px !important; margin-bottom: -10px !important;">
                                <i class=""></i> <b>Rp
                                <?php echo number_format($data_deposit_user['total'], 0, ',', '.'); ?> (<?php echo $jumlah_deposit_user; ?>)</b></br>
                            </div>
                            <br></br>
                            <div class="col-6">
                                <strong>
                                    <div class="mb-0 text-primary" style="margin-top: -5px !important; margin-bottom: -10px !important;"><i class="fa fa-bar-chart"></i> Total Pemesanan </div>
                                </strong>
                            </div>
                            <div class="col-6 text-right" style="margin-top: -10px !important; margin-bottom: -10px !important;">
                                <i class=""></i> <b>Rp
                                <?php echo number_format($data_order_sosmed['total'], 0, ',', '.'); ?> (<?php echo $jumlah_order_sosmed; ?>)</b></br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--AND DATA USER-->

            <!--START COURSEL-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active carousel-item-left">
                                    <img class="d-block w-100" src="/assets/images/maxresdefault.jpg" alt="Layanan Terbaik 2">
                                </div>
                                <div class="carousel-item carousel-item-next carousel-item-left">
                                    <img class="d-block w-100" src="/assets/images/Top-Up-FF.png" alt="Layanan Terbaik 0">
                                </div>
                                <div class="carousel-item carousel-item-left">
                                    <img class="d-block w-100" src="/assets/images/diamond-2ff.jpg" alt="Layanan Terbaik 2">
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="fa fa-arrow-left" style="font-size:24px;color:#000;background-color:#FFF;border-radius:50%" aria-hidden="true"></span>
                                    <span class="sr-only">Sebelumnya</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="fa fa-arrow-right" style="font-size:24px;color:#000;background-color:#FFF;border-radius:50%" aria-hidden="true"></span>
                                    <span class="sr-only">Selanjutnya</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END COURSEL-->

            <!--MENU ORDER-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body text-center">
                        <center>
                            <p>Welcome <span class="text-success"><?php echo $sess_username; ?></span>
                            </p>
                            <h4 class="header-title text-danger"><i class="fa fa-shopping-bag"></i><b> ORDER BARU</h4></b>
                        </center>
                        <br>
                        <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                            <li class="nav-item"><a href="/pemesanan/sosial-media.php" class="btn-loading"><img src="/assets/index/social-media.png" alt="Sosial Media" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">SOSMED</span></a></li>
                            <li class="nav-item"><a href="/pemesanan/pulsa.php" class="btn-loading"><img src="/assets/index/PULSA.png" alt="Pulsa Reguler" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Pulsa Reguler</span></a></li>
                            <li class="nav-item"><a href="/pemesanan/telepon-sms.php" class="btn-loading"><img src="/assets/index/PKSMS.png" alt="Telepon & SMS" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Telepon & SMS</span></a></li>
                            <li class="nav-item"><a href="/pemesanan/paket.php" class="btn-loading"><img src="/assets/index/5g.png" alt="Paket Data" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Paket Data</span></a></li>
                        </ul><br />

                        <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                            <li class="nav-item"><a href="/pemesanan/game.php" class="btn-loading"><img src="/assets/index/game-console.png" alt="Voucher Game" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Voucher Game</span></a></li>
                            <li class="nav-item"><a href="/pemesanan/pln.php" class="btn-loading"><img src="/assets/index/PLN.png" alt="Token PLN Prabayar" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Token PLN Prabayar</span></a></li>
                            <li class="nav-item"><a href="/pemesanan/e-money.php" class="btn-loading"><img src="/assets/index/E-MONEY.png" alt="Saldo E-money" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Saldo E-money</span></a></li>
                            <li class="nav-item"><a href="/tiket/" class="btn-loading"><img src="/assets/index/cs-bantuan.png" alt="Tiket" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Tiket Bantuan</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--END MENU ORDER-->

        </div>
        <!--END COLL 1-->

        <!--START COL2-->
        <div class="col-sm-12 col-lg-6">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <center>
                            <h4 class="header-title text-dark"><i class=" mdi mdi-newspaper "></i><b> BERITA & INFORMASI</h4></b>
                        </center>
                        <div class="table-responsive" style="display: inline-grid;">
                            <table class="able table-striped table-hovered nowrap mb-0">
                                <tbody>
                                    <?php $check_news = $conn->query("SELECT * FROM berita ORDER BY id DESC LIMIT 3"); ?>
                                    <?php while ($data_news = $check_news->fetch_assoc()) { ?>
                                        <?php
                                        if ($data_news['tipe'] == "INFORMASI") $btn = "primary";
                                        if ($data_news['tipe'] == "PERINGATAN") $btn = "warning";
                                        if ($data_news['tipe'] == "PENTING") $btn = "danger";
                                        if ($data_news['tipe'] == "DEPOSIT") $btn = "primary";
                                        if ($data_news['tipe'] == "UPDATE") $btn = "success";
                                        ?>
                                        <tr>
                                            <td width="60">
                                                <a href="<?= $config['web']['url']; ?>user/news?id=<?= $data_news['id']; ?>" class="btn btn-lg btn-<?= $btn; ?>" style="border-radius: 30px;font-size: 10px;"><i class="fas fa-info-circle" style="font-size: 20px;"></i></a>
                                            </td>
                                            <td style="vertical-align: middle !important;">
                                                <h6>
                                                    <a href="<?= $config['web']['url']; ?>user/news?id=<?= $data_news['id']; ?>" class="text-dark" style="font-size: 16px;"><?= $data_news['subjek']; ?></a>
                                                </h6>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <br>
                            <div class="text-center">
                                <a href="<?= $config['web']['url']; ?>user/news.php" class="btn btn-primary waves-effect">Tampilkan Semua...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <center>
                            <h4 class="header-title text-dark"><i class="mdi mdi-cart"></i><b>Riwayat Sosmed</h4></b>
                        </center>
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Layanan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    // start paging config
                                    if (isset($_GET['cari'])) {
                                        $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
                                        $cari_status = $conn->real_escape_string(filter($_GET['status']));
                                    
                                        $cek_pesanan = "SELECT * FROM pembelian_sosmed WHERE oid LIKE '%$cari_oid%' AND status LIKE '%$cari_status%' AND user = '$sess_username' ORDER BY id DESC"; // edit
                                    } else {
                                        $cek_pesanan = "SELECT * FROM pembelian_sosmed WHERE user = '$sess_username' ORDER BY id DESC"; // edit
                                    }
                                    if (isset($_GET['cari'])) {
                                    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
                                    $records_per_page = $cari_urut; // edit
                                    } else {
                                        $records_per_page = 3; // edit
                                    }
                                    
                                    $starting_position = 0;
                                    if(isset($_GET["halaman"])) {
                                        $starting_position = ($conn->real_escape_string(filter($_GET["halaman"]))-1) * $records_per_page;
                                    }
                                    $new_query = $cek_pesanan." LIMIT $starting_position, $records_per_page";
                                    $new_query = $conn->query($new_query);
                                    // end paging config
                                    while ($data_pesanan = $new_query->fetch_assoc()) {
                                        if ($data_pesanan['status'] == "Pending") {
                                            $badge = "warning";
                                        } else if ($data_pesanan['status'] == "Partial") {
                                            $badge = "danger";
                                        } else if ($data_pesanan['status'] == "Error") {
                                            $badge = "danger"; 
                                        } else if ($data_pesanan['status'] == "Canceled") {
                                            $badge = "danger"; 
                                        } else if ($data_pesanan['status'] == "Processing") {
                                            $badge = "primary";
                                        } else if ($data_pesanan['status'] == "In Progress") {
                                            $badge = "primary"; 
                                        } else if ($data_pesanan['status'] == "Completed") {
                                            $badge = "success";
                                        } else if ($data_pesanan['status'] == "Success") {
                                            $badge = "success";    
                                        }
                                    ?>
                                            <tr>
                                                <td>
                                                    <badge class="badge badge-<?php echo $badge; ?>"><?php echo $data_pesanan['status']; ?></badge>
                                                </td>
                                                <td><?php echo $data_pesanan['layanan']; ?></td>
                                                <td>Rp. <?php echo number_format($data_pesanan['harga'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div><br>
                            <div class="text-center">
                                <a href="/riwayat/pemesanan-sosmed.php" class="btn btn-xs btn-primary" Ganti Password Akun> <i class="fa fa-check-circle-o"></i> Lainnya </a>
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <center>
                            <h4 class="header-title text-dark"><i class="mdi mdi-cart"></i><b>Riwayat Sosmed</h4></b>
                        </center>
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Layanan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                // start paging config
                                if (isset($_GET['cari'])) {
                                    $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
                                    $cari_status = $conn->real_escape_string(filter($_GET['status']));
                                    $cek_pesanan = "SELECT * FROM pembelian_pulsa WHERE oid LIKE '%$cari_oid%' AND status LIKE '%$cari_status%' AND user = '$sess_username' ORDER BY id DESC"; // edit
                                    } else {
                                    $cek_pesanan = "SELECT * FROM pembelian_pulsa WHERE user = '$sess_username' ORDER BY id DESC"; // edit
                                    }
                                    if (isset($_GET['cari'])) {
                                        $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
                                    $records_per_page = $cari_urut; // edit
                                    } else {
                                    $records_per_page = 3; // edit
                                    }

                                    $starting_position = 0;
                                    if(isset($_GET["halaman"])) {
                                        $starting_position = ($conn->real_escape_string(filter($_GET["halaman"]))-1) * $records_per_page;
                                    }
                                    $new_query = $cek_pesanan." LIMIT $starting_position, $records_per_page";
                                    $new_query = $conn->query($new_query);
                                    // end paging config
                                    while ($data_pesanan = $new_query->fetch_assoc()) {
                                        if ($data_pesanan['status'] == "Pending") {
                                            $badge = "warning";
                                        } else if ($data_pesanan['status'] == "Partial") {
                                            $badge = "danger";
                                        } else if ($data_pesanan['status'] == "Error") {
                                            $badge = "danger";    
                                        } else if ($data_pesanan['status'] == "Processing") {
                                            $badge = "info";    
                                        } else if ($data_pesanan['status'] == "Success") {
                                            $badge = "success";    
                                        }
                            ?>
                                            <tr>
                                                <td>
                                                    <badge class="badge badge-<?php echo $badge; ?>"><?php echo $data_pesanan['status']; ?></badge>
                                                </td>
                                                <td><?php echo $data_pesanan['layanan']; ?></td>
                                                <td>Rp. <?php echo number_format($data_pesanan['harga'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div><br>
                            <div class="text-center">
                                <a href="/riwayat/pemesanan-pulsa.php" class="btn btn-xs btn-primary" Ganti Password Akun> <i class="fa fa-check-circle-o"></i> Lainnya </a>
                            </div>
                    </div>
                </div>
            </div>

        </div>
        <!--END COL2-->
        
        <div class="col-sm-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <h3>Data 7 Hari</h3>
                        <div id="line-chart7" height="150px"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--COL3-->
            <!--MONITORING SOSEMD-->
            <div class="col-sm-12 col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <center>
                                <h4 class="header-title text-dark"><i class="fa fa-spinner fa-spin text-dark"></i><b> MONITORING SOSMED</h4></b>
                            </center>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Layanan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // start paging config
                                        if (isset($_GET['cari'])) {
                                            $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
                                            $cari_status = $conn->real_escape_string(filter($_GET['status']));
                                            $cek_pesanan = "SELECT * FROM pembelian_sosmed WHERE oid LIKE '%$cari_oid%' AND status LIKE '%$cari_status%' ORDER BY id DESC"; // edit
                                        } else {
                                            $cek_pesanan = "SELECT * FROM pembelian_sosmed WHERE status = 'Success' ORDER BY id DESC"; // edit
                                        }
                                        if (isset($_GET['cari'])) {
                                            $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
                                            $records_per_page = $cari_urut; // edit
                                        } else {
                                            $records_per_page = 5; // edit
                                        }

                                        $starting_position = 0;
                                        if (isset($_GET["halaman"])) {
                                            $starting_position = ($conn->real_escape_string(filter($_GET["halaman"])) - 1) * $records_per_page;
                                        }
                                        $new_query = $cek_pesanan . " LIMIT $starting_position, $records_per_page";
                                        $new_query = $conn->query($new_query);
                                        // end paging config
                                        while ($data_pesanan = $new_query->fetch_assoc()) {
                                            if ($data_pesanan['status'] == "Pending") {
                                                $badge = "warning";
                                            } else if ($data_pesanan['status'] == "Partial") {
                                                $badge = "danger";
                                            } else if ($data_pesanan['status'] == "Error") {
                                                $badge = "danger";
                                            } else if ($data_pesanan['status'] == "Canceled") {
                                                $badge = "danger";
                                            } else if ($data_pesanan['status'] == "Processing") {
                                                $badge = "info";
                                            } else if ($data_pesanan['status'] == "In Progress") {
                                                $badge = "info";
                                            } else if ($data_pesanan['status'] == "Success") {
                                                $badge = "success";
                                            }
                                        ?>
                                            <tr>
                                                <td>
                                                    <badge class="badge badge-<?php echo $badge; ?>"><?php echo $data_pesanan['status']; ?></badge>
                                                </td>
                                                <td><?php echo $data_pesanan['layanan']; ?></td>
                                                <td>Rp. <?php echo number_format($data_pesanan['harga'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div><br>
                            <div class="text-center">
                                <a href="/panel/monitoring-sosmed.php" class="btn btn-xs btn-primary" Ganti Password Akun> <i class="fa fa-check-circle-o"></i> Lainnya </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END MONITORING SOSEMD-->

            <!--MONITORING PPOB-->
            <div class="col-sm-12 col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <center>
                                <h4 class="header-title text-dark"><i class="fa fa-spinner fa-spin text-dark"></i><b> MONITORING PPOB</h4></b>
                            </center>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                        <tr>
                                            <th>Status <a href="/halaman/status-order" target="_blank"><b><i class="fa fa-question-circle"></i></b></a></th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // start paging config
                                        if (isset($_GET['cari'])) {
                                            $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
                                            $cari_status = $conn->real_escape_string(filter($_GET['status']));
                                            $cek_pesanan = "SELECT * FROM pembelian_pulsa WHERE oid LIKE '%$cari_oid%' AND status LIKE '%$cari_status%' ORDER BY id DESC"; // edit
                                        } else {
                                            $cek_pesanan = "SELECT * FROM pembelian_pulsa WHERE status = 'Success' ORDER BY id DESC"; // edit
                                        }
                                        if (isset($_GET['cari'])) {
                                            $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
                                            $records_per_page = $cari_urut; // edit
                                        } else {
                                            $records_per_page = 5; // edit
                                        }

                                        $starting_position = 0;
                                        if (isset($_GET["halaman"])) {
                                            $starting_position = ($conn->real_escape_string(filter($_GET["halaman"])) - 1) * $records_per_page;
                                        }
                                        $new_query = $cek_pesanan . " LIMIT $starting_position, $records_per_page";
                                        $new_query = $conn->query($new_query);
                                        // end paging config

                                        while ($data_pesanan = $new_query->fetch_assoc()) {
                                            if ($data_pesanan['status'] == "Pending") {
                                                $badge = "warning";
                                            } else if ($data_pesanan['status'] == "Partial") {
                                                $badge = "danger";
                                            } else if ($data_pesanan['status'] == "Error") {
                                                $badge = "danger";
                                            } else if ($data_pesanan['status'] == "Processing") {
                                                $badge = "info";
                                            } else if ($data_pesanan['status'] == "Success") {
                                                $badge = "success";
                                            }
                                        ?>
                                            <tr>
                                                <td>
                                                    <badge class="badge badge-<?php echo $badge; ?>"><?php echo $data_pesanan['status']; ?></badge>
                                                </td>
                                                <td><?php echo $data_pesanan['layanan']; ?></td>
                                                <td>Rp. <?php echo number_format($data_pesanan['harga'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div><br />
                            <div class="text-center">
                                <a href="/panel/monitoring-pulsa" class="btn btn-xs btn-primary" Ganti Password Akun> <i class="fa fa-info-circle"></i> Lainnya </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END MONITORING PPOB-->

            <!--USER ONLINE-->
            <div class="col-sm-12 col-lg-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <center>
                                <h4 class="header-title text-dark"><i class=" mdi mdi-newspaper "></i><b> User Online</h4></b>
                            </center>
                            <div class="table-responsive" style="display: inline-grid;">
                                <table class="able table-striped table-hovered nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <td width="60">
                                                <a href="#" class="btn btn-lg btn-danger"><i class="fas fa-user-plus"></i></a>
                                            </td>
                                            <td style="vertical-align: middle !important;">
                                                <h6>
                                                    Admin Online : <?php echo $data_User_Online['admin']; ?>
                                                </h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="60">
                                                <a href="#" class="btn btn-lg btn-success"><i class="fas fa-user-plus"></i></a>
                                            </td>
                                            <td style="vertical-align: middle !important;">
                                                <h6>
                                                    Staff Online : <?php echo $data_User_Online['staff']; ?>
                                                </h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="60">
                                                <a href="#" class="btn btn-lg btn-info"><i class="fas fa-user-plus"></i></a>
                                            </td>
                                            <td style="vertical-align: middle !important;">
                                                <h6>
                                                    Users Online : <?php echo $data_User_Online['user']; ?><?php echo $count_user_online; ?>
                                                </h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END USER ONLINE-->
        <!--END COL3-->

    </div>

    <?php
    if ($_SESSION['user']) {
    ?>
        <div class="modal fade show" id="news" tabindex="-1" role="dialog" aria-labelledby="NewsInfo" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <style>
                .modal-content.ramadhan {
                    background: transparent;
                    box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
                }
                </style>
                <div class="modal-content ramadhan">
                    <div class="modal-header">
                        <h4 class="modal-title text-white mt-0" id="NewsInfo"><b><i class="fas fa-bell text-primary"></i> Berita & Informasi</b></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 400px; overflow: auto;">
                        <?php
                        $cek_berita = $conn->query("SELECT * FROM berita ORDER BY id DESC LIMIT 6");
                        while ($data_berita = $cek_berita->fetch_assoc()) {
                            if ($data_berita['tipe'] == "INFORMASI") {
                                $label = "info";
                            } else if ($data_berita['tipe'] == "PERINGATAN") {
                                $label = "warning";
                            } else if ($data_berita['tipe'] == "PENTING") {
                                $label = "danger";
                            } else if ($data_berita['tipe'] == "LAYANAN") {
                                $label = "success";
                            } else if ($data_berita['tipe'] == "PERBAIKAN") {
                                $label = "primary";
                            }
                        ?>
                            <div class="alert" style="background: linear-gradient(130deg, #1a142d 15%, #070118 40%, #22086f 60%, #280095 100%) !important;color: #fff;">
                                <div class="alert-text">
                                    <p><span class="float-right text-muted"><?php echo tanggal_indo($data_berita['date']); ?>, <?php echo $data_berita['time']; ?></span></p>
                                    <h5 class="inbox-item-author text-white mt-0 mb-1"><b><?php echo $data_berita['subjek']; ?></b></h5>
                                    <h5><span class="badge badge-<?php echo $label; ?>"><?php echo $data_berita['tipe']; ?></span></h5>
                                    <?php echo nl2br($data_berita['konten']); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="read_news()"><i class="mdi mdi-read" aria-hidden="true"></i> Saya Sudah Membaca</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- End Modal Content-->

<?php
}
require 'lib/footer.php';
?>
<script type="text/javascript">
    $(function() {
        new Morris.Area({
            element: 'line-chart7',
            data: [
                <?php
                $list_tanggal = array();
                for ($i = 6; $i > -1; $i--) {
                    $list_tanggal[] = date('Y-m-d', strtotime('-' . $i . ' days'));
                }

                for ($i = 0; $i < count($list_tanggal); $i++) {
                    $get_order_sosmed = $conn->query("SELECT * FROM pembelian_sosmed WHERE date = '" . $list_tanggal[$i] . "' AND user = '$sess_username' ");
                    $get_order_pulsa = $conn->query("SELECT * FROM pembelian_pulsa WHERE date = '" . $list_tanggal[$i] . "' AND user = '$sess_username' ");
                    print("{ y: '" . tanggal_indo($list_tanggal[$i]) . "', a: " . mysqli_num_rows($get_order_sosmed) . ",b: " . mysqli_num_rows($get_order_pulsa) . " }, ");
                }
                ?>
            ],
            xkey: 'y',
            ykeys: ['a','b'],
            labels: ['Pemesanan Sosmed','Pemesanan PPOB'],
            lineColors: ['#5b2be0','#f70000'],
            gridLineColor: '#eef0f2',
            pointSize: 0,
            lineWidth: 0,
            resize: true,
            parseTime: false
        });
    });
</script>