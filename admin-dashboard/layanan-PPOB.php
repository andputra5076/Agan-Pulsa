<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php';

if (isset($_POST['tambah'])) {
    $sid = $conn->real_escape_string(filter($_POST['sid']));
    $pid = $conn->real_escape_string(trim($_POST['pid']));
    $kategori = $conn->real_escape_string(trim($_POST['kategori']));
    $layanan = $conn->real_escape_string($_POST['layanan']);
    $catatan = $conn->real_escape_string(filter($_POST['catatan']));
    $tipe = $conn->real_escape_string(trim($_POST['tipe']));
    $harga = $conn->real_escape_string($_POST['harga']);
    $harga_api = $conn->real_escape_string($_POST['harga_api']);
    $profit = $conn->real_escape_string(filter($_POST['profit']));
    $status = $conn->real_escape_string(trim($_POST['status']));
    $provider = $conn->real_escape_string(trim($_POST['provider']));


    if (!$sid || !$pid || !$kategori || !$layanan || !$catatan || !$harga || !$harga_api || !$profit || !$status || !$provider) {
        $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Semua Input');
    } else {
        if ($conn->query("INSERT INTO layanan_pulsa VALUES ('', '$sid', '$pid', '$kategori', '$layanan', '$harga', '$harga_api', '$profit', 'Ya', '$status', '$provider', '$tipe', '$catatan')") == true) {
            $_SESSION['hasil'] = array(
                'alert' => 'success',
                'judul' => 'Berhasil',
                'pesan' => '
                        Layanan Baru Telah Berhasil Ditambahkan <br />
                        Service ID : ' . $sid . ' <br />
                        Provider ID : ' . $pid . ' <br />
                        Kategori : ' . $kategori . ' <br />
                        Nama Layanan : ' . $layanan . ' <br />
                        Catatan : ' . $catatan . ' <br />
                        Harga web : ' . $harga . ' <br />
                        Harga api : ' . $harga_api . ' <br />
                        Keuntungan : ' . $profit . ' <br />
                        Status : ' . $status . ' <br />
                        Provider : ' . $provider . ' <br />                        
                        '
            );
        } else {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
        }
    }
} else if (isset($_POST['edit'])) {
    $sid = $conn->real_escape_string(filter($_POST['sid']));
    $pid = $conn->real_escape_string(trim($_POST['pid']));
    $kategori = $conn->real_escape_string(trim($_POST['kategori']));
    $layanan = $conn->real_escape_string($_POST['layanan']);
    $catatan = $conn->real_escape_string(filter($_POST['catatan']));
    $tipe = $conn->real_escape_string(trim($_POST['tipe']));
    $multi = $conn->real_escape_string(trim($_POST['multi']));
    $harga = $conn->real_escape_string($_POST['harga']);
    $harga_api = $conn->real_escape_string($_POST['harga_api']);
    $profit = $conn->real_escape_string(filter($_POST['profit']));
    $status = $conn->real_escape_string(trim($_POST['status']));
    $provider = $conn->real_escape_string(trim($_POST['provider']));

    $cek_id = $conn->query("SELECT * FROM layanan_pulsa WHERE service_id = '$sid'");


    if ($cek_id->num_rows == 0) {
        $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data Tidak Di Temukan');
    } else {
        if ($conn->query("UPDATE layanan_pulsa SET service_id = '$sid', provider_id = '$pid',  operator = '$kategori', layanan = '$layanan', harga = '$harga', harga_api = '$harga_api', profit = '$profit', multi = '$multi', status = '$status', provider = '$provider', tipe = '$tipe', catatan = '$catatan'  WHERE service_id = '$sid'") == true) {
            $_SESSION['hasil'] = array(
                'alert' => 'success',
                'judul' => 'Berhasil',
                'pesan' => '
                        Layanan Telah Berhasil Diubah <br />
                        Service ID : ' . $sid . ' <br />
                        Provider ID : ' . $pid . ' <br />
                        Kategori : ' . $kategori . ' <br />
                        Nama Layanan : ' . $layanan . ' <br />
                        Catatan : ' . $catatan . ' <br />
                        Harga web : ' . $harga . ' <br />
                        Harga api : ' . $harga_api . ' <br />
                        Keuntungan : ' . $profit . ' <br />
                        Status : ' . $status . ' <br />
                        Provider : ' . $provider . ' <br />                        
                        '
            );
        } else {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
        }
    }
} else if (isset($_POST['delete'])) {
    $post_id = $conn->real_escape_string($_POST['id']);
    $cek_layanan = $conn->query("SELECT * FROM layanan_pulsa WHERE service_id = '$post_id'");
    if ($cek_layanan->num_rows == 0) {
        $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data Tidak Di Temukan');
    } else {
        if ($conn->query("DELETE FROM layanan_pulsa WHERE service_id = '$post_id'") == true) {
            $_SESSION['hasil'] = array(
                'alert' => 'success',
                'judul' => 'Berhasil',
                'pesan' => 'Layanan Berhasil Di Hapus'
            );
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
                        <h4 class="modal-title m-t-0 id=" myModalLabel""><i class="mdi mdi-format-align-justify text-primary"></i> Tambah Layanan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="POST">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Service ID</label>
                                <div class="col-md-10">
                                    <input type="text" name="sid" class="form-control" placeholder="Service ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Provider ID</label>
                                <div class="col-md-10">
                                    <input type="text" name="pid" class="form-control" placeholder="Provider ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Kategori</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="kategori">
                                        <option value="">Pilih Salah Satu...</option>
                                        <?php
                                        $cek_kategori = $conn->query("SELECT * FROM kategori_pulsa ORDER BY nama ASC");
                                        while ($data_kategori = $cek_kategori->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $data_kategori['kode']; ?>"><?php echo $data_kategori['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Layanan</label>
                                <div class="col-md-10">
                                    <input type="text" name="layanan" class="form-control" placeholder="Layanan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Catatan</label>
                                <div class="col-md-10">
                                    <textarea name="catatan" class="form-control" placeholder="Catatan"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Harga web</label>
                                <div class="col-md-10">
                                    <input type="text" name="harga" class="form-control" placeholder="Harga web
                                            ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Harga api</label>
                                <div class="col-md-10">
                                    <input type="text" name="harga_api" class="form-control" placeholder="Harga api
                                            ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Keuntungan</label>
                                <div class="col-md-10">
                                    <input type="text" name="profit" class="form-control" placeholder="Keuntungan
                                            ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="status">
                                        <option value="">Pilih Salah Satu...</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Gangguan">Gangguan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Provider</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="provider">
                                        <option value="">Pilih Salah Satu...</option>
                                        <?php
                                        $cek_provider = $conn->query("SELECT * FROM provider ORDER BY id ASC");
                                        while ($data_provider = $cek_provider->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $data_provider['code']; ?>"><?php echo $data_provider['code']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tipe</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="tipe">
                                        <option value="">Pilih Salah Satu...</option>
                                        <?php
                                        $cek_provider = $conn->query("SELECT * FROM kategori_pulsa ORDER BY id ASC");
                                        while ($data_provider = $cek_provider->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $data_provider['tipe']; ?>"><?php echo $data_provider['tipe']; ?></option>
                                        <?php } ?>
                                    </select>
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
                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="mdi mdi-format-align-justify text-primary"></i> Layanan Sosial Media</h4>
                <hr>
                <button data-toggle="modal" data-target="#addModal" class="btn btn-xs btn-primary btn-bordred waves-effect waves-light m-b-30"><i class="mdi mdi-plus-circle-outline"></i> Tambah Layanan</button>
                <br />
                <br />
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
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Cari Layanan</label>
                            <input type="text" class="form-control" name="search" placeholder="Cari Layanan" value="">
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
                                <th>Service ID</th>
                                <th>Provider ID</th>
                                <th>Kategori</th>
                                <th>Layanan</th>
                                <th>Catatan</th>
                                <th>Harga <i class="mdi mdi-television-guide text-success"></i></th>
                                <th>Harga <i class="mdi mdi-shuffle-variant text-danger"></i></th>
                                <th>Profit <i class="mdi mdi-coin text-warning"></i></th>
                                <th>Status</th>
                                <th>Provider</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // start paging config
                            if (isset($_GET['search'])) {
                                $search = $conn->real_escape_string(filter($_GET['search']));

                                $cek_layanan = "SELECT * FROM layanan_pulsa WHERE layanan LIKE '%$search%' ORDER BY id ASC"; // edit
                            } else {
                                $cek_layanan = "SELECT * FROM layanan_pulsa ORDER BY id ASC"; // edit
                            }
                            if (isset($_GET['search'])) {
                                $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
                                $records_per_page = $cari_urut; // edit
                            } else {
                                $records_per_page = 10; // edit
                            }

                            $starting_position = 0;
                            if (isset($_GET["halaman"])) {
                                $starting_position = ($conn->real_escape_string(filter($_GET["halaman"])) - 1) * $records_per_page;
                            }
                            $new_query = $cek_layanan . " LIMIT $starting_position, $records_per_page";
                            $new_query = $conn->query($new_query);
                            // end paging config
                            while ($data_layanan = $new_query->fetch_assoc()) {
                                if ($data_layanan['status'] == "Gangguan") {
                                    $badge = "danger";
                                } else if ($data_layanan['status'] == "Normal") {
                                    $badge = "success";
                                }
                            ?>
                                <tr>
                                    <td><?php echo $data_layanan['service_id']; ?></td>
                                    <td><?php echo $data_layanan['provider_id']; ?></td>
                                    <td><?php echo $data_layanan['operator']; ?></td>
                                    <td><?php echo $data_layanan['layanan']; ?></td>
                                    <td><?php echo $data_layanan['catatan']; ?></td>
                                    <td><b>Rp. <?php echo number_format($data_layanan['harga'], 0, ',', '.'); ?></b></td>
                                    <td><b>Rp. <?php echo number_format($data_layanan['harga_api'], 0, ',', '.'); ?></b></td>
                                    <td><b>Rp. <?php echo number_format($data_layanan['profit'], 0, ',', '.'); ?></b></td>
                                    <td><span class="badge badge-<?php echo $badge; ?>"><?php echo $data_layanan['status']; ?></span></td>
                                    <td><span class="badge badge-primary"><?php echo $data_layanan['provider']; ?></span></td>
                                    <td align="center">
                                        <a href="javascript:;" onclick="users('/admin-dashboard/ajax/layanan-pulsa/edit.php?id_layanan=<?php echo $data_layanan['id']; ?>')" class="btn btn-xs btn-warning"><i class="fa fa-pencil" title="Edit"></i> Update </a>
                                        <a href="javascript:;" onclick="users('/admin-dashboard/ajax/layanan-pulsa/delete.php?id_layanan=<?php echo $data_layanan['id']; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash" title="Hapus"></i> Delete </a>
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
                    $cek_layanan = $conn->query($cek_layanan);
                    $total_records = mysqli_num_rows($cek_layanan);
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
                            if (isset($_GET['search'])) {
                                $search = $conn->real_escape_string(filter($_GET['search']));
                                $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
                                echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=1&tampil=" . $cari_urut . "&search=" . $search . "'><<</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $previous . "&tampil=" . $cari_urut . "&search=" . $search . "'><</a></li>";
                            } else {
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
                        } else {
                            $limit_link = 3;
                        }
                        $limit_page = $current_page + $limit_link;
                        // end limit page
                        // start page
                        if ($current_page == 1) {
                            $start_page = 1;
                        } else if ($current_page > 1) {
                            if ($current_page < 4) {
                                $min_page  = $current_page - 1;
                            } else {
                                $min_page  = 3;
                            }
                            $start_page = $current_page - $min_page;
                        } else {
                            $start_page = $current_page;
                        }
                        // end start page
                        for ($i = $start_page; $i <= $limit_page; $i++) {
                            if (isset($_GET['search'])) {
                                $search = $conn->real_escape_string(filter($_GET['search']));
                                $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
                                if ($i == $current_page) {
                                    echo "<li class='active page-item'><a class='page-link' href='#'>" . $i . "</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $i . "&tampil=" . $cari_urut . "&search=" . $search . "'>" . $i . "</a></li>";
                                }
                            } else {
                                if ($i == $current_page) {
                                    echo "<li class='active page-item'><a class='page-link' href='#'>" . $i . "</a></li>";
                                } else {
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
                                echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $next . "&tampil=" . $cari_urut . "&search=" . $search . "'>></a></li>";
                                echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $total_pages . "&tampil=" . $cari_urut . "&search=" . $search . "'>>></a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $next . "'>></i></a></li>";
                                echo "<li class='page-item'><a class='page-link' href='" . $self . "?halaman=" . $total_pages . "'>>></a></li>";
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
        <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mt-0" id="myModalLabel"><i class="fa fa-list"></i> Layanan</h4>
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
<?php
require '../lib/footer_admin.php';
?>