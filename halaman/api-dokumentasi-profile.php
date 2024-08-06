<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
require '../lib/header.php';
?>

<div class="row">
	<div class="col-lg-12">
		<div class="card"><div class="card-body">
			<h4 class="m-t-0 text-center header-title"><i class="ri-shuffle-line mr1 text-primary"></i> Dokumentasi API Profile</h4><hr>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="50%">METODE HTTP</th>
						<td>POST</td>
					</tr>
					<tr>
						<th>API URL</th>
						<td style="min-width: 220px;"><?php echo $config['web']['url']; ?>api/profile</td>
					</tr>
					<tr>
						<th>API KEY</th>
						
						<td style="min-width: 80px;">
                                            <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" value="<?php echo $data_user['api_key']; ?>" id="apikey-<?php echo $data_user['id']; ?>" readonly="">
                                            <button data-toggle="tooltip" title="Copy Apikey" class="btn btn-xs btn-primary" type="button" onclick="copy_to_clipboard('apikey-<?php echo $data_user['id']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                            </div>
                                               
						</td>
					</tr>
					<tr>
						<th>FORMAT RESPON</th>
						<td>JSON</td>
					</tr>
					<tr>
						<th>CONTOH <i>CLASS</i></th>
						<td><a href="https://pastebin.com/vVKms9Tt" target="_new" class="btn btn-sm btn-primary">PHP</a></td>
					</tr>
				</table>
			</div>
			
			<div class="tab-content">
				<div class="tab-pane show active" id="profile">
					<b>URL Permintaan</b>
					<div class="alert alert-info" style="margin: 10px 0; color: #000;">
						<?php echo $config['web']['url']; ?>api/profile				</div>
					<b>Parameter</b>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>Parameter</th>
								<th>Deskripsi</th>
							</tr>
							<tr>
								<td>api_key</td>
								<td>API KEY Anda</td>
							</tr>
							<tr>
								<td>action</td>
								<td><span class="badge badge-primary"> profile </span></td>
							</tr>
						</table>
					</div>
					<b>Contoh Respon</b>
					<div class="alert alert-warning" style="margin: 10px 0; color: #000;">
<b>Sukses</b>
<pre>{
  "data": {
          "nama": "namaakun",
          "username": "username",
          "email": "email@gmail.com",
          "sisa_saldo": "20.200",
          "total_pemakaian": "19.500"
          }
}
</pre>
<b>Gagal</b>
<pre>{
    "status": false,
    "data": {
        "pesan": "Permintaan Tidak Sesuai"
    }
}
</pre>
					</div>
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
                    
<?php
require '../lib/footer.php';
?>