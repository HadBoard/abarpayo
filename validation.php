<?
require_once "functions/database.php";
// if($_SESSION['fromPhone'] == 'true'){
// $_SESSION['fromPhone'] = 'false';
$action = new Action();
$title = "ثبت نام";
include_once "header.php"
?>
<?
    if(isset($_POST['submit'])){
        $code = $action->request('code');
        $result = $action->validate_code($code);
        $validated_code = $result->fetch_object();
        if($validated_code){
            // $_SESSION['fromValidation'] = 'true';
            if($validated_code->user_id == 0){
                // header("Location: signup.php");
                $action->validation_code_remove($validated_code->id);
                echo "<script type='text/javascript'>window.location.href = 'signup.php';</script>"; 
            }
            else{ 
                // header("Location: index.php");
                $_SESSION['user_id'] = $validated_code->user_id;
                $action->validation_code_remove($validated_code->id);
                echo "<script type='text/javascript'>window.location.href = 'index.php';</script>"; 
            } 
        }else{
          ?>
           <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>ناموفق!</strong>کد وارد شده نامعتبر است.
          </div> 
          <?
        }
    }
    if(isset($_POST['resend'])){
        $action->send_sms();
    }
    $code_correct = $_SESSION['code'];
?>

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
                            <label for="code">کد تایید را وارد کنید.</label>
                            <input type="text" name="code" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="code">کد تایید را وارد کنید.</label>
                            <input type="text" name="code" placeholder="" value="<?=$code_correct?>">
                        </div>
                        <p class="resent_code_form">
                            ارسال مجدد کد تا
                            <span>02:35</span>
                        </p>
                        <input name="submit" type="submit" class="main_btn" value="ادامه">
                    </form>
                </div>
                <div class="col-md-7 left-form">
                    <img src="assets/images/Group 380@2x.png">
                </div>
            </div>
            <p>با ورود یا ثبت نام در ابرپایو <a>شرایط و قوانین </a> را میپذیرید.</p>
            <p><button  type="submit" name="resend">ارسال مجدد کد</button></p>
        </div>
    </div>
</div>
<script>
    $('document').ready(function(){
        setTimeout(function(){  $('.alert').hide(); }, 3000);
    })
</script> 

<? include_once "footer.php" ;
//  }else{
//     echo "<script type='text/javascript'>window.location.href = 'phone.php';</script>";
//  }
?>

