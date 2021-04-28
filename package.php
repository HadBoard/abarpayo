<?
    require_once "functions/database.php";
    $action = new Action();
    $title = "پکیج ها";
   $marketer_id = $action->marketer()->id;
?>
<? if( $action->hasUnpaidPackage($marketer_id)) {?>
<div class="profile-warning">
   شما یک پکیج در انتظار پرداخت دارید.
</div>
<? } ?>
<div class="edit_profile_div">


    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img_2"><img style="transform: scale(1.5);margin-top: 43px;" src="assets/images/icons8-package-64.png"></div></div>    
    </div>

    <div class="profile_left profile_left2">
        <div class="row profile_title">
            <h3>پکیج</h3>
            <? if( $action->hasUnpaidPackage($marketer_id)) {?>
            <p class="warning-package">شما یک پکیج خریداری نشده دارید</p>
            <? } ?>
        </div>
        <!--  -->
        
        <!--  -->
        <?
            $package_id =$action->marketer_get($marketer_id)->package_id;
        ?>
        <div class="wallet_table inviataion_table package_factor">
            <table>
                <tr>
                    <th>نام پکیج</th>
                    <th>تاریخ ثبت نام</th>
                    <th>قیمت</th>
                    <th>وضعیت</th>
                </tr>
                <tr>
                    <td><?= $action->package_get($package_id)->name?></td>
                    <td><?= $action->time_to_shamsi($action->marketer_get($marketer_id)->created_at)?></td>
                    <td><?= $action->package_get($package_id)->price?></td>
                    <? if( $action->hasUnpaidPackage($marketer_id)) {?>
                        <td><form action="marketer-package-request.php" method="post">
                            <input type="hidden" name="package" value="<?= $action->package_get($package_id)->price ?>">
                            <button name="pay_factor" class="pay_factor">پرداخت</button>
                        </form></td>
                    <? }else{ ?>
                        <td>پرداخت شده </td>
                    <? } ?>
                </tr>      
            </table>
        </div>
    </div>
</div>