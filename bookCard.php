<link rel="stylesheet" href="css/bookCard.css">
<?php
    $imgDir = "img/cover/";
    $images = glob($imgDir . "*.{jpg, jpeg, png}", GLOB_BRACE);
    $randImg = $images[array_rand($images)];
?>
<a href="book.php?id=<?=$id?>&img=<?=$randImg?>" class="card">
    <img src="<?=$randImg?>" alt="Cover of a book" class="cover">
    <p class="title"><?=$title?></p>
    <small class="author"><?=$author?></small>
    <h4>CHF <?=rand(10, 90)?>.00</h4>
</a>