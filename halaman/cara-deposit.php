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
                                <h4>DEPOSIT VIA BANK / E-MONEY TRANSFER</h4></h4>
                                <br>
                                <center>
                                <p>Setelah mendaftar di <?php echo $data['short_title']; ?>, langkah selanjutnya adalah deposit saldo agar anda dapat melakukan transaksi.</p>
                                <br>
                                <i class="fa fa-edit fa-3x text-primary"></i>  
                                <h4>Request Deposit</h4>
                                <p>Langkah pertama, lakukan request deposit pada halaman member dengan memilih menu DEPOSIT SALDO lalu memilih bank serta nominal deposit yang diinginkan dan sistem akan menampilkan detail deposit anda, berupa Nominal Transfer & Bank tujuan.</p>
                                <br>
                                <i class="fa fa-paper-plane fa-3x text-primary"></i>  
                                <h4>Transfer Pembayaran</h4>
                                <p>Langkah kedua, anda akan di minta untuk melakukan transfer sejumlah nominal transfer yang tertera pada detail deposit, nominal transfer memiliki <font color="#ff0040">3 ANGKA UNIK</font> di belakang sehingga disarankan untuk transfer pembayaran sesuai nominal transfer yang tertera.</p>
                                <br>
                                <i class="fa fa-check fa-3x text-primary"></i>  
                                <h4>Konfirmasi Pembayaran</h4>
                                <p>Langkah terakhir, konfirmasi pembayaran anda dengan cara klik tombol konfirmasi,  Saldo anda akan bertambah otomatis oleh system. jika ada kesalahan transfer harap menghubungi Admin <?php echo $data['short_title']; ?></p>
                                </center>                
                            </div>                               
                        </div>                        
                    </div>
                </div>
<?php
require '../lib/footer.php';
?>

