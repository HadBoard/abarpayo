<?php
require_once "functions/database.php";
require_once "const-values.php";
$action = new Action();


$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
// $Amount = 10000; //Amount will be based on Toman
$Amount =$_SESSION['cart_cost'];

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
    // var_dump($result);
    if($action->user()){

        $id = $action->user()->id;
        $action->remove_cart($id,1);
        $command = $action->payment_add($Amount,2,$result->RefID,1);

    }else if($action->marketer()){

        $id = $action->marketer()->id;
        $action->remove_cart($id,0);
        $command = $action->marketer_payment_add($id,$Amount,2,$result->RefID,1);
    }
    unset($_SESSION['already_in_gateway']);
    $_SESSION['successful_pay'] = 'true';
    header("Location: factor.php");


} else {
    unset($_SESSION['already_in_gateway']);
    $_SESSION['successful_pay'] = 'false';
    header("Location: factor.php");
}
} else {   
    unset($_SESSION['already_in_gateway']); 
    header("Location: shopping-cart.php");
}