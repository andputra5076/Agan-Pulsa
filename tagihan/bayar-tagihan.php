<?php
require '../mainconfig.php';
require '../lib/check_session.php';
if ($_POST) {
	require '../lib/is_login.php';
	$input_data = array('service', 'nomor_pelanggan');
	if (check_input($_POST, $input_data) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Input tidak sesuai!",text: "silakan coba lagi!"});</script>');
		header("location:/");
	} else {
		$validation = array(
			'service' => input_request($_POST['service'], $db),
			'phone' => input_request($_POST['nomor_pelanggan'], $db),
		);
		if (check_empty($validation) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Input tidak boleh kosong!",text: "Mohon mengisi semua input!"});</script>');
			header("location:/");
		} else {
			$service = $model->db_query($db, "*", "services_pascabayar", "sid = '".mysqli_real_escape_string($db, $_POST['service'])."' AND status = 'Active'");
			if ($service['count'] == 0) {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Layanan tidak ditemukan!",text: "Silakan hubungi admin!"});</script>');
				header("location:/");
			} else {
				$provider = $model->db_query($db, "*", "provider", "name = '".$service['rows']['provider']."'");
				$username = $provider['rows']['api_id'];
				$api_key = $provider['rows']['api_key'];
				if ($service['rows']['provider'] == 'DIGIFLAZZ') {
				    $oid = random_number(3).random_number(4);
                    $post_api = array('commands' => 'inq-pasca', 'username' => 'lixurig4X5kg', // konstan
                        'buyer_sku_code' => $service['rows']['pid'],
                        'customer_no' => input_request($_POST['nomor_pelanggan'], $db),
                        'ref_id' => $oid,
                        'sign' => md5("$username$api_key$oid"),
                        );
                     $data = json_encode($post_api);
                     $header = array(
                        'Content-Type: application/json',
                    );
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    $result = curl_exec($ch);
                    $json_result = json_decode($result, true);
				} else {
			        die("system error!");
			        header("location:/");
				}
				$price = $json_result['data']['selling_price'];
				$ref_id = $json_result['data']['ref_id'];
				if ($service['rows']['provider'] == 'DIGIFLAZZ' AND $json_result['data']['status'] == 'Gagal') {
					$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "'.$chresult['data']['message'].'"});</script>');
					header("location:/");
				}elseif ($provider['count'] == 0) {
					$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Layanan tidak tersedia!"});</script>');
					header("location:/");
				} elseif (empty($ref_id)) {
				   	$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Referensi Id tidak ditemukan!"});</script>');
				    header("location:/");
				} else {
				    if ($login['user_verif'] == 1) {
    				    $total_prices = $service['rows']['price_agen'];
                    } else {
                        $total_prices = $service['rows']['price'];
                    }
					if ($service['rows']['provider'] == 'DIGIFLAZZ') {
                        $data = json_encode(array(
                        'commands' => 'pay-pasca',
                        'username' => '', // konstan
                        'buyer_sku_code' => $service['rows']['pid'],
                        'customer_no' => input_request($_POST['nomor_pelanggan'], $db),
                        'ref_id' => $ref_id,
                        'sign' => md5("$username$api_key$ref_id"),
                        ));
                        $header = array(
                        'Content-Type: application/json',
                        );
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        $result = curl_exec($ch);
                        $chresult = json_decode($result, true);
                        $total_price = $chresult['data']['price'] + $total_prices;
					    $trx_id = $chresult['data']['ref_id'];
					}
					if ($service['rows']['provider'] == 'DIGIFLAZZ' AND $chresult['data']['status'] == 'Gagal') {
						$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "'.$chresult['data']['message'].'"});</script>');
						header("location:/");
			        } elseif ($login['balance'] < $total_price) {
					    $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Saldo kamu tidak cukup, silakan lakukan pengisian saldo!"});</script>');
					    header("location:/");
					} else {
					    
						$input_post = array(
						    'trx_id' => $trx_id,
						    'user' => $login['username'],
							'service' => $service['rows']['service'],
							'price' => $chresult['data']['price'],
							'admin' => $total_prices,
							'total' => $total_price,
							'data' => input_request($_POST['nomor_pelanggan'], $db),
							'pelanggan' => $chresult['data']['customer_name'],
							'status' => 'Pending',
							'created_at' => date('Y-m-d H:i:s'),
							'place_from' => 'WEB',
							'catatan' => 'Sedang diproses',
							'provider' => 'DIGIFLAZZ'
						);
						$insert = $model->db_insert($db, "orders_pascabayar", $input_post);
						if ($insert == true) {
						    // $model->db_insert($db, "notify_wa", array('user' => $login['username'], 'nomor' => $login['nomor'], 'msg' => 'Halo, '.$login['full_name'].'. Anda telah melakukan pembelian *Prabayar* - *'.$config['web']['title'].'* '.$tab_1.' Berikut detail transaksi anda: '.$tab_2.' Transaksi ID: '.$oid.' '.$tab_1.' Nama Layanan: '.$input_post['service'].' '.$tab_1.' Nomor Pelanggan: '.$input_post['phone'].' '.$tab_1.' Harga: Rp. '.number_format($input_post['price'],0,',','.').' '.$tab_2.' Terima kasih telah melakukan transaksi di '.$config['web']['title'].' ^_^ '.$tab_1.' -Jeremy & Team.', 'status' => 'Pending', 'type' => 'Order'));
							$model->db_update($db, "users", array('balance_mobile' => $login['balance_mobile'] - $total_price), "id = '".$login['id']."'");
							$model->db_insert($db, "balance_logs", array('user_id' => $login['id'], 'type' => 'minus', 'amount' => $total_price, 'note' => 'Membuat Pesanan Pascabayar. ID Pesanan: '.$insert.'.', 'created_at' => date('Y-m-d H:i:s')));
							$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => '<script>Swal.fire({type: "success",title: "Berhasil membuat pesanan!",text: "Order ID: '.$trx_id.'!"});</script>');
							header("Location: ".$config['web']['base_url']."order/history/pascabayar");
						} else {
							$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Pesanan gagal dibuat!",text: "silakan coba lagi!"});</script>');
							header("location:/");
						}
					}
				}
			}
		}
	}
}
require '../lib/csrf_token.php';
?>