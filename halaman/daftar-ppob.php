<?php
session_start();
require '../config.php';
require '../lib/header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <center>
                    <h4 class="text-primary">Layanan PPOB</h4>
                    Terakhir Diperbarui
                    <?php
echo date('j F Y');
?>
                </center>
                <br />
                <?php $cpr = $conn->query("SELECT * FROM kategori_pulsa"); ?>
                <?php while ($dpr = $cpr->fetch_assoc()) { ?>
                <center>
                    <h3><?= $dpr['nama']; ?></h3>
                </center>
                <br />
                <?php $cprl = $conn->query("SELECT * FROM layanan_pulsa WHERE operator = '".$dpr['kode']."' ORDER BY harga ASC"); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hovered mb-1">
                        <thead>
                            <tr>
                                <th width="10">ID</th>
                                <th width="200">Layanan</th>
                                <th width="300">Catatan</th>
                                <th width="200">Harga</th>
                                <th width="100">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($dprl = $cprl->fetch_assoc()) { ?>
                            <?php
                                        if ($dprl['status'] == "Normal") {
                                            $label = "success";
                                        } else {
                                            $label = "danger";
                                        }
                                        ?>
                            <tr>
                                <td><?= $dprl['service_id']; ?></td>
                                <td><?= $dprl['layanan']; ?></td>
                                <td><?= $dprl['catatan']; ?></td>
                                <td>
                                    Rp
                                    <?= number_format($dprl['harga'],0,',','.'); ?>
                                </td>
                                <td>
                                    <label class="btn btn-xs btn-<?= $label; ?>"><?= $dprl['status']; ?></label>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        
    });
</script>
<?php
require '../lib/footer-home.php';