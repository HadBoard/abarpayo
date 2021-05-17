<?
    if($action->user()){
        $icon = $action->user_get($id)->profile;

    }else if($action->marketer()){
        $icon = $action->marketer_get($id)->profile;
    }

$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}

    $icon = ($icon ? $icon : "");  
    if(isset($_POST['submit'])){
        $phone = $action->request('phone');
        $first_name = $action->request('name');
        $last_name = $action->request('lname');
        $national_code = $action->request('national_code');
        $birthday = $action->request_date('birthday');

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
        if($action->user()){
            $command= $action->user_profile_edit($first_name, $last_name,$national_code,$birthday,$icon);
        }else if($action->marketer()){
            $command= $action->marketer_profile_edit($id,$first_name, $last_name,$national_code,$birthday,$icon);
        }

        if ($command) {
            $_SESSION['error'] = 0;
        } else {
            $_SESSION['error'] = 1;
        }

        echo '<script>window.location="?edit"</script>';
    }
?>

<? if ($error) {
            if ($error_val) { ?>

                 <div class="modal">
                    <div class="alert alert-fail">
                        <span class="close_alart">×</span>
                        <p>
                            عملیات ناموفق بود!
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

<head>
    <link rel="stylesheet" href="assets/css/persian-datepicker.css">
</head>
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
    <div class="profile_left" style='margin-top:100px'>
            <div class="form-group">
                <label for="name">نام</label>
                <input required type="text" id="first_name" name="name" value="<?= ($action->user()) ? $action->user_get($id)->first_name : $action->marketer_get($id)->first_name?>" placeholder="فقط حروف فارسی">
            </div>
            <div class="form-group">
                <label for="lname">نام خانوادگی</label>
                <input required type="text" id="last_name" name="lname" value="<?= ($action->user()) ? $action->user_get($id)->last_name : $action->marketer_get($id)->last_name?>"  placeholder="فقط حروف فارسی">
            </div>
            <div class="form-group">
                <label for="national_code">کدملی</label>
                <input type="text" id="national_code" name="national_code" value="<?=($action->user()) ? $action->user_get($id)->national_code : $action->marketer_get($id)->national_code?>">
            </div>
            <div class="form-group">
                <label for="phone">شماره موبایل</label>
                <input type="text" id="phone" name="phone" placeholder="*******09" value="<?= ($action->user()) ? $action->user_get($id)->phone : $action->marketer_get($id)->phone?>"readonly>
            </div>
            
            <div class="form-group">
            <label for="birthday">تاریخ تولد</label>
                <input type="text" id="date_eee" name="birthday" class="form-control observer-example" autocomplete="off"
                        placeholder="تاریخ تولد"
                        value="<? 
                            if($action->user() && $action->user_get($id)->birthday != 0){
                                echo $action->time_to_shamsi($action->user_get($id)->birthday);
                            }else if($action->marketer() && $action->marketer_get($id)->birthday != 0){
                                echo $action->time_to_shamsi($action->marketer_get($id)->birthday);
                            }else {
                                echo "";
                            }
                        ?>">
            </div>

            <button name="submit" class="main_btn middle_btn " id="form_submit" >ذخیره</button>

        </form>
    </div>
</div>
<script>
$("label[for='pic']").click(function(){
    $("input[name=pic]").click();
})
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="assets/js/persian-date.js"></script>
  <script src="assets/js/persian-datepicker.js"></script>
  <script>        
        var customOptions = {
            placeholder: "تاریخ شروع"
            , twodigit: false
            , closeAfterSelect: true
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "black"
            , forceFarsiDigits: true
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        }
        
        kamaDatepicker('date_eee', customOptions);
        
        kamaDatepicker('date_start', customOptions);

        kamaDatepicker('date_start_1', customOptions);

        kamaDatepicker('date_end', customOptions);

        kamaDatepicker('date_end_1', customOptions);
    </script>