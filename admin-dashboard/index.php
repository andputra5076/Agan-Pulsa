<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php';
require '../lib/header_admin.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="bg-icon float-left"><img src="/assets/svg/user.svg" style="height: 6rem;width: 6rem;"></img></div>
                <div class="text-right">
                    <p>Total Pengguna</p>
                    <h3 class="m-b-10">
                        <span><?php echo $total_pengguna; ?></span>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="bg-icon float-left"><img src="/assets/svg/wallet.png" style="height: 6rem;width: 6rem;"></img></div>
                <div class="text-right">
                    <p>Total Deposit Saldo</p>
                    <h3 class="m-b-10">
                        <span>
                            Rp
                            <?php echo number_format($data_deposit['total'],0,',','.'); ?>
                            <br />
                            <h5>
                                (
                                <?php echo $count_deposit; ?>
                                )
                            </h5>
                        </span>
                        <hr />
                    </h3>
                </div>
                <div class="text-left">
                    <p>
                        <b class="badge badge-success">
                            Success : (
                            <?php echo $total_depo_succes; ?>
                            )
                        </b>
                        <b class="badge badge-danger">
                            Cancel : (
                            <?php echo $total_depo_error; ?>
                            )
                        </b>
                        <b class="badge badge-warning">
                            Pending : (
                            <?php echo $total_depo_pending; ?>
                            )
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card widget-box-three">
            <div class="card-body">
                <div class="bg-icon float-left"><img src="/assets/index/social-media.png" style="height: 6rem;width: 6rem;"></img></div>
                <div class="text-right">
                    <p>
                        Total Pemesanan 
                    </p>
                    <h3 class="m-b-10">
                        <span>
                            Rp
                            <?php echo number_format($data_pesanan_sosmed['total'],0,',','.'); ?>
                            <br />
                            <h5>
                                (
                                <?php echo $count_pesanan_sosmed; ?>
                                )
                            </h5>
                        </span>
                        <hr />
                    </h3>
                </div>
                <div class="text-left">
                    <p>
                        <b class="badge badge-success">
                            Success : (
                            <?php echo $total_sosmed_succes; ?>
                            )
                        </b>
                        <b class="badge badge-success">
                            Completed : (
                            <?php echo $total_sosmed_completed; ?>
                            )
                        </b>
                        <b class="badge badge-danger">
                            Partial : (
                            <?php echo $total_sosmed_partial; ?>
                            )
                        </b>
                        <b class="badge badge-danger">
                            Error : (
                            <?php echo $total_sosmed_error; ?>
                            )
                        </b>
                        <b class="badge badge-danger">
                            Canceled : (
                            <?php echo $total_sosmed_canceled; ?>
                            )
                        </b>
                        <b class="badge badge-warning">
                            Pending : (
                            <?php echo $total_sosmed_pending; ?>
                            )
                        </b>
                        <b class="badge badge-info">
                            Processing : (
                            <?php echo $total_sosmed_processing; ?>
                            )
                        </b>
                        <b class="badge badge-info">
                            In Progress : (
                            <?php echo $total_sosmed_progress; ?>
                            )
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
                                      
<?php
require '../lib/footer_admin.php';
?>