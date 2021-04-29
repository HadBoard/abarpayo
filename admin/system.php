<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "system.php";
// main url for remove , change status
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------

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
    $name = $action->request('name');
    $about_us = $action->request('about_us');
    $rules = $action->request('rules');
    $phone = $action->request('phone');
    $address = $action->request('address');

    $command = $action->update_system('name',$name);
    $command1 = $action->update_system('about_us',$about_us);
    $command2 = $action->update_system('rules',$rules);
    $command3 = $action->update_system('phone',$phone);
    $command4 = $action->update_system('address',$address);

    // check errors
    if ($command && $command1 && $command2 && $command3 && $command4) {
        $_SESSION['error'] = 0;
    } else {
        $_SESSION['error'] = 1;
    }

    // bye bye :)
    header("Location: $main_url");

}
// ----------- add or edit ---------------------------------------------------------------------------------------------

// ----------- start html :) ------------------------------------------------------------------------------------------
include('header.php'); ?>

<div class="page-wrapper">

    <div class="row page-titles">

        <!-- ----------- start title --------------------------------------------------------------------------- -->
        <div class="col-md-12 align-self-center text-right">
            <h3 class="text-primary">ویرایش سیستم</h3>
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
                <li class="breadcrumb-item"><a">سیستم</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">ویرایش</a></li>
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
                <!-- ----------- end history ------------------------------------------------------------------- -->

                <!-- ----------- start row of fields ----------------------------------------------------------- -->
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="float-right" for="name">نام سیستم</label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="نام سیستم"
                                           value="<?= $action->get_system('name');?>" >
                                </div>
                                <div class="form-group">
                                    <label class="float-right" for="phone">شماره تماس</label>
                                    <input type="text" name="phone" class="form-control"
                                           placeholder="شماره تماس"
                                           value="<?= $action->get_system('phone');?>" >
                                </div>
                                <div class="form-group">
                                <label class="float-right" for="address">آدرس</label>
                                    <textarea type="text" name="address" class="form-control input-default "
                                           placeholder="آدرس"
                                           ><?= $action->get_system('address');?></textarea>
                                </div>
                                <div class="form-group">
                                <label class="float-right" for="about_us">درباره ما</label>
                                    <textarea type="text" name="about_us" class="form-control input-default "
                                           placeholder="درباره ما"
                                           ><?= $action->get_system('about_us');?></textarea>
                                </div>
                                
                                <div class="form-group">
                                <label class="float-right" for="rules">قوانین و مقرارت</label>
                                    <textarea type="text" name="rules" class="form-control input-default "
                                           placeholder="قوانین و مقررات"
                                           ><?= $action->get_system('rules'); ?></textarea>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="submit" class="btn btn-success sweet-success">
                                        <i class="fa fa-check"></i> ثبت
                                    </button>
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

