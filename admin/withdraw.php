<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "withdraw.php";
// main url for remove , change status
$list_url = "withdraw-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->request_get($id);
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
$user_id  = $row->user_id;
$amount = $row->amount;
if (isset($_POST['submit'])) {

    $prev_wallet = $action->user_get($user_id)->wallet;
    $wallet = floatval($prev_wallet) - floatval($amount);
    // get fields
    $description = $action->request('description');
    $birthday = $action->request_date('birthday');
 
    // send query
    if ($edit) {
        $command = $action->request_edit($id, $description,$birthday);
        $command1 = $action->wallet_withdraw($user_id,$wallet);
        $command2 = $action->wallet_log_add($user_id,"برداشت از حساب",$amount,0,0);
    } else {
        // $command = $action->withdraw_add($description,$paymented_at,$status);
    }

    // check errors
    if ($command && $command1 && $command2) {
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
                <h3 class="text-primary">تایید درخواست</h3>
            <?php } else { ?>
                <h3 class="text-primary">تایید درخواست</h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">درخواست </a></li>
                <?php if ($edit) { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">تایید</a></li>
                <?php } else { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">تایید</a></li>
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
                                    <input type="text"  class="form-control input-default "
                                            readonly
                                           value="<?= ($edit) ? $action->user_get($row->user_id)->last_name : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control input-default "
                                           value="<?= ($edit) ? $row->amount : "" ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control input-default " readonly
                                           value="<?= ($edit) ? $action->cart_get($row->cart_id)->cart_number : "" ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <textarea type="text" name="description" class="form-control input-default "
                                           placeholder="توضیحات" <?= ($row->status) ? "readonly" : ""?>
                                            ><?= ($edit) ? $row->description : "" ?></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="text" id="date" name="birthday" class="form-control"
                                           placeholder="تاریخ واریز" value="<?= ($row->paymented_at) ? $action->time_to_shamsi($row->paymented_at) : ""?>"
                                           <?= ($row->status) ? "readonly" : ""?> required>
                                </div>

                                <div class="form-actions">

                                    <!-- <label class="float-right">
                                        <input type="checkbox" class="float-right m-1" name="status" value="1"
                                            <? //if ($edit && $row->status) echo "checked"; ?> >
                                        فعال
                                    </label> -->

                                    <button <?= ($row->status) ? "disabled" : ""?> type="submit" name="submit" class="btn btn-success sweet-success">
                                        <i class="fa fa-check"></i> ثبت
                                    </button>

                                    <a href="<?= $list_url ?>"><span name="back"class="btn btn-inverse">بازگشت به لیست</span></a>

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
<? include('footer.php'); ?>

