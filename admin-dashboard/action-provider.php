<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php';
require '../lib/header_admin.php';

// Panggil API ID, API KEY, SECRET KEY dengan CODE Provider
$cekdigi = $conn->query("SELECT * FROM provider WHERE code = 'DIGIFLAZZ'");
$datadigi = mysqli_fetch_assoc($cekdigi);
?>
<div class="row">
    <div class="col-12">
        <div class="card card-body">
            <h4 class='text-info'>PUSAT ZAYNFLAZZ</h4>
            <hr>
            <div class="row">
                <!--ZAYNFLAZZ-->
                <?php
                $cekzaynflazz = $conn->query("SELECT * FROM provider WHERE code = 'ZAYNFLAZZ'");
                $dataynflazz = mysqli_fetch_assoc($cekzaynflazz);
                $postdata = "api_key=" . $dataynflazz['api_key'] . "&action=profile";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://zaynflazz.com/api/profile");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $chresult = curl_exec($ch);
                //echo $chresult;
                curl_close($ch);
                $json_result = json_decode($chresult, true);
                $indeks = 0;
                if ($indeks < count($json_result['data'])) {
                    $usernamenya = $json_result['data'][$indeks]['username'];
                    $saldo_sosmed = $json_result['data'][$indeks]['saldo_sosmed'];

                    if (TRUE) {
                    } else {
                        echo "<b>Gagal</b>";
                    }
                }

                ?>
                <div class="col-6">
                    <strong>
                        <div class="mb-0 text-info" style="margin-top: -5px !important; margin-bottom: -10px !important;"><i class="ti-wallet"></i> SALDO SOSMED </div>
                    </strong>
                </div>
                <div class="col-6 text-right" style="margin-top: -10px !important; margin-bottom: -10px !important;"><i class=""></i> Rp <?php echo number_format($saldo_sosmed, 0, ',', '.'); ?></a></br>
                </div>
                <br></br>
                <div class="col-6">
                    <strong>
                        <div class="mb-0 text-info" style="margin-top: -5px !important; margin-bottom: -10px !important;"><i class="fa fa-user"></i> USERNAME </div>
                    </strong>
                </div>
                <div class="col-6 text-right" style="margin-top: -10px !important; margin-bottom: -10px !important;">
                    <i class=""></i>
                    <?php echo $usernamenya; ?></a></br>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-body">
            <div class="row">
                <!--DIGIFALZZ-->
                <?php
                $p_apiid = $datadigi['api_id'];
                $p_apikey = $datadigi['api_key'];

                $sign = md5($p_apiid . $p_apikey . "depo");
                $data = array(
                    'cmd' => 'deposit',
                    'username' => $p_apiid,
                    'sign' => $sign
                );
                $header = array(
                    'Content-Type: application/json',
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://api.digiflazz.com/v1/cek-saldo");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $chresult = curl_exec($ch);
                //echo $chresult;
                curl_close($ch);
                $json_result = json_decode($chresult, true);
                ?>
                <div class="col-6">
                    <strong>
                        <div class="mb-0 text-info" style="margin-top: -5px !important; margin-bottom: -10px !important;"><i class="ti-wallet"></i> SALDO DIGIFLAZZ </div>
                    </strong>
                </div>
                <div class="col-6 text-right" style="margin-top: -10px !important; margin-bottom: -10px !important;"><i class=""></i>Rp. <?php echo number_format($json_result['data']['deposit'], 0, ',', '.'); ?></a></br>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body table-responsive">
                <ul class="nav nav-tabs tabs-bordered">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#update">SOSMED</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ppob">PPOB</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#hapus">HAPUS</a></li>
                </ul>
                <div class="tab-content">
                    <div id="update" class="tab-pane active">
                        <h4 class="m-t-0 header-title text-center">UPDATE LAYANAN & CATEGORY</h4>
                        <hr />
                        <br />
                        <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                            <li class="nav-item">
                                <a href="/action/add/get-sosmed-1.php" class="btn-loading">
                                    <button class="btn btn-success">UPDATE</button>
                                </a>
                            </li>
                        </ul>
                        <br />
                        <br />
                    </div>

                    <div id="ppob" class="tab-pane">
                        <h4 class="m-t-0 header-title text-center">UPDATE LAYANAN & CATEGORY</h4>
                        <hr />
                        <br />
                        <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                            <li class="nav-item">
                                <a href="/action/add/upd-all-category-pulsa-ppobpuring.php" class="btn-loading">
                                    <button class="btn btn-success">CATEGORY</button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/action/add/upd-all-layanan-pulsa-ppobpuring.php" class="btn-loading">
                                    <button class="btn btn-success">LAYANAN</button>
                                </a>
                            </li>
                        </ul>
                        <br />
                        <hr />
                    </div>

                    <div id="hapus" class="tab-pane">
                        <h4 class="m-t-0 header-title text-center">HAPUS LAYANAN & CATEGORY SOSMED</h4>
                        <hr />
                        <br />
                        <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                            <li class="nav-item">
                                <a href="/action/delete/delete-layanan-1.php" class="btn-loading">
                                    <button class="btn btn-danger">DELLETE</button>
                                </a>
                            </li>
                        </ul>
                        <br />
                        <hr />
                        <h4 class="m-t-0 header-title text-center">HAPUS LAYANAN & CATEGORY PPOB</h4>
                        <hr />
                        <br />
                        <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                            <li class="nav-item">
                                <a href="/action/delete/delete-ppob.php" class="btn-loading">
                                    <button class="btn btn-danger">DELLETE ALL PPOB</button>
                                </a>
                            </li>
                        </ul>
                        <br />
                        <hr />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php
require '../lib/footer_admin.php';
?>