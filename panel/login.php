<?php

session_start();

require_once("../connections/db.php");

$username = $_POST["login"];
$password = $_POST["password"];

$query = "SELECT * FROM `users` WHERE `login`=?";
$stmt = $link->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($result == false) {
    echo "Пользователь не найден";
} else {
    $dbUsername = $result["login"];
    $dbPassword = $result["password"];

    if (password_verify($password, $dbPassword)) {
        $_SESSION["username"] = $dbUsername;
        $_SESSION["user_id"] = $result["id"];

        header("Location: index.php");
        die();
    } else {
        echo "Пользователь не найден";
    }
}
