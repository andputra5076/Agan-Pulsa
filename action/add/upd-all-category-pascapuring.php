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

$indeks=0; 
$i = 1;
// get data service
foreach($result->data as $data) {

$category = $data->brand;
$type = $data->category;
$indeks++; 
$i++;
// end get data service 

	$check_kategori_pasca = mysqli_query($conn, "SELECT * FROM kategori_pulsa WHERE nama = '$category' AND tipe = '$type'");
	$data_services_pasca = mysqli_fetch_assoc($check_kategori_pasca);
	if(mysqli_num_rows($check_kategori_pasca) > 0) {
		echo"<b>Kategori Sudah Ada</b> <br/>
		Kategori: $category <br/>
		Kode: $category <br/>
		Tipe: $type <br/><br/>";
	} else {
		//Memasukan ke Database
		$insert = mysqli_query($conn, "INSERT INTO kategori_pulsa (nama, kode, tipe) VALUES ('$category', '$category', '$type') ");
		if($insert == TRUE){
			echo"<b>Kategori Disimpan</b> <br/>
			Kategori: $category <br/>
			Kode: $category <br/>
			Tipe: $type <br/><br/>";
		} else{
			echo "<b>Kategori Gagal Disimpan</b> <br/>";
		}
	}
}

?>