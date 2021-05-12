<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "shop-ticket.php";
// main url for remove , change status
$list_url = "shop-ticket-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['id'])) {
    //$edit = true;
    $id = $action->request('id');
    $row = $action->shop_ticket_get($id);
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
    $solve = $action->request('solve');
    // send query
    $admin_id = $_SESSION['admin_id'];
    if($row->status == 3){
        $command = $action->shop_ticket_edit($id,$admin_id,$solve);
    }else{
        $command = $action->shop_ticket_solve($id,$admin_id,$solve);
    }
    
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
                <h3 class="text-primary">تیکت</h3>
            <?php } else { ?>
                <h3 class="text-primary">تیکت</h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">تیکت ها</a></li>
                <?php if ($row->status != 3) { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">ثبت</a></li>
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
                <!-- ----------- start history ----------------------------------------------------------------- -->
                <!-- ----------- end history ------------------------------------------------------------------- -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <h3 class="text-primary text-right">فروشگاه : </h3>
                                <p class="text-right">
                                    <a href="user.php?edit=<?= $row->user_id ?>"><i class="fas fa-plus"></i></a>
                                    <?= $action->shop_get($row->shop_id)->title?>
                                </p>
                            </div>

                            <div class="form-group">
                                <h3 class="text-primary text-right">تاریخ ایجاد : </h3>
                                <p class="text-right"><?= $action->time_to_shamsi($row->created_at) ?></p>
                            </div>

                            <div class="form-group">
                                <h3 class="text-primary text-right">عنوان : </h3>
                                <p class="text-right"><?= $row->subject ?></p>
                            </div>

                            <div class="form-group">
                                <h3 class="text-primary text-right">متن تیکت : </h3>
                                <p class="text-right"><?= $row->text ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <? if($row->status == 3){ ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group">
                                    <h3 class="text-primary text-right">پشتیبان : </h3>
                                    <p class="text-right"><?= $action->admin_get($row->admin_id)->last_name ?></p>
                                </div>

                                <div class="form-group">
                                    <h3 class="text-primary text-right">تاریخ پاسخ : </h3>
                                    <p class="text-right"><?= $action->time_to_shamsi($row->solved_at) ?></p>
                                </div>

                                <div class="form-group">
                                    <h3 class="text-primary text-right">پاسخ تیکت : </h3>
                                    <div  class="d-flex flex-row"><?= $row->solve ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <? }else{ ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-primary text-right">پاسخ تیکت : </h3>

                                <div class="basic-form">

                                    <form action="" method="post">

                                        <div class="form-group">
                                        <textarea type="text" name="solve" class="form-control input-default "
                                        required><?= $row->solve ?></textarea>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" name="submit" class="btn btn-success sweet-success">
                                            <i class="fa fa-check"></i>ثبت
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <? }?>
            
        </div>
    </div>
    <!-- ----------- end main container ------------------------------------------------------------------------ -->

</div>
<? include('footer.php'); ?>
// ----------- end html :) ---------------------------------------------------------------------------------------------

