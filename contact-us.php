
  <?
require_once "functions/database.php";
$action = new Action();
$title = "تماس با ما";
include_once "header.php";
?>
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
                <form>
                    <div class="form-group">
                        <label for="name">نام و نام خانوادگی</label>
                        <input type="text" name="name" placeholder="فقط حروف فارسی">
                    </div>
                    <div class="form-group">
                        <label for="lname">شماره موبایل</label>
                        <input type="text" name="lname" placeholder="فقط حروف فارسی">
                    </div>
                    <div class="form-group">
                        <label for="lname">موضوع</label>
                        <input type="text" name="lname" placeholder="فقط حروف فارسی">
                    </div>
                    <div class="form-group">
                        <label for="name">متن درخواست</label>
                        <textarea></textarea>
                    </div>
                    <input style="float: none;font-size: 15px;" type="submit" class="main_btn" value="ثبت درخواست">
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
                                        38282173
                                   </br>
                                        38562894
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
                                     38282173
                                </br>
                                     38562894
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
                                    دفتر مرکزی ابرپایو
                                    یزد, یزد - کوی وحدت مجتمع نگین فارس طبقه مثبت یک جنب فروشگاه سر و سامان
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

