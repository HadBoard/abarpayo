<?  $id = $_SESSION['user_id'];
    $row = $action->user_get($id);
    $province_id = $action->city_get($row->city_id)->province_id;
    
    if(isset($_POST['submit'])){
        $city_id = $action->request('city');
        $command = $action->user_city_edit($city_id);
        if($command){

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
        <select name="province" id="province" required>
            <option>استان را انتخاب فرمایید .</option>
            <?
            $option_result = $action->province_list();
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
        <select name="city" id="city" required>
            <option>شهرستان را انتخاب فرمایید .</option>
            <?
            $option_result =  $action->province_city_list($province_id);
            while ($option = $option_result->fetch_object()) {
                echo '<option value="';
                echo $option->id;
                echo '"';
                if ($option->id == $row->city_id) echo "selected";
                echo '>';
                echo $option->name;
                echo '</option>';
            }
            ?>
        </select>
        </div>
        <input name="submit" type="submit" class="main_btn middle_btn " value="ادامه">            
    </form>
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
