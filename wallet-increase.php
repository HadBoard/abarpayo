<?
    $user_id = $action->user()->id;
    $wallet = $action->user_get($user_id)->wallet;
?>

<div class="edit_profile_div">

    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img_2"><img src="assets/images/Path 710.svg"></div></div>
            
    </div>
    <div class="row profile_title">
        <a class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>
    
        <h3 style="width: 50%;float: right;">کیف پول</h3>

        <img src="assets/images/Group 465.svg">
        <div class="wallet_info wallet_info_btns">
            <h4>
                اعتبار فعلی : 
                <span>
                <?= ($wallet) ? $wallet : 0 ?> تومان
                </span>
            </h4>
            <div class="row wallet_increasement">
                <div class="col-4">
                    <a class="main_btn wallet_btn">50000 تومان</a>
                </div>
                <div class="col-4">
                    <a class="main_btn wallet_btn">100000 تومان</a>
                </div>
                <div class="col-4">
                    <a class="main_btn wallet_btn">200000 تومان</a>
                </div>

                <form action="wallet-request.php">
                    <input name="amount" placeholder="مبلغ را وارد کنید">
                    <input name="wallet_increase" type="submit" value="پرداخت" class="main_btn middle_btn">
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="profile_left">
        
    </div> -->
</div>

