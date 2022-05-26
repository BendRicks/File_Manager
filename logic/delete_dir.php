<?php
$curr_dir = $_COOKIE['curr_dir'];
$pieces = explode("/", $curr_dir);
$new_dir = "";
for ($i = 0; $i < count($pieces) - 1; $i++){
    if (strcmp($pieces[$i], "") !== 0) {
        $new_dir = $new_dir . "/" . $pieces[$i];
    }
}
setcookie('curr_dir', $new_dir, time() + 3600 * 24, "/");
rmdir("D:/serverData".$curr_dir);
header("Location: /lab6_php_scripts");