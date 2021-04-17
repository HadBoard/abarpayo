<?
    
    if(isset($_POST['submit'])){
        $phone = $action->request('phone');
        $first_name = $action->request('name');
        $last_name = $action->request('lname');
        $national_code = $action->request('national_code');
        $user_id = $action->user()->id;
        $user_phone = $user_get($user_id)->phone;
        if($user_phone == $phone){
            $command= $action->user_profile_edit($first_name, $last_name,$national_code, $phone,$birthday);
        }else{
            $code=rand(100000,999999);
            // $action->send_sms($phone,$code);
            $action->validation_code_add($user->id,$code);
        }
    }
?>
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <div class="modal-header">
        <span class="close">×</span>
        <h2>تایید کد تلفن همراه</h2>
    </div>
    <div class="modal-body">
        <p>کد ارسال شده برای شماره تلفن خود را وارد کنید</p>
        <input type="text" placeholder="کد ارسال شده">
        <div class="row">
            <button name="code_submit" class="main_btn modal_btn">ثبت کد
            </button>
        </div>
    </div>
  
</div>

</div>
<div class="edit_profile_div">

    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img"><img src="https://webmaz.ir/sanyar/images/woman-5.jpg">
            </div>
        </div>

        <a>ویرایش تصویر</a>
    </div>
    <div class="profile_left">
    <form action="" method="post">
            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" name="name" value= "<?= $row->first_name?>" placeholder="فقط حروف فارسی">
            </div>
            <div class="form-group">
                <label for="lname">نام خانوادگی</label>
                <input type="text" name="lname" value= "<?= $row->last_name?>" placeholder="فقط حروف فارسی">
            </div>
            <div class="form-group">
                <label for="national_code">کدملی</label>
                <input type="text" name="national_code"  value= "<?= $row->national_code?>" placeholder="کدملی">
            </div>
            <div class="form-group">
                <label for="phone">شماره موبایل</label>
                <input type="text" name="phone" placeholder="*******09"  value= "<?= $row->phone?>">
            </div>
            <div class="form-group">
            <label for="birthday">تاریخ تولد</label>
                <input type="text" id="date" name="birthday" class="form-control"
                        placeholder="تاریخ تولد"
                        value="<?= $action->time_to_shamsi($row->birthday) ?>"
                        required>
            </div>

            <input name="submit" type="submit" class="main_btn middle_btn " value="ادامه">

        </form>
    </div>
</div>
