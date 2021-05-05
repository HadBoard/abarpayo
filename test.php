<?
require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$wallet_date = $action->time_to_shamsi($action->wallet_log_get_payment($log->payment_id)->date);
echo $wallet_date;