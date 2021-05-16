<?
    if($action->user()){
        $transactions = $action->wallet_history($id,1);
    }else if($action->marketer()){
        $transactions = $action->wallet_history($id,0);
    }
?> 
<div class="edit_profile_div">
<div class="profile_header">
    <div class="profile_heade_inn">
        <div class="profile_header_img_2"><img src="assets/images/Path 710.svg"></div></div>
        
</div>
<div class="row profile_title">
    <a href="?wallet" class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>

    <h3 style="width: 50%;float: right;">تاریخچه کیف پول</h3>
    <img src="assets/images/Group 465.svg">
</div>
<div class="profile_left">

    <div class="wallet_table">
        
        <table>
        <?
            while($transaction = $transactions->fetch_object()){
        ?>  
                <tr>
                    <td <?= ($transaction->type == 1) ?'class="inc_wallet"' : 'class:"dec_wallet"'?>> <?= ($transaction->type == 1) ? "+".$transaction->amount : "-".$transaction->amount ?></td>
                    <td><?= $action->action_log_get($payment->action_id)->text ?></td>
                    <td><?= $action->time_to_shamsi($transaction->created_at)?></td>
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
