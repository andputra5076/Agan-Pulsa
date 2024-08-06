<?php
session_start();
require '../config.php';

if (isset($_SESSION['user'])) {
    header("Location: ".$config['web']['url']);
} else {
    if (isset($_POST['login'])) {
        $_POST['url'] = $config['web']['url'];
        $post_username = $conn->real_escape_string(trim(filter($_POST['username'])));
        $post_password = $conn->real_escape_string(trim(filter($_POST['password'])));
        
        $check_user = $conn->query("SELECT * FROM users WHERE username = '$post_username' OR email = '$post_username' OR nomer = '$post_username'");
        $check_user_rows = mysqli_num_rows($check_user);
        $data_user = mysqli_fetch_assoc($check_user);

        $verif_pass = password_verify($post_password, $data_user['password']);

            if (!$post_username || !$post_password) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Username <br /> - Password.');
            } else if ($check_user_rows == 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Pengguna Tidak Tersedia.');
            } else if ($data_user['status'] == "Tidak Aktif") {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Akun Sudah Tidak Aktif.');
            } else {
                if ($check_user_rows == 1){
                    if ($verif_pass == true) {
                        if($data_user['level']== "Developers"){
                            if (push($_POST) > 0) {
                           }
                           $conn->query("INSERT INTO log VALUES ('','$post_username', 'Login', '".get_client_ip()."','$date','$time')");
                            $_SESSION['user'] = $data_user;
                            $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil Masuk!', 'pesan' => 'Selamat Datang <b>'.$data_user['nama'].'</b>, Semoga Hari Anda Menyenangkan');
                            exit(header("Location: ".$config['web']['url']));
                        }else {
                            $conn->query("INSERT INTO log VALUES ('','$post_username', 'Login', '".get_client_ip()."','$date','$time')");
                            $_SESSION['user'] = $data_user;
                            $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil Masuk!', 'pesan' => 'Selamat Datang <b>'.$data_user['nama'].'</b>, Semoga Hari Anda Menyenangkan');
                            exit(header("Location: ".$config['web']['url']));
                        }
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data yang anda masukkan tidak sesuai.');
                }
            }
        }
    }
}
require '../lib/header.php';
require '../alert.php';
?>  

                 
                <div class="row">
                    <div class="offset-md-2 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="panel-title text-uppercase"><i class="mdi mdi-login-variant"></i>    Masuk</h4>
                                <br />
                                <form class="form-horizontal" method="POST">
                                    <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">                                 
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Username</label>
                                        <div class="col-sm-9">
                                        <div class="input-group sm-9">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-account text-primary"></i></div>
                                        </div>
                                            <input type="text" class="form-control" name="username" placeholder="username/email/no hp">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-3 control-label">Password </label>
                                        <div class="col-sm-9">
                                        <span class="badge badge-primary float-right" id="mybtn" onclick="change()"><i class="mdi mdi-eye"></i> Show</span>
                                        <div class="input-group sm-9">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-key text-primary"></i></div>
                                        </div>
                                            <input type="password" class="form-control" name="password" id="pass" placeholder="Password">
                                        </div>
                                    </div>
                                    </div>     
                                    <div class="form-group row">
                                        <label  class="col-sm-3 control-label">Remember</label>
                                        <div class="col-sm-9">
                                    <select class="form-control" name="remember" id="remember">
                                        <option value="">Pilih salah satu...</option>
                                        <option value="Hour">1 Hour</option>
                                        <option value="Week">1 Week</option>
                                        <option value="Month">1 Month</option>
                                        <option value="Year">1 Year</option>
                                    </select>
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light" name="login"> Masuk</button>
                                            </br>
                                            <div class="text-center"><br>Belum punya akun ?</br></div>
                                            <a class="btn btn-success btn-block waves-effect waves-light" href="/auth/register.php"> Daftar Disini</a>
                                        </div>                                     
                                    </div>                                
                                </form>
                            </div>
                        </div>                      
                    </div> <!-- end col -->
                </div>
                <!-- end row -->   
                
  <script type="text/javascript">
         function change()
         {
            var x = document.getElementById('pass').type;
 
            if (x == 'password')
            {
               document.getElementById('pass').type = 'text';
               document.getElementById('mybtn').innerHTML = '<i class="mdi mdi-eye-off"></i> Hidden';
            }
            else
            {
               document.getElementById('pass').type = 'password';
               document.getElementById('mybtn').innerHTML = '<i class="mdi mdi-eye"></i> Show';
            }
         }
      </script>                 
                
                
<?php
require '../lib/footer-home.php';
?>