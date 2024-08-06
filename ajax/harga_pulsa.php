<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user'])) {
	die("Anda Tidak Memiliki Akses!");
}

if (isset($_POST['layanan'])) {
	$post_layanan = $conn->real_escape_string($_POST['layanan']);
	$cek_layanan = $conn->query("SELECT * FROM layanan_pulsa WHERE provider_id = '$post_layanan' AND provider = 'DIGIFLAZZ' AND status = 'Normal'");
	if (mysqli_num_rows($cek_layanan) == 1) {
		$data_layanan = mysqli_fetch_assoc($cek_layanan);
		$hasil = $data_layanan['harga'];
		echo number_format($hasil,0,',','');
	} else {
		die("0");
	}
} else {
	die("0");
}