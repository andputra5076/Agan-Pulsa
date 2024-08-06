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
                                <h4>PENJELASAN STATUS DI <?php echo $data['short_title']; ?></h4></h4>
                                <br>
                                <center>
                                <span class="badge badge-warning">PENDING</span>
                                <p>Pesanan/Deposit sedang dalam antrian di server.</p>
                                <br>
                                <span class="badge badge-info">PROCESSING</span>                               
                                <p>Pesanan sedang dalam proses.</p>
                                <br>
                                <span class="badge badge-success">SUCCESS</span>                               
                                <p>Pesanan telah berhasil.</p>
                                <br>
                                <span class="badge badge-danger">PARTIAL</span>                               
                                <p>Pesanan hanya masuk sebagian. Dan anda hanya akan membayar layanan yang masuk saja.</p>
                                <br>
                                <span class="badge badge-danger">ERROR</span>                               
                                <p>Terjadi Kesalahan Sistem, dan saldo akan otomatis kembali ke akun anda.</p>
                                <br>
                                <br>
                                </center>  
                                <span class="badge badge-primary">Refill</span>                               
                                <p>Refill adalah isi ulang. Jika anda membeli layanan refill dan ternyata dalam beberapa hari followers berkurang, maka akan otomatis di refill/di isi ulang.</p>
                                <p><font color="#000000">Tapi harap di ketahui, Server hanya akan mengisi ulang jika followers yang berkurang adalah followers yang di beli dengan layanan refill.</font></p>
                                <br>              
                            </div>                               
                        </div>                        
                    </div>
                </div>
<?php
require '../lib/footer.php';
?>