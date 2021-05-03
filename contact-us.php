 <?
require_once "functions/database.php";
$action = new Action();
$title = "تماس با ما";

$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}

if(isset($_POST['submit'])){
    $name  = $action->request('name');
    $phone = $action->request('phone');
    $title = $action->request('title');
    $description = $action->request('description');

    $command  = $action->contact_add($name,$phone,$title,$description);

    if ($command) {
        $_SESSION['error'] = 0;
    } else {
        $_SESSION['error'] = 1;
    }

    echo '<script>window.location="contact-us.php"</script>';
}
include_once "header.php";
?>
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
    
<? } else { ?>
    <div class="modal">
        <div class="alert alert-suc">
            <span class="close_alart">×</span>
            <p>
                عملیات موفق بود!
            </p>
        </div>
    </div>
    <script src="assets/js/alert.js"></script>
    
<? }
} ?>

<div class="contact">
    <div class="contact-img"></div>
    <div class="contact-content">
        <div class="contact-header">
            <div class="bg-gray">2</div>

            <div class="contact-header-img">
                <img src="assets/images/Group 523@2x.png">
            </div>
        </div>
        <div class="contact-middle">
            <div class="row profile_title">
                <a class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>
            
                <h3 style="width: 50%;float: right;">تماس با ما</h3>
                <p class="contact-p">پیشنهادات و انتقادات خود را برای ما ارسال کنید</p>
                <span class="line"></span>
            </div>
            <!--  -->

            <div class="row">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">نام و نام خانوادگی</label>
                        <input type="text" name="name" placeholder="فقط حروف فارسی">
                    </div>
                    <div class="form-group">
                        <label for="phone">شماره موبایل</label>
                        <input type="text" name="phone" placeholder="فقط حروف فارسی">
                    </div>
                    <div class="form-group">
                        <label for="title">موضوع</label>
                        <input type="text" name="title" placeholder= "">
                    </div>
                    <div class="form-group">
                        <label for="description">متن درخواست</label>
                        <textarea name="description"></textarea>
                    </div>
                    <input style="float: none;font-size: 15px;" name="submit" type="submit" class="main_btn" value="ثبت درخواست">
                </form>
            </div>
            <!--  -->
            <div class="row">
               <div class="contact-info">
                   <h3>اطلاعات تماس</h3>
                   <div class="row">
                       <div class="contact-phone">
                           <div class="row">
                               <div class="col-1">
                                    <img src="assets/images/call.png" alt="">
                               </div>
                               <div class="col-10">
                                   <h4>اطلاعات تماس</h4>
                                   <p>
                                   <?= $action->get_system('phone')?>
                                   </br>
                                        <!-- 38562894 -->
                                   </p>
                               </div>
                           </div>

                       </div>
                       <div class="contact-phone">
                        <div class="row">
                            <div class="col-1">
                                 <img src="assets/images/call.png" alt="">
                            </div>
                            <div class="col-10">
                                <h4>اطلاعات تماس</h4>
                                <p>
                                    <?= $action->get_system('phone')?>
                                </br>
                                     <!-- 38562894 -->
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="contact-phone">
                        <div class="row">
                            <div class="col-1">
                                 <img src="assets/images/sign (1).png" alt="">
                            </div>
                            <div class="col-10">
                                <h4>آدرس ابرپایو</h4>
                                <p>
                                <?= $action->get_system('address')?>
                                </p>
                            </div>
                        </div>

                    </div>
                   </div>
               </div>

            </div>
        
        </div>
    </div>
</div>
<? include('footer.php');?>
<!--  -->

