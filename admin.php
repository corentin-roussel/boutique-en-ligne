<?php
if (session_status() == PHP_SESSION_NONE){ session_start();}
require_once ("autoloader.php");


?>

<!DOCTYPE html>
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

        <button class="button" id="showGames">Show Games</button>

        <div id="placeShowGames">

        </div>
    </main>
    <footer>

    </footer>
</body>
</html>

