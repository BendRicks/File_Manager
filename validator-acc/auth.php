<?php
$username = trim($_POST['login']);
$password = trim($_POST['password']);
$password = hash('sha512', $password."accpassword");

$mysql = new mysqli('localhost', 'root', 'password', 'usersdb');
$mysql->set_charset("utf8");
$username = $mysql->real_escape_string($username);
$result = $mysql->query("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'")->fetch_assoc();
if (!$result || count($result) == 0) {
    setcookie('auth-error-description', 'Неверное имя пользователя или пароль', time() + 10, "/" );
} else {
    setcookie('user-id', $result['user_id'], time() + 3600 * 24, "/");
}
$mysql->close();
header('Location: /lab6_php_scripts/');
