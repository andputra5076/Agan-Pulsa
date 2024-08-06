<?php
session_start();
require '../../config.php';
require '../../libs/session_user.php';
if (isset($_POST['id'])) {
    $post_id = $conn->real_escape_string($_POST['id']);
    $cek_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE id = '$post_id'");
    while($data_pesanan = $cek_pesanan->fetch_assoc()) {
        if ($data_pesanan['place_from'] == "Website") {
            $icon = "globe";
            $label = "info";
        } else if ($data_pesanan['place_from'] == "API") {
            $icon = "fire";
            $label = "danger";
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
        } else if ($data_pesanan['status'] == "In progress") {
            $badge = "info";
        } else if ($data_pesanan['status'] == "In Progress") {
            $badge = "info";    
        } else if ($data_pesanan['status'] == "Success") {
            $badge = "success";
        } else if ($data_pesanan['status'] == "Completed") {
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
                    <td class="table-detail"><span class="btn btn-block btn-<?php echo $badge; ?> disabled"><?php echo $data_pesanan['status']; ?></span></td>
                </tr>
                <tr>
                    <th class="table-detail">Tanggal & Waktu</th>
                    <td class="table-detail"><?php echo tanggal_indo($data_pesanan['date']); ?>, <?php echo $data_pesanan['time']; ?></td>
                </tr>
                <tr>
                    <th class="table-detail">Update</th>
                    <td class="table-detail"><?php echo $data_pesanan['update_at']; ?></td>
                </tr>
                <tr>
                    <th class="table-detail">Refund</th>
                    <td class="table-detail"><span><?php echo $data_pesanan['refund']; ?></span></td>
                </tr>
                <tr>
                    <th class="table-detail">Via API</th>
                    <td class="table-detail"><span><i class="fa fa-<?php echo $icon; ?> text-<?php echo $label; ?>"></i> <?php echo $data_pesanan['place_from']; ?></span></td>
                </tr>
            </table>
        </div>
        <?php
    }
}
?>