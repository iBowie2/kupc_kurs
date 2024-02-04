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

$query = "UPDATE `requests` SET `status`='" . $_POST["status"] . "' WHERE `id`='" . $_POST["id"] . "' LIMIT 1";
mysqli_query($link, $query);

header("Location: view.php?id=" . $_POST["id"]);
die();