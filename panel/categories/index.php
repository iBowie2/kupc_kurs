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
    <a href="create.php">Добавить категорию</a>
    <hr>
    <h1>Все категории</h1>
    <table>
        <thead>
            <th>Название</th>
            <th>Статус</th>
            <th>Действия</th>
        </thead>
        <tbody>
            <?php
            $allCategories = getDbCategories($link);
            while ($row = mysqli_fetch_array($allCategories))
            {
                ?>
                <tr>
                    <td><?php echo $row["category"] ?></td>
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