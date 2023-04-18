<?php
    if(session_status() == PHP_SESSION_NONE){ session_start();}
    require_once ("autoloader.php");

    use App\Controller\ProductController;

    $ProductController = new ProductController();

    if(isset($_GET['getArray']))
    {
        $ProductController->getPreorderGame();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <?php require_once ('_include/head.php') ?>
    <script src="index.js" defer></script>
    <title>Accueil</title>
</head>
<body>
    <header>
        <?php require_once ('_include/header.php') ?>
    </header>
    <main>
        <section id="carousel">
            <article id="controls">
                <button id="prev">
                    PREV
                </button>
                <button id="next">
                    NEXT
                </button>
            </article>
            <a href="" id="carousel-link">
                <img src="" alt="" id="carousel-img">
            </a>
        </section>
        <section>
            <article>
                <h2>New Released Games</h2>
                <a href="all_products.php"><h4>See more</h4></a>
            </article>
            <article class="display-new-released-games">
                <?php
                    foreach($ProductController->getNewReleasedGames() as $key => $games)
                    {
                        echo $games;
                    };
                ?>
            </article>
        </section>
        <section>
            <article>
                <h2>Try Something New</h2>
                <a href="all_products.php"><h4>See more</h4></a>
            </article>
        </section>
    </main>
    <footer>
        <?php require_once ('_include/footer.php') ?>
    </footer>
</body>
</html>