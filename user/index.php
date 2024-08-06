<?php 
session_start();
require '../config.php';
require '../lib/session_login.php';
require '../lib/session_user.php';

require '../lib/header.php';
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-heading">
                            </div>
                            <div class="card-body">
                                <h4 class="text-center text-success">Username: <?php echo $data_user['nama']; ?></h4>                              	
                            </div>
                         </div>
                      </div>
                 </div>    
                 
                 <div class="row">
                    <div class="col-12">
	                <div class="card text-center">
	                    <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th><a href="/pay/">
                                        <h5 class="float-left"><i class="mdi mdi-wallet text-primary mdi-18px"></i> Saldo </h5>
                                        <h5 class="float-right text-primary"> <b>Rp <?php echo number_format($data_user['saldo'],0,',','.'); ?> <span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h5>
                                    </th></a>
                                </tr>
                                
                                <tr>
                                    <th><a href="/user/pemakaian-saldo.php">
                                        <h5 class="float-left"><i class="mdi mdi-coin text-primary mdi-18px"></i> Pemakaian Saldo </h5>
                                        <h5 class="float-right text-primary"> <b>Rp <?php echo number_format($data_user['pemakaian_saldo'],0,',','.'); ?> <span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h5>
                                    </th></a>
                                </tr>
                                
                                <tr>
                                    <th><a href="/user/pemakaian-saldo.php">
                                        <h5 class="float-left"><i class="mdi mdi-file-restore text-primary mdi-18px"></i> Mutasi Saldo </h5>
                                        <h6 class="float-right"> detail <span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h6>
                                    </th></a>
                                </tr>
                                
                                <tr>
                                    <th><a href="/user/log.php">
                                        <h5 class="float-left"><i class="mdi mdi-file-restore text-primary mdi-18px"></i> Riwayat Aktivitas </h5>
                                        <h6 class="float-right"> detail <span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h6>
                                    </th></a>
                                </tr>
                                                                                                
                            </tbody>
                        </table>
	                </div>
	            </div>
	        </div>
	        
	        <div class="col-12">
	        <small> PENGATURAN </small>
	        </div>
	        
	        <div class="row">
                    <div class="col-12">
	                <div class="card text-center">
	                    <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th><a href="/user/pengaturan.php">
                                        <h5 class="float-left">Pengaturan Profil</h5>
                                        <h5 class="float-right text-primary"><b><span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h5>
                                    </th></a>
                                </tr>
                               <tr>
                                    <th><a href="/logout.php">
                                        <h5 class="float-left">Keluar</h5>
                                        <h5 class="float-right text-primary"><b><span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h5>
                                    </th><a>
                                </tr>                                                              
                            </tbody>
                        </table>
	                </div>
	            </div>
	        </div>
	        
	        <div class="col-12">
	        <small> INFORMASI UMUM </small>
	        </div>
	        
	        <div class="row">
                    <div class="col-12">
	                <div class="card text-center">
	                    <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <th><a href="/halaman/cara-deposit.php">
                                        <h5 class="float-left">Cara Deposit Saldo</h5>
                                        <h5 class="float-right text-primary"><b><span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h5>
                                    </th></a>
                                </tr>
                                
                                <tr>
                                    <th><a href="/halaman/cara-transaksi.php">
                                        <h5 class="float-left">Cara Transaksi</h5>
                                        <h5 class="float-right text-primary"><b><span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h5>
                                    </th></a>
                                </tr>
                                <tr>
                                
                                <tr>
                                    <th><a href="/halaman/info.php">
                                        <h5 class="float-left">Penjelasan Status</h5>
                                        <h5 class="float-right text-primary"><b><span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h5>
                                    </th></a>
                                </tr>
                                
                                <tr>
                                    <th><a href="/halaman/FAQ&TOS.php">
                                        <h5 class="float-left">Syarat & Ketentuan</h5>
                                        <h5 class="float-right text-primary"><b><span class="mdi mdi-chevron-right text-primary mdi-18px"></span></b></h5>
                                    </th></a>
                                </tr>
                                                                                             
                            </tbody>
                        </table>
	                </div>
	            </div>
	        </div>
                                                       
                
           
<script type="text/javascript">
function copy_to_clipboard(element) {
    var copyText = document.getElementById(element);
    copyText.select();
    document.execCommand("copy");
}
</script>              
                           
<?php
require '../lib/footer.php';
?>
