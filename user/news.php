<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
require '../lib/session_login.php';
require '../lib/header.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string(trim(filter($_GET['id'])));
    if (!$id) {
        header("Location: ".$config['web']['url']);
    } else {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $back = $_SERVER['HTTP_REFERER'];
        } else { $back = $config['web']['url']; }
        
        $check_news = $conn->query("SELECT * FROM berita WHERE id = '$id'");
        $data_news = $check_news->fetch_assoc();
        if (mysqli_num_rows($check_news) == 0) header("Location: ".$config['web']['url']);
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                       <div class="float-right">
                       <small class="text-dark m-0"><?php echo tanggal_indo($data_news['date']); ?> , <?php echo $data_news['time']; ?></small>
                        </div>
                        
                        <center>
                     <br /><br />
                            <h4><?= $data_news['subjek']; ?></h4><br />
                            <span><?= nl2br($data_news['konten']); ?></span>
                            <div class="row mt-2">
                                <a href="<?= $back; ?>" class="btn btn-primary btn-block"><i class="mdi mdi-arrow-left-bold-box-outline"></i> Kembali</a>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table footable toggle-square">
                                            <tbody>
                                                <?php $check_news = $conn->query("SELECT * FROM berita ORDER BY id DESC"); ?>
                                                <?php while ($data_news = $check_news->fetch_assoc()) { ?>
                                                <?php
                                                    if ($data_news['tipe'] == "INFORMASI") $btn = "info";
                                                    if ($data_news['tipe'] == "PERINGATAN") $btn = "warning";
                                                    if ($data_news['tipe'] == "PENTING") $btn = "danger";
                                                    if ($data_news['tipe'] == "DEPOSIT") $btn = "primary";
                                                    if ($data_news['tipe'] == "UPDATE") $btn = "success";
                                                ?>
                                                <tr>
                                                    <td width="60"><a href="<?= $config['web']['url']; ?>user/news.php?id=<?= $data_news['id']; ?>" class="btn btn-lg btn-<?= $btn; ?>"><i class="fas fa-info-circle"></i></a></td>
                                                    <td style="vertical-align: middle !important;"><h6><a href="<?= $config['web']['url']; ?>user/news.php?id=<?= $data_news['id']; ?>" class="text-dark"><?= $data_news['subjek']; ?></a></h6></td>
                                                    <td><a href="<?= $config['web']['url']; ?>user/news.php?id=<?= $data_news['id']; ?>" class="text-primary vertical-align: middle !important;"><small> <?php echo tanggal_indo($data_news['date']); ?> , <?php echo $data_news['time']; ?></small></a></td><hr>
                                                    
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                    <div class="row">
                        <a href="<?= $config['web']['url']; ?>" class="btn btn-primary btn-block"><i class="mdi mdi-arrow-left-bold-box-outline"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}

require '../lib/footer.php';