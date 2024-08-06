<?php
session_start();
require '../config.php';
require '../lib/session_user.php';
require '../lib/header.php';
?>
<!--Title-->
<title>Dokumentasi API Pulsa dan PPOB di <?php echo $data['short_title']; ?></title>
<meta name="description" content="Dokumentasi API <?php echo $data['short_title']; ?> dapat Anda gunakan untuk melakukan pembelian sebagai reseller melalui web SMM dan PPOB oper dengan harga yang lebih murah."/>

<!--OG2-->
<meta content="Dokumentasi API Pulsa dan PPOB <?php echo $data['short_title']; ?>" property="og:title"/>
<meta content="Dokumentasi API <?php echo $data['short_title']; ?> dapat Anda gunakan untuk melakukan pembelian sebagai reseller melalui web SMM dan PPOB oper dengan harga yang lebih murah." property="og:description"/>
<meta content="<?php echo $data['short_title']; ?> - Dokumentasi API Pulsa dan PPOB <?php echo $data['short_title']; ?>" property="og:headline"/>
<meta content="<?php echo $config['web']['url'];?>assets/images/halaman/dokumentasi-api.png" property="og:image"/>
<meta content="Dokumentasi API Pulsa dan PPOB <?php echo $data['short_title']; ?>" property="twitter:title"/>
<meta content="Dokumentasi API <?php echo $data['short_title']; ?> dapat Anda gunakan untuk melakukan pembelian sebagai reseller melalui web SMM dan PPOB oper dengan harga yang lebih murah." property="twitter:description"/>
<meta content="<?php echo $config['web']['url'];?>assets/images/halaman/dokumentasi-api.png" property="twitter:image"/>

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h1 class="m-t-0 text-uppercase text-center header-title"> <b>DOKUMENTASI API PPOB H2H <?php echo $data['short_title']; ?></b></h1>
            <div class="box-content text-center">
                <a href="/halaman/api-dokumentasi-pulsa" title="<?php echo $data['short_title'];?>" alt="<?php echo $data['title'];?>"> </a>
            </div><br/>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <td>METODE HTTP</td>
                            <td>POST</td>
                        </tr>
                        <tr>
                            <td>API URL</td>
                            <td style="min-width: 200px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $config['web']['url']; ?>api/pulsa" id="target-<?php echo $config['oid']; ?>" readonly="">
                                        <button data-toggle="tooltip" title="Copy Target" class="btn-info" type="button" onclick="copy_to_clipboard('target-<?php echo $config['oid']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                    </div>
                                </td>
								</td>
                            </tr>
                        <tr>
                            <td>API KEY</td>
                            <td style="min-width: 200px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_user['api_key']; ?>" id="target2-<?php echo $data_user['oid']; ?>" readonly="">
                                        <button data-toggle="tooltip" title="Copy Target" class="btn-info" type="button" onclick="copy_to_clipboard('target2-<?php echo $data_user['oid']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                    </div>
                                </td>
								</td>
                        </tr>
                        <tr>
                            <td>FORMAT RESPON</td>
                            <td>JSON</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-dark header-title m-t-0">Melakukan <font color="#005CAA">Pemesanan</font></h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Parameter</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>API URL</td>
                                        <td style="min-width: 200px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $config['web']['url']; ?>api/pulsa" id="target3-<?php echo $config['oid']; ?>" readonly="">
                                        <button data-toggle="tooltip" title="Copy Target" class="btn-info" type="button" onclick="copy_to_clipboard('target3-<?php echo $config['oid']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                    </div>
                                </td>
								</td>
                                    </tr>
                                    <tr>
                                        <td>api_key</td>
                                        <td style="min-width: 200px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_user['api_key']; ?>" id="target4-<?php echo $data_user['oid']; ?>" readonly="">
                                        <button data-toggle="tooltip" title="Copy Target" class="btn-info" type="button" onclick="copy_to_clipboard('target4-<?php echo $data_user['oid']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                    </div>
                                </td>
								</td>
                                        </tr>
                                        <tr>
                                            <td>action</td>
                                            <td>pemesanan</td>
                                        </tr>
                                        <tr>
                                            <td>Layanan</td>
                                            <td>Service ID <a href="<?php echo $config['web']['url'];?>halaman/daftar-harga">Daftar Layanan</a></td>
                                        </tr>
                                        <tr>
                                            <td>target</td>
                                            <td>Target / Tujuan</td>
                                        </tr>
                                        <tr>
                                            <td>no_meter</td>
                                            <td>No HP (Jika Pemesanan Pulsa)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <b>Contoh Respon Yang Di Dapat</b><br />
                            <div class="alert alert-success-2">
<pre>
Jika Pemesanan Sukses
{
    "data": {
    "id": "401"
    }
}

Jika Pemesanan Gagal
{
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
        <!-- end col -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-dark header-title m-t-0">Melakukan <font color="#005CAA">Cek Status Pesanan</font></h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>API URL</td>
                                    <td style="min-width: 200px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $config['web']['url']; ?>api/pulsa" id="target5-<?php echo $config['oid']; ?>" readonly="">
                                        <button data-toggle="tooltip" title="Copy Target" class="btn-info" type="button" onclick="copy_to_clipboard('target5-<?php echo $config['oid']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                    </div>
                                </td>
								</td>
                                </tr>
                                <tr>
                                    <td>api_key</td>
                                    <td style="min-width: 200px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_user['api_key']; ?>" id="target6-<?php echo $data_user['oid']; ?>" readonly="">
                                        <button data-toggle="tooltip" title="Copy Target" class="btn-info" type="button" onclick="copy_to_clipboard('target6-<?php echo $data_user['oid']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                    </div>
                                </td>
								</td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>status</td>
                                    </tr>
                                    <tr>
                                        <td>id</td>
                                        <td>Order ID</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <b>Contoh Respon Yang Didapat</b><br />
                        <div class="alert alert-success-2">
<pre>
Jika Respon Sukses
{
    "data": {
    "id":"40",
    "status":"Success",
    "catatan":"SN : 09220xxxxxxxx"
    }
}

Jika Respon Gagal
{
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
    <!-- end col -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-dark header-title m-t-0">Mendapatkan <font color="#005CAA">Layanan</font></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>API URL</td>
                                <td style="min-width: 200px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $config['web']['url']; ?>api/pulsa" id="target7-<?php echo $config['oid']; ?>" readonly="">
                                        <button data-toggle="tooltip" title="Copy Target" class="btn-info" type="button" onclick="copy_to_clipboard('target7-<?php echo $config['oid']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                    </div>
                                </td>
								</td>
                            </tr>
                            <tr>
                                <td>api_key</td>
                                <td style="min-width: 200px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_user['api_key']; ?>" id="target8-<?php echo $data_user['oid']; ?>" readonly="">
                                        <button data-toggle="tooltip" title="Copy Target" class="btn-info" type="button" onclick="copy_to_clipboard('target8-<?php echo $data_user['oid']; ?>')"><i class="mdi mdi-content-copy"></i></button>
                                    </div>
                                </td>
								</td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>layanan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <b>Contoh Respon Yang Di Dapat</b><br />
                <div class="alert alert-success-2">
<pre>
Jika Respon Sukses
{
    "data": {
    "sid": "1"
    "operator": "TSEL"
    "layanan": "TSEL 50000"
    "harga": "51000"
    "status": "Normal"
    "keterangan": "Pulsa Telkomsel 5.000"
    }
}

Jika Respon Gagal
{
    "status": false,
    "data": {
    "pesan": "Permintaan Tidak Sesuai"
    }
}
</pre>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->

</div>
<!-- end container -->
</div>
<!-- end content -->

<?php
require '../lib/footer.php';
?>