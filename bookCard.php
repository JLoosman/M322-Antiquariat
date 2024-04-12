<link rel="stylesheet" href="css/bookCard.css">

<?php
    $imgDir = "img/cover/";
    $images = glob($imgDir . "*.{jpg, jpeg, png}", GLOB_BRACE);
    $randImg = $images[array_rand($images)];

    if(isset($_SESSION["prices"])) {
        $count = $id % 12;
    } else {
        $priceArr = [];
        for($i = 0; $i < 12; $i++) {
            $priceArr[$i] = rand(10, 90);
        }
        $_SESSION["prices"] = $priceArr;
    }
?>

<a href="book.php?id=<?=$id?>&img=<?=$randImg?>" class="card">
    <img src="<?=$randImg?>" alt="Cover of a book" class="cover">
    <p class="title"><?=$title?></p>
    <small class="author"><?=$author?></small>
    <h4>CHF <?=$_SESSION["prices"][$count]?>.00</h4>
</a>