<?
require_once "functions/database.php";
$action = new Action();
?>

<?
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
<div class="background_page">
    <div class="container">
        <div class="center_form">
            <div class="row">
                <div class="col-md-5 right-form mobile_validiation">
                    <div class="form_top">
                        <img src="assets/images/logo.png">
                        <h4>ثبت نام / ورود </h4>
                    </div>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="phone">شماره موبایل خود را وارد کنید.</label>
                            <input type="text" name="phone" placeholder="*******09">
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
</body>
</html>
