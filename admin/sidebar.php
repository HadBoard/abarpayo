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
        <a class="has-arrow" href="withdraw-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu"> درخواست های برداشت </span>
        </a>
    </li>

    <li>
        <a class="has-arrow" href="ticket-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">تیکت ها</span>
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
