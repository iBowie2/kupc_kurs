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

if (isset($_POST["category"])) {
    $category = $_POST["category"];
    $status = $_POST["status"];

    $query = "INSERT INTO `categories` (`category`, `status`) values (?, ?)";
    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("ss", $category, $status);
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
    <title>Добавление категории</title>
</head>

<body>
    <h1>Добавление новой категории услуг</h1>
    <form action="create.php" method="POST">
        <label for="category">Название</label>
        <input type="text" name="category" placeholder="Название"> <br>
        <label for="status">Статус</label>
        <select name="status">
            <option value="Normal"><?php echo localizeStatus("Normal") ?></option>
            <option selected value="Pending"><?php echo localizeStatus("Pending") ?></option>
        </select>
        <br>
        <input type="submit" value="Добавить">
    </form>
</body>

</html>