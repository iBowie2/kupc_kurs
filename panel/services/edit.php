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

$editService = null;
if (isset($_GET["id"])) {
    $editService = getDbService($link, $_GET["id"]);
} else if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $service = $_POST["service"];
    $price = $_POST["price"];
    $categoryId = $_POST["categoryId"];
    $status = $_POST["status"];

    $query = "UPDATE `services` SET `service`=?, `status`=?, `price`='" . $price . "', `categoryId`='" . $categoryId . "' WHERE `id`='" . $id . "' LIMIT 1";
    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("ss", $service, $status);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    die();
} else {
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
    <h1>Редактирование услуги</h1>
    <form action="edit.php" method="POST">
        <input hidden name="id" value="<?php echo $editService["id"] ?>">
        <label for="service">Название</label>
        <input type="text" name="service" placeholder="Название" value="<?php echo $editService["service"] ?>"> <br>
        <label for="price">Цена</label>
        <input type="number" name="price" placeholder="Цена" value="<?php echo $editService["price"] ?>"> <br>
        <label for="categoryId">Категория</label>
        <select name="categoryId">
            <?php
            $allCategories = getDbCategories($link);
            while ($row = mysqli_fetch_array($allCategories)) {
            ?>
                <option <?php if ($row["id"] == $editService["categoryId"]) echo "selected" ?> value="<?php echo $row["id"] ?>">
                    <?php echo $row["category"] ?>
                </option>
            <?php
            }
            ?>
        </select>
        <br>
        <label for="status">Статус</label>
        <select name="status">
            <option <?php if ($editService["status"] == "Normal") echo "selected" ?> value="Normal"><?php echo localizeStatus("Normal") ?></option>
            <option <?php if ($editService["status"] == "Pending") echo "selected" ?> value="Pending"><?php echo localizeStatus("Pending") ?></option>
        </select>
        <br>
        <input type="submit" value="Изменить">
    </form>
</body>

</html>