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
    <title>Document</title>
</head>
<body>
    <?php include("header.php"); ?>
    <?php
    if(isset($_GET["id"])) {

        include("connection.php");
        /** @var TYPE_NAME $conn */
        $statement = $conn->prepare("SELECT * FROM buecher WHERE id = :id");

        $statement->execute(["id" => $_GET['id']]);

        $row = $statement->fetch();

        $title = $row["kurztitle"];
        $author = $row["autor"];
        $description = $row["title"];
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
            <h1><?=$title?></h1>
            <h3><?=$author?></h3>
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