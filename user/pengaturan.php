<?php
session_start();
require '../config.php';
require '../lib/session_login.php';
require '../lib/session_user.php';

if (isset($_POST['ganti_pass'])) {
	$password = $conn->real_escape_string(trim($_POST['password_lama']));
	$password_baru = $conn->real_escape_string(trim($_POST['password_baru']));
	$konfirmasi_baru = $conn->real_escape_string(trim($_POST['konf_pass_baru']));

	$cek_passwordnya = password_verify($password, $data_user['password']);
	$hash_passwordnya = password_hash($password_baru, PASSWORD_DEFAULT);
	if (!$password || !$password_baru || !$konfirmasi_baru) {
        	$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Password <br /> - Password Baru <br /> - Konfirmasi Password Baru');
    } else if ($cek_passwordnya == false) {
    		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Password Lama Yang Anda Masukkan Tidak Sesuai');
    } else if (strlen($password_baru) < 4 ){
    		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Password Baru Minimal 4 Karakter');
    } else if ($password_baru <> $konfirmasi_baru){
    		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Konfirmasi Password Baru Tidak Sesuai');
   	} else {

   		if ($conn->query("UPDATE users SET password = '$hash_passwordnya' WHERE username = '$sess_username'") == true) {
   			$_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Password Baru Berhasil Di Ubah');
   	} else { 
   			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Gagal !');
   		}
	}
} else if (isset($_POST['setting_nama'])) {
	$password = $conn->real_escape_string(trim($_POST['password']));
	$nama_baru = $conn->real_escape_string(trim(filter($_POST['nama'])));
	
	$cek_nama = $conn->query("SELECT * FROM users WHERE nama = '$nama_baru'");

	$cek_passwordnya = password_verify($password, $data_user['password']);
	if (!$password || !$nama_baru) {
        	$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Nama <br /> - Password');
    } else if ($cek_passwordnya == false) {
    		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Password Yang Anda Masukkan Tidak Sesuai');
    } else if ($cek_nama->num_rows > 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Nama <strong> '.$nama_baru.' </strong> Sudah Terdaftar ');        		
   	} else {

   		if ($conn->query("UPDATE users SET nama = '$nama_baru', update_nama = '0' WHERE username = '$sess_username'") == true) {
   			$_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Nama Berhasil Diubah');
   	} else { 
   			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Gagal !');
   		}
	}
} else if (isset($_POST['setting_email'])) {
	$password = $conn->real_escape_string(trim($_POST['password']));
	$email_baru = $conn->real_escape_string(trim(filter($_POST['email'])));
	
	$cek_email = $conn->query("SELECT * FROM users WHERE email = '$email_baru'");

	$cek_passwordnya = password_verify($password, $data_user['password']);
	if (!$password || !$email_baru) {
        	$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Email <br /> - Password');
    } else if ($cek_passwordnya == false) {
    		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Password Yang Anda Masukkan Tidak Sesuai');
    } else if ($cek_email->num_rows > 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Email <strong> '.$email_baru.' </strong> Sudah Terdaftar ');        		
   	} else {

   		if ($conn->query("UPDATE users SET email = '$email_baru', update_nama = '0' WHERE username = '$sess_username'") == true) {
   			$_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Email Berhasil Diubah');
   	} else { 
   			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Gagal !');
   		}
	}
} else if (isset($_POST['setting_nomer'])) {
	$password = $conn->real_escape_string(trim($_POST['password']));
	$nomer_baru = $conn->real_escape_string(trim(filter($_POST['nomer'])));
	
	$cek_nomer = $conn->query("SELECT * FROM users WHERE nomer = '$nomer_baru'");

	$cek_passwordnya = password_verify($password, $data_user['password']);
	if (!$password || !$nomer_baru) {
        	$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - No Hp <br /> - Password');
    } else if ($cek_passwordnya == false) {
    		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Password Yang Anda Masukkan Tidak Sesuai');
    } else if ($cek_nomer->num_rows > 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'No Hp <strong> '.$nomer_baru.' </strong> Sudah Terdaftar ');        		
   	} else {

   		if ($conn->query("UPDATE users SET nomer = '$nomer_baru', update_nama = '0' WHERE username = '$sess_username'") == true) {
   			$_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'No Hp Berhasil Diubah');
   	} else { 
   			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Gagal !');
   		}
	}	
	
} else if (isset($_POST['ganti_apinya'])) {
		$api_barunya = acak(32);
   		if ($conn->query("UPDATE users SET api_key = '$api_barunya' WHERE username = '$sess_username'") == true) {
   			$_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Api Key Berhasil Diubah');
   	} else { 
   			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Gagal !');
   		}
	}	
require '../lib/header.php';
?>

<div class="row">
	<div class="col-md-12">
		<div class="card"><div class="card-body">
			<h4 class="m-t-0 text-center header-title"><i class="mdi mdi-account-card-details text-primary"></i> Pengaturan Profil</h4><hr>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="25%">Nama</th>
						<td><?php echo $data_user['nama']; ?></td>
					</tr>
					<tr>
						<th width="25%">Email</th>
						<td><?php echo $data_user['email']; ?></td>
					</tr>
					<tr>
						<th width="25%">No Hp</th>
						<td><?php echo $data_user['nomer']; ?></td>
					</tr>
					<tr>
						<th width="25%">Level</th>
						<td><b class="badge badge-primary"><?php echo $data_user['level']; ?></b></td>
					</tr>
					<tr>
						<th width="45%">Up Link</th>
						<td><?php echo $data_user['uplink']; ?></td>
					</tr>
					<tr>
						<th width="45%">Api Key</th>
						
						<td style="min-width: 80px;">
                                            <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" value="<?php echo $data_user['api_key']; ?>" id="apikey-<?php echo $data_user['id']; ?>" readonly="">
                                            <button data-toggle="tooltip" title="Copy Apikey" class="btn btn-xs btn-primary" type="button" onclick="copy_to_clipboard('apikey-<?php echo $data_user['id']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                            </div>
                                               
						</td>
					</tr>		
				</table>
			    </div>	
		        </div>
	            </div>
	        </div>
	        
	        </div>
			
	        <div class="row">
		    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">                                            
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">
                                            <span class="d-block d-sm-none"><i class="mdi mdi-account-key"></i></span>
                                            <span class="d-none d-sm-block">Ganti Password</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="nama-tab" data-toggle="tab" href="#nama" role="tab" aria-controls="nama" aria-selected="true">        
                                            <span class="d-block d-sm-none"><i class="mdi mdi-account-card-details"></i></span>
                                            <span class="d-none d-sm-block">Ganti Nama</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="true">        
                                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                            <span class="d-none d-sm-block">Ganti Email</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="nomer-tab" data-toggle="tab" href="#nomer" role="tab" aria-controls="nomer" aria-selected="true">        
                                            <span class="d-block d-sm-none"><i class="mdi mdi-cellphone-iphone"></i></span>
                                            <span class="d-none d-sm-block">Ganti No Hp</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="api-tab" data-toggle="tab" href="#api" role="tab" aria-controls="api" aria-selected="false">
                                            <span class="d-block d-sm-none"><i class="mdi mdi-shuffle-variant"></i></span>
                                            <span class="d-none d-sm-block">Ganti Api Key</span>
                                        </a>
                                    </li>                                    
                                </ul>
                                
                                
                                
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <form class="form-horizontal" method="POST">
                                	<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Password Lama</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password_lama" placeholder="Password Lama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password_baru" placeholder="Password Baru">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Konfirmasi Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="konf_pass_baru" placeholder="Konfirmasi Password Baru">
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" name="ganti_pass" class="btn btn-block btn-primary waves-effect waves-light"><i class="mdi mdi-check-all"></i>	Ganti Password</button>
                                            
                                        </div>
                                    </div>
                                </form>
                                    </div>
                                    
                                    <div class="tab-pane" id="nama" role="nama" aria-labelledby="nama-tab">
                                <form class="form-horizontal" method="POST">
                                	<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                                	<?php
                                	$CallUsers = $conn->query("SELECT * FROM users WHERE username = '$sess_username'");
                                	while ($DataUsers = $CallUsers->fetch_assoc()) {
                                	 if ($DataUsers['update_nama'] == "1") {
                                		$cek = ''; 
                                        $disabled = '';
                                	} else if ($DataUsers['update_nama'] == "0") {
                                		$cek = ''; 
                                        $disabled = '';
                                	}
                                	?>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama" value="<?php echo $DataUsers['nama'] ?>" <?php echo $cek; ?>>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Password Anda</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" <?php echo $cek; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" name="setting_nama" class="btn btn-block btn-primary waves-effect waves-light" <?php echo $disabled; ?>><i class="mdi mdi-check-all"></i>	Ganti Nama</button>
                                            
                                        </div>
                                    </div>
                                <?php } ?>                                    
                                </form>
                                </div>
                                
                                <div class="tab-pane" id="email" role="email" aria-labelledby="email-tab">
                                <form class="form-horizontal" method="POST">
                                	<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                                	<?php
                                	$CallUsers = $conn->query("SELECT * FROM users WHERE username = '$sess_username'");
                                	while ($DataUsers = $CallUsers->fetch_assoc()) {
                                	 if ($DataUsers['update_nama'] == "1") {
                                		$cek = ''; 
                                        $disabled = '';
                                	} else if ($DataUsers['update_nama'] == "0") {
                                		$cek = ''; 
                                        $disabled = '';
                                	}
                                	?>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="email" value="<?php echo $DataUsers['email'] ?>" <?php echo $cek; ?>>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Password Anda</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" <?php echo $cek; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" name="setting_email" class="btn btn-block btn-primary waves-effect waves-light" <?php echo $disabled; ?>><i class="mdi mdi-check-all"></i>	Ganti Email</button>
                                            
                                        </div>
                                    </div>
                                <?php } ?>                                    
                                </form>
                                </div>
                                
                                <div class="tab-pane" id="nomer" role="nomer" aria-labelledby="nomer-tab">
                                <form class="form-horizontal" method="POST">
                                	<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                                	<?php
                                	$CallUsers = $conn->query("SELECT * FROM users WHERE username = '$sess_username'");
                                	while ($DataUsers = $CallUsers->fetch_assoc()) {
                                	 if ($DataUsers['update_nama'] == "1") {
                                		$cek = ''; 
                                        $disabled = '';
                                	} else if ($DataUsers['update_nama'] == "0") {
                                		$cek = ''; 
                                        $disabled = '';
                                	}
                                	?>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">No Hp</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nomer" value="<?php echo $DataUsers['nomer'] ?>" <?php echo $cek; ?>>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Password Anda</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" <?php echo $cek; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" name="setting_nomer" class="btn btn-block btn-primary waves-effect waves-light" <?php echo $disabled; ?>><i class="mdi mdi-check-all"></i>	Ganti No Hp</button>
                                            
                                        </div>
                                    </div>
                                <?php } ?>                                    
                                </form>
                                </div>
                                
                                <div class="tab-pane" id="api" role="api" aria-labelledby="api-tab">
                                	<form class="form-horizontal" method="POST">
                                	<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Api Key Anda</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" name="api" value="<?php echo $data_user['api_key']; ?>" id="apikey-<?php echo $data_user['id']; ?>" readonly="">
                                            </div>
                                    </div>
                                    <br />
                                    <br />
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" name="ganti_apinya" class="btn btn-block btn-primary waves-effect waves-light"><i class="mdi mdi-shuffle-variant"></i>	Update</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                </div>
                                </div>                                
                            </div>
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