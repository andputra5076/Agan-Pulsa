<?php
require_once("../../config.php");
$delet_service=mysqli_query($conn, "TRUNCATE TABLE kategori_layanan2 ");
$delet_service=mysqli_query($conn, "TRUNCATE TABLE layanan_sosmed2 ");
if($delet_service == TRUE){
    echo"success";
    
}else{
    echo"gagal";
}
?>