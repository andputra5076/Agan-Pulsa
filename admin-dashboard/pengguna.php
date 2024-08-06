<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php'; 
        if (isset($_POST['tambah'])) {
            $username = $conn->real_escape_string(filter($_POST['username']));
            $email = $conn->real_escape_string(trim($_POST['email']));
            $password = $conn->real_escape_string(trim($_POST['password']));
            $level = $conn->real_escape_string($_POST['level']);
            $saldo = $conn->real_escape_string(filter($_POST['saldo']));

            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            $cek_username = $conn->query("SELECT * FROM users WHERE username = '$username'");
            $cek_email = $conn->query("SELECT * FROM users WHERE email = '$email'");
            $api_key =  acak(32);
            $terdaftar = "$date $time";         


            if (!$username || !$email || !$password || !$level) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Email <br /> - Username <br /> - Password <br /> - Level <br /> - Saldo');
            } else if ($level != "Member" AND $level != "Reseller" AND $level != "Admin" AND $level != "Agen") {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Input Tidak Sesuai');
            } else if ($cek_username->num_rows > 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username <strong>'.$username.' </strong> Sudah Terdaftar'); 
            } else if ($cek_email->num_rows > 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Email <strong> '.$email.' </strong> Sudah Terdaftar');        
            } else if (strlen($username) < 4) { 
                 $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username Minimal 4 Karakter'); 
            } else if (strlen($password) < 4) { 
                 $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Password Minimal 4 Karakter');                              
            } else {
                if ($conn->query("INSERT INTO users VALUES ('', '', '$email', '', '0', '$username', '$hash_pass', '$saldo', '', '$level', 'Aktif', '$api_key', '$sess_username', '$date', '$time', '0','')") == true) {
                    $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => '
                        Perngguna Baru Telah Berhasil Ditambahkan <br />
                        Email : '.$email.' <br />
                        Username : '.$username.' <br />
                        Password : '.$password.' <br />
                        Level : '.$level.' <br />
                        Saldo : '.$saldo.' <br />
                        ');
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
                }
            }
        } else if (isset($_POST['edit'])) {
            $get_id = $conn->real_escape_string($_POST['id']);
            $email = filter($_POST['email']);
            $password = $conn->real_escape_string(trim($_POST['password']));
            $level = $conn->real_escape_string($_POST['level']);
            $saldo = filter($_POST['saldo']);   
            $status = $conn->real_escape_string($_POST['status']);

            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            if (!$level || !$email) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal!', 'pesan' => 'Input Tidak Boleh Kosong.');
            } else if (!empty($password) AND strlen($password) < 4) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal!', 'pesan' => 'Password minimal 5 karakter.');
            } else {
                if (empty($password) == true) {
                    if ($conn->query("UPDATE users SET email = '$email', level = '$level', status = '$status', saldo = '$saldo' WHERE id = '$get_id'") == true) {
                    $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil!', 'pesan' => 'Data Pengguna Berhasil Diubah.');
                    } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal!', 'pesan' => 'Gagal (1).');
                        }     
                    } else if ($password == true) {   
                    if ($conn->query("UPDATE users SET email = '$email', password = '$password_hash', level = '$level', status = '$status', saldo = '$saldo' WHERE id = '$get_id'") == true) {
                    $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil!', 'pesan' => 'Data Pengguna Berhasil Diubah. ');
                    } else {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal!', 'pesan' => 'Gagal (1).');
                    }
                
            } else {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal!', 'pesan' => 'Gagal (1).');
            }
        }
    } else if (isset($_POST['delete'])) {
            $post_id = $conn->real_escape_string($_POST['id']);
            $cek_users = $conn->query("SELECT * FROM users WHERE id = '$post_id'");
            if ($cek_users->num_rows == 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username Tidak Di Temukan');
            } else {
                if ($conn->query("DELETE FROM users WHERE id = '$post_id'") == true) {
                $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Pengguna Berhasil Di Hapus');
                }
            }
    } else if (isset($_POST['change_api'])) {
            $post_id = $conn->real_escape_string($_GET['id']);
            $cek_users = $conn->query("SELECT * FROM users WHERE id = '$post_id'");
            $api_key =  acak(32);
            if ($cek_users->num_rows == 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Username Tidak Di Temukan');
            } else {
                if ($conn->query("UPDATE  users SET api_key = '$api_key' WHERE id = '$post_id'") == true) {
                $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'API Key Sukses Di Update');
                }
            }
    } else if (isset($_POST['delete_all'])) {
                if ($conn->query("DELETE FROM users WHERE saldo = '0'") == true) {
                $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Pembersihan Pengguna Berhasil');
                }          
        }
    require("../lib/header_admin.php");
?>        
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ri-user-add-line text-primary"></i> Tambah Pengguna</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Level</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="level">
                                                <option value="Member">Member</option>
                                                <option value="Agen">Agen</option>
                                                <option value="Reseller">Reseller</option>
                                                <option value="Admin">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email</label>
                                        <div class="col-md-10">
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Username</label>
                                        <div class="col-md-10">
                                            <input type="text" name="username" class="form-control" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Password</label>
                                        <div class="col-md-10">
                                            <input type="text" name="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Saldo</label>
                                        <div class="col-md-10">
                                            <input type="text" name="saldo" class="form-control" placeholder="Saldo">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger btn-bordred waves-effect" data-dismiss="modal"><i class="fa fa-refresh"></i> Reset</button>
                                        <button type="submit" class="btn btn-success btn-bordred waves-effect w-md waves-light" name="tambah"><i class="ri-user-add-line"></i> Tambah Pengguna</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
                   <div class="row">
                   <div class="col-md-7 col-xl-4">
                       <div class="widget-rounded-circle card-box">
                            <div class="row">
                                <div class="col-6">
                                        <i class="fa fa-users font-24 avatar-title text-success"></i>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h4 class="text-dark mt-1"><span> <?php echo $aktif; ?> </span></h4>
                                        <p class="text-muted mb-1 text-truncate"> Pengguna Aktif</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                    <div class="col-md-5 col-xl-4">
                        <div class="widget-rounded-circle card-box">
                            <div class="row">
                                <div class="col-6">
                                        <i class="fa fa-times font-24 avatar-title text-danger"></i>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h4 class="text-dark mt-1"><span> <?php echo $nonaktif; ?> </span></h4>
                                        <p class="text-muted mb-1 text-truncate"> Pengguna Non Aktif</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">   
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ri-user-search-line text-primary"></i> Daftar Pengguna</h4><hr>
                                    <button data-toggle="modal" data-target="#addModal" class="btn btn-xs btn-primary btn-bordred waves-effect waves-light m-b-30"><i class="ri-user-add-line"></i> Tambah Pengguna</button>
                                      <br/>
                                      <br/>
                                        <form method="GET" action="">
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label>Tampilkan Beberapa</label>
                                                    <select class="form-control" name="tampil">
                                                        <option value="10">10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>                                                          
                                                <div class="form-group col-lg-4">
                                                    <label>Cari Kata Kunci</label>
                                                    <input type="text" class="form-control" name="search" placeholder="Cari Kata Kunci" value="">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Submit</label>
                                                    <button type="submit" class="btn btn-block btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form>
                                <div class="table-responsive">        
                                    <table class="table table-bordered m-0">

                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Saldo</th>
                                                <th>Pemakaian Saldo</th>
                                                <th>Level</th>
                                                <th style="min-width: 250px;">Api Key</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $nama = $conn->real_escape_string(filter($_GET['search']));
    $uplink = $conn->real_escape_string(filter($_GET['search']));
    $email = $conn->real_escape_string(filter($_GET['search']));

    $cek_pengguna = "SELECT * FROM users WHERE username LIKE '%$search%' ORDER BY id ASC"; // edit
} else {
    $cek_pengguna = "SELECT * FROM users ORDER BY saldo DESC"; // edit
}
if (isset($_GET['search'])) {
$cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
$records_per_page = $cari_urut; // edit
} else {
    $records_per_page = 10; // edit
}

$starting_position = 0;
if(isset($_GET["halaman"])) {
    $starting_position = ($conn->real_escape_string(filter($_GET["halaman"]))-1) * $records_per_page;
}
$new_query = $cek_pengguna." LIMIT $starting_position, $records_per_page";
$new_query = $conn->query($new_query);
// end paging config
    while ($data_pengguna = $new_query->fetch_assoc()) {
    if ($data_pengguna['status'] == "Aktif") {
        $label = "success";
    } else if ($data_pengguna['status'] == "Tidak Aktif") {
        $label = "danger";  
    }    
    ?>                                        
                                            <tr>
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $data_pengguna['id']; ?>" class="form-inline" role="form" method="POST">
                                                <th scope="row"><?php echo $data_pengguna['id']; ?></th>
                                                <td><?php echo $data_pengguna['nama']; ?></td>
                                                <td><?php echo $data_pengguna['username']; ?></td>
                                                <td><?php echo number_format($data_pengguna['saldo'],0,',','.'); ?></td>
                                                <td><?php echo number_format($data_pengguna['pemakaian_saldo'],0,',','.'); ?></td>
                                                <td><?php echo $data_pengguna['level']; ?></td>
                                                
                                                
                                                <td style="min-width: 250px;">
                                            <div class="input-group">
                                            <button type="submit" name="change_api" class="btn btn-xs btn-bordred btn-success"><i class="mdi mdi-shuffle-variant" title="Ganti API Key"></i></button> 
                                            <input type="text" class="form-control form-control-sm" value="<?php echo $data_pengguna['api_key']; ?>" id="apikey-<?php echo $data_pengguna['id']; ?>" readonly="">
                                            <button data-toggle="tooltip" title="Copy Apikey" class="btn btn-xs btn-primary" type="button" onclick="copy_to_clipboard('apikey-<?php echo $data_pengguna['id']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                            </div>
                                               </td>
                                        
                                                <td><span class="badge badge-<?php echo $label; ?>"><?php echo $data_pengguna['status']; ?></span></td>
                                                <td align="center">
                                                    <a href="javascript:;" onclick="users('/admin-dashboard/ajax/pengguna/view.php?id=<?php echo $data_pengguna['id']; ?>')" class="btn btn-xs btn-primary"><i class="fa fa-list" title="Edit"></i> View </a>
                                                    <a href="javascript:;" onclick="users('/admin-dashboard/ajax/pengguna/edit.php?id=<?php echo $data_pengguna['id']; ?>')" class="btn btn-xs btn-warning"><i class="fa fa-pencil" title="Edit"></i> Edit </a>
                                                    <a href="javascript:;" onclick="users('/admin-dashboard/ajax/pengguna/delete.php?id=<?php echo $data_pengguna['id']; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash" title="Hapus"></i> Delete </a>
                                                </td>                                                
                                            </form>
                                            </tr>
<?php } ?>                                        
                                    </tbody>
                                </table>
       <br>                   
                                        <ul class="pagination">
<?php
// start paging link
if (isset($_GET['search'])) {
$cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
} else {
$cari_urut =  10;
}  
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
} else {
    $self = $_SERVER['PHP_SELF'];
}
$cek_pengguna = $conn->query($cek_pengguna);
$total_records = mysqli_num_rows($cek_pengguna);
echo "<li class='disabled page-item'><a class='page-link' href='#'>Total Data : ".$total_records."</a></li>";
if($total_records > 0) {
    $total_pages = ceil($total_records/$records_per_page);
    $current_page = 1;
    if(isset($_GET["halaman"])) {
        $current_page = $conn->real_escape_string(filter($_GET["halaman"]));
        if ($current_page < 1) {
            $current_page = 1;
        }
    }
    if($current_page > 1) {
        $previous = $current_page-1;
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=1&tampil=".$cari_urut."&search=".$search."'>← Pertama</a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$previous."&tampil=".$cari_urut."&search=".$search."'><i class='fa fa-angle-left'></i> Sebelumnya</a></li>";
} else {
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=1'>← Pertama</a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$previous."'><i class='fa fa-angle-left'></i> Sebelumnya</a></li>";
}
}
    // limit page
    $limit_page = $current_page+3;
    $limit_show_link = $total_pages-$limit_page;
    if ($limit_show_link < 0) {
        $limit_show_link2 = $limit_show_link*2;
        $limit_link = $limit_show_link - $limit_show_link2;
        $limit_link = 3 - $limit_link;
    } else {
        $limit_link = 3;
    }
    $limit_page = $current_page+$limit_link;
    // end limit page
    // start page
    if ($current_page == 1) {
        $start_page = 1;
    } else if ($current_page > 1) {
        if ($current_page < 4) {
            $min_page  = $current_page-1;
        } else {
            $min_page  = 3;
        }
        $start_page = $current_page-$min_page;
    } else {
        $start_page = $current_page;
    }
    // end start page
    for($i=$start_page; $i<=$limit_page; $i++) {
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
        if($i==$current_page) {
            echo "<li class='active page-item'><a class='page-link' href='#'>".$i."</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$i."&tampil=".$cari_urut."&search=".$search."'>".$i."</a></li>";
        }
    } else {
        if($i==$current_page) {
            echo "<li class='active page-item'><a class='page-link' href='#'>".$i."</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$i."'>".$i."</a></li>";
        }        
    }
    }
    if($current_page!=$total_pages) {
        $next = $current_page+1;
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$next."&tampil=".$cari_urut."&search=".$search."'>Selanjutnya <i class='fa fa-angle-right'></i></a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$total_pages."&tampil=".$cari_urut."&search=".$search."'>Terakhir →</a></li>";
} else {
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$next."'>Selanjutnya <i class='fa fa-angle-right'></i></a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$total_pages."'>Terakhir →</a></li>";
    }
}
}
// end paging link
?>                  
                        </ul>            
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
        function users(url) {
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
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ri-user-search-line text-primary"></i> Detail Pengguna</h4>
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
<?php require '../lib/footer_admin.php'; ?>