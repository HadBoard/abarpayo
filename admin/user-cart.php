<? require_once "functions/database.php";

$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "user-cart.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data ------------------------------------------------------------------------------------------------
if (isset($_GET['user_id'])) {
    $user_id = $action->request('user_id');
    $counter = 1;
    $result = $action->user_get_cart($user_id);
}
// ----------- get data ------------------------------------------------------------------------------------------------

// ----------- delete --------------------------------------------------------------------------------------------------
if (isset($_GET['remove']) && isset($_GET['user_id'])) {
    $user_id = $action->request('user_id');
    $id = $action->request('remove');
    $_SESSION['error'] = !$action->cart_remove($id);
    header("Location: $main_url?user_id=$user_id");
    return;
}
// ----------- delete --------------------------------------------------------------------------------------------------

// ----------- edit mode -------------------------------------------------------------------------------------------
if (isset($_GET['edit'])  && isset($_GET['user_id'])) {
    $user_id = $action->request('user_id');
    $edit_id = $action->request('edit');
    $edit_row = $action->cart_get($edit_id);

    $counter = 1;
    $result = $action->user_get_cart($user_id);
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
    $title = $action->request('title');
    $cart_number = $action->request('cart_number');
    $validation = $action->request('validation');

    // send query
    if ($edit_id) {
        $command = $action->cart_edit($edit_id,$user_id,$title,$cart_number,$validation);
    } else {
        $command = $action->cart_add($user_id,$title,$cart_number,$validation);
    }

    // check errors
    if ($command) {
        $_SESSION['error'] = 0;
    } else {
        $_SESSION['error'] = 1;
    }

    // bye bye :)
    header("Location: $main_url?user_id=$user_id");

}
// ----------- add or edit ---------------------------------------------------------------------------------------------

// ----------- start html :) -------------------------------------------------------------------------------------------
include('header.php'); ?>

<div class="page-wrapper">

    <div class="row page-titles">
        <!-- ----------- start breadcrumb ---------------------------------------------------------------------- -->
        <div class="col-md-12 align-self-center text-right">
            <h3 class="text-primary">کارت های کاربران</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="user-list.php">کاربران</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">کارت ها</a></li>
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
                                    <input type="text" name="title" class="form-control input-default "
                                           placeholder="عنوان"
                                           value="<?= ($edit_id) ? $edit_row->title : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="cart_number" class="form-control input-default "
                                           placeholder="شماره کارت"
                                           value="<?= ($edit_id) ? $edit_row->cart_number : "" ?>" required>
                                </div>

                                <div class="form-actions">
                                    <label class="float-right">
                                        <input type="checkbox" class="float-right m-1" name="validation" value="1"
                                            <? if ($edit_id && $edit_row->validation) echo "checked"; ?> required>
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
                                    <th class="text-center">عنوان</th>
                                    <th class="text-center">شماره کارت</th>
                                    <th class="text-center">مدیریت</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">

                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $row->title ?></td>
                                        <td class="text-center"><?= $row->cart_number ?></td>
                                      
                                        <td class="text-center">
                                            <a href="<?= $main_url?>?user_id=<?= $user_id?>&edit=<?= $row->id ?>">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            |
                                            <a href="<?= $main_url ?>?user_id=<?= $user_id?>&remove=<?= $row->id ?>">
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
