<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php';

    if (isset($_POST['update'])) {
        $get_oid = $conn->real_escape_string($_GET['order_id']);
        $status = $conn->real_escape_string($_POST['status']);
        $s_count = $conn->real_escape_string($_POST['start_count']);
        $remains = $conn->real_escape_string($_POST['remains']);
        
        $cek_orders = $conn->query("SELECT * FROM pembelian_sosmed WHERE oid = '$get_oid'");
        $data_orders = $cek_orders->fetch_array(MYSQLI_ASSOC);
        
        if ($cek_orders->num_rows == 0) {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data Pesanan Tidak Ditemukan');
        } else {
            if ($conn->query("UPDATE pembelian_sosmed SET status = '$status', start_count = '$s_count', remains = '$remains'  WHERE oid = '$get_oid'") == true){
                $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Data Pesanan Berhasil Di Update 
                    <br /> Order ID : '.$get_oid.'
                    <br /> Status : '.$status.'
                    <br /> Start Count : '.$s_count.'
                    <br /> Remains : '.$remains.'');
            } else {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Gagal');
            }
        }
    } else if (isset($_POST['hapus'])) {
        $get_oid = $conn->real_escape_string($_GET['order_id']);
        $cek_orders = $conn->query("SELECT * FROM pembelian_sosmed WHERE oid = '$get_oid'");
        
        if ($cek_orders->num_rows == 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data Pesanan Tidak Ditemukan');
        } else {
            if ($conn->query("DELETE FROM pembelian_sosmed WHERE oid = '$get_oid'") == TRUE) {
                $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Data Pesanan Berhasil Di Hapus 
                    <br /> Order ID : '.$get_oid.'');
            }
        }
    }
require '../lib/header_admin.php';
?>
<?php
$tanggal = date("Y-m-d");
$waktu = date("H:i:s");
$jumlah_hari_ini = mysqli_num_rows($conn->query("SELECT * FROM pembelian_sosmed WHERE date = '$date'"));

$total_hari_ini = $conn->query("SELECT SUM(harga) AS total FROM pembelian_sosmed WHERE date = '$date'");
$data_hari_ini = $total_hari_ini->fetch_assoc();
//Hari ini
?>
                        <div class="row">
                   <div class="col-md-6 col-xl-4">
                       <div class="widget-rounded-circle card-box">
                            <div class="row">
                                <div class="col-6">
                                <br>
                                    <div class="avatar-lg rounded-circle bg-soft-danger">
                                        <i class="ri-shopping-cart-2-line font-24 avatar-title text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h4 class="text-dark mt-1"><span>Rp <?php echo number_format($data_pesanan_sosmed['total'],0,',','.'); ?> <br> ( <?php echo $count_pesanan_sosmed; ?> )</span></h4>
                                        <p class="text-muted mb-1 text-truncate"> Total pemesanan <br> hari ini</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                    <div class="col-md-6 col-xl-4">
                        <div class="widget-rounded-circle card-box">
                            <div class="row">
                                <div class="col-6">
                                  <br>
                                    <div class="avatar-lg rounded-circle bg-soft-info">
                                        <i class="ri-shopping-cart-2-fill font-24 avatar-title text-info"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <h4 class="text-dark mt-1"><span>Rp <?php echo number_format($data_hari_ini['total'],0,',','.'); ?> <br> ( <?php echo $jumlah_hari_ini; ?> )</span></h4>
                                        <p class="text-muted mb-1 text-truncate"> Total pemesanan <br> hari ini</p>
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
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ri-shopping-cart-2-line text-primary"></i> Daftar Pemesanan Sosial Media</h4><hr>
                                        <form>
                                            <div class="row">
                                                <div class="form-group col-lg-3">
                                                    <label>Tampilkan Beberapa</label>
                                                    <select class="form-control" name="tampil">
                                                        <option value="10">10</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                        <option value="250">250</option>
                                                    </select>
                                                </div>                                                
                                                <div class="form-group col-lg-3">
                                                    <label>Filter Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="">Semua</option>
                                                        <option value="Pending" >Pending</option>
                                                        <option value="Processing" >Processing</option>
                                                        <option value="In Progress" >In Progress</option>
                                                        <option value="Success" >Success</option>
                                                        <option value="Error" >Error</option>
                                                        <option value="Partial" >Partial</option>
                                                    </select>
                                                </div>                                                
                                                <div class="form-group col-lg-3">
                                                    <label>Cari Order ID</label>
                                                    <input type="text" class="form-control" name="cari" placeholder="Cari Order ID" value="">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Submit</label>
                                                    <button type="submit" class="btn btn-block btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Provider OID</th>
                                        <th>Pengguna</th>
                                        <th>Waktu Pemesanan</th>
                                        <th>Layanan</th>
                                        <th>Target</th>
                                        <th>Jumlah Pemesanan</th>
                                        <th>Start Count</th>
                                        <th>Remains</th>
                                        <th>Harga</th>
                                        <th width="150%">Status</th>
                                        <th>API</th>
                                        <th>Provider</th>
                                        <th>Refund</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
<?php 
// start paging config
if (isset($_GET['cari'])) {
    $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
    $cari_status = $conn->real_escape_string(filter($_GET['status']));

    $cek_pesanan = "SELECT * FROM pembelian_sosmed WHERE oid LIKE '%$cari_oid%' AND status LIKE '%$cari_status%' ORDER BY id DESC"; // edit
} else {
    $cek_pesanan = "SELECT * FROM pembelian_sosmed ORDER BY id DESC"; // edit
}
if (isset($_GET['cari'])) {
$cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
$records_per_page = $cari_urut; // edit
} else {
    $records_per_page = 10; // edit
}

$starting_position = 0;
if(isset($_GET["halaman"])) {
    $starting_position = ($conn->real_escape_string(filter($_GET["halaman"]))-1) * $records_per_page;
}
$new_query = $cek_pesanan." LIMIT $starting_position, $records_per_page";
$new_query = $conn->query($new_query);
// end paging config
while ($data_pesanan = $new_query->fetch_assoc()) {
?>
                                    <tr>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?order_id=<?php echo $data_pesanan['oid']; ?>" class="form-inline" role="form" method="POST"> 
                                        <td><?php echo $data_pesanan['oid']; ?></td>
                                        <td><?php echo $data_pesanan['provider_oid']; ?></td>
                                        <td><?php echo $data_pesanan['user']; ?></td>
                                        <td><?php echo tanggal_indo($data_pesanan['date']); ?>, <?php echo $data_pesanan['time']; ?></td>
                                        <td><?php echo $data_pesanan['layanan']; ?></td>
                                        <td style="min-width: 200px;">
                                            <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" value="<?php echo $data_pesanan['target']; ?>" id="target-<?php echo $data_pesanan['oid']; ?>" readonly="">
                                            <button data-toggle="tooltip" title="Copy Target" class="btn btn-xs btn-primary" type="button" onclick="copy_to_clipboard('target-<?php echo $data_pesanan['oid']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                            </div>
                                        </td>
                                        <td><?php echo $data_pesanan['jumlah']; ?></td>
                                        <td><input type="text" class="form-control" style="width: 75px;" name="start_count" value="<?php echo $data_pesanan['start_count']; ?>">
                                        </td>
                                        <td><input type="text" class="form-control" style="width: 75px;" name="remains" value="<?php echo $data_pesanan['remains']; ?>">
                                        </td>
                                        <td>Rp <?php echo number_format($data_pesanan['harga'],0,',','.'); ?></td>
                                                                               
                                        <td>
                                            <select class="form-control" style="width: 100px;" name="status">
                                            <?php if ($data_pesanan['status'] == "Success") { ?>
                                                <option value="<?php echo $data_pesanan['status']; ?>"><?php echo $data_pesanan['status']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $data_pesanan['status']; ?>"><?php echo $data_pesanan['status']; ?></option>
                                                <option value="Pending">Pending</option>
                                                <option value="Processing">Processing</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Success">Success</option>
                                                <option value="Error">Error</option>
                                                <option value="Partial">Partial</option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                        </td>                                        
                                        <td><?php if($data_pesanan['place_from'] == "API") { ?><span class="badge badge-success"><i class="fa fa-check"></i></span><?php } else { ?><span class="badge badge-danger"><i class="fa fa-times"></i></span><?php } ?></td>
                                        <td><?php echo $data_pesanan['provider']; ?></td>
                                        <td><?php if($data_pesanan['refund'] == "1") { ?><span class="badge badge-success"><i class="fa fa-check"></i></span><?php } else { ?><span class="badge badge-danger"><i class="fa fa-times"></i></span><?php } ?></td>
                                        <td align="center">
                                            <a href="javascript:;" onclick="pembelian_sosmed('/admin-dashboard/ajax/order/view-sosmed.php?oid=<?php echo $data_pesanan['oid']; ?>')" class="btn btn-xs btn-primary"><i class="fa fa-eye" title="view"></i> View </a>
                                            <button data-toggle="tooltip" title="Update" type="submit" name="update" class="btn btn-xs btn-bordred btn-warning"><i class="fa fa-edit"></i> Edit </button>
                                            <button data-toggle="tooltip" title="Hapus" type="submit" name="hapus" class="btn btn-xs btn-bordred btn-danger"><i class="ri-delete-bin-5-line"></i> Delete </button>
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
} else {
$cari_urut =  10;
}  
if (isset($_GET['cari'])) {
    $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
    $cari_status = $conn->real_escape_string(filter($_GET['status']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
} else {
    $self = $_SERVER['PHP_SELF'];
}
$cek_pesanan = $conn->query($cek_pesanan);
$total_records = mysqli_num_rows($cek_pesanan);
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
    if (isset($_GET['cari'])) {
    $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
    $cari_status = $conn->real_escape_string(filter($_GET['status']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=1&tampil=".$cari_urut."&status=".$cari_status."&cari=".$cari_oid."'><<</a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$previous."&tampil=".$cari_urut."&status=".$cari_status."&cari=".$cari_oid."'><</a></li>";
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
    if (isset($_GET['cari'])) {
    $cari_oid = $conn->real_escape_string(filter($_GET['cari']));
    $cari_status = $conn->real_escape_string(filter($_GET['status']));
    $cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
        if($i==$current_page) {
            echo "<li class='active page-item'><a class='page-link' href='#'>".$i."</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$i."&tampil=".$cari_urut."&status=".$cari_status."&cari=".$cari_oid."'>".$i."</a></li>";
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
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$next."&tampil=".$cari_urut."&status=".$cari_status."&cari=".$cari_oid."'>></a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$total_pages."&tampil=".$cari_urut."&status=".$cari_status."&cari=".$cari_oid."'>>></a></li>";
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
        function pembelian_sosmed(url) {
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
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ri-shopping-cart-2-line text-primary"></i> Detail Pemesanan sosial media</h4>
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