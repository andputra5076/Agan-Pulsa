<?php
session_start();
require '../config.php';
require '../lib/header.php';
?>
    <div class="row">
         <div class="col-sm-12">
              <div class="card">    
                   <div class="card-body table-responsive">                            
                        <h4 class="m-t-0 text-uppercase text-center header-title">
                        <img src="/assets/images/admin.png" style="height: 13rem;width: 15rem;"></img>   
                        <br />
                        <br />
                        <span> CEO & FOUNDER </span>
                        </h4>
                        <p class="text-center"> <?php echo $data_kontak['nama']; ?> </p>
                        <br />
                        <h4 class="m-t-0 text-uppercase text-center header-title"><img src="/assets/svg/andreas.svg" alt="ALAMAT" style="height: 1rem;width: 1rem;"></img> ALAMAT</h4>
                        <p class="text-center"> <?php echo $data_kontak['alamat']; ?> </p>
                        <br />
                        <h4 class="m-t-0 text-uppercase text-center header-title"><img src="/assets/svg/contact.svg" alt="KONTAK KAMI" style="height: 1rem;width: 1rem;"></img> KONTAK KAMI</h4>
                        <hr>
                        <br />
                        <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                                   <li class="nav-item"><a href="https://facebook.com/<?php echo $data['faccebook_akun']; ?>" class="btn-loading"><img src="/assets/svg/fb.svg" alt="Facebook" style="height: 3rem;width: 3rem; mb-2"></img><br></a></li>
                                   <li class="nav-item"><a href="https://instagram.com/<?php echo $data['ig_akun']; ?>" class="btn-loading"><img src="/assets/svg/ig.svg" alt="Instagram" style="height: 3rem;width: 3rem; mb-2"></img><br></a></li>
                                   <li class="nav-item"><a href="https://wa.me/<?php echo $data['wa_number']; ?>" class="btn-loading"><img src="/assets/svg/wa.svg" alt="WhatsApp" style="height: 3rem;width: 3rem; mb-2"></img><br></a></li>
                                   <li class="nav-item"><a href="https://twitter.com/<?php echo $data['twitter']; ?>" class="btn-loading"><img src="/assets/images/twiter.png" alt="Telegram" style="height: 3rem;width: 3rem; mb-2"></img><br></a></li>
                        </ul>
                        
                           <br />
                        
                              <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                                   <li class="nav-item"><a href = "mailto:<?php echo $data['email_akun']; ?>" class="btn-loading"><img src="/assets/svg/mail.svg" alt="Email" style="height: 4rem;width: 4rem; mb-2"></img><br></a></li>
                                   
                                   <li class="nav-item"><a href = "mailto:<?php echo $data['email_akun']; ?>" class="btn-loading"><img src="/assets/svg/gmail.svg" alt="Gmail" style="height: 3.5rem;width: 3.5rem; mb-2"></img><br></a></li>
                              </ul>
                        
                    </div>
               </div>
          </div>
     </div>                      
<?php
require '../lib/footer-home.php';
?>