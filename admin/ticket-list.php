<? require_once "functions/database.php";

$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "ticket.php";
// main url for remove , change status
$list_url = "ticket-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data ------------------------------------------------------------------------------------------------
$counter = 1;
$solved = $action->solved_ticket_list();
$not_solved = $action->not_solved_ticket_list();
// ----------- get data ------------------------------------------------------------------------------------------------

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
            <h3 class="text-primary">تیکت ها</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">تیکت ها</a></li>
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
        <!-- ----------- start row of not solved ticket table -------------------------------------------------------------------- -->
        <div class="row">
            <div class="col-12">
                
                <div class="card">
                    <div class="card-title">
                        <div class="col-md-12 align-self-center text-right">
                            <h3 class="text-primary">تیکت های بدون پاسخ</h3>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive m-t-5">
                                <table id="example25" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">ردیف</th>
                                    <th class="text-center">کاربر</th>
                                    <th class="text-center">عنوان</th>
                                    <th class="text-center">متن</th>
                                    <th class="text-center">پاسخ</th>
                                    <th class="text-center">وضعیت</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($not_solved_row = $not_solved->fetch_object()) { ?>
                                    <tr class="text-center">

                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $action->user_get($not_solved_row->user_id)->last_name ?></td>
                                        <td class="text-center"><?= $not_solved_row->subject ?></td>
                                        <td class="text-center"><?= $not_solved_row->text ?></td>
                                        <td class="text-center"><a href="<?= $main_url?>?id=<?= $not_solved_row->id?>"><i class="fa fa-pencil-square-o"></i></a></td>
                                        <td class="text-center">
                                            <?
                                            if ($not_solved_row->admin_id) echo "<status-indicator positive pulse></status-indicator>";
                                            else echo "<status-indicator negative pulse></status-indicator>";
                                            ?>
                                        </td>
                                    </tr>
                                <? } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        <div class="col-md-12 align-self-center text-right">
                            <h3 class="text-primary">تیکت های پاسخ داده شده</h3>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive m-t-5">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">ردیف</th>
                                    <th class="text-center">پشتیبان</th>
                                    <th class="text-center">کاربر</th>
                                    <th class="text-center">عنوان</th>
                                    <th class="text-center">مشاهده</th>
                                    <th class="text-center">وضعیت</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($solved_row = $solved->fetch_object()) { ?>
                                    <tr class="text-center">

                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $action->admin_get($solved_row->admin_id)->last_name ?></td>
                                        <td class="text-center"><?= $action->user_get($solved_row->user_id)->last_name ?></td>
                                        <td class="text-center"><?= $solved_row->title ?></td>
                                        <td class="text-center"><a href="<?= $main_url?>?id=<?= $solved_row->id?>"><i class="fa fa-pencil-square-o"></i></a></td>
                                        <td class="text-center">
                                            <?
                                            if ($solved_row->admin_id) echo "<status-indicator positive pulse></status-indicator>";
                                            else echo "<status-indicator negative pulse></status-indicator>";
                                            ?>
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

        <!-- ----------- end row of not solved table ---------------------------------------------------------------------- -->

    </div>
</div>

<? include('footer.php'); ?>
