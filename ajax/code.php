<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$code=$_POST['code'];
$sent_code = $_SESSION['change_phone_code'];
// $phone = $_SESSION['phone'];
// $sent_code = $_SESSION['code'];
// $first_name = $_SESSION['first_name'];
// $last_name = $_SESSION['last_name'];
// $national_code = $_SESSION['national_code'];
// $date = $_SESSION['date'];
// $result = $action->validate_code($sent_code);
// $validated_code = $result->fetch_object();
// $action->validation_code_remove($validated_code->id);
if($code == $sent_code ){
    // $command = $action->user_phone_edit($phone);
    // $command =  $action->user_phone_edit($first_name,$last_name,$national_code,$phone,$date);
    echo 1;
    //   if($command){
    //     echo 1;
    // }else{
    //     echo -1;
    // }
    // echo $phone;
    // echo $sent_code;
    // echo $code;
   
}else{
    echo -1;
    // echo "not equal";
    // echo $code."<br>";
    // echo $sent_code;
}