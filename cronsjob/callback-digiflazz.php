<?php
require("../config.php");

$get = file_get_contents('php://input');
$header = getallheaders();

function DFStatus($x) {
    if($x == 'Transaksi Pending') $str = 'Pending';
    if($x == 'Transaksi Gagal') $str = 'Error';
    if($x == 'Produk Sedang Gangguan') $str = 'Error';
    if($x == 'Timeout') $str = 'Error';
    if($x == 'Saldo tidak cukup') $str = 'Error';
    if($x == 'Transaksi sudah pernah terjadi sebelumnya') $str = 'Error';
    if($x == 'Transaksi Tidak Ditemukan') $str = 'Error';
    if($x == 'Nomor Tujuan Diblokir') $str = 'Error';
    if($x == 'Nomor Tujuan Salah') $str = 'Error';
    if($x == 'Produk Sedang Gangguan') $str = 'Error';
    if($x == 'Sedang Cut Off') $str = 'Error';
    if($x == 'Transaksi Sukses') $str = 'Success';
    return (!$str) ? 'Pending' : $str;
}

if(isset($header['x-digiflazz-event']) && isset($header['x-digiflazz-delivery']) && isset($header['x-hub-signature']) && in_array($header['User-Agent'],['Digiflazz-Hookshot','DigiFlazz-Pasca-Hookshot'])) {
    $array = json_decode($get, true)['data'];
    $json = json_encode($array);
    
    $status = DFStatus($array['message']);
    $trxid = $array['trx_id']; // ID Transaksi DigiFlazz
    $refid = $array['ref_id']; // ID Transaksi dari Panel
    $note = $array['sn'];

    $format = $refid.' -> '.$array['message'].'<br>'.$note;
    print $format;

    $check_order = $conn->query("SELECT * FROM pembelian_pulsa WHERE status IN ('Pending')");
	$data_order = mysqli_fetch_assoc($check_order);

	$o_oid = $data_order['oid'];
	$username = $data_order['user'];
    $layanan = $data_order['layanan'];

    if ($conn->query("SELECT * FROM pembelian_pulsa WHERE oid = '$refid' AND status = 'Pending'")->num_rows == 1); {
        $conn->query("UPDATE pembelian_pulsa SET status = '$status', keterangan = '$note', provider_oid = '$trxid' WHERE oid = '$refid'");
    }
} else {
    print 'Access Denied!';
}