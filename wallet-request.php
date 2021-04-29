<?php
require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

if(isset($_POST['wallet_increase']) || isset($_SESSION['app'])){
    if(isset($_SESSION['app'])){
        $amount = $_SESSION['amount'];
    }else{
    $amount = $action->request('amount');
    $_SESSION['increase_amount'] = $amount;
    }
    $Amount = $amount;
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
//$Amount = $_SESSION['cost']/1000; //Amount will be based on Toman - Required
// $Amount = 10000;
$Description = ' افزایش موجودی کیف پول'; // Required
$Email = 'UserEmail@Mail.Com'; // Optional
$Mobile = "0000"; // Optional
$CallbackURL = 'http://abarpayo.com/site/wallet-verify.php'; // Required

$client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentRequest(
    [
        'MerchantID' => $MerchantID,
        'Amount' => $Amount,
        'Description' => $Description,
        'Email' => $Email,
        'Mobile' => $Mobile,
        'CallbackURL' => $CallbackURL,
    ]
);

if ($result->Status == 100) {
    Header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
} else {
    echo "invalid";
  
}
}