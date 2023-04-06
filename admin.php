<?php


require_once('./src/controllers/PlateformController.php');

use App\controllers\AdminPlateform;


$add_platform = new AdminPlateform();

if (isset($_POST['content'])) {
    $add_platform->addForm($_POST['content']);
    die();
}



?>


<!DOCTYPE html>
<html lang="Fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINK SCRIPT JS  -->
    <script defer src="./scripts/admin.js"></script>
    <!-- LINK CSS -->
    <link rel="stylesheet" href="./assets/Admin_style.css">
    <title>Game Vault - Boutique en ligne</title>
</head>

<body>

    <?php require_once('./_include/header.php'); ?>

    <div class="container-dash-admin">
        <h2>Dashboard Admin</h2>
    </div>

    <div class="container-user-man">
        <h3>User Manager</h3>
    </div>


    <div class="container-pro-stock">
        <h3>Product & Stock management</h3>
    </div>

    <div class="container-title-platform">
        <h4>Plateform</h4>
    </div>

    <div class="container-btn-plateforme">

        <button type="button" id="add_plat">Add Plateform</button>
        <button type="button" id="del-plat">Delete Plateform</button>
    </div>

    <div class="form-add-plateform">
        <form action="" method="POST" id="form-insert-plateform">
            <label for="plateform"></label>
            <input type="text" name="content" id="content" placeholder="Write a plateform">
            <button type="submit" name="submit_form" value="submit_form">ADD</button>
        </form>
    </div>

    <div class="container-mess-plateform">
        
    </div>

    <table>
        <thead>
            <tr>
                <th> Platforms
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>

            </tr>
        </tbody>
    </table>

</body>

</html>