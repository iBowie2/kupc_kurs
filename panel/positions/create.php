<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

if (!$dbUser["isAdmin"]) {
    die();
}

if (isset($_POST["position"])) {
    $position = $_POST["position"];
    $status = $_POST["status"];

    $query = "INSERT INTO `positions` (`position`, `status`) values (?, ?)";
    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("ss", $position, $status);
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
    <title>Добавление должности</title>
</head>

<body>
    <h1>Добавление новой должности</h1>
    <form action="create.php" method="POST">
        <label for="position">Название</label>
        <input type="text" name="position" placeholder="Название"> <br>
        <label for="status">Статус</label>
        <select name="status">
            <option value="Normal"><?php echo localizeStatus("Normal") ?></option>
            <option selected value="Pending"><?php echo localizeStatus("Pending") ?></option>
        </select>
        <br>
        <input class="primary-button" type="submit" value="Добавить">
    </form>
</body>

</html>