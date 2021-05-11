<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "wallet.php";
$list_url="wallet-log.php";
// ----------- urls ----------------------------------------------------------------------------------------------------
// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->guild_request_get($id);
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
    
    $cart_id= $action->request('cart_id');
    $amount=$action->request('amount');
    // send query
    $command = $action->request_add($cart_id,$amount);
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
           
                <h3 class="text-primary">کیف پول</h3>
           
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">صندوق</a></li>
              
                    <li class="breadcrumb-item"><a href="javascript:void(0)">کیف پول</a></li>
               
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
               
                    <div class="row m-b-0">
                        <div class="col-lg-6">
                            <p class="text-right m-b-0">
                               موجودی کیف پول شما:
                                <?=$action->guild()->wallet?$action->guild()->wallet:0; ?>
                            </p>
                        </div>
                    </div>
               
                <!-- ----------- end history ------------------------------------------------------------------- -->

                <!-- ----------- start row of fields ----------------------------------------------------------- -->
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <select class="form-control" name="cart_id" required>
                                        <option>کارت را انتخاب فرمایید .</option>
                                        <?
                                        $option_result = $action->guild_cart_list();
                                        while ($option = $option_result->fetch_object()) {
                                            echo '<option value="';
                                            echo $option->id;
                                            echo '"';
                                            if ($option->id == $row->cart_id) echo "selected";
                                            echo '>';
                                            echo $option->title."|".$option->cart_number;
                                            echo '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <input type="text" name="amount" class="form-control input-default "
                                           placeholder="مبلغ در خواستی" value="<?=$row->amount?$row->amount:''?>" required>
                                </div>

                                <div class="form-actions">

                                    <button type="submit" name="submit" class="btn btn-success sweet-success">
                                        <i class="fa fa-check"></i> ثبت
                                    </button>

                                    <a href="<?= $list_url?>"><span name="back" class="btn btn-inverse">بازگشت</span></a>

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

<? include('footer.php'); ?>
// ----------- end html :) ---------------------------------------------------------------------------------------------

