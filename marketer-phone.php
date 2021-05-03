<?
require_once "functions/database.php";
$action = new Action();

if(isset($_GET['ref'])){

    $invitation_code = $action->request('ref');

    $result = $action->marketer_reference_code($invitation_code);
    $reference = $result->fetch_object();
    $reference_id = $reference->id;

    $found = $action->marketer_get($reference_id)->first_name." ".$action->marketer_get($reference_id)->last_name;
    $_SESSION['invitation_code'] = $reference_id;
}

if(isset($_POST['submit'])){
    $phone = $action->request('phone');
    $code=rand(100000,999999);
    // $action->send_sms($phone,$code);
    $_SESSION['code'] = $code;
    $_SESSION['phone'] = $phone;
    $_SESSION['MfromPhone'] = 'true';
    $result = $action->marketer_get_phone($phone);
    $marketer = $result->fetch_object();
    $marketer_id = $marketer ? $marketer->id : 0;
    $action->validation_code_add($marketer_id,$code);
    header("Location: marketer-validation.php");
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
    <script src='../assets/js/jquery.js'></script>
    <script src='assets/js/fontAwsome.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
</head>
<body>
<!--welcome modal  -->
<? if($reference_id){?>
<div class="welcom-modal modal2 animate__animated  animate__backInDown">
        <a class="close-modal"><i class="fa fa-times"></i></a>
        <img src="assets/images/icons8-add-user-group-man-man-64.png" alt="">
        <h2>خوش آمدید</h2>
        <h5>ورود با کد دعوت</h5>

        <p>
            شما با کد دعوت 
            <span><?= $found ?></span>
            وارد شدید.
        </p>
    </div>
<? }?>
<!--  -->
<div class="background_page">
    <div class="container">
        <div class="center_form">
            <div class="row">
                <div class="col-md-5 right-form mobile_validiation">
                    <div class="form_top">
                    <a href="index.php">
                    <img src="assets/images/logo.png">
                    </a>
                        <h4>ثبت نام / ورود </h4>
                    </div>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="phone">شماره موبایل خود را وارد کنید.</label>
                            <input type="text" name="phone" placeholder="*******09" required>
                        </div>
                        <input name="submit" type="submit" class="main_btn" value="ادامه">
                    </form>
                    <a class="form_ques">در ابرپایو <span>عضو</span> نیستید ؟</a>

                </div>
                <div class="col-md-7 left-form">
                    <img src="assets/images/Group 380@2x.png">
                </div>
            </div>
            <p>با ورود یا ثبت نام در ابرپایو <a>شرایط و قوانین </a> را میپذیرید.</p>
        </div>
    </div>
</div>
<script>
    document.querySelector('.close-modal').onclick = function(){
        $('.modal2').hide();
    }
</script>
</body>
</html>
