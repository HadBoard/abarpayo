<?
session_start();
if(isset($_SESSION['cart_cost'])){
    echo 1;
}else{
    echo 0;
}