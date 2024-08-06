<?php
session_start();
require '../../../config.php';
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!isset($_SESSION['user']) || $data_user['level'] == "Member" || $data_user['level'] == "Reseller") {
	exit("Anda Tidak Memiliki Akses!");
    }
    if (!isset($_GET['id'])) {
        exit("Anda Tidak Memiliki Akses!-");
    } 
$get_id = $conn->real_escape_string(filter($_GET['id']));
$cek_pengguna = $conn->query("SELECT * FROM users WHERE id = '$get_id'");
while($data_pengguna = $cek_pengguna->fetch_assoc()) {
    if ($data_pengguna['status'] == "Aktif") {
        $icon = "close";
        $label = "success";
    } else if ($data_pengguna['status'] == "Tidak Aktif") {
        $icon = "check";
        $label = "danger";
    }	
    
?>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST">     
                                   <div class="table-responsive">
<table class="table table-striped table-bordered table-box">
<tr>
<th class="table-detail" width="50%">ID Pengguna</th>
<td class="table-detail"><?php echo $data_pengguna['id']; ?></td>
</tr>
<tr>
<th class="table-detail">NAMA</th>
<td class="table-detail"><div class="text-primary"><?php echo $data_pengguna['nama']; ?></div></td>
</tr>
<tr>
<th class="table-detail">USERNAME</th>
<td class="table-detail"><?php echo $data_pengguna['username']; ?></td>
</tr>
<tr>
<th class="table-detail">EMAIL</th>
<td class="table-detail"><?php echo $data_pengguna['email']; ?></td>
</tr>
<tr>
<th class="table-detail">LEVEL</th>
<td class="table-detail"><?php echo $data_pengguna['level']; ?></td>
</tr>
<tr>
<th class="table-detail">SALDO</th>
<td class="table-detail">Rp <?php echo number_format($data_pengguna['saldo'],0,',','.'); ?></td>
</tr>
<tr>
<th class="table-detail">PEMAKAIAN SALDO</th>
<td class="table-detail">Rp <?php echo number_format($data_pengguna['pemakaian_saldo'],0,',','.'); ?></td>
</tr>
<tr>
<th class="table-detail">STATUS</th>
<td class="table-detail"><span><div class="badge badge-<?php echo $label; ?>"><?php echo $data_pengguna['status']; ?></div></span></td>
</tr>
<tr>
<th class="table-detail">Nomer Hp</th>
<td class="table-detail"><span class="badge badge-primary"><?php echo $data_pengguna['nomer']; ?></span></td>
</tr>
<tr>
<th class="table-detail">UPLINK</th>
<td class="table-detail"><?php echo $data_pengguna['uplink']; ?></td>
</tr>
</table>
</div>
                                                                       
                                    </form>
                                </div>
                            </div>       
<?php 
    }
} else {
    exit("Anda Tidak Memiliki Akses!?");
}