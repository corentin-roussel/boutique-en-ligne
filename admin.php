<?php
if (session_status() == PHP_SESSION_NONE){ session_start();}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once '_include/head.php' ?>
    <script src="admin_user.js" defer></script>
    <title>Admin</title>
</head>

<body>

    <header><?php require_once '_include/header.php' ?></header>

    <main>

        <h2>User manager</h2>

        <select name="roles" id="role">
            <option value="all">-- Choose a role --</option>
        </select>

        <div id="displayUserData"></div>

    </main>

    <footer><?php require_once '_include/footer.php' ?></footer>

</body>

</html>