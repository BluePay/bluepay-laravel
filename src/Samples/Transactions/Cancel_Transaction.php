<?php
/**
* BluePay PHP Sample Code
*
* This code sample runs a $3.00 Credit Card Sale transaction
* against a customer using test payment information.
* If approved, a 2nd transaction is run to cancel this transaction
* If using TEST mode, odd dollar amounts will return
* an approval and even dollar amounts will return a decline.
*/

use Margules\bplib\BluePay;

$payment = new BluePay();

$payment->setCustomerInformation(array(
    'firstName' => 'Bob', 
    'lastName' => 'Tester', 
    'addr1' => '1234 Test St.', 
    'addr2' => 'Apt #500', 
    'city' => 'Testville', 
    'state' => 'IL', 
    'zip' =>'54321', 
    'country' => 'USA', 
    'phone' => '1231231234', 
    'email' => 'test@bluepay.com' 
));

$payment->setCCInformation(array(
    'cardNumber' => '4111111111111111', // Card Number: 4111111111111111
    'cardExpire' => '1225', // Card Expire: 12/25
    'cvv2' => '123' // Card CVV2: 123
    )
);

$payment->sale('3.00');

$payment->process();

// If transaction was approved..
if ($payment->isSuccessfulResponse()) {

    $cancelPayment = new BluePay(
        $accountID,
        $secretKey,
        $mode
    );

    $cancelPayment->void($payment->getTransID());

    $cancelPayment->process();

    // Read response from BluePay
    echo 
    'Transaction Status: '. $payment->getStatus() . "<br/>" .
    'Transaction Message: '. $payment->getMessage() . "<br/>" .
    'Transaction ID: '. $payment->getTransID() . "<br/>" .
    'AVS Response: ' . $payment->getAVSResponse() . "<br/>" .
    'CVS Response: ' . $payment->getCVV2Response() . "<br/>" .
    'Masked Account: ' . $payment->getMaskedAccount() . "<br/>" .
    'Card Type: ' . $payment->getCardType() . "<br/>" .
    'Authorization Code: ' . $payment->getAuthCode() . "<br/>";
} else {
    echo $payment->getMessage();
}
?>