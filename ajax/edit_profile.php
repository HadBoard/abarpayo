<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$date = $_POST['date'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$national_code = $_POST['national_code'];
$phone = $_POST['phone'];

$user_id = $action->user()->id;
$user_phone = $action->user_get($user_id)->phone;
if($phone == $user_phone){
    $command= $action->user_profile_edit($first_name, $last_name,$national_code,$date);
    if($command){
        echo 1;
    }else{
        echo -1;
    }
}else{
    $code=rand(100000,999999);
    // $action->send_sms($phone,$code);
    // $command= $action->user_profile_edit($first_name, $last_name,$national_code,$date);
    $_SESSION['code'] = $code;
    $_SESSION['phone'] = $phone;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['national_code'] =$national_code;
    $_SESSION['date'] = $date;
    // $action->validation_code_add($user_id,$code);    
    echo 0 ;
}