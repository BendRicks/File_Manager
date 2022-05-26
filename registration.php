<?php if (!isset($_COOKIE['user-id'])): ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="content/favicon.ico" type="image/x-icon"/>
</head>
<body>
<div class="container mt-4">
    <h1>Регистрация</h1>
    <form method="post" action="validator-acc/reg.php">
        <label for="login">Логин</label><input type="text" class="form-control s-input" name="login" id="login"
                                               placeholder="Логин">
        <label for="password">Пароль</label><input type="password" class="form-control s-input" name="password"
                                                   id="password" placeholder="Пароль">
        <label for="passwordRepeat">Повторите пароль</label><input type="password" class="form-control s-input"
                                                                   name="password-repeat" id="passwordRepeat"
                                                                   placeholder="Повторите пароль">
        <label for="inv-password">Пригласительный код</label><input type="password" class="form-control s-input"
                                                                   name="inv-password" id="invitationPassword"
                                                                   placeholder="Пригласительный код">
        <button class="btn btn-success">Зарегестрироваться</button>
    </form>
    <a href="index.php">
        <button class="btn btn-dark mg-0">Авторизация</button>
    </a>
    <?php if (isset($_COOKIE['reg-error-description'])): ?>
        <p class="mg-0"><?=$_COOKIE['reg-error-description'] ?></p>
    <?php endif;?>
</div>
</body>
</html>
<?php else: header("Location: /lab6_php_scripts"); endif;