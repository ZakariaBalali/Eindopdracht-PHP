<?php
require_once dirname(__FILE__) . '/../Logic/mollie/vendor/autoload.php';

session_start();
if (isset($_POST['ConfirmButton'])) {
    $price = 50;
    CallMollieAPI();
}


function CallMollieAPI()
{

    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey("test_kWeW5tjftHhThty23qAtNeaDyQERjC");

    $amount = $_POST["Price"];
    $description = "Ticket buyer";
    $payment = $mollie->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => "$amount"

        ],
        "description" => "$description",
        "redirectUrl" => "http://636655.infhaarlem.nl/View/MakePdf.php",
        "webhookUrl" => "http://636655.infhaarlem.nl/Logic/Webhook.php",

    ]);
    header("Location: " . $payment->getCheckoutUrl(), true, 303);
}

?>
