<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в панель управления</title>
</head>

<body>
    <h1>Вход для работников автосервиса</h1>
    <form action="login.php" method="POST">
        <input name="login" type="text" placeholder="Логин" required>
        <input name="password" type="password" placeholder="Пароль" required>
        <input type="submit" value="Вход">
    </form>
</body>

</html>