<?php session_start() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="favicon.ico">
    <title>myLibrary</title>
</head>
<body>
    <div class="hero">
        <?php include("header.php")?>
        <div class="search-bar">
            <form action="katalog.php">
                <input class="site" name="site" type="text" value="1">
                <input name="q" type="text" placeholder="Suche...">
                <button class="search-icon" type="submit">
                <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <svg width="1342" height="235" viewBox="0 0 1342 235" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M501 154.663C361.218 214.622 275 218.663 0 234.163L1.50204e-05 1.19209e-06C566.333 -0.499999 1614.4 -0.537404 1276 0.662596C853 2.1626 691 73.1626 501 154.663Z" fill="#094D8D"/>
    </svg>
    <section>
        <div class="content left-content">
            <?php
                include("connection.php");

                // choose a random book from the first 500 books for the front page
                $offset = rand(1, 500);
                $query = "SELECT * FROM buecher LIMIT 1 OFFSET $offset";

                /** @var TYPE_NAME $conn */
                $statement = $conn->query($query);

                // getting all the data for this book
                while($row = $statement->fetch()) {
                    $title = $row["kurztitle"];
                    $author = $row["autor"];
                    $description = $row["title"];
                }

                // putting the data into html
                echo "
                    <h1>$title</h1>
                    <p>$author</p>
                    <p>$description</p>
                ";

                // choose a random cover for the front page
                $imgDir = "img/cover/";
                $images = glob($imgDir . "*.{jpg, jpeg, png}", GLOB_BRACE);
                $randImg = $images[array_rand($images)];
            ?>


        </div>
        <div class="content right-content">
            <img src=<?=$randImg?> alt="">
            <svg width="600" height="600" viewBox="0 0 676 676" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="338" cy="338" r="338" fill="#D9D9D9"/>
        </div>
    </section>
    <?php include("footer.php")?>
</body>
</html>