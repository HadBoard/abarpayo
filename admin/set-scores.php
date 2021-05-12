<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "set-scores.php";
// main url for remove , change status
// ----------- urls ----------------------------------------------------------------------------------------------------
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
    $register = $action->request('register');
    $marketer_register = $action->request('marketer_register');
    $wallet = $action->request('wallet');
    $marketer_wallet = $action->request('marketer_wallet');
    $invite = $action->request('invite');
    $marketer_invite = $action->request('marketer_invite');
    $guild_user = $action->request('guild_user');
    $guild_marketer = $action->request('guild_marketer');
    $guild_guild = $action->request('guild_guild');

    $command = $action->update_system('score_register',$register);
    $command1 = $action->update_system('score_marketer_register',$marketer_register);
    $command2 = $action->update_system('score_wallet',$wallet);
    $command3 = $action->update_system('score_marketer_wallet',$marketer_wallet);
    $command4 = $action->update_system('score_invite',$invite);
    $command5 = $action->update_system('score_marketer_invite',$marketer_invite);
    $command6 = $action->update_system('score_guild_by_user',$guild_user);
    $command7 = $action->update_system('score_guild_by_marketer',$guild_marketer);
    $command8 = $action->update_system('score_guild_by_guild',$guild_guild);

    // check errors
    if ($command && $command1 && $command2 && $command3 && $command4 && $command5) {
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
            <h3 class="text-primary"> امتیازات سیستم</h3>
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
                <li class="breadcrumb-item"><a">امتیازات سیستم</a></li>
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
                                    <label class="float-right" for="register">امتیاز ثبت نام کاربر</label>
                                    <input type="text" name="register" class="form-control"
                                           placeholder="امتیاز ثبت نام کاربر"
                                           value="<?= $action->get_system('score_register');?>" >
                                </div>
                                <div class="form-group">
                                    <label class="float-right" for="marketer_register">امتیاز ثبت نام بازارساز</label>
                                    <input type="text" name="marketer_register" class="form-control"
                                           placeholder=" امتیاز ثبت نام بازارساز"
                                           value="<?= $action->get_system('score_marketer_register');?>" >
                                </div>
                                <div class="form-group">
                                    <label class="float-right" for="wallet">امتیاز افزایش موجودی کیف پول کاربر</label>
                                    <input type="text" name="wallet" class="form-control"
                                           placeholder=" امتیاز افزایش موجودی کیف پول کاربر"
                                           value="<?= $action->get_system('score_wallet');?>" >
                                </div>
                                <div class="form-group">
                                    <label class="float-right" for="marketer_wallet">امتیاز افزایش موجودی کیف پول بازارساز</label>
                                    <input type="text" name="marketer_wallet" class="form-control"
                                           placeholder=" امتیاز  افزایش موجودی کیف پول بازارساز"
                                           value="<?= $action->get_system('score_marketer_wallet');?>" >
                                </div>
                                <div class="form-group">
                                    <label class="float-right" for="invite">امتیاز معرفی کاربر</label>
                                    <input type="text" name="invite" class="form-control"
                                           placeholder=" امتیاز معرفی کاربر"
                                           value="<?= $action->get_system('score_invite');?>" >
                                </div>
                                <div class="form-group">
                                    <label class="float-right" for="marketer_invite">امتیاز معرفی بازارساز</label>
                                    <input type="text" name="marketer_invite" class="form-control"
                                           placeholder=" امتیاز معرفی بازارساز"
                                           value="<?= $action->get_system('score_marketer_invite');?>" >
                                </div> 
                                <div class="form-group">
                                    <label class="float-right" for="guild_user">امتیاز معرفی صنف توسط کاربر</label>
                                    <input type="text" name="guild_user" class="form-control"
                                           placeholder=" امتیاز معرفی صنف توسط کاربر"
                                           value="<?= $action->get_system('score_guild_by_user');?>" >
                                </div>
                                <div class="form-group">
                                    <label class="float-right" for="guild_marketer">امتیاز معرفی صنف توسط  بازارساز</label>
                                    <input type="text" name="guild_marketer" class="form-control"
                                           placeholder=" امتیاز معرفی صنف توسط بازارساز"
                                           value="<?= $action->get_system('score_guild_by_marketer');?>" >
                                </div>
                                <div class="form-group">
                                    <label class="float-right" for="guild_guild">امتیاز معرفی صنف توسط  صنف</label>
                                    <input type="text" name="guild_guild" class="form-control"
                                           placeholder=" امتیاز معرفی صنف توسط صنف"
                                           value="<?= $action->get_system('score_guild_by_guild');?>" >
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

