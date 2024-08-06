<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
	die("Anda Tidak Memiliki Akses!");
}

if (isset($_POST['jenis'])) {
	$post_tipe = $conn->real_escape_string($_POST['jenis']);
	$cek_metode = $conn->query("SELECT * FROM metode_depo1 WHERE jenis_saldo = '$post_tipe' AND tipe = 'Convenience-Store' AND keterangan = 'ON' ORDER BY id ASC");
	?>
	<option value="0">Pilih Salah Satu</option>
	<?php
	while ($data_metode = $cek_metode->fetch_assoc()) {
		?>
		<option value="<?php echo $data_metode['id'];?>"><?php echo $data_metode['nama'];?></option>
		<?php
	}
} else {
	?>
	<option value="0">Provider Tidak Tersedia</option>
	<?php
}