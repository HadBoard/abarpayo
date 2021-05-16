<?
require_once "functions/database.php";
require_once "const-values.php";
$action = new Action();

if(!isset($_SESSION['fromValidation'])){
    header("Location: phone.php");
}

if($action->auth()){
    header('Location: index.php');
}

$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}

if(isset($_POST['submit'])){
    unset($_SESSION['fromValidation']);
    $first_name = $action->request('first_name');
    $last_name = $action->request('last_name');

    if(isset($_SESSION['invitation_code'])){
        $reference_id = $_SESSION['invitation_code'];
        $action->score_log_add($reference_id,$invitation_score,8,1);
        $action->score_edit($reference_id,$invitation_score,1);
    }else{
        $reference_code = $action->request('reference_code');
        if($reference_code){
            $result = $action->user_reference_code($reference_code);
            $reference = $result->fetch_object();
            $reference_id = $reference->id;
            if(!$reference_id){$_SESSION['error'] = 1;}
            $action->score_log_add($reference_id,$invitation_score,8,1);
            $action->score_edit($reference_id,$invitation_score,1);
        }
    }

    $phone = $_SESSION['phone'];
    $platform = 1;
    $command = $action->user_add($first_name,$last_name,$phone,$reference_id,$platform);    
    if($command){
        $action->score_log_add($command,$register_score,6,1);
        $action->score_edit($command,$register_score,1);
        unset($_SESSION['phone']);
        $_SESSION['user_id'] = $command;
        $action-> user_update_last_login( $_SESSION['user_id']);
        $action-> log_action(3,0);
        header("Location: index.php");
    }else{
        $_SESSION['error'] = 1;
    }
}
?>
  

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>ابرپایو</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  
    <link rel="stylesheet" href="assets/css/swiper.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/fontiran.css">
    <link rel="stylesheet" href="assets/css/fontAswome.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <script src='assets/js/swiper.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src='assets/js/jquery.js'></script>
    <script src='assets/js/fontAwsome.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
</head>
<body>

    <div class="background_page">
        <div class="container">
        <? if ($error) {
            if ($error_val) { ?>

                 <div class="modal">
                    <div class="alert alert-fail">
                        <span class="close_alart">×</span>
                        <p>
                            عملیات ناموفق بود!
                        </p>
                    </div>
                </div>
                <script src="assets/js/alert.js"></script>
                
            <? } 
} ?>
            
            <div class="center_form">
                <div class="row">
                    <div class="col-md-5 right-form">
                    <div class="form_top">
                    <a href="index.php">
                    <img src="assets/images/logo.png">
                    </a>
                        <h4>ثبت نام در ابرپایو</h4>
                    </div>
                        <form action="" method="post">
                        <div class="form-group">
                            <label for="first_name">نام</label>
                            <input type="text" name="first_name" placeholder="فقط حروف فارسی" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">نام خانوادگی</label>
                            <input type="text" name="last_name" placeholder="فقط حروف فارسی" required>
                        </div>
                    <?if(!isset($_SESSION['invitation_code'])){?>
                        <div class="form-group">
                            <label for="reference_code">کد معرف(اختیاری)</label>
                            <input type="text" name="reference_code">
                        </div>
                    <?}?>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="checkRule()">
                            <label class="form-check-label" for="flexCheckDefault">
                                پذیرش 
                            </label>
                            <a href="rules.php" id="rule-btn" class="show-rules">قوانین و مقررات</a>
                        </div>
                        <input id="signup"  name="submit" type="submit" class="main_btn" value="ادامه">

                    </form>
                    </div>
                    <div class="col-md-7 left-form">
                        <img src="assets/images/Group 380@2x.png">
                    </div>
                </div>
             </div>
        </div>
    </div>
    <script>
        function checkRule() {
                document.getElementById("signup").disabled = true;
                var checkBox = document.getElementById("flexCheckDefault");
                if (checkBox.checked == true){
                    document.getElementById("signup").disabled = false;
                } else {
                    document.getElementById("signup").disabled = true;
                }
            }
            checkRule()

    </script>
</body>
</html>