<?php
$host = "localhost";
$db = "happycar";
$user = "root";
$password = "";

$link = mysqli_connect($host, $user, $password) or trigger_error(mysqli_error($link), E_USER_ERROR);
mysqli_select_db($link, $db);

$dbUser = null;
if (isset($_SESSION["user_id"])) {
    $query = "SELECT * FROM `users` WHERE `id`='" . $_SESSION["user_id"] . "' LIMIT 1";
    $result = mysqli_query($link, $query);
    $dbUser = mysqli_fetch_assoc($result);
}

function getDbUserById(mysqli $link, int $userId)
{
    $query = "SELECT * FROM `users` WHERE `id`='" . $userId . "' LIMIT 1";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_assoc($result);
}

function getDbUserPosition(mysqli $link, array $dbUser)
{
    if (!isset($dbUser)) return null;
    if (!isset($dbUser["positionId"])) return null;

    $query = "SELECT * FROM `positions` WHERE `id`='" . $dbUser["positionId"] . "' LIMIT 1";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_assoc($result);
}
