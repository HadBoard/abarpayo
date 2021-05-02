<? require_once "functions/database.php";
 require_once "../const-values.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "shop-request.php";
// main url for remove , change status
$list_url = "shop-requests.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->shop_request_get($id);
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
    $status = $action->request('status');
    // send query
    if ($edit) {
        $command1 = $action->shop_request_status($id,$status);
        $icon = "";
        $command = $action->shop_add($row->category_id,$row->title,$icon,0,0,0, $row->address,0,0,$status);
    } 
    // check errors
    if ($command && $command1) {

        if($row -> access == 0){

            $user_id = $row -> user_id;
            $action->score_log_add($user_id,$guilds_score,$guilds_action,1);
            $action->score_edit($user_id,$guilds_score,1);

        }else if($row -> access == 1){

            $user_id = $row -> user_id;
            $action->marketer_score_log_add($user_id,$guilds_score,$guilds_action,1);
            $action->marketer_score_edit($user_id,$guilds_score,1);
        }
       
       $_SESSION['error'] = 0;
    } else {
       $_SESSION['error'] = 1;
    }

    // bye bye :)
   header("Location: shop.php?edit=$command");

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
                        <? if ($row->confirmed_at) { ?>
                            <div class="col-lg-6">
                                <p class="text-right m-b-0">
                                     تاریخ تایید :
                                    <?= $action->time_to_shamsi($row->confirmed_at) ?>
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
                            <form action="" method="post">

                                <div class="form-group">
                                    <input type="text"  class="form-control input-default "
                                            readonly
                                           value="<?= ($edit) ? $row->title : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control input-default "
                                           value="<?= ($edit) ? $row->owner : "" ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <input type="text"  class="form-control input-default "
                                            readonly
                                           value="<?= ($edit) ? $action->category_get($row->category_id)->title : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <textarea type="text" class="form-control input-default "
                                        readonly><?= ($edit) ? $row->address : "" ?></textarea>
                                </div>

                                <div class="form-actions">

                                    <label class="float-right">
                                        <input type="checkbox" class="float-right m-1" name="status" value="1" required
                                            <? if ($edit && $row->status){echo "checked"; echo "disabled";}?> >
                                        تایید صنف
                                    </label>

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

