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
                                <h4>INGIN MEMILIKI WEBSITE SEPERTI <?php echo $data['short_title']; ?> ?</h4></h4></center>
                                <br>
                                <center>
                                <h5>PENJELASAN</h5></center>                            
                                <p><?php echo $data['short_title']; ?> adalah portal di mana member dapat melakukan pembelian layanan.
Dengan memiliki website seperti <?php echo $data['short_title']; ?> bukan berarti anda bisa melakukan pemesanan semau anda dan sepuasnya.
Karena setiap pemesanan yang di lakukan oleh anda atau member anda, akan memotong saldo pusat di <?php echo $data['short_title']; ?>.</p>
                                <br>
                                <center>
                                <h5>PERTANYAAN</h5></center>  
<p><i class="mdi mdi-quora text-primary"></i> = Apakah saya bisa memiliki website smm? Sedangkan saya tidak bisa coding.<br>
<i class="mdi mdi-account-star text-danger"></i> = Sangat bisa, semua Urusan coding dan eror di website kami yang mengurus.</p>                            
<p><i class="mdi mdi-quora text-primary"></i> = Berapa harga pembuatan website smm?.<br>
<i class="mdi mdi-account-star text-danger"></i> = Harga akan kami cantumkan di bagian terahir halaman ini.</p>             
<p><i class="mdi mdi-quora text-primary"></i> = Apakah penghasilan akan langsung masuk ke rekening saya?<br>
<i class="mdi mdi-account-star text-danger"></i> = tentu saja, Semua deposit akan langsung masuk ke rekening anda.</p>
<p><i class="mdi mdi-quora text-primary"></i> = Berapa lama proses pembuatan website yang saya pesan?
<br>
<i class="mdi mdi-account-star text-danger"></i> = Untuk pemrosesan layanan web SMM kami membutuhkan waktu 1-3 Hari, setelah pembayaran terkonfirmasi.</p>
<p><i class="mdi mdi-quora text-primary"></i> = Apa bisa nanti nama website dan domain saya yang menentukan?<br>
<i class="mdi mdi-account-star text-danger"></i> = Tentu saja, Nama website dan domain anda yang menentukan sendiri.</p>
<p><i class="mdi mdi-quora text-primary"></i> = Apakah saya bisa mengatur harga layanan sesuai keinginan saya?<br>
<i class="mdi mdi-account-star text-danger"></i> = Bisa, anda bisa mengatur semua harga layanan di website anda untuk menyesuaikan keuntungan.</p>
<p><i class="mdi mdi-quora text-primary"></i> = Apakah saya bisa mendapatkan akses cpanel?<br>
<i class="mdi mdi-account-star text-danger"></i> = Tidak, anda hanya mendapatkan akses penuh admin panel.</p>
                                <br>
                                <br>
                                <center>
                                <h5>HARGA</h5></center>
                                <p><font color="#ff0000">MEDIUM.</font><br>
                                Siklus Sewa 6 Bulan Rp 160.000</p>
                                <p><font color="#ff0000">EXTRA.</font><br>
                                Siklus Sewa 12 Bulan Rp 250.000</p>                                                              
                                <p><font color="#000000">HUBUNGI KAMI UNTUK PEMBUATAN WEB PANEL ANDA</font>
                                <a href="https://api.whatsapp.com/send?phone=<?php echo $data['wa_number']; ?>&text=Halo" class="btn-loading"><i class="mdi mdi-television-guide text-primary"></i> KLIK DISINI</a></p>
                                <br>
                                <br>
                        <center><h5>Jika Ada Pertanyaan Silakan Hubungi Kontak Kami</h5></center>

                            </div>                               
                        </div>                        
                    </div>
                </div>
<?php
require '../lib/footer.php';
?>