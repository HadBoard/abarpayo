<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "question.php";
// main url for remove , change status
$list_url = "question-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->question_get($id);
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
    $package = $action->request('package');
    $question = $action->request('question');
    $option1 = $action->request('option1');
    $option2 = $action->request('option2');
    $option3 = $action->request('option3');
    $option4 = $action->request('option4');
    $correct_answer = $action->request('correct_answer');
    $status = $action->request('status');
    // send query
    if ($edit) {
        $command = $action->question_edit($id,$package,$question,$option1,$option2,$option3,$option4,$correct_answer,$status);
    } else {
        $command = $action->question_add($package,$question,$option1,$option2,$option3,$option4,$correct_answer,$status);
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
                <h3 class="text-primary">ثبت سوال</h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش سوال </h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>?package=<?= $row->package_id ?>">پکیج سوالات  </a></li>
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
                               <select class="form-control" name="package" required>
                                        <option> پکیج سوالات را انتخاب فرمایید .</option>
                                        <?
                                        $option_result = $action->question_package_list();
                                        while ($option = $option_result->fetch_object()) {
                                            echo '<option value="';
                                            echo $option->id;
                                            echo '"';
                                            if ($option->id == $row->package_id) echo "selected";
                                            echo '>';
                                            echo $option->title;
                                            echo '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea type="text" name="question" class="form-control input-default "
                                           placeholder="عنوان سوال" required><?= ($edit) ? $row->question : "" ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="option1" class="form-control input-default "
                                           placeholder="گزینه اول"
                                           value="<?= ($edit) ? $row->option1 : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="option2" class="form-control input-default "
                                           placeholder="گزینه دوم"
                                           value="<?= ($edit) ? $row->option2 : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="option3" class="form-control input-default "
                                           placeholder="گزینه سوم"
                                           value="<?= ($edit) ? $row->option3 : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="option4" class="form-control input-default "
                                           placeholder="گزینه چهارم"
                                           value="<?= ($edit) ? $row->option4 : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="correct_answer" class="form-control input-default "
                                           placeholder="گزینه درست"
                                           value="<?= ($edit) ? $row->correct_answer : "" ?>" required>
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

                                    <a href="<?= $list_url ?>?package=<?= $row->package_id ?>"><span name="back"
                                                                     class="btn btn-inverse">بازگشت به لیست</span></a>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- ----------- end row of fields ----------------------------------------------------------- -->
            </div>  
    </div>
    <!-- ----------- end main container ------------------------------------------------------------------------ -->

</div>
<? include('footer.php'); ?>

