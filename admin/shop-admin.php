<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "shop-admin.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data ------------------------------------------------------------------------------------------------
if (isset($_GET['id'])) {
    $shop_id = $action->request('id');
    $counter = 1;
    $result = $action->shop_admin_list($shop_id);
}
// ----------- get data ------------------------------------------------------------------------------------------------

// ----------- delete --------------------------------------------------------------------------------------------------
if (isset($_GET['remove']) && isset($_GET['id'])) {
    $shop_id = $action->request('id');
    $id = $action->request('remove');
    $_SESSION['error'] = !$action->shop_admin_remove($id);
    header("Location: $main_url?id=$shop_id");
    return;
}
// ----------- delete --------------------------------------------------------------------------------------------------

// ----------- edit mode -------------------------------------------------------------------------------------------
if (isset($_GET['edit'])  && isset($_GET['id'])) {
    $shop_id = $action->request('id');
    $edit_id = $action->request('edit');
    $edit_row = $action->shop_admin_get($edit_id);

    $counter = 1;
    $result = $action->shop_admin_list($shop_id);
}
// ----------- edit mode -------------------------------------------------------------------------------------------


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
    $national_code = $action->request('national_code');
    $status = $action->request('status');
   
    // send query
    if ($edit_id) {
        $command = $action->shop_admin_edit($edit_id,$first_name,$last_name,$phone,$username,$password,$national_code,$status);
    }else{
        $command = $action->shop_admin_add($shop_id,$first_name,$last_name,$phone,$username,$password,$national_code,$status);
    }

    // check errors
    if ($command) {
        $_SESSION['error'] = 0;
    } else {
        $_SESSION['error'] = 1;
    }

    // bye bye :)
    header("Location: $main_url?id=$shop_id");

}
// ----------- add or edit ---------------------------------------------------------------------------------------------

// ----------- start html :) -------------------------------------------------------------------------------------------
include('header.php'); ?>

<div class="page-wrapper">

    <div class="row page-titles">
        <!-- ----------- start breadcrumb ---------------------------------------------------------------------- -->
        <div class="col-md-12 align-self-center text-right">
            <h3 class="text-primary">مدیران فروشگاه</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="shop-list.php">فروشگاه ها</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"> مدیران</a></li>
            </ol>
        </div>
        <!-- ----------- end breadcrumb ------------------------------------------------------------------------ -->

    </div>

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

        <!-- ----------- add button ---------------------------------------------------------------------------- -->
        <!-- ----------- add button ---------------------------------------------------------------------------- -->

        <!-- ----------- start row of table -------------------------------------------------------------------- -->
        <div class="row">
            <div class="col-lg-6">
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
                                           value="<?= ($edit_id) ? $edit_row->first_name : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="last_name" class="form-control input-default "
                                           placeholder="نام خانوادگی"
                                           value="<?= ($edit_id) ? $edit_row->last_name : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control input-default "
                                           placeholder="شماره تلفن "
                                           value="<?= ($edit_id) ? $edit_row->phone : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="username" class="form-control input-default "
                                           placeholder="نام کاربری"
                                           value="<?= ($edit_id) ? $edit_row->username : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="password" class="form-control input-default "
                                           placeholder="رمزعبور"
                                           value="<?= ($edit_id) ? $edit_row->password : "" ?>" required>
                                </div>

                                
                                <div class="form-group">
                                    <input type="text" name="national_code" class="form-control input-default "
                                           placeholder="کد ملی"
                                           value="<?= ($edit_id) ? $edit_row->national_code : "" ?>" required>
                                </div>

                                <div class="form-actions">
                                    <label class="float-right">
                                        <input type="checkbox" class="float-right m-1" name="status" value="1"
                                            <? if ($edit_id && $edit_row->status) echo "checked"; ?> >
                                        فعال
                                    </label>

                                    <button type="submit" name="submit" class="btn btn-success sweet-success">
                                        <i class="fa fa-check"></i> ثبت
                                    </button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive m-t-5">
                            <table id="example23" class="display nowrap table table-hover table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">ردیف</th>
                                    <th class="text-center">نام ونام خانوادگی</th>
                                    <th class="text-center">شماره تماس</th>
                                    <th class="text-center">مدیریت</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">

                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $row->first_name." ".$row->last_name ?></td>
                                        <td class="text-center"><?= $row->phone ?></td>
                                      
                                        <td class="text-center">
                                            <a href="<?= $main_url?>?id=<?= $shop_id?>&edit=<?= $row->id ?>">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            |
                                            <a href="<?= $main_url ?>?id=<?= $shop_id?>&remove=<?= $row->id ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>
                                <? } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ----------- end row of table ---------------------------------------------------------------------- -->

    </div>
</div>

<? include('footer.php'); ?>
