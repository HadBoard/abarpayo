
<?
    $user_id = $action->user()->id;
    $icon = $action->user_get($user_id)->profile; 
    $icon = ($icon ? $icon : "");  
?>
<div class="profile_right">
    <div class="row">
        <div class="col-6">
            <div class="profile_right_img"><img src=<?= $icon ? "admin/users/$icon" :"https://webmaz.ir/sanyar/images/woman-5.jpg"?>></div>

        </div>
        <div class="col-6 profile_user">
            <h3><?= $action->user_get($user_id)->first_name." ".$action->user_get($user_id)->last_name ?></h3>
            <h5><?= $action->user_get($user_id)->phone?></h5>
            <a href="?edit" class="main_btn edit_profile">
                <i class="fa fa-edit"></i>
                ویرایش
            </a>
        </div>
    </div>
    <div class="row">
        <a href="?address" class="main_btn profile_btn">
            <i class="fa fa-user"></i>
            <h4>انتخاب شهر</h4>
            <img src="assets/images/006-right-arrow.svg">
        </a>
        <a href="?wallet" class="main_btn profile_btn">
            <i class="fa fa-user"></i>
            <h4>کیف پول</h4>
            <img src="assets/images/006-right-arrow.svg">
        </a>
        <a href="?carts" class="main_btn profile_btn">
            <i class="fa fa-user"></i>
            <h4>لیست کارت ها</h4>
            <img src="assets/images/006-right-arrow.svg">
        </a>
        <a href="?transactions" class="main_btn profile_btn">
            <i class="fa fa-user"></i>
            <h4> لیست تراکنش ها</h4>
            <img src="assets/images/006-right-arrow.svg">
        </a>
        <a href="?invitation" class="main_btn profile_btn">
            <i class="fa fa-user"></i>
            <h4>لینک دعوت</h4>
            <img src="assets/images/006-right-arrow.svg">
        </a>
        <a href="?guilds" class="main_btn profile_btn">
            <i class="fa fa-user"></i>
            <h4>معرفی اصناف</h4>
            <img src="assets/images/006-right-arrow.svg">
        </a>
        <a href="?scores" class="main_btn profile_btn">
            <i class="fa fa-user"></i>
            <h4>تاریخچه امتیازات</h4>
            <img src="assets/images/006-right-arrow.svg">
        </a>
        <? if($action->user()){?>
        <a href="?communicate" class="main_btn profile_btn">
        <i class="fa fa-user"></i>
        <h4> ارتباط با حامی</h4>
        <img src="assets/images/006-right-arrow.svg    ">
        </a>
        <a href="?ticket" class="main_btn profile_btn">
        <i class="fa fa-user"></i>
        <h4>پاسخ تیکت ها</h4>
        <img src="assets/images/006-right-arrow.svg    ">
        </a>
     <? } ?>
        <? if($action->marketer()){?>
        <a href="?package" class="main_btn profile_btn">
        <i class="fa fa-user"></i>
        <h4>پکیج </h4>
        <img src="assets/images/006-right-arrow.svg    ">
        </a>
        <a href="?support" class="main_btn profile_btn">
        <i class="fa fa-user"></i>
        <h4>پرسش ها </h4>
        <img src="assets/images/006-right-arrow.svg    ">
        </a>
     <? } ?>
    </div>
</div>
