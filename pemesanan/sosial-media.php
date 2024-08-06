<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
	if (isset($_POST['pesan'])) {
	require '../lib/session_login.php';
		$post_kategori = $conn->real_escape_string(trim(filter($_POST['kategori'])));
		$post_layanan = $conn->real_escape_string(trim(filter($_POST['layanan'])));
		$post_jumlah = $conn->real_escape_string(trim(filter($_POST['jumlah'])));
		$post_target = $conn->real_escape_string(trim(filter($_POST['target'])));
		$post_comments = $_POST['comments'];

		$cek_layanan = $conn->query("SELECT * FROM layanan_sosmed  WHERE service_id = '$post_layanan' AND status = 'Aktif'");
		$data_layanan = mysqli_fetch_assoc($cek_layanan);
		
		$cek_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE target = '$post_target' AND status = 'Pending'");
		$data_pesanan = mysqli_fetch_assoc($cek_pesanan);
		
		$cek_harga = $data_layanan['harga'] / 1000;
		$cek_profit = $data_layanan['profit'] / 2000;
		$hitung = count(explode(PHP_EOL, $post_comments));
	    $replace = str_replace("\r\n",'\r\n', $post_comments);
	    if (!empty($post_comments)) {
			$post_jumlah = $hitung;
		} else {
			$post_jumlah = $post_jumlah;
		}
		// $price = $rate*$post_quantity;
		if (!empty($post_comments)) {
			$harga = $cek_harga*$hitung;
			$profit = $cek_profit*$hitung;
		} else {
			$harga = $cek_harga*$post_jumlah;
			$profit = $cek_profit*$post_jumlah;
		}
		$order_id = acak_nomor(3).acak_nomor(4);
        $provider = $data_layanan['provider'];

		$cek_provider = $conn->query("SELECT * FROM provider WHERE code = 'ZAYNFLAZZ'");
		$data_provider = mysqli_fetch_assoc($cek_provider);
		
		$cek_wa = $conn->query("SELECT * FROM bot_whatsapp WHERE status = 'Aktif'");
        $data_wa_bot = $cek_wa->fetch_assoc();

        //Get Start Count
        if ($data_layanan['kategori'] == "Instagram Likes" AND "Instagram Likes Indonesia" AND "Instagram Likes [Targeted Negara]" AND "Instagram Likes/Followers Per Minute") {
            $start_count = likes_count($post_target);
        } else if ($data_layanan['kategori'] == "Instagram Followers No Refill/Not Guaranteed" AND "Instagram Followers Indonesia" AND "Instagram Followers [Negara]" AND "Instagram Followers [Refill] [Guaranteed] [NonDrop]") {
            $start_count = followers_count($post_target);
        } else if ($data_layanan['kategori'] == "Instagram Views") {
            $start_count = views_count($post_target);
        } else {
            $start_count = 0;
        }

		if (!$post_target || !$post_layanan || !$post_kategori) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Pemesanan Gagal', 'pesan' => 'Harap Mengisi Form <br /> - Kategori <br /> - Layanan <br /> - Target');
			
		} else if (mysqli_num_rows($cek_layanan) == 0) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Pemesanan Gagal', 'pesan' => 'Layanan Tidak Tersedia.');
			
		} else if (mysqli_num_rows($cek_provider) == 0) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Pemesanan Gagal', 'pesan' => 'Server Sedang Maintance.');

		} else if ($post_jumlah < $data_layanan['min']) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Pemesanan Gagal', 'pesan' => 'Jumlah Minimal Pemesanan Adalah '.number_format($data_layanan['min'],0,',','.').'.');
			
		} else if ($post_jumlah > $data_layanan['max']) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Pemesanan Gagal', 'pesan' => 'Jumlah Maksimal Pemesanan Adalah '.number_format($data_layanan['max'],0,',','.').'.');
			
		} else if ($data_user['saldo'] < $harga) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Pemesanan Gagal', 'pesan' => 'Saldo Anda Tidak Mencukupi Untuk Melakukan Pemesanan Ini.');
			
		} else if (mysqli_num_rows($cek_pesanan) == 1) {
		    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Pemesanan Gagal', 'pesan' => 'Masih Terdapat Pesanan Dengan Tujuan / Target Yang Sama.');
		    
		} else {

			if ($provider == "MANUAL") {
				$api_postdata = "";
			} else if ($provider == "ZAYNFLAZZ") {
			    if ($post_comments == false) {
				$postdata = "api_key=".$data_provider['api_key']."&action=pemesanan&layanan=".$data_layanan['provider_id']."&target=$post_target&jumlah=$post_jumlah";
			} else if ($post_comments == true) {
				$postdata = "api_key=".$data_provider['api_key']."&action=pemesanan&layanan=".$data_layanan['provider_id']."&target=$post_target&custom_comments=$post_comments";
			}

            $endpoint = "https://zaynflazz.com/api/sosial-media";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $chresult = curl_exec($ch);
            curl_close($ch);
            $json_result = json_decode($chresult, true);
			} else {
				die("System Error!");
			}
			if ($provider == "ZAYNFLAZZ" AND $json_result['status'] == false) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Order Gagal', 'pesan' => ''.$json_result['data']['pesan'].'.');
		} else {
			if ($provider == "ZAYNFLAZZ") {
				$provider_oid = $json_result['data']['id'];
			}

    			if ($conn->query("INSERT INTO pembelian_sosmed VALUES ('','$order_id', '$provider_oid', '$sess_username', '".$data_layanan['layanan']."', '$post_target', '$post_jumlah', '0', '$start_count', '$harga', '$profit', 'Pending', '$date', '$time', '$provider', 'Website', '0')") == true) {
				 	$conn->query("UPDATE users SET saldo = saldo-$harga, pemakaian_saldo = pemakaian_saldo+$harga WHERE username = '$sess_username'");
					$conn->query("INSERT INTO history_saldo VALUES ('', '$sess_username', 'Pengurangan Saldo', '$harga', 'Pemesanan Sosial Media Dengan Order ID $order_id', '$date', '$time')");	   
									
    				$jumlah = number_format($post_jumlah,0,',','.');
    				$harga2 = number_format($harga,0,',','.');
    				$_SESSION['hasil'] = array(
    				 'alert' => 'success',
    				 'judul' => 'Pesanan Berhasil.',
    				 'pesan' => '<b>Order ID : </b> '.$order_id.'<br />
    				 - <b>Layanan : </b> '.$data_layanan['layanan'].'<br />
    				 - <b>Target : </b> '.$post_target.'<br />
    				 - <b>Start Count : </b> '.$start_count.'<br />
    				 - <b>Jumlah Pesan : </b> '.$jumlah.'<br />
    				 - <b>Total Harga : </b> Rp '.$harga2.'');
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
						$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Pemesanan Gagal', 'pesan' => 'Error System (2)');
					}
				}
			}
		}
	
	require("../lib/header.php");
?>

<!-- Select2 -->
  <link rel="stylesheet" href="/dokumen/assets/plugins/select2/css/select2.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="/dokumen/assets/plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
                <div class="col-lg-12">
            		<div class="alert alert-primary" style="color: #434d4c"><i class="fa fa-info-circle fa-fw"></i> Baca <b>Informasi</b> yang terletak dikanan (PC/Tablet) / dibawah (Smartphone) form sebelum melakukan Submit.</div>
            	</div>   
				<div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">                                            
                                <h4 class="m-t-0 text-uppercase text-center header-title"><img src="/assets/index/social-media.png" alt="Sosial Media" style="height: 1.5rem;width: 1.5rem; mb-2"></img> PEMESANAN BARU </h4><hr>
                                	<form class="form-horizontal" method="POST">
	                              	<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">   										    
											<div class="form-group">
												<label class="col-md-12 control-label">Kategori</label>
												<div class="col-md-12">
													<select class="form-control select2" id="kategori" name="kategori">
														<option value="">Pilih Salah Satu...</option>
												<?php
												$cek_kategori = $conn->query("SELECT * FROM kategori_layanan WHERE tipe = 'Sosial Media' ORDER BY nama ASC");
												while ($data_kategori = $cek_kategori->fetch_assoc()) {
												?>
														<option value="<?php echo $data_kategori['kode']; ?>"><?php echo $data_kategori['nama']; ?></option>
												<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-12 control-label">Layanan</label>
												<div class="col-md-12">
													<select class="form-control select2" name="layanan" id="layanan">
														<option value="0">Pilih Kategori Terlebih Dahulu</option>
													</select>
												</div>
											</div>
											<div class="form-group">
											<div class="col-md-12">
											<div id="catatan"></div>
											</div>
											</div>
											<div class="form-group">
												<label class="col-md-12 control-label">Link/Target</label>
												<div class="col-md-12">
													<input type="text" name="target" class="form-control" placeholder="Masukan Username Target / Link Target">
												</div>
											</div>
											<div id="show1">
											<div class="form-group">
												<label class="col-md-12 control-label">Jumlah</label>
												<div class="col-md-12">
													<input type="number" name="jumlah" class="form-control" placeholder="Jumlah" onkeyup="get_total(this.value).value;">
												</div>
											</div>
											
											<input type="hidden" id="rate" value="0">
											<div class="form-group">
												<label class="col-md-12 control-label">Total Harga</label>
												<div class="col-md-12">
													<input type="number" class="form-control" id="total" readonly>
												</div>
											</div>
											</div>
											<div id="show2" style="display: none;">
												<div class="form-group">
													<label class="col-md-12 control-label">Comment</label>
													<div class="col-md-12">
														<textarea class="form-control" name="comments" id="comments" placeholder="Pisahkan Tiap Baris komentar dengan enter"></textarea>
													</div>
												</div>
												<input type="hidden" id="rate" value="0">
    											<div class="form-group">
    												<label class="col-md-12 control-label">Total Harga</label>
    												<div class="col-md-12">
    													<input type="number" class="form-control" id="totalxx" readonly>
    												</div>
    											</div>
											</div>		
											<div class="col-md-12"> <button type="submit" class="pull-right btn btn-block btn--md btn-primary waves-effect w-md waves-light" name="pesan"><i class="mdi mdi-cart"></i>	Buat Pesanan</button> 
											
											</div> 
										</form>
                            </div>
                        </div>
                    </div> 
                    
                    <!-- INFORMASI ORDER -->
	<div class="col-md-5" id="informasiorder">
		<div class="card">
			<div class="card-body">

				<center><h4 class="m-t-0 text-uppercase header-title"><i aria-hidden="true" class="fa fa-info-circle"></i><b> Informasi</h4></b>
					<hr>
				</center>

				<!--KETERANGAN-->
				<div class="table-responsive">
					<center><b>Langkah-langkah membuat pesanan baru:</b></center>
					<ol class="list-p">
						<li>Pilih salah satu Kategori.</li>
						<li>Pilih salah satu Layanan yang ingin dipesan.</li>
						<li>Masukkan Target pesanan sesuai ketentuan yang diberikan layanan tersebut.</li>
						<li>Masukkan Jumlah Pesanan yang diinginkan..</li>
						<li>Klik Submit untuk membuat pesanan baru</li>
					</ol>
				</div>

				<!--KETENTUAN-->
				<div class="table-responsive">
					<center><b>Ketentuan membuat pesanan baru:</b></center>
					<ol class="list-p">
						<li>Silahkan membuat pesanan sesuai langkah-langkah diatas.</li>
						<li>Jika ingin membuat pesanan dengan Target yang sama dengan pesanan yang sudah pernah dipesan sebelumnya, mohon menunggu sampai pesanan sebelumnya selesai diproses. Jika terjadi kesalahan / mendapatkan pesan gagal yang kurang jelas, silahkan hubungi Admin untuk informasi lebih lanjut.</li>
						<li>Jangan memasukkan orderan yang sama jika orderan sebelumnya belum selesai.</li>
						<li>Jangan mengganti username atau menghapus link target saat sudah order.</li>
						<li>Order baru untuk produk & target yang sama, tunggu status order sebelumnya <span class="badge badge-success"><b>Success</b></span>.Orderan yang sudah masuk tidak dapat di cancel / refund manual, seluruh proses orderan dikerjakan secara otomatis oleh server.</li>
						<li>Jika Anda memasukkan orderan di <?php echo $data['short_title']; ?> berarti Anda sudah mengerti aturan <?php echo $data['short_title']; ?> dan jangan lupa baca menu F.A.Q serta Terms</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- INFORMASI ORDER -->
        	</div>
        </div>
    </div>
</div>
<?php
	require ("../lib/footer.php");
?>
<!-- Select2 -->
<script src="/dokumen/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="/dokumen/assets/plugins/moment/moment.min.js"></script>
<script src="/dokumen/assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#kategori").change(function() {
		var kategori = $("#kategori").val();
		$.ajax({
			url: '/ajax/layanan_sosmed.php',
			data: 'kategori=' + kategori,
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
			url: '/ajax/catatan_sosmed.php',
			data: 'layanan=' + layanan,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#catatan").html(msg);
			}
		});
		$.ajax({
			url: '/ajax/rate_sosmed.php',
			data: 'layanan=' + layanan,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#rate").val(msg);
			}
		});
	});
});
document.getElementById("show1").style.display = "none";
    $("#layanan").change(function() {
		var selectedCountry = $("#layanan option:selected").text();
		if (selectedCountry.indexOf('Komen') !== -1 || selectedCountry.indexOf('komen') !== -1 || selectedCountry.indexOf('comment') !== -1 || selectedCountry.indexOf('Comment') !== -1) {
			document.getElementById("show1").style.display = "none";
			document.getElementById("show2").style.display = "block";
		} else {
		    document.getElementById("show1").style.display = "block";
			document.getElementById("show2").style.display = "none";
		}
	});
	 $(document).ready(function(){
            $("#comments").on("keypress", function(a){
                if(a.which == 13) {
                    var baris = $("#comments").val().split(/\r|\r\n|\n/).length;
                    var rates = $("#rate").val();
                    var calc = eval(baris)*rates;
                    console.log(calc)
                    $('#totalxx').val(calc);
                }
            });

        });
function get_total(quantity) {
	var rate = $("#rate").val();
	var result = eval(quantity) * rate;
	$('#total').val(result);
}
	</script>