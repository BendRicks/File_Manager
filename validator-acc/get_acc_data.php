<?php
function get_username($id)
{
    $mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
    $result = $mysqli->query("SELECT * FROM `users` WHERE `user_id` = '$id'")->fetch_assoc();
    $mysqli->close();
    if ($result) {
        return $result['username'];
    } else {
        return "(Данного пользователя не существует)";
    }
}

function get_password($id)
{
    $mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
    $password = $mysqli->query("SELECT * FROM `users` WHERE `user_id` = '$id'")->fetch_assoc()['password'];
    $mysqli->close();
    return $password;
}

function get_inv_user_id($id)
{
    $mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
    $id = $mysqli->query("SELECT * FROM `users` WHERE `user_id` = '$id'")->fetch_assoc()['invit_user_id'];
    $mysqli->close();
    return $id;
}

function get_inv_user_name($id){
    return get_username(get_inv_user_id($id));
}