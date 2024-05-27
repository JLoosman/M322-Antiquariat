<?php
session_start();

if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true && $_SERVER["REQUEST_METHOD"] == "POST"){

    isset($_POST["id"]) ? $id = $_POST["id"] : $id = "";

    isset($_POST["firstname"]) ? $firstname = $_POST["firstname"] : $firstname = "";
    isset($_POST["lastname"]) ? $lastname = $_POST["lastname"] : $lastname = "";
    isset($_POST["email"]) ? $email = $_POST["email"] : $email = "";
    isset($_POST["kontakt"]) ? $kontakt = $_POST["kontakt"] : $kontakt = 0;
    isset($_POST["date"]) ? $date = $_POST["date"] : $date = "";
    isset($_POST["customerSince"]) ? $customerSince = $_POST["customerSince"] : $customerSince = "";
    isset($_POST["gender"]) ? $gender = $_POST["gender"] : $gender = "M";

    $kontakt = $kontakt == "on" ? 1 : 0;


    $query = "UPDATE kunden
            SET kid = ?, geburtstag = ?, vorname = ?, name = ?, geschlecht = ?, kunde_seit = ?, email = ?, kontaktpermail = ?
            WHERE kid = ?";

    include("connection.php");

    // add new book to dbs
    /** @var TYPE_NAME $conn */
    $statement = $conn->prepare($query);
    $statement->execute([$id, $date, $firstname, $lastname, $gender, $customerSince, $email, $kontakt, $id]);

    header("Location: kunden.php?site=1");

} else if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true && $_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $id = $_GET["id"];

    include("connection.php");
    $statement = $conn->prepare("SELECT * FROM kunden WHERE kid = ?");
    $statement->execute([$id]);

    $row = $statement->fetch();

    $firstname = $row["vorname"];
    $lastname = $row["name"];
    $email = $row["email"];
    $kontakt = $row["kontaktpermail"];
    $geburtstag = $row["geburtstag"];
    $customerSince = $row["kunde_seit"];
    $gender = $row["geschlecht"];

} else {
    header("Location: kunden.php?site=1");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/addbook.css">
    <title>Kunden</title>
</head>
<body>
<section id="modal">
    <div class="modal-frame">
        <h1>Kunde ändern</h1>
        <form action="editCustomer.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <input value=<?=$firstname?> required type="text" maxlength="250" placeholder="Vorname..." name="firstname">
            <input value=<?=$lastname?> required type="text" maxlength="250" placeholder="Nachname..." name="lastname">
            <input value=<?=$email?> required type="email" maxlength="250" placeholder="Email..." name="email">

            <div>
                <label for="kontakt">Kontakt per Email?</label>
                <input <?=$kontakt == 1 ? "checked" : ""?> id="kontakt" name="kontakt" type="checkbox">
            </div>
            <div>
                <label for="geburtstag">Geburtstag: </label>
                <input value=<?=$geburtstag?> id="geburtstag" type="date" maxlength="250" placeholder="Geburtstag..." name="date">
            </div>
            <div>
                <label for="kundeseit">Kunde seit:</label>
                <input value=<?=$customerSince?> id="kundeseit" type="date" maxlength="250" placeholder="Kunde seit..." name="customerSince">
            </div>
            <div>
                <label>Geschlecht?</label>
                <div>
                    <label for="M">M</label>
                    <input <?=$gender == 'M' ? "checked" : ""?> type="radio" value="M" name="gender" id="M">
                    <label for="F">F</label>
                    <input <?=$gender == 'F' ? "checked" : ""?> type="radio" value="F" name="gender" id="F">
                </div>
            </div>
            <div>
                <button onclick="history.back()" class="btn" type="button">Abbrechen</button>
                <button class="btn btn-dark" type="submit">Speichern</button>
            </div>
        </form>
    </div>
    <a onclick="history.back()" id="overlay"></a>
</section>
</body>
</html>