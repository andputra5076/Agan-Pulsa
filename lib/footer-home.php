<!-- Footer -->
                </div>
                </div>
            <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                               <b class="text-dark"><?php echo $data['short_title']; ?></b> &copy; 2022 <b class="text-primary"></b> | 
<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo 'Load Page <font color="black">'.$total_time.'</font> s';
?>
                            </div>
                        </div>
                    </div>
                </footer> 
            <!-- End Footer -->

        </div>
        <!-- end wrapper -->
  </div>
        <!-- end wrapper -->
 	<style>

        .float{
	position:fixed;
	width:50px;
	height:50px;
	bottom:18px;
	right:18px;
	background-color:#60f968;
	color:#FFF;
	border-radius:30px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:10px;
	margin-left:2px;
}
    
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=<?php echo $data['wa_number']; ?>&text=Halo" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
      <!--<script src="//code.tidio.co/8sf1egxukyiwnwpb09ch5fm0xj0ecdun.js" async></script>-->

        <script src="/assets/v1/jquery-3.2.1.min.js"></script>
        <script src="/ssets/v1/operator.js"></script>
        	
        <script src="/assets/v1/vendor.min.js"></script>
        
        <script src="/assets/v1/jquery.dataTables.min.js"></script>
        <script src="/assets/v1/dataTables.bootstrap4.js"></script>
        <script src="/assets/v1/dataTables.responsive.min.js"></script>
        <script src="/assets/v1/responsive.bootstrap4.min.js"></script>
        <script src="/assets/v1/dataTables.buttons.min.js"></script>
        <script src="/assets/v1/buttons.bootstrap4.min.js"></script>
        <script src="/assets/v1/buttons.html5.min.js"></script>
        <script src="/ssets/v1/buttons.flash.min.js"></script>
        <script src="/assets/v1/buttons.print.min.js"></script>
        <script src="/assets/v1/dataTables.keyTable.min.js"></script>
        <script src="/assets/v1/dataTables.select.min.js"></script>
        
        <!-- App js -->
        <script src="/assets/v1/app.min.js"></script>
    </body>
</html>