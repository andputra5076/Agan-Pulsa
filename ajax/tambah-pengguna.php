<?php
session_start();
require("../config.php");

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        if (!isset($_SESSION['user'])) {
                exit("Anda Tidak Memiliki Akses!");
        }
	if (!isset($_POST['level'])) {
		exit("No direct script access allowed!");
	}
	
	$post_level = $conn->real_escape_string($_POST['level']);
	$cek_pendaftaran = $conn->query("SELECT * FROM harga_pendaftaran WHERE level = '$post_level'");
	if (mysqli_num_rows($cek_pendaftaran) == 1) {
		$data_pendaftaran = mysqli_fetch_assoc($cek_pendaftaran);
	?>
												<div class="alert alert-info alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
													<b>Level : </b> <?php echo $data_pendaftaran['level']; ?><br />
													<b>Harga Pendaftaran : </b> Rp <?php echo number_format($data_pendaftaran['harga'],0,',','.'); ?><br />
													<b>Bonus Saldo : </b> <?php echo number_format($data_pendaftaran['bonus'],0,',','.'); ?> <br />
													<b>Note : </b>Pendaftaran Pengguna baru dengan level <?php echo $data_pendaftaran['level']; ?> akan mengurangi saldo Anda sebesar Rp <?php echo number_format($data_pendaftaran['harga'],0,',','.'); ?>
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