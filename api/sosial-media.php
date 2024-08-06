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
			if ($aksinya == 'pemesanan') {
				if (isset($_POST['layanan']) AND isset($_POST['target']) AND isset($_POST['jumlah'])) {
					$layanan = $conn->real_escape_string(trim(filter($_POST['layanan'])));
					$target = $conn->real_escape_string(trim(filter($_POST['target'])));
					$jumlah = $conn->real_escape_string(trim(filter($_POST['jumlah'])));
					if (!$layanan || !$target || !$jumlah) {
						$hasilnya = array('status' => false, 'data' => array('pesan' => 'Permintaan Tidak Sesuai'));
					} else {
						$cek_layanan = $conn->query("SELECT * FROM layanan_sosmed WHERE service_id = '$layanan' AND status = 'Aktif'");
						$data_layanan = $cek_layanan->fetch_assoc();
						if (mysqli_num_rows($cek_layanan) == 0) {
							$hasilnya = array('status' => false, 'data' => array('pesan' =>'server overload silahkan gunakan layanan lain'));
						} else {
							$order_id = acak_nomor(3).acak_nomor(4);
							$cek_profit = $data_layanan['profit'] / 1000;
							$cek_harga = $data_layanan['harga_api'] / 1000;
							$profit = $cek_profit*$jumlah;
							$harga = $cek_harga*$jumlah;
							$provider = $data_layanan['provider'];
        							//Get Start Count
        							if ($data_layanan['kategori'] == "Instagram Likes" AND "Instagram Likes Indonesia" AND "Instagram Likes [Targeted Negara]" AND "Instagram Likes/Followers Per Minute") {
            							$start_count = likes_count($target);
        							} else if ($data_layanan['kategori'] == "Instagram Followers No Refill/Not Guaranteed" AND "Instagram Followers Indonesia" AND "Instagram Followers [Negara]" AND "Instagram Followers [Refill] [Guaranteed] [NonDrop]") {
            							$start_count = followers_count($target);
        							} else if ($data_layanan['kategori'] == "Instagram Views") {
            							$start_count = views_count($target);
        							} else {
            							$start_count = 0;
        							}
							if ($jumlah > $data_layanan['min']) {
								$hasilnya = array('status' => false, 'data' => array('pesan' =>'minimum order is not appropriate'));
							} else if ($jumlah > $data_layanan['max']) {
								$hasilnya = array('status' => false, 'data' => array('pesan' =>'max order does not match'));
							} else if ($datanya['saldo'] < $harga) {
								$hasilnya = array('status' => false, 'data' => array('pesan' =>'your balance is not sufficient to place this order'));
							} else {
								$cek_provider = $conn->query("SELECT * FROM provider WHERE code = '$provider'");
								$data_provider = $cek_provider->fetch_assoc();
 
                                if ($provider == "MANUAL") {
                                    $post_datanya = "";
                                    $provider_oid = $order_id;
                                } else if ($provider == "ZAYNFLAZZ"){
                                    $post_datanya = "api_key=".$data_provider['api_key']."&pemesanan=".$data_layanan['service_id']."&target=$target&jumlah=$jumlah";
                                    $url = "https://zaynflazz.com/api/sosial-media";
                                }
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, $url);
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_datanya);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                    $chresult = curl_exec($ch);
                                    curl_close($ch);
                                    $resultnya = json_decode($chresult, true);
 
                                if ($provider == "ZAYNFLAZZ" AND $resultnya['status'] == false) {
                                    $hasilnya = array('status' => false, 'data' => array('pesan' => 'Ups, Server Kami Sedang Mengalami Gangguan, Silakan Di Coba Lagi Nanti.'));
                                } else {
 
                                    if ($provider == "ZAYNFLAZZ") {
                					    $provider_oid = $resultnya['data']['id'];
                				    }
 
 
                                    if ($conn->query("INSERT INTO pembelian_sosmed VALUES ('','$order_id', '$provider_oid', '".$datanya['username']."', '".$data_layanan['layanan']."', '$target', '$jumlah', '0', '$start_count', '$harga', '$profit', 'Pending', '$date', '$time', '$provider', 'API', '0')") == true) {
				 						$conn->query("UPDATE users SET saldo = saldo-$harga, pemakaian_saldo = pemakaian_saldo+$harga WHERE username = '".$datanya['username']."'");
										$conn->query("INSERT INTO history_saldo VALUES ('', '".$datanya['username']."', 'Pengurangan Saldo', '$harga', 'Pemesanan Sosial Media Via API Dengan Order ID $order_id', '$date', '$time')");	
										$hasilnya = array('status' => true, 'data' => array('id' => $order_id, 'start_count' => $start_count));
										} else {
										$hasilnya = array('status' => false, 'data' => array('pesan' => 'System Error'));
									}
								}
							}
						}
					}
				} else {
					$hasilnya = array('status' => false, 'data' => array('pesan' => 'System Error'));
					}
			} else if ($aksinya == 'status') {
				if (isset($_POST['id'])) {
					$order_id = $conn->real_escape_string(trim($_POST['id']));
					$cek_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE oid = '$order_id' AND user = '".$datanya['username']."'");
					$data_pesanan = mysqli_fetch_array($cek_pesanan);
					if (mysqli_num_rows($cek_pesanan) == 0) {
						$hasilnya = array('status' => false, 'data' => array('pesan' => 'Order ID Tidak Di Temukan'));
					} else {
						$hasilnya = array('status' => true, 'data' => array("id" => $data_pesanan['oid'], 'status' => $data_pesanan['status'], 'start_count' => $data_pesanan['start_count'], 'remains' => $data_pesanan['remains']));
					}
				} else {
					$hasilnya = array('status' => false, 'data' => array('pesan' => 'Permintaan Tidak Sesuai'));
				}
			} else if ($aksinya == 'layanan') {
					$cek_layanan = $conn->query("SELECT * FROM layanan_sosmed WHERE status = 'Aktif' AND tipe = 'Sosial Media'");
					while($rows = mysqli_fetch_array($cek_layanan)){
					$hasilnya = "-";
					$this_data[] = array('sid' => $rows['service_id'], 'kategori' => $rows['kategori'], 'layanan' => $rows['layanan'], 'catatan' => $rows['catatan'], 'min' => $rows['min'], 'max' => $rows['max'], 'harga' => $rows['harga_api']);
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