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

// ----------- get data ------------------------------------------------------------------------------------------------
$counter = 1;
if(isset($_GET['package'])){
    $id = $action->request('package');
    $result = $action->question_list($id);
}   

// ----------- get data ------------------------------------------------------------------------------------------------

// ----------- delete --------------------------------------------------------------------------------------------------
if (isset($_GET['remove'])) {
    $id = $action->request('remove');
    $_SESSION['error'] = !$action->question_remove($id);
    header("Location: $list_url");
    return;
}
// ----------- delete --------------------------------------------------------------------------------------------------

// ----------- change status -------------------------------------------------------------------------------------------
if (isset($_GET['status'])) {
    $id = $action->request('status');
    $_SESSION['error'] = !$action->question_status($id);
    header("Location: $list_url");
    return;
}
// ----------- change status -------------------------------------------------------------------------------------------

// ----------- check error ---------------------------------------------------------------------------------------------
$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}
// ----------- check error ---------------------------------------------------------------------------------------------

// ----------- start html :) -------------------------------------------------------------------------------------------
include('header.php'); ?>

<div class="page-wrapper">

    <div class="row page-titles">
        <!-- ----------- start breadcrumb ---------------------------------------------------------------------- -->
        <div class="col-md-12 align-self-center text-right">
            <h3 class="text-primary"> سوالات</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"> سوالات</a></li>
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
        <div class="row">
            <a class="add-user mb-2" href="<?= $main_url ?>"> ثبت  سوالات  <i class="fas fa-plus"></i></a>
            <a class="float-left add-user mb-2" href="question-package.php?edit=<?= $id?>">بازگشت به پکیج </a>
        </div>
        <!-- ----------- add button ---------------------------------------------------------------------------- -->

        <!-- ----------- start row of table -------------------------------------------------------------------- -->
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive m-t-5">
                            <table id="example23" class="display nowrap table table-hover table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">ردیف</th>
                                    <th class="text-center"> پکیج</th>
                                    <th class="text-center">عنوان سوال</th>
                                    <th class="text-center">وضعیت</th>
                                    <th class="text-center">مدیریت</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">

                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $action->question_package_get($id)->title ?></td>
                                        <td class="text-center"><?= $row->question ?></td>
                                        <td class="text-center">
                                            <a href="<?= $list_url ?>?status=<?= $row->id ?>">
                                                <?
                                                if ($row->status) echo "<status-indicator positive pulse></status-indicator>";
                                                else echo "<status-indicator negative pulse></status-indicator>";
                                                ?>
                                            </a>
                                        </td>

                                        <td class="text-center">
                                            <a href="<?= $main_url ?>?edit=<?= $row->id ?>">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            |
                                            <a href="<?= $list_url ?>?remove=<?= $row->id ?>">
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
