<?php 
require_once("../../config.php");

$check_provider = $conn->query("SELECT * FROM provider WHERE code = 'DIGIFLAZZ'");
$data_provider = mysqli_fetch_assoc($check_provider);

    $p_apiid = $data_provider['api_id'];
    $p_apikey = $data_provider['api_key'];
    $keuntungan = $data_provider['profit'];
    $sign = md5($p_apiid.$p_apikey."pricelist");

    $data = array( 
        'cmd' => 'prepaid',
	    'username' => $p_apiid,
	    'sign' => $sign
    );
    $header = array(
    'Content-Type: application/json',
    );
    
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.digiflazz.com/v1/price-list");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
    // echo $response;
    // die;
    $result = json_decode($response);
     print_r($result);
$i = 1;
$indeks=0; 
// get data service
foreach($result->data as $data) {

$id = $data->buyer_sku_code;
$category = $data->brand;
$type = $data->category;
$service = $data->product_name;
$description = $data->desc;
$api = $data->price;
$ht_status = $data->buyer_product_status;
$ht_multi = $data->multi;
$tipe = $data->type;
$provider = "DIGIFLAZZ";
$harga = $api+$keuntungan;
$harga_api = $api;
$untung = $harga-$api;
$indeks++; 

    if ($ht_status == true) {
			$status = "Normal";
		} else if ($ht_status == false) {
			$status = "Gangguan";
		}
		
	if ($ht_multi == true) {
			$multi = "Ya";
		} else if ($ht_multi == false) {
			$multi = "Tidak";
		}
	        
	$category2 = strtr($category, array(
	            'TELKOMSEL' => 'Telkomsel',
	            'INDOSAT' => 'Indosat',
	            'AXIS' => 'Axis',
	            'SMART' => 'Smart',
	            'TRI' => 'Tri',
	            'GARENA' => 'Garena',
	            'MOBILE LEGEND' => 'Mobile Legend',
	            'POINT BLANK' => 'Point Blank',
	            'FREE FIRE' => 'Free Fire',
	            'ARENA OF VALOR' => 'Arena Of Valor',
	            'PUBG MOBILE' => 'PUBG Mobile',
	            'AU2 MOBILE' => 'AU2 Mobile',
	            'Call of Duty MOBILE' => 'Call of Duty Mobile',
	            'BOYAA DOMINO QIUQIU' => 'Boyaa Domino QiuQiu',
	            'HAGO' => 'Hago',
	            'LOST SAGA' => 'Lost Saga',
	            'DRAGON RAJA - SEA' => 'Dragon Raja - Sea',
	            'GOOGLE PLAY INDONESIA' => 'Google Play Indonesia',
	            'GOOGLE PLAY US REGION' => 'Google Play US Region',
	            'ITUNES US REGION' => 'ITunes US Region',
	            'MEGAXUS' => 'Megaxus',
	            'PLAYSTATION' => 'Playstation',
	            'WAVE GAME' => 'Wave Game',
	            'WIFI ID' => 'Wifi ID',
	            'ALFAMART VOUCHER' => 'Alfamart',
	            'INDOMARET' => 'Indomaret',
	            'SPOTIFY' => 'Spotify',
	            'JUNGLELAND' => 'JungleLand',
	            'GRAB' => 'Grab',
	            'XBOX' => 'Xbox',
	            'GO PAY' => 'Gopay',
	            'MANDIRI E-TOLL' => 'Mandiri E-Toll',
	            'BUKALAPAK' => 'Bukalapak',
	            'TAPCASH BNI' => 'Tapcash BNI',
	            'SHOPEE PAY' => 'Shopee Pay',
	            'BRI BRIZZI' => 'BRI Brizzi',
	            'MAXIM' => 'Maxim',
	            'CHINA TOPUP' => '',
	            'MAXIS' => 'Maxis',
	            'DIGI' => 'Digi',
	            'CELCOM' => 'Celcom',
	            'UMOBILE' => 'Umobile',
	            'TUNETALK' => 'Tunetalk',
	            'SMART PINOY' => 'Smart Pinoy',
	            'Philippines - SMART' => 'Philippines - Smart',
	            'GLOBE' => 'Globe',
	            'SUN TELECOM' => 'Sun Telecom',
	            'XOX' => 'Xox',
	            'SINGTEL' => 'Singtel',
	            'STARHUB' => 'Starhub',
	            'THAILAND TOPUP' => '',
	            'VIETNAM TOPUP' => '',
	            'ORANGE TV' => 'Orange TV',
	            'Disney+ Hotstar' => 'Disney Hotstar',
	            'GamesMAX' => 'GamesMax',
	            'GigaMAX' => 'GigaMax',
	            'InternetMAX' => 'InternetMax',
	            'MusicMAX' => 'MusicMax',
	            'UnlimitedMAX' => 'UnlimitedMax',
	            '&' => '',
	    ));
	    
	$tipe2 = strtr($tipe, array(
	        'Umum' => '',
	        'Pulsa Transfer' => 'Transfer',
	        'Pulsa Gift' => 'Gift',
	        'Gift Data' => 'Gift',
	    ));
	      
	$type2 = strtr($type, array(
	        'Paket SMS & Telpon' => '',
	        'PLN' => 'Token',
	        'China TOPUP' => 'China',
	        'Malaysia TOPUP' => 'Malaysia',
	        'Philippines TOPUP' => 'Philippines',
	        'Singapore TOPUP' => 'Singapore',
	        'Thailand TOPUP' => 'Thailand',
	        'Vietnam TOPUP' => 'Vietnam',
	    )); 
	    
	$type3 = strtr($type, array(
			'China TOPUP' => 'Pulsa Internasional',
			'Malaysia TOPUP' => 'Pulsa Internasional',
			'Philippines TOPUP' => 'Pulsa Internasional',
			'Singapore TOPUP' => 'Pulsa Internasional',
			'Thailand TOPUP' => 'Pulsa Internasional',
			'Vietnam TOPUP' => 'Pulsa Internasional',
			'Paket SMS & Telpon' => 'Paket Sms Telpon'
		));
		
	$service2 = strtr($service, array(
	    '&' => '',
	    ));

	$check_layanan_pulsa = mysqli_query($conn, "SELECT * FROM layanan_pulsa WHERE provider_id = '$id' AND provider = '$provider'");
	$data_layanan_pulsa = mysqli_fetch_assoc($check_layanan_pulsa);
	if(mysqli_num_rows($check_layanan_pulsa) > 0) {
		$update = mysqli_query($conn, "UPDATE layanan_pulsa SET harga = '$harga', harga_api = '$harga_api', profit = '$untung', status = '$status' WHERE provider_id = '$id' AND provider = '$provider'");
		echo ($update == TRUE) ? '<b>Produk & Harga Berhasil Diupdate</b> <br/>
		Provider ID: '.$id.' <br/>
		Operator: '.$type2.' '.$category2.' '.$tipe2.' <br/>
		Nama: '.$service2.'.<br/>
		Status Provider: '.$ht_status.' <br/>
		Harga Provider: '.$api.' <br/>
		Tipe: '.$type3.'.<br/>
		Catatan: '.$description.' <br/>
		Provider: '.$provider.' <br/>
		Harga Web: '.$harga.' <br/>
		Harga Api: '.$harga_api.' <br/>
		Status Web: '.$status.' <br/><br/>
		' : '<b>Produk & Harga Gagal Diupdate</b>: '.mysqli_error($conn).'<br/>';
	} else {
	    $sid = $i++;
		$insert = mysqli_query($conn,"INSERT INTO layanan_pulsa(service_id, provider_id, operator, layanan, harga, harga_api, profit, multi, status, provider, tipe, catatan) VALUES ('$sid','$id','$type2 $category2 $tipe2','$service2','$harga','$harga_api','$untung','$multi','$status','$provider','$type3','$description')");
		if($insert == TRUE){
			echo"<b>Produk Berhasil Disimpan</b> <br/>
			Provider ID: $id <br/>
			Operator: $type2 $category2 $tipe2 <br/>
			Nama: $service2 <br/>
			Status Provider: $ht_status <br/>
			Harga Provider: $api <br/>
			Tipe: $type3 <br/>
			Catatan: $description <br/>
			Provider: $provider <br/>
			Harga Web: $harga <br/>
			Harga Api: $harga_api <br/>
			Status Web: $status <br/><br/>";
		}else{
			echo "<b>Produk Gagal Disimpan</b> <br/>";
		}
	}
}

?>