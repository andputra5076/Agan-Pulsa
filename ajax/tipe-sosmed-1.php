<?php
require("../config.php");

if (isset($_POST['tipe'])) {
	$post_kategori = $conn->real_escape_string(filter($_POST['tipe']));
	if ($post_kategori == '0') {
	    $cek_layanan = $conn->query("SELECT * FROM kategori_layanan WHERE server IN ('BUZZER','Sosial Media') ORDER BY nama ASC");
	} else {
	    $cek_layanan = $conn->query("SELECT * FROM kategori_layanan WHERE type = '$post_kategori' AND server = 'BUZZER' ORDER BY nama ASC");
	}
	?>
	<option value="0">Pilih Salah Satu</option>
	<?php
	while ($data_layanan = mysqli_fetch_assoc($cek_layanan)) {
	?>
	<option value="<?php echo $data_layanan['kode'];?>"><?php echo $data_layanan['nama'];?></option>
	<?php
	}
} else {
?>
<option value="0">Error.</option>
<?php
}