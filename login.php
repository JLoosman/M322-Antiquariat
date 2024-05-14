<?php session_start()?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <?php
        $options = [
                "cost" => 10
        ];
        // passwords are admin and tom
        // echo password_hash("admin", PASSWORD_DEFAULT, $options);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["username"]) && isset($_POST["password"])) {
                $usernameLogin = $_POST["username"];
                $passwordLogin = $_POST["password"];

                include("connection.php");

                $sql = "SELECT * FROM benutzer
                        WHERE benutzername = :username";

                /** @var TYPE_NAME $conn */
                $statement = $conn->prepare($sql);
                $statement->execute(["username" => $usernameLogin]);

                $statementRow = $statement->fetch();

                if(isset($statementRow["passwort"])) {
                    $passwordHash = $statementRow["passwort"];
                    echo $passwordHash;
                    if (password_verify($passwordLogin, $passwordHash)) {
                        $_SESSION["loggedIn"] = true;
                        header("Location: account.php");
                    } else {
                        echo "Password wrong";
                    }
                } else {
                    echo "No such user";
                }
            }
        }
    ?>
    <div class="hero">
        <?php include("header.php") ?>
        <div class="center">
            <div class="login-form">
                <h1>Login</h1>
                <form action="login.php" method="post">
                    <input name="username" required placeholder="Benutzername..." type="text">
                    <input name="password" required placeholder="Passwort..." type="password">
                    <button type="submit">Login</button>
                </form>
                <div class="options">
                    <a href="">Passwort vergessen?</a>
                    <a href="register.php">Registrieren</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>