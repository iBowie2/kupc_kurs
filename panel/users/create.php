<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

if (!$dbUser["isAdmin"]) {
    die();
}

if (isset($_POST["login"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $phoneNumber = $_POST["phoneNumber"];
    $login = $_POST["login"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $status = $_POST["status"];
    $position = $_POST["position"];

    $query = "INSERT INTO `users` (`firstName`, `lastName`, `phoneNumber`, `login`, `password`, `status`, `isAdmin`, `positionId`) values (?, ?, ?, ?, ?, ?, 0, ?)";
    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("ssssssi", $firstName, $lastName, $phoneNumber, $login, $password, $status, $position);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/grid.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Создание пользователя</title>
</head>

<body>
    <h1>Создание пользователя</h1>
    <form action="create.php" method="POST">
        <label for="lastName">Фамилия</label>
        <input type="text" name="lastName" placeholder="Фамилия" required> <br>
        <label for="firstName">Имя</label>
        <input type="text" name="firstName" placeholder="Имя" required> <br>
        <label for="phoneNumber">Номер телефона</label>
        <input type="tel" name="phoneNumber" required placeholder="Номер телефона"> <br>
        <label for="login">Логин</label>
        <input type="text" name="login" placeholder="Логин" required> <br>
        <label for="password">Пароль</label>
        <input type="password" name="password" placeholder="Пароль" required> <br>
        <label for="status">Статус</label>
        <select name="status">
            <option value="Normal">Нормально</option>
            <option value="Pending">Ожидает проверки</option>
            <option value="Invalid">Невалидный</option>
        </select> <br>
        <label for="position">Должность</label>
        <select name="position">
            <?php
            $query = "SELECT * FROM `positions`";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <option value="<?php echo $row["id"] ?>">
                    <?php
                    echo $row["position"];
                    ?>
                </option>
            <?php
            }
            ?>
        </select>
        <input class="primary-button" type="submit" value="Создать">
    </form>
</body>

</html>