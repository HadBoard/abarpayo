<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$account_number = $_POST['account_number'];
$iban = $_POST['iban'];
$cart_number = $_POST['cart_number'];

if($action->marketer()){
    $validate = $action->account_number_validate($account_number,0);
    $validate1 = $action->iban_validate($iban) && $action->iban_unique($iban,0);
    $validate2 = $action->cart_number_validate($cart_number,0);
    if($validate && $validate1 && $validate2) echo 1;
}else if($action->user()){
    $validate = $action->account_number_validate($account_number,0);
    $validate1 = $action->iban_validate($iban) && $action->iban_unique($iban,0);
    $validate2 = $action->cart_number_validate($cart_number,0);
    // $validate = true;
    // $validate1 = true;
    // $validate2 = true;
    if($validate && $validate1 && $validate2) echo 1;
}
