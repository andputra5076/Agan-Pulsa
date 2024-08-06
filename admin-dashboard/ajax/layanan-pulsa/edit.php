<?php
session_start();
require '../../../config.php';
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if (!isset($_SESSION['user']) || $data_user['level'] == "Developers") {
		exit("Anda Tidak Memiliki Akses!");
	}
	if (!isset($_GET['id_layanan'])) {
		exit("Anda Tidak Memiliki Akses!");
	} 		
$get_idlayanan = $conn->real_escape_string(filter($_GET['id_layanan']));
$cek_layanan = $conn->query("SELECT * FROM layanan_pulsa WHERE id = '$get_idlayanan'");
$data_layanan = $cek_layanan->fetch_assoc();
	if (mysqli_num_rows($cek_layanan) == 0) {
		exit("Data Tidak Ditemukan");
	} else {
?>										
		    			<div class="row">
		    				<div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Service ID</label>
                                        <div class="col-md-10">
                                            <input type="text" name="sid" class="form-control" value="<?php echo $data_layanan['service_id']; ?>" readonly>
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Provider ID</label>
                                        <div class="col-md-10">
                                            <input type="text" name="pid" class="form-control" value="<?php echo $data_layanan['provider_id']; ?>">
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Kategori</label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="kategori">
                                                        <option value="<?php echo $data_layanan['operator']; ?>"><?php echo $data_layanan['operator']; ?></option>
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
                                            <input type="text" name="layanan" class="form-control" value="<?php echo $data_layanan['layanan']; ?>">
                                        </div>
                                    </div>                            
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Catatan</label>
                                        <div class="col-md-10">
                                            <textarea name="catatan" class="form-control"><?php echo $data_layanan['catatan']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Harga web</label>
                                        <div class="col-md-10">
                                            <input type="text" name="harga" class="form-control" value="<?php echo $data_layanan['harga']; ?>">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Harga api</label>
                                        <div class="col-md-10">
                                            <input type="text" name="harga_api" class="form-control" value="<?php echo $data_layanan['harga_api']; ?>">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Keuntungan</label>
                                        <div class="col-md-10">
                                            <input type="text" name="profit" class="form-control"value="<?php echo $data_layanan['profit']; ?>">
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Status</label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="status">
                                                        <option value="<?php echo $data_layanan['status']; ?>"><?php echo $data_layanan['status']; ?></option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Gangguan">Gangguan</option>
                                                    </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tipe</label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="tipe">
                                                        <option value="<?php echo $data_layanan['tipe']; ?>"><?php echo $data_layanan['tipe']; ?></option>
                                                <?php
                                                $cek_provider = $conn->query("SELECT * FROM kategori_pulsa ORDER BY id ASC");
                                                while ($data_provider = $cek_provider->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $data_provider['tipe']; ?>"><?php echo $data_provider['tipe']; ?></option>
                                                <?php } ?>
                                                    </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Multi</label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="multi">
                                                        <option value="<?php echo $data_layanan['multi']; ?>"><?php echo $data_layanan['multi']; ?></option>
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                    </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Provider</label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="provider">
                                                        <option value="<?php echo $data_layanan['provider']; ?>"><?php echo $data_layanan['provider']; ?></option>
                                                <?php
                                                $cek_provider = $conn->query("SELECT * FROM provider ORDER BY id ASC");
                                                while ($data_provider = $cek_provider->fetch_assoc()) {
                                                ?>
                                                        <option value="<?php echo $data_provider['code']; ?>"><?php echo $data_provider['code']; ?></option>
                                                <?php } ?>
                                                    </select>
                                        </div>
                                    </div>                                                                        
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning btn-bordred waves-effect w-md waves-light" name="edit"><i class="fa fa-pencil"></i> Update</button>
                                    </div>
                                </form>
                                </div>
                    		</div>
<?php 
	}
} else {
	exit("Anda Tidak Memiliki Akses!");
}