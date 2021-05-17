<?
    if($action->user()){
        $transactions = $action->user_get_payment();
    }else if($action->marketer()){
        $transactions = $action->marketer_get_payment($id);
    }
?> 
<div class="edit_profile_div">
<div class="profile_header">
    <div class="profile_heade_inn">
        <div class="profile_header_img_2"><img src="assets/images/Path 710.svg"></div></div>
        
</div>
<div class="row profile_title">
    <a href="?wallet" class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>

    <h3 style="width: 50%;float: right;">تراکنش های مالی</h3>
    <img src="assets/images/Group 465.svg">
</div>
<div class="profile_left">

    <div class="wallet_table">
        
        <table>
        <?
            while($transaction = $transactions->fetch_object()){
                if($action->user()){
                    $payments = $action->payment_get_action($transaction->id);
                }else if($action->marketer()){
                    $payments = $action->marketer_payment_get_action($transaction->id);
                }
                $payment = $payments->fetch_object();
        ?>  
                <tr>
                    <td class="inc_wallet"'> <?=  "+".$transaction->amount ?></td>
                    <td><?= $action->action_log_get($payment->action_id)->text ?></td>
                    <td><?= $action->time_to_shamsi($transaction->date)?></td>
                </tr>
        <?
            }
        ?>  
        </table>
        <table>
        </table>
    </div>
</div>
</div>
