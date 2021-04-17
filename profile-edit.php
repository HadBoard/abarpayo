
<?
    
    if(isset($_POST['submit'])){
        $phone = $action->request('phone');
        $first_name = $action->request('name');
        $last_name = $action->request('lname');
        $national_code = $action->request('national_code');
        $email = $action->request('email');
        $result = $action->user_get_phone($phone);
        $user = $result->fetch_object();
        if($user->phone == $phone){
            $command->user_profile_edit($first_name, $last_name,$national_code, $phone, $email);
        }else{
            $code=rand(100000,999999);
            // $action->send_sms($phone,$code);
            $action->validation_code_add($user->id,$code);
        }
        

    }
?>
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
                <input type="text" name="name" placeholder="فقط حروف فارسی">
            </div>
            <div class="form-group">
                <label for="lname">نام خانوادگی</label>
                <input type="text" name="lname" placeholder="فقط حروف فارسی">
            </div>
            <div class="form-group">
                <label for="national_code">کدملی</label>
                <input type="text" name="national_code" placeholder="کدملی">
            </div>
            <div class="form-group">
                <label for="phone">شماره موبایل</label>
                <input type="text" name="phone" placeholder="*******09">
            </div>
            <div class="form-group">
                <label for="email">شماره موبایل</label>
                <input type="text" name="email" placeholder="example@gmail.com">
            </div>

            <input type="submit" class="main_btn middle_btn " value="ادامه">

        </form>
    </div>
</div>
