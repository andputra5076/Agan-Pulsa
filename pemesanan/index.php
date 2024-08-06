<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
require '../lib/session_login.php';
require '../lib/header.php';
?>
<div class="row">
    <div class="col-12" style="margin-top: 15px;">
        <div class="card card-body text-center">
            <center>
                <p>Welcome <span class="text-success"><?php echo $sess_username; ?></span>
                </p>
                <h4 class="header-title text-danger"><i class="fa fa-shopping-bag"></i><b> ORDER BARU</h4></b>
            </center>
            <br>
            <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                <li class="nav-item"><a href="/pemesanan/sosial-media.php" class="btn-loading"><img src="/assets/index/social-media.png" alt="Sosial Media" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">SOSMED</span></a></li>
                <li class="nav-item"><a href="/pemesanan/pulsa.php" class="btn-loading"><img src="/assets/index/PULSA.png" alt="Pulsa Reguler" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Pulsa Reguler</span></a></li>
                <li class="nav-item"><a href="/pemesanan/telepon-sms.php" class="btn-loading"><img src="/assets/index/PKSMS.png" alt="Telepon & SMS" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Telepon & SMS</span></a></li>
                <li class="nav-item"><a href="/pemesanan/paket.php" class="btn-loading"><img src="/assets/index/5g.png" alt="Paket Data" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Paket Data</span></a></li>
            </ul><br />

            <ul class="nav line-tabs nav-justified line-tabs-2x line-tabs-solid mb-2">
                <li class="nav-item"><a href="/pemesanan/game.php" class="btn-loading"><img src="/assets/index/game-console.png" alt="Voucher Game" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Voucher Game</span></a></li>
                <li class="nav-item"><a href="/pemesanan/pln.php" class="btn-loading"><img src="/assets/index/PLN.png" alt="Token PLN Prabayar" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Token PLN Prabayar</span></a></li>
                <li class="nav-item"><a href="/pemesanan/e-money.php" class="btn-loading"><img src="/assets/index/E-MONEY.png" alt="Saldo E-money" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Saldo E-money</span></a></li>
                <li class="nav-item"><a href="/tiket/" class="btn-loading"><img src="/assets/index/cs-bantuan.png" alt="Tiket" style="height: 3rem;width: 3rem; mb-2"></img><br><span class="text-muted">Tiket Bantuan</span></a></li>
            </ul>
        </div>
    </div>
</div>
<?php
require '../lib/footer.php';
?>