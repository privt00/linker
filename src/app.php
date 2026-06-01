<?php

$resources = BASE_PATH . 'resources/';
$sites = $resources . 'sites/';
$auth = $resources . 'auth/';
$dashboard = $resources . 'dashboard/';

$api = BASE_PATH . 'src/api/';

if (isset($_GET['page'])) {

    $page = $_GET['page'];

    switch ($page) {

        default:
            include($sites . "404.php");
            break;

        //auth
        case "auth":
            include($auth . "auth.php");
            break;

        //dashboard
        case "dashboard":
            include($dashboard . "dashboard.php");
            break;

        //gcodes
        case "gcodes":
            include($dashboard . "gcodes.php");
            break;

        //api
        //login
        case "api_login":
            include($api . "login.php");
            break;

        //getTemp
        case "api_get_temp":
            include($api . "getTemp.php");
            break;

        //setTemp Hotend
        case "api_set_temp_hotend":
            include($api . "setTempHotend.php");
            break;

        //setTemp Bed
        case "api_set_temp_bed":
            include($api . "setTempBed.php");
            break;

        //get G-Codes
        case "get_gcodes":
            include($api . "getGcodes.php");
            break;

        //start Print
        case "start_print":
            include($api . "startPrint.php");
            break;

        //get Print Stats
        case "get_print_stats":
            include($api . "getPrintStats.php");
            break;
    }

}