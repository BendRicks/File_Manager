<?php
require_once "validator-acc/get_acc_data.php";
if (isset($_COOKIE['user-id'])) {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="content/favicon.ico" type="image/x-icon"/>
</head>
<body>
<header class="fm-header">
    <div class="fm-header-content">
        <nav class="header-nav">
            <ul>
                <li><a class="header-btn" href="logic/change_dir.php?dir=.">Корень</a></li>
                <li><a class="header-btn" href="index.php">Проводник</a></li>
                <li><a class="header-btn" href="uploaded_files.php">Загруженные файлы</a></li>
            </ul>
        </nav>
        <a class="header-btn" href="account_page.php"><?= get_username($_COOKIE['user-id']) ?></a>
    </div>
</header>
<div class="content-container">
    <div class="content-body-2 pd-00">
        <p>Вы были приглашены: <?=get_inv_user_name($_COOKIE['user-id']) ?></p>
        <div class="change-block change-block-mgpds">
            <form method="post" action="validator-acc/change_nick.php">
                <label for="newlogin">Новый логин</label><input type="text" class="form-control s-input"
                                                                id="newlogin"
                                                                name="newlogin" placeholder="Новый логин">
                <label for="password">Пароль</label><input type="password" id="password" name="password"
                                                           class="form-control s-input"
                                                           placeholder="Пароль">
                <input type="submit" class="btn btn-success" value="Поменять">
            </form>
            <?php if (isset($_COOKIE['edit-nick-state'])): ?>
                <p class="mg-0"><?= $_COOKIE['edit-nick-state'] ?></p>
            <?php endif; ?>
        </div>
        <div class="change-block change-block-mgpds">
            <form method="post" action="validator-acc/change_password.php">
                <label for="oldpassword">Старый пароль</label><input type="password" class="form-control s-input"
                                                                     id="oldpassword" name="oldpassword"
                                                                     placeholder="Старый пароль">
                <label for="newpassword">Новый пароль</label><input type="password" id="newpassword" name="newpassword"
                                                                    class="form-control s-input" placeholder="Новый пароль">
                <label for="newpasswordrep">Повторите новый пароль</label><input type="password" id="newpasswordrep"
                                                                       name="newpasswordrep"
                                                                       class="form-control s-input"
                                                                       placeholder="Повторите новый пароль">
                <input type="submit" class="btn btn-success" value="Поменять">
            </form>
            <?php if (isset($_COOKIE['edit-password-state'])): ?>
                <p class="mg-0"><?= $_COOKIE['edit-password-state'] ?></p>
            <?php endif; ?>
        </div>
        <div class="change-block change-block-mgpds">
            <form method="post" action="validator-acc/change_inv_code.php">
                <label for="code">Пригласительный код</label><input type="text" class="form-control s-input"
                                                                    id="code"
                                                                    name="code" placeholder="Новый пригласительный код">
                <input type="submit" class="btn btn-success" value="Поменять">
            </form>
            <?php if (isset($_COOKIE['edit-inv-code-state'])): ?>
                <p class="mg-0"><?= $_COOKIE['edit-inv-code-state'] ?></p>
            <?php endif; ?>
        </div>
        <div class="change-block change-block-mgpds">
            <form method="post" action="validator-acc/delete_acc.php">
                <label for="password">Пароль</label><input type="password" id="password" name="password"
                                                           class="form-control s-input"
                                                           placeholder="Пароль">
                <input type="submit" class="btn btn-success" value="Удалить аккаунт">
            </form>
            <?php if (isset($_COOKIE['delete-acc-state'])): ?>
                <p class="mg-0"><?= $_COOKIE['delete-acc-state'] ?></p>
            <?php endif; ?>
        </div>
        <a href="validator-acc/exit.php"><button class="btn btn-success">Выйти</button></a>
<!--        <a href="validator-acc/delete_acc.php"><button class="btn btn-success">Удалить аккаунт</button></a>-->
    </div>
</div>
</body>
</html>
<?php } else { header("Location: /lab6_php_scripts/index.php"); }