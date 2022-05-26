<?php
$curr_dir = "";
if (isset($_COOKIE['curr_dir'])){
    $curr_dir = $_COOKIE['curr_dir'];
}
$file_path = "";
if (isset($_GET['fullpath'])){
    $file_path = $_GET['fullpath'];
} else {
    $file_path = "D:/serverData" . $curr_dir . "/" . $_GET['filename'];
}

if (file_exists($file_path)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
}
