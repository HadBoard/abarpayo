<?
require_once "functions/database.php";
$action = new Action();
?>
<!-- ----------- start sidebar ------------------------------------------------------------------------------------- -->
<ul id="sidebarnav">

    <li class="nav-label">| پنل</li>

    <li>
        <a class="has-arrow" href="panel.php" aria-expanded="false">
            <i class="fa fa-dashboard"></i>
            <span class="hide-menu">داشبورد</span>
        </a>
    </li>

    <hr class="m-0">

    <? if ($action->admin()->access) { ?>

        <li>
            <a class="has-arrow" href="admin-list.php" aria-expanded="false">
                <i class="fas fa-user-tie"></i>
                <span class="hide-menu">مدیران</span>
            </a>
        </li>

    <? } ?>

    <hr class="m-0">

    <li class="nav-label">| مدیریت</li>

    <li>
        <a class="has-arrow" href="user-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">کاربران</span>
        </a>
    </li>

    <hr class="m-0">


    <li>
        <a class="has-arrow" href="marketer-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">بازارسازان</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="vip-marketer.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">بازارسازان ویژه</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="old-marketer-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">بازارسازان قدیم</span>
        </a>
    </li>

    <hr class="m-0">

    <li>
        <a class="has-arrow" href="category-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">دسته بندی ها</span>
        </a>
    </li>

    <hr class="m-0">

    <li>
        <a class="has-arrow" href="shop-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">فروشگاه ها</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="product-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">محصولات</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="package-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">پکیج ها</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="question-package-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">پکیج سوالات</span>
        </a>
    </li>

    <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fas fa-user "></i><span class="hide-menu">درخواست های برداشت</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="marketer-withdraw-list.php">برداشت های بازاریابان</a></li>
            <li><a href="withdraw-list.php"> برداشت های کاربران</a></li>
            <li><a href="shop-withdraw-list.php"> برداشت های اصناف</a></li>
        </ul>
    </li>

    <li>
        <a class="has-arrow" href="shop-requests.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu"> درخواست ثبت اصناف  </span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="ticket-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">تیکت ها</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="contact-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">تماس با ما</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="frequently-asked-question-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">پرسش های پرتکرار</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="slider-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">اسلایدر ها</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="system.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">مدیریت سیستم</span>
        </a>
    </li>
    <li>
        <a class="has-arrow" href="set-scores.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu"> امتیازات سیستم</span>
        </a>
    </li>
    <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fas fa-user "></i><span class="hide-menu">لاگ سنتر</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="admin-log-list.php">لاگ مدیران</a></li>
            <li><a href="marketer-log-list.php">لاگ بازاریابان</a></li>
            <li><a href="user-log-list.php">لاگ کاربران</a></li>
            <li><a href="guild-log-list.php">لاگ اصناف</a></li>
        </ul>
    </li>
    <li>
        <a class="has-arrow" href="province-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">استان ها</span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="city-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">شهرستان ها</span>
        </a>
    </li>

    <hr class="m-0">

</ul>
<!-- ----------- end sidebar --------------------------------------------------------------------------------------- -->
