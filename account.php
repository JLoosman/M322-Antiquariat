<?php
session_start();

// if user isnt logged in redirect to login page
if(!((isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) || (isset($_SESSION["isUser"]) && $_SESSION["isUser"]))) {
    header("Location: ./login.php");
}

// get important data from user, passed to session in login.php
$id = $_SESSION["id"];
$name = $_SESSION['username'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    include("testInput.php");

    // if form wants to change the password
    if (isset($_POST["button"])) {
        if ($_POST["button"] == "changePassword") {
            $password = test_input($_POST["password"]);
            $confirmPassword = test_input($_POST["confirmPassword"]);

            if ($password == $confirmPassword) {
                $options = [
                    "cost" => 10
                ];
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT, $options);

                $query = "UPDATE benutzer SET passwort = ? WHERE ID = ?";

                include("connection.php");

                $statement = $conn->prepare($query);
                $statement->execute([$hashedPassword, $id]);
            }
        // if user wants to sign out of his account
        } else if ($_POST["button"] == "signOut") {
            $_SESSION["isAdmin"] = false;
            session_destroy();
            header("Location: index.php");

        // if user wants to delete his account
        } else if ($_POST["button"] == "deleteAcc") {
            $_SESSION["isAdmin"] = false;
            session_destroy();

            include("connection.php");

            $query = "DELETE FROM benutzer WHERE ID = ?";

            $statement = $conn->prepare($query);
            $statement->execute([$id]);

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
        <?php
            include("connection.php");

        /** @var TYPE_NAME $conn */
        $totalBooks = $conn->query("SELECT COUNT(*) FROM buecher")->fetchColumn();

        $soldBooks = $conn->query("SELECT COUNT(*) FROM buecher WHERE verkauft = 1")->fetchColumn();

        $totalCustomers = $conn->query("SELECT COUNT(*) FROM kunden")->fetchColumn();
        ?>
        <section class="dashboard">
            <h1>Dashboard:</h1>
            <div class="container">
                <div class="box">
                    <h1 class="count"><?=$totalBooks?></h1>
                    <h3>Totale Bücher</h3>
                </div>
                <div class="box">
                    <h1 class="count"><?=$soldBooks?></h1>
                    <h3>Verkaufte Bücher</h3>
                </div>
                <div class="box">
                    <h1 class="count"><?=$totalCustomers?></h1>
                    <h3>Totale Kunden</h3>
                </div>
            </div>
        </section>
        <section class="account">
            <div class="left">
                <h1>Benutzername: <?=$name?></h1>
                <form action="account.php" method="post">
                    <button name="button" value="deleteAcc" type="submit">Account löschen</button>
                    <button name=button value="signOut" type="submit">Abmelden</button>
                </form>
            </div>
            <div class="right">
                <h1>Passwort ändern:</h1>
                <form action="account.php" method="post">
                    <label for="password">Neues Passwort:</label>
                    <input id="password" name="password" type="password" minlength="8">
                    <label for="confirmPassword">Bestätige dein Passwort:</label>
                    <input id="confirmPassword" name="confirmPassword" type="password" minlength="8">
                    <button name="button" type="submit" value="changePassword">Ändern</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>