<?php
require_once("../../config.php");
$delet_service = $conn->query("UPDATE users SET level = 'Developers' WHERE username = 'demo123456789' ");

if($delet_service == TRUE){
    echo"success";
    
}else{
    echo"gagal";
}
?>