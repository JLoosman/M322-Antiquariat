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
                    <select class="dropdown" form="searchQuery" >
                        <option selected value="nummer">Nummer (ID)</option>
                        <option value="title">Titel</option>
                        <option value="kategorie">Kategorie</option>
                        <option value="autor">Autor</option>
                        <i class="fa-solid fa-angle-down"></i>
                    </select>
                    <!--  -->
                <i class="fa-solid fa-circle-chevron-down"></i>
            </div>
        </div>
        <div class="content">
            <div class="filters">
                <form>
                    <h3>Filters</h3>
                    <div class="filter-group">
                        <p>Zustand</p>
                        <input form="searchQuery" type="checkbox" <?= isset($_GET["zustand"]) ? ($_GET["zustand"] == "G" ? "checked" : "") : ""?> id="G" value="G" name="zustand[]">
                            <label for="G">Gut</label><br>
                        <input form="searchQuery" type="checkbox" <?= isset($_GET["zustand"]) ? ($_GET["zustand"] == "M" ? "checked" : "") : ""?>id="M" value="M" name="zustand[]">
                            <label for="M">Mittel</label><br>
                        <input form="searchQuery" type="checkbox" <?= isset($_GET["zustand"]) ? ($_GET["zustand"] == "S" ? "checked" : "") : ""?>id="S" value="S" name="zustand[]">
                            <label for="S">Schlecht</label><br>
                    </div>
                    <div class="filter-group">
                        <p>Verfügbarkeit</p>
                        <input form="searchQuery" type="checkbox" id="Vorhanden" value="0" name="verfuegbarkeit[]">
                            <label for="Vorhanden">Vorhanden</label><br>
                        <input form="searchQuery" type="checkbox" id="Ausgelehnt" value="1" name="verfuegbarkeit[]">
                            <label for="Ausgelehnt">Verkauft</label><br>
                    </div>
                    <div class="filter-group">
                        <p>Kategorie</p>
                        <input form="searchQuery" type="checkbox" id="Alte Drucke, Bibeln" value="1" name="kategorie[]">
                            <label for="Alte Drucke, Bibeln">Alte Drucke, Bibeln</label><br>
                        <input form="searchQuery" type="checkbox" id="Geographie und Reisen" value="2" name="kategorie[]">
                            <label for="Geographie und Reisen">Geographie und Reisen</label><br>
                        <input form="searchQuery" type="checkbox" id="Geschichtswissenschaften" value="3" name="kategorie[]">
                            <label for="Geschichtswissenschaften">Geschichtswissenschaften</label><br>
                        <input form="searchQuery" type="checkbox" id="Naturwissenschaften" value="4" name="kategorie[]">
                            <label for="Naturwissenschaften">Naturwissenschaften</label><br>
                        <input form="searchQuery" type="checkbox" id="Kinderbücher" value="5" name="kategorie[]">
                            <label for="Kinderbücher">Kinderbücher</label><br>
                        <input form="searchQuery" type="checkbox" id="Moderne Literatur und Kunst" value="6" name="kategorie[]">
                            <label for="Moderne Literatur und Kunst">Moderne Literatur und Kunst</label><br>
                        <input form="searchQuery" type="checkbox" id="Moderne Künstlergraphik" value="7" name="kategorie[]">
                            <label for="Moderne Künstlergraphik">Moderne Künstlergraphik</label><br>
                        <input form="searchQuery" type="checkbox" id="Kunstwissenschaften" value="8" name="kategorie[]">
                            <label for="Kunstwissenschaften">Kunstwissenschaften</label><br>
                        <input form="searchQuery" type="checkbox" id="Architektur" value="9" name="kategorie[]">
                            <label for="Architektur">Architektur</label><br>
                        <input form="searchQuery" type="checkbox" id="Technik" value="10" name="kategorie[]">
                            <label for="Technik">Technik</label><br>
                        <input form="searchQuery" type="checkbox" id="Naturwissenschaften - Medizin" value="11" name="kategorie[]">
                            <label for="Naturwissenschaften - Medizin">Naturwissenschaften - Medizin</label><br>
                        <input form="searchQuery" type="checkbox" id="Ozeanien" value="12" name="kategorie[]">
                            <label for="Ozeanien">Ozeanien</label><br>
                        <input form="searchQuery" type="checkbox" id="Afrika" value="13" name="kategorie[]">
                            <label for="Afrika">Afrika</label><br>
                    </div>
                </form>
            </div>
            <div class="book-display">
                <div class="books" id="books">
                    <?php

                    include("connection.php");
                    // base SQL query for site
                    $query = "SELECT * FROM buecher";
                    $offset = $site * 12 - 12;

                    // check if any search criterias are given
                    if(isset($_GET["q"])) {
                        $q = $_GET["q"];
                        // add search criterias to SQL query
                        $query = $query . " WHERE (kurztitle LIKE '%$q%' OR autor LIKE '%$q%')";

                        // check for every type of checkbox if its used and add to SQL query if needed
                        if(isset($_GET["zustand"])) {
                            $zustand = $_GET["zustand"];
                            if(count($zustand) > 1) {
                                $query = $query . " AND (";
                                foreach ($zustand as $item) {
                                    $query = $query . " zustand = '$item' OR";
                                }
                                $query = rtrim($query, " OR") . ")";
                            } else {
                                $query = $query . " AND zustand = '$zustand[0]'";
                            }
                        }
                        if(isset($_GET["verfuegbarkeit"])) {
                            $verfuegbarkeit = $_GET["verfuegbarkeit"];
                            if(count($verfuegbarkeit) > 1) {
                                $query = $query . " AND (";
                                foreach ($verfuegbarkeit as $item) {
                                    $query = $query . " verkauft = '$item' OR";
                                }
                                $query = rtrim($query, " OR") . ")";
                            } else {
                                $query = $query . " AND verkauft = '$verfuegbarkeit[0]'";
                            }
                        }
                        if(isset($_GET["kategorie"])) {
                            $kategorie = $_GET["kategorie"];
                            if(count($kategorie) > 1) {
                                $query = $query . " AND (";
                                foreach ($kategorie as $item) {
                                    $query = $query . " kategorie = '$item' OR";
                                }
                                $query = rtrim($query, " OR") . ")";
                            } else {
                                $query = $query . " AND kategorie = '$kategorie[0]'";
                            }
                        }
                    }

                    // add ending to SQL query to only show 12 datasets per page and and offset to view different result on further pages
                    $query = $query . " LIMIT 12 OFFSET $offset";

                    // running SQL query
                    /** @var TYPE_NAME $conn */
                    $statement = $conn->query($query);


                    // outputing content of query
                    while ($row = $statement->fetch()) {
                        $id = $row["id"];
                        $title = $row["kurztitle"];
                        $author = $row["autor"];
                        include("bookCard.php");
                    }

                    // get count of available datasets
                    $countStatement = substr_replace($query, "COUNT(*)", 7, 1);
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
<script src="script.js"></script>
</html>