<?
    if($action->user()){
        $result  =  $action->score_logs_list($id);
        
    }else if($action->marketer()){
        $result  =  $action->marketer_score_logs_list($id);
    }
?> 
<div class="edit_profile_div">
<div class="profile_header">
    <div class="profile_heade_inn">
        <div class="profile_header_img_2"><img src="assets/images/Path 710.svg"></div></div>
        
</div>
<div class="row profile_title">
    <h3 style="width: 50%;float: right;">تاریخچه امتیازات</h3>
    <img src="assets/images/Group 465.svg">
</div>
<div class="profile_left">

    <div class="wallet_table">
        
        <table>
            <? while($row = $result->fetch_object()){?>
            <tr>
                <td <?= ($type == 1) ? 'class="dec_wallet"': 'class="inc_wallet"' ?>><?= ($type == 1) ? "-".$row-> score : "+".$row-> score ?></td>
                <td><?= $action->action_log_get(($row -> action_id))->text?></td>
                <td><?= $action->time_to_shamsi($row->created_at)?></td>
            </tr>
            <? } ?>
       
        </table>
    </div>
</div>
</div>
