<?php
session_start();
include("testInput.php");

if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true) {

    isset($_GET["id"]) ? $id = test_input($_GET["id"]) : $id = "";

    $query = "DELETE FROM buecher WHERE id = ?";

    include("connection.php");

    /** @var TYPE_NAME $conn */
    $statement = $conn->prepare($query);
    $statement->execute([$id]);

    header("Location: katalog.php?site=1");
} else {
    header("Location: katalog.php?site=1");
}