<?php
$old_password = $_POST['oldpassword'];
$old_password = hash('sha512', $old_password."accpassword");
$new_password = $_POST['newpassword'];
$new_password_rep = $_POST['newpasswordrep'];
$id = $_COOKIE['user-id'];
$mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
$result = $mysqli->query("SELECT * FROM `users` WHERE `user_id` = '$id' AND `password` = '$old_password'")->fetch_assoc();
if ($result){
    if (mb_strlen($new_password) < 8) {
        setcookie('edit-password-state', 'Длина пароля должна быть минимум 8 символов', time() + 10, "/");
    } elseif (mb_strlen($new_password) > 52) {
        setcookie('edit-password-state', 'Длина пароля не может превышать 52 символа', time() + 10, "/");
    } elseif (strcmp($new_password, $new_password_rep) !== 0){
        setcookie('edit-password-state', 'Новые пароли не совпадают', time() + 10, "/");
    } else {
        $new_password = hash('sha512', $new_password."accpassword");
        $new_password_rep = hash('sha512', $new_password_rep."accpassword");
        $mysqli->query("UPDATE `users` SET `password` = '$new_password' WHERE `user_id` = '$id'");
        setcookie('edit-password-state', 'Пароль успешно поменян', time() + 10, "/");
    }
} else {
    setcookie('edit-password-state', 'Неверный старый пароль', time() + 10, "/");
}
$mysqli->close();
header("Location: /lab6_php_scripts/account_page.php");