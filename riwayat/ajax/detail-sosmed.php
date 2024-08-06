<?php
session_start();
require '../../config.php';
require '../../lib/session_user.php';
$sess_username = $_SESSION['user']['username'];
if (isset($_POST['id'])) {
	$post_id = $conn->real_escape_string($_POST['id']);
	$cek_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE id = '$post_id' AND user ='$sess_username'");
    while($data_pesanan = $cek_pesanan->fetch_assoc()) {
    if ($data_pesanan['place_from'] == "Website") {
        $icon = "close";
        $label = "danger";
    } else if ($data_pesanan['place_from'] == "API") {
        $icon = "check";
        $label = "success";
    }	
    if ($data_pesanan['refund'] == "0") {
        $icon2 = "close";
        $label2 = "danger"; 
    } else if ($data_pesanan['refund'] == "1") {
        $icon2 = "check";
        $label2 = "success";
    }
    if ($data_pesanan['status'] == "Pending") {
        $badge = "warning";
    } else if ($data_pesanan['status'] == "Partial") {
        $badge = "danger";
    } else if ($data_pesanan['status'] == "Error") {
        $badge = "danger";
    } else if ($data_pesanan['status'] == "Canceled") {
        $badge = "danger";
    } else if ($data_pesanan['status'] == "Processing") {
        $badge = "info";
    } else if ($data_pesanan['status'] == "In Progress") {
        $badge = "info";
    } else if ($data_pesanan['status'] == "Completed") {
        $badge = "success";
    } else if ($data_pesanan['status'] == "Success") {
        $badge = "success";    
    }
?>
<div class="table-responsive">
<table class="table table-striped table-bordered table-box">
<tr>
<th class="table-detail" width="50%">Order ID</th>
<td class="table-detail"><?php echo $data_pesanan['oid']; ?></td>
</tr>
<tr>
<th class="table-detail">Layanan</th>
<td class="table-detail"><?php echo $data_pesanan['layanan']; ?></td>
</tr>
<tr>
<th class="table-detail">Target</th>
<td class="table-detail"><?php echo $data_pesanan['target']; ?></td>
</tr>
<tr>
<th class="table-detail">Jumlah</th>
<td class="table-detail"><?php echo $data_pesanan['jumlah']; ?></td>
</tr>
<tr>
<th class="table-detail">Start</th>
<td class="table-detail"><?php echo $data_pesanan['start_count']; ?></td>
</tr>
<tr>
<th class="table-detail">Remains</th>
<td class="table-detail"><?php echo $data_pesanan['remains']; ?></td>
</tr>
<tr>
<th class="table-detail">Harga</th>
<td class="table-detail">Rp <?php echo number_format($data_pesanan['harga'],0,',','.'); ?></td>
</tr>
<tr>
<th class="table-detail">Status</th>
<td class="table-detail"><badge class="badge badge-<?php echo $badge; ?>"><?php echo $data_pesanan['status']; ?></td></tr>
<tr>
<th class="table-detail">Tanggal & Waktu</th>
<td class="table-detail"><?php echo tanggal_indo($data_pesanan['date']); ?>, <?php echo $data_pesanan['time']; ?></td>
</tr>
<tr>
<th class="table-detail">Refund / Pengembalian Dana</th>
<td class="table-detail"><span class="badge badge-<?php echo $label2; ?>"><i class="mdi mdi-<?php echo $icon2; ?>"></i></span></td>
</tr>
<tr>
<th class="table-detail">Via API</th>
<td class="table-detail"><span class="badge badge-<?php echo $label; ?>"><i class="mdi mdi-<?php echo $icon; ?>"></i></span></td>
</tr>
</table>
</div>
<?php
}
}
?>