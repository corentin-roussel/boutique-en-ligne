<?php

    if(session_status() == PHP_SESSION_NONE){ session_start();}

    require_once ("autoloader.php");

    use App\Controller\AdminControllerGame;

        $AdminController = new AdminControllerGame();

    if(isset($_GET['submitGame']))
    {
        $AdminController->insertGame($_POST["title"], $_POST["desc"], $_POST["price"], $_POST["image"], $_POST["release_date"], $_POST["developper"], $_POST["publisher"], $_POST["category"], $_POST["subcategory"]);
    }


    use App\Controller\AdminControllerUser;
    $adminUser = new AdminControllerUser();
    
    !isset($_GET['getAllRoles']) ?: ($adminUser->GetAllRoles()) . (die());

    !isset($_GET['actualRole']) ?: ($adminUser->GetAllRoleExeptActual($_GET['actualRole'])) . (die());

    !isset($_GET['inputRole']) ?: ($adminUser->GetUsersDataByRole($_GET['inputRole'])) . (die());

    if(isset($_GET['tableUserRole'])) : $dataUsers = $adminUser->GetUsersDataByRole($_GET['tableUserRole']);

        ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>LOGIN</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($dataUsers as $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['login'] ?></td>
                        <td>
                            <select name="<?= $user['id'] ?>" id="changeRoleUser<?= $user['id'] ?>" class="selectChangeRole">
                                <option value="<?= $user['id'] ?>"><?= $user['role'] ?></option>
                                <?php $otherRoles = $adminUser->GetAllRoleExeptActual($user['id_role']) ?>
                                <?php foreach ($otherRoles as $role) : ?>
                                    <option value="<?= $role['id'] ?>"><?= $role['role'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td><button class="infoUser" value="<?= $user['id'] ?>">INFOS</button></td>
                        <td><button class="supprUser" value="<?= $user['id'] ?>">DELETE</button></td>
                    </tr>
                    
                    <tr id="infosUser<?= $user['id'] ?>" style="display: none;">
                        <td colspan="5">
                            <p>email : <?= $user['email'] ?></p>
                            <p>first name : <?= $user['firstname'] ?></p>
                            <p>last name : <?= $user['lastname'] ?></p>
                            <p>birth date : <?= $user['birth_date'] ?></p>
                            <p>phone number : <?= $user['phone_number'] ?></p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    <?php die(); endif;

    !isset($_GET['changeRole']) ?: ($adminUser->ChangeUserRole($_GET['changeRole'], $_GET['userId'])) . (die());

    !isset($_GET['deleteUser']) ?: ($adminUser->DeleteUser($_GET['deleteUser'])) . (die());

    if(isset($_SESSION) && $_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'moderator') :
    
?>

<!doctype html>
<html lang="en">
<head>
   <?php require_once("_include/head.php") ?>
    <script defer src="admin_game.js"></script>
    <script defer src="admin_user.js"></script>
    <title>Admin</title>
</head>
<body>
    <header>

    </header>
    <main>

        <h2>User manager</h2>

        <select name="roles" id="role">
            <option value="all">-- Choose a role --</option>
        </select>

        <div id="displayUserData"></div>



        <h2>Game manager</h2>

        <button class="button" id="addFormGame">Add Game</button>

        <div id="placeAddGame">

        </div>
    </main>
    <footer>

    </footer>
</body>
</html>

<?php endif ?>