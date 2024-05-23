<?php
session_start();

if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true && $_SERVER["REQUEST_METHOD"] == "POST"){

    isset($_POST["title"]) ? $title = $_POST["title"] : $title = "";
    isset($_POST["number"]) ? $number = $_POST["number"] : $number = "";
    isset($_POST["kategorie"]) ? $kategorie = $_POST["kategorie"] : $kategorie = "";
    isset($_POST["katalog"]) ? $katalog = $_POST["katalog"] : $katalog = "";
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

    /** @var TYPE_NAME $conn */
    $newID = $conn->query("SELECT max(id) FROM buecher")->fetchColumn() + 1;


    /** @var TYPE_NAME $conn */
    $statement = $conn->prepare($query);
    $statement->execute([$newID, $katalog, $number, $title, $kategorie, $verfuegbarkeit, "", $autor, $beschreibung ,$sprache, "", "", $zustand]);
}

header("Location: katalog.php?site=1");