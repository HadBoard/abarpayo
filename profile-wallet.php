<?
    if($action->user()){
        $wallet = $action->user_get($id)->wallet;
        $carts = $action->user_get_cart_limited();
        $transactions = $action->user_get_payment_limited();
        $withdraws = $action->user_get_requests_limited();
    }else if($action -> marketer()){
        $wallet = $action->marketer_get($id)->wallet;
        $carts = $action->marketer_get_cart_limited($id);
        $transactions = $action->marketer_get_payment_limited($id);
        $withdraws = $action->marketer_get_requests_limited($id);
    }
   

    if($_SESSION['successful_pay'] == 'true'){
        ?>
            <div class="modal">
                    <div class="alert alert-suc">
                        <span class="close_alart">×</span>
                        <p>
                            پرداخت موفق بود!
                        </p>
                    </div>
                </div>
                <script src="assets/js/alert.js"></script>
        <?
        unset($_SESSION['successful_pay']);
    }

    if($_SESSION['successful_pay'] == 'false'){
        ?>
            <div class="modal">
                    <div class="alert alert-suc">
                        <span class="close_alart">×</span>
                        <p>
                            پرداخت موفق بود!
                        </p>
                    </div>
                </div>
                <script src="assets/js/alert.js"></script>
        <?
        unset($_SESSION['successful_pay']);
    }
?>
    <div class="edit_profile_div">
    
        <div class="profile_header">
            <div class="profile_heade_inn">
                <div class="profile_header_img_2"><img src="assets/images/Path 710.svg"></div></div>
                
        </div>
        <div class="row profile_title">
            <h3>کیف پول</h3>
            <img src="assets/images/Group 465.svg">
            <div class="wallet_info">
                <h4>
                    اعتبار فعلی : 
                    <span>
                        <?= ($wallet) ? $wallet : 0 ?> تومان
                    </span>
                </h4>
                <div class="row">
                    <div class="col-6">
                        <a href="?wallet-increase" style="float: left;
                        padding: 10px 20px;" class="main_btn wallet_btn">افزایش اعتبار</a>
                    </div>
                    <div class="col-6">
                        <a href="?wallet-withdraw" class="main_btn wallet_btn">درخواست تسویه</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_left profile_left_2">
            <div class="wallet_table">
                
                <table>
                    <div class="row wallet_table_title" >
                        <div class="col-6">
                            <h4>مدیریت کارت ها</h4>
                        </div>
                        <div class="col-6">
                            <a href="?carts">مشاهده همه</a>
                        </div>
                    </div>
                    <?
                        while($cart = $carts->fetch_object()){
                    ?>  
                            <tr>
                                <td><?= $cart->title ?></td>
                                <td><?=  $action->bank_get($cart->bank_id)->name?></td>
                                <td><?= $cart->cart_number?></td>
                            </tr>
                    <?
                        }
                    ?>                  

                </table>


            </div>
            <div class="wallet_table">
                
                <table>
                    <div class="row wallet_table_title" >
                        <div class="col-6">
                            <h4>تراکنش های اخیر</h4>
                        </div>
                        <div class="col-6">
                            <a href="?transactions">مشاهده همه</a>
                        </div>
                    </div>
                    <?
                    
                        while($transaction = $transactions->fetch_object()){
                            if($action->user()){
                                $payments = $action->payment_get_action($transaction->id);
                            }else if($action->marketer()){
                                $payments = $action->marketer_payment_get_action($transaction->id);
                            }
                           
                            $payment = $payments->fetch_object();
                            $type = $transaction->type;
                    ?>  
                            <tr>
                                <td <?= ($type == 1) ? 'class="dec_wallet"': 'class="inc_wallet"' ?>> <?= ($type == 1) ? "-".$transaction->amount : "+".$transaction->amount ?></td>
                                <td><?= $action->time_to_shamsi($transaction->date)?></td>
                                <td><?= $action->action_log_get($payment->action_id)->text?></td>
                            </tr>
                    <?
                        }
                       
                        while($withdraw = $withdraws->fetch_object()){
                    ?>  

                        <tr>
                            <td class="dec_wallet"> <?= "-".$withdraw->amount ?></td>
                            <td><?= $action->time_to_shamsi($withdraw->paymented_at)?></td>
                            <td>برداشت از حساب</td>
                        </tr>

                    <?
                        }
                    ?>  
                </table>                
            </div>
        </div>
    </div>

