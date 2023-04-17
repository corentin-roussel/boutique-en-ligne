<?php
    if(isset($_SESSION['user'])):

?>
        <a href="index.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="all_product.php">All products</a>
        <a href="platform.php">Platform</a>
        <a href="disconnect.php">Disconnect</a>
    <?php
        if($_SESSION['user']['role'] === "admin" || $_SESSION['user']['role'] === "moderator"):
    ?>
        <a href="admin.php">Admin</a>
<?php
        endif;
    else :
?>
        <a href="index.php">Home</a>
        <a href="authentification.php">Authenticate</a>
        <a href="all-product.php">All products</a>
        <a href="platform.php">Platform</a>
        <a href="admin.php">Admin</a>
<?php
    endif;
?>
