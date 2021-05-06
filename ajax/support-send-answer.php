<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$user_id = $_POST['user_id'];
$text = $_POST['text'];
$question_id = $_POST['question_id'];
$support_id = $_POST['support_id'];

$command= $action->message_add($support_id,$user_id,$question_id,$text,$status);
$action->message_status($question_id);
if($command){
    echo 1;
}

