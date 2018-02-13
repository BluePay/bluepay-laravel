<?php
/**
* BluePay PHP Sample Code
*
* This code sample runs a $0.00 Credit Card Auth transaction
* against a customer using test payment information.
* See comments below on the details of the initial setup of the
* rebilling cycle.
*/

use BluePay\bluepay\BluePay;

$rebill = new BluePay();

$rebill->setCustomerInformation(array(
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
 
$rebill->setCCInformation(array(
    'cardNumber' => '4111111111111111', // Card Number: 4111111111111111
    'cardExpire' => '1225', // Card Expire: 12/25
    'cvv2' => '123' // Card CVV2: 123
));

$rebill->setRebillingInformation(array(
   'rebillFirstDate' => '2015-01-05', // Rebill Start Date: Jan. 5, 2015
   'rebillExpression' => '1 MONTH', // Rebill Frequency: 1 MONTH
   'rebillCycles' => '5', // Rebill # of Cycles: 5
   'rebillAmount' => '3.50' // Rebill Amount: $3.50
));

$rebill->auth('0.00');

// Makes the API Request with BluePay
$rebill->process();

if ($rebill->isSuccessfulResponse()) {
    // Read response from BluePay
    echo 
    'Transaction ID: '. $rebill->getTransID() . "<br/>" .
    'Rebill ID: ' . $rebill->getRebillID() . "<br/>" .
    'Status: '. $rebill->getStatus() . "<br/>" .
    'Message: '. $rebill->getMessage() . "<br/>" .
    'AVS Response: ' . $rebill->getAVSResponse() . "<br/>" .
    'CVS Response: ' . $rebill->getCVV2Response() . "<br/>" .
    'Masked Account: ' . $rebill->getMaskedAccount() . "<br/>" .
    'Card Type: ' . $rebill->getCardType() . "<br/>" .
    'Authorization Code: ' . $rebill->getAuthCode() . "<br/>";
} else {
    echo $rebill->getMessage();
}

?>