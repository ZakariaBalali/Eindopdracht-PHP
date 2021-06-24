<?php
/*
 * How to verify Mollie API Payments in a webhook.
 *
 * See: https://docs.mollie.com/guides/webhooks
 */

try {
    require_once ("mollie/vendor/autoload.php");
    require_once ("mollie/examples/functions.php");

    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey("test_kWeW5tjftHhThty23qAtNeaDyQERjC");

    $payment = $mollie->payments->get($_POST["id"]);
    $orderId = $payment->metadata->order_id;

    /*
     * Update the order in the database.
     */
    database_write($orderId, $payment->status);

    if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
    } elseif ($payment->isOpen()) {
        /*
         * The payment is open.
         */
    } elseif ($payment->isPending()) {
        /*
         * The payment is pending.
         */
    } elseif ($payment->isFailed()) {
        /*
         * The payment has failed.
         */
    } elseif ($payment->isExpired()) {
        /*
         * The payment is expired.
         */
    } elseif ($payment->isCanceled()) {
        /*
         * The payment has been canceled.
         */
    } elseif ($payment->hasRefunds()) {
        /*
         * The payment has been (partially) refunded.
         * The status of the payment is still "paid"
         */
    } elseif ($payment->hasChargebacks()) {
        /*
         * The payment has been (partially) charged back.
         * The status of the payment is still "paid"
         */
    }
} catch (\Mollie\Api\Exceptions\ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}