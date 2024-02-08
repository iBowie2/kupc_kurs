<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

if (!$dbUser["isAdmin"]) {
    die();
}

$editPosition = null;
if (isset($_GET["id"])) {
    $editPosition = getDbPosition($link, $_GET["id"]);
} else if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $position = $_POST["position"];
    $status = $_POST["status"];

    $query = "UPDATE `positions` SET `position`=?, `status`=? WHERE `id`='" . $id . "' LIMIT 1";
    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("ss", $position, $status);
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
    <title>Редактирование должности</title>
</head>

<body>
    <h1>Редактирование должности</h1>
    <form action="edit.php" method="POST">
        <input hidden name="id" value="<?php echo $editPosition["id"] ?>">
        <label for="position">Название</label>
        <input type="text" name="position" placeholder="Название" value="<?php echo $editPosition["position"] ?>"> <br>
        <label for="status">Статус</label>
        <select name="status">
            <option <?php if ($editPosition["status"] == "Normal") echo "selected" ?> value="Normal"><?php echo localizeStatus("Normal") ?></option>
            <option <?php if ($editPosition["status"] == "Pending") echo "selected" ?> value="Pending"><?php echo localizeStatus("Pending") ?></option>
        </select>
        <br>
        <input type="submit" value="Изменить">
    </form>
</body>

</html>