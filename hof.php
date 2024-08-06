<?php
session_start();
require 'config.php';
require 'lib/session_user.php';
require 'lib/header.php';
// ===== Data Top Pengguna ===== //
    $Cek_Top_Pengguna1 = $conn->query("SELECT * FROM set_top_pengguna WHERE id = '1'");
    $Data_Top_Pengguna1 = $Cek_Top_Pengguna1->fetch_assoc();
// ===== Data Top Pengguna ===== //
    $Cek_Top_Pengguna2 = $conn->query("SELECT * FROM set_top_pengguna WHERE id = '2'");
    $Data_Top_Pengguna2 = $Cek_Top_Pengguna2->fetch_assoc();
// ===== Data Top Pengguna ===== //
    $Cek_Top_Pengguna3 = $conn->query("SELECT * FROM set_top_pengguna WHERE id = '3'");
    $Data_Top_Pengguna3 = $Cek_Top_Pengguna3->fetch_assoc(); 
// ===== Data Top Pengguna ===== //
    $Cek_Top_Pengguna4 = $conn->query("SELECT * FROM set_top_pengguna WHERE id = '4'");
    $Data_Top_Pengguna4 = $Cek_Top_Pengguna4->fetch_assoc();
// ===== Data Top Pengguna ===== //
    $Cek_Top_Pengguna5 = $conn->query("SELECT * FROM set_top_pengguna WHERE id = '5'");
    $Data_Top_Pengguna5 = $Cek_Top_Pengguna5->fetch_assoc();  
?>
      <div class="row">
         <div class="col-md-12 text-center">
           <h4>Top 5 Pengguna Pemesanan Bulan Ini</h4>
               <p>Kami <?php echo $data['short_title']; ?> Group mengucapkan terimakasih telah menjadi pelanggan setia di <?php echo $data['short_title']; ?></p>
        	  </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="m-t-0 text-uppercase text-center header-title"><i class="ti-medall text-primary"></i> Top Pembelian</h4><hr>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                    <tr>
                                        <th>TOP</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th style="min-width: 130px;">Nominal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><span class="badge badge-dark"><?php echo $Data_Top_Pengguna1['id']; ?></span></td>
                                        <td><?php echo $Data_Top_Pengguna1['nama']; ?></td>
                                        <td><?php echo $Data_Top_Pengguna1['jumlah']; ?> Pesanan</td>
                                        <td><span class="btn btn-success btn-xs"><b> Rp <?php echo $Data_Top_Pengguna1['nominal']; ?></span></b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge badge-dark"><?php echo $Data_Top_Pengguna2['id']; ?></span></td>
                                        <td><?php echo $Data_Top_Pengguna2['nama']; ?></td>
                                        <td><?php echo $Data_Top_Pengguna2['jumlah']; ?> Pesanan</td>
                                        <td><span class="btn btn-success btn-xs"><b> Rp <?php echo $Data_Top_Pengguna2['nominal']; ?></span></b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge badge-dark"><?php echo $Data_Top_Pengguna3['id']; ?></span></td>
                                        <td><?php echo $Data_Top_Pengguna3['nama']; ?></td>
                                        <td><?php echo $Data_Top_Pengguna3['jumlah']; ?> Pesanan</td>
                                        <td><span class="btn btn-success btn-xs"><b> Rp <?php echo $Data_Top_Pengguna3['nominal']; ?></span></b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge badge-dark"><?php echo $Data_Top_Pengguna4['id']; ?></span></td>
                                        <td><?php echo $Data_Top_Pengguna4['nama']; ?></td>
                                        <td><?php echo $Data_Top_Pengguna4['jumlah']; ?> Pesanan</td>
                                        <td><span class="btn btn-success btn-xs"><b> Rp <?php echo $Data_Top_Pengguna4['nominal']; ?></span></b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge badge-dark"><?php echo $Data_Top_Pengguna5['id']; ?></span></td>
                                        <td><?php echo $Data_Top_Pengguna5['nama']; ?></td>
                                        <td><?php echo $Data_Top_Pengguna5['jumlah']; ?> Pesanan</td>
                                        <td><span class="btn btn-success btn-xs"><b> Rp <?php echo $Data_Top_Pengguna5['nominal']; ?></span></b></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                                        </ul>
                        </div>
                    </div>
                </div>                    
             </div>      
<?php
require 'lib/footer.php';
?>