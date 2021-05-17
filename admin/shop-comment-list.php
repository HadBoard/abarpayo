<? require_once "functions/database.php";

$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
// main url for remove , change status
$list_url = "shop-comment-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data ------------------------------------------------------------------------------------------------
$counter = 1;
if (isset($_GET['shop'])) {
    $shop_id = $action->request('shop');
    $result = $action->shop_comment_list($shop_id);
}
// ----------- get data ------------------------------------------------------------------------------------------------

// ----------- delete --------------------------------------------------------------------------------------------------
// if (isset($_GET['remove']) && isset($_GET['shop'])) {
//     $remove_id = $action->request('remove');
//     $shop_id = $action->request('shop');
//     $_SESSION['error'] = !$action->shop_comment_remove($remove_id);
//     header("Location: $list_url?shop=$shop_id");
//     return;
// }

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
            <h3 class="text-primary">نظرات فروشگاه ها</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="shop-list.php">فروشگاه ها</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">نظرات</a></li>
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
        <!-- ----------- add button ---------------------------------------------------------------------------- -->

        <!-- ----------- start row of table -------------------------------------------------------------------- -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive m-t-5">
                            <table id="example23" class="display nowrap table table-hover table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">ردیف</th>
                                    <th class="text-center">کاربر</th>
                                    <th class="text-center">فروشگاه</th>
                                    <th class="text-center">توضیحات</th>
                                    <th class="text-center">امتیاز</th>
                                    <th class="text-center">تاریخ ثبت</th>
                                    <th class="text-center">تایید</th>
                                    <!-- <th class="text-center">مدیریت</th> -->
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">

                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $action->user_get($row->user_id)->first_name."  ".$action->user_get($row->user_id)->last_name ?></td>
                                        <td class="text-center"><?= $action->shop_get($row->shop_id)->title ?></td>
                                        <td class="text-center"><?= $row->text ?></td>
                                        <td class="text-center"><?= $row->score ?></td>
                                        <td class="text-center"><?= $action->time_to_shamsi($row->created_at) ?></td>
                                        <td class="text-center">
                                            <?=
                                            ($row->confirm) ? "<status-indicator positive pulse></status-indicator>" 
                                             : "<status-indicator negative pulse></status-indicator>";
                                            ?>
                                        </td>
                                        <!-- <td>
                                            <a href="<?= $list_url ?>?shop=<?= $row->shop_id?>&remove=<?= $row->id ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td> -->

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
