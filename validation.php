<?
require_once "functions/database.php";
if(!isset($_SESSION['fromPhone'])){
    header("Location: phone.php");
}
$action = new Action();

$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}

?>
<?
    if(isset($_POST['submit'])){
        $code = $action->request('code');
        $result = $action->validate_code($code);
        $validated_code = $result->fetch_object();
        if($validated_code){
            unset($_SESSION['code']);
            unset($_SESSION['fromPhone']);
            $_SESSION['fromValidation'] = 'true';
            if($validated_code->user_id == 0){
                $action->validation_code_remove($validated_code->id);
                header("Location: signup.php");
            }
            else{ 
                $_SESSION['user_id'] = $validated_code->user_id;
                $action->validation_code_remove($validated_code->id);
                unset($_SESSION['phone']);
                header("Location: index.php");
            } 
        }else{
            $_SESSION['error'] = 1;
            header("Location: validation.php");
        }
    }
    $code_correct = $_SESSION['code'];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>ابرپایو</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  
    <link rel="stylesheet" href="assets/css/swiper.css">
    <link rel="stylesheet" href="assets/css/fontiran.css">
    <link rel="stylesheet" href="assets/css/fontAswome.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src='assets/js/swiper.js'></script>
    <script src='assets/js/jquery.js'></script>
    <script src='assets/js/fontAwsome.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
</head>
<body>
<div class="background_page">
    <div class="container">
        <div class="center_form">
            <div class="row">
                <div class="col-md-5 right-form mobile_validiation">
                <? if ($error) {
            if ($error_val) { ?>
            <div class="modal">
                    <div class="alert alert-fail">
                        <span class="close_alart">×</span>
                        <p>
                              کد وارد شده نامعتبر است!
                        </p>
                    </div>
                </div>
                <script src="assets/js/alert.js"></script>
               
            <? }} ?>
                    <div class="form_top">
                        <img src="assets/images/logo.png">
                        <h4>ثبت نام / ورود </h4>
                    </div>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="code">کد تایید را وارد کنید.</label>
                            <input type="text" name="code" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="code">کد تایید را وارد کنید.</label>
                            <input type="text" placeholder="" value="<?=$code_correct?>" >
                        </div>
                        <p id="resent_code_form"  class="resent_code_form">
                                ارسال مجدد کد تا 
                                <span id="countdown">02:35</span>
                        </p>
                        <a id="resent_btn" style="display:none">ارسال مجدد کد</a>
                        <input name="submit" type="submit" class="main_btn" value="ادامه">
                    </form>
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

    
// timer
down_expired();

var min,sec;
    function down_expired(){
        min =0;
         sec = 5;
        document.getElementById('resent_btn').style.display = 'none';
        document.getElementById('resent_code_form').style.display='block';
        var x= setInterval(
            function(){
                print_time(min,sec);
                if(sec == 0){
                    min--;
                    sec= 60;
                }if(  min<0 ){
                    sec=0;
                    min = 0;
                    document.getElementById('resent_btn').style.display = 'block';
                    document.getElementById('resent_code_form').style.display='none';
                    print_time(min,sec)
                    clearInterval(x);
                }
                sec--;
            }
            ,1000
        )         
    }
    var c = document.getElementById('countdown');

    function print_time(min,sec){

        if(min<10 && sec<10){
        c.innerHTML = "0"+min + ":" +"0"+sec;
        }
        else if(min<10){
            c.innerHTML = "0"+min + ":" +sec;
        }
        else if(sec<10){
            c.innerHTML = min + ":" +"0"+sec;

        }
        
    }
    document.getElementById('resent_btn').onclick = function(){
        down_expired()
    }
</script> 
</body>
</html>

