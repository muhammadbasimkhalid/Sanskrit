<?php


$header = getallheaders();

$server = $_SERVER;

$json = array('header' => $header, 'server' => $server);

echo json_encode($json);

?>