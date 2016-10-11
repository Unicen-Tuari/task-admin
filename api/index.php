<?php

require_once('TareaApi.php');

try{
  $api = new TareaApi($_REQUEST['request']);
  echo $api->processAPI();
} catch (Exception $e) {
  echo json_encode(Array('error' => $e->getMessage()));
}


?>
