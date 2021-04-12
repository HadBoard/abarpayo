<? require_once "functions/database.php";

$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "product-comment.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data ------------------------------------------------------------------------------------------------
if (isset($_GET['product'])) {
    $product_id = $action->request('product');
    $counter = 1;
    $result = $action->product_comment_list($product_id);
}
// ----------- get data ------------------------------------------------------------------------------------------------

// ----------- delete --------------------------------------------------------------------------------------------------
if (isset($_GET['remove']) && isset($_GET['product'])) {
    $remove_id = $action->request('remove');
    $product_id = $action->request('product');
    $_SESSION['error'] = !$action->product_comment_remove($remove_id);
    header("Location: $main_url?product=$product_id");
    return;
}
// ----------- delete --------------------------------------------------------------------------------------------------

// ----------- validate -------------------------------------------------------------------------------------------
if (isset($_GET['product']) && isset($_GET['status'])) {
    $product_id = $action->request('product');
    $counter = 1;
    $result = $action->product_comment_list($product_id);

    $id = $action->request('status');
    $old_status = $action->product_comment_get($id)->status;
    $_SESSION['error'] = !$action->product_comment_status($id,$old_status);
    header("Location: $main_url?product=$product_id");
    return;
}
// ----------- validate -------------------------------------------------------------------------------------------


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
            <h3 class="text-primary">نظرات محصولات</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="product-list.php">محصولات</a></li>
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
                                    <th class="text-center">محصول</th>
                                    <th class="text-center">توضیحات</th>
                                    <th class="text-center">امتیاز</th>
                                    <th class="text-center">تاریخ ثبت</th>
                                    <th class="text-center">تایید</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">

                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $action->user_get($row->user_id)->last_name ?></td>
                                        <td class="text-center"><?= $action->product_get($row->product_id)->title ?></td>
                                        <td class="text-center"><?= $row->text ?></td>
                                        <td class="text-center"><?= $row->score ?></td>
                                        <td class="text-center"><?= $action->time_to_shamsi($row->created_at) ?></td>
                                        <td class="text-center">
                                            <a href="<?= $main_url?>?product=<?= $row->product_id?>&status=<?= $row->id ?>">
                                                <?
                                                if ($row->status) echo "<status-indicator positive pulse></status-indicator>";
                                                else echo "<status-indicator negative pulse></status-indicator>";
                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= $main_url ?>?product=<?= $row->product_id?>&remove=<?= $row->id ?>">
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
