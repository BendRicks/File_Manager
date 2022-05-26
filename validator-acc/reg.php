<?php
$username = trim($_POST['login']);
$password = trim($_POST['password']);
$repPassword = trim($_POST['password-repeat']);
$invPassword = trim($_POST['inv-password']);

if (mb_strlen($username) < 4) {
    setcookie('reg-error-description', 'Длина логина должна быть минимум 4 символа', time() + 10, "/");
} elseif (mb_strlen($username) > 100) {
    setcookie('reg-error-description', 'Длина логина не может превышать 100 символов', time() + 10, "/");
} elseif (mb_strlen($password) < 8) {
    setcookie('reg-error-description', 'Длина пароля должна быть минимум 8 символов', time() + 10, "/");
}elseif (mb_strlen($password) > 52) {
    setcookie('reg-error-description', 'Длина пароля не может превышать 52 символа', time() + 10, "/");
} elseif (strcmp($password, $repPassword) != 0) {
    setcookie('reg-error-description', 'Пароли не совпадают', time() + 10, "/");
} else {
    $password = hash('sha512', $password . 'accpassword');
    $repPassword = hash('sha512', $repPassword . 'accpassword');
    $invPassword = hash('sha512', $invPassword . 'invpassword');
    $mysql = new mysqli('localhost', 'root', 'password', 'usersdb');
    $mysql->set_charset("utf8");
    $username = $mysql->real_escape_string($username);
    $result = $mysql->query("SELECT * FROM `users` WHERE `username` = '$username'")->fetch_assoc();
    if ($result && count($result) > 0) {
        setcookie('reg-error-description', 'Такой пользователь уже существует', time() + 10, "/");
    } else {
        $result = $mysql->query("SELECT * FROM `invit_codes` WHERE `invit_code` = '$invPassword'")->fetch_assoc();
        if ($result && isset($result['user_id'])) {
            $inv_user = $result['user_id'];
            $mysql->query("INSERT INTO `users` (`username`, `password`, `invit_user_id`) VALUES ('$username', '$password', '$inv_user')");
            $result = $mysql->query("SELECT * FROM `users` WHERE `username` = '$username'")->fetch_assoc()['user_id'];
            setcookie('user-id', $result, time() + 3600 * 24, "/");
        } else {
            setcookie('reg-error-description', 'Неверный пригласительный код', time() + 10, "/");
        }
    }
    $mysql->close();
}
    header('Location: /lab6_php_scripts/registration.php');
