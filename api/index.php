<?php
require 'TareaApi.php';
$api = new TareaApi($_REQUEST['request']);

echo $api->processAPI();
 ?>
