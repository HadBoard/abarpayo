<?
require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$result =$action->connection->query("SELECT * FROM `tbl_message` WHERE `to_id` = '$marketer_id' ");
$messages =$action->connection->query("SELECT * FROM `tbl_message` WHERE `from_id` = '$marketer_id'");
while($message = $messages->fetch_object()){
    while($row = $result->fetch_object()){
        if(!($row->parent == $message->id && $row->user_view == 0)){
            echo 1;
        }
    }
}