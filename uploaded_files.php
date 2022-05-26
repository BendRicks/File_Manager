<?php
require_once "validator-acc/get_acc_data.php";
if (isset($_COOKIE['user-id'])): ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Загруженные файлы</title>
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
    <div class="content-body">
        <?php
        $mysqli = new mysqli('localhost', 'root', 'password', 'usersdb');
        $id = $_COOKIE['user-id'];
        $result = $mysqli->query("SELECT * FROM `uploaded_files` WHERE `user_id` = '$id'");
        while($file = mysqli_fetch_assoc($result)) { ?>
            <div class="dir-part">
                <a class="dir-part-content" href="">
                    <img class="dir-part-img" alt="folder" src="content/file.png" width="32" height="32"/>
                    <p><?= $file['url'] ?></p>
                </a>
                <a class="serv-img" href="logic/save_file.php?fullpath=<?=$file['url'] ?>"><img src="content/download.png" alt="download" width="32" height="32"></a>
                <a class="serv-img" href="logic/delete_file.php?fullpath=<?=$file['url'] ?>"><img src="content/delete.jpg" alt="delete" width="32" height="32"></a>
            </div>
            <?php
        }
        $mysqli->close(); ?>
    </div>
</div>
</body>
</html>
<?php else: header("Location: /lab6_php_scripts/index.php"); endif;