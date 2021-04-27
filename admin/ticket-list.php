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
if(isset($_GET['solved'])){
    $result = $action->solved_ticket_list();
    $solved = 1;
}
else if(isset($_GET['not-solved'])){
    $result = $action->not_solved_ticket_list();
    $not_solved = 1;

}
else if(isset($_GET['in-queue'])){
    $result = $action->in_queue_ticket_list();
    $in_queue = 1;
}
else if(isset($_GET['solving'])){
    $result = $action->solving_ticket_list();
    $solving = 1;
}else{
    header("Location: $list_url?solved");
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
            <a class="add-user mb-2<?= $solved ?'active_ticket_button' : '';?>" href="<?= $list_url ?>?solved">پاسخ داده شده</a>
            <a class="add-user mb-2<?= $not_solved ? 'active_ticket_button' : '';?>" href="<?= $list_url ?>?not-solved">پاسخ داده نشده</a>
            <a class="add-user mb-2<?= $in_queue ? 'active_ticket_button' : '' ;?>" href="<?= $list_url ?>?in-queue">در صف بررسی</a>
            <a class="add-user mb-2<?= $solving ? 'active_ticket_button' : '';?>" href="<?= $list_url ?>?solving">در حال بررسی</a>
        </div>
        
        <div class="row">
            <div class="col-12">            
                <div class="card">
                    <div class="card-title">
                        <div class="col-md-12 align-self-center text-right">
                            <h3 class="text-primary">
                            <?if($solved) echo "تیکت های پاسخ داده شده";?>
                            <?if($solving) echo "تیکت های در حال بررسی";?>
                            <?if($in_queue) echo "تیکت های در صف بررسی";?>
                            <?if($not_solved) echo "تیکت های پاسخ داده نشده";?>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive m-t-5">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">ردیف</th>
                                    <?if($solved){?>
                                        <th class="text-center">پشتیبان</th>
                                    <?}?>
                                    <th class="text-center">کاربر</th>
                                    <th class="text-center">عنوان</th>
                                    <th class="text-center">تاریخ ثبت</th>
                                    <th class="text-center">مشاهده</th>
                                    <th class="text-center">وضعیت</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">
                                        <td class="text-center"><?= $counter++ ?></td>
                                        <?if($solved){?>
                                        <td class="text-center"><?= $action->admin_get($row->admin_id)->last_name ?></td>
                                        <?}?>
                                        <td class="text-center"><?= $action->user_get($row->user_id)->first_name." ".$action->user_get($row->user_id)->last_name ?></td>
                                        <td class="text-center"><?= $row->subject ?></td>
                                        <td class="text-center"><?= $action->time_to_shamsi($row->created_at) ?></td>
                                        <td class="text-center"><a href="<?= $main_url?>?id=<?= $row->id?>"><i class="fa fa-pencil-square-o"></i></a></td>
                                        <td class="text-center">
                                            <select class="form-control" name="status" id="<?= $row->id ?>" onchange="setStatus(<?= $row->id ?>)">
                                                <option <? if($row->status == 0) echo 'selected="selected"'; ?>  value="0">پاسخ داده نشده</option>
                                                <option <? if($row->status == 1) echo 'selected="selected"'; ?>  value="1">در صف بررسی</option>
                                                <option <? if($row->status == 2) echo 'selected="selected"'; ?>  value="2">در حال بررسی</option>
                                                <option <? if($row->status == 3) echo 'selected="selected"'; ?>  value="3">پاسخ داده شده</option>
                                            </select>
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
<script>
    function setStatus(id){
        var status=document.getElementById(id).value;
        $.ajax({
            url: "ajax/set_status.php",
            method:"POST",
            data:{
                id,status
            },
            success: function(data){
              window.location.reload();
            }
        });
    }
</script>

<? include('footer.php'); ?>
