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
$result = $action->ticket_list();
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
            <h3 class="text-primary">محصولات</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">پشتیبانی</a></li>
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
            <a class="add-user mb-2" href="<?= $main_url ?>"> ثبت تیکت <i class="fas fa-plus"></i></a>
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
                                    <th class="text-center">عنوان</th>
                                    <th class="text-center">متن</th>                               
                                    <th class="text-center">وضعیت</th>
                                   
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <?if(mysqli_num_rows($result))
                                 while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">

                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $row->subject ?></td>
                                        <td class="text-center"><?= $row->text?></td>
                                        <td class="text-center">
                                              <?
                                                if ($row->status) echo "<status-indicator positive pulse></status-indicator>";
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
        <!-- ----------- end row of table ---------------------------------------------------------------------- -->
    </div>
</div>

<? include('footer.php'); ?>
