<?
    $user_id = $action->user()->id;
    $wallet = $action->user_get($user_id)->wallet;

    if(isset($_POST['withdraw_wallet'])){
        $amount = $action->request('amount');
        if($amount > $wallet){
            ?>
            <div class="modal">
                    <div class="alert alert-fail">
                        <span class="close_alart">×</span>
                        <p>
                            مبلغ درخواست شده بیشتر از موجودی کیف پول شما است!
                        </p>
                    </div>
                </div>
                <script src="assets/js/alert.js"></script>
            <?
        }else{
            // $command  = $action->request_add();
            if($command){
                ?> 
                <div class="modal">
                    <div class="alert alert-suc">
                        <span class="close_alart">×</span>
                        <p>
                            درخواست برداشت از کیف پول با موفقیت ثبت شد!
                        </p>
                    </div>
                </div>
                <script src="assets/js/alert.js"></script>
                <?
            }
        }
    }
?>
          
<div class="edit_profile_div">

    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img_2"><img src="assets/images/Path 710.svg"></div></div>
            
    </div>
    <div class="row profile_title">
        <a class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>
    
        <h3 style="width: 50%;float: right;">درخواست تسویه</h3>

        <img src="assets/images/Group 465.svg">
        <div class="wallet_info wallet_info_btns">
            <h4>
                اعتبار فعلی : 
                <span>
                    <?= $wallet ?> تومان
                </span>
            </h4>
            <div class="row wallet_increasement">
                <div class="col-4">
                    <a class="main_btn wallet_btn" onclick="changeValue(5000)">50000 تومان</a>
                </div>
                <div class="col-4">
                    <a class="main_btn wallet_btn" onclick="changeValue(100000)">100000 تومان</a>
                </div>
                <div class="col-4">
                    <a class="main_btn wallet_btn" onclick="changeValue(200000)">200000 تومان</a>
                </div>

                <form action="" method="post">
                    <input name="amount" id="amount" placeholder="مبلغ را وارد کنید">
                    <input name="withdraw_wallet" type="submit" value="پرداخت" class="main_btn middle_btn">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
   function changeValue(amount){
     document.getElementById('amount').value= amount;
    }
</script>     