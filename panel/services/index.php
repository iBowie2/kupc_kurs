<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/grid.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Все услуги</title>
</head>

<body>
    <a class="secondary-button" href="/panel/index.php">В панель управления</a> <br>
    <a class="primary-button" href="create.php">Добавить услугу</a>
    <hr>
    <h1>Все услуги</h1>
    <table>
        <thead>
            <th>Название</th>
            <th>Цена</th>
            <th>Статус</th>
            <th>Действия</th>
        </thead>
        <tbody>
            <?php
            $allServices = getDbServices($link);
            while ($row = mysqli_fetch_array($allServices)) {
            ?>
                <tr>
                    <td><?php echo $row["service"] ?></td>
                    <td><?php echo $row["price"] . " рублей" ?></td>
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