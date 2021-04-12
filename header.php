<?
require_once "functions/database.php";
$action = new Action();
?>

<!-- ------------------------------------------------------------------------------------------------------------------------>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <title><?= (isset($title)?$title:"ابر پایو") ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel='icon' type='image/png' href='assets/images/logo.png'>

    <link rel="stylesheet" href="assets/css/swiper.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/fontiran.css">
    <link rel="stylesheet" href="assets/css/fontAswome.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">

    <script src='assets/js/swiper.js'></script>
    <script src='assets/js/jquery.js'></script>
    <script src='assets/js/fontAwsome.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <style>
        .carousel-cell.is-selected {
            transform: scale(1.02);
        }
        .main-slider {
            width: 100%;
            margin-top: 30px;
            margin-bottom: 50px;;
        }

        .carousel-cell {
            width: 66%;
            height: 400px;
            margin-right: 10px;
            /*! background: #8C8; */
            border-radius: 5px;
            counter-increment: carousel-cell;
            padding-top: 21px;
        }

        /* cell number */
        .carousel-cell:before {
            display: block;
            text-align: center;
            /* content: counter(carousel-cell); */
            line-height: 200px;
            font-size: 80px;
            /* color: white; */
        }

        .flickity-viewport {
            height:  525px !important;
        }
        .carousel-cell {
            max-width: 100% !important;
            height: auto;
            transform: scale(0.8);
        }




    </style>
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
            <div class="col-1 logo_header" >
                <img src="assets/images/logo.png">
            </div>
            <div class="col-md-3 search_header">
                <input placeholder="لطفا کلمه مورد نظر خود را جستجو کنید">
                <button><span class="material-icons">
                    search
                    </span></button>
            </div>
            <div class="col-md-3 city_header">
                <select>
                    <option>یزد-یزد</option>
                    <option>یزد-یزد</option>
                    <option>یزد-یزد</option>
                </select>
            </div>
            <div class="col-md-5">
                <a class="main_btn">
                    <i class="fa fa-user"></i>

                    ورود یا ثبت نام
                </a>
            </div>

        </div>
        <div class="row main_header-nav">
            <nav>
                <ul class="menu_header">
                    <span class="material-icons">
                        menu
                    </span>
                    <li>
                        <a href="#">دسته بندی</a>
                    </li>
                    <li>
                        <a href="#">صفحه اصلی</a>
                    </li>
                    <li>
                        <a href="#">فروشگاه</a>
                    </li>
                    <li>
                        <a href="#">باشگاه مشتریان</a>
                    </li>
                    <li>
                        <a href="#">درباره ما</a>
                    </li>
                    <li>
                        <a href="#">تماس با ما</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</header>
<!-- eof header -->
