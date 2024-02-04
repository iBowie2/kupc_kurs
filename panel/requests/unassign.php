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

if (!isset($_GET["id"])) {
    header("Location: index.php");
    die();
}

$query = "DELETE FROM `requests_users` WHERE `requestId`='" . $_GET["id"] . "' AND `userId`='" . $_GET["userId"] . "' LIMIT 1";
mysqli_query($link, $query);

header("Location: view.php?id=" . $_GET["id"]);
die();
