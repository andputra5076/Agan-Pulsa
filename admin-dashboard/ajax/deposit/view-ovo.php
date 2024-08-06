<?php
session_start();
require '../../../config.php';
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'Developers') {
	exit("Anda Tidak Memiliki Akses!");
    }
    if (!isset($_GET['id'])) {
        exit("Anda Tidak Memiliki Akses!-");
    } 
$get_id = $conn->real_escape_string(filter($_GET['id']));
$cek_depo = $conn->query("SELECT * FROM mutasi_ovo WHERE id = '$get_id'");
while($data_depo = $cek_depo->fetch_assoc()) {
    if ($data_depo['status'] == "Read") {
        $badge = "danger";
        $icon = "close";
        $txt = "Sudah Di Gunakan";
    } else if ($data_depo['status'] == "Unread") {
        $badge = "success";
        $icon = "check";
        $txt = "Active";
    }
?>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST">     
                                   <div class="table-responsive">
<table class="table table-striped table-bordered table-box">
<tr>
<th class="table-detail" width="50%">ID MUTASI OVO</th>
<td class="table-detail"><?php echo $data_depo['id']; ?></td>
</tr>
<th class="table-detail">DESKRIPSI</th>
<td class="table-detail"><?php echo $data_depo['an']; ?> <hr> <?php echo $data_depo['deskripsi']; ?></td>
</tr>
<tr>
<th class="table-detail">NO REFERENSI</th>
<td class="table-detail" style="min-width: 180px;">
                <div class="input-group">
                <input type="text" class="form-control form-control-sm" value="<?php echo $data_depo['keterangan']; ?>" id="keterangan-<?php echo $data_depo['id']; ?>" readonly="">
                <button data-toggle="tooltip" title="Copy Referensi" class="btn btn-xs btn-primary" type="button" onclick="copy_to_clipboard('keterangan-<?php echo $data_depo['id']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                </div>
</td>
</tr>
<th class="table-detail">NOMINAL</th>
<td class="table-detail">
                <div class="badge badge-success">
                 Rp. <?php echo number_format($data_depo['saldo'], 0, ',', '.'); ?>
                </div>
</td>
</tr>
<tr>
<th class="table-detail">DATE & TIME</th>
<td class="table-detail"><?php echo tanggal_indo($data_depo['date']); ?></td>
</tr>
<tr>
<th class="table-detail">STATUS</th>
<td class="table-detail"><span class="badge badge-<?php echo $badge; ?>"><i class="mdi mdi-<?php echo $icon; ?>"></i> <?php echo $txt; ?> </span></td>
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
