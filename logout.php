<?
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_access']);

header("Location: index.php");