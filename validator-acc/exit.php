<?php
setcookie('user-id', $_COOKIE['user-id'], time() - 3600 * 24, "/");
if (isset($_COOKIE['curr_dir'])) {
    setcookie('curr_dir', '', time() - 3600 * 24, "/");
}
header('Location: /lab6_php_scripts/');
