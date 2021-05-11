
<?
    if($action->user()){
        $invitation_code = $action->user_get($id)->reference_code;
        $result = $action->user_invitations_list($id);
    }else if($action->marketer()){
        $invitation_code = $action->marketer_get($id)->reference_code;
        $result = $action->marketer_invitations_list($id);
    }
?>
<div class="edit_profile_div">
    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img_2"><img src="assets/images/icons8-add-user-group-man-man-100.png"></div></div>    
    </div>

    <div class="profile_left profile_left2">
        <div class="row profile_title">
            <h3>کد دعوت</h3>
            <span class="line"></span>

        </div>
        <!--  -->
        <div class="invation-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <div class="row">
                                <div class="col-12">
                                    <img src="assets/images/icons8-invite-64.png">
                                    <h3>کد دعوت</h3>
                                </div>
                            </div>
                                
                        </div>
                        <div class="flip-card-back">
                            <h2><?= $invitation_code?></h2>
                            
                                <div class="share-link">
                                    <button class="whatsapp-icon">
                                        <i class="fab fa-whatsapp-square"></i>
                                    </button>
                                    <button class="telegram-icon">
                                        <i class="fab fa-telegram"></i>
                                    </button>
                                    <button class="copy-icon">
                                        <i class="far fa-copy"></i>
                                    </button>
                                </div>
                             
                        </div>
                        </div>
                    </div> 
                </div>
                <div class="col-md-12">
                    <div class="flip-card flip-card-link">
                        <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="assets/images/icons8-invite-64.png">
                            <h3>لینک دعوت</h3>
                        </div>
                        <div class="flip-card-back">
                            <h3><?= 'http://abarpayo.com/abarpayo/phone.php?ref='.$invitation_code ?></h3>
                            <div class="share-link">
                                    <button class="whatsapp-icon">
                                        <i class="fab fa-whatsapp-square"></i>
                                    </button>
                                    <button class="telegram-icon">
                                        <i class="fab fa-telegram"></i>
                                    </button>
                                    <button class="copy-icon">
                                        <i class="far fa-copy"></i>
                                    </button>
                                </div>
                            
                        </div>
                        </div>
                    </div> 
                </div>
            </div>  
        </div>   
        <!--  -->
        <? if($result->num_rows){?>
        <div class="wallet_table inviataion_table">
            <div class="header_table_inv">
                <h3>افراد دعوت شده</h3>
                <span class="line"></span>

            </div>
            <table>
                
                <tr>
                    <th>نام کاربر</th>
                    <th>تارخ ثبت نام</th>
                </tr>
                <? while($row = $result->fetch_object()){?>
                <tr>
                    <td><?= $row->first_name." ".$row->last_name?></td>
                    <td><?= $action->time_to_shamsi($row->created_at)?></td>
                </tr>
                <?}?>
               
            </table>

            
        </div>
        <?}?>
    </div>
</div>
         