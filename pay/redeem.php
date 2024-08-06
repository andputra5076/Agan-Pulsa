<?php
session_start();
require("../config.php");
require '../lib/session_user.php';
	if (isset($_POST['request'])) {
	require '../lib/session_login.php';
		
                $post_voucher = $conn->real_escape_string(trim(filter($_POST['voucher'])));
                
		$cek_voucher = $conn->query("SELECT * FROM voucher_deposit WHERE voucher = '$post_voucher'");
		$data_voucher = $cek_voucher->fetch_assoc();
		$cek_voucher_rows = mysqli_num_rows($cek_voucher);
		
                $post_balance = $data_voucher['saldo'];
                $post_voc = $data_voucher['voucher'];
		
		if (!$post_voucher) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Mohon mengisi input');
		} else if ($cek_voucher_rows == 0) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Kode Voucher Tidak Valid.');
		} else if ($data_voucher['status'] == "sudah di redeem") { 
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Kode Voucher sudah di gunakan');
			
	        } else {
	                
	                $kode = acak_nomor(3).acak_nomor(3);
	                
		        $insert_depo = $conn->query("UPDATE voucher_deposit set status = 'sudah di redeem', user = '$sess_username', date = '$date', time = '$time' WHERE voucher = '$post_voucher'");
			$insert_depo = $conn->query("INSERT INTO deposit VALUES ('','R-$kode', '$sess_username', 'VOUCHER', 'redeem voucher' ,'voucher deposit Rp $post_balance', '-','-','$post_balance', '$post_balance', 'Success', 'Website', '$date', '$time')");
			$insert_depo = $conn->query("INSERT INTO history_saldo VALUES ('', '$sess_username', 'Penambahan Saldo', '$post_balance', 'Penambahan Saldo Dengan Voucher Deposit $post_balance', '$date', '$time')");
			$insert_depo = $conn->query("UPDATE users set saldo = saldo + $post_balance WHERE username = '$sess_username'");

			if ($insert_depo == TRUE) {
				$_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Redeem Voucher Berhasil', 'pesan' => 'Saldo Anda Telah Kami Tambah Dengan Nominal Rp '.$post_balance );
			exit(header("location: ".$config['web']['url']));
			} else {
				$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Upss', 'pesan' => 'Terjadi Kesalahan Silahkan Hubungi Admin');
			}
		}
	}
require("../lib/header.php");
?>
			<div class="row">
		<div class="col-lg-12">
		<div class="alert alert-warning"><i class="mdi mdi-information fa-fw"></i> Baca <b>INFORMASI</b> yang terletak dikanan <i>Pc,Tablet</i> / dibawah <i>Smartphone</i> form sebelum melakukan deposit saldo.
		</div>
		</div>
		</div>
		
		<div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-wallet text-primary"></i> Redeem Voucher</h4><hr>
										<form class="form-horizontal" role="form" method="POST">
										<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
											<div class="form-group">
											<label class="col-md-12 control-label">Kode Voucher</label>
											<div class="col-md-12">
												<input type="text" class="form-control" name="voucher" placeholder="Masukkan Voucher Deposit" id="voucher">
											</div>
										</div>
									
											<div class="form-group">
												<div class="col-md-offset-2 col-md-12">
											<button type="submit" class="pull-right btn btn-primary btn-block waves-effect w-md waves-light" name="request"><i class="ti-wallet"></i> Redeem</button>
											    </div>
											</div>    
										</form>
									</div>
								</div>
							</div>	
																
                    
                    <!-- end col -->
                            <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                         <h4 class="m-t-0 text-uppercase header-title"><i class="mdi mdi-information mr-1 text-primary"></i> Informasi Deposit</h4><hr>
				<div class="card-body">
										<ul>
											<li>Pastikan anda sudah membeli<b> Kode Voucher Deposit </b>di Admin.</li>
											
											<li>Masukkan kode voucher di bagian kolom kode voucher.</li>
											<li>Klik Redeem, Kemudian tunggu hingga <span class="badge badge-success"> Success </span> saldo anda akan otomatis ditambahkan </li>
										</ul>
										<p><b>Keterangan</b> : Deposit ON 24 jam, Jika Terjadi Kendala Silahkan Hubungi Admin</p>
									</div>
								</div>
							</div>
						</div>

<?php
	require ("../lib/footer.php");
?>