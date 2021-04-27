<?php
require_once "functions/database.php";
$action = new Action();
if(isset($_SESSION['marketer_package'])){
    $amount = $_SESSION['marketer_package'];
    unset($_SESSION['marketer_package']);
    $_SESSION['marketer_amount'] = $amount;
    $Amount = $amount;
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
//$Amount = $_SESSION['cost']/1000; //Amount will be based on Toman - Required
// $Amount = 10000;
$Description = 'پرداخت هزینه پکیج توسط بازارساز'; // Required
$Email = 'UserEmail@Mail.Com'; // Optional
$Mobile = "0000"; // Optional
$CallbackURL = 'http://localhost/abarpaya/marketer-package-verify.php'; // Required

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
  
}
}