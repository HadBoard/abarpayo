<?  


    if($action->user()){
        $city =  $action->user_get($id)->city_id;
    }else if($action->marketer()){
        $city =  $action->marketer_get($id)->city_id;
    }
    $province = $action->city_get($city)->province_id;

$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}
    
    if(isset($_POST['submit'])){
        $city_id = $action->request('city');
        $postal_code = $action->request('postal_code');
        $address = $action->request('address');

        if($action->user()){
            $command = $action->user_address_edit($city_id,$postal_code,$address);
        }else if($action->marketer()){
            $command = $action->marketer_address_edit($id,$city_id,$postal_code,$address);
        }

        if ($command) {
            $_SESSION['error'] = 0;
        } else {
            $_SESSION['error'] = 1;
        }

        echo '<script>window.location="?address"</script>';
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

<div class="edit_profile_div">
    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img_2"><img style="margin-top:-17px" src="assets/images/002-place.svg"></div></div>

    </div>
    <div class="row profile_title">
        <h3>انتخاب شهر</h3>
        <img  src="assets/images/Group 462.svg">
    </div>
    <div class="profile_left mp">

   <form action="" method="post">
        <h3>انتخاب شهر و استان</h3>
        <div class="col-md-10  city_header city_pro ">
        <select name="province" id="province">
            <option>استان را انتخاب فرمایید .</option>
            <?
            $option_result =  $action->province_list();
            while ($option = $option_result->fetch_object()) {
                echo '<option value="';
                echo $option->id;
                echo '"';
                if ($option->id == $province) echo "selected";
                echo '>';
                echo $option->name;
                echo '</option>';
            }
            ?>
        </select>
        </div>
        <div class="col-md-10 city_header city_pro">
            <select name="city" id="city">
                <option>شهرستان را انتخاب فرمایید .</option>
                <?
                $option_result =  $action->province_city_list($province);
                while ($option = $option_result->fetch_object()) {
                    echo '<option value="';
                    echo $option->id;
                    echo '"';
                    if ($option->id == $city) echo "selected";
                    echo '>';
                    echo $option->name;
                    echo '</option>';
                }
                ?>
            </select>
        </div>
        <div  class="form-group">
                <label for="postal_code">کدپستی</label>
                <input type="text" id="postal_code" name="postal_code" placeholder=""  value="<?= ($action->user()) ? $action->user_get($id)->postal_code : $action->marketer_get($id)->postal_code ?>">
        </div>
        <div class="form-group">
            <textarea type="text" name="address" class="form-control"
                    placeholder="آدرس"
                    ><?= ($action->user()) ? $action->user_get($id)->address : $action->marketer_get($id)->address  ?></textarea>
        </div>
        <input name="submit" type="submit" class="main_btn middle_btn " value="ذخیره">            
    </form>
</div>
</div>
<script>
 document.getElementById('province').onchange=function(){
       var province_id=document.getElementById('province').value;
       console.log(province_id);
       $.ajax({
            url:'admin/ajax/get_city.php',
            type:'post',
            data:{province_id:province_id},
            success:function(response){
        		$("#city").html(response);
            }
       })
   }
</script>
