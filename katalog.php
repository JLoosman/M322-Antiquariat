<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/katalog.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<?php
    if(!isset($_GET["site"])) {
        $site = 1;
    } else {
        $site = $_GET["site"];
        if ($site < 1) {
           header("Location: katalog.php?site=1");
        }
    }
?>
<body>
    <?php include("header.php") ?>
    <section>
        <div class="search">
            <div class="search-left">
                <div class="search-bar">
                    <form id="searchQuery" action="katalog.php" method="get">
                        <input name="q" type="text" placeholder="Search...">
                        <button class="search-icon" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <!-- <i class="fa-regular fa-square-plus"></i> -->
            </div>
            <div class="search-right">
                <h3>Sortieren nach:</h3>
                <div class="dropdown">
                    <p>Name</p>
                    <i class="fa-solid fa-angle-down"></i>
                </div>
                <i class="fa-solid fa-circle-chevron-down"></i>
            </div>
        </div>
        <div class="content">
            <div class="filters">
                <form>
                    <h3>Filters</h3>
                    <div class="filter-group">
                        <p>Zustand</p>
                        <input form="searchQuery" type="checkbox" <?= isset($_GET["zustand"]) ? ($_GET["zustand"] == "G" ? "checked" : "") : ""?> id="G" value="G" name="zustand">
                            <label for="G">Gut</label><br>
                        <input form="searchQuery" type="checkbox" <?= isset($_GET["zustand"]) ? ($_GET["zustand"] == "M" ? "checked" : "") : ""?>id="M" value="M" name="zustand">
                            <label for="M">Mittel</label><br>
                        <input form="searchQuery" type="checkbox" <?= isset($_GET["zustand"]) ? ($_GET["zustand"] == "S" ? "checked" : "") : ""?>id="S" value="S" name="zustand">
                            <label for="S">Schlecht</label><br>
                    </div>
                    <div class="filter-group">
                        <p>Verfügbarkeit</p>
                        <input form="searchQuery" type="checkbox" id="Vorhanden" value="Vorhanden" name="Verfügbarkeit">
                            <label for="Vorhanden">Vorhanden</label><br>
                        <input form="searchQuery" type="checkbox" id="Ausgelehnt" value="Ausgelehnt" name="Verfügbarkeit">
                            <label for="Ausgelehnt">Ausgelehnt</label><br>
                    </div>
                    <div class="filter-group">
                        <p>Kategorie</p>
                        <input form="searchQuery" type="checkbox" id="Alte Drucke, Bibeln" value="1" name="Kategorie">
                            <label for="Alte Drucke, Bibeln">Alte Drucke, Bibeln</label><br>
                        <input form="searchQuery" type="checkbox" id="Geographie und Reisen" value="2" name="Kategorie">
                            <label for="Geographie und Reisen">Geographie und Reisen</label><br>
                        <input form="searchQuery" type="checkbox" id="Geschichtswissenschaften" value="3" name="Kategorie">
                            <label for="Geschichtswissenschaften">Geschichtswissenschaften</label><br>
                        <input form="searchQuery" type="checkbox" id="Naturwissenschaften" value="4" name="Kategorie">
                            <label for="Naturwissenschaften">Naturwissenschaften</label><br>
                        <input form="searchQuery" type="checkbox" id="Kinderbücher" value="5" name="Kategorie">
                            <label for="Kinderbücher">Kinderbücher</label><br>
                        <input form="searchQuery" type="checkbox" id="Moderne Literatur und Kunst" value="6" name="Kategorie">
                            <label for="Moderne Literatur und Kunst">Moderne Literatur und Kunst</label><br>
                        <input form="searchQuery" type="checkbox" id="Moderne Künstlergraphik" value="7" name="Kategorie">
                            <label for="Moderne Künstlergraphik">Moderne Künstlergraphik</label><br>
                        <input form="searchQuery" type="checkbox" id="Kunstwissenschaften" value="8" name="Kategorie">
                            <label for="Kunstwissenschaften">Kunstwissenschaften</label><br>
                        <input form="searchQuery" type="checkbox" id="Architektur" value="9" name="Kategorie">
                            <label for="Architektur">Architektur</label><br>
                        <input form="searchQuery" type="checkbox" id="Technik" value="10" name="Kategorie">
                            <label for="Technik">Technik</label><br>
                        <input form="searchQuery" type="checkbox" id="Naturwissenschaften - Medizin" value="11" name="Kategorie">
                            <label for="Naturwissenschaften - Medizin">Naturwissenschaften - Medizin</label><br>
                        <input form="searchQuery" type="checkbox" id="Ozeanien" value="12" name="Kategorie">
                            <label for="Ozeanien">Ozeanien</label><br>
                        <input form="searchQuery" type="checkbox" id="Afrika" value="13" name="Kategorie">
                            <label for="Afrika">Afrika</label><br>
                    </div>
                </form>
            </div>
            <div class="book-display">
                <div class="books">
                    <?php

                    include("connection.php");

                    /** @var TYPE_NAME $conn */
                    $offset = $site * 12 - 12;
                    // $statement = $conn->prepare("SELECT * FROM buecher LIMIT 12 OFFSET {$offset}");
                    $statement = $conn->prepare(
                            "SELECT * FROM buecher
                                    WHERE 
                                        kurztitle LIKE :kurztitle 
                                       OR 
                                        autor LIKE :author 
                                        AND
                                        zustand = :zustand
                                    LIMIT 12 
                                    OFFSET {$offset}");

                    // passing arguments of form to query using prepared statements
                    if(isset($_GET["q"])) {
                        $queryParam = $_GET["q"];
                        if(isset($_GET["zustand"])) {
                            $zustandParam = $_GET["zustand"];
                            $statement->execute(["kurztitle" => "%{$queryParam}%", "author" => "%{$queryParam}%", "zustand" => "$zustandParam"]);
                        } else {
                        $statement->execute(["kurztitle" => "%{$queryParam}%", "author" => "%{$queryParam}%", "zustand" => ""]);
                        }

                    } else {
                        $statement->execute(["kurztitle" => "%%", "author" => "%%", "zustand" => ""]);
                    }

                    // outputing content of query
                    while($row = $statement->fetch()) {
                        $id = $row["id"];
                        $title = $row["kurztitle"];
                        $author = $row["autor"];
                        include("bookCard.php");
                    }

                    // get count of available datasets
                    $countStatement = "SELECT COUNT(*) FROM buecher";
                    $totalSites = ceil(($conn->query($countStatement)->fetchColumn(0)) / 12);

                    ?>
                    <div class="site-changer">
                        <a href="katalog.php?site=<?=$site - 1?>"><i class="fa-solid fa-angle-left"></i></a>
                        <p>Seite<?=" $site von $totalSites"?></p>
                        <a href="katalog.php?site=<?=$site + 1?>"><i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include("footer.php") ?>
</body>
</html>