# Bluepay Package for Laravel 5.6.x

## 1. Copy your BluePay credentials to .env file
	BP_ACCOUNT_ID="Merchant's Account ID Here"
	BP_SECRET_KEY="Merchant's Secret Key Here"
	BP_MODE="TEST"

## 2. Add Service Provider and Facade to config/app.php.
	"Margules\bplib\BluePayServiceProvider::class," to "providers" array
	"'BluePay' => Margules\bplib\Facades\BluePay::class," to "aliases" array

## 3. Test transaction using sample file
	Ex. 'require_once('Samples/Transactions/Charge_Customer_CC.php');'

## 4. Include namespace to run a transaction
	Place 'use Margules\bplib\BluePay;' at the top of files you wish to run transactions.