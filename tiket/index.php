<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
	if (isset($_POST['kirim'])) {
		require '../lib/session_login.php';
		$post_subjek = $conn->real_escape_string(trim(filter($_POST['subjek'])));
		$post_pesan = $conn->real_escape_string(trim(filter($_POST['pesan'])));
		if (!$post_subjek || !$post_pesan) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Subjek <br /> - Pesan');	
		} else if (strlen($post_subjek) > 200) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Maksimal Pengisian Pada Form Subjek Adalah 200 Karakter');	
		} else if (strlen($post_pesan) > 500) {
			$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Maksimal Pengisian Pada Form Pesan Adalah 500 Karakter');
		} else {
			$insert_tiket = $conn->query("INSERT INTO tiket VALUES ('', '$sess_username', '$post_subjek', '$post_pesan', '$date', '$time', '$date $time', 'Pending','1','0')");
			if ($insert_tiket == TRUE) {
				$_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Sukses', 'pesan' => 'Tiket Berhasil Dibuat, Harap Menunggu Respon Dari team-support.');
			} else {
				$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Error System(Insert To Database).');
			}
		}
	}
require("../lib/header.php");
?>
          <div class="row">
               <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <h4><i class="icon fa fa-check"></i> Hai <?php echo $data_user['nama']; ?> !</h4>
                         <p><b>TATA CARA PENGISIAN JUDUL</b><br/>
                         1. <b>ORDER</b> : Masalah mengenai dengan pemesanan.<br/>
                         2. <b>DEPOSIT</b> : Masalah mengenai dengan deposito.<br/>
                         3. <b>LAYANAN</b> : Masalah mengenai dengan Layanan.<br/>
                         4. <b>OTHER</b> : Masalah mengenai dengan hal lainnya.<br/>                         
                         5. Sertakan ID pemesanan/deposit saat melalukan komplain</p>
                     </div>
                     
           <div class="row">
                <div class="col-md-12">
                     <div class="card-box">
                          <h4 class="header-title mb-3">KIRIM TIKET BANTUAN</h4><hr>
                              <div class="table-responsive">
                                   <table class="table table-striped table-bordered table-hover m-0">
			               <div class="table-responsive">
				   <table class="table table-striped table-bordered table-hover m-0">
			      <thead>
			   <form class="form-default" role="form" method="POST">
			<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
	             <div class="form-group">
                <label class="col-md-2 control-label">Masukan Judul</label>
                <div class="col-md-12">
                <input type="text" class="form-control" placeholder="Masukkan Subjek"  name="subjek">
		</div>
		</div>
		<div class="form-group">
                    	<label class="col-md-8 control-label">Masukan Pesan Anda</label>
                    	<div class="col-md-12">                   	
			<textarea class="form-control" name="pesan" rows="8" style="height:200px;" placeholder="Keluhan Pesanan, Deposit, Tentang Layanan, atau yang Lainnya"></textarea></textarea>
		</table>
		</div>
		<div class="col-md-12">
		<button type="submit" class="btn btn-block btn-primary waves-effect w-md waves-light" name="kirim"><i class="mdi mdi-send"></i> Kirim</button>
		</div>
		</div>
		</table>
		</div>
	        
	    <div class="col-md-12">
                 <div class="card-box">
                      <h4 class="header-title mb-3">RIWAYAT TIKET <?php if (mysqli_num_rows($CallDBTiket) !== 0) { ?><span class="badge badge-warning badge-pill notif-tiket"><?php echo mysqli_num_rows($CallDBTiket); ?></span><?php } ?></h4><hr>
                          <div class="table-responsive">
                               <table class="table table-striped table-bordered table-hover m-0">
                               <thead>
                               <div class="alert alert-info"><i class="fa fa-info-circle"></i> Informasi !!
			       <br>
			       <li>Silahkan klik ID Tiket untuk melihat detail tiket anda.</li>
		          </div>
                               <tr>
                                    <th>ID Tiket</th>
                                    <th>Subjek</th>
                                    <th>Pesan Anda</th>                                    
                                    <th style="min-width: 200px;">Update Terakhir</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                               </tr>
			 </thead>
			 <tbody>
<?php 
// start paging config
if (isset($_GET['search'])) {
    $cari = $conn->real_escape_string(filter($_GET['search']));
    $cari_status = $conn->real_escape_string(filter($_GET['status']));

    $cek_tiket = "SELECT * FROM tiket WHERE subjek LIKE '%$cari%' AND status LIKE '%$cari_status%' AND user = '$sess_username' ORDER BY id DESC"; // edit
} else {
    $cek_tiket = "SELECT * FROM tiket WHERE user = '$sess_username' ORDER BY id DESC"; // edit
}
if (isset($_GET['search'])) {
$cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
$records_per_page = $cari_urut; // edit
} else {
    $records_per_page = 10; // edit
}

$starting_position = 0;
if(isset($_GET["halaman"])) {
    $starting_position = ($conn->real_escape_string(filter($_GET["halaman"]))-1) * $records_per_page;
}
$new_query = $cek_tiket." LIMIT $starting_position, $records_per_page";
$new_query = $conn->query($new_query);
// end paging config
while ($data_tiket = $new_query->fetch_assoc()) {
    if ($data_tiket['status'] == "Pending") {
        $label = "warning";
        $btn = "";
    } else if ($data_tiket['status'] == "Closed") {
        $label = "danger";
        $btn = "disabled";
    } else if ($data_tiket['status'] == "Waiting") {
        $label = "info";   
        $btn = ""; 
    } else if ($data_tiket['status'] == "Responded") {
        $label = "success";
        $btn = "";       
    }

?>
 
		<tr>
		     
		     <th scope="row"><b><a href="<?php echo $config['web']['url']; ?>tiket/view?id=<?php echo $data_tiket['id']; ?>"</a>#<?php echo $data_tiket['id']; ?></b></th>     
		     <td><b><?php echo $data_tiket['subjek']; ?></b></td>		     
		     <td><?php echo $data_tiket['pesan']; ?></td>                   
                     <td><?php echo time_elapsed_string($data_tiket['update_terakhir']); ?></td>     
                     <td><span class="btn btn-xs btn-<?php echo $label; ?>"><?php echo $data_tiket['status']; ?></span></td>
                     <td align="right">
                     <a href="<?php echo $config['web']['url']; ?>tiket/open?id=<?php echo $data_tiket['id']; ?>" class="btn btn-sm btn-success <?php echo $btn; ?>" ><i class="fa fa-reply"></i> Balas</a></td>
                </tr>   
<?php 
} 
?>
                                    </tbody>
                                </table>
		            </div>				
			</div>
		</div>
	</div>
</div>
<?php 
include '../lib/footer.php';
?>      



		