<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "marketer.php";
// main url for remove , change status
$list_url = "marketer-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->marketer_get($id);
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
    $first_name = $action->request('first_name');
    $last_name = $action->request('last_name');
    $phone = $action->request('phone');
    $package_id = $action->request('package_id');
    $national_code = $action->request('national_code');
    $payment_type  = $action->request('payment_type');
    $reference_code = $action->request('reference_code');
    $support_id = $action->request('support_id');
    $status = $action->request('status');

    if($reference_code){
        $result = $action->marketer_reference_code($reference_code);
        $reference = $result->fetch_object();
        $reference_id = $reference->id;
        $support_id = $reference_id;
    }
   
    // send query
    if ($edit) {
        $command = $action->marketer_edit($id,$first_name, $last_name,$phone, $national_code,$package_id ,$payment_type,$reference_id,$support_id,$status);
    } else {
        $command = $action->marketer_add($first_name, $last_name,$phone, $national_code,$package_id ,$payment_type,$reference_id,$support_id,$status);
        $action->marketer_log($command);
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
                <h3 class="text-primary">ثبت بازارساز</h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش بازارساز</h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">بازارسازان</a></li>
                <?php if ($edit) { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">ویرایش</a></li>
                <?php } else { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">ثبت</a></li>
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
                                    <input type="text" name="first_name" class="form-control input-default "
                                           placeholder="نام"
                                           value="<?= ($edit) ? $row->first_name : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="last_name" class="form-control input-default "
                                           placeholder="نام خانوادگی"
                                           value="<?= ($edit) ? $row->last_name : "" ?>" required>
                                </div>

                                <div class="form-group">
                                   
                                    <select class="form-control " name="support_id">
                                        <option>پشتیبان را انتخاب فرمایید .</option>
                                        <option value=13 >دانیال قاسمی</option>
                                    </select>
                                
                                </div>

                                <div class="form-group">
                                    <input type="text" name="national_code" class="form-control"
                                           placeholder="کدملی"
                                           value="<?= ($edit) ? $row->national_code : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control input-default "
                                           placeholder="تلفن همراه"
                                           value="<?= ($edit) ? $row->phone : "" ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text"  name="reference_code" class="form-control"
                                           placeholder="کد معرف"
                                           value="<?= ($edit) ? $action->marketer_get($row->reference_id)->reference_code : "" ?>" >
                                </div>

                                <div class="form-group">
                                    <select class="form-control " name="package_id" required>
                                    <option>پکیج را انتخاب فرمایید .</option>
                                        <?
                                        $option_result = $action->package_list();
                                        while ($option = $option_result->fetch_object()) {
                                            echo '<option value="';
                                            echo $option->id;
                                            echo '"';
                                            if ($option->id == $row->package_id) echo "selected";
                                            echo '>';
                                            echo $option->name;
                                            echo '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control " name="payment_type" required>
                                        <option>نحوه پرداخت را انتخاب کنید.</option>
                                        <option value=1>اعتباری</option>
                                    </select>
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

                                    <a href="<?= $list_url ?>"><span name="back" class="btn btn-inverse">بازگشت به لیست</span></a>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- ----------- end row of fields ----------------------------------------------------------- -->

            </div>
        </div>
    </div>
    <!-- ----------- end main container ------------------------------------------------------------------------ -->
</div>
<? include('footer.php'); ?>


