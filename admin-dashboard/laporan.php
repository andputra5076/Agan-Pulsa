<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php';
require '../lib/header_admin.php';
?> 
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="m-t-0 text-uppercase text-center header-title">Laporan Seluruh Pemesanan Sosial Media</h4>
                <hr />

                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap m-0">
                        <thead>
                            <tr>
                                <th>Total Pesanan</th>
                                <th>Penghasilan Kotor</th>
                                <th>Penghasilan Bersih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="badge badge-pill badge-dark"><?php echo $CountProfitSosmed; ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-primary">
                                        Rp
                                        <?php echo number_format($AllSosmed['total'],0,',','.') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-success">
                                        Rp
                                        <?php echo number_format($ProfitSosmed['total'],0,',','.'); ?>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
      
<?php 
require '../lib/footer_admin.php';
?>