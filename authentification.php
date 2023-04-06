<?php
if (session_status() == PHP_SESSION_NONE){ session_start();}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once '_include/head.php' ?>
    <script src="authentification.js" defer></script>
    <title>Authenticate</title>
</head>

<body>

    <header><a href="index.php"><h1>GAME VAULT</h1></a></header>

    <main id="main">

        <div id="divForm">

            <form action="" method="POST" id="signinForm" class="form">

                <h2>Sign in</h2>

                <label for="login">Login</label>
                <input type="text" name="login" id="login" placeholder="login" required />
                <div id="errorLogin" class="error"></div>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required />
                <div id="errorPass" class="error"></div>

                <button type="submit">Submit</button>

            </form>

        </div>

        <p id="switchInscription">Not registered yet?</p>
        <p id="switchConnexion" style="display: none"><< Back</p>

    </main>

</body>

</html>