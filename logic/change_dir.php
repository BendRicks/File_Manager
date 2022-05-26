<?php
$tmp = $_GET['dir'];
$new_dir = "";
if (isset($_COOKIE['curr_dir'])) {
    $new_dir = $_COOKIE['curr_dir'];
}
if (strcmp($tmp, ".") === 0){
    $new_dir = "";
} elseif (strcmp($tmp, "..") === 0) {
    $pieces = explode("/", $new_dir);
    $new_dir = "";
    for ($i = 0; $i < count($pieces) - 1; $i++){
        if (strcmp($pieces[$i], "") !== 0) {
            $new_dir = $new_dir . "/" . $pieces[$i];
        }
    }
} else {
    $new_dir = $new_dir . $tmp;
}
setcookie('curr_dir', $new_dir, time() + 3600 * 24, "/");
header("Location: /lab6_php_scripts");
