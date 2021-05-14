<?
require_once "../functions/database.php";
$action = new Action();

$id = $_POST['id'];
$type = $_POST['type'];

$command = $action->change_view($id,$type);
if($command){
    echo 1;
}
