<? 
require_once "functions/database.php";
$action = new Action();
$title = "پشتیبانی";

if(!$action->user()){
    header("Location: phone.php");
}
$user_id = $action->user()->id;

$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}

if(isset($_POST['submit'])){
 
    $subject = $action->request('title');
    $text = $action->request('text');
    $type = $action->request('type');

    $command = $action->ticket_add($user_id,$subject,$text,$type,$view,$status);

    if ($command) {
        $_SESSION['error'] = 0;
    } else {
        $_SESSION['error'] = 1;
    }

    header("Location: ticket.php");
    // echo '<script>window.location="ticket.php"</script>';
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
                
<? } } ?>

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
                <a href="index.php" class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>
            
                <h3 style="width: 50%;float: right;">پشتیبانی</h3>
            </div>
            <!--  -->

            <div class="row">
                <form action="" method="post" style="margin-bottom: 70px;">
                    <div class="form-group">
                        <label for="title">موضوع</label>
                        <input type="text" name="title" placeholder="فقط حروف فارسی" required>
                    </div>
                    <div class="form-group">
                        <label for="type">نوع درخواست</label>
                        <select name="type" required>
                            <option value = 1>سرمایه گذاری و مشارکت</option>
                            <option value = 2>  انتقادات و پیشنهادات </option>
                            <option value = 3>حسابداری و مالی </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text">متن درخواست</label>
                        <textarea name="text" required></textarea>
                    </div>
                    <input name="submit" style="float: none;font-size: 15px;" type="submit" class="main_btn" value="ثبت درخواست">
                    
                </form>
            </div>
            <!--  -->
        </div>
    </div>
</div>
<? include('footer.php');?>
