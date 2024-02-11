<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

if (!$dbUser["isAdmin"]) {
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
    <title>Список должностей</title>
</head>

<body>
    <a class="secondary-button" href="/panel/index.php">В панель управления</a> <br>
    <a class="primary-button" href="create.php">Добавить должность</a>
    <hr>
    <h1>Все должности</h1>
    <table>
        <thead>
            <th>Название</th>
            <th>Статус</th>
            <th>Действия</th>
        </thead>
        <tbody>
            <?php
            $allPositions = getDbPositions($link);
            while ($row = mysqli_fetch_array($allPositions)) {
            ?>
                <tr>
                    <td><?php echo $row["position"] ?></td>
                    <td><?php echo localizeStatus($row["status"]) ?></td>
                    <td>
                        <a class="primary-button" href="edit.php?id=<?php echo $row["id"] ?>">Редактировать</a>
                        <a class="danger-button" href="delete.php?id=<?php echo $row["id"] ?>">Удалить</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>