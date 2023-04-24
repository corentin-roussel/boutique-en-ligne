<?php

require_once ("autoloader.php");
if (session_status() == PHP_SESSION_NONE){ session_start();}



?>


<!doctype html>
<html lang="en">
<head>
    <?php require_once('_include/head.php') ?>
    <link rel="stylesheet" href="assets/payments.css">
    <script defer src="payment.js"></script>
    <title>Payment</title>
</head>
<body>
    <header>

    </header>
    <main class="flex-all">
        <section class="flex-payment">
            <h1 class="title-payment">Shipping Method</h1>
            <article id="shipping_method">

            </article>
            <a href="shipping_info.php"><< Create a new adress</a>
        </section>
        <section class="flex-payment">
            <h1 class="title-payment">Payment Method</h1>
            <article id="payment_method">

            </article>
        </section>
        <section class="flex-payment">
            <h1 class="title-payment">Summary</h1>
            <article id="summary_game">

            </article>
        </section>
        <article id="button_buy">

        </article>
    </main>
    <footer>

    </footer>
</body>
</html>
