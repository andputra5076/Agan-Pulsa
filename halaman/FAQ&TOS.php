<?php
session_start();
require '../config.php';
require '../lib/header.php';
?>
                            <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Minton</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Extras</a></li>
                                            <li class="breadcrumb-item active">FAQs</li>
                                        </ol>
                                    </div>
                                    <!--<h4 class="page-title">FAQs</h4>-->
                                    </div>
                                    </div>
                                    </div>
	                            <div class="row">
                                <div class="col-md-12">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg">
                                        <li class="nav-item">
                                            <a href="#general-q-tab" data-toggle="tab" aria-expanded="false" class="nav-link px-3 py-2 active">
                                                <span class="d-inline-block d-sm-none"><i class="ti-help-alt"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="ti-help-alt mr-1"></i> Pertanyaan Umum</span>   
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#privacy-p-tab" data-toggle="tab" aria-expanded="true" class="nav-link px-3 py-2">
                                                <span class="d-inline-block d-sm-none"><i class="ti-shield"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="ti-shield mr-1"></i> Terms Of Services</span> 
                                            </a>
                                        </li>
                                        <!--<li class="nav-item">
                                            <a href="#support-tab" data-toggle="tab" aria-expanded="false" class="nav-link px-3 py-2">
                                                <span class="d-inline-block d-sm-none"><i class="ti-headphone-alt"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="ti-headphone-alt mr-1"></i> Support</span>  
                                            </a>
                                        </li>-->
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="general-q-tab">
                                            <div class="row pt-2">
                                                <div class="col-lg-6">
                                                    <div class="p-lg-2">
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">?</div>
                                                            <h4 class="faq-question" data-wow-delay=".1s">Bagaimana cara melakukan order ?</h4>
                                                            <p class="faq-answer mb-4">Untuk melakukan order Anda harus memiliki saldo yang cukup. Masuk ke halaman Dashboard, Silahkan pilih layanan sesuai kebutuhan anda</p>
                                                        </div>
                                
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">?</div>
                                                            <h4 class="faq-question">Bagaimana cara melakukan Deposit / Isi Saldo ? </h4>
                                                            <p class="faq-answer mb-4">Untuk melalukan deposit saldo anda pergi ke halaman <b>Dashboard</b> Silahkan pilih menu Deposit Saldo , ada banyak pilihan deposit yaitu : <br> 1. OVO CASH<br> 2. GO-PAY<br> 3. Pulsa Transfer ( TELKOMSEL , XL & AXiS )<br> Semua <b>Deposit</b> diatas menggunakan sistem otomatis <br /> <br /> Jika anda ingin melakukan deposit manual bisa hubungi admin di <b>Tiket Bantuan / Kontak Admin</b> untuk deposit : <br> 1. ALFAMART<br> 2. DANA<br> 3. LinkAja<br> 4. Bank ( BCA , BNI , BRI )<br> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/col-md-5 -->
                            
                                                <div class="col-lg-6">
                                                    <div class="p-lg-2">
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">?</div>
                                                            <h4 class="faq-question">Bagaimana Jika Orderan saya Error ?</h4>
                                                            <p class="faq-answer mb-4">Jika orderan kalian status nya <b>Error</b> maka otomatis saldo kalian akan dikembalikan (<b>Reffund</b>) dengan estimasi waktu 1-5 menit dari status <b>Error</b> tersebut</p>
                                                        </div>
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">?</div>
                                                            <h4 class="faq-question">Bagaimana jika orderan saya bermasalah / stuck order ?</h4>
                                                            <p class="faq-answer mb-4">Mohon menunggu selama 1x24 jam, orderan stuck kemungkinan dikarenakan server yang sedang Overload. Harap bersabar dan jika lebih dari 1x24 jam orderan tetap stuck, segera komplain ke menu <b>Tiket Bantuan / Kontak Admin</b></p>
                                                        </div>
                                
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">?</div>
                                                            <h4 class="faq-question">Bagaimana saya mau mendaftar akun <?php echo $data['short_title']; ?> ?</h4>
                                                            <p class="faq-answer mb-4">Jika kalian ingin mendaftar akun <?php echo $data['short_title']; ?> , silahkan lakukan pendaftaran di <a href="<?php echo $config['web']['url'] ?>auth/register">DISINI</a></p>
                                                        </div>
                                
                                                        
                                                    </div>
                                                </div>
                                                <!--/col-md-5-->
                                            </div>
                                            <!-- end row -->

                                        </div>
                                        <div class="tab-pane fade" id="privacy-p-tab">
                                            <div class="row pt-2">
                                                <div class="col-lg-6">
                                                    <div class="p-lg-2">
                                                        
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">!</div>
                                                            <h4 class="faq-question">Umum</h4>
                                                            <p class="faq-answer mb-4"><b>1.</b > Dengan mendaftar dan menggunakan layanan <?php echo $data['short_title']; ?>, Anda secara otomatis menyetujui semua ketentuan layanan kami. Kami berhak mengubah ketentuan layanan ini tanpa pemberitahuan terlebih dahulu. Anda diharapkan membaca semua ketentuan layanan kami sebelum membuat pesanan.</p>
                                                        </div>

                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">!</div>
                                                            <p class="faq-answer mb-4"><b>2.</b> Penolakan : <?php echo $data['short_title']; ?> tidak akan bertanggung jawab jika Anda mengalami kerugian dalam bisnis Anda. 
</p>
                                                        </div>
                                
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">!</div>
                                                            <p class="faq-answer mb-4"><b>3.</b> Kewajiban : <?php echo $data['short_title']; ?> tidak bertanggung jawab jika Anda mengalami suspensi akun atau penghapusan kiriman yang dilakukan oleh Instagram, Twitter, Facebook, Youtube, dan lain-lain. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/col-md-5 -->
                            
                                                <div class="col-lg-6">
                                                    <div class="p-lg-2">
                                                        
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">!</div>
                                                            <h4 class="faq-question">Layanan</h4>
                                                            <p class="faq-answer mb-4"><b>1.</b> <?php echo $data['short_title']; ?> hanya digunakan untuk media promosi sosial media dan membantu meningkatkan penampilan akun Anda saja.</p>
                                                        </div>
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">!</div>
                                                            <p class="faq-answer mb-4"><b>2.</b> <?php echo $data['short_title']; ?> tidak menjamin pengikut baru Anda berinteraksi dengan Anda, kami hanya menjamin bahwa Anda mendapat pengikut yang Anda beli. </p>
                                                        </div>
                                
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">!</div>
                                                            <p class="faq-answer mb-4"><b>3.</b> <?php echo $data['short_title']; ?> tidak menerima permintaan pembatalan/pengembalian dana setelah pesanan masuk ke sistem kami. Kami memberikan pengembalian dana yang sesuai jika pesanan tida dapat diselesaikan.</p>
                                                        </div>
                                                         <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">!</div>
                                                            <p class="faq-answer mb-4"><b>4.</b> <?php echo $data['short_title']; ?> Berhak Mensuspend akun,apabila akun tersebut di perjual belikan dan tanpa Pemberian Refund Dari Pihak <?php echo $data['short_title']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/col-md-5-->
                                            </div>
                                            <!-- end row -->
                                        </div>
                                        <div class="tab-pane fade" id="support-tab">
                                            <div class="row pt-2">
                                                <div class="col-lg-6">
                                                    <div class="p-lg-2">
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">Q.</div>
                                                            <h4 class="faq-question">How many variations exist?</h4>
                                                            <p class="faq-answer mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                        </div>

                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">Q.</div>
                                                            <h4 class="faq-question" data-wow-delay=".1s">What is Lorem Ipsum?</h4>
                                                            <p class="faq-answer mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                        </div>
                                
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">Q.</div>
                                                            <h4 class="faq-question">Why use Lorem Ipsum?</h4>
                                                            <p class="faq-answer mb-4">Lorem ipsum dolor sit amet, in mea nonumes dissentias dissentiunt, pro te solet oratio iriure. Cu sit consetetur moderatius intellegam, ius decore accusamus te. Ne primis suavitate disputando nam. Mutat convenirete.</p>
                                                        </div>
                                
                                                    </div>
                                                </div>
                                                <!--/col-md-5 -->
                            
                                                <div class="col-lg-6">
                                                    <div class="p-lg-2">
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">Q.</div>
                                                            <h4 class="faq-question">License &amp; Copyright</h4>
                                                            <p class="faq-answer mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                        </div>

                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">Q.</div>
                                                            <h4 class="faq-question">Is safe use Lorem Ipsum?</h4>
                                                            <p class="faq-answer mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                                        </div>
                                
                                                        <!-- Question/Answer -->
                                                        <div>
                                                            <div class="faq-question-q-box">Q.</div>
                                                            <h4 class="faq-question">When can be used?</h4>
                                                            <p class="faq-answer mb-4">Lorem ipsum dolor sit amet, in mea nonumes dissentias dissentiunt, pro te solet oratio iriure. Cu sit consetetur moderatius intellegam, ius decore accusamus te. Ne primis suavitate disputando nam. Mutat convenirete.</p>
                                                        </div>
                                
                                                    </div>
                                                </div>
                                                <!--/col-md-5-->
                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- container -->

                </div> <!-- content -->
<?php
require '../lib/footer-home.php';
?>               