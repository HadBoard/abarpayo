<!-- eof stores -->
<footer>
    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-md-3 download_app">
                    <h5>دیافت اپلیکیشن</h5>
                    <button class="main_btn middle_btn">
                        <i class="fa fa-android"></i>
                        دانلود نسخه اندروید
                    </button>
                </div>
                <div class="col-md-6">
                    <h3>اشتراک خبرنامه</h3>
                    <p>جهت اطلاع از آخرین تخفیف های شهرستان ، آدرس ایمیل خود را وارد کنید و در خبرنامه مشترک شوید.</p>
                    <div class="search_header email_footer">
                        <input placeholder="ایمیل خود را وارد کنید .">
                        <button><span >
                              اشتراک
                              </span></button>
                    </div>
                </div>
                <div class="col-md-3 namad_footer">
                    <div class="namad_cell">
                        <img src="assets/images/samandehi@2x.png">
                    </div>
                    <div class="namad_cell">
                        <img src="assets/images/samandehi@2x.png">
                    </div>
                </div>
            </div>
        </div><!-- eof newsLetter -->
    </div>
    <div class="main_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="menu_footer">
                        <ul>
                            <h4>ابرپایو</h4>
                            <li>
                                <a>درباره ابرپایو</a>
                            </li>
                            <li>
                                <a>قوانین و مقررات</a>
                            </li>
                            <li>
                                <a>حریم خصوصی</a>
                            </li>
                            <li>
                                <a>ژتون در رسانه</a>
                            </li>
                        </ul>
                        <ul>
                            <h4>ابرپایو</h4>
                            <li>
                                <a>پاسخ به پرسش های متدوال</a>
                            </li>
                            <li>
                                <a>قوانین و مقررات</a>
                            </li>
                            <li>
                                <a>حریم خصوصی</a>
                            </li>
                            <li>
                                <a>ژتون در رسانه</a>
                            </li>
                        </ul>
                        <ul>
                            <h4>ابرپایو</h4>
                            <li>
                                <a>درباره ابرپایو</a>
                            </li>
                            <li>
                                <a>قوانین و مقررات</a>
                            </li>
                            <li>
                                <a>حریم خصوصی</a>
                            </li>
                            <li>
                                <a>ژتون در رسانه</a>
                            </li>
                        </ul>
                        <ul>
                            <h4>ابرپایو</h4>
                            <li>
                                <a>درباره ابرپایو</a>
                            </li>
                            <li>
                                <a>قوانین و مقررات</a>
                            </li>
                            <li>
                                <a>حریم خصوصی</a>
                            </li>
                            <li>
                                <a>ژتون در رسانه</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact_footer">
                        <div class="row">
                            <a class="main_btn">
                                <p>شماره تماس : </p>
                                <span>
                                    <?= $action->get_system('phone') ?>
                                </span>
                            </a>
                        </div>
                        <div class="row">
                            <div class="socila_icons">
                                <div>
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </div>
                                <div class="socila_icons_availabel">
                                    <a  href="#">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- eof main footer -->
    <div class="copyright">
        <div class="container">
            <p>کلیه حقوق این سایت متعلق به شرکت حامی تک میبا شد . &copy copyright</p>
        </div>
    </div>
</footer>
<script>
    var customOptions = {
        placeholder: "تاریخ شروع"
        , twodigit: false
        , closeAfterSelect: true
        , nextButtonIcon: "fa fa-arrow-circle-right"
        , previousButtonIcon: "fa fa-arrow-circle-left"
        , buttonsColor: "black"
        , forceFarsiDigits: true
        , markToday: true
        , markHolidays: true
        , highlightSelectedDay: true
        , sync: true
        , gotoToday: true
    }
    kamaDatepicker('date', customOptions);
    kamaDatepicker('date_start', customOptions);
    kamaDatepicker('date_end', customOptions);
    kamaDatepicker('birthday', customOptions);
</script>

</body>

</html>