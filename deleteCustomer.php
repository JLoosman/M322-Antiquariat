<?php
session_start();
include("testInput.php");

if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {

    isset($_GET["id"]) ? $id = test_input($_GET["id"]) : $id = "";

    $query = "DELETE FROM kunden WHERE kid = ?";

    include("connection.php");

    /** @var TYPE_NAME $conn */
    $statement = $conn->prepare($query);
    $statement->execute([$id]);

    header("Location: kunden.php?site=1");
} else {
    header("Location: kunden.php?site=1");
}