<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php'; 
        if (isset($_POST['tambah'])) {
            $konten = $conn->real_escape_string(filter($_POST['konten']));
            $subjek = $conn->real_escape_string(filter($_POST['subjek']));
            $tipe = $conn->real_escape_string(filter($_POST['tipe']));

            if (!$konten || !$subjek || !$tipe) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Tipe <br /> - Subjek <br /> - Konten');
            } else {
                $insert = $conn->query("INSERT INTO berita VALUES ('', '$date', '$time', '$tipe', '$subjek', '$konten')");
                if ($insert == TRUE) {
                    $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Berhasil Menambahkan Berita Baru');
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
                }
            }
        } else if (isset($_POST['edit'])) {
            $post_id = $conn->real_escape_string($_POST['id']);
            $konten = $conn->real_escape_string(filter($_POST['konten']));
            $subjek = $conn->real_escape_string(filter($_POST['subjek']));
            $tipe = $conn->real_escape_string(filter($_POST['tipe']));
            if (!$konten) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Input Pada Form <br /> - Subjek <br /> - Konten');
            } else {
                $update = $conn->query("UPDATE berita SET konten = '$konten', subjek = '$subjek', tipe = '$tipe' WHERE id = '$post_id'");
                if ($update == TRUE) {
                    $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Berita Berhasil Di Update');
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
                }
            }
        } else if (isset($_POST['delete'])) {
            $post_id = $conn->real_escape_string($_POST['id']);
            $cek_berita = $conn->query("SELECT * FROM berita WHERE id = '$post_id'");
            if ($cek_berita->num_rows == 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Berita Tidak Di Temukan');
            } else {
                $delete = $conn->query("DELETE FROM berita WHERE id = '$post_id'");
                if ($delete == TRUE) {
                $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Berita Berhasil Di Hapus');
                }
            }
        }

    require '../lib/header_admin.php';
?>        
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="mdi mdi-newspaper text-primary"></i> Tambah Berita</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST">
                                    <div class="form-group row">
                                        <badge class="col-md-2 control-badge">Label</badge>
                                        <div class="col-md-10">
                                            <select class="form-control" name="tipe">
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="INFORMASI">INFORMASI</option>
                                                <option value="PERINGATAN">PERINGATAN</option>
                                                <option value="PENTING">PENTING</option>
                                                <option value="UPDATE">UPDATE</option>
                                                <option value="DEPOSIT">DEPOSIT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <badge class="col-md-2 control-badge">Subjek</badge>
                                        <div class="col-md-10">
                                            <textarea name="subjek" class="form-control" placeholder="Subjek"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <badge class="col-md-2 control-badge">Konten</badge>
                                        <div class="col-md-10">
                                            <textarea name="konten" class="form-control" rows="8" style="height:200px;" placeholder="Konten"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger btn-bordred waves-effect"><i class="fa fa-refresh"></i> Reset</button>
                                        <button type="submit" class="btn btn-success btn-bordred waves-effect w-md waves-light" name="tambah"><i class="fa fa-add"></i> Tambah</button>
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
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="mdi mdi-newspaper text-primary"></i> Kelola Berita</h4><hr>
                                    <button data-toggle="modal" data-target="#addModal" class="btn btn-xs btn-primary btn-bordred waves-effect waves-light m-b-30"><i class="mdi mdi-newspaper"></i> Tambah Berita</button>
                                      <br/>
                                      <br/>
                                        <form method="GET" action="">
                                            <div class="row">
                                                <div class="form-group col-lg-3">
                                                    <badge>Tampilkan Beberapa</badge>
                                                    <select class="form-control" name="tampil">
                                                        <option value="10">10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>                                                
                                                <div class="form-group col-lg-3">
                                                    <badge>Filter Tipe</badge>
                                                    <select class="form-control" name="kategori">
                                                        <option value="">Semua</option>
                                                        <option value="INFORMASI">Informasi</option>
                                                        <option value="PERINGATAN">Peringatan</option>
                                                        <option value="PENTING">Penting</option>
                                                        <option value="UPDATE">UPDATE</option>
                                                        <option value="DEPOSIT">DEPOSIT</option>
                                                    </select>
                                                </div>                                                
                                                <div class="form-group col-lg-3">
                                                    <badge>Cari Kata Kunci</badge>
                                                    <input type="text" class="form-control" name="search" placeholder="Cari Kata Kunci" value="">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <badge>Submit</badge>
                                                    <button type="submit" class="btn btn-block btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Waktu</th>
                                                <th>Label</th>
                                                <th>Subjek</th>
                                                <th>Konten</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$no = 1;
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $kategori = $conn->real_escape_string(filter($_GET['kategori']));

    $cek_berita = "SELECT * FROM berita WHERE tipe LIKE '%$kategori%' AND konten LIKE '%$search%' ORDER BY id DESC"; // edit
} else {
    $cek_berita = "SELECT * FROM berita ORDER BY id DESC"; // edit
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
$new_query = $cek_berita." LIMIT $starting_position, $records_per_page";
$new_query = $conn->query($new_query);
// end paging config
    while ($data_berita = $new_query->fetch_assoc()) {
    if ($data_berita['tipe'] == "INFORMASI") {
        $badge = "info";
    } else if ($data_berita['tipe'] == "PERINGATAN") {
        $badge = "warning";
    } else if ($data_berita['tipe'] == "PENTING") {
        $badge = "danger";    
    } else if ($data_berita['tipe'] == "NEW Layanan") {
        $badge = "success";        
    } else if ($data_berita['tipe'] == "OFF Layanan") {
        $badge = "primary";            
    }
    ?>                                        
                                            <tr>
                                                <td scope="row"><?php echo $no++; ?></td>
                                                <td><?php echo tanggal_indo($data_berita['date']); ?>, <?php echo $data_berita['time']; ?></td>
                                                <td><span class="btn btn-lg btn-<?php echo $badge; ?>"><i class="fas fa-info-circle"></i></span></td>
                                                <td style="min-width: 150px;"><textarea rows="5" cols="100" class="form-control" readonly><?php echo $data_berita['subjek']; ?></textarea></td>
                                                <td style="min-width: 250px;"><textarea rows="5" cols="100" class="form-control" readonly><?php echo $data_berita['konten']; ?></textarea></td>
                                                <td align="center">
                                                    <a href="javascript:;" onclick="users('/admin-dashboard/ajax/berita/edit.php?id=<?php echo $data_berita['id']; ?>')" class="btn btn-xs btn-warning"><i class="fa fa-pencil" title="Edit"></i> Update </a>
                                                    <a href="javascript:;" onclick="users('/admin-dashboard/ajax/berita/delete.php?id=<?php echo $data_berita['id']; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash" title="Hapus"></i> Delete </a>
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
    $kategori = $conn->real_escape_string(filter($_GET['kategori']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
} else {
    $self = $_SERVER['PHP_SELF'];
}
$cek_berita = $conn->query($cek_berita);
$total_records = mysqli_num_rows($cek_berita);
echo "<li class='disabled page-item'><a class='page-link' href='#'>Total : ".$total_records."</a></li>";
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
    $kategori = $conn->real_escape_string(filter($_GET['kategori']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=1&tampil=".$cari_urut."&kategori=".$kategori."&search=".$search."'> << </a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$previous."&tampil=".$cari_urut."&kategori=".$kategori."&search=".$search."'> < </a></li>";
} else {
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=1'> << </a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$previous."'> < </a></li>";
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
    $kategori = $conn->real_escape_string(filter($_GET['kategori']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
        if($i==$current_page) {
            echo "<li class='active page-item'><a class='page-link' href='#'>".$i."</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$i."&tampil=".$cari_urut."&kategori=".$kategori."&search=".$search."'>".$i."</a></li>";
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
    $kategori = $conn->real_escape_string(filter($_GET['kategori']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$next."&tampil=".$cari_urut."&kategori=".$kategori."&search=".$search."'> > </a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$total_pages."&tampil=".$cari_urut."&kategori=".$kategori."&search=".$search."'> >> </a></li>";
} else {
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$next."'> > </a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$total_pages."'> >> </a></li>";
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
                <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-badgeledby="myModalbadge"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title mt-0" id="myModalbadge"><i class="mdi mdi-newspaper"></i> Berita</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-badge="Close">
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