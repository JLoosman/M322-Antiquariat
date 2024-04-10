<link rel="stylesheet" href="css/bookCard.css">

<a href="book.php?id=<?=$id?>}" class="card">
    <?php
        $imgDir = "img/cover/";
        $images = glob($imgDir . "*.{jpg, jpeg, png}", GLOB_BRACE);
        $randImg = $images[array_rand($images)];
    ?>

    <img src="<?=$randImg?>" alt="Cover of a book" class="cover">
    <p class="title"><?=$title?></p>
    <small class="author"><?=$author?></small>
    <h4>CHF <?=rand(10, 90)?>.00</h4>
</a>