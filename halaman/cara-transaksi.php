<?php
session_start();
require '../config.php';
require '../lib/header.php';
?>
        <div class="row">
                    <div class="col-sm-12">
                        <div class="card">    
                        <div class="card-body table-responsive">                            
                                <h4 class="m-t-0 header-title">
                                <center>                                
                                <h4>3 LANGKAH MUDAH UNTUK MEMULAI</h4></h4>
                                <br>
                                <center>
                                <p>berikut langkah untuk memulai bisnis anda bersama <?php echo $data['short_title']; ?></p>
                                <br>
                                <i class="mdi mdi-account-multiple-plus mdi-48px text-primary"></i>
                                <h4>1. Daftar Akun</h4>
                                <p>Langkah pertama, Segera daftar menjadi member/resseler , pendaftaran member tidak di kenakan biaya apapun <b>[GRATIS] !</b></p>
                                <br>
                                <i class="mdi mdi-wallet mdi-48px text-primary"></i>  
                                <h4>2. Deposit Saldo</h4>
                                <p>Langkah kedua, untuk melakukan pengisian saldo, Anda hanya perlu masuk terlebih dahulu ke akun Anda dan menuju halaman deposit dengan mengklik menu yang sudah tersedia. Kami menyediakan deposit melalui Bank, E-money dan Pulsa.</p>
                                <br>
                                <i class="mdi mdi-cart-plus mdi-48px text-primary"></i>  
                                <h4>3. Mulai Transaksi</h4>
                                <p>Setelah anda melakukan 2 langkah di atas, Anda dapat melakukan transaksi Pulsa dan Sosial Media ataupun layanan lainnya yang tersedia di <?php echo $data['short_title']; ?></p>
                                </center>                
                            </div>                               
                        </div>                        
                    </div>
                </div>
<?php
require '../lib/footer.php';
?>        