# Bluepay Package for Laravel 5.6.x

## 1. Add BluePay dependency to composer.json "require" array.
	"BluePay/bluepay" : "dev-master"

## 2. Copy your BluePay credentials to .env file
	BP_ACCOUNT_ID="Merchant's Account ID Here"
	BP_SECRET_KEY="Merchant's Secret Key Here"
	BP_MODE="TEST"

## 3. Add Service Provider and Facade to config/app.php.
	"BluePay\bluepay\BluePayServiceProvider::class," to "providers" array
	"'BluePay' => BluePay\bluepay\Facades\BluePay::class," to "aliases" array

## 4. Run composer dump-autoload.

## 5. Include namespace to run a transaction
	Place 'use BluePay\bluepay\BluePay;' at the top of files you wish to run transactions.

## 6. Test transaction using sample file
	Ex. 'require_once('Samples/Transactions/Charge_Customer_CC.php');'