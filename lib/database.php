<?php
// ===== Halaman Admin ===== //
//Count Users
$total_pengguna = mysqli_num_rows($conn->query("SELECT * FROM users"));
//Count Pesanan
$count_pesanan_sosmed = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed"));
//Total Pemesanan
$total_pemesanan_sosmed = $conn->query("SELECT SUM(harga) AS total FROM pembelian_sosmed");
$data_pesanan_sosmed = $total_pemesanan_sosmed->fetch_assoc();
//Count Deposit
$count_deposit = mysqli_num_rows($conn->query("SELECT * FROM deposit"));
//Total Deposit
$total_deposit = $conn->query("SELECT SUM(jumlah_transfer) AS total FROM deposit");
$data_deposit = $total_deposit->fetch_assoc();
// Total Profit Pembelian Sosmed Perbulan
$ThisProfitSosmed = $conn->query("SELECT SUM(profit) AS total FROM pembelian_sosmed WHERE MONTH(pembelian_sosmed.date) = '".date('m')."' AND YEAR(pembelian_sosmed.date) = '".date('Y')."'");
$ProfitSosmed = $ThisProfitSosmed->fetch_assoc();

$ThisTotalSosmed = $conn->query("SELECT SUM(harga) AS total FROM pembelian_sosmed WHERE MONTH(pembelian_sosmed.date) = '".date('m')."' AND YEAR(pembelian_sosmed.date) = '".date('Y')."'");
$AllSosmed = $ThisTotalSosmed->fetch_assoc();

$CountProfitSosmed = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE MONTH(pembelian_sosmed.date) = '".date('m')."' AND YEAR(pembelian_sosmed.date) = '".date('Y')."'"));

// ===== Data Tiket ===== //
$AllTiketUsers = $conn->query("SELECT * FROM tiket WHERE status = 'Pending'");
// ======================== //

// ===== ============ ===== //

// ===== Halaman Pengguna ===== //
// Data User
    $jumlah_order_sosmed = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE user = '$sess_username'"));
    $jumlah_deposit_user = mysqli_num_rows($conn->query("SELECT * FROM deposit WHERE username = '$sess_username' AND status = 'Success'"));
   $total_deposit_user = $conn->query("SELECT SUM(jumlah_transfer) AS total FROM deposit WHERE username = '$sess_username'");
   $data_deposit_user = $total_deposit_user->fetch_assoc();

    $cek_order_sosmed = $conn->query("SELECT SUM(harga) AS total FROM pembelian_sosmed WHERE user = '$sess_username'");
    $data_order_sosmed = $cek_order_sosmed->fetch_assoc();    
// ===== ============== ===== //

// ===== Data Halaman Kontak ===== //
    $CallDbHalaman = $conn->query("SELECT * FROM halaman WHERE id = '1'");
    $PageContact = $CallDbHalaman->fetch_assoc();
// ======================== //

// ===== Data Tiket ===== //
    $CallDBTiket = $conn->query("SELECT * FROM tiket WHERE status = 'Responded' AND user = '$sess_username'");
// ======================== //

// ===== Data Website ===== //
    $panggil = $conn->query("SELECT * FROM setting_web WHERE id = '1'");
    $data = $panggil->fetch_assoc();

// ===== Data User Online ===== //
    $cek_user_online = $conn->query("SELECT * FROM set_online_users ");
    $data_User_Online = $cek_user_online->fetch_assoc();  
    
// ===== Data User / Layanan ===== //
    $Cek_User_layanan = $conn->query("SELECT * FROM set_total_pengguna ");
    $Data_User_layanan = $Cek_User_layanan->fetch_assoc();  
    
// ======================== //
$total_depo_succes = mysqli_num_rows($conn->query("SELECT * FROM deposit WHERE status = 'Success'"));
$total_depo_error = mysqli_num_rows($conn->query("SELECT * FROM deposit WHERE status = 'Error'"));
$total_depo_pending = mysqli_num_rows($conn->query("SELECT * FROM deposit WHERE status = 'Pending'"));

$total_sosmed_succes = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE status = 'Success'"));
$total_sosmed_completed = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE status = 'Completed'"));
$total_sosmed_error = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE status = 'Error'"));
$total_sosmed_canceled = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE status = 'Canceled'"));
$total_sosmed_pending = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE status = 'Pending'"));
$total_sosmed_partial = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE status = 'Partial'"));
$total_sosmed_processing = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE status = 'processing'"));
$total_sosmed_progress = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE status = 'In Progress'"));

$aktif =  mysqli_num_rows($conn->query("SELECT * FROM users WHERE status = 'Aktif'"));
$nonaktif =  mysqli_num_rows($conn->query("SELECT * FROM users WHERE status = 'Tidak Aktif'"));

$kontak_kami = $conn->query("SELECT * FROM kontak_kami WHERE id = '1'");
$data_kontak = $kontak_kami->fetch_assoc();
?>