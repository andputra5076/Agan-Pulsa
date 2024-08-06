<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
	$post_idtarget = $conn->real_escape_string($_GET['id']);
	require '../lib/session_login.php';
	$cek_tiket = $conn->query("SELECT * FROM tiket WHERE id = '$post_idtarget' AND user = '$sess_username'");
	$data_tiket = $cek_tiket->fetch_assoc();

	$cek_balasan = $conn->query("SELECT * FROM pesan_tiket WHERE id_tiket = '$post_idtarget' AND pengirim = 'team-support'");
	if (mysqli_num_rows($cek_tiket) == 0) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Tiket Tidak Ditemukan');
		exit(header("Location: ".$config['web']['url']."tiket/"));
	} else {
		$conn->query("UPDATE tiket SET this_user = '1' WHERE id = '$post_idtarget'");
		if (isset($_POST['balas'])) {
			$pesan = $conn->real_escape_string(trim(filter($_POST['pesan'])));
			if ($data_tiket['status'] == "Closed") {
				$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Status Tiket Closed/Sudah Ditutup Dikarenakan Ada Masalah,Harap Membuat Tiket Baru');
					exit(header("Location: ".$config['web']['url']."tiket/"));
			} else if (!$pesan) {
				$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Pesan');
			} else if (strlen($pesan) > 500) {
				$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Maksimal Pengisian Pada Form Pesan Adalah 500 Karakter');
			} else {
				$update_terakhir = "$date $time";
				$insert_tiket = $conn->query("INSERT INTO pesan_tiket VALUES ('', '$post_idtarget', 'Member', '$sess_username', '$pesan',  '$date', '$time','$update_terakhir')");
				$update_tiket = $conn->query("UPDATE tiket SET update_terakhir = '$update_terakhir' WHERE id = '$post_idtarget'");
				if (mysqli_num_rows($cek_balasan) > 0) {
					$conn->query("UPDATE tiket SET status = 'Waiting', this_team-support = '0' WHERE id = '$post_idtarget'");
				}
				if ($insert_tiket == TRUE) {
					$_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Sukses', 'pesan' => 'Pesan/Balasan Baru Berhasil Dikirim !!.');
				} else {
					$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'System Error');
				}
			}
		}
	}
require '../lib/header.php';
?>

                        <!-- end row -->
	        <div class="row">
	            <div class="offset-md-2 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title"><a href="<?php echo $config['web']['url']; ?>tiket/"><div class="badge badge-primary"> <i class="fa fa-chevron-left" data-toggle="tooltip" title="Kembali"></i> Ticket #<?php echo $data_tiket['id']; ?></div> - <div class="badge badge-success"> <?php echo $data_tiket['subjek']; ?></div></a></h4>
        	        <hr>
										<div style="max-height: 400px; overflow: auto;">
											<div class="alert alert-info alert-white text-right"><b><?php echo $data_tiket['user']; ?></b><br /><i style="font-size: 10px;"><?php echo tanggal_indo($data_tiket['date']); ?>, <?php echo $data_tiket['time']; ?></i><br /><br /><?php echo nl2br($data_tiket['pesan']); ?>
											</div>
<?php
$cek_pesan = $conn->query("SELECT * FROM pesan_tiket WHERE id_tiket = '$post_idtarget'");
while ($data_pesan = $cek_pesan->fetch_assoc()) {
	if ($data_pesan['pengirim'] == "team-support") {
		$alert = "warning";
		$text = "";
		$pengirim = "team-support";
	} else {
		$alert = "info";
		$text = "text-right";
		$pengirim = $data_pesan['user'];
	}
?>
											<div class="alert alert-<?php echo $alert; ?> <?php echo $text; ?>">
												<b><?php echo $pengirim; ?></b><br /><i style="font-size: 10px;"><?php echo tanggal_indo($data_pesan['date']); ?>, <?php echo $data_tiket['time']; ?></i><br /><br /><?php echo nl2br($data_pesan['pesan']); ?>
											</div>
<?php
}
?>
                                                </div>	

						</div>						
					</div>					
				</div>				
			</div>			
		</div>		
	</div>	
</div>
<?php require '../lib/footer.php'; ?>