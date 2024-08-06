<?php
session_start();
require '../config.php';
require '../lib/session_login_admin.php'; 
        if (isset($_POST['tambah'])) {
            $PostCode = $conn->real_escape_string(filter($_POST['nomer_hp']));
            $GetKey = $conn->real_escape_string(filter($_POST['token_wa']));
            $PosPrivate = $conn->real_escape_string(filter($_POST['status']));


            if (!$PostCode || !$GetKey || !$PosPrivate) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Harap Mengisi Semua Input Pada Form <br />');
            } else {
                if ($conn->query("INSERT INTO bot_whatsapp VALUES ('', '$PostCode', '$GetKey', '$PosPrivate')") == true) {
                    $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Berhasil Menambahkan Baru');
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
                }
            }
        } else if (isset($_POST['update'])) {
            $GetID = $conn->real_escape_string($_GET['this_id']);
            $PostCode = $conn->real_escape_string(filter($_POST['nomer_hp']));
            $GetKey = $conn->real_escape_string(filter($_POST['token_wa']));
            $PosPrivate = $conn->real_escape_string(filter($_POST['status']));
                if ($conn->query("UPDATE bot_whatsapp SET nomer_hp = '$PostCode',  token_wa = '$GetKey', status = '$PosPrivate' WHERE id = '$GetID'") == true) {
                    $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Berhasil Di Update');
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Sistem Error !!');
                }
        } else if (isset($_POST['hapus'])) {
            $GetID = $conn->real_escape_string($_GET['this_id']);
            $CheckData = $conn->query("SELECT * FROM bot_whatsapp WHERE id = '$GetID'");
            if ($CheckData->num_rows == 0) {
                $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data Tidak Di Temukan');
            } else {
                if ($conn->query("DELETE FROM bot_whatsapp WHERE id = '$GetID'") == true) {
                $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Berhasil Di Hapus');
                }
            }
        }

    require '../lib/header_admin.php';
?>        
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title m-t-0 id="myModalLabel""><i class="ri-shield-keyhole-line text-primary"></i> Tambah Wa-GateWay</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nomor WhatsApp</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nomer_wa" class="form-control" placeholder="nomer_wa">
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-md-10 control-label">Api Token</label>
                                        <div class="col-md-10">
                                            <input type="text" name="token_wa" class="form-control" placeholder="token_wa">
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Status</label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="status">
                                                        <option value="">Pilih Salah Satu...</option>
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Tidak Aktif">Tidak Aktif</option>
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
                                    <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ri-shield-keyhole-line text-primary"></i> Wa GateWay</h4><hr>
                                    <button data-toggle="modal" data-target="#addModal" class="btn btn-xs btn-primary btn-bordred waves-effect waves-light m-b-30"><i class="mdi mdi-plus-circle-outline"></i> Tambah</button> 
                                      <br/>
                                      <br/>                                     
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">

                                        <thead>
                                            <tr>
                                                <th width="1%">#</th>
                                                <th>No Wa</th>
                                                <th>Api Token</th>
                                                <th>status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$no = 1;
    $CallDB_Provider = $conn->query("SELECT * FROM bot_whatsapp ORDER BY id ASC"); // edit
    while ($ShowData = $CallDB_Provider->fetch_assoc()) {
?>                                        
                                            <tr>
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?this_id=<?php echo $ShowData['id']; ?>" class="form-inline" role="form" method="POST">
                                                <td scope="row"><?php echo $no++; ?></td>
                                                <td><input type="text" class="form-control" style="width: 100px;" name="nomer_hp" value="<?php echo $ShowData['nomer_hp']; ?>">
                                                </td>
                                                <td><input type="text" class="form-control" style="width: 200px;" name="token_wa" value="<?php echo $ShowData['token_wa']; ?>">
                                                </td>
                                                <td>
                                                <select class="form-control" style="width: 200px;" name="status">
                                                    <option value="<?php echo $ShowData['status']; ?>"><?php echo $ShowData['status']; ?></option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                                </select>
                                                <td align="center">
                                                <button data-toggle="tooltip" title="Update" type="submit" name="update" class="btn btn-xs btn-bordred btn-warning"><i class="fa fa-edit"></i> Update </button>
                                                <hr>
                                                <button data-toggle="tooltip" title="Hapus" type="submit" name="hapus" class="btn btn-xs btn-bordred btn-danger"><i class="fa fa-trash"></i> Delete </button>
                                                </td>
                                            </tr>
                                        </form>
<?php } ?>                                        
                                    </tbody>
                                </table>
                            </div>                                     
                        </div>
                    </div>
                </div> 
<?php require '../lib/footer_admin.php'; ?>
