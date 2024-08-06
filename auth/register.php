<?php
session_start();
require("../config.php");
if (isset($_SESSION['user'])) {
    header("Location: ".$config['web']['url']);
} else {
    if (isset($_POST['daftar'])) {

        if (daftar($_POST) > 0) {
            $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Pendaftaran Berhasil!', 'pesan' => 'Pengguna Baru Berhasil Ditambahkan !!! Silahkan <a href="/auth/login.php">Masuk_Disini<a/>');
        } else {
            echo mysqli_error($conn);
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
                                <h4 class="panel-title text-uppercase"><i class="mdi mdi-account-plus"></i>    Daftar</h4>
                                <br />
                                <form class="form-horizontal" method="POST">
                                    <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Nama</label>
                                        <div class="col-sm-9">
                                        <div class="input-group sm-9">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-account-card-details text-primary"></i></div>
                                        </div>
                                            <input type="nama" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-9">
                                        <div class="input-group sm-9">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-email-outline text-primary"></i></div>
                                        </div>
                                            <input type="email" class="form-control" name="email" placeholder="Email Aktif" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">No Hanphone</label>
                                        <div class="col-sm-9">
                                        <div class="input-group sm-9">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-phone text-primary"></i></div>
                                        </div>
                                            <input type="number" class="form-control" name="nomer" placeholder="08xxxx" required>
                                        </div>
                                    </div>
                                    </div>                                                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Username</label>
                                        <div class="col-sm-9">
                                        <div class="input-group sm-9">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-account text-primary"></i></div>
                                        </div>
                                            <input type="text" class="form-control" name="username" placeholder="Username">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">Password</label>
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
                                        <label class="col-sm-3 control-label">Konfirmasi Password</label>
                                        <div class="col-sm-9">
                                        <div class="input-group sm-9">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-key text-primary"></i></div>
                                        </div>
                                            <input type="password" class="form-control" name="password2" id="passs" placeholder="Konfirmasi Password">
                                            
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="S&K" class="col-sm-3 control-label">Saya Setuju Dengan S&K</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="ya" id="ya">
                                          <option value="">Pilih salah satu...</option>
                                          <option value="ya">Ya</option>                                        
                                        </select>
                                    </div>
                                </div>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light" name="daftar">  Daftar</button>
                                            </br></br>
                                            <div class="text-center">
                                            <label>Saya sudah punya akun? </b><a href="/auth/login.php">Masuk</b></a>
                                            </label>
                                            </div>
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
            var x = document.getElementById('passs').type;
 
            if (x == 'password')
            {
               document.getElementById('pass').type = 'text';
               document.getElementById('passs').type = 'text';
               document.getElementById('mybtn').innerHTML = '<i class="mdi mdi-eye-off"></i> Hidden';
            }
            else
            {
               document.getElementById('pass').type = 'password';
               document.getElementById('passs').type = 'password';
               document.getElementById('mybtn').innerHTML = '<i class="mdi mdi-eye"></i> Show';
            }
         }
      </script>                                   
                
                      
<?php
require '../lib/footer-home.php';
?>