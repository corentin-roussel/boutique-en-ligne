<?php
    
    if(session_status() == PHP_SESSION_NONE){ session_start();}
    
    require_once 'controller/UserController.php';
    $user = new UserController();
?>

<?php if(isset($_GET['inscription'])): ?>
    
    <div id="divForm">

        <form action="" method="POST" id="signupForm" class="form">
            <h2>Sign up</h2>

            <label for="login">Login</label>
            <input type="text" name="login" placeholder="Login" required />
            <div id="errorLogin" class="error"></div>

            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Email" required />
            <div id="errorEmail" class="error"></div>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required />

            <label for="confpassword">Password confirmation</label>
            <input type="password" name="passwordConfirm" placeholder="Confirm password" required />
            <div id="errorPass" class="error"></div>

            <button type="submit">Submit</button>

        </form>

    </div>

<?php die (); endif ?>


<?php if(isset($_GET['connexion'])): ?>

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

<?php die(); endif ?>



<?php

    !isset($_GET['signup']) ?: $user->Register($_POST['login'], $_POST['email'], $_POST['password'], $_POST['passwordConfirm']);

    !isset($_GET['signin']) ?: $user->Connect($_POST['login'], $_POST['password']);

?>