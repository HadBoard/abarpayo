<?  
    if(!$action->auth()){
        header("Location: phone.php");
    }
    $user_id = $action->user()->id;
    $province_id = $action->city_get($action->user_get($user_id)->city_id)->province_id;
    // $province_id = 2;
    
    if(isset($_POST['submit'])){
        $city_id = $action->request('city');
        $postal_code = $action->request('postal_code');
        $address = $action->request('address');
        $command = $action->user_address_edit($city_id,$postal_code,$address);
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
    }
?>
<div class="edit_profile_div">
    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img_2"><img src="assets/images/002-place.svg"></div></div>

    </div>
    <div class="row profile_title">
        <h3>انتخاب شهر</h3>
        <img src="assets/images/Group 462.svg">
    </div>
    <div class="profile_left">

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
                if ($option->id == $province_id) echo "selected";
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
                $option_result =  $action->province_city_list($province_id);
                while ($option = $option_result->fetch_object()) {
                    echo '<option value="';
                    echo $option->id;
                    echo '"';
                    if ($option->id == $action->user_get($user_id)->city_id) echo "selected";
                    echo '>';
                    echo $option->name;
                    echo '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
                <label for="postal_code">کدپستی</label>
                <input type="text" id="postal_code" name="postal_code" placeholder=""  value="<?= $action->user_get($user_id)->postal_code?>">
        </div>
        <div class="form-group">
            <textarea type="text" name="address" class="form-control"
                    placeholder="آدرس"
                    ><?= $action->user_get($user_id)->address ?></textarea>
        </div>
        <input name="submit" type="submit" class="main_btn middle_btn " value="ادامه">            
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
