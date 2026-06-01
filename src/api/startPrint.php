<?php
require BASE_PATH . 'src/handlers/postURL.php';
header("Content-Type: application/json; charset=UTF-8");

$id = $_GET["id"];


echo postURL($_COOKIE["address"] . '/api/print/start/' . $id);


?>