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
    <title>Список категорий</title>
</head>

<body>
    <a class="secondary-button" href="/panel/index.php">В панель управления</a> <br>
    <a class="primary-button" href="create.php">Добавить категорию</a>
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
            while ($row = mysqli_fetch_array($allCategories)) {
            ?>
                <tr>
                    <td><?php echo $row["category"] ?></td>
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