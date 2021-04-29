<?
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['marketer_id']);


header("Location: index.php");