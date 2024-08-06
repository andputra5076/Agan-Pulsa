<?php
session_start();
require '../../../config.php';
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if (!isset($_SESSION['user']) || $data_user['level'] == "Developers") {
		exit("Anda Tidak Memiliki Akses!");
	}
	if (!isset($_GET['id'])) {
		exit("Anda Tidak Memiliki Akses!");
	} 		
$GetID = $conn->real_escape_string(filter($_GET['id']));
$CekData = $conn->query("SELECT * FROM setting_web WHERE id = '$GetID'");
$Datanya = $CekData->fetch_assoc();
	if (mysqli_num_rows($CekData) == 0) {
		exit("Data Tidak Ditemukan");
	} else {
?>				
						
		    <div class="row">
		    	<div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
				<label>Short Title</label>
				<input type="text" name="shrt_title" class="form-control" value="<?php echo $Datanya['short_title']; ?>"></div>      
				                              	
				<div class="form-group">
				<label>Title Website</label>
				<input type="text" name="title" class="form-control" value="<?php echo $Datanya['title']; ?>"></div>
				
                <div class="form-group">
				<label>Deskripsi Website</label>
				<textarea type="text" name="deskripsi" class="form-control" style="min-height: 250px;"><?php echo $Datanya['deskripsi_web']; ?></textarea></div>
				
				<div class="form-group">
				<label>instagram</label>
				<input type="text" name="instagram" class="form-control" value="<?php echo $Datanya['ig_akun']; ?>"></div>
				
				<div class="form-group">
				<label>facebook</label>
				<input type="text" name="facebook" class="form-control" value="<?php echo $Datanya['facebook_akun']; ?>"></div>
				
				<div class="form-group">
				<label>whatsapp</label>
				<input type="text" name="whatsapp" class="form-control" value="<?php echo $Datanya['wa_number']; ?>"></div>
				
				<div class="form-group">
				<label>email</label>
				<input type="text" name="email" class="form-control" value="<?php echo $Datanya['email_akun']; ?>"></div>
				
				<div class="form-group">
				<label>twitter</label>
				<input type="text" name="twitter" class="form-control" value="<?php echo $Datanya['twitter']; ?>"></div>
				
				<div class="form-group">
				<label>_harga_reseller</label>
				<input type="text" name="reseller" class="form-control" value="<?php echo $Datanya['daftar_reseller']; ?>"></div>
				
				<div class="form-group">
				<label>url_logoWeb</label>
				<input type="text" name="logo" class="form-control" value="<?php echo $Datanya['logo_web']; ?>"></div>

				<div class="modal-footer">
                                <button type="submit" class="btn btn-warning waves-effect w-md waves-light" name="edit"><i class="fa fa-pencil"></i> Update</button></div>
				</form>
                         </div>
                    </div>
<?php 
	}
} else {
	exit("Anda Tidak Memiliki Akses!");
}
