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
<body>
    <?php include("header.php") ?>
    <section>
        <div class="search">
            <div class="search-left">
                <div class="search-bar">
                    <form action="">
                        <input type="text" placeholder="Search...">
                        <button class="search-icon" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <i class="fa-regular fa-square-plus"></i>
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
                <form action="">
                    <h3>Filters</h3>
                    <div class="filter-group">
                        <p>Zustand</p>
                        <input type="radio" id="G" value="G" name="Zustand">
                            <label for="G">Gut</label><br>
                        <input type="radio" id="M" value="M" name="Zustand">
                            <label for="M">Mittel</label><br>
                        <input type="radio" id="S" value="S" name="Zustand">
                            <label for="S">Schlecht</label><br>
                    </div>
                    <div class="filter-group">
                        <p>Verfügbarkeit</p>
                        <input type="radio" id="Vorhanden" value="Vorhanden" name="Verfügbarkeit">
                            <label for="Vorhanden">Vorhanden</label><br>
                        <input type="radio" id="Ausgelehnt" value="Ausgelehnt" name="Verfügbarkeit">
                            <label for="Ausgelehnt">Ausgelehnt</label><br>
                    </div>
                    <div class="filter-group">
                        <p>Kategorie</p>
                        <input type="radio" id="Alte Drucke, Bibeln" value="1" name="Kategorie">
                            <label for="Alte Drucke, Bibeln">Alte Drucke, Bibeln</label><br>
                        <input type="radio" id="Geographie und Reisen" value="2" name="Kategorie">
                            <label for="Geographie und Reisen">Geographie und Reisen</label><br>
                        <input type="radio" id="Geschichtswissenschaften" value="3" name="Kategorie">
                            <label for="Geschichtswissenschaften">Geschichtswissenschaften</label><br>
                        <input type="radio" id="Naturwissenschaften" value="4" name="Kategorie">
                            <label for="Naturwissenschaften">Naturwissenschaften</label><br>
                        <input type="radio" id="Kinderbücher" value="5" name="Kategorie">
                            <label for="Kinderbücher">Kinderbücher</label><br>
                        <input type="radio" id="Moderne Literatur und Kunst" value="6" name="Kategorie">
                            <label for="Moderne Literatur und Kunst">Moderne Literatur und Kunst</label><br>
                        <input type="radio" id="Moderne Künstlergraphik" value="7" name="Kategorie">
                            <label for="Moderne Künstlergraphik">Moderne Künstlergraphik</label><br>
                        <input type="radio" id="Kunstwissenschaften" value="8" name="Kategorie">
                            <label for="Kunstwissenschaften">Kunstwissenschaften</label><br>
                        <input type="radio" id="Architektur" value="9" name="Kategorie">
                            <label for="Architektur">Architektur</label><br>
                        <input type="radio" id="Technik" value="10" name="Kategorie">
                            <label for="Technik">Technik</label><br>
                        <input type="radio" id="Naturwissenschaften - Medizin" value="11" name="Kategorie">
                            <label for="Naturwissenschaften - Medizin">Naturwissenschaften - Medizin</label><br>
                        <input type="radio" id="Ozeanien" value="12" name="Kategorie">
                            <label for="Ozeanien">Ozeanien</label><br>
                        <input type="radio" id="Afrika" value="13" name="Kategorie">
                            <label for="Afrika">Afrika</label><br>
                    </div>
                </form>
            </div>
            <div class="books">
                <?php
                for($i = 0; $i < 18; $i++) {
                    include("bookCard.php");
                }
                ?>
            </div>
        </div>
    </section>
    <?php include("footer.php") ?>
</body>
</html>