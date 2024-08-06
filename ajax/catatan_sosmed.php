<?php
session_start();
require("../config.php");
if (!isset($_SESSION['user'])) {
   die("Anda Tidak Memiliki Akses!");
}
if (isset($_POST['layanan'])) {
	$post_layanan = $conn->real_escape_string($_POST['layanan']);
	$cek_layanan = $conn->query("SELECT * FROM layanan_sosmed WHERE service_id = '$post_layanan' AND status = 'Aktif'");
	if (mysqli_num_rows($cek_layanan) == 1) {
		$data_layanan = mysqli_fetch_assoc($cek_layanan);
	?>
			<div class="alert alert-dismissible" role="alert" style="background: linear-gradient(130deg, #1a142d 15%, #070118 40%, #22086f 60%, #280095 100%) !important;color: #fff;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
			        </button>
			        
			        
<i class="mdi mdi-alert-box"></i>

<b>Deskripsi:</b><br> <span><?= nl2br($data_layanan['catatan']); ?></span><br />
<hr>																<b>Harga/1000:</b> Rp <?php echo number_format($data_layanan['harga'],0,',','.'); ?><br />
<b>Min. Pemesanan:</b> <?php echo number_format($data_layanan['min'],0,',','.'); ?><br />
<b>Max. Pemesanan:</b> <?php echo number_format($data_layanan['max'],0,',','.'); ?>
												</div>
	<?php
	} else {
	?>
												<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
													<i class="mdi mdi-block-helper"></i>
													<b>Gagal :</b> Service Tidak Ditemukan
												</div>
	<?php
	}
} else {
?>
												<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
													<i class="mdi mdi-block-helper"></i>
													<b>Gagal : </b> Terjadi Kesalahan.
												</div>
<?php
}

