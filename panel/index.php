<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: signin.php");
    die();
}

require_once("../connections/db.php");

if (!isset($dbUser)) {
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Панель работника автосервиса</h1>
    Вы вошли как: <b><?php echo $dbUser["firstName"] . " " . $dbUser["lastName"] ?></b> <br>
    <?php

    $userPosition = getDbUserPosition($link, $dbUser);

    echo "Ваша должность: <b>" . $userPosition["position"] . "</b><br>";

    if ($dbUser["isAdmin"]) {
    ?>
        <a href="categories/index.php">Список категорий услуг</a> <br>
        <a href="services/index.php">Список услуг</a> <br>
        <a href="users/index.php">Список пользователей</a> <br>
    <?php
    }
    ?>
    <a href="requests/index.php">Список заявок</a> <br>
    <?php
    ?>
    <a href="logout.php">Выйти из аккаунта</a>
</body>

</html>