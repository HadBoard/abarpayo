<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// check admin access
if (!$action->admin()->access) {
    echo "<script type='text/javascript'>window.location.href = 'panel.php';</script>";
    return 0;
}

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "admin.php";
// main url for remove , change status
$list_url = "admin-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->admin_get($id);
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
    $phone = $action->request('phone');
    $username = $action->request('username');
    $password = $action->request('password');
    $access = 0;
    $status = $action->request('status');
    if($edit){

        $perms = $_POST['perms'];

        if(!empty($perms)){
            
            for ($i = 1 ; $i < 15 ; $i++) {
                $key = array_search($i, $perms);
                if ($key > -1) {
                    if(!$action->admin_check_per($id,$i))
                        $action -> admin_per_add($id,$i);
                } else {
                    $action -> admin_per_remove($id,$i);
                }
            }
        }
    }

    // send query
    if ($edit) {
        $command = $action->admin_edit($id, $first_name, $last_name, $phone, $username, $password, $status, $access);
    } else {
        $command = $action->admin_add($first_name, $last_name, $phone, $username, $password, $status, $access);
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
                <h3 class="text-primary">ثبت مدیر</h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش مدیر</h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">مدیران</a></li>
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
                                    <input type="text" name="phone" class="form-control input-default "
                                           placeholder="تلفن همراه"
                                           value="<?= ($edit) ? $row->phone : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="username" class="form-control input-default "
                                           placeholder="نام کاربری"
                                           value="<?= ($edit) ? $row->username : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="password" class="form-control input-default "
                                           placeholder="رمز عبور"
                                           value="<?= ($edit) ? $row->password : "" ?>" required>
                                </div>
                                <div class="form-group text-right" id="per_div">
                                <?if($edit){?>
                                <div class="form-group">
                                    <label for="perms">انتخاب سطح دسترسی</label>
                                    <!-- <input style="margin: 6px 8px 13px 0px;" type="checkbox"  >انتخاب همه -->
                                    <label  >
                                        <input type="checkbox" class="float-right m-1" 
                                        id="selctall">
                                          انتخاب همه
                                    </label>
                                    <select  class="form-control select2" name="perms[]" multiple="multiple" size=2 id="e1">
                                        <!-- <option>سطوح دسترسی  را انتخاب فرمایید .</option> -->
                                        <option value=1>دسته بندی ها</option>
                                        <option value=2>فروشگاه ها</option>
                                        <option value=3>محصولات</option>
                                        <option value=4>پکیج ها</option>
                                        <option value=5>آزمون ها</option>
                                        <option value=6>بازارسازان</option>
                                        <option value=7>کاربران</option>
                                        <option value=8>درخواست های برداشت</option>
                                        <option value=9>تیکت وتماس با ما</option>
                                        <option value=10>بازارسازان ویژه</option>
                                        <option value=11>لاگ سنتر</option>
                                        <option value=12>مدیریت سیستم</option>
                                        <option value=13>اسلایدرها</option>
                                        <option value=14>پرسش های پرتکرار</option>
                                    </select>
                                </div>

                                <?}?>
                                <div class="form-group" style="width:100%;float:right">
                                    <label class="float-right">
                                        <input type="checkbox" class="float-right m-1" name="status" value="1"
                                            <? if ($edit && $row->status) echo "checked"; ?> >
                                        فعال
                                    </label>
                                </div>
                                <div class="form-actions">



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
        </div>
    </div>
    <!-- ----------- end main container ------------------------------------------------------------------------ -->

</div>
<script>
$("#e1").select2();
$("#selctall").click(function(){
    if($("#selctall").is(':checked') ){
        $("#e1 > option").prop("selected","selected");
        $("#e1").trigger("change");
        console.log('check');
    }else{
        $("#e1 > option").prop("selected", false);
         $("#e1").trigger("change");
         console.log('not check');
     }
});

</script>
<? include('footer.php'); ?>