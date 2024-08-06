<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php';
require '../gateway/gopay/gopay.php';
$dataGopay = $conn->query("SELECT * FROM akun_emoney WHERE type = 'GOPAY'")
    ->fetch_assoc();
$gopayClass = new GoPay();
if (isset($_POST['send_otp'])) {
    $nomorGojek = $conn->real_escape_string(trim(filter($_POST['nomorGojek'])));
    $loginGopay = $gopayClass->sendRequest($nomorGojek);
    $loginToken = $loginGopay['data']['login_token'];
    if ($loginGopay['success'] == true) {
        $conn->query("UPDATE akun_emoney SET nomor = '$nomorGojek', device = '$loginToken' WHERE type = 'GOPAY'");
        $_SESSION['result'] = array(
            'alert' => 'success',
            'judul' => 'Berhasil',
            'pesan' => '' . $loginGopay['data']['message'] . '.'
        );
    }
    else {
        $_SESSION['result'] = array(
            'alert' => 'danger',
            'judul' => 'Gagal - ' . $loginGopay['errors']['0']['message_title'] . '',
            'pesan' => '' . $loginGopay['errors']['0']['message'] . ''
        );
    }
}
if (isset($_POST['login'])) {
    $otp = $conn->real_escape_string(trim(filter($_POST['otp'])));
    $loginGopay = $gopayClass->konfirmasiCode($dataGopay['device'], $otp, $dataGopay['nomor']);
    $aksesToken = $loginGopay['data']['access_token'];
    if ($loginGopay['success'] == true) {
        $conn->query("UPDATE akun_emoney SET token = '$aksesToken', otp = '$otp' WHERE type = 'GOPAY'");
        $_SESSION['result'] = array(
            'alert' => 'success',
            'judul' => 'Berhasil',
            'pesan' => '' . $loginGopay['errors']['0']['message'] . '.'
        );
    }
    else {
        $_SESSION['result'] = array(
            'alert' => 'danger',
            'judul' => 'Gagal',
            'pesan' => '' . $loginGopay['errors']['0']['message'] . '.'
        );
    }
}
if (isset($_POST['reset'])) {
    $reset = $conn->query("UPDATE akun_emoney SET nomor = '', otp = '0', token = '', device = '' WHERE type = 'GOPAY'");
    if ($reset == true) {
        $_SESSION['result'] = array(
            'alert' => 'success',
            'judul' => 'Berhasil',
            'pesan' => 'Data Berhasil Di Reset.'
        );
    }
    else {
        $_SESSION['result'] = array(
            'alert' => 'danger',
            'judul' => 'Gagal',
            'pesan' => 'Sistem Error !!'
        );
    }
}
if (isset($_POST['cek'])) {
    $Cek = $gopayClass->seeMutation($dataGopay['nomor']);
    if ($Cek['result'] == true) {
        $_SESSION['result'] = array(
            'alert' => 'success',
            'judul' => 'Berhasil',
            'pesan' => 'Tidak Ada Data Error.'
        );
    }
    else {
        $_SESSION['result'] = array(
            'alert' => 'danger',
            'judul' => 'Gagal',
            'pesan' => '' . $Cek['data'] . ''
        );
    }
}
if (isset($_POST['truncate'])) {
    $truncate = $conn->query("TRUNCATE TABLE mutasi_gopay");
    if ($truncate == true) {
        $_SESSION['result'] = array(
            'alert' => 'success',
            'judul' => 'Berhasil',
            'pesan' => 'Data Mutasi Berhasil Di Bersihkan.'
        );
    }
    else {
        $_SESSION['result'] = array(
            'alert' => 'danger',
            'judul' => 'Gagal',
            'pesan' => 'Sistem Error !!'
        );
    }
}
if (isset($_POST['update'])) {
    $get_id = $conn->real_escape_string($_GET['id']);
    $status = $conn->real_escape_string($_POST['status']);
          
          $deponya = $conn->query("SELECT * FROM mutasi_gopay WHERE id = '$get_id'");
          $datanya = $deponya->fetch_assoc();
          
          $nominal = $datanya['saldo'];
        
        if ($deponya->num_rows == 0) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data mutasi gopay Tidak Ditemukan');
        } else if ($datanya['status'] == "Read") { 
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Ups, Status mutasi gopay Dengan Kode ID : '.$get_id.' Sudah Berstatus Read');
            } else {
                if ($conn->query("UPDATE mutasi_gopay SET status = '$status' WHERE id = '$get_id'") == true){
                    if ($status == "Read") {
                    
                    $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Data mutasi gopay Berhasil Di Update 
                    <br /> ID : '.$get_id.'
                    <br /> Status : '.$status.'
                    <br /> Nominal : '.$nominal.'
                    ');
                } else {
                    $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Data Deposit Berhasil Di Update 
                    <br /> Deposit ID : '.$get_id.'
                    <br /> Status : '.$status.'
                    ');
                }
            } else {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Gagal');
            }
        }
}        

require ("../lib/header_admin.php");
?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-wallet text-primary"></i> Kelola Account GOPAY <i class="mdi mdi-settings mdi-spin text-primary"></i></h4><hr>
        <?php if (isset($_SESSION['result'])) {
    if ($_SESSION['result']['alert'] == 'success') {
?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;
            </span>
          </button>
          <strong>Respon : 
          </strong>
          <?php echo $_SESSION['result']['judul'] ?>
          <br /> 
          <strong>Pesan : 
          </strong> 
          <?php echo $_SESSION['result']['pesan'] ?>
          <div id="respon">
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <script>
          var url = "<?php echo $config['web']['url'] ?>admin-dashboard/mutasi_gopay";
          // URL Tujuan
          var count = 3;
          // dalam detik
          function countDown() {
            if (count > 0) {
              count--;
              var waktu = count + 1;
              $('#respon').html('<b>Autentikasi Berhasil: </b> Halaman Akan Refresh Otomatis Dalam ' + waktu + ' Detik.');
              setTimeout("countDown()", 1000);
            }
            else {
              window.location.href = url;
            }
          }
          countDown();
        </script>
        <?php
    }
    else { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;
            </span>
          </button>
          <strong>Respon : 
          </strong>
          <?php echo $_SESSION['result']['judul'] ?>
          <br /> 
          <strong>Pesan : 
          </strong> 
          <?php echo $_SESSION['result']['pesan'] ?>
        </div>
        <?php
    }
    unset($_SESSION['result']);
} ?>
        <form method="POST">
          <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
          <div class="row">
            <div class="form-group col-md-6 col-12">
              <label>Nomor HP
              </label>
              <input type="number" class="form-control" name="nomorGojek" value="<?php echo $dataGopay['nomor'] ?>">
            </div>
            <div class="form-group col-md-6 col-12">
              <label>&nbsp;
              </label>
              <button type="submit" name="send_otp" class="btn btn-primary form-control">Kirim OTP
              </button>
            </div>
          </div>	
          <div class="row">
            <div class="form-group col-md-6 col-12">
              <label>Verifikasi SMS
              </label>
              <input type="number" class="form-control" name="otp" value="<?php echo $dataGopay['otp'] ?>">
            </div>
            <div class="form-group col-md-6 col-12">
              <label>&nbsp;
              </label>
              <button type="submit" name="login" class="btn btn-primary form-control">Verifikasi
              </button>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-6">
              <button type="submit" name="reset" class="btn btn-danger form-control">Reset
              </button>
            </div>
            <div class="form-group col-6">
              <button type="submit" name="cek" class="btn btn-primary form-control">Cek
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>										
</div>
<!-- end row -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="m-t-0 text-uppercase text-center header-title"><i class="mdi mdi-history text-primary"></i> Riwayat Mutasi GOPAY </h4><hr>
        <form method="POST">
          <div class="row">
            <div class="form-group col-md-6 col-12">
              <a href="../gateway/gopay/mutasi_gopay.php" target="BLANK" class="btn btn-success btn-block m-b-30">
                <i class="fa fa-plus">
                </i> Mendapatkan Mutasi GOPAY
              </a>
            </div>
            <div class="form-group col-md-6 col-12">
              <button type="submit" name="truncate" class="btn btn-danger btn-block m-b-30">
                <i class="fa fa-trash">
                </i> Truncate / Hapus Semua Mutasi
              </button>
            </div>
          </div>
        </form>
        <form method="GET">
          <div class="row">
            <div class="form-group col-lg-4">
              <label>Tampilkan Beberapa
              </label>
              <select class="form-control" name="tampil">
                <option value="10">10
                </option>
                <option value="50">50
                </option>
                <option value="100">100
                </option>
                <option value="250">250
                </option>
              </select>
            </div> 
            <div class="form-group col-lg-4">
              <label>Cari Deskripsi
              </label>
              <input type="text" class="form-control" name="aksi" placeholder="Cari Deskripsi">
            </div>    
            <div class="form-group col-lg-4">
              <label>Submit
              </label>
              <button type="submit" class="btn btn-block btn-primary">Filter
              </button>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-bordered nowrap m-0">
            <thead>
              <tr>
                <th>ID
                </th>
                <th style="min-width: 170px;">Tanggal & Waktu
                </th>
                <th>Tipe
                </th>
                <th>Deskrpisi
                </th>
                <th>Nominal
                </th>
                <th>Nomer Referensi
                </th>
                <th>Status</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
// start paging config
if (isset($_GET['cari'])) {
    $cari_urut = $db->real_escape_string(filter($_GET['tampil']));
    $cari_aksi = $db->real_escape_string(filter($_GET['aksi']));
    $cek_mutasi = "SELECT * FROM mutasi_gopay WHERE deskripsi LIKE '%$cari_aksi%' ORDER BY waktu DESC"; // edit
    
}
else {
    $cek_mutasi = "SELECT * FROM mutasi_gopay ORDER BY waktu DESC"; // edit
    
}
if (isset($_GET['cari'])) {
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
    $records_per_page = $cari_urut; // edit
    
}
else {
    $records_per_page = 10; // edit
    
}
$starting_position = 0;
if (isset($_GET["halaman"])) {
    $starting_position = ($conn->real_escape_string(filter($_GET["halaman"])) - 1) * $records_per_page;
}
$new_query = $cek_mutasi . " LIMIT $starting_position, $records_per_page";
$new_query = $conn->query($new_query);
$no = $starting_position + 1;
// end paging config
while ($data_mutasi = $new_query->fetch_assoc()) {
    if ($data_mutasi['status'] == "Read") {
        $label = "danger";
    }
    else if ($data_mutasi['status'] == "Unread") {
        $label = "success";
    }
?>
              <tr>
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $data_mutasi['id']; ?>" class="form-inline" role="form" method="POST"> 
                  <td><?php echo $data_mutasi['id']; ?></td>
                <td>
                  <?php echo $data_mutasi['waktu']; ?>
                </td>
                <td>
                <div class="badge badge-primary">
                  <?php if ($data_mutasi['username'] == "credit") { ?>Transfer Masuk
                    <?php } else { ?>Transfer keluar <?php } ?>
                </div><hr><div class="badge badge-primary"><?php echo $data_mutasi['username']; ?></div>
                </td>
                <td>
                  <?php echo $data_mutasi['deskripsi']; ?>
                </td>
                <td>
                <div class="badge badge-success">
                Rp. <?php echo number_format($data_mutasi['saldo'], 0, ',', '.'); ?>
                </div>
                </td>
                <td style="min-width: 150px;">
                <div class="input-group">
                <input type="text" class="form-control form-control-sm" value="<?php echo $data_mutasi['ref_trx']; ?>" id="ref_trx-<?php echo $data_mutasi['id']; ?>" readonly="">
                <button data-toggle="tooltip" title="Copy Referensi" class="btn btn-xs btn-primary" type="button" onclick="copy_to_clipboard('ref_trx-<?php echo $data_mutasi['id']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                </div>
                </td>
                <td>
                  <button class="btn btn-xs btn-<?php echo $label; ?>">
                    <?php if ($data_mutasi['status'] == "Unread") { ?>Aktif
                    <?php
    }
    else { ?>Sudah Digunakan
                  </button>
                  <?php
    } ?>
                </td>
                <td>                                        
                    <select class="form-control" style="width: 100px;" name="status">
                        <?php if ($data_mutasi['status'] == "Read") { ?>
                               <option value="<?php echo $data_mutasi['status']; ?>"><?php echo $data_mutasi['status']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $data_mutasi['status']; ?>"><?php echo $data_mutasi['status']; ?></option>
                                                <option value="Unread">Unread</option>
                                                <option value="Read">Read</option>
                                            <?php
                                            }
                                            ?>
                     </select>
                 </td>        
                      <td align="center">
                                            <a href="javascript:;" onclick="mutasi_gopay('<?php echo $config['web']['url']; ?>admin-dashboard/ajax/deposit/view-gopay?id=<?php echo $data_mutasi['id']; ?>')" class="btn btn-xs btn-primary"><i class="fa fa-eye" title="view"></i> View </a>
                                            <button data-toggle="tooltip" title="Update" type="submit" name="update" class="btn btn-xs btn-bordred btn-warning"><i class="fa fa-edit"></i> Edit </button>
                     </td>
              </tr>  
               </form> 
<?php } ?>
                </tbody>
          </table>
        </div>
        <br>
                <ul class="pagination pagination-split">
          <?php
// start paging link
if (isset($_GET['cari'])) {
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
}
else {
    $cari_urut = 10;
}
if (isset($_GET['cari'])) {
    $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
    $cari_status = $conn->real_escape_string(filter($_GET['status']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
}
else {
    $self = $_SERVER['PHP_SELF'];
}
$cek_mutasi = $conn->query($cek_mutasi);
$total_records = mysqli_num_rows($cek_mutasi);
echo "<li class='disabled page-item'><a class='page-link' href='#'>Total Data : " . $total_records . "</a></li>";
if ($total_records > 0) {
    $total_pages = ceil($total_records / $records_per_page);
    $current_page = 1;
    if (isset($_GET["halaman"])) {
        $current_page = $conn->real_escape_string(filter($_GET["halaman"]));
        if ($current_page < 1) {
            $current_page = 1;
        }
    }
    if ($current_page > 1) {
        $previous = $current_page - 1;
        if (isset($_GET['cari'])) {
            $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
            $cari_status = $conn->real_escape_string(filter($_GET['status']));
            $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
            echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=1&tampil=" . $cari_urut . "&status=" . $cari_status . "&cari=" . $cari_oid . "'><<</a></li>";
            echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $previous . "&tampil=" . $cari_urut . "&status=" . $cari_status . "&cari=" . $cari_oid . "'><</a></li>";
        }
        else {
            echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=1'><<</a></li>";
            echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $previous . "'><</a></li>";
        }
    }
    // limit page
    $limit_page = $current_page + 3;
    $limit_show_link = $total_pages - $limit_page;
    if ($limit_show_link < 0) {
        $limit_show_link2 = $limit_show_link * 2;
        $limit_link = $limit_show_link - $limit_show_link2;
        $limit_link = 3 - $limit_link;
    }
    else {
        $limit_link = 3;
    }
    $limit_page = $current_page + $limit_link;
    // end limit page
    // start page
    if ($current_page == 1) {
        $start_page = 1;
    }
    else if ($current_page > 1) {
        if ($current_page < 4) {
            $min_page = $current_page - 1;
        }
        else {
            $min_page = 3;
        }
        $start_page = $current_page - $min_page;
    }
    else {
        $start_page = $current_page;
    }
    // end start page
    for ($i = $start_page;$i <= $limit_page;$i++) {
        if (isset($_GET['cari'])) {
            $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
            $cari_status = $conn->real_escape_string(filter($_GET['status']));
            $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
            if ($i == $current_page) {
                echo "<li class='active page-item'><a class='page-link' href='#'>" . $i . "</a></li>";
            }
            else {
                echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $i . "&tampil=" . $cari_urut . "&status=" . $cari_status . "&cari=" . $cari_oid . "'>" . $i . "</a></li>";
            }
        }
        else {
            if ($i == $current_page) {
                echo "<li class='active page-item'><a class='page-link' href='#'>" . $i . "</a></li>";
            }
            else {
                echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $i . "'>" . $i . "</a></li>";
            }
        }
    }
    if ($current_page != $total_pages) {
        $next = $current_page + 1;
        if (isset($_GET['cari'])) {
            $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
            $cari_status = $conn->real_escape_string(filter($_GET['status']));
            $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
            echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $next . "&tampil=" . $cari_urut . "&status=" . $cari_status . "&cari=" . $cari_oid . "'>></a></li>";
            echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $total_pages . "&tampil=" . $cari_urut . "&status=" . $cari_status . "&cari=" . $cari_oid . "'>>></a></li>";
        }
        else {
            echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $next . "'>></i></a></li>";
            echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $total_pages . "'>>></a></li>";
        }
    }
}
// paging link

?>
        </ul>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function copy_to_clipboard(element) {
    var copyText = document.getElementById(element);
    copyText.select();
    document.execCommand("copy");
}
</script>

<script type="text/javascript">
        function mutasi_gopay(url) {
            $.ajax({
                type: "GET",
                url: url,
                beforeSend: function() {
                    $('#modal-detail-body').html('Sedang memuat...');
                },
                success: function(result) {
                    $('#modal-detail-body').html(result);
                },
                error: function() {
                    $('#modal-detail-body').html('Terjadi kesalahan.');
                }
            });
            $('#modal-detail').modal();
        }
    </script> 
        <div class="row">
            <div class="col-md-12">     
                <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title mt-0" id="myModalLabel"><h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-wallet text-primary"></i> Detail Mutasi Gopay</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <div class="modal-body" id="modal-detail-body">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>     
<!-- end row -->
<?php
require '../lib/footer_admin.php';
?>