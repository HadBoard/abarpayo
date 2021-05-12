<?
    if($action->user()){
        $wallet = $action->user_get($id)->wallet;
        $transactions = $action->wallet_history_limited($id,1);
    }else if($action -> marketer()){
        $wallet = $action->marketer_get($id)->wallet;
        $transactions = $action->wallet_history_limited($id,0);
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
                            <h4>تاریخچه کیف پول</h4>
                        </div>
                        <div class="col-6">
                            <a href="?wallet-history">مشاهده همه</a>
                        </div>
                    </div>
                    <?
                        while($transaction = $transactions->fetch_object()){
                    ?>  
                            <tr>
                                <td <?= ($transaction->type == 1) ?'class="inc_wallet"' : 'class:"dec_wallet"'?>> <?= ($transaction->type == 1) ? "+".$transaction->amount : "-".$transaction->amount ?></td>
                                <td><?= $action->time_to_shamsi($transaction->created_at)?></td>
                                <td><?= $action->action_log_get($payment->action_id)->text ?></td>
                            </tr>
                    <?
                        }
                    ?>  
                </table>                
            </div>
        </div>
    </div>

