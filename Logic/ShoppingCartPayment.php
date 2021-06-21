<?php
require_once dirname(__FILE__) . '/../Logic/mollie/vendor/autoload.php';

session_start();
if (isset($_POST['ConfirmButton'])) {
    $price =
        number_format((float)$_POST["Price"], 2, '.', '');
    echo $price;
    CallMollieAPI($price);
}


function CallMollieAPI($price)
{

    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey("test_kWeW5tjftHhThty23qAtNeaDyQERjC");

    $amount = $price;
    $description = "Ticket buyer";
    $payment = $mollie->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => "$amount"

        ],
        "description" => "$description",
        "redirectUrl" => "http://localhost/Frontend/Eindopdracht/View/PaymentSuccess.php",
        "webhookUrl" => "http://636655.infhaarlem.nl/Logic/Webhook.php",

    ]);
    header("Location: " . $payment->getCheckoutUrl(), true, 303);
}

?>
