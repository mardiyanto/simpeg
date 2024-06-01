<?php

require 'init.php';

$_ws = new WS();

include '../koneksi.php'; 
$query="SELECT * FROM `setting` where id='1'"; 
$roware=array(); 
$result=mysqli_query($koneksi, $query); 
while ($row = $result->fetch_assoc()) 
{ $roware[]=$row; 
 } 
$_ws->username = $koneksi -> real_escape_string($roware[0]['username']);
$_ws->password = $koneksi -> real_escape_string($roware[0]['pwd']);

$_ws->url = $koneksi -> real_escape_string($roware[0]['url']).'/ws/';

$data = [
	'act' => 'GetToken',
	'username' => $_ws->username,
	'password' => $_ws->password
];

$_result = json_decode($_ws->execute($data));

$_token = $_result->data->token;

$no=0;
$filter = "";
$order = '';
$limit = '100';
$offset = '';
$dictejum = [
	'act' => 'GetProfilPT',
	'token' => $_token,
	'filter' => $filter, 'order' => $order, 'limit' => $limit, 'offset' => $offset
];
$dataprodi = json_decode($_ws->execute($dictejum));
foreach ($dataprodi->data as $datas => $d);
?>