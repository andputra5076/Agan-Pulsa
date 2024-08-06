<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
if (isset($_POST['pesan'])) {
	require '../lib/session_login.php';
	$post_operator = $conn->real_escape_string(trim(filter($_POST['operator'])));
	$post_layanan = $conn->real_escape_string(trim(filter($_POST['layanan'])));
	$post_target = $conn->real_escape_string(trim(filter($_POST['target'])));
	$post_nometer = $conn->real_escape_string(trim(filter($_POST['nometer'])));

	$cek_layanan = $conn->query("SELECT * FROM layanan_pulsa WHERE provider_id = '$post_layanan' AND status = 'Normal'");
	$data_layanan = mysqli_fetch_assoc($cek_layanan);

	$order_id = acak_nomor(3).acak_nomor(4);
	$provider = $data_layanan['provider'];

	$cek_provider = $conn->query("SELECT * FROM provider WHERE code = '$provider'");
	$data_provider = mysqli_fetch_assoc($cek_provider);
	
	$cek_wa = $conn->query("SELECT * FROM bot_whatsapp WHERE status = 'Aktif'");
    $data_wa_bot = $cek_wa->fetch_assoc();

	$cek_pesanan = $conn->query("SELECT * FROM pembelian_pulsa WHERE user = '$sess_username' AND target = '$post_target' AND status = 'Pending' AND provider = '$provider'");
	$data_pesanan = mysqli_fetch_assoc($cek_pesanan);

	if (!$post_target || !$post_layanan || !$post_operator) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Order Gagal', 'pesan' => 'Lengkapi Bidang Berikut:<br/> - Kategori <br /> - Produk <br /> - Target');

	} else if (mysqli_num_rows($cek_layanan) == 0) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Order Gagal', 'pesan' => 'Produk Tidak Tersedia');

	} else if (mysqli_num_rows($cek_provider) == 0) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Order Gagal', 'pesan' => 'Server Sedang Maintenance');

	} else if ($data_user['saldo'] < $data_layanan['harga']) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Order Gagal', 'pesan' => 'Saldo Tidak Mencukupi');

	} else if (mysqli_num_rows($cek_pesanan) == 1) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Order Gagal', 'pesan' => 'Orderan Sebelumnya di Produk & Target yang Sama Masih Pending');

	} else {

		$api_link = $data_provider['link'];
		    $api_key = $data_provider['api_key'];
		    $api_id = $data_provider['api_id'];

		    if ($provider == "MANUAL") {
			    $api_postdata = "";
		    } else if ($provider == "DIGIFLAZZ") {
		    $sign = md5($api_id.$api_key.$order_id);
            $api_postdata = array( 
            	'username' => $api_id,
            	'buyer_sku_code' => $data_layanan['provider_id'],
            	'customer_no' => "$post_target",
            	'ref_id' => $order_id,
            	'sign' => $sign
            );
            $header = array(
                'Content-Type: application/json',
            );
			} else {
				die("System Error!");
			}

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_link);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($api_postdata));
                $chresult = curl_exec($ch);
                curl_close($ch);
                $json_result = json_decode($chresult, true);
                $result = json_decode($chresult);
                // print_r($result);

			    if ($provider == "DIGIFLAZZ" && $json_result['data']['status'] == "Gagal") {
		            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Order Gagal', 'pesan' => 'Gagal, '.$json_result['data']['message']);
			    } else {

			        if ($provider == "DIGIFLAZZ") {
		                $provider_oid = $order_id;
			        }
				if ($conn->query("INSERT INTO pembelian_pulsa VALUES ('','$order_id', '$provider_oid', '$sess_username', '".$data_layanan['layanan']."', '".$data_layanan['harga']."', '".$data_layanan['profit']."', '$post_target', '$post_nometer', '$pesan', 'Pending', '$date', '$time', 'Website', '$provider', '0')") == true) {

					$conn->query("UPDATE users SET saldo = saldo-".$data_layanan['harga'].", pemakaian_saldo = pemakaian_saldo+".$data_layanan['harga']." WHERE username = '$sess_username'");
					$conn->query("INSERT INTO history_saldo VALUES ('', '$sess_username', 'Pengurangan Saldo', '".$data_layanan['harga']."', 'Order ID $order_id Voucher Games', '$date', '$time')");

					$harga = number_format($data_layanan['harga'],0,',','.');
					$_SESSION['hasil'] = array(
						'alert' => 'success',
						'judul' => 'Order Berhasil', 
						'pesan' => 'Terimakasih </b>'.$sess_username.'<br /> 
						<b>Order ID : </b> '.$order_id.'<br />
						<b>Layanan : </b> '.$data_layanan['layanan'].'<br />
						<b>Target : </b> '.$post_target.'<br />
						<b>Harga : </b> Rp. '.$harga.'');
						 // PESAN WA
                 $target = $data_user['nomer'] ;
                 $nama_user = $data_user['nama'] ;
                 $token_whatsapp =  $data_wa_bot ['token_wa'] ;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                    'target' => $target,
                    'message' => "INVOICE ORDER\n\n𝙄𝘿 : $order_id\nTanggal : $date\nLayanan : ".$data_layanan['layanan']."\nHarga : $harga\nTarget : $post_target",
                    ),
                    CURLOPT_HTTPHEADER => array(
                    "Authorization: $token_whatsapp " //change TOKEN to your actual token
                    ),
                    ));
                    
                    $response = curl_exec($curl);
                    curl_close($curl);
				} else {
					$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Order Gagal', 'pesan' => 'Pemesanan gagal');
				}
			}
		}

	//Disable form resubmit after page refresh 1
	header ('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}

require("../lib/header.php");
?>

<!--Title-->
<title>VOUCHER GAMES</title>
<meta name="description" content="Platform Layanan Digital All in One, Berkualitas, Cepat & Aman. Menyediakan Produk & Layanan Pemasaran Sosial Media, Payment Point Online Bank, Layanan Pembayaran Elektronik, Optimalisasi Toko Online, Voucher Game dan Produk Digital."/>

<div class="row">
	<div class="col-md-7">
		<div class="card">
			<div class="card-body">
				<h4 class="m-t-0 text-uppercase text-center header-title">
				    <img src="/assets/index/game-console.png" alt="Top Up Game" style="height: 1.5rem;width: 1.5rem;"></img><b> TOP UP GAMES</b></h4><hr>
				<form class="form-horizontal" method="POST">
					<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">   										    
					<div class="form-group">
						<label class="col-md-12 control-label">Kategori *</label>
						<div class="col-md-12">
							<select class="form-control" name="operator" id="operator">
								<option value="0">Pilih Salah Satu</option>
								<?php
								$cek_kategori = $conn->query("SELECT * FROM kategori_pulsa WHERE tipe IN ('Games') ORDER BY nama ASC");
								while ($data_kategori = $cek_kategori->fetch_assoc()) {
									?>
									<option value="<?php echo $data_kategori['kode']; ?>"><?php echo $data_kategori['nama']; ?></option>
								<?php } ?>														
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-12 control-label">Produk *</label>
						<div class="col-md-12">
							<select class="form-control" name="layanan" id="layanan">
								<option value="0">Pilih Kategori</option>
							</select>
						</div>
					</div>

					<div id="catatan">
					</div>
					
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="col-md-12 col-form-label">Target *</label>
							<div class="col-md-12">
								<input type="text" name="target" class="form-control" placeholder="No HP / ID Game / User ID">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label class="col-md-12 col-form-label">Total</label>
							<div class="col-md-12">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Rp. </span>
									</div>
									<input type="number" class="form-control" id="harga" readonly>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12">
							<button type="submit" class="btn btn-block btn-primary waves-effect w-md waves-light" name="pesan" id="checkout" disabled="disabled"><i class="mdi mdi-cart"></i>Order</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>	
	<!-- end col -->

	<!-- INFORMASI ORDER -->
	<div class="col-md-5" id="informasiorder">
		<div class="card">
			<div class="card-body">

				<center><h4 class="m-t-0 text-uppercase header-title"><i aria-hidden="true" class="fa fa-info-circle"></i><b> Informasi Order</h4></b>
					Gunakan koneksi internet yang stabil agar daftar produk sinkron dengan kategori yang dipilih.<hr>
				</center>

				<!--KETERANGAN-->
				<div class="table-responsive">
					<center><i aria-hidden="true" class="fa fa-check-circle"></i><b> Keterangan Produk</b></center>
					<ol class="list-p">
						<li>Akun berstatus baru.</li>
						<li>Durasi sesuai masa aktif yang dipilih.</li>
						<li>Akun bisa dengan mudah diperpanjang.</li>
						<li>Email & password akun dari kami.</li>
						<li>Akun no ads / tanpa iklan.</li>
						<li>Bisa unlocked semua lagu.</li>
						<li>Bisa unlimited skip.</li>
					</ol>
				</div>

				<!--KETENTUAN-->
				<div class="table-responsive">
					<center><i aria-hidden="true" class="fa fa-check-circle"></i><b> Syarat & Ketentuan</b></center>
					<ol class="list-p">
						<li>Mengikuti cara order di bawah.</li>
						<li>Memahami & mengikuti <a href="#catatan"><b><u>Deskripsi</u></b></a> dibawah pilihan produk.</li>
						<li>Target atau tujuan sesuai <b>Contoh Target Pesanan</b>.</li>
						<li>Kesalahan input dan order pending atau processing tidak dapat di cancel atau refund.</li>
						<li>Order baru untuk produk & target yang sama, tunggu status order sebelumnya <span class="badge badge-success"><b>Success</b></span>.</li>
						<li>Memahami & mengikuti <b>Informasi Status Order</b>.</li>
						<li>Memahami & mengikuti <b>Ketentuan Layanan</b> & <b>FAQ</b>.</li>
					</ol>
				</div>

				<!--CARA-->
				<div class="table-responsive">
					<center><i aria-hidden="true" class="fa fa-check-circle"></i><b> Cara Melakukan Order</b></center>
					<ol class="list-p">
						<li>Pilih salah satu kategori & produk.</li>
						<li>Masukkan nomor whatsapp anda pada target .</li>
						<li>Klik <span class="badge badge-primary"><b>Order</b></span> untuk memesan.</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- INFORMASI ORDER -->
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#operator").change(function() {
			var operator = $("#operator").val();
			$.ajax({
				url: '<?php echo $config['web']['url'];?>ajax/layanan_pulsa.php',
				data: 'operator=' + operator,
				type: 'POST',
				dataType: 'html',
				success: function(msg) {
					$("#layanan").html(msg);
				}
			});
		});
		$("#layanan").change(function() {
			var layanan = $("#layanan").val();
			$.ajax({
				url: '<?php echo $config['web']['url'];?>ajax/harga_pulsa.php',
				data: 'layanan=' + layanan,
				type: 'POST',
				dataType: 'html',
				success: function(msg) {
					$("#harga").val(msg);
				}
			});
		});
		$("#layanan").change(function() {
			var layanan = $("#layanan").val();
			$.ajax({
				url: '<?php echo $config['web']['url'];?>ajax/catatan_pulsa.php',
				data: 'layanan=' + layanan,
				type: 'POST',
				dataType: 'html',
				success: function(msg) {
					$("#catatan").html(msg);
				}
			});
		});
	});
</script>

<script type="text/javascript">
	//Disable button
	(function() {
		$('input').keyup(function() {
			var empty = false;
			$('input').each(function() {
				if ($(this).val() == '') {
					empty = true;
				}
			});
			//Id button
			if (empty) {
				$('#checkout').attr('disabled', 'disabled');
			} else {
				$('#checkout').removeAttr('disabled');
			}
		});
	})()
</script>

<?php
require ("../lib/footer.php");
?>