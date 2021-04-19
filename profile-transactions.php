<?
    $user_id = $action->user()->id;
?>
           
<div class="edit_profile_div">


<div class="profile_header">
    <div class="profile_heade_inn">
        <div class="profile_header_img_2"><img src="assets/images/Path 710.svg"></div></div>
        
</div>
<div class="row profile_title">
    <a class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>

    <h3 style="width: 50%;float: right;">تراکنش های مالی</h3>
    <img src="assets/images/Group 465.svg">
    
</div>
<div class="profile_left">

    <div class="wallet_table">
        
        <table>
        <?
            $transactions = $action->user_get_payment($user_id);
            while($transaction = $transactions->fetch_object()){
                $type = $transaction->type;
        ?>  
                <tr>
                    <td <?= ($type == 1) ? 'class="dec_wallet"': 'class="inc_wallet"' ?>> <?= ($type == 1) ? "-".$transaction->amount : "+".$transaction->amount ?></td>
                    <td><?= $action->time_to_shamsi($transaction->date)?></td>
                    <td><?= $transaction->cart_number?></td>
                </tr>
        <?
            }
        ?>    
                        
            <!-- <tr>
                <td class="inc_wallet"> +5000 تومان</td>
                <td>شنبه 10 بهمن</td>
                <td>22:00</td>
                <td>224561235</td>
            </tr>
            <tr>
                <td class="dec_wallet"> +5000 تومان</td>
                <td>شنبه 10 بهمن</td>
                <td>22:00</td>
                <td>224561235</td>
            </tr>
            <tr>
                <td class="dec_wallet"> +5000 تومان</td>
                <td>شنبه 10 بهمن</td>
                <td>22:00</td>
                <td>224561235</td>
            </tr>
            <tr>
                <td class="dec_wallet"> +5000 تومان</td>
                <td>شنبه 10 بهمن</td>
                <td>22:00</td>
                <td>224561235</td>
            </tr>
            <tr>
                <td class="dec_wallet"> +5000 تومان</td>
                <td>شنبه 10 بهمن</td>
                <td>22:00</td>
                <td>224561235</td>
            </tr>
            <tr>
                <td class="dec_wallet"> +5000 تومان</td>
                <td>شنبه 10 بهمن</td>
                <td>22:00</td>
                <td>224561235</td>
            </tr>
            <tr>
                <td class="dec_wallet"> +5000 تومان</td>
                <td>شنبه 10 بهمن</td>
                <td>22:00</td>
                <td>224561235</td>
            </tr>
            <tr>
                <td class="dec_wallet"> +5000 تومان</td>
                <td>شنبه 10 بهمن</td>
                <td>22:00</td>
                <td>224561235</td>
            </tr>
            <tr>
                <td class="inc_wallet"> +5000 تومان</td>
                <td>شنبه 10 بهمن</td>
                <td>22:00</td>
                <td>224561235</td>
            </tr> -->

        </table> 
    </div>
</div>
</div>
            
       