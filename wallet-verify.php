<?php
require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();
   
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
// $Amount = 10000; //Amount will be based on Toman
$Amount =$_SESSION['increase_amount'];
$Authority = $_GET['Authority'];

if ($_GET['Status'] == 'OK') {

$client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentVerification(
[
'MerchantID' => $MerchantID,
'Authority' => $Authority,
'Amount' => $Amount,
]
);

if ($result->Status == 100) {
// echo '<br>Transation success. RefID:'.$result->RefID;
$command = $action->payment_add($Amount,$cart_number,$result->RefID,1);
$action->wallet_log_add("افزایش موجودی کیف پول",$Amount,1,$command);
$action->user_wallet_edit($Amount,1);
$_SESSION['successful_pay'] = 'true';
echo "<script> location.href='profile.php?wallet'; </script>";

} else {
    $_SESSION['successful_pay'] = 'false';
    echo "<script> location.href='profile.php?wallet'; </script>";
}
} else {    
    echo 'Transaction canceled by user';
}