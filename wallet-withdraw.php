<?

    if($action -> user()){
        $wallet = $action->user_get($id)->wallet;
        $option_result =  $action->user_cart_list();
    }else if($action->marketer()){
        $wallet = $action->marketer_get($id)->wallet;
        $option_result =  $action->marketer_cart_list($id);
    }

    if(isset($_POST['withdraw_wallet'])){
        $amount = $action->request('amount');
        $cart = $action->request('cart');
        if($amount > $wallet){
            $_SESSION['error'] = 1;
            echo '<script>window.location="?wallet-withdarw"</script>';
        }else{

            if($action -> user()){
                $command  = $action->request_add($cart,$amount);
            }else if($action -> marketer()){
                $command  = $action->marketer_request_add($id,$cart,$amount);
            }
            
            if ($command) {
                $_SESSION['error'] = 0;
            } else {
                $_SESSION['error'] = 1;
            }
    
            echo '<script>window.location="?wallet-withdarw"</script>';
        }
    }
?>
<? if ($error) {
if ($error_val) { ?>

        <div class="modal">
        <div class="alert alert-fail">
            <span class="close_alart">×</span>
            <p>
                عملیات ناموفق بود!
            </p>
        </div>
    </div>
    <script src="assets/js/alert.js"></script>
    
<? } else { ?>
    <div class="modal">
        <div class="alert alert-suc">
            <span class="close_alart">×</span>
            <p>
                عملیات موفق بود!
            </p>
        </div>
    </div>
    <script src="assets/js/alert.js"></script>
    
<? }
} ?>
        
<div class="edit_profile_div">

    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img_2"><img src="assets/images/Path 710.svg"></div></div>
            
    </div>
    <div class="row profile_title">
        <a class="profile_title_icon" href="?wallet"><img src="assets/images/006-right-arrow.svg"></a>
    
        <h3 style="width: 50%;float: right;">درخواست تسویه</h3>

        <img src="assets/images/Group 465.svg">
        <div class="wallet_info wallet_info_btns">
            <h4>
                اعتبار فعلی : 
                <span>
                    <?= $wallet ? $wallet : 0 ?> تومان
                </span>
            </h4>
            <form action="" method="post">
            <div class="form-group">
                <select name="cart">
                    <option>کارت را انتخاب فرمایید .</option>
                    <?
                    while ($option = $option_result->fetch_object()) {
                        echo '<option value="';
                        echo $option->id;
                        echo '"';
                        if ($option->id == $row->cart_id) echo "selected";
                        echo '>';
                        echo $option->cart_number;
                        echo '</option>';
                    }
                    ?>
                </select>
            </div>
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
                    <input name="amount" id="amount" placeholder="مبلغ را وارد کنید">
                    <input name="withdraw_wallet" type="submit" value="ثبت درخواست" class="main_btn middle_btn">
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