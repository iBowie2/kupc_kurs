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
    <title>Document</title>
</head>
<body>
    <a href="/panel/index.php">В панель управления</a> <br>
    <a href="create.php">Добавить услугу</a>
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
            while ($row = mysqli_fetch_array($allServices))
            {
                ?>
                <tr>
                    <td><?php echo $row["service"] ?></td>
                    <td><?php echo $row["price"] . " рублей" ?></td>
                    <td><?php echo localizeStatus($row["status"]) ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row["id"] ?>">Редактировать</a>
                        <a href="delete.php?id=<?php echo $row["id"] ?>">Удалить</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>