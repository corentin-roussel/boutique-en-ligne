<?php

require_once ("autoloader.php");
if (session_status() == PHP_SESSION_NONE){ session_start();}

use App\Controller\PaymentController;

$PaymentController = new PaymentController();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>Your order is complete</h1>
    </main>
</body>
</html>
