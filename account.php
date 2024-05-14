<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["button"])) {
        if($_POST["button"] == "changePassword") {
            // echo "password";
            echo (
                "<input type='text'>
                <input type='text'>"
            );
        } elseif ($_POST["button"] == "signOut") {
            // echo "submit";
            $_SESSION["loggedIn"] = false;
            session_destroy();
            header("Location: index.php");
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scales=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/account.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="favicon.ico">
    <title>My Account</title>
</head>
<body>
    <?php include("header.php")?>
    <main>
        <h1>Username: admin</h1>
        <form action="account.php" method="post">
            <button name=button value="changePassword" type="submit">Passwort ändern</button>
            <button name=button value="signOut" type="submit">Abmelden</button>
        </form>
    </main>
</body>
</html>