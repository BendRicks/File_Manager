<?php require_once "validator-acc/get_acc_data.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Хранилище</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="content/favicon.ico" type="image/x-icon"/>
</head>
<body>
<?php if (!isset($_COOKIE['user-id'])): ?>
    <div class="container mt-4">
        <h1>Авторизация</h1>
        <form action="validator-acc/auth.php" method="post">
            <label for="login">Логин</label><input type="text" class="form-control s-input" name="login" id="login"
                                                   placeholder="Логин">
            <label for="password">Пароль</label><input type="password" class="form-control s-input" name="password"
                                                       id="password" placeholder="Пароль">
            <button class="btn btn-success">Авторизоваться</button>
        </form>
        <a href="registration.php">
            <button class="btn btn-dark mg-0">Регистрация</button>
        </a>
        <?php if (isset($_COOKIE['auth-error-description'])): ?>
            <p class="mg-0"><?= $_COOKIE['auth-error-description'] ?></p>
        <?php endif; ?>
    </div>
<?php else: ?>
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
        <div class="content-body">
            <?php
            $currentDirectory = "D:/serverData";
            $not_default_dir = isset($_COOKIE['curr_dir']) && $_COOKIE['curr_dir'] != "";
            if ($not_default_dir) {
                $currentDirectory = $currentDirectory . $_COOKIE['curr_dir'];
            }
            $list = scandir($currentDirectory);
            $files = array_diff($list, array('.', '..'));
            if ($not_default_dir): ?>
                <p><?=$_COOKIE['curr_dir'] ?></p>
                <div class="dir-part">
                    <a class="dir-part-content" href="logic/change_dir.php?dir=..">
                        <img class="dir-part-img" alt="folder" src="content/folder.png" width="32" height="32"/>
                        <p>..</p>
                    </a>
                </div>
            <?php endif;
            if ($not_default_dir && empty($files)): ?>
                <div class="dir-part">
                    <a class="dir-part-content" href="logic/delete_dir.php">
                        <img class="dir-part-img" src="content/delete.jpg" width="32" height="32"/>
                        <p>Удалить папку</p>
                    </a>
                </div>
            <?php endif;
            foreach ($files as $value) { ?>
                <?php if (is_dir($currentDirectory . '/' . $value)): ?>
                    <div class="dir-part">
                        <a class="dir-part-content" href="logic/change_dir.php?dir=/<?= $value ?>">
                            <img class="dir-part-img" alt="folder" src="content/folder.png" width="32" height="32"/>
                            <p><?= $value ?></p>
                        </a>
                    </div>
                <?php endif;
            }
            foreach ($files as $value) {
                if (!is_dir($currentDirectory . '/' . $value)): ?>
                    <div class="dir-part">
                        <a class="dir-part-content" href="">
                            <img class="dir-part-img" src="content/file.png" width="32" height="32"/>
                            <p id><?= $value ?></p>
                        </a>
                        <a class="serv-img" href="logic/save_file.php?filename=<?= $value ?>"><img
                                    src="content/download.png" width="32" height="32"></a>
                    </div>
                <?php endif;
            } ?>
        </div>
    </div>
    <div class="divider"></div>
    <footer class="footer">
        <div class="fm-footer-content">
            <div class="fm-footer-block">
                <form class="new-folder-container" method="post" action="logic/create_dir.php">
                    <input type="text" name="new_dir" class="form-control new-folder-input"
                           placeholder="Название папки">
                    <input type="submit" value="Создать" class="btn btn-success">
                </form>
            </div>
            <div class="fm-footer-block">
                <form method="post" enctype="multipart/form-data" action="logic/upload_files.php">
                    Выберите файлы: <input type="file" name="files[]" size="40" multiple/>
                    <input type="submit" value="Загрузить" class="btn btn-success"/>
                </form>
            </div>
        </div>
    </footer>
<?php endif; ?>
</body>
</html>
