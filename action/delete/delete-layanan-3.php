<?php
require_once("../../config.php");
$delet_service=mysqli_query($conn, "TRUNCATE TABLE kategori_layanan3 ");
$delet_service=mysqli_query($conn, "TRUNCATE TABLE layanan_sosmed3 ");
if($delet_service == TRUE){
    echo"success";
    
}else{
    echo"gagal";
}
?>