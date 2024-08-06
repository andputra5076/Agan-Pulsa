<?php
require_once("../../config.php");
$delet_service=mysqli_query($conn, "TRUNCATE TABLE kategori_pulsa ");
$delet_service=mysqli_query($conn, "TRUNCATE TABLE layanan_pulsa ");
if($delet_service == TRUE){
    echo"success";
    
}else{
    echo"gagal";
}
?>