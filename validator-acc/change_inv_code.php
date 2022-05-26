<?php
$code = trim($_POST['code']);
if (mb_strlen($code) >= 8) {
    $code = hash('sha512', $code . "invpassword");
    $mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
    $mysqli->set_charset("utf8");
    $code = $mysqli->real_escape_string($code);
    $result = $mysqli->query("SELECT * FROM `invit_codes` WHERE `invit_code` = '$code'")->fetch_assoc();
    if ($result){
        setcookie('edit-inv-code-state', 'Такой код уже существует', time() + 10, "/");
    } else {
        $id = $_COOKIE['user-id'];
        $result = $mysqli->query("SELECT * FROM `invit_codes` WHERE `user_id` = '$id'")->fetch_assoc();
        if ($result) {
            $mysqli->query("UPDATE `invit_codes` SET `invit_code` = '$code' WHERE `user_id` = '$id'");
            setcookie('edit-inv-code-state', 'Успешно поменян', time() + 10, "/");
        } else {
            $mysqli->query("INSERT INTO `invit_codes` (`user_id`, `invit_code`) VALUES ('$id', '$code')");
            setcookie('edit-inv-code-state', 'Успешно создан', time() + 10, "/");
        }
    }
} else {
    setcookie('edit-inv-code-state', 'Пригласительный код должен быть больше 8 символов', time() + 10, "/");
}
$mysqli->close();
header("Location: /lab6_php_scripts/account_page.php");