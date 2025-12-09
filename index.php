<?php
include "config.php";
include "class/Database.php";
include "class/Form.php";

session_start();

$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';
$segments = explode('/', trim($path, '/'));

$mod = isset($segments[0]) ? $segments[0] : 'home';
$page = isset($segments[1]) ? $segments[1] : 'index';

$file = "module/{$mod}/{$page}.php";

include "template/header.php";

if (file_exists($file)) {
    include $file;
} else {
    echo '<div class="alert alert-danger">Modul tidak ditemukan: ' . $mod . '/' . $page . '</div>';
}

include "template/footer.php";
?>