<?php
    if(isset($_SESSION['user']))
    {
?>
        <a href="index.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="all-product.php">All products</a>
        <a href="platform.php">Platform</a>
<?php
    }
    else {
?>
        <a href="index.php">Home</a>
        <a href="authentification.php">Authenticate</a>
        <a href="all-product.php">All products</a>
        <a href="platform.php">Platform</a>
        <a href="admin.php">Admin</a>
<?php
    }
?>
