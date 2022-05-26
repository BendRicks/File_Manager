<?php
$curr_dir = "";
$new_dir = $_POST['new_dir'];
if (isset($_COOKIE['curr_dir'])){
    $curr_dir = $_COOKIE['curr_dir'];
}
mkdir("D:/serverData".$curr_dir."/".$new_dir);
header("Location: /lab6_php_scripts");
