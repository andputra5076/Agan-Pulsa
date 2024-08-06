<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
require '../lib/header.php';

	if (isset($_GET['oid'])) {
		$kode_pesanan = filter($_GET['oid']);

		$cek_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE oid = '$kode_pesanan' AND user = '$sess_username'");
		$data_pesanan = mysqli_fetch_assoc($cek_pesanan);

		if ($data_pesanan['status'] == "Pending") {
			$label = "warning";
		} else if ($data_pesanan['status'] == "Processing") {
			$label = "primary";
		} else if ($data_pesanan['status'] == "Error") {
			$label = "danger";
		} else if ($data_pesanan['status'] == "Partial") {
			$label = "danger";
		} else if ($data_pesanan['status'] == "Success") {
			$label = "success";
		}

		if ($cek_pesanan->num_rows == 0) {
			header("Location: ".$config['web']['url']."riwayat/pemesanan-sosmed");
		} else {
?>
<div class="kt-invoice__head" style="background-image: url(https://serbamudah.xyz/assets/images/network22/struk.jpg);">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!--Title-->
<title>Serba mudah - SMM & PPOB TERMURAH NO#1</title>

<meta name="description" content="Platform Layanan Digital All in One, Berkualitas, Cepat & Aman. Menyediakan Produk & Layanan Pemasaran Sosial Media, Payment Point Online Bank, Layanan Pembayaran Elektronik, Optimalisasi Toko Online, Voucher Game dan Produk Digital."/>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="kt-invoice__head" style="background-image: url(https://network22.site/assets/images/network22/struk.jpg);">
                <h4 class="m-t-0 text-uppercase text-center header-title"> <?php
require("tglcetak.php");
?></h4><hr>

        <!-- Start Content -->
        <div class="kt-container kt-grid__item kt-grid__item--fluid">

		<!-- Start Page Order Struk -->
        <div class="row">
	        <div class="offset-lg-2 col-lg-8">
		        <div class="kt-portlet">
			        <div class="kt-portlet__body">
                    <div class="text-center"><img src="<?php echo $config['web']['url'] ?>assets/images/network22/webkmpanelblack.png" width="140px" height="40px"></div>
                    <h5 style="padding-top:10px" class="text-center"><strong><font><?php echo tanggal_indo($data_pesanan['date']); ?>, <?php echo $data_pesanan['time']; ?></font></strong></h5>
                    <br />
	                <center>
		                <h4><font>STRUK PEMBELIAN</font></h4>
	                </center>
	                <br>
                    <div class="cart">
            <div class = "table-responsive">
         <table class = "table table-bordered table-sm">
                <tr class="table-danger">
                    <td>LAYANAN</td>
                    <td>: <?php echo $data_pesanan['layanan']; ?></td>
                </tr>
                <tr class="table-danger">
                    <td>TUJUAN</td>
                    <td>: <?php echo $data_pesanan['target']; ?></td>
                </tr>
                <tr class="table-danger">
                    <td>JUMLAH PESANAN</td>
                    <td>: <?php echo $data_pesanan['jumlah']; ?></td>
                </tr>
                <tr class="table-danger">
                    <td>HARGA</td>
                    <td contenteditable="true">: Rp. <?php echo number_format($data_pesanan['harga'],0,',','.'); ?>,-</td>
                </tr>
                <tr class="table-danger">
                    <td>STATUS</td>
                    <td>: <?php echo $data_pesanan['status']; ?></td>
                </tr>
            </table>
        </div> 
					<br><center>
					    <h4><font>Terima Kasih</font></h4>
					</center>
					</div>
				</div>
					<center>
					<div class="card-footer text-muted">
						<a href="<?php echo $config['web']['url']; ?>riwayat/pemesanan-sosmed" class="btn btn-warning btn-elevate btn-pill btn-elevate-air">Kembali</a>
						<a class="pull-right btn btn-primary btn-elevate btn-pill btn-elevate-air" href="#" onClick="window.print();"><i class="fa fa-print"></i> Print</a></center>
					</ul>
            </div>
        </div>
    </div>
</div>
</div>
        <!-- End Page Order Struk -->

        </div>
        <!-- End Content -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php ?>

<?php 
require '../lib/footer.php';
}
} else {
	header("Location: ".$config['web']['url']."history/order");
}
?>