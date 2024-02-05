<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

if (!$dbUser["isAdmin"]) {
    header("Location: index.php");
    die();
}

$editRequest = null;
if (isset($_POST["id"])) {
    $query = "UPDATE `requests` SET `firstName`=?, `lastName`=?, `phoneNumber`=?, `email`=?, `carMark`=?, `carYear`=?, `repairDate`=? WHERE `id`='" . $_POST["id"] . "'";
    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("sssssss", $_POST["firstName"], $_POST["lastName"], $_POST["phoneNumber"], $_POST["email"], $_POST["carMark"], $_POST["carYear"], $_POST["repairDate"]);
    $stmt->execute();
    $stmt->close();
    header("Location: view.php?id=" . $_POST["id"]);
    die();
} else if (isset($_GET["id"])) {
    $editRequest = getDbRequest($link, $_GET["id"]);
} else {
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование заявки</title>
</head>

<body>
    <h1>Редактирование заявки №<?php echo $_GET["id"] ?></h1>
    <form action="edit.php" method="POST">
        <input name="id" hidden value="<?php echo $_GET["id"] ?>">
        <label for="lastName">Фамилия</label>
        <input type="text" name="lastName" required value="<?php echo $editRequest["lastName"] ?>">
        <br>
        <label for="firstName">Имя</label>
        <input type="text" name="firstName" required value="<?php echo $editRequest["firstName"] ?>">
        <br>
        <label for="phoneNumber">Номер телефона</label>
        <input type="tel" name="phoneNumber" required value="<?php echo $editRequest["phoneNumber"] ?>">
        <br>
        <label for="email">Электронная почта</label>
        <input type="email" name="email" value="<?php echo $editRequest["email"] ?>">
        <br>
        <label for="carMark">Модель автомобиля</label>
        <input type="text" name="carMark" required value="<?php echo $editRequest["carMark"] ?>">
        <br>
        <label for="carYear">Год выпуска автомобиля</label>
        <input type="number" name="carYear" required value="<?php echo $editRequest["carYear"] ?>">
        <br>
        <label for="repairDate">Дата починки</label>
        <input type="date" name="repairDate" required value="<?php echo $editRequest["repairDate"] ?>">
        <br>
        <input type="submit" value="Изменить">
    </form>
</body>

</html>