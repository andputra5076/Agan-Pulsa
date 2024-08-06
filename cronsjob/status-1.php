<?php
require("../config.php");
$cek_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE status IN ('','Pending','Processing','In progress') AND provider = 'ZAYNFLAZZ'");

if (mysqli_num_rows($cek_pesanan) == 0) {
  die("Order Pending Tidak Ditemukan.");
} else {
  while($data_pesanan = $cek_pesanan->fetch_assoc()) {
    $poid =  $data_pesanan['provider_oid'];
    $oid =  $data_pesanan['oid'];
    $id =  $data_pesanan['id'];
    $o_provider =  $data_pesanan['provider'];

    if ($o_provider == "MANUAL") {
      echo "Order manual<br />";
    } else {

      $cek_provider = $conn->query("SELECT * FROM provider WHERE code = 'ZAYNFLAZZ'");
      $data_provider = $cek_provider->fetch_assoc();

      if ($o_provider !== "MANUAL") {
        $api_postdata = "api_key=".$data_provider['api_key']."&action=status&id=$poid";
      } else {
        die("System error");
      }
      $url = 'https://zaynflazz.com/api/sosial-media';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $api_postdata);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $chresult = curl_exec($ch);
      //echo $chresult;
      curl_close($ch);
      $json_result = json_decode($chresult, true);
      print_r($json_result);

    	if ($json_result['data']['status'] == "Pending") {
				$u_status = "Pending";
			} else if ($json_result['data']['status'] == "Processing") {
				$u_status = "Processing";
			} else if ($json_result['data']['status'] == "In progress") {
				$u_status = "Processing";
			} else if ($json_result['data']['status'] == "In Progress") {
				$u_status = "Processing";
			} else if ($json_result['data']['status'] == "Canceled") {
				$u_status = "Error";	
			} else if ($json_result['data']['status'] == "Partial") {
				$u_status = "Partial";
			} else if ($json_result['data']['status'] == "Error") {
				$u_status = "Error";
			} else if ($json_result['data']['status'] == "Completed") {
				$u_status = "Success";	
			} else if ($json_result['data']['status'] == "Success") {
				$u_status = "Success";
			}

			$u_start = $json_result['data']['start_count'];
			$u_remains = $json_result['data']['remains'];
			
      $update_pesanan = $conn->query("UPDATE pembelian_sosmed SET status = '$u_status', start_count = '$u_start', remains = '$u_remains' WHERE id = '$id' AND provider = 'ZAYNFLAZZ'");
      if ($update_pesanan == TRUE) {
        echo "<b>Status Order Diupdate</b> <br/>
        Order ID: $poid <br/>
        Status: $u_status <br/>
        Start: $u_start <br/>
        Remains: $u_remains <br/><br/>";
      } else {
        echo "Error database";
      }
    }
  }
}

?>