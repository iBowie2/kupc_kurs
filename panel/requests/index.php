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
    <table>
        <thead>
            <th>Номер заявки</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Электронная почта</th>
            <th>Номер телефона</th>
            <th>Модель автомобиля</th>
            <th>Год выпуска</th>
            <th>Дата починки</th>
            <th>Статус заявки</th>
            <th>Действия</th>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM `requests` ORDER BY `id` DESC";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["lastName"] ?> </td>
                    <td><?php echo $row["firstName"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["phoneNumber"] ?></td>
                    <td><?php echo $row["carMark"] ?></td>
                    <td><?php echo $row["carYear"] ?></td>
                    <td><?php echo $row["repairDate"] ?></td>
                    <td><?php echo localizeStatus($row["status"]) ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $row["id"] ?>">Подробности</a>
                        <?php
                        if ($dbUser["isAdmin"]) {
                        ?>
                            <a href="edit.php?id=<?php echo $row["id"] ?>">Редактировать основную информацию</a>
                            <a href="delete.php?id=<?php echo $row["id"] ?>">Удалить</a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>