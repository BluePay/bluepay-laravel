<?php

/***
* BluePay PHP Sample Code
*
* This code sample runs a $3.00 Credit Card Sale transaction
* against a customer using test payment information. If
* approved, a 2nd transaction is run to refund the customer
* for $1.75.
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
));

$payment->sale('3.00');

$payment->process();

// If transaction was approved..
if ($payment->isSuccessfulResponse()) {
    
    $paymentRefund = new BluePay();

    $paymentRefund->refund(
        $payment->getTransID(), 
        '1.75' // partial refund of $1.75
    );

    // Makes the API Request to process refund
    $paymentRefund->process();

    // Reads the response from BluePay
    echo 
    'Transaction Status: '. $paymentRefund->getStatus() . "<br/>" .
    'Transaction Message: '. $paymentRefund->getMessage() . "<br/>" .
    'Transaction ID: '. $paymentRefund->getTransID() . "<br/>" .
    'AVS Response: ' . $paymentRefund->getAVSResponse() . "<br/>" .
    'CVS Response: ' . $paymentRefund->getCVV2Response() . "<br/>" .
    'Masked Account: ' . $paymentRefund->getMaskedAccount() . "<br/>" .
    'Card Type: ' . $paymentRefund->getCardType() . "<br/>" .
    'Authorization Code: ' . $paymentRefund->getAuthCode() . "<br/>";
} else {
    echo $payment->getMessage();
}
?>