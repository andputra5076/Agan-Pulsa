<?php
session_start();
require("../config.php");
require '../lib/session_user.php';
	if (isset($_POST['request'])) {
	require '../lib/session_login.php';
		
		$post_provider = $conn->real_escape_string($_POST['provider']);
		$post_pembayaran = $conn->real_escape_string($_POST['pembayaran']);
		$post_jumlah = $conn->real_escape_string(trim(filter($_POST['jumlah'])));
                $post_pengirim = $conn->real_escape_string(trim(filter($_POST['pengirim'])));
        
		$cek_metod = $conn->query("SELECT * FROM metode_depo WHERE id = '$post_provider'");
		$data_metod = $cek_metod->fetch_assoc();
		$cek_metod_rows = mysqli_num_rows($cek_metod);
		
		$cek_depo = $conn->query("SELECT * FROM deposit WHERE username = '$sess_username' AND status = 'Pending'");
		$data_depo = $cek_depo->fetch_assoc();
		$count_depo = mysqli_num_rows($cek_depo);
		
		$kode = acak_nomor(3).acak_nomor(3);
		$acakin = acak_nomor(2).acak_nomor(1);


		if (!$post_provider || !$post_pembayaran || !$post_jumlah) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Tipe Pembayaran <br /> - Provider Pembayaran <br /> - Pembayaran <br /> - Pengirim <br /> - Jumlah');
			
		} else if ($cek_metod_rows == 0) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Metode Deposit Tidak Tersedia.');
			
		} else if ($count_depo >= 1) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Masih terdapat pengajuan Isi Saldo yang berstatus pending, silahkan dibatalkan dulu permintaan isi saldo sebelumnya di menu History Isi Saldo.');
		} else if ($post_jumlah < $data_metod['min']) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Minimal Isi Saldo Rp. '.$data_metod['min'].'.');	
		} else if ($post_jumlah > $data_metod['max']) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Maksimal Isi Saldo Rp. '.$data_metod['max'].'.');		
			
	    } else {
	    
	        $metodnya = $data_metod['nama'];
	        $get_saldo = $post_jumlah * $data_metod['rate'];
	        $amount = $acakin + $get_saldo;
	        $reg = $acakin + $post_jumlah;
	        $insert = $conn->query("INSERT INTO deposit VALUES (NULL,'B-$kode', '$sess_username', 'BANK', '".$data_metod['provider']."' ,'".$data_metod['nama']."', '-','".$data_metod['tujuan']."','$reg', '$amount', 'Pending', 'Website', '$date', '-', '$time')");
	        if ($insert == TRUE) {
              
              exit(header("Location: ".$config['web']['url']."invoice.php")); 
	      	     
              
	        } else {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Error System(Insert To Database).');
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
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-wallet text-primary"></i> DEPOSIT BANK</h4><hr>
										<form class="form-horizontal" role="form" method="POST">
										<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
											<div class="form-group">
												<label class="col-md-12 control-label">Operator</label>
												<div class="col-md-12">
													<select class="form-control" name="provider" id="provider">
													<option value="0">Pilih Salah Satu</option>
												<?php
												$cek_kategori = $conn->query("SELECT * FROM metode_depo ORDER BY nama ASC");
												while ($data_metode = $cek_kategori->fetch_assoc()) {
												?>
													<option value="<?php echo $data_metode['id'];?>"><?php echo $data_metode['provider'];?></option>
	
												<?php } ?>	
																									
													</select>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-md-12 control-label">Pembayaran</label>
												<div class="col-md-12">
													<select class="form-control" name="pembayaran" id="pembayaran">
														<option value="0">Pilih Provider Pembayaran Terlebih Dahulu</option>
													</select>
												</div>
											</div>
																					
										<div class="form-group">
											<label class="col-md-12 control-label">Jumlah</label>
											<div class="col-md-12">
												<input type="number" class="form-control" name="jumlah" placeholder="Jumlah Deposit" id="jumlah">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-12 control-label">Saldo Didapat</label>
											<div class="col-md-12">
												<input type="text" class="form-control" name="saldo" placeholder="klik disini untuk lihat total Saldo Didapat" id="rate" readonly>
											</div>
										</div>
									
											<div class="form-group">
												<div class="col-md-offset-2 col-md-12">
											<button type="submit" class="pull-right btn btn-primary btn-block waves-effect w-md waves-light" name="request"><i class="ti-wallet"></i> Deposit</button>
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
											<li> pilih salah satu pembayaran deposit.</li>
											
											<li>masukkan jumlah yang akan kamu transfer Dan Nanti Akan Di Tambah 3 Kode Unik Contoh 10.000 + (156) Maka Kamu Harus Transfer Nominal + kode unik Tadi Sebesar 10.156.</li>
											<li>Klik Deposit Proses</li>
											<li>Setelah anda transfer sesuai invoice silahkan klik konfirmasi, saldo akan otomatis masuk ke akun anda</li>
											<li>JANGAN TRANSFER SEBELUM REQUEST DEPOSIT. TRANSFER HARUS SESUAI NOMINAL UNIK, JANGAN DIBULATKAN</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#tipe_pulsa").change(function() {
		var tipe = $("#tipe_pulsa").val();
		$.ajax({
			url: '/ajax/provider-deposit.php',
			data: 'tipe=' + tipe,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#provider_pulsa").html(msg);
			}
		});
	});
	$("#provider_pulsa").change(function() {
		var provider = $("#provider_pulsa").val();
		$.ajax({
			url: '/ajax/pembayaran-deposit.php',
			data: 'provider=' + provider,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#pembayaran_pulsa").html(msg);
			}
		});
	});
  $("#jumlah").change(function(){
    var pembayaran = $("#pembayaran_pulsa").val();
    var jumlah = $("#jumlah_pulsa").val();
    $.ajax({
      url : '/ajax/rate-deposit.php',
      type  : 'POST',
      dataType: 'html',
      data  : 'pembayaran='+pembayaran+'&jumlah='+jumlah,
      success : function(result){
        $("#rate_pulsa").val(result);
      }
      });
    });  
});
</script>	
<script type="text/javascript">
$(document).ready(function() {
	$("#tipe").change(function() {
		var tipe = $("#tipe").val();
		$.ajax({
			url: '/ajax/provider-deposit.php',
			data: 'tipe=' + tipe,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#provider").html(msg);
			}
		});
	});
	$("#provider").change(function() {
		var provider = $("#provider").val();
		$.ajax({
			url: '/ajax/pembayaran-deposit.php',
			data: 'provider=' + provider,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#pembayaran").html(msg);
			}
		});
	});
  $("#jumlah").change(function(){
    var pembayaran = $("#pembayaran").val();
    var jumlah = $("#jumlah").val();
    $.ajax({
      url : '/ajax/rate-deposit.php',
      type  : 'POST',
      dataType: 'html',
      data  : 'pembayaran='+pembayaran+'&jumlah='+jumlah,
      success : function(result){
        $("#rate").val(result);
      }
      });
    });  
});
	</script>
<?php
	require ("../lib/footer.php");
?>