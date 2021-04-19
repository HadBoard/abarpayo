<?php
include('functions/database.php');   
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
$increase_amount = $_SESSION['increase_amount']; //Amount will be based on Toman
$Authority = $_GET['Authority'];
$user_id = $action->user()->id;
//die($Amount);

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
//echo 'Transation success. RefID:'.$result->RefID;
    $command = $action->payment_add($amount,$cart_number,$reference_code,$status);
    $action->wallet_log_add("increase wallet by user",$increase_amount,1,$command);
    $action->user_wallet_edit($increase_amount,1);
    echo "<script> location.href='profile.php?wallet'; </script>";
} else {
    echo 'Transation failed. Status:'.$result->Status;
   
}
} else {
// echo 'Transaction canceled by user';
    echo "<script> location.href='profile.php?wallet'; </script>";
}