<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
	die("Anda Tidak Memiliki Akses!");
}
if (isset($_POST['layanan'])) {
	$post_layanan = $conn->real_escape_string($_POST['layanan']);
	$cek_layanan = $conn->query("SELECT * FROM layanan_pulsa WHERE provider_id = '$post_layanan' AND status = 'Normal'");
	if (mysqli_num_rows($cek_layanan) == 1) {
		$data_layanan = mysqli_fetch_assoc($cek_layanan);
		?>
		<div class="alert alert-dismissible" role="alert" style="background: linear-gradient(130deg, #1a142d 15%, #070118 40%, #22086f 60%, #280095 100%) !important;color: #fff;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<i class="mdi mdi-alert-box"></i>
			<b>Deskripsi</b><br />
			• Tujuan Harus Valid Sesuai Produk yang di Pilih.<br />
			• Baca <a href="#informasiorder"><font color="FFFFFF"><b><u>Informasi Order</u></b></font></a>.<br /><br />
			
			<span><?= nl2br($data_layanan['catatan']); ?></span><hr>

			<b>Produk:</b> <?php echo($data_layanan['layanan']); ?><br />
			<b>Kategori:</b> <?php echo($data_layanan['operator']); ?><br />
			<b>Harga:</b> Rp <?php echo number_format($data_layanan['harga'],0,',','.'); ?>
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