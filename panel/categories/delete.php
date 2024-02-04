<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die();
}

require_once("../../connections/db.php");

if (!$dbUser["isAdmin"]) {
    die();
}

$categoryToDelete = null;
if (isset($_POST["id"]))
{
    $query = "DELETE FROM `categories` WHERE `id`='". $_POST["id"] . "' LIMIT 1";
    mysqli_query($link, $query);
    header("Location: index.php");
    die();
}
else if (isset($_GET["id"])){
    $categoryToDelete = getDbCategory($link, $_GET["id"]);
}
else{
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Подтвердите удаление категории <?php echo $categoryToDelete["category"] ?></h1>
    <form action="delete.php" method="POST">
        <input name="id" hidden value="<?php echo $_GET["id"] ?>">
        <input type="submit" value="Подтвердить">
    </form>
</body>
</html>