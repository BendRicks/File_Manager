<?php
$mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
$id = $_COOKIE['user-id'];
$url = $_GET['fullpath'];
$mysqli->query("DELETE FROM `uploaded_files` WHERE `user_id` = '$id' AND `url` = '$url'");
unlink($url);
$mysqli->close();
header("Location: /lab6_php_scripts/uploaded_files.php");
