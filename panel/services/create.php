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

if (isset($_POST["service"])) {
    $service = $_POST["service"];
    $price = $_POST["price"];
    $categoryId = $_POST["categoryId"];
    $status = $_POST["status"];

    $query = "INSERT INTO `services` (`service`, `price`, `categoryId`, `status`) values (?, '" . $price . "', '" . $categoryId . "', ?)";
    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("ss", $service, $status);
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
    <title>Добавление новой услуги</title>
</head>

<body>
    <h1>Добавление новой услуги</h1>
    <form action="create.php" method="POST">
        <label for="service">Название</label>
        <input type="text" name="service" placeholder="Название"> <br>
        <label for="price">Цена</label>
        <input type="number" name="price" placeholder="Цена"> <br>
        <label for="categoryId">Категория</label>
        <select name="categoryId">
            <?php
            $allCategories = getDbCategories($link);
            while ($row = mysqli_fetch_array($allCategories)) {
            ?>
                <option value="<?php echo $row["id"] ?>">
                    <?php echo $row["category"] ?>
                </option>
            <?php
            }
            ?>
        </select>
        <br>
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