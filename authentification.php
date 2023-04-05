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

    <main>

        <form action="" method="POST">

            <a href="index.php"><h2>Sign in</h2></a>

            <label for="login">Login</label>
            <input type="text" name="login" id="login" placeholder="login" required />
            <div id="errorLogin" class="error"></div>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required />
            <div id="errorPass" class="error"></div>

            <button type="submit">Submit</button>

            <p>Not registered yet?</p>

        </form>

    </main>

</body>

</html>