<?php

require_once ("autoloader.php");
if (session_status() == PHP_SESSION_NONE){ session_start();}



?>


<!doctype html>
<html lang="en">
<head>
    <?php require_once('_include/head.php') ?>
    <script defer src="payment.js"></script>
    <title>Payment</title>
</head>
<body>
    <header>

    </header>
    <main>
        <h1>Shipping Method</h1>
        <section id="shipping_method">

        </section>
        <a href="shipping_info.php"><< Create a new adress</a>
        <h1>Payment Method</h1>
        <section id="payment_method">

        </section>

        <h1>Summary</h1>
        <section id="summary_game">

        </section>
        <section id="button_buy">

        </section>
    </main>
    <footer>

    </footer>
</body>
</html>