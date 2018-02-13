<?php
/**
* BluePay PHP Sample Code
*
* Charges a customer $3.00 using the payment information from a previous transaction. 
* If using TEST mode, odd dollar amounts will return
* an approval and even dollar amounts will return a decline.
*/

use Margules\bplib\BluePay;

$payment = new BluePay();

$token = "Transaction ID here"; 

$payment->sale(
	'3.00', 
	$token 
);

$payment->process();

if($payment->isSuccessfulResponse()){
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
} else{
    echo $payment->getMessage() . "<br/>";
}
?>
