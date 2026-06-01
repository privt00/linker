<?php
require BASE_PATH . 'src/handlers/fetchURL.php';
header("Content-Type: application/json; charset=UTF-8");


echo fetchURL($_COOKIE["address"] . '/api/gcodes');

?>