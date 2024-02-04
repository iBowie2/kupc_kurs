<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

if (!$dbUser["isAdmin"]) {
    header("Location: index.php");
    die();
}

if (!isset($_POST["id"]))
{
    header("Location: index.php");
    die();
}

$query = "INSERT INTO `requests_services` (`requestId`, `serviceId`) values ('" . $_POST["id"] . "', '" . $_POST["serviceId"] . "')";
mysqli_query($link, $query);

header("Location: view.php?id=" . $_POST["id"]);
die();