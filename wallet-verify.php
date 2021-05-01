<?php
require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();


$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
// $Amount = 10000; //Amount will be based on Toman
 if(isset($_SESSION['app'])){
    $Amount =$_SESSION['amount'];
}else{
    $Amount =$_SESSION['increase_amount'];
}

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
 if(isset($_SESSION['app'])){
    $user_id = $_SESSION['user_id'];
    $command = $action->app_payment_add($user_id,$Amount,$cart_number,$result->RefID,1);
     $action->app_wallet_log_add($user_id,"افزایش موجودی کیف پول",$Amount,1,$command);
     $action->app_user_wallet_edit($user_id,$Amount,1);
     $_SESSION['app-wallet'] = 'success';
    echo "<script> location.href='http://abarpayo.com/site/return.php'; </script>";
}

    if($action->user()){

        $command = $action->payment_add($Amount,$cart_number,$result->RefID,1);
        $action->wallet_log_add("افزایش موجودی کیف پول",$Amount,1,$command);
        $action->user_wallet_edit($Amount,1);

    }else if($action->marketer()){

        $id = $action->marketer()->id;
        $command = $action->marketer_payment_add($id,$Amount,$cart_number,$result->RefID,1);
        $action->marketer_wallet_log_add($id,"افزایش موجودی کیف پول",$Amount,1,$command);
        $action->marketer_wallet_edit($id,$Amount,1);
    }
    
    $_SESSION['successful_pay'] = 'true';
    echo "<script> location.href='profile.php?wallet'; </script>";

} else {
    if(isset($_SESSION['app'])){
    $_SESSION['app-wallet'] = 'fail';
    echo "<script> location.href='http://abarpayo.com/site/return.php'; </script>";
    }
    $_SESSION['successful_pay'] = 'false';
    echo "<script> location.href='profile.php?wallet'; </script>";
}
} else {    
  if(isset($_SESSION['app'])){
    $_SESSION['app-wallet'] = 'cancel';
   echo "<script> location.href='http://abarpayo.com/site/return.php'; </script>";
}
    echo "<script> location.href='profile.php?wallet'; </script>";
}