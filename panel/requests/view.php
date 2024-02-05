<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

$requestToView = getDbRequest($link, $_GET["id"]);

if (!isset($requestToView)) {
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявка №<?php echo $requestToView["id"] ?></title>
</head>

<body>
    <a href="index.php">Назад</a> <br>
    <a href="/panel/index.php">В панель управления</a> <br>
    <?php
    if ($dbUser["isAdmin"]) {
    ?>
        <a href="edit.php?id=<?php echo $requestToView["id"] ?>">Редактировать основную информацию</a> <br>
    <?php
    }
    ?>
    <hr>
    <h1>Заявка №<?php echo $requestToView["id"] ?></h1>
    <p>Имя клиента: <?php echo $requestToView["lastName"] . " " . $requestToView["firstName"] ?></p>
    <p>Автомобиль: <?php echo $requestToView["carMark"] . " " . $requestToView["carYear"] ?></p>
    <?php
    if (isset($requestToView["repairDate"])) {
    ?>
        <p>Дата починки: <?php echo $requestToView["repairDate"] ?></p>
    <?php
    }
    ?>
    <p>Проблема:</p>
    <p><?php echo $requestToView["problem"] ?></p>
    <?php
    if ($dbUser["isAdmin"]) {
    ?>
        <form action="setstatus.php" method="POST">
            <label>Статус: </label>
            <input hidden name="id" value="<?php echo $requestToView["id"] ?>">
            <select name="status">
                <option <?php if ($requestToView["status"] == "Pending") echo "selected" ?> value="Pending"><?php echo localizeStatus("Pending") ?></option>
                <option <?php if ($requestToView["status"] == "Normal") echo "selected" ?> value="Normal"><?php echo localizeStatus("Normal") ?></option>
                <option <?php if ($requestToView["status"] == "Invalid") echo "selected" ?> value="Invalid"><?php echo localizeStatus("Invalid") ?></option>
                <option <?php if ($requestToView["status"] == "Completed") echo "selected" ?> value="Completed"><?php echo localizeStatus("Completed") ?></option>
            </select>
            <input type="submit" value="Сохранить">
        </form>

        <hr>

        <h2>Назначенные работники</h2>

        <div>
            <?php
            $allUsers = getDbRequestUsers($link, $requestToView["id"]);
            while ($row = mysqli_fetch_array($allUsers)) {
            ?>
                <p>
                    <span>
                        <?php
                        $assignedUser = getDbUserById($link, $row["userId"]);
                        echo $assignedUser["lastName"] . " " . $assignedUser["firstName"];
                        ?>
                    </span>
                    <a href="unassign.php?id=<?php echo $requestToView["id"] ?>&userId=<?php echo $row["userId"] ?>">Убрать назначение</a>
                </p>
            <?php
            }
            ?>
        </div>

        <form action="assign.php" method="POST">
            <input hidden name="id" value="<?php echo $requestToView["id"] ?>">
            <select name="userId">
                <?php
                $allUsers = getDbUsers($link);
                while ($row = mysqli_fetch_array($allUsers)) {
                ?>
                    <option value="<?php echo $row["id"] ?>"><?php echo $row["lastName"] . " " . $row["firstName"] ?></option>
                <?php
                }
                ?>
            </select>
            <input type="submit" value="Назначить">
        </form>

        <hr>

        <h2>Назначенные услуги</h2>

        <div>
            <?php
            $totalCost = 0.0;
            $allRequestsAndServices = getDbRequestServices($link, $requestToView["id"]);
            while ($row = mysqli_fetch_array($allRequestsAndServices)) {
            ?>
                <p>
                    <span>
                        <?php
                        $assignedService = getDbService($link, $row["serviceId"]);
                        $totalCost += $assignedService["price"];
                        echo $assignedService["service"] . " (" . $assignedService["price"] . " руб.)";
                        ?>
                        <a href="unassignService.php?id=<?php echo $requestToView["id"] ?>&serviceId=<?php echo $row["serviceId"] ?>">Убрать назначение</a>
                    </span>
                </p>
            <?php
            }
            ?>
        </div>

        <form action="assignService.php" method="POST">
            <input hidden name="id" value="<?php echo $requestToView["id"] ?>">
            <select name="serviceId">
                <?php
                $allServices = getDbServices($link);
                while ($row = mysqli_fetch_array($allServices)) {
                ?>
                    <option value="<?php echo $row["id"] ?>"><?php echo $row["service"] . " (" . $row["price"] . " руб.)" ?></option>
                <?php
                }
                ?>
            </select>
            <input type="submit" value="Назначить">
        </form>

        <p>Общая сумма услуг: <?php echo $totalCost ?> рублей.</p>
    <?php
    } else {
    ?>
        <p>Статус: <?php echo localizeStatus($requestToView["status"]) ?></p>

        <hr>

        <h2>Назначенные работники</h2>

        <div>
            <?php
            $allUsers = getDbRequestUsers($link, $requestToView["id"]);
            while ($row = mysqli_fetch_array($allUsers)) {
            ?>
                <p>
                    <span>
                        <?php
                        if ($row["userId"] == $dbUser["id"]) {
                            echo "<b>" . $dbUser["lastName"] . " " . $dbUser["firstName"] . " (Вы)</b>";
                        } else {

                            $assignedUser = getDbUserById($link, $row["userId"]);
                            echo $assignedUser["lastName"] . " " . $assignedUser["firstName"];
                        }
                        ?>
                    </span>
                </p>
            <?php
            }
            ?>
        </div>

        <hr>

        <h2>Назначенные услуги</h2>

        <div>
            <?php
            $totalCost = 0.0;
            $allRequestsAndServices = getDbRequestServices($link, $requestToView["id"]);
            while ($row = mysqli_fetch_array($allRequestsAndServices)) {
            ?>
                <p>
                    <span>
                        <?php
                        $assignedService = getDbService($link, $row["serviceId"]);
                        $totalCost += $assignedService["price"];
                        echo $assignedService["service"] . " (" . $assignedService["price"] . " руб.)";
                        ?>
                    </span>
                </p>
            <?php
            }
            ?>
        </div>

        <p>Общая сумма услуг: <?php echo $totalCost ?> рублей.</p>
    <?php
    }
    ?>
    <form>

    </form>
</body>

</html>