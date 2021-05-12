<?php
require_once "functions/database.php";
$action = new Action();


 if(isset($_SESSION['cart_cost'])){
    
    $Amount = $_SESSION['cart_cost'];
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
//$Amount = $_SESSION['cost']/1000; //Amount will be based on Toman - Required
// $Amount = 10000;
$Description = ' افزایش موجودی کیف پول'; // Required
$Email = 'UserEmail@Mail.Com'; // Optional
$Mobile = "0000"; // Optional
// $CallbackURL = 'http://abarpayo.com/site/wallet-verify.php'; // Required
$CallbackURL = 'http://localhost/abarpaya/shop-verify.php';

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