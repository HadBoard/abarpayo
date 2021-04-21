<?
    $user_id = $action->user()->id;
    $edit = false;
    if(isset($_GET['id'])){
        $edit = true;
        $id = $action->request('id');
        $row  = $action->cart_get($id);
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
            $command= $action->cart_edit($id,$bank_id,$name,$cart_number,$account_number,$iban,0);
        }else{
            $command= $action->cart_add($bank_id,$name,$cart_number,$account_number,$iban,0);
        }

        if ($command) {
            $_SESSION['error'] = 0;
        } else {
            $_SESSION['error'] = 1;
        }
    
        echo '<script>location.href = "add-cart.php?id='.$command.'</script>';
       
    } 
?>

<? if ($error) {
            if ($error_val) { ?>
            <div class="modal">
                    <div class="alert alert-suc">
                        <span class="close_alart">×</span>
                        <p>
                            عملیات موفق بود!
                        </p>
                    </div>
                </div>
            <script src="assets/js/alert.js"></script>
              
            <? } else { ?>

                <div class="modal">
                    <div class="alert alert-fail">
                        <span class="close_alart">×</span>
                        <p>
                              عملیات ناموفق بود!
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

        
        <form action="" method="post">
            <div class="form-group">
                <label for="bank">نام بانک</label>
                <select name="bank">
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
                <input type="text" name="name" placeholder="فقط حروف فارسی" value="<?= $action->user_get($row->user_id)->first_name."  ".$action->user_get($row->user_id)->last_name ?>">
            </div>
            <div class="form-group">
                <label for="account_number">شماره حساب</label>
                <input type="text" name="account_number" placeholder="فقط حروف فارسی" value="<?= $row->account_number?>">
            </div>
            <div class="form-group">
                <label for="cart_number">شماره کارت</label>
                <input type="text" name="cart_number" placeholder="فقط حروف فارسی" value="<?= $row->cart_number?>" >
            </div>
                <div class="form-group">
                <label for="iban">شماره شبا</label>
                <input type="text" name="iban" placeholder="فقط حروف فارسی" value="<?= $row->iban?>">
            </div>
            <input name="submit" type="submit" class="main_btn middle_btn " value="ذخیره">
            
        </form>
    </div>
</div>
</div>
         