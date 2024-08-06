<?php
	if (!isset($_SESSION['user'])) {
		$_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Autentikasi dibutuhkan', 'pesan' => 'Silahkan Login Terlebih Dahulu.');
		exit(header("Location: ".$config['web']['url']."auth/login.php"));
	}