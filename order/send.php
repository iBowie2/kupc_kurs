<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/grid.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Заявка отправлена!</title>
</head>

<body>

    <?php require("../templates/header.php") ?>

    <hr />

    <?php

    session_start();

    require_once("../connections/db.php");

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $problem = $_POST["problem"];
    $carMark = $_POST["carMark"];
    $carYear = $_POST["carYear"];

    $query = "INSERT INTO `requests` (`firstName`, `lastName`, `email`, `phoneNumber`, `carMark`, `carYear`, `problem`, `status`) values(?, ?, ?, ?, ?, ?, ?, 'Pending')";

    $stmt = mysqli_prepare($link, $query);
    $stmt->bind_param("sssssis", $firstName, $lastName, $email, $phoneNumber, $carMark, $carYear, $problem);
    $stmt->execute();
    $stmt->close();
    ?>

    <div class="container" style="min-height: 50vh;">
        <p>Ваша заявка отправлена! Ожидайте обратной связи по указанным Вами контактам.</p>

        <a href="/index.php">На главную</a>
    </div>

    <hr />

    <?php require("../templates/footer.php") ?>
</body>

</html>