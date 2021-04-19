<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "user.php";
// main url for remove , change status
$list_url = "user-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->user_get($id);
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
    $first_name = $action->request('first_name');
    $last_name = $action->request('last_name');
    $national_code = $action->request('national_code');
    $phone = $action->request('phone');
    $birthday = $action->request_date('birthday');
    $iban = $action->request('iban');
    $postal_code = $action->request('postal_code');
    $wallet = $action->request('wallet');
    $score = $action->request('score');
    $address = $action->request('address');
    $city_id = $action->request('city');
    $status = $action->request('status');
    $icon = ($edit ? $row->profile : "");
    
    if($_FILES["icon"]["name"]){

        $target_dir = "users/";
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
    // send query
    if ($edit) {
        $command = $action->user_edit($id, $first_name, $last_name, $national_code, $phone,$city_id,$address,$postal_code,$birthday,$icon,$score,$wallet,$iban,$status);
    } else {
        $command = $action->user_add($first_name, $last_name, $national_code, $phone,$city_id,$address,$postal_code,$birthday,$icon,$score,$wallet,$iban,$status);
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
                <h3 class="text-primary">ثبت کاربر</h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش کاربر</h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">کاربران</a></li>
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
                                    <input type="text" name="first_name" class="form-control input-default "
                                           placeholder="نام"
                                           value="<?= ($edit) ? $row->first_name : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="last_name" class="form-control input-default "
                                           placeholder="نام خانوادگی"
                                           value="<?= ($edit) ? $row->last_name : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="national_code" class="form-control"
                                           placeholder="کدملی"
                                           value="<?= ($edit) ? $row->national_code : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control input-default "
                                           placeholder="تلفن همراه"
                                           value="<?= ($edit) ? $row->phone : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" id="date" name="birthday" class="form-control"
                                           placeholder="تاریخ تولد"
                                           value="<?= ($edit) ? $action->time_to_shamsi($row->birthday) : "" ?>"
                                           required>
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
                                    <input type="text"  name="postal_code" class="form-control"
                                           placeholder="کد پستی "
                                           value="<?= ($edit) ? $row->postal_code : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text"  name="iban" class="form-control"
                                           placeholder="شماره شبا"
                                           value="<?= ($edit) ? $row->iban : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text"  name="wallet" class="form-control"
                                           placeholder="کیف پول"
                                           value="<?= ($edit) ? $row->wallet : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text"  name="reference_code" class="form-control"
                                           placeholder="کد رفرنس"
                                           value="<?= ($edit) ? $row->reference_code : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text"  name="score" class="form-control"
                                           placeholder="امتیاز"
                                           value="<?= ($edit) ? $row->score : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" name="address" class="form-control input-default "
                                           placeholder="آدرس" required
                                            ><?= ($edit) ? $row->address : "" ?></textarea>
                                </div>
                                <div>
                                        <label for="icon" class="btn btn-dark btn-block m-0">انتخاب عکس پروفایل </label>
                                        <input type="file" name="icon" id="icon" style="visibility:hidden;">
                                </div>

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
            <? if($edit && $row->profile) { ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <img src="users/<?= $row->profile ?>">
                        </div>
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
<? include('footer.php'); ?>

