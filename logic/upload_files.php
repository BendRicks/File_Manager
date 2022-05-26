<?php
$mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
foreach ($_FILES["files"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["files"]["tmp_name"][$key];
        $name = basename($_FILES["files"]["name"][$key]);
        $curr_dir = "";
        if (isset($_COOKIE['curr_dir'])){
            $curr_dir = $_COOKIE['curr_dir'];
        }
        $file_dir = "D:/serverData".$curr_dir."/".$name;
        move_uploaded_file($tmp_name, $file_dir);
        $id = $_COOKIE['user-id'];
        $mysqli->query("INSERT INTO `uploaded_files` (`user_id`, `url`) VALUES ('$id', '$file_dir')");
    }
}
$mysqli->close();
header("Location: /lab6_php_scripts");