<?php
session_start();

if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true && $_SERVER["REQUEST_METHOD"] == "POST"){

    isset($_POST["title"]) ? $title = $_POST["title"] : $title = "";
    isset($_POST["number"]) ? $number = $_POST["number"] : $number = 0;
    isset($_POST["kategorie"]) ? $kategorie = $_POST["kategorie"] : $kategorie = 0;
    isset($_POST["katalog"]) ? $katalog = $_POST["katalog"] : $katalog = 0;
    isset($_POST["verfuegbarkeit"]) ? $verfuegbarkeit = $_POST["verfuegbarkeit"] : $verfuegbarkeit = 0;
    isset($_POST["autor"]) ? $autor = $_POST["autor"] : $autor = "";
    isset($_POST["sprache"]) ? $sprache = $_POST["sprache"] : $sprache = "";
    isset($_POST["zustand"]) ? $zustand = $_POST["zustand"] : $zustand = "";
    isset($_POST["beschreibung"]) ? $beschreibung = $_POST["beschreibung"] : $beschreibung = "";

    $verfuegbarkeit = $verfuegbarkeit == "on" ? 1 : 0;


    $query = "INSERT INTO `buecher` 
            (`id`, `katalog`, `nummer`, `kurztitle`, `kategorie`, `verkauft`, `kaufer`, `autor`, `title`, `sprache`, `foto`, `verfasser`, `zustand`) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    include("connection.php");

    // query to get new ID for new entry
    /** @var TYPE_NAME $conn */
    $newID = $conn->query("SELECT max(id) FROM buecher")->fetchColumn() + 1;


    // add new book to dbs
    /** @var TYPE_NAME $conn */
    $statement = $conn->prepare($query);
    $statement->execute([$newID, $katalog, $number, $title, $kategorie, $verfuegbarkeit, "", $autor, $beschreibung ,$sprache, "", "", $zustand]);

    header("Location: katalog.php?site=1");

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
    <title>Document</title>
</head>
<body>
<section id="modal">
    <div class="modal-frame">
        <h1>Buch hinzufügen</h1>
        <form action="addbook.php" method="post">
            <input required type="text" maxlength="250" placeholder="Titel..." name="title">
            <input type="number" min="1" max="999" placeholder="Nummer..." name="number">
            <div>
                <select name="kategorie" class="dropdown">
                    <option disabled selected>Kategorie:</option>
                    <option value="1">Alte Drucke, Bibeln</option>
                    <option value="2">Geographie und Reisen</option>
                    <option value="3">Geschichtswissenschaften</option>
                    <option value="4">Naturwissenschaften</option>
                    <option value="5">Kinderbücher</option>
                    <option value="6">Moderne Literatur und Kunst</option>
                    <option value="7">Moderne Künstlergraphik</option>
                    <option value="8">Kunstwissenschaften</option>
                    <option value="9">Architektur</option>
                    <option value="10">Technik</option>
                    <option value="11">Naturwissenschaften - Medizin</option>
                    <option value="12">Ozeanien</option>
                    <option value="13">Afrika</option>
                </select>
                <select name="katalog" class="dropdown">
                    <option disabled selected>Katalog:</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                </select>
            </div>
            <div>
                <label for="verfuegbar">Verkauft?</label>
                <input id="verfuegbar" name="verfuegbarkeit" type="checkbox">
            </div>
            <input type="text" maxlength="250" placeholder="Autor..." name="autor">
            <input type="text" maxlength="250" placeholder="Sprache..." name="sprache">
            <div>
                <label>Zustand?</label>
                <div>
                    <label for="G">Gut</label>
                    <input type="radio" value="G" name="zustand" id="G">
                    <label for="M">Mittel</label>
                    <input type="radio" value="M" name="zustand" id="M">
                    <label for="S">Schlecht</label>
                    <input type="radio" value="S" name="zustand" id="S">
                </div>
            </div>
            <textarea maxlength="60000" placeholder="Beschreibung..." name="beschreibung" id="" cols="30" rows="10"></textarea>
            <div>
                <a href="katalog.php?site=1">
                    <button class="btn" type="button">Abbrechen</button>
                </a>
                <button class="btn btn-dark" type="submit">Speichern</button>
            </div>
        </form>
    </div>
    <a href="katalog.php?site=1" id="overlay"></a>
</section>
</body>
</html>