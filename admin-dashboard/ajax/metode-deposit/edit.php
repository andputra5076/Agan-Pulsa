<?php
session_start();
require '../../../config.php';
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if (!isset($_SESSION['user']) || $data_user['level'] == "Developers") {
		exit("Anda Tidak Memiliki Akses!");
	}
	if (!isset($_GET['data'])) {
		exit("Anda Tidak Memiliki Akses!");
	} 		
$get_id = $conn->real_escape_string(filter($_GET['data']));
$cek_depo = $conn->query("SELECT * FROM metode_depo WHERE id = '$get_id'");
$data_depo = $cek_depo->fetch_assoc();
	if (mysqli_num_rows($cek_depo) == 0) {
		exit("Data Tidak Ditemukan");
	} else {
?>										
		    			<div class="row">
		    				<div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">ID</label>
                                        <div class="col-md-10">
                                            <input type="text" name="id" class="form-control" value="<?php echo $data_depo['id']; ?>" readonly>
                                        </div>
                                    </div>                                      
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tipe Provider</label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="tipe">
                                                        <option value="<?php echo $data_depo['tipe']; ?>"><?php echo $data_depo['tipe']; ?></option>
                                                        <option value="Pulsa Transfer">Pulsa Transfer</option>
                                                        <option value="Bank">Bank</option>
                                                    </select>
                                        </div>
                                    </div>     
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Provider</label>
                                        <div class="col-md-10">
                                            <input type="text" name="provider" class="form-control" value="<?php echo $data_depo['provider']; ?>">
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label class="col-md-10 control-label">Nama Provider</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nama" class="form-control" value="<?php echo $data_depo['nama']; ?>">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Rate</label>
                                        <div class="col-md-10">
                                            <input type="text" name="rate" class="form-control" value="<?php echo $data_depo['rate']; ?>">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tujuan</label>
                                        <div class="col-md-10">
                                            <input type="text" name="tujuan" class="form-control" value="<?php echo $data_depo['tujuan']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Min</label>
                                        <div class="col-md-10">
                                            <input type="text" name="min" class="form-control" value="<?php echo $data_depo['min']; ?>">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Max</label>
                                        <div class="col-md-10">
                                            <input type="text" name="max" class="form-control" value="<?php echo $data_depo['max']; ?>">
                                        </div>
                                    </div> 
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning btn-bordred waves-effect w-md waves-light" name="edit"><i class="fa fa-pencil"></i> Edit</button>
                                    </div>
                                </form>
                                </div>
                    		</div>
<?php 
	}
} else {
	exit("Anda Tidak Memiliki Akses!");
}