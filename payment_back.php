<?php

require_once ("autoloader.php");
if (session_status() == PHP_SESSION_NONE){ session_start();}


use App\Controller\PaymentController;

$PaymentController = new PaymentController();

if(isset($_GET['shippingAdress']))
{
    $PaymentController = new PaymentController();

    $PaymentController->getAdress($_SESSION['user']['id']);
}

if(isset($_GET['summaryGame']))
{
    $PaymentController = new PaymentController();

    $PaymentController->getSummaryGames($_SESSION['user']['actualCart']);
}

if(isset($_GET['updateCart']))
{
    $PaymentController = new PaymentController();

    $PaymentController->verifFormPayment(isset($_POST['shipping']), $_POST['card-number'], $_POST['expiration-date'], $_POST['cvv'], $_POST['name'], $_SESSION['user']['actualCart'], $_SESSION['user']['id']);
}



?>




<?php if(isset($_GET['formPayment'])) : ?>
<h2>Credit/Debit Card</h2>
<form action="" id="payment" method="POST">
    <label for="card_number">Card Number</label>
    <input type="text" name="card-number" id="card-number" placeholder="1234 5678 9012 3456" maxlength="19">
    <small id="error-card-number"></small>

    <label for="expiration-date">Expiration Date</label>
    <input type="text" name="expiration-date" id="expiration-date" placeholder="12/34" maxlength="5">
    <small id="error-expiration-date"></small>

    <label for="cvv">CVC/CVV</label>
    <input type="text" name="cvv" id="cvv" placeholder="123" maxlength="3">
    <small id="error-cvv"></small>

    <label for="name">Name on Card</label>
    <input type="text" id="name" name="name" placeholder="Jhon Doe">
    <small id="error-card-name"></small>
</form>
<?php endif; ?>

<?php if(isset($_GET['buttonBuy'])): ?>
<div>
    <div>
        <p>TOTAL : </p>
        <p><?php  $cartPrice = $PaymentController->getCart($_SESSION['user']['id']); echo $cartPrice['total_price']  ?></p>
    </div>
    <input form="payment" id="buy" type="submit" value="Buy!">
</div>
<?php endif; ?>
