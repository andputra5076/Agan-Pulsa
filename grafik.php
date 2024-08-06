<?php
session_start();
require("config.php");
require("lib/header.php");
 ?>
<!-- import library chart menggunakan cdn -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    </head>
<div class="container">
<div class="row">
<div class="col-12">
<div class="card card-body">    
  <h3>Line Chart</h3>
  <div id="line-chart7" height="150px"></div>
</div>
</div>
</div>
</div>
<?php
require 'lib/footer.php';
?>
<script type="text/javascript">
    $(function(){
        new Morris.Area({
            element: 'line-chart7',
            data: [
            <?php
            $list_tanggal = array();
            for ($i = 6; $i > -1; $i--) {
                $list_tanggal[] = date('Y-m-d', strtotime('-'.$i.' days'));
            }

            for ($i = 0; $i < count($list_tanggal); $i++) {
                $get_order_sosmed = $conn->query("SELECT * FROM pembelian_sosmed WHERE date = '".$list_tanggal[$i]."' AND user = '$sess_username' ");
                print("{ y: '".tanggal_indo($list_tanggal[$i])."', a: ".mysqli_num_rows($get_order_sosmed)." }, ");

            }
            ?>
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Pemesanan'],
            lineColors: ['#28a745'],
            gridLineColor: '#eef0f2',
            pointSize: 0,
            lineWidth: 0,
            resize: true,
            parseTime: false
        });
    });
</script> 
