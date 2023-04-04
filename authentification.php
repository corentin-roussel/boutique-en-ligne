<?php
if (session_status() == PHP_SESSION_NONE){ session_start();}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once('head.php')?>
    <script src="authentification.js" defer></script>
    <title>Authenticate</title>
</head>

<body>
    <header>
        <?php require_once '_header.php' ?>
    </header>

    <main id="main">

        <div id="buttons">
            <button id="switchInscription">Sign up</button>
            <button id="switchConnexion">Sign in</button>
        </div>

        <div id="divForm"></div>

    </main>

    <footer>
        <?php require_once '_include/footer.php' ?>
    </footer>

</body>

</html>