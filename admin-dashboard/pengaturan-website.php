<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php'; 

 if (isset($_POST['edit'])) {
            $PostStitle = $conn->real_escape_string(filter($_POST['shrt_title']));
            $PostTitle = $conn->real_escape_string(trim($_POST['title']));
            $PostDescWeb = $conn->real_escape_string(trim($_POST['deskripsi']));
            $PostInstagram = $conn->real_escape_string(trim($_POST['instagram']));
            $PostFacebook = $conn->real_escape_string(trim($_POST['facebook']));
            $PostWhatsapp = $conn->real_escape_string(trim($_POST['whatsapp']));
            $PostEmail = $conn->real_escape_string(trim($_POST['email']));
            $PostTwitter = $conn->real_escape_string(trim($_POST['twitter']));
            $PostReseller = $conn->real_escape_string(trim($_POST['reseller']));
            $PostLogo = $conn->real_escape_string(trim($_POST['logo']));

                if ($conn->query("UPDATE setting_web SET short_title = '$PostStitle', title = '$PostTitle', deskripsi_web = '$PostDescWeb', ig_akun = '$PostInstagram', facebook_akun = '$PostFacebook', wa_number = '$PostWhatsapp', email_akun = '$PostEmail', twitter = '$PostTwitter', daftar_reseller = '$PostReseller', logo_web = '$PostLogo' WHERE id = '1'") == true) {
                    $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => '
                        Pengaturan Website Telah Berhasil Diubah <br />                       
                        ');                    
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
                }
            }
        
    require("../lib/header_admin.php");
?>       
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="fa fa-gears text-primary"></i> Pengaturan Website</h4><hr>
                                    
                                        
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                    <tr>
                                        <th>Short Title</th>
                                        <th>Title Website</th>
                                        <th>Deskripsi Website</th>
                                        <th>Instagram</th>
                                        <th>Facebook</th>
                                        <th>WhatsApp</th>
                                        <th>Email</th>
                                        <th>Twitter</th>
                                        <th>Daftar_Reseller</th>
                                        <th>logo_Web</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
<?php 
$CekData = $conn->query("SELECT * FROM setting_web WHERE id = '1'"); // edit
while ($ShowData = $CekData->fetch_assoc()) {
?>
                                    <tr> 
                                        <td style="min-width: 150px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['short_title']; ?></textarea></td>
                                        <td style="min-width: 180px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['title']; ?></textarea></td>
                                        <td style="min-width: 250px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['deskripsi_web']; ?></textarea></td>
                                        <td style="min-width: 180px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['ig_akun']; ?></textarea></td>
                                        <td style="min-width: 180px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['facebook_akun']; ?></textarea></td>
                                        <td style="min-width: 180px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['wa_number']; ?></textarea></td>
                                        <td style="min-width: 180px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['email_akun']; ?></textarea></td>
                                        <td style="min-width: 180px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['twitter']; ?></textarea></td>
                                        <td style="min-width: 180px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['daftar_reseller']; ?></textarea></td>
                                        <td style="min-width: 180px;"><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['logo_web']; ?></textarea></td>
                                        <td align="center">
                                            <a href="javascript:;" onclick="users('/admin-dashboard/ajax/pengaturan-website/edit.php?id=1')" class="btn btn-xs btn-warning"><i class="fa fa-pencil" title="Edit"></i> Update </a>
                                        </td>                                 
                                    </tr>  
<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <script type="text/javascript">
        function users(url) {
            $.ajax({
                type: "GET",
                url: url,
                beforeSend: function() {
                    $('#modal-detail-body').html('Sedang memuat...');
                },
                success: function(result) {
                    $('#modal-detail-body').html(result);
                },
                error: function() {
                    $('#modal-detail-body').html('Terjadi kesalahan.');
                }
            });
            $('#modal-detail').modal();
        }
    </script> 
        <div class="row">
            <div class="col-md-12">     
                <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title mt-0" id="myModalLabel"><i class="fa fa-gears text-primary"></i> Pengaturan Website</h4>
                                
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <div class="modal-body" id="modal-detail-body">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require '../lib/footer_admin.php';
?>