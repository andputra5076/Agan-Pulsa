<?php 
require_once("../../config.php");

$check_provider = $conn->query("SELECT * FROM provider WHERE code = 'DIGIFLAZZ'");
$data_provider = mysqli_fetch_assoc($check_provider);

    $p_apiid = $data_provider['api_id'];
    $p_apikey = $data_provider['api_key'];

    $url = "https://api.digiflazz.com/v1/price-list";
    $sign = md5("$p_apiid+$p_apikey+pricelist");

    $data = array( 
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
$tipe = $data->type;
$indeks++; 
$i++;
// end get data service 

		//INSERT LAYANAN
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
		
	$check_kategori_pulsa = mysqli_query($conn, "SELECT * FROM kategori_pulsa WHERE nama = '$type2 $category2 $tipe2' AND tipe = '$type3'");
	$data_services_pulsa = mysqli_fetch_assoc($check_kategori_pulsa);
	if(mysqli_num_rows($check_kategori_pulsa) > 0) {
		echo"<b>Kategori Sudah Ada</b> <br/>
		Kategori: $type2 $category2 $tipe2 <br/>
		Kode: $type2 $category2 $tipe2 <br/>
		Tipe: $type3 <br/><br/>";
	} else {
		//Memasukan ke Database
		$insert = mysqli_query($conn, "INSERT INTO kategori_pulsa (nama, kode, tipe) VALUES ('$type2 $category2 $tipe2', '$type2 $category2 $tipe2', '$type3') ");
		if($insert == TRUE){
			echo"<b>Kategori Disimpan</b> <br/>
			Kategori: $type2 $category2 $tipe2 <br/>
			Kode: $type2 $category2 $tipe2 <br/>
			Tipe: $type3 <br/><br/>";;
		} else{
			echo "<b>Kategori Gagal Disimpan</b> <br/>";
		}
	}
}

?>