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

        <li>
            <a class="has-arrow" href="admin-list.php" aria-expanded="false">
                <i class="fas fa-user-tie"></i>
                <span class="hide-menu">مدیران</span>
            </a>
        </li>

    <hr class="m-0">

    <li class="nav-label">| مدیریت</li>

    <li>
        <a class="has-arrow" href="shop.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu"> تنظیمات فروشگاه</span>
        </a>
    </li>
    <hr class="m-0">
    <li>
        <a class="has-arrow" href="product-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">محصولات</span>
        </a>
    </li>
    <hr class="m-0">
    <li>
        <a class="has-arrow" href="shop-comment-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">نظرات</span>
        </a>
    </li>
    <hr class="m-0">
    <li>
        <a class="has-arrow" href="ticket-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">پشتیبانی</span>
        </a>
    </li>
    <li>
        <a class="has-arrow" href="add-guild-list.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">پیشنهاد فروشگاه جدید</span>
        </a>
    </li>
    <hr class="m-0">
    <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fas fa-user "></i><span class="hide-menu">صندوق</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="wallet-log.php">کیف پول</a></li>
            <li><a href="cart-list.php">کارت ها</a></li>
           
        </ul>
    </li>
    <hr class="m-0">
    <li>
        <a class="has-arrow" href="log.php" aria-expanded="false">
            <i class="fa fa-user"></i>
            <span class="hide-menu">لاگ</span>
        </a>
    </li>
     

       <hr class="m-0">

</ul>
<!-- ----------- end sidebar --------------------------------------------------------------------------------------- -->
