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

function getDbRequest(mysqli $link, int $requestId)
{
    $query = "SELECT * FROM `requests` WHERE `id`='" . $requestId . "' LIMIT 1";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_assoc($result);
}

function getDbService(mysqli $link, int $serviceId)
{
    $query = "SELECT * FROM `services` WHERE `id`='" . $serviceId . "' LIMIT 1";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_assoc($result);
}

function getDbCategory(mysqli $link, int $categoryId)
{
    $query = "SELECT * FROM `categories` WHERE `id`='" . $categoryId . "' LIMIT 1";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_assoc($result);
}

function getDbRequestServices(mysqli $link, int $requestId): mysqli_result
{
    $query = "SELECT * FROM `requests_services` WHERE `requestId`='" . $requestId . "'";
    $result = mysqli_query($link, $query);
    return $result;
}

function getDbRequestUsers(mysqli $link, int $requestId): mysqli_result
{
    $query = "SELECT * FROM `requests_users` WHERE `requestId`='" . $requestId . "'";
    $result = mysqli_query($link, $query);
    return $result;
}

function getDbUserRequests(mysqli $link, int $userId)
{
    $query = "SELECT * FROM `requests_users` WHERE `userId`='" . $userId . "'";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_array($result);
}

function getDbServiceRequests(mysqli $link, int $serviceId)
{
    $query = "SELECT * FROM `requests_services` WHERE `serviceId`='" . $serviceId . "'";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_array($result);
}

function getDbCategoryServices(mysqli $link, int $categoryId)
{
    $query = "SELECT * FROM `services` WHERE `categoryId`='" . $categoryId . "'";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_array($result);
}

function localizeStatus(string $status)
{
    switch ($status)
    {
        case "Normal": return "Обычный";
        case "Completed": return "Выполнено";
        case "Invalid": return "Невалидный";
        case "Pending": return "Ожидает проверки";
        default: return $status;
    }
}

function getDbUsers(mysqli $link): mysqli_result
{
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($link, $query);
    return $result;
}

function getDbServices(mysqli $link): mysqli_result
{
    $query = "SELECT * FROM `services`";
    $result = mysqli_query($link, $query);
    return $result;
}

function getDbCategories(mysqli $link): mysqli_result
{
    $query = "SELECT * FROM `categories`";
    $result = mysqli_query($link, $query);
    return $result;
}