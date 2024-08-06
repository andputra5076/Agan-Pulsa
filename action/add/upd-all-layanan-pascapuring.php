<?php 
require_once("../../config.php");

	$check_provider = $conn->query("SELECT * FROM provider WHERE code = 'DIGIFLAZZ'");
    $data_provider = mysqli_fetch_assoc($check_provider);

    $p_apiid = $data_provider['api_id'];
    $p_apikey = $data_provider['api_key'];

    $url = "https://api.digiflazz.com/v1/price-list";
    $sign = md5("$p_apiid+$p_apikey+pricelist");

    $data = array( 
        'cmd' => "pasca",
	    'username' => $p_apiid,
	    'sign' => $sign
    );
    $header = array(
    'Content-Type: application/json',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    // echo $response;
    // die;
    $result = json_decode($response);
    // print_r($result);

$i = 1;
$indeks=0; 
// get data service
foreach($result->data as $data) {

$id = $data->buyer_sku_code;
$category = $data->brand;
$service = $data->product_name;
$admin = $data->admin;
$komisi = $data->commission;
$type = $data->category;
$provider = "DIGIFLAZZ";
$ht_status = $data->buyer_product_status;
$indeks++; 
// end get data service 

		if ($ht_status == true) {
			$status = "Normal";
		} else if ($ht_status == false) {
			$status = "Gangguan";
		}

		$check_layanan_pascabayar = mysqli_query($conn, "SELECT * FROM layanan_pascabayar WHERE provider_id = '$sid'");
		$data_layanan_pascabayar = mysqli_fetch_assoc($check_layanan_pascabayar);
		if(mysqli_num_rows($check_layanan_pascabayar) > 0) {
		echo"<b>Produk Berhasil Di Update</b> <br/>
		Layanan : $service <br/>
		Admin : $admin <br/>
		Komisi : $komisi <br/>
		Status : $ht_status <br/>
		Tipe : $type <br/>
		Provider : $provider <br/><br/>";
	} else {
	    $sid = $i++;
		$insert = mysqli_query($conn, "INSERT INTO layanan_pascabayar VALUES ('', '$sid', '$id', '$category', '$service', '$admin', '$komisi', '$ht_status', '$provider', '$type') ");
		if($insert == TRUE){
			echo"<b>Produk Berhasil Disimpan</b> <br/>
			Layanan : $service <br/>
			Admin : $admin <br/>
			Komisi : $komisi <br/>
			Status : $ht_status <br/>
			Tipe : $type <br/>
		    Provider : $provider <br/><br/>";
		} else{
			echo "<b>Layanan Gagal Disimpan</b> <br/>";
		}
	}
}

?>
