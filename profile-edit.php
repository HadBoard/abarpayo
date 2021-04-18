<?
    $user_id = $action->user()->id;
    if(isset($_POST['submit'])){
        $phone = $action->request('phone');
        $first_name = $action->request('name');
        $last_name = $action->request('lname');
        $national_code = $action->request('national_code');
        $birthday = $action->request_date('birthday');
        $user_phone = $action->user_get($user_id)->phone;
        $command= $action->user_profile_edit($first_name, $last_name,$national_code,$birthday);
        if($command){
            ?>
            <div class="modal">
                    <div class="alert alert-suc">
                        <span class="close_alart">×</span>
                        <p>
                            عملیات موفق بود!
                        </p>
                    </div>
                </div>
            <script src="assets/js/alert.js"></script>
            <?
        }
        // if($user_phone == $phone){
        //     $command= $action->user_profile_edit($first_name, $last_name,$national_code,$birthday);
        // }else{
        //     $code=rand(100000,999999);
        //     // $action->send_sms($phone,$code);
        //     $_SESSION['change_phone_code'] = $code;
        //     $action->validation_code_add($user_id,$code);
?>
           <!-- <script> document.getElementById("myModal").style.display = "block";</script> -->
<?
        // }
    }
    // $sent_code = $_SESSION['change_phone_code'];
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
                <input type="text" id="first_name" name="name" value="<?= $action->user_get($user_id)->first_name?>" placeholder="فقط حروف فارسی">
            </div>
            <div class="form-group">
                <label for="lname">نام خانوادگی</label>
                <input type="text" id="last_name" name="lname" value="<?= $action->user_get($user_id)->last_name?>"  placeholder="فقط حروف فارسی">
            </div>
            <div class="form-group">
                <label for="national_code">کدملی</label>
                <input type="text" id="national_code" name="national_code" value="<?= $action->user_get($user_id)->national_code?>">
            </div>
            <div class="form-group">
                <label for="phone">شماره موبایل</label>
                <input type="text" id="phone" name="phone" placeholder="*******09" value="<?= $action->user_get($user_id)->phone?>"readonly>
            </div>
            
            <div class="form-group">
            <label for="birthday">تاریخ تولد</label>
                <input type="text" id="date" name="birthday" class="form-control"
                        placeholder="تاریخ تولد"
                        required value="<?= ($action->user_get($user_id)->birthday) ? $action->time_to_shamsi($action->user_get($user_id)->birthday) : "" ?>">
            </div>

            <button name="submit" class="main_btn middle_btn " id="form_submit" >ادامه</button>

        </form>
    </div>
</div>
<!-- <script>
 document.getElementById('code_submit').onclick=function(){
    var code=document.getElementById('code').value;
       $.ajax({
            url:'ajax/code.php',
            type:'post',
            data:{code:code},
            success:function(data){
                console.log(data)
        		if(data==-1){
                        alert("دوباره تلاش کنید.");
                }
                if(data==1){
                    alert("1");
                }
            }
       })
   }
</script> -->
