<?php
/*
* Recode by https://rdptma.id
* Change this? Allah Swt. can see you.
*/
require_once("../../config.php");

$cek_provider = mysqli_query($conn, "SELECT * FROM `provider` WHERE `id` = '1'");
$data_provider = mysqli_fetch_assoc($cek_provider);

if (mysqli_num_rows($cek_provider) != 0) {
$api_key = $data_provider['api_key'];
$secret_key = $data_provider['secret_key'];
$url = $data_provider['link'];
$keuntungan = $data_provider['profit'];
$name_provider = $data_provider['code'];

	$postdata = "api_key=$api_key&action=layanan";	
	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
//echo $chresult;
curl_close($ch);
$json_result = json_decode($chresult, true);
//print_r($json_result);

$no = 1;
$indeks = 0; 
while($indeks < count($json_result['data'])){ 
	$id_provider = $json_result['data'][$indeks]['sid'];
	$kategori = $json_result['data'][$indeks]['kategori'];
	$layanan = $json_result['data'][$indeks]['layanan'];
	$price = $json_result['data'][$indeks]['harga'];
	$min = $json_result['data'][$indeks]['min'];
	$max = $json_result['data'][$indeks]['max'];
	$catatan = $json_result['data'][$indeks]['catatan'];
	$provider = $name_provider;
	$price_after = $price *$keuntungan ;
	$profit_after = $price_after - $price ;
	$status = "Aktif";
	$tipe = "Sosial Media";
	$indeks++;

	//INSERT KATEGORI KE DATABASE kategori_layanan
	$cek_kategori = $conn->query("SELECT * FROM kategori_layanan WHERE nama = '$kategori' AND tipe = '$tipe'");
	if(mysqli_num_rows($cek_kategori) > 0){
	}else{
		$input_kategori = $conn->query("INSERT INTO kategori_layanan VALUES ('','$kategori','$kategori','$tipe')");
	}
	//INSERT UPDATE KE DATABASE layanan_sosmed
	$cek_layanan = $conn->query("SELECT * FROM layanan_sosmed WHERE provider_id = '$id_provider' AND provider = '$provider'");
	$data_layanan = $cek_layanan->fetch_assoc();
	if(mysqli_num_rows($cek_layanan) > 0) {
		$update = mysqli_query($conn, "UPDATE layanan_sosmed SET harga = '$price_after', harga_api = '$price', profit = '$profit_after', status = '$status' WHERE provider_id = '$id_provider' AND provider = '$provider'");
		echo "<b>Layanan Sudah Ada & Harga Diupdate</b> <br/>
		Provider ID: $id_provider <br/>
		Kategori: $kategori <br/>
		Layanan: $layanan <br/>
		Harga Provider: $api <br/>
		Min. Order: $min <br/>
		Max. Order: $max <br/>
		Catatan: $catatan <br/>
		Provider: $provider <br/>
		Harga Web: $price_after <br/>
		Harga Api: $price <br/>
		Status: $status <br/>
		Tipe: $tipe <br/><br/>";
	} else {

		//REPLACE NAMA LAYANAN DI PROVIDER layanan_sosmed
		$layanan = strtr($layanan, array(
			'ZF' => 'NW',
			'Zaynflazz' => 'Zaynflazz',
			'ZAYNFLAZZ' => 'Zaynflazz',
			'ZaynFlazz' => 'Zaynflazz',
		));

		$sid = $no++;
		$insert_layanan = $conn->query("INSERT INTO layanan_sosmed VALUES ('','$sid' ,'$kategori' ,'$layanan' ,'$catatan' ,'$min' ,'$max' ,'$price_after' ,'$price', '$profit_after', '$status' ,'$id_provider' ,'$provider' ,'$tipe')");
		if($insert_layanan == TRUE){
			echo "<b>Data Berhasil Disimpan</b> <br/>
			Provider ID: $id_provider <br/>
			Kategori: $kategori <br/>
			Layanan: $layanan -Rp $price_after<br/>
			Harga Provider: $api <br/>
			Min. Order: $min <br/>
			Max. Order: $max <br/>
			Catatan: $catatan <br/>
			Provider: $provider <br/>
			Harga Web: $price_after <br/>
			Harga Api: $price <br/>
			Status: $status <br/>
			Tipe: $tipe <br/><br/>";
		}else{
			echo "<b>Data Gagal Disimpan</b> <br/>";
		}
	}
}
}
