<?php
$host = "localhost";
$db = "happycar";
$user = "root";
$password = "";

$link = mysqli_connect($host, $user, $password) or trigger_error(mysqli_error($link), E_USER_ERROR);
mysqli_select_db($link, $db);

// mysqli_query($link, "SET NAMES cp1251;") or die(mysqli_error($link));
// mysqli_query($link, "SET CHARACTER SET cp1251;") or die(mysqli_error($link));
?>