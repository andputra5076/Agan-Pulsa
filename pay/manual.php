<?php
session_start();
require("../config.php");
require '../lib/session_user.php';	
require '../lib/session_login.php';
require("../lib/header.php");
?> 
			<div class="row">
                        <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-wallet text-primary"></i> DEPOSIT MANUAL </h4><hr>
                                <img src="<?php echo $config['web']['url'] ?>assets/images/qris-saya.png" alt="DEPOSIT-MANUAL VIA QRIS" class="card-img-top"></img>
                                <div class="card-body">
                                <center><b>INFORMASI DEPOSIT MANUAL</b></center><br/>
				<div class="mb-3" id="accordion">
				<div class="card mb-1">
			   <!-- KE 1 -->  
				<div class="card-header" id="headingOne">
				<h4 class="m-0">
				<a class="text-dark collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
				<i class="mdi mdi-help-circle mr-1 text-primary"></i>SCAN DEPOSIT MANUAL
				</a>
				</h4>
				</div>
				<div id="collapseOne" class="card-collapse collapse in" role="tabcard" aria-labelledby="headingOne">
				<div class="card-body">
					<ul>
			                <li>Scan kode QR diatas pastikan sesuai nama merchant <b> -</b>.</li><br />
                                        <li>Isi nominal deposit saldo.</li><br />
                                        <li>Selesaikan pembayaran deposit saldo.</li><br />
                                        <li>Jika anda sudah melakukan pembayaran diatas silahkan kirim bukti pembayaran ke kontak admin<b><a href="../halaman/kontak-kami"> KLIK DISINI.!! </a></b></li><br />
            				
            				<ul>
        			</div>
        			</div>
        		        </div>        		        
        		    <!-- KE 2 -->  
        		        <div class="card mb-1">
		                <div class="card-header" id="headingTwo">
				<h4 class="m-0">
				<a class="text-dark collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="true">
				<i class="mdi mdi-help-circle mr-1 text-primary"></i>DEPOSIT MANUAL
				</a>
			        </h4>
				</div>
				<div id="collapseTwo" class="card-collapse collapse" role="tabcard" aria-labelledby="headingTwo">
				<div class="card-body">
					<ul>
        		                <li><b class="text-dark">ShopeePay</b> : - </li><br />
       		                        <li><b class="text-dark">Alfamart</b> : Silahkan minta bantuan kasir untuk TOP UP Saldo <b>Dana / Go-pay</b> dengan nomor di bawah ini</li><br />  		        
        	                  	<li><b class="text-dark">LinkAja</b> : - </li><br />
        		                <li><b class="text-dark">GO-PAY</b> : 085381259307 A/n <?php echo $data_kontak['nama']; ?> </li><br />
        		                <li><b class="text-dark">DANA</b> : 085381259307 A/n <?php echo $data_kontak['nama']; ?> </li><br />
        		                <li><b class="text-dark">OVO</b> : 085381259307 A/n <?php echo $data_kontak['nama']; ?> </li><br />
        		                <li>Jika anda sudah melakukan pembayaran diatas silahkan kirim bukti pembayaran ke kontak admin<b><a href="../halaman/kontak-kami"> KLIK DISINI.!! </a></b></li>
        		                </ul>
				</div>
				</div>
				</div>			   
			   <!-- DONE -->
			   
        	                </div>
                                </div>
                             </div>
                         </div>
                        </div>  
                        </div>
                        </div>
<?php
require '../lib/footer.php';
?>

