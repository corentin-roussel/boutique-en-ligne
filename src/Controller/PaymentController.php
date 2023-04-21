<?php

namespace App\Controller;
use App\Model\PaymentModel;

class PaymentController
{
    private $model;

    public function __construct() {
        $this->model = new PaymentModel();
    }

    public function verifFormPayment(?string $idAdress, ?int $cardNumber, ?int $cardExpiration, ?int $cardAuth, ?string $cardName) {

        $date = new Date("Y-m-d");
        echo $date;

        if(is_int($idAdress) == 1 && grapheme_strlen($cardNumber == 19) && grapheme_strlen($cardExpiration == 5) && grapheme_strlen($cardAuth == 3) && isset($cardName))
        {
//            $this->model->
        }

    }

    public function getAdress($id) {

        $this->model->getAdressByIdUser($id);
    }

    public function getSummaryGames($id_cart) {
        $this->model->getSummaryGame($id_cart);
    }
}