<?php
require("../config.php");
$cek_pesanan = $conn->query("SELECT * FROM pembelian_pulsa WHERE status IN ('','Pending','Processing') AND provider = 'DIGIFLAZZ'");

if (mysqli_num_rows($cek_pesanan) == 0) {
  die("Order Pending Tidak Ditemukan.");
} else {
  while($data_pesanan = $cek_pesanan->fetch_assoc()) {
    $pid =  $data_pesanan['provider_oid'];
    $oid =  $data_pesanan['oid'];
    $id =  $data_pesanan['id'];
    $harga = $data_pesanan['harga'];
    $o_provider =  $data_pesanan['provider'];
    $layanan = $data_pesanan['layanan'];
    $target = $data_pesanan['target'];

    if ($o_provider == "MANUAL") {
      echo "Order manual<br />";
    } else {

    
    $getService = $conn->query("SELECT * FROM layanan_pulsa WHERE layanan = '$layanan' AND provider = '$o_provider'");
    $getDataService = mysqli_fetch_assoc($getService);
        
    $cek_provider = $conn->query("SELECT * FROM provider WHERE code = 'DIGIFLAZZ'");
    $data_provider = $cek_provider->fetch_assoc();

    $p_apikey = $data_provider['api_key'];
	$p_api_id = $data_provider['api_id'];

        $url = "https://api.digiflazz.com/v1/transaction";
        $sign = md5($p_api_id.$p_apikey.$oid);

        $header = array(
            'Content-Type: application/json',
        );

        $data = array( 
            'command' => 'status-pasca',
            'username' => $p_api_id,
            'buyer_sku_code' => $getDataService['provider_id'],
            'customer_no' => $data_pesanan['target'],
            'ref_id' => $oid,
            'sign' => $sign
        );
        // echo json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        $result = json_decode($result, true);
         //echo $result;
         print_r ($result);

        $sn = $result['data']['sn'];
        $ht_status = $result['data']['status'];

		if($ht_status == 'Pending'){
        $status = 'Pending';
      }else if($ht_status == 'Processing'){
        $status = 'Processing';
      }else if($ht_status == 'Gagal'){
        $status = 'Error';
      }else if($ht_status == 'Partial'){
        $status = 'Partial';
      }else if($ht_status == 'Sukses'){
        $status = 'Success';
      } else {
        $status = 'Pending';
      }

      $update_pesanan = $conn->query("UPDATE pembelian_pulsa SET keterangan = '$sn', status = '$status' WHERE provider_oid = '$pid' AND provider = 'DIGIFLAZZ'");
      if ($update_pesanan == TRUE) {
        echo "<b>Status Order Diupdate</b> <br/>
        Provider ID: $pid <br/>
        Order ID: $oid <br/>
        Layanan: $layanan <br/>
        Target: $target <br/>
        Status: $status <br/>
        Catatan: $sn <br/><br/>";
      } else {
        echo "Error database";
      }
    }
  }
}

?>