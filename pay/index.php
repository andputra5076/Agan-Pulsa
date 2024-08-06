<?php
session_start();
require("../config.php");
require '../lib/session_user.php';
require '../lib/session_login.php';

require("../lib/header.php");
?>

<!--Title-->
<title>Deposit Saldo</title>
<meta name="description" content="Platform Layanan Digital All in One, Berkualitas, Cepat & Aman. Menyediakan Produk & Layanan Pemasaran Sosial Media, Payment Point Online Bank, Layanan Pembayaran Elektronik, Optimalisasi Toko Online, Voucher Game dan Produk Digital."/>

<div class="row">
	<div class="col-12">
		<div class="card card-body">
               <center>
				<h1 class="m-t-0 text-uppercase text-center header-title"><b>Pilih Metode Deposit <a href="button" data-toggle="modal" data-target="#exampleModalLong4">
 <i class="fa fa-bell faa-tada animated" style="color: blue"> </i></b></h1>
			</center><br>
<!--START DEPO Manual-->
<div class="row">
				<div class="col-lg-4 col-sm-12">
					<a class="card card-body text-center text-success" href="/pay/bank.php" style="height:200px;">
						<center>
							<img src="/assets/images/depo/tf-bank.jpg" class="img-responsive" width="100"/>
						</center>
						<h4>Deposit <br>(Manual)</h4>
					</a>
				</div>
                <div class="col-lg-4 col-sm-12">
					<a class="card card-body text-center text-success" href="/pay/e-wallet.php" style="height:200px;">
						<center>
							<img src="/assets/images/depo/qris.png" class="img-responsive" width="100"/>
						</center>
						<h4>QRIS All Payment<br>(Otomatis 24Jam)</h4>
					</a>
				</div>
                <div class="col-lg-4 col-sm-12">
					<a class="card card-body text-center text-success" href="/pay/virtual-account.php" style="height:200px;">
						<center>
							<img src="/assets/images/depo/virtual-account.png" class="img-responsive" width="100"/>
						</center>
						<h4>Virtual Account<br>(Otomatis 24Jam)</h4>
					</a>
				</div>
			</div>
           <div class="row">
               <div class="col-lg-4 col-sm-12">
					<a class="card card-body text-center text-success" href="/pay/convenience-store.php" style="height:200px;">
						<center>
							<img src="/assets/images/depo/convenience-store-new.png" class="img-responsive" width="100"/>
						</center>
						<h4>Convenience Store<br>(Otomatis 24Jam)</h4>
					</a>
				</div>
				<!--<div class="col-lg-4 col-sm-12">
					<a class="card card-body text-center text-success" href="/pay/e-wallet.php" style="height:200px;">
						<center>
							<img src="/assets/images/depo/e-wallet.jpg" class="img-responsive" width="100"/>
						</center>
						<h4>E-Wallet & Qris All<br>(Otomatis 24Jam)</h4>
					</a>
				</div>-->
				<div class="col-lg-4 col-sm-12">
					<a class="card card-body text-center text-success" href="/pay/redeem.php" style="height:200px;">
						<center>
							<img src="/assets/images/depo/voc.svg" class="img-responsive" width="100"/>
						</center>
						<h4>Redeem Voucher</h4>
					</a>
				</div>
				<div class="col-lg-4 col-sm-12">
					<a class="card card-body text-center text-success" href="/invoice.php" style="height:200px;">
						<center>
							<img src="/assets/images/depo/invoice.png" class="img-responsive" width="100"/>
						</center>
						<h4>CEK INVOICE / TAGIHAN<br></h4>
					</a>
				</div>
			</div>
			<!--<div class="row">
			    <div class="col-lg-4 col-sm-12">
					<a class="card card-body text-center text-success" href="/invoice.php" style="height:200px;">
						<center>
							<img src="/assets/images/depo/invoice.png" class="img-responsive" width="100"/>
						</center>
						<h4>CEK INVOICE / TAGIHAN<br></h4>
					</a>
				</div>
			</div>-->
		</div>
	</div>
</div>
<!-- Modal -->
        <!--<div class="modal fade" id="exampleModalLong4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle4" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle4">Notifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3><strong> DEPOSIT Manual & Otomatis</strong> <br></h3>
        Untuk deposit manual tidak dikenakan biaya faktur pajak transaksi<br><br>
        - <strong> Dana</strong> PPN  Rp 0<br>
        - <strong> Ovo</strong> PPN  Rp 0<br>
        - <strong> BCA</strong> PPN  Rp 0<br>
        - <strong> BNI</strong> PPN  Rp 0<br>
        - <strong> BRI</strong> PPN  Rp 0<br>
        - <strong> BTPN</strong> PPN  Rp 0<br>
        - <strong> CIMBNIAGA</strong> PPN  Rp 0<br>
        - <strong> MANDIRI</strong> PPN  Rp 0<br>
        - <strong> SINARMAS</strong> PPN  Rp 0<br>
       <br>
        <h3><strong> DEPOSIT OTOMATIS TRIPAY</strong> <br></h3>
        Untuk deposit otomatis tripay akan dikenakan faktur pajak transaksi sesuai metode deposit otomatis yang dipilih, Karna adanya Administration Fee dan PPN (Pajak Pertambahan Nilai) <br><br>
        - <strong> BCA</strong> PPN  3.00<br>
        - <strong> BNI</strong> PPN  3.00<br>
        - <strong> OVO</strong> PPN  2.00%<br>
        - <strong> QRISC</strong> PPN  Rp 750 + 0.70%<br>
        - <strong> Virtual Account BNI</strong> PPN  Rp 4.250<br>
        - <strong> Virtual Account BRI</strong> PPN  Rp 4.250<br>
        - <strong> Virtual Account PERMATA</strong> PPN  Rp 4.250<br>
        - <strong> Virtual Account MANDIRI</strong> PPN  Rp 4.250<br>
        - <strong> Virtual Account BSI</strong> PPN  Rp 4.250<br>
        - <strong> Virtual Account BCA</strong> PPN  Rp 5.000<br>
        - <strong> ALFAMART</strong> PPN  Rp 6.000<br>
        - <strong> INDOMARET</strong> PPN  Rp 3.500<br>
        - <strong> ALFAMIDI</strong> PPN  Rp 6.000<br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
				</div>
				</div>-->
<?php
require ("../lib/footer.php");
?>