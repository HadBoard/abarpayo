<? require_once "functions/database.php";

$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for remove , change status
$list_url = "admin-log-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data ------------------------------------------------------------------------------------------------
$counter = 1;
$result = $action->admin_log_list();
// ----------- get data ------------------------------------------------------------------------------------------------
// ----------- delete --------------------------------------------------------------------------------------------------
if (isset($_GET['remove'])) {
    $id = $action->request('remove');
    $_SESSION['error'] = !$action->change_admin_view($id,1);
    header("Location: $list_url");
    return;
}

// -
// ----------- check error ---------------------------------------------------------------------------------------------
$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}
// ----------- check error ---------------------------------------------------------------------------------------------

// ----------- start html :) ------------------------------------------------------------------------------------------
include('header.php'); ?>

    <div class="page-wrapper">

        <div class="row page-titles">
            <!-- ----------- start breadcrumb ---------------------------------------------------------------------- -->
            <div class="col-md-12 align-self-center text-right">
                <h3 class="text-primary">لاگ مدیران</h3></div>
            <div class="col-md-12 align-self-center text-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="panel.php">
                            <i class="fa fa-dashboard"></i>
                            خانه
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">لاگ مدیران</a></li>
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
                                        <th class="text-center">نام</th>
                                        <th class="text-center">پیام</th>
                                        <th class="text-center">تاریخ</th>
                                        <th class="text-center">مدیریت</th>
                                       
                                    </tr>
                                    </thead>

                                    <tbody class="text-center">
                                    <? 
                                    if(mysqli_num_rows($result)){
                                        while ($row = $result->fetch_object()) { ?>
                                            <tr class="text-center">

                                                <td class="text-center"><?= $counter++ ?></td>
                                                <td class="text-center"><?= $action->admin_get($row->admin_id)->first_name." ".$action->admin_get($row->admin_id)->last_name; ?></td>
                                                <td class="text-center"><?= $action->action_log_get($row->action_id)->text ?></td>
                                                <td class="text-center"><?=$action->time_to_shamsi($row->created_at)."</br>".date("H:i:s",$row->created_at) ?></td>
                                                <td class="text-center">
                                                <a href="<?= $list_url ?>?remove=<?= $row->id ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                </td>
                                            </tr>
                                    <? } }?>
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