<?
session_start();
if(isset($_SESSION['already_in_gateway'])){
    unset($_SESSION['already_in_gateway']);
}
$_SESSION['cart_cost'] = $total_cost;
echo 1;