<?php
session_start();

if(!isset($_SESSION["loggedIn"]) && !$_SESSION["loggedIn"] == true) {
    header("Location: ./login.php");
}

$id = $_SESSION["id"];
$username = $_SESSION['username'];
$name = $username;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["button"])) {
        if ($_POST["button"] == "changePassword") {
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];

            if($password == $confirmPassword) {
                $options = [
                    "cost" => 10
                ];
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT, $options);

                $query = "UPDATE benutzer SET passwort = ? WHERE id = ?";

                include("connection.php");

                $statement = $conn->prepare($query);
                $statement->execute([$hashedPassword, $id]);
            }
        } else if ($_POST["button"] == "signOut") {
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
            <h1>Account:</h1>
            <h1>Benutzername: <?=$name?></h1>
            <form action="account.php" method="post">
                <label for="password">Neues Passwort:</label>
                    <input id="password" name="password" type="password">
                <label for="confirmPassword">Bestätige dein Passwort:</label>
                    <input id="confirmPassword" name="confirmPassword" type="password">
                <button name="button" type="submit" value="changePassword">Ändern</button>
            </form>
            <form action="account.php" method="post">
                <button onclick="">Passwort ändern</button>
                <button name=button value="signOut" type="submit">Abmelden</button>
            </form>
        </section>
    </main>
</body>
</html>