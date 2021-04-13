<?
require_once "functions/database.php";
$action = new Action();
$title = "ثبت نام";
include_once "header.php"
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

                    <form>
                        <div class="form-group">
                            <label for="name">نام</label>
                            <input type="text" name="name" placeholder="فقط حروف فارسی">
                        </div>
                        <div class="form-group">
                            <label for="lname">نام خانوادگی</label>
                            <input type="text" name="lname" placeholder="فقط حروف فارسی">
                        </div>
                        <div class="form-group">
                            <label for="phone">شماره موبایل</label>
                            <input type="text" name="phone" placeholder="فقط حروف فارسی">
                        </div>
                        <div class="form-group">
                            <label for="name">کد معرف(اختیاری)</label>
                            <input type="text" name="name" placeholder="فقط حروف فارسی">
                        </div>
                        <input type="submit" class="main_btn" value="ادامه">

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

<? include_once "footer.php" ?>
