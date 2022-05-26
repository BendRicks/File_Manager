<?php
$new_username = trim($_POST['newlogin']);
$password = trim($_POST['password']);
$password = hash('sha512', $password."accpassword");
$id = $_COOKIE['user-id'];
$mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
$mysqli->set_charset("utf8");
$new_username = $mysqli->real_escape_string($new_username);
$result = $mysqli->query("SELECT * FROM users WHERE `user_id` = '$id' AND `password` = '$password'")->fetch_assoc();
if ($result) {
    $result = $mysqli->query("SELECT * FROM users WHERE `username` = '$new_username'")->fetch_assoc();
    if ($result) {
        setcookie('edit-nick-state', 'Такой пользователь уже существует', time() + 10, "/");
    } else {
        $mysqli->query("UPDATE `users` SET `username` = '$new_username' WHERE `user_id` = '$id'");
        setcookie('edit-nick-state', 'Успешно поменян', time() + 10, "/");
    }
} else {
    setcookie('edit-nick-state', 'Неверный пароль', time() + 10, "/");
}
$mysqli->close();
header("Location: /lab6_php_scripts/account_page.php");