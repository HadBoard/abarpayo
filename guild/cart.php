<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "cart.php";
// main url for remove , change status
$list_url = "cart-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->cart_get($id);
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
    
    $bank_id = $action->request('bank_id');
    $title = $action->request('title');
    $cart_number = $action->request('cart_number');
    $iban = $action->request('iban');
    $account_number = $action->request('account_number');
    // if(!$action->bankCardCheck($cart_number) || !$action->shaba($iban) || strlen($account_number)!=13){
    //     $_SESSION['error'] = 1;
    // }else
    // send query
    if ($edit) {
        $command = $action->cart_edit($id,$bank_id,$title,$cart_number,$account_number,$iban,$validation);
    } else {
        $command = $action->cart_add($bank_id,$title,$cart_number,$account_number,$iban,$validation);
    }
// }

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
                <h3 class="text-primary">ثبت کارت</h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش  کارت</h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">کارت ها</a></li>
                <?php if ($edit) { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">ثبت</a></li>
                <?php } else { ?>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">ویرایش</a></li>
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
                                    <select class="form-control" name="bank_id" required>
                                        <option>بانک را انتخاب فرمایید .</option>
                                        <?
                                        $option_result = $action->bank_list();
                                        while ($option = $option_result->fetch_object()) {
                                            echo '<option value="';
                                            echo $option->id;
                                            echo '"';
                                            if ($option->id == $row->bank_id) echo "selected";
                                            echo '>';
                                            echo $option->name;
                                            echo '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control input-default "
                                           placeholder="نام دارنده کارت"
                                           value="<?= ($edit) ? $row->title : "" ?>" required>
                                </div>

                                <div class="form-group">
                                         <input type="text" name="account_number" class="form-control input-default "
                                           placeholder="شماره حساب"
                                           value="<?= ($edit) ? $row->account_number : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="cart_number" class="form-control input-default "
                                           placeholder="شماره کارت"
                                           value="<?= ($edit) ? $row->cart_number : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="iban" class="form-control input-default "
                                           placeholder="شماره شبا"
                                           value="<?= ($edit) ? $row->iban : "" ?>" >
                                </div>

                                
                                <div class="form-actions">

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
// ----------- end html :) ---------------------------------------------------------------------------------------------

