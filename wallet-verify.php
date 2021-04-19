<?php
require_once "functions/database.php";
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
$command = $action->payment_add($Amount,123,1234,1);
$action->wallet_log_add("increase wallet by user",$Amount,1,$command);
$action->user_wallet_edit($Amount,1);
echo "<script> location.href='profile.php?wallet'; </script>";

} else {
      echo 'Transation failed. Status:'.$result->Status;
}
} else {    
    echo 'Transaction canceled by user';
}