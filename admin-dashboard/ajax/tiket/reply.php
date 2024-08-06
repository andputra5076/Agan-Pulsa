<?php
session_start();
require '../../../config.php';
require '../../../lib/session_login_admin.php';
	if (!isset($_GET['id'])) {
		exit("Anda Tidak Memiliki Akses!");
	} 
	$GetIDTiket = $conn->real_escape_string($_GET['id']);
	$CallDBTiket = $conn->query("SELECT * FROM tiket WHERE id = '$GetIDTiket'");
	$ThisData = $CallDBTiket->fetch_assoc();
	if (mysqli_num_rows($CallDBTiket) == 0) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Tiket Tidak Ditemukan');
		exit(header("Location: ".$config['web']['url']."admin-dashboard/tiket"));
	} else {
		$conn->query("UPDATE tiket SET this_admin = '1' WHERE id = '$GetIDTiket'");
		if (isset($_POST['balas'])) {
			$pesan = $conn->real_escape_string(trim(filter($_POST['pesan'])));
			if ($ThisData['status'] == "Closed") {
				$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Tiket Di Tutup');
			} else if (!$pesan) {
				$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Pesan');
			} else if (strlen($pesan) > 500) {
				$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Maksimal Pengisian Pada Form Pesan Adalah 500 Karakter');
			} else {
				$update_terakhir = "$date $time";
				$insert_tiket = $conn->query("INSERT INTO pesan_tiket VALUES ('', '$GetIDTiket', 'team-support', '".$ThisData['user']."', '$pesan',  '$date', '$time','$update_terakhir')");
				$update_tiket = $conn->query("UPDATE tiket SET update_terakhir = '$update_terakhir', this_user = '0', status = 'Responded' WHERE id = '$GetIDTiket'");
				if ($insert_tiket == TRUE) {
					$_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Sukses', 'pesan' => 'Pesan/Balasan Baru Berhasil Dikirim !!.');
				} else {
					$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'System Error');
				}
			}
		}
	}
require '../../../lib/header_admin.php';
?>

            <!-- end row -->
	        <div class="row">
	            <div class="offset-md-2 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title"><a href="<?php echo $config['web']['url']; ?>admin-dashboard/tiket.php"><div class="badge badge-primary"> <i class="fa fa-chevron-left" data-toggle="tooltip" title="Kembali"></i> Ticket #<?php echo $ThisData['id']; ?></div> - <div class="badge badge-success"> <?php echo $ThisData['subjek']; ?></div></a></h4>
        	        <hr>
										<div style="max-height: 400px; overflow: auto;">
											<div class="alert alert-info alert-white text-right"><img class="chat-avatar" src="/assets/images/user.png" alt="user" style="height: 1.5rem;width: 1.5rem; mb-2"></img>
												<b><?php echo $ThisData['user']; ?></b><br /><?php echo nl2br($ThisData['pesan']); ?><br /><i style="font-size: 10px;"><?php echo tanggal_indo($ThisData['date']); ?>, <?php echo $ThisData['time']; ?></i>
											</div>
<?php
$CekPesannya = $conn->query("SELECT * FROM pesan_tiket WHERE id_tiket = '$GetIDTiket'");
while ($IniPesannya = $CekPesannya->fetch_assoc()) {
	if ($IniPesannya['pengirim'] == "team-support") {
		$alert = "primary";
		$text = "";
		$pengirim = "team-support";
	} else {
		$alert = "info";
		$text = "text-right";
		$pengirim = $IniPesannya['user'];
	}
?>
											<div class="alert alert-<?php echo $alert; ?> <?php echo $text; ?>">
												<b><?php echo $pengirim; ?></b> <img class="chat-avatar" src="/assets/images/admin.png" alt="user" style="height: 1.5rem;width: 1.5rem; mb-2"></img> <br /><?php echo nl2br($IniPesannya['pesan']); ?><br /><i style="font-size: 10px;"><?php echo tanggal_indo($IniPesannya['date']); ?>, <?php echo $IniPesannya['time']; ?></i>
											</div>
<?php
}
?>
										</div>
										<div class="card-footer">
    				<form class="form-horizontal" role="form" method="POST">
    					<div class="input-group">
    						<input type="hidden" class="form-control" name="pesan" value="<?php echo $ThisData['id']; ?>">
    						    						<textarea class="form-control" name="pesan" placeholder="Balas pesan dari <?php echo $ThisData['user']; ?> ..."></textarea>
    						<span class="input-group-append">
    						<button class="btn btn-primary" name="balas"><i>Kirim</i></button>
    						</span>
    						    					</div>
    				</form>
    			</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
<?php require '../../../lib/footer_admin.php'; ?>