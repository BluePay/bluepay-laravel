<?php
/**
  * BluePay PHP Sample Code
  *
  * This code sample runs a $3.00 ACH Sale transaction
  * against a customer using test payment information.
  *
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

$payment->setACHInformation(array(
    'routingNumber' =>'123123123', // Routing Number: 123123123
    'accountNumber' => '1234567890', // Account Number: 1234567890
    'accountType' => 'C', // Account Type: Checking
    'documentType' => 'WEB' // ACH Document Type: WEB
));

$payment->sale('3.00'); // Sale Amount: $3.00

// Makes the API Request with BluePay
$payment->process();

// Read response from BluePay
if($payment->isSuccessfulResponse()){
    echo 
    'Status: '. $payment->getStatus() . "<br/>" .
    'Message: '. $payment->getMessage() . "<br/>" .
    'Transaction ID: '. $payment->getTransID() . "<br/>" .
    'Masked Account: ' . $payment->getMaskedAccount() . "<br/>" .
    'Customer Bank: ' . $payment->getBank() . "<br/>";
} else{
    echo $payment->getMessage() . "<br/>";
}
?>