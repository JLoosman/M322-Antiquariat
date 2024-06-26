<?php
    session_start();

    if(!isset($_SESSION["isAdmin"]) && !$_SESSION["isAdmin"] == true){
        header("Location: login.php");
    }
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
    <title>Kunden</title>
</head>
<?php
    // function to simplify input validation
    include("testInput.php");

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
        $site = test_numeric($_GET["site"]);
        if ($site < 1) {
           header("Location: katalog.php?site=1");
        }
    }
?>
<body>
    <?php include("header.php") ?>
    <main>
        <div class="search">
            <div class="search-left">
                <div class="search-bar">
                    <form id="searchQuery" action="kunden.php?site=1" method="get">
                        <input class="site" name="site" value="1" type="text">
                        <input name="q" type="text" placeholder="Suche...">
                        <button class="search-icon" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <a href="addcustomer.php">
                    <svg width="40" height="34" viewBox="0 0 40 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M38 14H36V12C36 11.4696 35.7893 10.9609 35.4142 10.5858C35.0391 10.2107 34.5304 10 34 10C33.4696 10 32.9609 10.2107 32.5858 10.5858C32.2107 10.9609 32 11.4696 32 12V14H30C29.4696 14 28.9609 14.2107 28.5858 14.5858C28.2107 14.9609 28 15.4696 28 16C28 16.5304 28.2107 17.0391 28.5858 17.4142C28.9609 17.7893 29.4696 18 30 18H32V20C32 20.5304 32.2107 21.0391 32.5858 21.4142C32.9609 21.7893 33.4696 22 34 22C34.5304 22 35.0391 21.7893 35.4142 21.4142C35.7893 21.0391 36 20.5304 36 20V18H38C38.5304 18 39.0391 17.7893 39.4142 17.4142C39.7893 17.0391 40 16.5304 40 16C40 15.4696 39.7893 14.9609 39.4142 14.5858C39.0391 14.2107 38.5304 14 38 14ZM22.6 17.44C23.6672 16.5163 24.5231 15.3738 25.1097 14.09C25.6964 12.8063 26 11.4114 26 10C26 7.34784 24.9464 4.8043 23.0711 2.92893C21.1957 1.05357 18.6522 0 16 0C13.3478 0 10.8043 1.05357 8.92893 2.92893C7.05357 4.8043 6 7.34784 6 10C5.99998 11.4114 6.3036 12.8063 6.89025 14.09C7.4769 15.3738 8.33284 16.5163 9.4 17.44C6.60028 18.7078 4.22493 20.7551 2.55796 23.3371C0.89099 25.9191 0.00294371 28.9266 0 32C0 32.5304 0.210714 33.0391 0.585786 33.4142C0.960859 33.7893 1.46957 34 2 34C2.53043 34 3.03914 33.7893 3.41421 33.4142C3.78929 33.0391 4 32.5304 4 32C4 28.8174 5.26428 25.7652 7.51472 23.5147C9.76516 21.2643 12.8174 20 16 20C19.1826 20 22.2348 21.2643 24.4853 23.5147C26.7357 25.7652 28 28.8174 28 32C28 32.5304 28.2107 33.0391 28.5858 33.4142C28.9609 33.7893 29.4696 34 30 34C30.5304 34 31.0391 33.7893 31.4142 33.4142C31.7893 33.0391 32 32.5304 32 32C31.9971 28.9266 31.109 25.9191 29.442 23.3371C27.7751 20.7551 25.3997 18.7078 22.6 17.44ZM16 16C14.8133 16 13.6533 15.6481 12.6666 14.9888C11.6799 14.3295 10.9108 13.3925 10.4567 12.2961C10.0026 11.1997 9.88378 9.99334 10.1153 8.82946C10.3468 7.66557 10.9182 6.59647 11.7574 5.75736C12.5965 4.91824 13.6656 4.3468 14.8295 4.11529C15.9933 3.88378 17.1997 4.0026 18.2961 4.45672C19.3925 4.91085 20.3295 5.67988 20.9888 6.66658C21.6481 7.65327 22 8.81331 22 10C22 11.5913 21.3679 13.1174 20.2426 14.2426C19.1174 15.3679 17.5913 16 16 16Z" fill="#434343"/>
                    </svg>
                </a>
            </div>
            <div class="search-right">
                <h3>Sortieren nach:</h3>
                <select name="sortBy" id="dropdown" class="dropdown">
                    <option selected value="kid">Nummer (ID)</option>
                    <option value="vorname">Name</option>
                </select>
                <i id="sortingSymbol" class="fa-solid fa-arrow-down-wide-short"></i>
            </div>
        </div>
        <div class="content">
            <div class="filters">
                <form>
                    <h3>Filters</h3>
                    <div class="filter-group">
                        <p>Geschlecht</p>
                        <input form="searchQuery" type="checkbox" id="M" value="M" name="geschlecht[]" <?= isCheckboxSet("geschlecht", "M")?>>
                            <label for="M">Männlich</label><br>
                        <input form="searchQuery" type="checkbox" id="F" value="F" name="geschlecht[]" <?= isCheckboxSet("geschlecht", "F")?>>
                            <label for="F">Weiblich</label><br>
                    </div>
                    <div class="filter-group">
                        <p>Kontakt per Email</p>
                        <input form="searchQuery" type="checkbox" id="Erwünscht" value="1" name="kontakt[]" <?= isCheckboxSet("kontakt", "1")?>>
                            <label for="Erwünscht">Erwünscht</label><br>
                        <input form="searchQuery" type="checkbox" id="Nicht Erwünscht" value="0" name="kontakt[]" <?= isCheckboxSet("kontakt", "0")?>>
                            <label for="Nicht Erwünscht">Nicht Erwünscht</label><br>
                    </div>
                </form>
            </div>
            <div class="book-display">
                <h3 id="noResults" class="hidden">Keine Resultate gefunden...</h3>
                <div class="books" id="books">
                    <?php

                    include("connection.php");
                    // base SQL query for site
                    $query = "SELECT * FROM kunden";
                    $offset = $site * 12 - 12;

                    // check if any search criterias are given
                    if(isset($_GET["q"])) {
                        $q = test_input($_GET["q"]);
                        // add search criterias to SQL query
                        $query = $query . " WHERE (kid LIKE '%$q%' OR vorname LIKE '%$q%')";
                    }

                    // check for every type of checkbox if its used and add to SQL query if needed
                    if(isset($_GET["geschlecht"])) {
                        $geschlecht = test_input($_GET["geschlecht"]);
                        if(count($geschlecht) > 1) {
                            $query = $query . " AND (";
                            foreach ($geschlecht as $item) {
                                $query = $query . " geschlecht = '$item' OR";
                            }
                            $query = rtrim($query, " OR") . ")";
                        } else {
                            $query = $query . " AND geschlecht = '$geschlecht[0]'";
                        }
                    }
                    if(isset($_GET["kontakt"])) {
                        $kontakt = test_input($_GET["kontakt"]);
                        if(count($kontakt) > 1) {
                            $query = $query . " AND (";
                            foreach ($kontakt as $item) {
                                $query = $query . " kontaktpermail = '$item' OR";
                            }
                            $query = rtrim($query, " OR") . ")";
                        } else {
                            $query = $query . " AND kontaktpermail = '$kontakt[0]'";
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
                        $id = $row["kid"];
                        $firstname = $row["vorname"];
                        $lastname = $row["name"];
                        include("customerCard.php");
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
                        <a href=<?=str_replace("site=$site", "site=1", $_SERVER["REQUEST_URI"])?>><img src="img/chevron-left.svg" alt=""></a>
                        <a href=<?=str_replace("site=$site", "site=$siteBefore", $_SERVER["REQUEST_URI"])?>><i class="fa-solid fa-angle-left"></i></a>
                        <p>Seite<?=" $site von $totalSites"?></p>
                        <a href=<?=str_replace("site=$site", "site=$siteAfter", $_SERVER["REQUEST_URI"])?>><i class="fa-solid fa-angle-right"></i></a>
                        <a href="<?=str_replace("site=$site", "site=$totalSites", $_SERVER["REQUEST_URI"])?>"><img src="img/chevron-right.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("footer.php") ?>
</body>
<script src="kunden.js"></script>
</html>