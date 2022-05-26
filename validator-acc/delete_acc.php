<?php
$password = trim($_POST['password']);
$password = hash('sha512', $password."accpassword");
$mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
$id = $_COOKIE['user-id'];
$result = $mysqli->query("SELECT * FROM `users` WHERE `user_id` = '$id' AND `password` = '$password'")->fetch_assoc();
if ($result) {
    $result = $mysqli->query("SELECT * FROM `uploaded_files` WHERE `user_id` = '$id'");
    while ($file = mysqli_fetch_assoc($result)) {
        unlink($file['url']);
    };
    $mysqli->query("DELETE FROM `users` WHERE `user_id` = '$id'");
    setcookie('user-id', $id, time() - 3600 * 24, "/");
} else {
    setcookie('delete-acc-state', 'Неверный пароль', time() + 10, "/");
}
$mysqli->close();
header("Location: /lab6_php_scripts/account_page.php");