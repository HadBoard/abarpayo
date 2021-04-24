<?
    $user_id = $action->user()->id;
    $icon = $action->user_get($user_id)->profile; 
    $icon = ($icon ? $icon : "");  
    if(isset($_POST['submit'])){
        $phone = $action->request('phone');
        $first_name = $action->request('name');
        $last_name = $action->request('lname');
        $national_code = $action->request('national_code');
        

        $birthday = $action->request_date('birthday');
        
       
        $user_phone = $action->user_get($user_id)->phone;

        if($_FILES["pic"]["name"]){
    
            $target_dir = "admin/users/";
            $target_file = $target_dir . basename($_FILES["pic"]["name"]);
    
            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");
    
            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                $name = $action -> get_token(10) . "." . $imageFileType;
                // Upload file
                move_uploaded_file($_FILES['pic']['tmp_name'],$target_dir.$name);
                $icon = $name;
    
            } 
        }
        $command= $action->user_profile_edit($first_name, $last_name,$national_code,$birthday,$icon);
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
            echo "<script>location.href='?edit'</script>";
        }
    }
?>


<div class="edit_profile_div">

    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img"><img src=<?= $icon ? "admin/users/$icon" :"https://webmaz.ir/sanyar/images/woman-5.jpg"?>>
            </div>
        </div>
    <form action="" method="post"  enctype="multipart/form-data">
        <label for="pic">ویرایش تصویر</label>
            <input type="file" style="
                display: none;
            " name="pic">
    </div>
    <div class="profile_left">
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
                <input type="text" id="birthday" name="birthday" class="form-control"
                        placeholder="تاریخ تولد"
                        value="<?= ($action->user_get($user_id)->birthday) ? $action->time_to_shamsi($action->user_get($user_id)->birthday) : "" ?>">
            </div>

            <button name="submit" class="main_btn middle_btn " id="form_submit" >ذخیره</button>

        </form>
    </div>
</div>
<script>
$("label[for='pic']").click(function(){
    console.log('hello')
    $("input[name=pic]").click();
})

</script>
