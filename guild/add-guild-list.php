<? require_once "functions/database.php";

$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "add-guild.php";
// main url for remove , change status
$list_url = "add-guild-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data ------------------------------------------------------------------------------------------------
$counter = 1;
$result = $action->add_guild_list();
// ----------- get data ------------------------------------------------------------------------------------------------

// ----------- delete --------------------------------------------------------------------------------------------------
if (isset($_GET['remove'])) {
    $id = $action->request('remove');
    $_SESSION['error'] = !$action->add_guild_remove($id);
    header("Location: $list_url");
    return;
}
// ----------- delete --------------------------------------------------------------------------------------------------
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
            <h3 class="text-primary">اصناف جدید</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">اصناف جدید</a></li>
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
            <a class="add-user mb-2" href="<?= $main_url ?>"> ثبت صنف<i class="fas fa-plus"></i></a>
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
                                    <th class="text-center"> نام صنف</th>
                                    <th class="text-center">صاحب کسب و کار</th>
                                    <th class="text-center">وضعیت</th>
                                    <th class="text-center">مدیریت</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">

                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?=$row->title?></td>
                                        <td class="text-center"><?= $row->owner?></td>
                                          <td class="text-center">
                                           
                                                <?
                                                if ($row->status) echo "<status-indicator positive pulse></status-indicator>";
                                                else echo "<status-indicator negative pulse></status-indicator>";
                                                ?>
                                          
                                        </td>

                                        <td class="text-center">
                                            <a href="<?= $main_url ?>?edit=<?= $row->id ?>">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            <?if(!$row->status){?>
                                            |
                                            <a href="<?= $list_url ?>?remove=<?= $row->id ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <?}?>
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
