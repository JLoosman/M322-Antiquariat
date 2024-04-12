<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/book.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Details</title>
</head>
<body>
    <?php include("header.php"); ?>
    <?php
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

    if(isset($_GET["id"])) {

        include("connection.php");
        /** @var TYPE_NAME $conn */
        $statement = $conn->prepare("SELECT * FROM buecher WHERE id = :id");

        $statement->execute(["id" => test_input($_GET['id'])]);

        $row = $statement->fetch();

        $title = $row["kurztitle"];
        $author = ($row["autor"] == " " ? "Kein Autor bekannt" : $row["autor"]);
        $description = $row["title"];
        $available = $row["verkauft"];
        $category = $row["kategorie"];

        if ($category <= 13) {
            $statement = $conn->prepare("SELECT * FROM kategorien WHERE id = :kategorieID");

            $statement->execute(["kategorieID" => $category]);

            $categoryRow = $statement->fetch();

            $category = $categoryRow["kategorie"];
        } else {
            $category = "Kategorie unbekannt";
        }

    } else {
        header("Location: katalog.php");
    }
    ?>
    <main>
        <div class="left-content">
            <img src=<?=$_GET["img"]?> alt="">
            <svg width="600" height="600" viewBox="0 0 676 676" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="338" cy="338" r="338" fill="#D9D9D9"/>
        </div>
        <div class="right-content">
            <div class="top">
                <h1><?=$title?></h1>
                <?= $available ? '<i class="unavailable fa-regular fa-circle-xmark"></i>': '<i class="available fa-regular fa-circle-check"></i>'?>
            </div>
            <div class="mid">
                <h3><?=$author?></h3>
                <h3 class="category" ><?=$category?></h3>
            </div>
            <div class="rating">
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
            </div>
            <p><?=$description?></p>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>
</html>