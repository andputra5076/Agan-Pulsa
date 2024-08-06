<?php
require '../mainconfig.php';
require '../lib/check_session.php';
require '../lib/is_login.php';
if ($login['level'] == 'Member') {
	$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Opps!",text: "Hak Akses tidak sah!"});</script>');
	exit(header("Location: ".$config['web']['base_url']));
}
if ($_POST) {
	$input_data = array('full_name', 'username', 'password');
	if (check_input($_POST, $input_data) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Input tidak sesuai!"});</script>');
	} else {
		$validation = array(
			'full_name' => input_request($_POST['full_name'],$db),
			'username' => input_request($_POST['username'],$db),
			'password' => input_request($_POST['password'],$db),
			'nomor' => input_request($_POST['nomor'], $db),
			'email' => input_request($_POST['email'], $db)
		);
		if (check_empty($validation) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Input tidak boleh kosong."});</script>');
		} elseif (strlen($validation['username']) < 5) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Username minimal 5 karakter!"});</script>');
		} elseif (strlen($validation['username']) > 15) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Username maksimal 15 karakter!"});</script>');
		} elseif (strlen($validation['password']) < 5) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Password minimal 5 karakter!"});</script>');
		} elseif (strlen($validation['password']) > 15) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Password maksimal 15 karakter!"});</script>');
		} elseif ($login['balance'] < $config['register']['price']['member']) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Saldo anda tidak cukup untuk melakukan pendaftaran member!"});</script>');
		} else {
			$input_post = array(
				'level' => 'Member',
				'username' => strtolower($validation['username']),
				'password' => password_hash($validation['password'], PASSWORD_DEFAULT),
				'full_name' => $validation['full_name'],
				'balance' => 0,
				'nomor' => $validation['nomor'],
				'email' => $validation['email'],
				'api_key' => str_rand(30),
				'created_at' => date('Y-m-d H:i:s')
			);
			if ($model->db_query($db, "username", "users", "username = '".mysqli_real_escape_string($db, $input_post['username'])."'")['count'] > 0) {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Username sudah terdaftar!"});</script>');
			} else {
				if ($model->db_insert($db, "users", $input_post) == true) {
					$model->db_update($db, "users", array('balance' => $login['balance'] - $config['register']['price']['member']), "id = '".$login['id']."'");
					$model->db_insert($db, "balance_logs", array('user_id' => $login['id'], 'type' => 'minus', 'amount' => $config['register']['price']['member'], 'note' => 'Mendaftarkan Member. Username: '.$input_post['username'].'.', 'created_at' => date('Y-m-d H:i:s')));
					$_SESSION['result'] = array('alert' => 'success', 'title' => 'Member berhasil didaftarkan!', 'msg' => '<script>Swal.fire({type: "success",title: "Berhasil!",text: "Member telah didaftarkan! Username: '.$input_post['username'].' Password: '.$validation['password'].'"});</script>');
				} else {
					$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Tidak dapat mendaftarkan member!"});</script>');
				}
			}
		}
	}
}
require '../lib/header.php';
?>

<div class="header-large-title pt-5"><header class="no-border text-light">
                        <left>
                <a href="/" class="headerButton">
                    <em class="ri-arrow-left-s-line"></em>
                                        <pagetitle>Kembali</pagetitle>
                </a>
            </left>
            <right></right>
                    </header></div>

    <form class="form-horizontal" method="post">
        <section class="card-section pt-2 wd-100">
                      <card style="border-radius: .90rem">
		<card-body style="padding-top: 6px; padding-bottom: 6px">
	<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
	<div class="form-group">
		<label>Nama Lengkap</label>
		<input type="text" class="form-control" name="full_name">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" class="form-control" name="email">
	</div>
	<div class="form-group">
		<label>Nomor Handphone</label>
		<input type="number" class="form-control" name="nomor">
	</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password">
	</div>
	<div class="form-group">
			<button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
			<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button>
	</div>
</form>
								</card-body>
								</card>
                  </section>
							</div>
						</div>
<?php
require '../lib/footer.php';
?>