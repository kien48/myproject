<?php
session_start();

require_once "env.php";
require_once "vendor/autoload.php";
require_once "commons/route.php";


// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
}
?>
