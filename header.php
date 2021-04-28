<?
require_once "functions/database.php";
$action = new Action();
?>

<!-- ------------------------------------------------------------------------------------------------------------------------>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <title><?= (isset($title) ? $title : "ابر پایو") ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel='icon' type='image/png' href='assets/images/logo.png'>

    <link rel="stylesheet" href="assets/css/swiper.css">
    <link rel="stylesheet" href="assets/css/fontiran.css">
    <link rel="stylesheet" href="assets/css/fontAswome.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src='assets/js/swiper.js'></script>
    <script src='assets/js/jquery.js'></script>
    <script src='assets/js/fontAwsome.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin/css/jquery.Bootstrap-PersianDateTimePicker.css"/>
    <link type="text/css" rel="stylesheet" href="admin/css/kamadatepicker.css"/>
    <script src="admin/js/kamadatepicker.js"></script>


</head>

<body>

<!-- header -->
<header>
    <div class="info_header">
        <div class="container">
            <div class='row'>

                <div class="col-2">
                    <span class="material-icons">
                        email
                    </span>
                    <a href="mailto:support@lmsins.ir">
                        <p> zhetoon@gmail.com </p>
                    </a>
                </div>

                <div class="col-2">
                    <span class="material-icons">
                        call
                        </span>
                    <a href="tel:+98-5832226125">
                        <p>+98-9135244859</p>
                    </a>
                </div>

            </div>
        </div>

    </div>
    <!-- eof info header -->
    <div class="container main_header">
        <div class="row main_header_top">
            <div class="col-1 logo_header">

                <a href="index.php">
                    <img src="assets/images/logo.png">
                </a>

            </div>
            <div class="col-md-4 search_header">
                <input id="search" placeholder="لطفا کلمه مورد نظر خود را جستجو کنید">
                <button id="search_button"><span class="material-icons">search</span></button> 
            </div>
            <div class="col-md-3 city_header">
                <select>
                    <option>یزد-یزد</option>
                    <option>یزد-یزد</option>
                    <option>یزد-یزد</option>
                </select>
            </div>

            <? if ($action->auth()) { ?>
                <div class="col-md-4 active_header_user ">
                    <div class="user_header user_signout">
                        <a href="logout.php">
                            <img src="assets/images/logout.png">
                        </a>

                    </div>
                    <div class="user_header">
                        <a href="profile.php">
                            <img src="assets/images/user (1).png">
                        </a>

                    </div>

                    <div class="line_header">
                        <img src="assets/images/Line 15.png">
                    </div>

                    <div class="notice_header">
                        <a href="notification.php">
                            <img src="assets/images/Announcement.png">
                            <span>2</span>
                        </a>
                    </div>

                    <div class="message_header">
                        <a href="message.php">
                            <img src="assets/images/message.png">
                            <span>2</span>
                        </a>
                    </div>

                </div>
            <? } else { ?>
                <div class="col-md-4">
                    <a class="main_btn" href="phone.php">
                        <i class="fa fa-user"></i>
                        ورود یا ثبت نام
                    </a>
                </div>
            <? } ?>


        </div>
        <div class="row main_header-nav">
            <nav>
                <ul class="menu_header">
                    <li style="position: relative;">
                            <span class="material-icons">
                                menu
                            </span>
                        <a class="category_btn" href="#">دسته بندی</a>
                        <div class="submenu">
                            <?
                                $result = $action->category_ordered_list();
                                while($row = $result->fetch_object()){
                            ?>
                                <a href="shop-list.php?category=<?=$row->id?>">
                                    <img src="admin/images/categoryIcons/<?= $row->icon ?>">
                                    <h5><?= $row->title ?></h5>
                                </a>
                            <?
                                }
                            ?>

                        </div>
                    </li>
                    <li>
                        <a href="index.php">صفحه اصلی</a>
                    </li>
                    <li>
                        <a href="#">فروشگاه</a>
                    </li>
                    <li style="width:14%">
                        <a href="#">باشگاه مشتریان</a>
                    </li>
                    <li>
                        <a href="about-us.php">درباره ما</a>
                    </li>
                    <li>
                        <a href="contact-us.php">تماس با ما</a>
                    </li>
                    <li>
                        <a href="marketer-phone.php">بازار ساز</a>
                    </li>
                    
                </ul>
            </nav>

        </div>
    </div>
</header>
<!-- eof header -->
<script>

 $('#search_button').click(function(){
     var search = $('#search').text();
    $.ajax({
        url: "ajax/search.php",
        type:'post',
        data: {search:search},
        success: function(response){
            if(response){
               console.log(response);
            }else{
                
            }
        }
    });
});
</script>
