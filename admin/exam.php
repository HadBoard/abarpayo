<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "exam.php";
// main url for remove , change status
$list_url = "exam-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->exam_get($id);
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
    $title = $action->request('title');
    $status = $action->request('status');
    $start_date=$action->request($_POST['start_date']);
    $start_time=$action->request($_POST['start_time']);
    $start_date=$action->shamsi_to_miladi($start_date);
    $start_date=$start_date.' '.$start_time;
    $start_date=strtotime($start_date);
    $end_date=$action->request($_POST['end_date']);
    $end_time=$action->request($_POST['end_time']);
    $end_date=$action->shamsi_to_miladi($end_date);
    $end_date=$end_date.' '.$end_time;
    $end_date=strtotime($end_date);
    $package_id=$action->request('package_id');
    $question_pack_id=$action->request('question_pack_id');
    // send query
    if ($edit) {
        $command = $action-> exam_edit($id,$title,$package_id,$question_pack_id,$start_date,$end_date,$status);
    } else {
        $command = $action-> exam_add($title,$package_id,$question_pack_id,$start_date,$end_date,$status);
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
                <h3 class="text-primary">ثبت آزمون</h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش آزمون</h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">آزمون</a></li>
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
                                           value="<?= ($edit) ? $row->title : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="package_id" required>
                                        <option>سطح دسترسی  را انتخاب فرمایید .</option>
                                        <?
                                        $option_result = $action->package_list();
                                        while ($option = $option_result->fetch_object()) {
                                            echo '<option value="';
                                            echo $option->id;
                                            echo '"';
                                            if ($option->id == $row->package_id) echo "selected";
                                            echo '>';
                                            echo $option->name;
                                            echo '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="question_pack_id" required>
                                        <option>پکیج سوالات  را انتخاب فرمایید .</option>
                                        <?
                                        // $option_result = $action->question_package_list();
                                        $option_result = $action->package_list();
                                        while ($option = $option_result->fetch_object()) {
                                            echo '<option value="';
                                            echo $option->id;
                                            echo '"';
                                            if ($option->id == $row->question_pack_id) echo "selected";
                                            echo '>';
                                            echo $option->title;
                                            echo '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="start_date" id="date_start" class="form-control input-default "
                                           placeholder="تاریخ شروع"
                                           value="<?= ($edit) ? $action->time_to_shamsi($row->start_time): "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="start_time" id="date_start" class="form-control input-default "
                                           placeholder="ساعت شروع"
                                           value="<?= ($edit) ? date("H:i:s",$row->start_date): "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="end_date" id="date_start" class="form-control input-default "
                                           placeholder="تاریخ پایان"
                                           value="<?= ($edit) ? $action->time_to_shamsi($row->end_time): "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="end_time" id="date_start" class="form-control input-default "
                                           placeholder="ساعت پایان"
                                           value="<?= ($edit) ? date("H:i:s",$row->end_date): "" ?>" required>
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
        </div>
    </div>
    <!-- ----------- end main container ------------------------------------------------------------------------ -->

</div>
<? include('footer.php'); ?>
// ----------- end html :) ---------------------------------------------------------------------------------------------

