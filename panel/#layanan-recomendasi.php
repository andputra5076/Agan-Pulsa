<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
$cek_pemesanan = $conn->query("SELECT * FROM monitoring_layanan WHERE status = 'Success' AND update_at != 'NULL' ORDER BY update_at DESC LIMIT 100");
    function jangka_waktu($awal, $akhir) {
        $waktu_awal = date_create($awal);
        $waktu_akhir = date_create($akhir);
        $waktu_diff = date_diff($waktu_awal, $waktu_akhir);
        return $waktu_diff->d.' Hari Yang Lalu';
    }
    
require '../lib/header.php';
?>

<!--Title-->
<title>Layanan recomendasi</title>
<meta name="description" content="Platform Layanan Digital All in One, Berkualitas, Cepat & Aman. Menyediakan Produk & Layanan Pemasaran Sosial Media, Payment Point Online Bank, Layanan Pembayaran Elektronik, Optimalisasi Toko Online, Voucher Game dan Produk Digital."/>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <center><h4 class="header-title text-dark"><i class="fa fa-spinner fa-spin text-dark"></i><b> Layanan Dibawah Ini Adalah Layanan Yang <span class="text-success">Success</span> Dikerjakan Oleh Server Dengan Rentang Waktu Yang Cepat. Sehingga Layanan Dibawah Ini Sangat <span class="text-info">Di RECOMENDASIKAN!!</span> Untuk Di Pesan.</h4></b></center>

            <div class="text-center">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap m-0">
                       <thead>
                                        <th>No</th>
                                        <th>Layanan</th>
                                        <th>Jumlah</th>
                                        <th>Pesanan Dimulai</th>
                                        <th>Terakhir Di Pesan</th>
                                        <th>Kecepatan Waktu Proses</th>
                                        <th>Status</th>
                                    </thead>
                         <tbody>
                                    <?php $no =1; while($data_pemesanan = $cek_pemesanan->fetch_assoc()) { ?>
                                        <tr>
                                            <th><?= $no++ ?>
                                            <th><?= $data_pemesanan['layanan'] ?></th>
                                            <th><?= $data_pemesanan['jumlah'] ?></th>
                                            <th><?= tanggal_indo($data_pemesanan['date']) ?> <?= $data_pemesanan['time'] ?></th>
                                            <th><?= jangka_waktu($data_pemesanan['date']." ".$data_pemesanan['time'], $data_pemesanan['update_at']) ?></th>
                                            <th><?= $data_pemesanan['waktu_proses'] ?></th>
                                            <th><a class="badge badge-success text-white"><?= $data_pemesanan['status'] ?></a></th>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
        
<?php
require '../lib/footer.php';
?>