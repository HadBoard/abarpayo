<?php
require_once "functions/database.php";
require_once "const-values.php";
$action = new Action();


$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
// $Amount = 10000; //Amount will be based on Toman
if(isset($_SESSION['app'])){
    $Amount = $_SESSION['amount'];
    $shop_id = $_SESSION['shop_id'];
}else{
    $Amount =$_SESSION['cart_cost'];
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
    // var_dump($result);
    if(isset($_SESSION['app'])){

        $id = $_SESSION['user_id'];
        $command = $action->app_payment_add($id,$Amount,2,$result->RefID,1);
        $_SESSION['app-wallet'] = 'success';
        $participation = floatval(($action->shop_get($shop_id)->participation_percentage)* $Amount/100) ;
        $action->shop_wallet_edit($shop_id,$participation,1);
        $action->guild_wallet_log_add($shop_id,0,$participation);
        $work = floatval(($action->shop_get($shop_id)->work_percentage)* $Amount/100) ;
        $user_percentage = 100 - $participation - $work;
        $user_wallet = floatval($user_percentage* $Amount/100);
        $action->app_user_wallet_edit($id,$user_wallet,1);
        echo "<script> location.href='http://abarpayo.com/abarpayo/shop-return.php?id=$shop_id'; </script>";

    }else{

        if($action->user()){

            $id = $action->user()->id;
            $action->remove_cart($id,1);
            $payment_id = $action->app_payment_add($id,$Amount,2,$result->RefID,1);
            //$order_id = $action->order_add();
            // $action->purchase_add($id,1,$shop_id,$payment_id,$order_id);

        }else if($action->marketer()){
    
            $id = $action->marketer()->id;
            $action->remove_cart($id,0);
            $payment_id = $action->marketer_payment_add($id,$Amount,2,$result->RefID,1);
            //$order_id = $action->order_add();
            $action->purchase_add($id,0,$shop_id,$payment_id,$order_id);
        }
        unset($_SESSION['already_in_gateway']);
        $_SESSION['successful_pay'] = 'true';
        header("Location: factor.php");

    }
    
} else {
    if(isset($_SESSION['app'])){
        $_SESSION['app-wallet'] = 'fail';
        echo "<script> location.href='http://abarpayo.com/abarpayo/shop-return.php?id=$shop_id'; </script>";
    }else{
        unset($_SESSION['already_in_gateway']);
        $_SESSION['successful_pay'] = 'false';
        header("Location: factor.php");
    }
}
} else {
    if(isset($_SESSION['app'])){
        $_SESSION['app-wallet'] = 'cancel';
      echo "<script> location.href='http://abarpayo.com/abarpayo/shop-return.php?id=$shop_id'; </script>";
    }else{
        unset($_SESSION['already_in_gateway']); 
        header("Location: shopping-cart.php");
    }
}