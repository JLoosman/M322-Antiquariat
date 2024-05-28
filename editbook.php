<?php
session_start();
include("testInput.php");

// if user isnt logged in and method isnt post redirect away from this page
if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] && $_SERVER["REQUEST_METHOD"] == "POST"){

    // get data from form
    isset($_POST["id"]) ? $id = test_numeric($_POST["id"]) : $id = "";
    isset($_POST["title"]) ? $title = test_input($_POST["title"]) : $title = "";
    isset($_POST["number"]) ? $number = test_input($_POST["number"]) : $number = 0;
    isset($_POST["kategorie"]) ? $kategorie = test_input($_POST["kategorie"]) : $kategorie = 0;
    isset($_POST["katalog"]) ? $katalog = test_input($_POST["katalog"]) : $katalog = 0;
    isset($_POST["verfuegbarkeit"]) ? $verfuegbarkeit = test_input( $_POST["verfuegbarkeit"]) : $verfuegbarkeit = 0;
    isset($_POST["autor"]) ? $autor = test_input($_POST["autor"]) : $autor = "";
    isset($_POST["sprache"]) ? $sprache = test_input($_POST["sprache"]) : $sprache = "";
    isset($_POST["zustand"]) ? $zustand = test_input($_POST["zustand"]) : $zustand = "";
    isset($_POST["beschreibung"]) ? $beschreibung = test_input($_POST["beschreibung"]) : $beschreibung = "";

    $verfuegbarkeit = $verfuegbarkeit == "on" ? 1 : 0;


    $query = "UPDATE buecher
            SET id = ?, katalog = ?, nummer = ?, kurztitle = ?, kategorie = ?, verkauft = ?, kaufer = ?, autor = ?, title = ?, sprache = ?, foto = ?, verfasser = ?, zustand = ?
            WHERE id = ?";

    include("connection.php");


    // add new book to dbs
    /** @var TYPE_NAME $conn */
    $statement = $conn->prepare($query);
    $statement->execute([$id, $katalog, $number, $title, $kategorie, $verfuegbarkeit, '', $autor, $beschreibung ,$sprache, '', '', $zustand, $id]);

    header("Location: katalog.php?site=1");

} else if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true && $_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $id = test_numeric($_GET["id"]);

    include("connection.php");
    $statement = $conn->prepare("SELECT * FROM buecher WHERE id = ?");
    $statement->execute([$id]);

    $row = $statement->fetch();

    // get data from database to fill in form
    $title = $row["kurztitle"];
    $number = $row["nummer"];
    $kategorie = $row["kategorie"];
    $katalog = $row["katalog"];
    $verfuegbarkeit = $row["verkauft"];
    $autor = $row["autor"];
    $sprache = $row["sprache"] == " " ? "" : $row["sprache"];
    $zustand = $row["zustand"];
    $beschreibung = $row["title"];
} else {
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
    <title>Bücher</title>
</head>
<body>
<section id="modal">
    <div class="modal-frame">
        <h1>Buch ändern</h1>
        <form action="editbook.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <input value="<?=$title?>" required type="text" maxlength="250" placeholder="Titel..." name="title">
            <input value="<?=$number?>" type="number" min="1" max="999" placeholder="Nummer..." name="number">
            <div>
                <select name="kategorie" class="dropdown">
                    <option disabled>Kategorie:</option>
                    <option <?= $kategorie == 1 ? "selected" : ""?> value="1">Alte Drucke, Bibeln</option>
                    <option <?= $kategorie == 2 ? "selected" : ""?> value="2">Geographie und Reisen</option>
                    <option <?= $kategorie == 3 ? "selected" : ""?> value="3">Geschichtswissenschaften</option>
                    <option <?= $kategorie == 4 ? "selected" : ""?> value="4">Naturwissenschaften</option>
                    <option <?= $kategorie == 5 ? "selected" : ""?> value="5">Kinderbücher</option>
                    <option <?= $kategorie == 6 ? "selected" : ""?> value="6">Moderne Literatur und Kunst</option>
                    <option <?= $kategorie == 7 ? "selected" : ""?> value="7">Moderne Künstlergraphik</option>
                    <option <?= $kategorie == 8 ? "selected" : ""?>value="8">Kunstwissenschaften</option>
                    <option <?= $kategorie == 9 ? "selected" : ""?> value="9">Architektur</option>
                    <option <?= $kategorie == 10 ? "selected" : ""?> value="10">Technik</option>
                    <option <?= $kategorie == 11 ? "selected" : ""?> value="11">Naturwissenschaften - Medizin</option>
                    <option <?= $kategorie == 12 ? "selected" : ""?>value="12">Ozeanien</option>
                    <option <?= $kategorie == 13 ? "selected" : ""?>value="13">Afrika</option>
                </select>
                <select name="katalog" class="dropdown">
                    <option disabled>Katalog:</option>
                    <option <?= $katalog == 10 ? "selected" : ""?> value="10">10</option>
                    <option <?= $katalog == 11 ? "selected" : ""?> value="11">11</option>
                    <option <?= $katalog == 12 ? "selected" : ""?> value="12">12</option>
                    <option <?= $katalog == 13 ? "selected" : ""?> value="13">13</option>
                    <option <?= $katalog == 14 ? "selected" : ""?> value="14">14</option>
                    <option <?= $katalog == 15 ? "selected" : ""?> value="15">15</option>
                    <option <?= $katalog == 16 ? "selected" : ""?> value="16">16</option>
                    <option <?= $katalog == 17 ? "selected" : ""?> value="17">17</option>
                    <option <?= $katalog == 18 ? "selected" : ""?> value="18">18</option>
                    <option <?= $katalog == 19 ? "selected" : ""?> value="19">19</option>
                </select>
            </div>
            <div>
                <label for="verfuegbar">Verkauft?</label>
                <input <?= $verfuegbarkeit == 1 ? "checked" : ""?>  id="verfuegbar" name="verfuegbarkeit" type="checkbox">
            </div>
            <input value="<?=$autor?>" type="text" maxlength="250" placeholder="Autor..." name="autor">
            <input value="<?=$sprache?>" type="text" maxlength="250" placeholder="Sprache..." name="sprache">
            <div>
                <label>Zustand?</label>
                <div>
                    <label for="G">Gut</label>
                    <input <?= $zustand == 'G' ? "checked" : ""?> type="radio" value="G" name="zustand" id="G">
                    <label for="M">Mittel</label>
                    <input <?= $zustand == 'M' ? "checked" : ""?> type="radio" value="M" name="zustand" id="M">
                    <label for="S">Schlecht</label>
                    <input <?= $zustand == 'S' ? "checked" : ""?> type="radio" value="S" name="zustand" id="S">
                </div>
            </div>
            <textarea maxlength="60000" placeholder="Beschreibung..." name="beschreibung" id="" cols="30" rows="10"><?=$beschreibung?></textarea>
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