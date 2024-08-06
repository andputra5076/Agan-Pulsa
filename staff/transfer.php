<?php
require '../mainconfig.php';
require '../lib/check_session.php';
require '../lib/is_login.php';
if ($_POST) {
	$input_data = array('username', 'amount');
	if (check_input($_POST, $input_data) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Input tidak sesuai!"});</script>');
	} else {
		$input_post = array(
			'username' => input_request($_POST['username'], $db),
			'amount' => input_request($_POST['amount'], $db),
		);
		if (check_empty($input_post) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Input tidak boleh kosong!"});</script>');
		} elseif ($input_post['amount'] < 10000) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Minimal transfer saldo Rp. 10.000!"});</script>');
		} elseif ($input_post['amount'] > 1000000) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Maksimal transfer saldo Rp. 1.000.000!"});</script>');
		} elseif (strlen($input_post['amount']) > 7) {
		    $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Input maksimal 7 karakter."});</script>');
		} elseif ($login['balance'] < $input_post['amount']) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Saldo anda tidak mencukupi untuk melakukan transfer saldo!"});</script>');
		} elseif ($input_post['username'] == $login['username']) {
		    $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Tidak dapat melakukan transfer ke Akun Sendiri!"});</script>');
		} elseif (strlen($input_post['username']) > 15) {
		    $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Username maksimal 15 karakter."});</script>');
		
		} else {
			$user_target = $model->db_query($db, "*", "users", "username = '".$input_post['username']."'");
			if ($user_target['count'] == 0) {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => '<script>Swal.fire({type: "error",title: "Gagal!",text: "Pengguna tidak ditemukan!"});</script>');
			} else {
				$model->db_update($db, "users", array('balance' => $login['balance'] - $input_post['amount']), "id = '".$login['id']."'");
				$model->db_update($db, "users", array('balance' => $user_target['rows']['balance'] + $input_post['amount']), "id = '".$user_target['rows']['id']."'");
				$model->db_insert($db, "balance_logs", array('user_id' => $login['id'], 'type' => 'minus', 'amount' => $input_post['amount'], 'note' => 'Transfer saldo Social Media. Penerima: '.$input_post['username'].'.', 'created_at' => date('Y-m-d H:i:s')));
				$model->db_insert($db, "balance_logs", array('user_id' => $user_target['rows']['id'], 'type' => 'plus', 'amount' => $input_post['amount'], 'note' => 'Transfer saldo. Pengirim: '.$login['username'].'.', 'created_at' => date('Y-m-d H:i:s')));
				$_SESSION['result'] = array('alert' => 'success', 'title' => 'Transfer saldo Social Media berhasil!', 'msg' => '<script>Swal.fire({type: "success",title: "Berhasil!",text: "Penerima: '.$input_post['username'].' Jumlah Saldo: Rp '.number_format($input_post['amount'],0,',','.').'"});</script>');
			}
		}
	}
}
require '../lib/header.php';
?>
<div class="header-large-title pt-5">
	<header class="no-border text-light">
	    
		<left>
			<a href="/" class="headerButton"> <em class="ri-arrow-left-s-line"></em>
				<pagetitle>Kirim Saldo - Sosmed</pagetitle>
			</a>
		</left>
		<right></right>
	</header>
</div>
<form class="form-horizontal" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
	<section class="card-section pt-2 wd-100">
		<card style="border-radius: .90rem">
			<card-body style="padding-top: 6px; padding-bottom: 6px">
				<div class="form-group">
					<label>Username</label>
					<div class="input-group input-group-fade">
						<input ttype="number" class="form-control" name="username" style="border-radius: .40rem">
					</div>
				</div>
				<div class="form-group">
                    <label>Masukkan Nominal</label>
                    <input type="number" class="form-control" name="amount" style="border-radius: .40rem">
                </div>
                
                <button class="btn btn-primary btn-block text-center" name="myButton" onclick="MyCustomFunction()" id="submit" data-loading-text="Mohon menunggu..." type="submit">Transfer</button>
			</card-body>
		</card>
	</section>
</form>
</div>
	</div>
	    </div>
<?php
require '../lib/footer.php';
?>