<?php
require '../config.php';
header('Content-Type: application/json');
if ($maintenance == 1) {
	$hasilnya = array('status' => false, 'data' => array('pesan' => 'Maintenance'));
	exit(json_encode($hasilnya, JSON_PRETTY_PRINT));
}
if (isset($_POST['api_key']) AND isset($_POST['action'])) {
	$apinya = $conn->real_escape_string($_POST['api_key']);
	$aksinya = $_POST['action'];

	if (!$apinya || !$aksinya) {
		$hasilnya = array('status' => false, 'data' => array('pesan' => 'Permintaan Tidak Sesuai'));

	} else {
		$cek_usernya = $conn->query("SELECT * FROM users WHERE api_key = '$apinya'");
		$datanya = $cek_usernya->fetch_assoc();
		if (mysqli_num_rows($cek_usernya) == 1) {
			if ($aksinya == 'profile') {
					$cek_user = $conn->query("SELECT * FROM users WHERE api_key = '$apinya'");
					while($rows = mysqli_fetch_array($cek_user)){
					$hasilnya = "-";
					$this_data[] = array('nama' => $rows['nama'], 'username' => $rows['username'], 'email' => $rows['email'], 'sisa_saldo' => $rows['saldo'], 'total_pemakaian' => $rows['pemakaian_saldo']);
                }
						$hasilnya = array('status' => true, 'data' => $this_data);
			} else {
				$hasilnya = array('status' => false, 'data' => array('pesan' => 'Permintaan Salah'));
			}
		} else {
			$hasilnya = array('status' => false, 'data' => array('pesan' => 'Api Key Salah'));
		}
	}
} else {
	$hasilnya = array('status' => false, 'data' => array('pesan' => 'Permintaan Tidak Sesuai'));
}

print(json_encode($hasilnya, JSON_PRETTY_PRINT));