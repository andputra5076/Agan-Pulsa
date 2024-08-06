<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php'; 

        if (isset($_POST['tambah'])) {
            $tipe = $conn->real_escape_string(filter($_POST['tipe']));
            $provider = $conn->real_escape_string(trim($_POST['provider']));
            $nama = $conn->real_escape_string(trim($_POST['nama']));
            $tujuan = $conn->real_escape_string($_POST['tujuan']);
            $rate = $conn->real_escape_string($_POST['rate']);
            $min = $conn->real_escape_string($_POST['min']);
            $max = $conn->real_escape_string($_POST['max']);


            if (!$tipe || !$provider || !$nama || !$tujuan || !$rate || !$min || !$max) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Semua Input');                               
            } else {
                if ($conn->query("INSERT INTO metode_depo VALUES ('', '$provider', '$nama', '$rate', '$tujuan', '$tipe', '$min', '$max')") == true) {
                    $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => '
                        Metode Deposit Baru Telah Berhasil Ditambahkan <br />
                        Tipe : '.$tipe.' <br />
                        Provider : '.$provider.' <br />
                        Nama : '.$nama.' <br />
                        Tujuan : '.$tujuan.' <br />
                        Rate : '.$rate.' <br />
                        Min : '.$min.' <br />
                        Max : '.$max.' <br />
                        ');
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
                }
            }
        } else if (isset($_POST['edit'])) {
            $post_id = $conn->real_escape_string($_POST['id']);
            $tipe = $conn->real_escape_string(filter($_POST['tipe']));
            $provider = $conn->real_escape_string(trim($_POST['provider']));
            $nama = $conn->real_escape_string(trim($_POST['nama']));
            $tujuan = $conn->real_escape_string($_POST['tujuan']);
            $rate = $conn->real_escape_string($_POST['rate']);  
            $min = $conn->real_escape_string($_POST['min']); 
            $max = $conn->real_escape_string($_POST['max']); 

            $cek_id = $conn->query("SELECT * FROM metode_depo WHERE id = '$post_id'");       


            if ($cek_id->num_rows == 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data Tidak Di Temukan');                                   
            } else {
                if ($conn->query("UPDATE metode_depo SET provider = '$provider', nama = '$nama', rate = '$rate', tujuan = '$tujuan', tipe = '$tipe' , min = '$min' , max = '$max'  WHERE id = '$post_id'") == true) {
                    $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => '
                        Metode Deposit Baru Telah Berhasil Diubah <br />
                        Tipe : '.$tipe.' <br />
                        Provider : '.$provider.' <br />
                        Nama : '.$nama.' <br />
                        Tujuan : '.$tujuan.' <br />
                        Rate : '.$rate.' <br />
                        Min : '.$min.' <br />     
                        Max : '.$max.' <br />     
                        ');                    
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
                }
            }
    } else if (isset($_POST['delete'])) {
            $post_id = $conn->real_escape_string($_POST['id']);
            $cek_layanan = $conn->query("SELECT * FROM metode_depo WHERE id = '$post_id'");
            if ($cek_layanan->num_rows == 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data Tidak Di Temukan');
            } else {
                if ($conn->query("DELETE FROM metode_depo WHERE id = '$post_id'") == true) {
                $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Data Berhasil Di Hapus');
                }
            }
        }
    require("../lib/header_admin.php");
?>   
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-wallet text-primary"></i> TAMBAH METODE DEPOSIT <i class="fa fa-pencil"></i><h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tipe</label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="tipe">
                                                        <option value="">Pilih Salah Satu...</option>
                                                        <option value="Pulsa Transfer">Pulsa Transfer</option>
                                                        <option value="Bank">Bank</option>
                                                    </select>
                                        </div>
                                    </div>                                     
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Provider</label>
                                        <div class="col-md-10">
                                            <input type="text" name="provider" class="form-control" placeholder="Contoh : Bank BRI, Telkomsel">
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nama</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nama" class="form-control" placeholder="Contoh : #1 Telkomsel Transfer">
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Rate</label>
                                        <div class="col-md-10">
                                            <input type="text" name="rate" class="form-control" placeholder="Contoh : 1 , 1.2">
                                        </div>
                                    </div>                                         
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tujuan</label>
                                        <div class="col-md-10">
                                            <input type="text" name="tujuan" class="form-control" placeholder="Contoh : 081324447474
                                            ">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Min</label>
                                        <div class="col-md-10">
                                            <input type="text" name="min" class="form-control" placeholder="Contoh : 10000
                                            ">
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Max</label>
                                        <div class="col-md-10">
                                            <input type="text" name="max" class="form-control" placeholder="Contoh : 999999999
                                            ">
                                        </div>
                                    </div>   
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger btn-bordred waves-effect"><i class="fa fa-refresh"></i> Reset</button>
                                        <button type="submit" class="btn btn-success btn-bordred waves-effect w-md waves-light" name="tambah"><i class="fas fa-plus-circle"></i> Tambahkan</button>
                                    </div>
                                </form>
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
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-wallet text-primary"></i> METODE DEPOSIT</h4><hr> 
                                <button data-toggle="modal" data-target="#addModal" class="btn btn-xs btn-primary btn-bordred waves-effect waves-light m-b-30"><i class="fas fa-plus-circle"></i> Tambah Metode Deposit</button><hr>
                                        <form>
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label>Tampilkan Beberapa</label>
                                                    <select class="form-control" name="tampil">
                                                        <option value="10">10</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                        <option value="250">250</option>
                                                    </select>
                                                </div>                                                             <div class="form-group col-lg-4">
                                                    <label>Cari Metode Deposit</label>
                                                    <input type="text" class="form-control" name="search" placeholder="Cari Metode Deposit" value="">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Submit</label>
                                                    <button type="submit" class="btn btn-block btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipe</th>
                                        <th>Provider</th>
                                        <th>Nama</th>
                                        <th>Rate</th>
                                        <th>Tujuan Transfer</th>
                                        <th>Min</th>
                                        <th>Max</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
<?php 
// start paging config
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));

    $cek_metode = "SELECT * FROM metode_depo WHERE nama LIKE '%$search%' ORDER BY id ASC"; // edit
} else {
    $cek_metode = "SELECT * FROM metode_depo ORDER BY id ASC"; // edit
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
$new_query = $cek_metode." LIMIT $starting_position, $records_per_page";
$new_query = $conn->query($new_query);
// end paging config
while ($data_method = $new_query->fetch_assoc()) {
?>
                                    <tr> 
                                        <td><?php echo $data_method['id']; ?></td>
                                        <td><?php echo $data_method['tipe']; ?></td>
                                        <td><?php echo $data_method['provider']; ?></td>
                                        <td><?php echo $data_method['nama']; ?></td>
                                        <td><?php echo $data_method['rate']; ?></td>
                                        <td style="min-width: 200px;">
                                            <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" value="<?php echo $data_method['tujuan']; ?>" id="tujuan-<?php echo $data_method['id']; ?>" readonly="">
                                            <button data-toggle="tooltip" title="Copy Target" class="btn btn-xs btn-primary" type="button" onclick="copy_to_clipboard('tujuan-<?php echo $data_method['id']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                            </div>
                                        </td>
                                        <td><?php echo $data_method['min']; ?></td>
                                        <td><?php echo $data_method['max']; ?></td>
                                        <td align="center">
                                            <a href="javascript:;" onclick="users('/admin-dashboard/ajax/metode-deposit/edit.php?data=<?php echo $data_method['id']; ?>')" class="btn btn-xs btn-warning"><i class="fa fa-pencil" title="Edit"></i> Edit </a>
                                            <a href="javascript:;" onclick="users('/admin-dashboard/ajax/metode-deposit/delete.php?data=<?php echo $data_method['id']; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash" title="Hapus"></i> Delete </a>
                                        </td>                                 
                                    </tr>  
<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                                        <ul class="pagination pagination-split">
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
$cek_metode = $conn->query($cek_metode);
$total_records = mysqli_num_rows($cek_metode);
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
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=1&tampil=".$cari_urut."&search=".$search."'><<</a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$previous."&tampil=".$cari_urut."&search=".$search."'><</a></li>";
} else {
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=1'><<</a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$previous."'><</a></li>";
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
    if (isset($_GET['cari'])) {
    $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
    $cari_status = $conn->real_escape_string(filter($_GET['status']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$next."&tampil=".$cari_urut."&search=".$search."'>></a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$total_pages."&tampil=".$cari_urut."&search=".$search."'>>></a></li>";
} else {
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$next."'>></i></a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$total_pages."'>>></a></li>";
    }
}
}
// end paging link
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
                                <h4 class="modal-title mt-0" id="myModalLabel"><h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-wallet text-primary"></i> METODE DEPOSIT</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <div class="modal-body" id="modal-detail-body">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require '../lib/footer_admin.php';
?>