<?php

require_once ("autoloader.php");

    use App\Controller\AdminControllerGame;

        $AdminController = new  AdminControllerGame();
    if(isset($_GET['submitGame']))
    {
        $AdminController->insertGame($_POST["title"], $_POST["desc"], $_POST["price"], $_POST["image"], $_POST["release_date"], $_POST["developper"], $_POST["publisher"], $_POST["category"], $_POST["subcategory"]);
    }
?>

<!doctype html>
<html lang="en">
<head>
   <?php require_once("_include/head.php") ?>
    <script defer src="admin_game.js"></script>
    <title>Admin</title>
</head>
<body>
    <header>

    </header>
    <main>
        <button class="button" id="addFormGame">Add Game</button>

        <div id="placeAddGame">

        </div>
    </main>
    <footer>

    </footer>
</body>
</html>

