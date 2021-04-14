<?
require_once "functions/database.php";
if(!isset($_SESSION['fromValidation'])){
    header("Location: phone.php");
}
$action = new Action();
$title = "ثبت نام";
include_once "header.php";
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
        $command = $action->user_add($first_name,$last_name,$phone,$reference_id);    
        if($command){
            unset($_SESSION['phone']);
            echo "<script type='text/javascript'>window.location.href = 'index.php';</script>"; 
        }else{
            ?>
            <div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>ناموفق!</strong>دوباره تلاش کنید.
           </div> 
           <?
        }
    }

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
            <p>با ورود یا ثبت نام در ابرپایو <a>شرایط و قوانین </a> را میپذیرید.</p>
        </div>
    </div>
</div>
<? 
include_once "footer.php" ;
?>
