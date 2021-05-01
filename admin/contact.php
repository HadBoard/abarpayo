<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "contact.php";
// main url for remove , change status
$list_url = "contact-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
if (isset($_GET['id'])) {
    //$edit = true;
    $id = $action->request('id');
    $row = $action->contact_get($id);
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
   $command = $action->contact_status($id,$status);
    
    // check errors
    if ($command) {
        $_SESSION['error'] = 0;
    } else {
        $_SESSION['error'] = 1;
    }

    // bye bye :)
    header("Location: $main_url?id=$command");

}
// ----------- add or edit ---------------------------------------------------------------------------------------------

// ----------- start html :) ------------------------------------------------------------------------------------------
include('header.php'); ?>

<div class="page-wrapper">

    <div class="row page-titles">

        <!-- ----------- start title --------------------------------------------------------------------------- -->
        <div class="col-md-12 align-self-center text-right">
            <?php if (!isset($_GET['action'])) { ?>
                <h3 class="text-primary">تماس</h3>
            <?php } else { ?>
                <h3 class="text-primary">تماس</h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">تماس ها</a></li>
                <?php if ($row->status != 3) { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">جزئیات</a></li>
                <?php } else { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">جزئیات</a></li>
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
                           value="<?= $row->fullname ?>" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control input-default "
                           value="<?= $row->phone ?>" readonly>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control input-default " readonly
                           value="<?= $row->title ?>" readonly>
                </div>

                <div class="form-group">
                    <textarea type="text" name="description" class="form-control input-default "
                           placeholder="توضیحات" readonly
                            ><?=  $row->description ?></textarea>
                </div>

                <div class="form-actions">

                    <label class="float-right">
                        <input type="checkbox" class="float-right m-1" name="status" value="0"
                            <? if ($row->status == 0) echo "checked"; ?> >
                        بایگانی
                    </label>

                    <button type="submit" name="submit" class="btn btn-success sweet-success">
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
// ----------- end html :) ---------------------------------------------------------------------------------------------

