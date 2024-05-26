<?php
    session_start();
?>
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
    <link rel="icon" type="image/png" href="favicon.ico">
    <title>Katalog</title>
</head>
<?php
    // function to simplify input validation
    function test_input($data) {
        if(is_array($data)) {
            $arr = [];
            foreach ($data as $dataset) {
                array_push($arr, test_input($dataset));
            }
            return $arr;
        } else {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }

    function isCheckboxSet($category, $value) {
        if(!isset($_GET[$category])) {
            return false;
        } else {
            return in_array($value, $_GET[$category]) ? "checked" : "";
        }
    }

    // if side variable is set in url set side to this value
    if(!isset($_GET["site"])) {
        $site = 1;
    } else {
        $site = test_input($_GET["site"]);
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
                    <form id="searchQuery" action="katalog.php?site=1" method="get">
                        <input class="site" name="site" value="1" type="text">
                        <input name="q" type="text" placeholder="Suche...">
                        <button class="search-icon" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <?php
                    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
                        echo '
                            <a href="addbook.php">
                                <svg width="36" height="40" viewBox="0 0 36 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M34 32H32V30C32 29.4696 31.7893 28.9609 31.4142 28.5858C31.0391 28.2107 30.5304 28 30 28C29.4696 28 28.9609 28.2107 28.5858 28.5858C28.2107 28.9609 28 29.4696 28 30V32H26C25.4696 32 24.9609 32.2107 24.5858 32.5858C24.2107 32.9609 24 33.4696 24 34C24 34.5304 24.2107 35.0391 24.5858 35.4142C24.9609 35.7893 25.4696 36 26 36H28V38C28 38.5304 28.2107 39.0391 28.5858 39.4142C28.9609 39.7893 29.4696 40 30 40C30.5304 40 31.0391 39.7893 31.4142 39.4142C31.7893 39.0391 32 38.5304 32 38V36H34C34.5304 36 35.0391 35.7893 35.4142 35.4142C35.7893 35.0391 36 34.5304 36 34C36 33.4696 35.7893 32.9609 35.4142 32.5858C35.0391 32.2107 34.5304 32 34 32ZM20 36H6C5.46957 36 4.96086 35.7893 4.58579 35.4142C4.21071 35.0391 4 34.5304 4 34V6C4 5.46957 4.21071 4.96086 4.58579 4.58579C4.96086 4.21071 5.46957 4 6 4H16V10C16 11.5913 16.6321 13.1174 17.7574 14.2426C18.8826 15.3679 20.4087 16 22 16H28V22C28 22.5304 28.2107 23.0391 28.5858 23.4142C28.9609 23.7893 29.4696 24 30 24C30.5304 24 31.0391 23.7893 31.4142 23.4142C31.7893 23.0391 32 22.5304 32 22V14C32 14 32 14 32 13.88C31.9792 13.6963 31.9389 13.5153 31.88 13.34V13.16C31.7838 12.9544 31.6556 12.7653 31.5 12.6L19.5 0.6C19.3347 0.444432 19.1456 0.316162 18.94 0.22C18.8738 0.208419 18.8062 0.208419 18.74 0.22C18.5455 0.116006 18.3365 0.041844 18.12 0H6C4.4087 0 2.88258 0.632141 1.75736 1.75736C0.632141 2.88258 0 4.4087 0 6V34C0 35.5913 0.632141 37.1174 1.75736 38.2426C2.88258 39.3679 4.4087 40 6 40H20C20.5304 40 21.0391 39.7893 21.4142 39.4142C21.7893 39.0391 22 38.5304 22 38C22 37.4696 21.7893 36.9609 21.4142 36.5858C21.0391 36.2107 20.5304 36 20 36ZM20 6.82L25.18 12H22C21.4696 12 20.9609 11.7893 20.5858 11.4142C20.2107 11.0391 20 10.5304 20 10V6.82ZM10 12C9.46957 12 8.96086 12.2107 8.58579 12.5858C8.21071 12.9609 8 13.4696 8 14C8 14.5304 8.21071 15.0391 8.58579 15.4142C8.96086 15.7893 9.46957 16 10 16H12C12.5304 16 13.0391 15.7893 13.4142 15.4142C13.7893 15.0391 14 14.5304 14 14C14 13.4696 13.7893 12.9609 13.4142 12.5858C13.0391 12.2107 12.5304 12 12 12H10ZM20 28H10C9.46957 28 8.96086 28.2107 8.58579 28.5858C8.21071 28.9609 8 29.4696 8 30C8 30.5304 8.21071 31.0391 8.58579 31.4142C8.96086 31.7893 9.46957 32 10 32H20C20.5304 32 21.0391 31.7893 21.4142 31.4142C21.7893 31.0391 22 30.5304 22 30C22 29.4696 21.7893 28.9609 21.4142 28.5858C21.0391 28.2107 20.5304 28 20 28ZM22 20H10C9.46957 20 8.96086 20.2107 8.58579 20.5858C8.21071 20.9609 8 21.4696 8 22C8 22.5304 8.21071 23.0391 8.58579 23.4142C8.96086 23.7893 9.46957 24 10 24H22C22.5304 24 23.0391 23.7893 23.4142 23.4142C23.7893 23.0391 24 22.5304 24 22C24 21.4696 23.7893 20.9609 23.4142 20.5858C23.0391 20.2107 22.5304 20 22 20Z" fill="#434343"/>
                                </svg>
                            </a>
                        ';
                    }
                ?>
            </div>
            <div class="search-right">
                <h3>Sortieren nach:</h3>
                <select name="sortBy" id="dropdown" class="dropdown">
                    <option selected value="id">Nummer (ID)</option>
                    <option value="kurztitle">Titel</option>
                    <option value="kategorie">Kategorie</option>
                    <option value="autor">Autor</option>
                </select>
                <i id="sortingSymbol" class="fa-solid fa-arrow-down-wide-short"></i>
            </div>
        </div>
        <div class="content">
            <div class="filters">
                <form>
                    <h3>Filters</h3>
                    <div class="filter-group">
                        <p>Zustand</p>
                        <input form="searchQuery" type="checkbox" id="G" value="G" name="zustand[]" <?= isCheckboxSet("zustand", "G")?>>
                            <label for="G">Gut</label><br>
                        <input form="searchQuery" type="checkbox" id="M" value="M" name="zustand[]" <?= isCheckboxSet("zustand", "M")?>>
                            <label for="M">Mittel</label><br>
                        <input form="searchQuery" type="checkbox" id="S" value="S" name="zustand[]" <?= isCheckboxSet("zustand", "S")?>>
                            <label for="S">Schlecht</label><br>
                    </div>
                    <div class="filter-group">
                        <p>Verfügbarkeit</p>
                        <input form="searchQuery" type="checkbox" id="Vorhanden" value="0" name="verfuegbarkeit[]" <?= isCheckboxSet("verfuegbarkeit", "0")?>>
                            <label for="Vorhanden">Vorhanden</label><br>
                        <input form="searchQuery" type="checkbox" id="Ausgelehnt" value="1" name="verfuegbarkeit[]" <?= isCheckboxSet("verfuegbarkeit", "1")?>>
                            <label for="Ausgelehnt">Verkauft</label><br>
                    </div>
                    <div class="filter-group">
                        <p>Kategorie</p>
                        <input form="searchQuery" type="checkbox" id="Alte Drucke, Bibeln" value="1" name="kategorie[]" <?= isCheckboxSet("kategorie", "1")?>>
                            <label for="Alte Drucke, Bibeln">Alte Drucke, Bibeln</label><br>
                        <input form="searchQuery" type="checkbox" id="Geographie und Reisen" value="2" name="kategorie[]" <?= isCheckboxSet("kategorie", "2")?>>
                            <label for="Geographie und Reisen">Geographie und Reisen</label><br>
                        <input form="searchQuery" type="checkbox" id="Geschichtswissenschaften" value="3" name="kategorie[]" <?= isCheckboxSet("kategorie", "3")?>>
                            <label for="Geschichtswissenschaften">Geschichtswissenschaften</label><br>
                        <input form="searchQuery" type="checkbox" id="Naturwissenschaften" value="4" name="kategorie[]" <?= isCheckboxSet("kategorie", "4")?>>
                            <label for="Naturwissenschaften">Naturwissenschaften</label><br>
                        <input form="searchQuery" type="checkbox" id="Kinderbücher" value="5" name="kategorie[]" <?= isCheckboxSet("kategorie", "5")?>>
                            <label for="Kinderbücher">Kinderbücher</label><br>
                        <input form="searchQuery" type="checkbox" id="Moderne Literatur und Kunst" value="6" name="kategorie[]" <?= isCheckboxSet("kategorie", "6")?>>
                            <label for="Moderne Literatur und Kunst">Moderne Literatur und Kunst</label><br>
                        <input form="searchQuery" type="checkbox" id="Moderne Künstlergraphik" value="7" name="kategorie[]" <?= isCheckboxSet("kategorie", "7")?>>
                            <label for="Moderne Künstlergraphik">Moderne Künstlergraphik</label><br>
                        <input form="searchQuery" type="checkbox" id="Kunstwissenschaften" value="8" name="kategorie[]" <?= isCheckboxSet("kategorie", "8")?>>
                            <label for="Kunstwissenschaften">Kunstwissenschaften</label><br>
                        <input form="searchQuery" type="checkbox" id="Architektur" value="9" name="kategorie[]" <?= isCheckboxSet("kategorie", "9")?>>
                            <label for="Architektur">Architektur</label><br>
                        <input form="searchQuery" type="checkbox" id="Technik" value="10" name="kategorie[]" <?= isCheckboxSet("kategorie", "10")?>>
                            <label for="Technik">Technik</label><br>
                        <input form="searchQuery" type="checkbox" id="Naturwissenschaften - Medizin" value="11" name="kategorie[]" <?= isCheckboxSet("kategorie", "11")?>>
                            <label for="Naturwissenschaften - Medizin">Naturwissenschaften - Medizin</label><br>
                        <input form="searchQuery" type="checkbox" id="Ozeanien" value="12" name="kategorie[] <?= isCheckboxSet("kategorie", "12")?>">
                            <label for="Ozeanien">Ozeanien</label><br>
                        <input form="searchQuery" type="checkbox" id="Afrika" value="13" name="kategorie[]" <?= isCheckboxSet("kategorie", "13")?>>
                            <label for="Afrika">Afrika</label><br>
                    </div>
                </form>
            </div>
            <div class="book-display">
                <h3 id="noResults" class="hidden">Keine Resultate gefunden...</h3>
                <div class="books" id="books">
                    <?php

                    include("connection.php");
                    // base SQL query for site
                    $query = "SELECT * FROM buecher";
                    $offset = $site * 12 - 12;

                    // check if any search criterias are given
                    if(isset($_GET["q"])) {
                        $q = test_input($_GET["q"]);
                        // add search criterias to SQL query
                        $query = $query . " WHERE (kurztitle LIKE '%$q%' OR autor LIKE '%$q%')";

                        // check for every type of checkbox if its used and add to SQL query if needed
                        if(isset($_GET["zustand"])) {
                            $zustand = test_input($_GET["zustand"]);
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
                            $verfuegbarkeit = test_input($_GET["verfuegbarkeit"]);
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
                            $kategorie = test_input($_GET["kategorie"]);
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

                    // if an sorting option is present in the url apply it to the querry
                    if(isset($_GET["sortBy"])) {
                        $sort = test_input($_GET["sortBy"]);

                        $query = $query . " ORDER BY $sort";

                        if(isset($_GET["desc"])) {
                            $query = $query . " DESC";
                        }
                    }

                    // add ending to SQL query to only show 12 datasets per page and and offset to view different result on further pages
                    $query = $query . " LIMIT 12 OFFSET $offset";
                    // echo $query;
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
                    $countStatement = substr($countStatement, 0, strpos($countStatement, "OFFSET"));
                    // i have to use this to fix the site bug at the bottom of page
                    $totalSites = ceil(($conn->query($countStatement)->fetchColumn(0)) / 12);

                    ?>
                    <div id="sitechanger" class="site-changer">
                        <?php

                            $siteBefore = $site-1;
                            $siteAfter = $site+1;

                            // if the next site would be over the maximal site limit it goes back to the first site
                            if($siteAfter > $totalSites) {
                                $siteAfter = 1;
                            }
                        ?>
                        <a href=<?=str_replace("site=$site", "site=$siteBefore", $_SERVER["REQUEST_URI"])?>><i class="fa-solid fa-angle-left"></i></a>
                        <p>Seite<?=" $site von $totalSites"?></p>
                        <a href=<?=str_replace("site=$site", "site=$siteAfter", $_SERVER["REQUEST_URI"])?>><i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include("footer.php") ?>
</body>
<script src="script.js"></script>
</html>