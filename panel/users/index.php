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
    <title>Список пользователей</title>
</head>

<body>
    <a href="/panel/index.php">В панель управления</a>
    <table>
        <thead>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Должность</th>
            <th>Статус</th>
            <th>Действия</th>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM `users`";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($result)) {
                $position = getDbUserPosition($link, $row);
            ?>
                <tr>
                    <td><?php echo $row["lastName"] ?></td>
                    <td><?php echo $row["firstName"] ?></td>
                    <td><?php echo $row["phoneNumber"] ?></td>
                    <td><?php echo $position["position"] ?></td>
                    <td><?php echo localizeStatus($row["status"]) ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row["id"] ?>">Редактировать</a>
                        <?php
                        if ($row["id"] != $dbUser["id"]) {
                            if ($row["isAdmin"]) {
                                echo "<a href=\"demote.php?id=" . $row["id"] . "\">Убрать права администратора</a>";
                            } else {
                                echo "<a href=\"promote.php?id=" . $row["id"] . "\">Сделать администратором</a>";
                            }

                            echo "<a href=\"delete.php?id=" . $row["id"] . "\">Удалить</a>";
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <a href="create.php">Создать нового пользователя</a>
</body>

</html>