<?php
session_start();
require("../config.php");
require '../lib/session_user.php';
if (isset($_POST['request'])) {
	require '../lib/session_login.php';

    $post_jenis = $conn->real_escape_string($_POST['jenis']);
	$post_pembayaran = $conn->real_escape_string($_POST['pembayaran']);
	$post_jumlah = $conn->real_escape_string(trim(filter($_POST['jumlah'])));
	$post_pengirim = $conn->real_escape_string(trim(filter($_POST['pengirim'])));

	$cek_metod = $conn->query("SELECT * FROM metode_depo1 WHERE id = '$post_pembayaran'");
	$data_metod = $cek_metod->fetch_assoc();
	$cek_metod_rows = mysqli_num_rows($cek_metod);

	$cek_depo = $conn->query("SELECT * FROM deposit_bank WHERE username = '$sess_username' AND status = 'Pending'");
	$data_depo = $cek_depo->fetch_assoc();
	$count_depo = mysqli_num_rows($cek_depo);
	
	$minimal_deposit = $data_metod['minimal_deposit'];

	$acakin = acak_nomor(2).acak_nomor(1);

	if (!$post_jenis || !$post_pembayaran || !$post_jumlah) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Lengkapi Bidang Berikut:<br/> - Jenis Saldo <br /> - Pembayaran <br /> - Pengirim <br /> - Jumlah');

	 } else if ($cek_metod_rows == 0) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Metode Deposit Tidak Tersedia.');

	} else if ($count_depo >= 1) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Masih Terdapat Deposit Yang Berstatus Pending.');

	} else if ($post_jumlah < $minimal_deposit) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Minimal Deposit Saldo '.$minimal_deposit.'');

	} else {

		$metodnya = $data_metod['nama'];
        $reg = $post_jumlah + $acakin;
        $get_saldo = $reg * $data_metod['rate'];
        $amount = $get_saldo;
        $pengirim = "-";
        $cek_yab = $conn->query("SELECT * FROM yabgroup WHERE nama = 'YABGROUP'");
        
        if ($data_metod['tipe'] == "EMoney") {
                $yabgroup = $cek_yab->fetch_assoc();
                $apiKey = $yabgroup['api_key'];
                $secretKey = $yabgroup['secret_key'];
                $method = $data_metod['provider'];
                $merchantRef = rand(1,999999999);
                
                $url = $yabgroup['url'];
                
                $postdata = [
                        'api_key'  => $apiKey,
                        'secret_key'  => $secretKey,
                        'channel_payment' => $method,
                        'ref_kode' => $merchantRef,
                        'nominal' => $reg,
                        'cus_nama' => $sess_username,
                        'url_redirect' => "".$config['web']['url']."invoice-va.php",
                        'url_callback' => "".$config['web']['url']."cronsjob/callback_yab.php",
                        'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                        'signature' => hash_hmac('sha256', $merchantRef.$apiKey.$reg, $secretKey)
                    ];
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                
                $response = curl_exec($ch);
                $response = json_decode($response, true);

                if ($response['data']['status'] == "success") {
                    $checkout_url = $response['data']['checkout_url'];
                    $kode = $response['data']['id_reference'];
                    $reg = $reg + $response['data']['fee'];
                    $fee = $response['data']['fee'];
                    $tujuan = $response['data']['code_payment'];
                    
                    $insert = $conn->query("INSERT INTO deposit_bank VALUES ('','$kode', '$merchantRef', '$sess_username', '$post_jenis', '".$data_metod['tipe']."', '".$data_metod['provider']."' ,'$metodnya', '$post_pengirim','$tujuan', '$fee', '$reg', '$amount', 'Pending', 'Website', '$date', '$time', '$checkout_url')");
        			if ($insert == TRUE) {
        			    $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil!', 'pesan' => 'Sip! Kamu Berhasil Buat Isi Saldo .<script>swal.fire("Berhasil!", "Kamu Berhasil Buat Isi Saldo.", "success");</script>');
        			if ($data_metod['tipe'] == "EMoney") {
                        exit(header("Location: ".$checkout_url));
                    } else {
        				exit(header("Location: ".$config['web']['url']."invoice-va.php"));  
                    }
        
        			} else {
        				$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Error System(Insert To Database).');
        			}
                    
            } else {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => ''.$reg.'');
            }
        
        } else {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan Gagal', 'pesan' => 'Gagal');
        }
		}
	}
require("../lib/header.php");
?>

<!--Title-->
<title>Deposit via Emoney & Qris</title>
<meta name="description" content="Platform Layanan Digital All in One, Berkualitas, Cepat & Aman. Menyediakan Produk & Layanan Pemasaran Sosial Media, Payment Point Online Bank, Layanan Pembayaran Elektronik, Optimalisasi Toko Online, Voucher Game dan Produk Digital."/>

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
				<h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-wallet text-primary"></i> DEPOSIT E-Wallet
				<?php
                    //INFO STATUS DEPOSIT
					$cek_status = $conn->query("SELECT * FROM metode_depo1 WHERE tujuan IN ('Yabgroup') AND tipe = 'EMoney' AND keterangan = 'OFF' AND Jalur='Auto'");
                    $data_status = $cek_status->fetch_assoc();
                    $count_status = mysqli_num_rows($cek_status);
                    if ($count_status == 0) {
                        ?>
                        <div class="text-success">
                            (ONLINE)
                        </div>
                    <?php }
                    else {
                        ?>
                        <div class="text-danger">
                            (OFFLINE)
                        </div>
                    <?php }
                ?>
				</h4><hr>
				<form class="form-horizontal" role="form" method="POST">
					<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
					<div class="form-group">
						<label class="col-md-12 control-label">Jenis Saldo *</label>
						<div class="col-md-12">
					<select class="form-control" name="jenis" id="jenis">
						<option value="0">Pilih Salah Satu</option>
						<option value="Saldo">Deposit Otomatis</option>
						
					</select>
					</div>
					    </div>
					<div class="form-group">
						<label class="col-md-12 control-label">Pembayaran *</label>
						<div class="col-md-12">
							<select class="form-control" name="pembayaran" id="pembayaran">
								<option value="0">Pilih Provider Pembayaran</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-12 control-label">Nomor Pengirim *<br/>
							<small class="text-danger">Masukkan Awalan 08. Bukan 62 / +62</small>
						</label>
						<div class="col-md-12">
							<input type="text" class="form-control" name="pengirim" placeholder="082377XXXXXX" id="pengirim">
						</div>
					</div>

					<div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-md-12 col-form-label">Jumlah *</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" name="jumlah" placeholder="Jumlah Deposit" id="jumlah">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-12 col-form-label">Saldo yang didapat</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control"  name="saldo" placeholder="Saldo Yang Didapat" id="rate" readonly>
                                </div>
                            </div>
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

	<!-- INFORMASI ORDER -->
	<div class="col-md-5">
		<div class="card">
			<div class="card-body">

				<center><h4 class="m-t-0 text-uppercase header-title"><i aria-hidden="true" class="fa fa-info-circle"></i><b> Informasi Deposit</h4></b>
					<b>Keterangan</b> : Deposit Otomatis Sesuai Jam Online Masing - Masing Bank.<hr>
				</center>

				<!--CARA-->
				<div class="table-responsive">
					<center><i aria-hidden="true" class="fa fa-check-circle"></i><b> Cara Melakukan Deposit</b></center>
					<ol class="list-p">
						<li>Pilih salah satu provider & pembayaran.</li>
						<li>Masukkan jumlah deposit.</li>
						<li>Klik <span class="badge badge-primary"><b>Deposit</b></span></li>
					</ol>
				</div>

				<!--KETENTUAN-->
				<div class="table-responsive">
					<center><i aria-hidden="true" class="fa fa-check-circle"></i><b> Syarat & Ketentuan Deposit</b></center>
					<ol class="list-p">
						<li>Jumlah deposit akan ditambahkan dengan 3 angka unik.</li>
						<li>Detail faktur tampil setelah klik deposit.</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- INFORMASI ORDER -->

	<script type="text/javascript">
		$(document).ready(function() {
			$("#jenis").change(function() {
				var jenis = $("#jenis").val();
				$.ajax({
					url: '/ajax/Yab-Wallet.php',
					data: 'jenis=' + jenis,
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
					url : '/ajax/rate-deposit111.php',
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
