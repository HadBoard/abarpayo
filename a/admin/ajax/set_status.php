<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$id=$_POST['id'];
$status=$_POST['status'];
echo $action -> ticket_set_status($id,$status);