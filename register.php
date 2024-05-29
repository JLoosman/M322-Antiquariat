<?php
session_start();

// register new User via form and send it to database
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include("testInput.php");

    $userName = test_input($_POST['username']);
    $formPassword = test_input($_POST['password']);
    $isAdmin = $_POST['isAdmin'];

    $isAdmin = $isAdmin == "on" ? 1 : 0;

    $options = [
        "cost" => 10
    ];
    $hashedPassword = password_hash($formPassword, PASSWORD_DEFAULT, $options);

    include("connection.php");

    $query = "INSERT INTO `benutzer` (`benutzername`, `passwort`, `admin`) VALUES (?, ?, ?)";

    $statement = $conn->prepare($query);
    $statement->execute([$userName, $hashedPassword, $isAdmin]);

    header("Location: login.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon.ico">
    <title>Register</title>
</head>
<body>
    <div class="hero">
        <?php include("header.php") ?>
        <div class="center">
            <div class="login-form">
                <h1>Register</h1>
                <form action="register.php" method="post">
                    <input required name="username" placeholder="Benutzername..." type="text">
                    <input required name="password" placeholder="Passwort..." type="password" minlength="8">
                    <div>
                        <label for="isAdmin">Admin?</label>
                        <input id="isAdmin" name="isAdmin" type="checkbox">
                    </div>
                    <button type="submit">Register</button>
                </form>
                <div class="options">
                    <a href="login.php">Sie haben bereits einen Account?</a>
                    <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>