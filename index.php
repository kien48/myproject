<?php
session_start();
if(!isset($_SESSION['giohang'])){
    $_SESSION['giohang'] = [];
}
include "env.php";
include "vendor/autoload.php";
include "commons/route.php";