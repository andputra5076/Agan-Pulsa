<?php
require '../mainconfig.php';
require '../lib/check_session.php';
require '../lib/csrf_token.php';
require '../lib/is_login.php';
if (isset($_SESSION['login']) AND $config['web']['maintenance'] == 1) {
	exit("<center><h1>SORRY, WEBSITE IS UNDER MAINTENANCE!</h1></center>");
}
require '../lib/header.php';
?>
<script type="text/javascript">
  $(document).ready(function() { 
      $("#ajax-result").submit(function(e) {
          var data = $("#data").val();
          var category = $("#category").val();
          e.preventDefault();
          $.ajax({
              url: '<?php echo $config['web']['base_url'] ?>ajax/cek-tagihan/pdam.php',
              type: 'POST',
              data: 'data=' + data + '&type=PDAM' + '&category=' + category,
              beforeSend: function(){
                $('#service').html("<center><img style='position:pixed;' src='<?php echo $config['web']['base_url']; ?>dist/images/loader-unscreen.gif'/></center>");
              },
              success: function(data) {               
              document.getElementById("ajax-result").reset();
              $('#service').html(data);
              }
          });
      });
  })
 </script>
<div class="header-large-title pt-5"><header class="no-border text-light">
                        <left>
                <a href="/" class="headerButton">
                    <em class="ri-arrow-left-s-line"></em>
                                        <pagetitle>PDAM</pagetitle>
                </a>
            </left>
            <right></right>
                    </header></div>
<form class="form-horizontal" method="POST" id="ajax-result">
    <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                  <section class="card-section pt-2 wd-100">
                      <card style="border-radius: .90rem">
                          <card-body style="padding-top: 6px; padding-bottom: 6px">
                                <label>Kategori</label>
		                            <select style="border-radius: .40rem" class="form-control" id="category" name="service">
				                    <option value="0">Pilih...</option>
                                        <?php
                                        $category = $model->db_query($db, "*", "service_cat_pasca", "type = 'PDAM'", "name ASC");
                                        if ($category['count'] == 1) {
	                                        print('<option value="'.$category['rows']['code'].'">'.$category['rows']['name'].'</option>');
                                        } else {
                                            foreach ($category['rows'] as $key) {
	                                        print('<option value="'.$key['code'].'">'.$key['name'].'</option>');
                                        }
                                        }
                                        ?>
			                    </select>
                                <div class="form-group">
                                  <label>Masukkan Nomor Pelanggan</label>
                                  <div class="input-group input-group-fade">
                                  <input ttype="number" class="form-control" id="data" name="data">
                                  <div class="input-group-append">
                                      <button class="btn btn-outline-default btn-bold pull-right text-right" type="submit">Cek Tagihan</button>
                                    </div>
                                </div>
                                </div>
                          </card-body>
                      </card>
                  </section>
                  <section class="wd-100 pt-3">
                    <div id="service"></div>
                  </section>
            </form>
    </div>
</div>

<?php
require '../lib/footer.php';
?>