<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

if (!$dbUser["isAdmin"]) {
    die();
}

$editUser = null;
if (isset($_POST["id"])) {
    $query = "UPDATE `users` SET `firstName`=?, `lastName`=?, `phoneNumber`=?, `status`=? WHERE `id`='" . $_POST["id"] . "'";
    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("ssss", $_POST["firstName"], $_POST["lastName"], $_POST["phoneNumber"], $_POST["status"]);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    die();
} else if (isset($_GET["id"])) {
    $editUser = getDbUserById($link, $_GET["id"]);
} else {
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
    <title>Редактирование пользователя</title>
</head>

<body>
    <form action="edit.php" method="POST">
        <input name="id" hidden value="<?php echo $_GET["id"] ?>">
        <label for="lastName">Фамилия</label>
        <input type="text" name="lastName" required value="<?php echo $editUser["lastName"] ?>">
        <br>
        <label for="firstName">Имя</label>
        <input type="text" name="firstName" required value="<?php echo $editUser["firstName"] ?>">
        <br>
        <label for="phoneNumber">Номер телефона</label>
        <input type="tel" name="phoneNumber" required value="<?php echo $editUser["phoneNumber"] ?>">
        <br>
        <label for="status">Статус</label>
        <select name="status">
            <option value="Normal">Нормально</option>
            <option value="Pending">Ожидает проверки</option>
            <option value="Invalid">Невалидный</option>
        </select>
        <br>
        <input class="primary-button" type="submit" value="Изменить">
    </form>
</body>

</html>