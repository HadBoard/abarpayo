<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$code = $_POST['code'];
$phone = $_POST['phone'];

$result = $action->validate_code($phone,$code);
$validated_code = $result->fetch_object();

if($validated_code){
    
    $code = $validated_code->code;
    $action->send_sms($phone,$code);

}else{
    $code=rand(100000,999999);

    $result = $action->user_get_phone($phone);
    $user = $result->fetch_object();
    $user_id = $user ? $user->id : 0;
    $action->validation_code_add($user_id,$phone,$code);

    $action->send_sms($phone,$code);
}
