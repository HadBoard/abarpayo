<?
    $edit = false;
    if(isset($_GET['id'])){
        $edit = true;
        $cart_id = $action->request('id');
        if($action->user()){
            $row  = $action->cart_get($cart_id);
            $isUser = 1;
           
        }else if($action->marketer()){
            $row = $action->marketer_cart_get($cart_id);
            $isUser = 0;
        }
    }

    $error = false;
    if (isset($_SESSION['error'])) {
        $error = true;
        $error_val = $_SESSION['error'];
        unset($_SESSION['error']);
    }

    if(isset($_POST['submit'])){
        $bank_id = $action->request('bank');
        $name = $action->request('name');
        $account_number = $action->request('account_number');
        $cart_number = $action->request('cart_number');
        $iban = $action->request('iban');

        if($edit){
            $validate = $validate1 = $validate2 = 1;
            if($account_number != $row->account_number){
                $validate = $action->account_number_validate($id,$account_number,$isUser);
            }else if($iban != $row->iban){
                $validate1 = $action->iban_validate($iban) && $action->iban_unique($id,$iban,$isUser);
            }else if($cart_number != $row->cart_number){
                $validate2 = $action->cart_number_validate($id,$cart_number,$isUser);
            }
        }else{
            $validate = $action->account_number_validate($id,$account_number,$isUser);
            $validate1 = $action->iban_validate($iban) && $action->iban_unique($id,$iban,$isUser);
            $validate2 = $action->cart_number_validate($id,$cart_number,$isUser);
        }

        if($edit && $validate && $validate1 && $validate2){
            if($action->user()){
                $command= $action->cart_edit($cart_id,$bank_id,$name,$cart_number,$account_number,$iban,$validation);
            }else if($action->marketer()){
                $command= $action->marketer_cart_edit($cart_id,$bank_id,$name,$cart_number,$account_number,$iban,$validation);
            }    
        }else if($validate && $validate1 && $validate2){
            if($action->user()){
                $command= $action->cart_add($bank_id,$name,$cart_number,$account_number,$iban,$validation);
            }else if($action->marketer()){  
                $command= $action->marketer_cart_add($id,$bank_id,$name,$cart_number,$account_number,$iban,$validation);
            }
        }
        if ($command) {
            $_SESSION['error'] = 0;
        } else {
            $_SESSION['error'] = 1;
        }
        echo '<script>location.href = "?add-cart&id='.$command.'"</script>';
    } 
?>

<? if ($error) {
            if ($error_val) { ?>
            <div class="modal">
                    <div class="alert alert-fail">
                        <span class="close_alart">×</span>
                        <p>
                            کارت با مشخصات داده شده در سیستم موجود است!
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
    <a href="?carts"class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a>
   
    <h3 style="width: 50%;float: right;"><?= ($edit) ? "ویرایش کارت" : "افزودن کارت" ?></h3>

    <img src="assets/images/Group 465.svg">
    <!-- <div class="wallet_info wallet_info_btns">
        
    </div> -->
</div>
<div class="profile_left"style="padding-top: 0;
margin-top: -68px;" >
    <div class="add_card">

        
        <form action="" method="post" id="form">
            <div class="form-group">
                <label for="bank">نام بانک</label>
                <select name="bank" required>
                    <option>بانک را انتخاب فرمایید .</option>
                    <?
                    $option_result =  $action->bank_list();
                    while ($option = $option_result->fetch_object()) {
                        echo '<option value="';
                        echo $option->id;
                        echo '"';
                        if ($option->id == $row->bank_id) echo "selected";
                        echo '>';
                        echo $option->name;
                        echo '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">نام دارنده حساب</label>
                <input type="text" name="name" placeholder="فقط حروف فارسی" value="<?= $row->title ?>" required>
            </div>
            <div class="form-group">
                <label for="account_number">شماره حساب</label>
                <input type="text" id="account_number" name="account_number" value="<?= $row->account_number?>" required>
            </div>
            <div class="form-group">
                <label for="cart_number">شماره کارت</label>
                <input type="text" id="cart_number" name="cart_number" value="<?= $row->cart_number?>" required>
            </div>
                <div class="form-group">
                <label for="iban">شماره شبا</label>
                <input type="text" id="iban" name="iban" placeholder="فقط حروف فارسی" value="<?= $row->iban?>" required>
            </div>
            <input name="submit" type="submit" class="main_btn middle_btn " value="ذخیره">
            
        </form>
    </div>
</div>
</div>
<script>
// $('#form').submit(function (e) {
//   e.preventDefault();
//   var account_number = $("#account_number").val();
//   var cart_number = $("#cart_number").val();
//   var iban = $("#iban").val();

//   $.ajax({
//     type: 'POST',
//     url: 'ajax/validation.php',
//     data: {iban:iban,account_number:account_number,cart_number:cart_number},
//     success: function (response) {
//         if(response == 1){
//             alert(1);
//             // $('#form').submit();
//         }else{
//             // alert(-1);
//             e.preventDefault();
//             // alert(-1);
//             // $('#answers').html(response);
//         }
//     },
//   });
// });
</script>