<?php
session_start();
require("../config.php");
if (!isset($_SESSION['user'])) {
   die("Anda Tidak Memiliki Akses!");
}
if (isset($_POST['tipe'])) {
	$post_tipe = $conn->real_escape_string($_POST['tipe']);
	$cek_metode = $conn->query("SELECT * FROM metode_depo WHERE tipe = '$post_tipe' ORDER BY id ASC");
	?>
	<option value="0">Pilih Salah Satu</option>
	<?php
	while ($data_metode = $cek_metode->fetch_assoc()) {
	?>
	<option value="<?php echo $data_metode['id'];?>"><?php echo $data_metode['provider'];?></option>
	<?php
	}
} else {
?>
<option value="0">Error.</option>
<?php
}