<?php

setcookie("address", $_POST["address"], time() + (86400 * 30 * 30), "/");

header("Location: /dashboard");
die();

?>