<?php
require BASE_PATH . 'src/handlers/postURL.php';
header("Content-Type: application/json; charset=UTF-8");

$target = $_GET["target"];

  $data = <<<DATA
  {
      "target": $target
  }
  DATA;


echo postURL($_COOKIE["address"] . '/api/temperature/bed', $data);



?>