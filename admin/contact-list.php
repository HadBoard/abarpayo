<? require_once "functions/database.php";

$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "contact.php";
// main url for remove , change status
$list_url = "contact-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data ------------------------------------------------------------------------------------------------
$counter = 1;
if(isset($_GET['solved'])){
    $result = $action->solved_contact_list();
    $solved = 1;
}
else if(isset($_GET['not-solved'])){
    $result = $action->not_solved_contact_list();
    $not_solved = 1;
}else{
    header("Location: $list_url?not-solved");
}
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
            <h3 class="text-primary">تماس ها</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel.php">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">تماس ها</a></li>
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
            <a class="add-user mb-2<?= $solved ?'active_ticket_button' : '';?>" href="<?= $list_url ?>?solved">بایگانی</a>
            <a class="add-user mb-2<?= $not_solved ? 'active_ticket_button' : '';?>" href="<?= $list_url ?>?not-solved">بررسی نشده </a>
        </div>
        
        <div class="row">
            <div class="col-12">            
                <div class="card">
                    <div class="card-title">
                        <div class="col-md-12 align-self-center text-right">
                            <h3 class="text-primary">
                            <?if($solved) echo "تماس ها";?>
                            <?if($not_solved) echo "بایگانی";?>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive m-t-5">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">ردیف</th>
                                    <th class="text-center">کاربر</th>
                                    <th class="text-center">عنوان</th>
                                    <th class="text-center">تاریخ ثبت</th>
                                    <th class="text-center">مشاهده</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">
                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $row->fullname ?></td>
                                        <td class="text-center"><?= $row->title ?></td>
                                        <td class="text-center"><?= $action->time_to_shamsi($row->created_at) ?></td>
                                        <td class="text-center"><a href="<?= $main_url?>?id=<?= $row->id?>"><i class="fa fa-pencil-square-o"></i></a></td>
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
