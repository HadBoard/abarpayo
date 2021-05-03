<?
require_once "functions/database.php";
$action = new Action();
$title = "پرسش های پر تکرار";
include_once "header.php";
// alse 2 links in header
?>
<style>
    .panel-group .panel{
    background-color: #fff;
    border:none;
    box-shadow:none;
    border-radius: 10px;
    margin-bottom:11px;
}
.panel .panel-heading{
    padding: 0;
    border-radius:10px;
    border: none;
}
.panel-heading a{
    color:#fff !important;
    display: block;
    border:none;
    padding:13px 35px 15px;
    font-size: 17px;
    background-image:linear-gradient(99deg, rgb(255, 142, 10) 8%, rgb(253, 118, 0) 90%);
    font-weight:600;
    position: relative;
    color:#fff;
    box-shadow:none;
    transition:all 0.1s ease 0;
}
.panel-heading a:after, .panel-heading a.collapsed:after{
    content: "\f068";
    font-family: fontawesome;
    text-align: center;
    position: absolute;
    left:-20px;
    top: 10px;
    color:#fff;
    background-color:rgb(236, 87, 102);
    border: 5px solid #fff;
    font-size: 15px;
    width: 40px;
    height:40px;
    line-height: 30px;
    border-radius: 50%;
    transition:all 0.3s ease 0s;
}
.panel-heading:hover a:after,
.panel-heading:hover a.collapsed:after{
    transform:rotate(360deg);
}
.panel-heading a.collapsed:after{
    content: "\f067";
}
#accordion .panel-body{
    background-color:#Fff;
    color:#8C8C8C;
    line-height: 25px;
    padding: 10px 25px 20px 35px ;
    border-top:none;
    font-size:14px;
    position: relative;
}
.questions {
    width: 85%;
    margin: auto;
    display: table;
    margin: 52px auto;
}

.panel-heading a:focus ,.panel-heading a:hover {
    text-decoration: none;
}
</style>
<body>

<!-- main content -->
<div class="contact">
    <div class="contact-img"></div>
    <div class="contact-content">
        <div class="contact-header">
            <div class="bg-gray">2</div>

            <div class="contact-header-img">
                <img src="assets/images/Group 532@2x.png">
            </div>
        </div>
        <div class="contact-middle">
            <div class="row profile_title">
                <a class="profile_title_icon"><img style="margin-top: 2px;" src="assets/images/006-right-arrow.svg"></a>
            
                <h3 style="width: 50%;float: right;">پرسش های پرتکرار</h3>

            </div>
            <!--  -->
            <!--  -->
            <div class="questions">
                <div class="container">
                    <div class="row">
                        <div class="">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <?$result = $action->frequently_asked_question_list();
                              while ($row = $result->fetch_object()) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading<?= $row->id?>">
                                        <h4 class="panel-title">
                                            <a class="first" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $row->id ?>" aria-expanded="false" aria-controls="collapse<?= $row->id ?>">
                                                <?= $row->question ?>
                                                <span> </span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?= $row->id ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?= $row->id?>">
                                        <div class="panel-body">
                                        <p><?= $row->solve ?> </p>
                                         </div>
                                    </div>
                                </div>
                            <? } ?>

                                <!-- <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                چرا الکل قبل از کشف آن حرام اعلام شده بود
                                                <span> </span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <p>چونکه در واقع الکل وجود داشته از قرن های گزشته و حرام بوده اما کشف فرمولی و شیمیایی آن بعدا اتفاق افتاده .</p>
                                         </div>
                                    </div>
                                </div>
                
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed last" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                جایگاه ایرانیان در آن دنیا چیست ؟
                                                <span> </span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <p>
                                                تصور این بنده حقیر این هستش که ما مثلا تو اون دنیا 3 تا جهنم داریم جهنم راحت جهنم متوسط و سخت 
                                                حالا اگه شما جهنمی باشی خدا میگه که این تو دنیا ایران بوده پس بفرستینش جهنم سخته چون عذابای اون دوتا جهنم براش تکراریه 
                                            </p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript"  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<? include_once "footer.php"?>



