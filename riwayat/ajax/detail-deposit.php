<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
$sess_username = $_SESSION['user']['username'];
if (isset($_POST['id'])) {
	$post_id = $conn->real_escape_string($_POST['id']);
	$cek_depo = $conn->query("SELECT * FROM deposit WHERE id = '$post_id' AND username = '$sess_username'");
    while ($data_depo = mysqli_fetch_assoc($cek_depo)) {
    if ($data_depo['place_from'] == "Website") {
        $icon = "close";
        $label = "danger";
    } else if ($data_depo['place_from'] == "API") {
        $icon = "check";
        $label = "success";
    }	
    if ($data_depo['refund'] == "0") {
        $icon2 = "close";
        $label2 = "danger"; 
    } else if ($data_depo['refund'] == "1") {
        $icon2 = "check";
        $label2 = "success";        
    }
    if ($data_depo['status'] == "Pending") {
      	$label = "warning";
        $btn = "warning";
    } else if ($data_depo['status'] == "Partial") {
      	$label = "danger";
        $btn = "danger";
    } else if ($data_depo['status'] == "Error") {
      	$label = "danger";
        $btn = "danger";    
    } else if ($data_depo['status'] == "Processing") {
      	$label = "info";
        $btn = "info";    
    } else if ($data_depo['status'] == "Success") {
        $label = "success";
        $btn = "success";  
    }	
?>
<div class="table-wrapper table-responsive">
<table class="table">
<tr>
<th class="table-detail" width="50%">ID</th>
<td class="table-detail"><?php echo $data_depo['kode_deposit']; ?></td>
</tr>
<tr>
<th class="table-detail">Metode</th>
<td class="table-detail"><?php echo $data_depo['payment']; ?></td>
</tr>
  <tr>
<th class="table-detail">Rek. Pembayaran</th>
<td class="table-detail"><?php echo $data_depo['tujuan']; ?></td>
</tr>
<tr>
<th class="table-detail">Pengirim</th>
<td class="table-detail"><?php echo $data_depo['nomor_pengirim']; ?></td>
</tr>
<tr>
<th class="table-detail">Jumlah</th>
<td class="table-detail">Rp <?php echo number_format($data_depo['jumlah_transfer'],0,',','.'); ?></td>
</tr>
<tr>
<th class="table-detail">Saldo Yang Didapat</th>
<td class="table-detail">Rp <?php echo number_format($data_depo['get_saldo'],0,',','.'); ?></td>
</tr>
<tr>
<th class="table-detail">Tanggal</th>
<td class="table-detail"><?php echo tanggal_indo($data_depo['date']).','.tanggal_indo($data_depo['time']); ?></td>
</tr>
<tr>
<th class="table-detail">Status</th>
<td class="table-detail"><span class="btn btn-xs btn-<?php echo $label; ?>"><?php echo $data_depo['status']; ?></span></td>
</tr>
</table>
</div>
<?php
} 
}