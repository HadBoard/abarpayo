<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "shop.php";
// main url for remove , change status
$list_url = "shop-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->shop_get($id);
    $province_id = $action->city_get($row->city_id)->province_id;
}
// ----------- get data from database when action is edit --------------------------------------------------------------

// ----------- check error ---------------------------------------------------------------------------------------------
$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}
// ----------- check error ---------------------------------------------------------------------------------------------

// ----------- add or edit ---------------------------------------------------------------------------------------------
if (isset($_POST['submit'])) {

    // get fields
    $category_id = $action->request('category_id');
    $title = $action->request('title');
    $phone = $action->request('phone');
    $fax = $action->request('fax');
    $city_id = $action->request('city');
    $address = $action->request('address');
    $longitude = $action->request('longitude');
    $latitude = $action->request('latitude');
    $status = $action->request('status');
    $icon = ($edit ? $row->image : "");
    
    if($_FILES["icon"]["name"]){

        $target_dir = "images/shops/";
        $target_file = $target_dir . basename($_FILES["icon"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            $name = $action -> get_token(10) . "." . $imageFileType;
            // Upload file
            move_uploaded_file($_FILES['icon']['tmp_name'],$target_dir.$name);
            $icon = $name;

        } 
    }

    if($edit){
    // Count the number of uploaded files in array
    $total_count = count($_FILES['upload']['name']);
    // Loop through every file
    for( $i=0 ; $i < $total_count ; $i++ ) {
        $target_dir = "images/shops/";
        $target_file = $target_dir . basename($_FILES["upload"]["name"][$i]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            $name = $action -> get_token(10) . "." . $imageFileType;
            // Upload file
            move_uploaded_file($_FILES['upload']['tmp_name'][$i],$target_dir.$name);
            $pic = $name;
            $command1 = $action->shop_pics_add($id,$pic);
        } 
    }
}


    // send query
    if ($edit) {
        $command = $action->shop_edit($id,$category_id, $title,$icon,$phone, $fax, $city_id, $address, $longitude, $latitude, $status);
    } else {
        $command = $action->shop_add($category_id,$title,$icon, $phone, $fax, $city_id, $address, $longitude, $latitude, $status);
    }

    // check errors
    if ($command) {
        $_SESSION['error'] = 0;
    } else {
        $_SESSION['error'] = 1;
    }

    // bye bye :)
    header("Location: $main_url?edit=$command");

}
// ----------- add or edit ---------------------------------------------------------------------------------------------

// ----------- start html :) ------------------------------------------------------------------------------------------
include('header.php'); ?>

<div class="page-wrapper">

    <div class="row page-titles">

        <!-- ----------- start title --------------------------------------------------------------------------- -->
        <div class="col-md-12 align-self-center text-right">
            <?php if (!isset($_GET['action'])) { ?>
                <h3 class="text-primary">ثبت فروشگاه</h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش فروشگاه</h3>
            <?php } ?>
        </div>
        <!-- ----------- end title ----------------------------------------------------------------------------- -->

        <!-- ----------- start breadcrumb ---------------------------------------------------------------------- -->
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">فروشگاه ها</a></li>
                <?php if ($edit) { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">ثبت</a></li>
                <?php } else { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">ویرایش</a></li>
                <?php } ?>
            </ol>
        </div>
        <!-- ----------- end breadcrumb ------------------------------------------------------------------------ -->

    </div>

    <!-- ----------- start main container ---------------------------------------------------------------------- -->
    <div class="container-fluid">

        <!-- ----------- start error list ---------------------------------------------------------------------- -->
        <? if ($error) {
            if ($error_val) { ?>
                <div class="alert alert-danger">
                    عملیات ناموفق بود .
                </div>
            <? } else { ?>
                <div class="alert alert-info text-right">
                    عملیات موفق بود .
                </div>
            <? }
        } ?>
        <!-- ----------- end error list ------------------------------------------------------------------------ -->

        <div class="row">
            <div class="col-lg-6">

                <!-- ----------- start history ----------------------------------------------------------------- -->
                <? if ($edit) { ?>
                    <div class="row m-b-0">
                        <div class="col-lg-6">
                            <p class="text-right m-b-0">
                                تاریخ ثبت :
                                <?= $action->time_to_shamsi($row->created_at) ?>
                            </p>
                        </div>
                        <? if ($row->updated_at) { ?>
                            <div class="col-lg-6">
                                <p class="text-right m-b-0">
                                    آخرین ویرایش :
                                    <?= $action->time_to_shamsi($row->updated_at) ?>
                                </p>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
                <!-- ----------- end history ------------------------------------------------------------------- -->

                <!-- ----------- start row of fields ----------------------------------------------------------- -->
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                    <select class="form-control" name="category_id" required>
                                        <option>دسته بندی را انتخاب فرمایید .</option>
                                        <?
                                        $option_result = $action->category_list();
                                        while ($option = $option_result->fetch_object()) {
                                            echo '<option value="';
                                            echo $option->id;
                                            echo '"';
                                            if ($option->id == $row->category_id) echo "selected";
                                            echo '>';
                                            echo $option->title;
                                            echo '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control input-default "
                                           placeholder="عنوان"
                                           value="<?= ($edit) ? $row->title : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control input-default "
                                           placeholder="شماره تماس"
                                           value="<?= ($edit && $row->phone != 0) ? $row->phone : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="fax" class="form-control input-default "
                                           placeholder="فکس"
                                           value="<?= ($edit && $row->fax != 0 ) ? $row->fax : "" ?>">
                                </div>

                                <div class="form-group">
                                    <select class="form-control " name="province" id="province" required>
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
                                <div class="form-group">
                                   
                                    <select class="form-control " name="city" id="city" required>
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

                                <div class="form-group">
                                    <input type="text" name="address" class="form-control input-default "
                                           placeholder="آدرس"
                                           value="<?= ($edit) ? $row->address : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="longitude" class="form-control input-default "
                                           placeholder="طول جغرافیایی"
                                           value="<?= ($edit && $row->longitude !=0 ) ? $row->longitude : "" ?>"
                                           required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="latitude" class="form-control input-default "
                                           placeholder="عرض جغرافیایی"
                                           value="<?= ($edit  && $row->latitude !=0) ? $row->latitude : "" ?>"
                                           required>
                                </div>

                                <div>
                                        <label for="icon" class="btn btn-dark btn-block m-0 add-pic-btn"> انتخاب عکس اصلی</label>
                                        <input type="file" name="icon" id="icon" style="visibility:hidden;">
                                </div>
                                <?if($edit){?>
                                <div class="input_fields_wrap form-group">
                                    <h5 class="title_add">انتخاب عکس گالری فروشگاه</h5>
                                    <button class="add_field_button"><i class="fas fa-plus"></i></button>
                                    <label class="btn btn-dark btn-block m-0 add-pic-btn">انتخاب عکس
                                    <input type="file" name="upload[]" style="visibility:hidden;">
                                    </label>
                                </div>
                                <? } ?>
                                <div class="form-actions">

                                    <label class="float-right">
                                        <input type="checkbox" class="float-right m-1" name="status" value="1"
                                            <? if ($edit && $row->status) echo "checked"; ?> >
                                        فعال
                                    </label>

                                    <button type="submit" name="submit" class="btn btn-success sweet-success">
                                        <i class="fa fa-check"></i> ثبت
                                    </button>

                                    <a href="<?= $list_url ?>"><span name="back" class="btn btn-inverse">بازگشت به لیست</span></a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ----------- end row of fields ----------------------------------------------------------- -->
                
            </div>
            <? if($edit && $row->image) { ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <img src="images/shops/<?= $row->image ?>">
                        </div>
                        <?
                            $pictures = $action->shop_pics_get($id);
                            while ($picture = $pictures->fetch_object()) {
                                ?>
                                <div class="row">
                                <div class="clog-lg-3">
                                <div class="card">
                                    <img src="images/shops/<?= $picture->image ?>">
                                </div>
                                </div>
                                <div>
                                <?
                            }
                        ?>
                    </div>
            <? } ?>
        </div>
    </div>
    <!-- ----------- end main container ------------------------------------------------------------------------ -->
</div>
<script>
 document.getElementById('province').onchange=function(){
       var province_id=document.getElementById('province').value;
       console.log(province_id);
       $.ajax({
            url:'ajax/get_city.php',
            type:'post',
            data:{province_id:province_id},
            success:function(response){
        		$("#city").html(response);
            }
       })   
   }
</script>
<? if($edit){?>
<script>
$(document).ready(function() {
	var max_fields      = 5; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div style="margin-bottom: 10px;"><label class="btn btn-dark btn-block m-0 add-pic-btn">انتخاب عکس<input type="file" name="upload[]" style="visibility:hidden;"></label><a href="#" class="remove_field"><i class="fas fa-times"></i></a></div>'); //add input box
		}
	});

	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
</script>
<?}?>
<? include('footer.php'); ?>

