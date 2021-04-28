<?
require_once "functions/database.php";
if(!isset($_SESSION['MfromValidation'])){
    header("Location: marketer-phone.php");
}
$action = new Action();
$title = "ثبت نام";
unset($_SESSION['MfromValidation']);
?>

<?
    if(isset($_POST['submit'])){
        $first_name = $action->request('first_name');
        $last_name = $action->request('last_name');
        $package_id = $action->request('package_id');
        $national_code = $action->request('national_code');
        $payment_type  = $action->request('payment_type');
        $reference_code = $action->request('reference_code');
        if($reference_code){
            $result = $action->marketer_reference_code($reference_code);
            $reference = $result->fetch_object();
            $reference_id = $reference->id;
        }
        $phone = $_SESSION['phone'];
        $command = $action->marketer_add($first_name,$last_name,$phone,$package_id,$payment_type,$national_code,$reference_id);

        if($command){
            $_SESSION['marketer_id'] = $command;
           if($payment_type == 1){
            $action->marketer_change_status($command);
            header("Location: index.php");
           }else{
               $_SESSION['marketer_package'] = $action->package_get($package_id)->price;
                header("Location: marketer-package-request.php");
           }
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
    <script src='../assets/js/jquery.js'></script>
    <script src='assets/js/fontAwsome.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
</head>
<body>
    <div class="background_page">
        <div class="container">
            <div class="center_form">
                <div class="row">
                    <div class="col-md-5 right-form">
                        <div class="form_top">
                            <!-- <img src="../assets/images/logo.png"> -->
                            <h4>ثبت نام بازارسازان</h4>
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
                                <label for="national_code">کد ملی</label>
                                <input type="text" name="national_code">
                            </div>
                            <div class="form-group">
                                <label for="reference_code">کد معرف(اختیاری)</label>
                                <input type="text" name="reference_code" placeholder="فقط حروف فارسی">
                            </div>
                            <div class="form-group">
                                <label for="package_id">انتخاب محصول</label>
                                
                                <select name="package_id">
                                <?
                                $option_result = $action->package_list();
                                while ($option = $option_result->fetch_object()) {
                                    echo '<option value="';
                                    echo $option->id;
                                    echo '"';
                                    if ($option->id == $row->package_id) echo "selected";
                                    echo '>';
                                    echo $option->name."-".$roption->price;
                                    echo '</option>';
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="payment_type">نحوه پرداخت</label>
                                <select name="payment_type">
                                    <option value=1>اعتباری</option>
                                    <option value=2>نقدی</option>
                                </select>
                            </div>
                            <input name="submit" type="submit" class="main_btn" value="ثبت خرید">
                            
                        </form>
                    </div>
                    <div class="col-md-7 left-form">
                    <img src="assets/images/Group 494@2x.png">
                    </div>
                </div>
                <p>با ورود یا ثبت نام در ابرپایو <a>شرایط و قوانین </a> را میپذیرید.</p>
            </div>
        </div>
    </div>
</body>
</html>