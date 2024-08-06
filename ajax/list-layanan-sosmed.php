<?php
/**
Script By KangHL
 */

require '../config.php';
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$table = 'layanan_sosmed';
	$primaryKey = 'id';

	$columns = array(
		array( 'db' => 'service_id', 'dt' => 0),
		array( 'db' => 'kategori', 'dt' => 1),
		array( 'db' => 'layanan', 'dt' => 2),
		array( 'db' => 'harga',  'dt' => 3, 'formatter' => function($i) {
			return "Rp ".number_format($i,0,',','.');
		}),
		array( 'db' => 'min',  'dt' => 4, 'formatter' => function($i) {
			return "".number_format($i,0,',','.');
		}),
		array( 'db' => 'max',  'dt' => 5, 'formatter' => function($i) {
			return "".number_format($i,0,',','.');
		}),
		array( 'db' => 'catatan', 'dt' => 6),
	);
	require '../lib/ssp.class.php';
	$sql_details = array(
		'user' => $config['db']['username'],
		'pass' => $config['db']['password'],
		'db'   => $config['db']['name'],
		'host' => $config['db']['host']
	);
	$joinQuery = null;
	$extraWhere = '';
	$groupBy = '';
	$having = '';
	print(json_encode(
		SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
	));
} else {
	exit("No direct script access allowed!");
}