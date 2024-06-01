<?php 
  include '../koneksi.php';
  include '../config/initsoap.php';
  $filter = '';
  $order = '';
  $limit = '1';
  $offset = '';
  $dictejum = [
      'act' => 'DetailBiodataDosen',
      'token' => $_token,
      'filter' => $filter, 
      'order' => $order, 
      'limit' => $limit, 
      'offset' => $offset
  ];
  $datajson = json_decode($_ws->execute($dictejum), true);
  
  $response = [
      'error_code' => 0,
      'error_desc' => '',
      'jumlah' => count($datajson['data']),
      'data' => $datajson['data']
  ];
  $array_data = [
      'error_code' => $response['error_code'],
      'error_desc' => $response['error_desc'],
      'jumlah' => $response['jumlah'],
      'data' => $response['data']
  ];
  echo json_encode($array_data, JSON_PRETTY_PRINT);                  
?>
