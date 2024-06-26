<?php
session_start();
include("testInput.php");

if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true && $_SERVER["REQUEST_METHOD"] == "POST") {

    isset($_POST["firstname"]) ? $firstname = test_input($_POST["firstname"]) : $firstname = "";
    isset($_POST["lastname"]) ? $lastname = test_input($_POST["lastname"]) : $lastname = "";
    isset($_POST["email"]) ? $email = test_email($_POST["email"]) : $email = "";
    isset($_POST["kontakt"]) ? $kontakt = test_input($_POST["kontakt"]) : $kontakt = 0;
    isset($_POST["date"]) ? $date = test_input($_POST["date"]) : $date = "";
    isset($_POST["customerSince"]) ? $customerSince = test_input($_POST["customerSince"]) : $customerSince = "";
    isset($_POST["gender"]) ? $gender = test_input($_POST["gender"]) : $gender = "M";


    $kontakt = $kontakt == "on" ? 1 : 0;


    $query = "INSERT INTO `kunden` 
            (`kid`, `geburtstag`, `vorname`, `name`, `geschlecht`, `kunde_seit`, `email`, `kontaktpermail`) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?)";

    include("connection.php");

    // query to get new ID for new entry
    /** @var TYPE_NAME $conn */
    $newID = $conn->query("SELECT max(kid) FROM kunden")->fetchColumn() + 1;


    // add new customer to dbs
    /** @var TYPE_NAME $conn */
    $statement = $conn->prepare($query);
    $statement->execute([$newID, $date, $firstname, $lastname, $gender, $customerSince, $email, $kontakt]);

    header("Location: kunden.php?site=1");

} else if (!isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"] == true) {
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
        <h1>Kunde hinzufügen</h1>
        <form action="addCustomer.php" method="post">
            <input required type="text" maxlength="250" placeholder="Vorname..." name="firstname">
            <input required type="text" maxlength="250" placeholder="Nachname..." name="lastname">
            <input required type="email" maxlength="250" placeholder="Email..." name="email">

            <div>
                <label for="kontakt">Kontakt per Email?</label>
                <input id="kontakt" name="kontakt" type="checkbox">
            </div>
            <div>
                <label for="geburtstag">Geburtstag: </label>
                <input required id="geburtstag" type="date" maxlength="250" placeholder="Geburtstag..." name="date">
            </div>
            <div>
                <label for="kundeseit">Kunde seit:</label>
                <input required id="kundeseit" type="date" maxlength="250" placeholder="Kunde seit..." name="customerSince">
            </div>
            <div>
                <label>Geschlecht?</label>
                <div>
                    <label for="M">M</label>
                    <input checked type="radio" value="M" name="gender" id="M">
                    <label for="F">F</label>
                    <input type="radio" value="F" name="gender" id="F">
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