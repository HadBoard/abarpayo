<?
require_once "functions/database.php";
if(!isset($_SESSION['fromValidation'])){
    header("Location: phone.php");
}
$action = new Action();
$title = "ثبت نام";
unset($_SESSION['fromValidation']);
?>
<?
    if(isset($_POST['submit'])){
        $first_name = $action->request('first_name');
        $last_name = $action->request('last_name');
        $reference_code = $action->request('reference_code');
        if($reference_code){
            $result = $action->user_reference_code($reference_code);
            $reference = $result->fetch_object();
            $reference_id = $reference->id;
        } 
        $phone = $_SESSION['phone'];
        $platform = 1;
        $command = $action->user_add($first_name,$last_name,$phone,$reference_id,$platform);    
        if($command){
            unset($_SESSION['phone']);
            $_SESSION['user_id'] = $command;
            header("Location: index.php");
        }else{
            ?>
          <div class="modal">
                    <div class="alert alert-fail">
                        <span class="close_alart">×</span>
                        <p>
                              ثبت نام ناموفق بود!
                        </p>
                    </div>
           </div>
            <script src="assets/js/alert.js"></script>
           <?
        }
    }
    include_once "header.php";
?>

<div class="background_page">
    <div class="container">
        <div class="center_form">
            <div class="row">
                <div class="col-md-5 right-form">
                    <div class="form_top">
                        <img src="assets/images/logo.png">
                        <h4>ثبت نام در ابرپایو</h4>
                    </div>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="first_name">نام</label>
                            <input type="text" name="first_name" placeholder="فقط حروف فارسی">
                        </div>
                        <div class="form-group">
                            <label for="last_name">نام خانوادگی</label>
                            <input type="text" name="last_name" placeholder="فقط حروف فارسی">
                        </div>
                    
                        <div class="form-group">
                            <label for="reference_code">کد معرف(اختیاری)</label>
                            <input type="text" name="reference_code" placeholder="فقط حروف فارسی">
                        </div>
                        <input name="submit" type="submit" class="main_btn" value="ادامه">

                    </form>
                </div>
                <div class="col-md-7 left-form">
                    <img src="assets/images/Group 380@2x.png">
                </div>
            </div>
            <p>با ورود یا ثبت نام در ابرپایو <a href="rules.php">شرایط و قوانین </a> را میپذیرید.</p>
        </div>
    </div>
</div>
<? 
include_once "footer.php" ;
?>
