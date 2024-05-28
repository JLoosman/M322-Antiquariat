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
        include("testInput.php");

        $options = [
                "cost" => 10
        ];

        // login via form, hashing the password and comparing it to database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["username"]) && isset($_POST["password"])) {
                $usernameLogin = test_input($_POST["username"]);
                $passwordLogin = test_input($_POST["password"]);

                include("connection.php");

                $sql = "SELECT * FROM benutzer
                        WHERE benutzername = :username";

                /** @var TYPE_NAME $conn */
                $statement = $conn->prepare($sql);
                $statement->execute(["username" => $usernameLogin]);

                $statementRow = $statement->fetch();

                if(isset($statementRow["passwort"])) {
                    $passwordHash = $statementRow["passwort"];

                    if (password_verify($passwordLogin, $passwordHash)) {
                        $_SESSION["loggedIn"] = true;
                        $_SESSION["username"] = $usernameLogin;
                        $_SESSION["id"] = $statementRow["ID"];
                        header("Location: account.php");
                    } else {
                        echo '<div class="failedLogin">
                                    <h3>Versuche es erneut</h3>
                                </div>';
                    }
                } else {
                    echo '<div class="failedLogin">
                                    <h3>Versuche es erneut</h3>
                                </div>';
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