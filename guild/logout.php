<?
// delete all session
session_start();
unset($_SESSION['guild_id']);
unset($_SESSION['shop_id']);
// bye bye :)
header('location:index.php');
?>