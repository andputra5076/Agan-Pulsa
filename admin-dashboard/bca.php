<?php
session_start();
require('../config.php');
require('../lib/session_login_admin.php');

$data_bca = $conn->query("SELECT * FROM bca")->fetch_assoc();

if (isset($_POST['submit'])) {
    $user_id = $conn->real_escape_string(trim(filter($_POST['user_id'])));
    $password = $_POST['password'];
    
    if(!$user_id || !$password) {
        $_SESSION['result'] = array(
            'alert' => 'danger',
            'judul' => 'Gagal',
            'pesan' => 'Mohon Mengisi Form.'
        );
    } else {
        $input = $conn->query("UPDATE bca SET user_id = '$user_id', password = '$password' WHERE id = 'S1'");
        if ($input == true) {
            $_SESSION['result'] = array(
                'alert' => 'success',
                'judul' => 'Berhasil',
                'pesan' => 'Berhasil update data bca'
                );
        } else {
          $_SESSION['result'] = array(
            'alert' => 'danger',
            'judul' => 'Gagal',
            'pesan' => 'Sistem kami sedang gangguan.'
        );  
        }
    }
}
    
require ("../lib/header_admin.php");
?>
<?php if (isset($_SESSION['result'])) {
    if ($_SESSION['result']['alert'] == 'success') {
        ?>
<div class="row">
	<div class="col-md-12">
	     <div class="row">
  <div class="col">
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;
        </span>
      </button>
      <div class="alert-text">
        <strong>Respon : 
        </strong>
        <?php echo $_SESSION['result']['judul'] ?>
        <br> 
        <strong>Pesan : 
        </strong> 
        <?php echo $_SESSION['result']['pesan'] ?>
        <div id="respon">
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
      </script>
      <script>
        var url = "<?php echo $config['web']['url'] ?>admin-dashboard/bca.php";
        // URL Tujuan
        var count = 1;
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
    </div>
  </div>
</div>
<?php
    }
    else { ?>
<div class="row">
  <div class="col">
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;
        </span>
      </button>
      <div class="alert-text">
        <strong>Respon : 
        </strong>
        <?php echo $_SESSION['result']['judul'] ?>
        <br> 
        <strong>Pesan : 
        </strong> 
        <?php echo $_SESSION['result']['pesan'] ?>
      </div>
    </div>
  </div>
</div>
<?php
    }
    unset($_SESSION['result']);
} ?>
		<div class="card">
			<div class="card-body">
				<h4 class="m-t-0 text-uppercase text-center header-title"><b> Login BCA</b></h4><hr>
				
        <form class="form-horizontal" method="POST">
          <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
          <div class="row">
            <div class="form-group col-md-12 col-12">
              <label>USER ID.
              </label>
              <input type="text" class="form-control" name="user_id" value="<?php echo $data_bca['user_id'] ?>">
            </div>
            <div class="form-group col-md-12 col-12">
              <label>&nbsp;
              </label>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12 col-12">
              <label>PASSWORD
              </label>
              <input type="password" class="form-control" name="password" value="<?php echo $data_bca['password'] ?>">
            </div>
            <div class="form-group col-md-12 col-12">
              <label>&nbsp;
              </label>
           </div>
          </div>
          <div class="form-group">
             <button type="submit" name="submit" class="btn btn-success btn-block form-control">Login
             </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
require '../lib/footer.php';
?>
