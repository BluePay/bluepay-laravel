<?php

/***
* BluePay PHP Sample Code
*
# This code sample runs a $3.00 Credit Card Sale transaction
# against a customer using test payment information. If
# approved, a 2nd transaction is run to update the first transaction 
# to $5.75, $2.75 more than the original $3.00.
# If using TEST mode, odd dollar amounts will return
# an approval and even dollar amounts will return a decline.
*/

use BluePay\bluepay\BluePay;

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

    $paymentUpdate = new BluePay();

    $paymentUpdate->update(
        $payment->getTransID(), 
        '5.75' // add $2.75 to previous amount
    );

    // Makes the API Request to process update
    $paymentUpdate->process();

    // Reads the response from BluePay
    echo 
    'Transaction Status: '. $paymentUpdate->getStatus() . "<br/>" .
    'Transaction Message: '. $paymentUpdate->getMessage() . "<br/>" .
    'Transaction ID: '. $paymentUpdate->getTransID() . "<br/>" .
    'AVS Response: ' . $paymentUpdate->getAVSResponse() . "<br/>" .
    'CVS Response: ' . $paymentUpdate->getCVV2Response() . "<br/>" .
    'Masked Account: ' . $paymentUpdate->getMaskedAccount() . "<br/>" .
    'Card Type: ' . $paymentUpdate->getCardType() . "<br/>" .
    'Authorization Code: ' . $paymentUpdate->getAuthCode() . "<br/>";
} else {
    echo $payment->getMessage();
}
?>