<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

if (!$dbUser["isAdmin"]) {
    die();
}

$editCategory = null;
if (isset($_GET["id"])) {
    $editCategory = getDbCategory($link, $_GET["id"]);
} else if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $category = $_POST["category"];
    $status = $_POST["status"];

    $query = "UPDATE `categories` SET `category`=?, `status`=? WHERE `id`='" . $id . "' LIMIT 1";
    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("ss", $category, $status);
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
    <link rel="stylesheet" href="/css/grid.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Редактирование категории</title>
</head>

<body>
    <h1>Редактирование категории</h1>
    <form action="edit.php" method="POST">
        <input hidden name="id" value="<?php echo $editCategory["id"] ?>">
        <label for="category">Название</label>
        <input type="text" name="category" placeholder="Название" value="<?php echo $editCategory["category"] ?>"> <br>
        <label for="status">Статус</label>
        <select name="status">
            <option <?php if ($editCategory["status"] == "Normal") echo "selected" ?> value="Normal"><?php echo localizeStatus("Normal") ?></option>
            <option <?php if ($editCategory["status"] == "Pending") echo "selected" ?> value="Pending"><?php echo localizeStatus("Pending") ?></option>
        </select>
        <br>
        <input class="primary-button" type="submit" value="Изменить">
    </form>
</body>

</html>