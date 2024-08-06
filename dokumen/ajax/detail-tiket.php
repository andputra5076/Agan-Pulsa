<?php
session_start();
require '../../config.php';
require '../../lib/session_user.php';
if (isset($_POST['id'])) {
    $post_id = $conn->real_escape_string($_POST['id']);
    $cek_pesan = $conn->query("SELECT * FROM tiket WHERE id = '$post_id'");
while ($data_pesan = $cek_pesan->fetch_assoc()) {
	if ($data_pesan['pengirim'] == "Admin") {
		$alert = "success";
		$text = "text-left";
		$pengirim = "Customer Services";
	} else {
		$alert = "info";
		$text = "text-right";
		$pengirim = $data_pesan['user'];
if (isset($_POST['id'])) {
    $post_idtarget = $conn->real_escape_string($_POST['id']);
    $cek_tiket = $conn->query("SELECT * FROM pesan_tiket WHERE id_tiket = '$post_idtarget'");
while ($data_tiket = $cek_tiket->fetch_assoc()) {
	if ($data_tiket['pengirim'] == "Admin") {
		$alert = "success";
		$text = "text-left";
		$pengirim = "Customer Services";
	} else {
		$alert = "info";
		$text = "text-right";
		$pengirim = $data_tiket['user'];
	}
?>

<div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                   <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right"><?php echo $data_pesan['user']; ?></span>
                      <span class="direct-chat-timestamp float-left"><?php echo tanggal_indo($data_pesan['date']); ?> <?php echo $data_pesan['time']; ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="../dokumen/assets/images/user-144-min.png">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      <?php echo nl2br($data_pesan['pesan']); ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->   
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left"><?php echo $data_tiket['user']; ?></span>
                      <span class="direct-chat-timestamp float-right"><?php echo tanggal_indo($data_tiket['date']); ?> <?php echo $data_tiket['time']; ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="../home/assets/src/img-min/logo/144x144.png">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      <?php echo $data_tiket['pesan']; ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                </div>
                <!--/.direct-chat-messages-->
                <?php }}}}}?>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary">Send</button>
                    </span>
                  </div>
                </form>
              </div>
              <!-- /.card-footer-->
