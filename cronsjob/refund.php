<?php
require("../config.php");
$cek_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE status IN ('Error','Partial','Canceled') AND refund = '0'");

if (mysqli_num_rows($cek_pesanan) == 0) {
	die("Order Error or Partial not found.");
} else {
	while($data_pesanan = mysqli_fetch_assoc($cek_pesanan)) {
		
		    $harga = $data_pesanan['harga'] / $data_pesanan['jumlah'];
		    $profit = $data_pesanan['profit'] / $data_pesanan['jumlah'];
		    $refund1 = $harga * $data_pesanan['remains'];
		    $refund2 = $profit * $data_pesanan['remains'];
		    
		    if($data_pesanan['remains'] == 0) {
		        $refund1 = $data_pesanan['harga'];
		        $refund2 = $data_pesanan['profit'];
		    }
		    
			$update_user = $conn->query("UPDATE users SET pemakaian_saldo = pemakaian_saldo-$refund1 WHERE user = '".$data_pesanan['user']."'");
			$update_user = $conn->query("UPDATE users SET saldo = saldo+$refund1 WHERE username = '".$data_pesanan['user']."'");
			$update_order = $conn->query("INSERT INTO history_saldo VALUES ('', '".$data_pesanan['user']."', 'Penambahan Saldo', '$refund1', 'Pengembalian Dana Dari Pemesanan Pada Fitur Sosial Media Akibat Status Pesanan Error/Partial Dengan Order ID ".$data_pesanan['oid']."', '$date', '$time')");
    		$update_order = $conn->query("UPDATE pembelian_sosmed SET refund = '1' , profit = profit-$refund2  WHERE oid = '".$data_pesanan['oid']."'");
    		if ($update_order == TRUE) {
    			echo "Refunded Rp $refund1 - ".$data_pesanan['oid']." Untuk  ".$data_pesanan['user']."<br />";
    		} else {
    			echo "Error database.";
    		}
	}
}