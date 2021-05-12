<? require_once "functions/database.php";
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "vip-marketer.php";
// ----------- urls ----------------------------------------------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $id = $action->request('edit');
    $edit = true;
    
}else{
    $result = $action->vip_marketer_list();
    if( $result->num_rows > 0){
        while($row = $result->fetch_object()){
            $vips[] = $row->marketer_id; 
        }
    }
}

if (isset($_GET['remove'])) {
    $id = $action->request('remove');
    $_SESSION['error'] = !$action->vip_marketer_remove($id);
    header("Location: $main_url");
    return;
}
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
    $score = $action->request('score');
    
    if($edit){
        $command = $action-> vip_marketer_edit($id,$score);

    }else{

        $marketers = $_POST['marketer'];
        if(!empty($marketers)){
    
            foreach($vips as $vip){
                $command = $action -> vip_marketer_remove($vip);
            }

            foreach ($marketers as $marketer) {
               $command = $action -> vip_marketer_add($marketer,$score);
            }
        }
        
    }

   
    // check errors
    if ($command) {
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
            <?php if (!isset($_GET['action'])) { ?>
                <h3 class="text-primary">ثبت  بازاریابان ویژه</h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش  بازاریابان ویژه</h3>
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
                <li class="breadcrumb-item"><a href="<?= $main_url ?>">بازاریابان ویژه</a></li>
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
                            <form action="" method="post">
                            <?if(!$edit){?>
                            <div class="form-group">
                                    <label for="marketer[]">انتخاب بازاراسازان</label>
                                    <select class="form-control select2" name="marketer[]" multiple="multiple">
                                        <?
                                        $option_result = $action->marketer_list();
                                        while ($option = $option_result->fetch_object()) {
                                            echo '<option value="';
                                            echo $option->id;
                                            echo '"';
                                            if( $result->num_rows > 0){if (in_array($option->id,$vips)) echo "selected";}
                                            echo '>';
                                            echo $option->first_name." ".$option->last_name;
                                            echo '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?}?>

                                <?if($edit){?>
                                <div class="form-group">
                                    <input type="text" class="form-control input-default "
                                        value="<?= $action->marketer_get($id)->first_name." ".$action->marketer_get($id)->last_name?>" readonly>
                                </div>
                                <?}?>

                                <div class="form-group">
                                    <input type="text" name="score" class="form-control input-default "
                                           placeholder="امتیاز پیش فرض" required>
                                </div>

                                <div class="form-actions">

                                    <button type="submit" name="submit" class="btn btn-success sweet-success">
                                        <i class="fa fa-check"></i> ثبت
                                    </button>

                                    <a href="panel.php"><span name="back" class="btn btn-inverse">بازگشت  </span></a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- ----------- end row of fields ----------------------------------------------------------- -->
            </div>
            <div class="col-lg-6">
            <div class="card">
                    <div class="card-body">

                        <div class="table-responsive m-t-5">
                            <table id="example23" class="display nowrap table table-hover table-striped"
                                   cellspacing="0" width="100%">
                                <thead>
                               
                                <tr>
                                    <th class="text-center">ردیف</th>
                                    <th class="text-center">نام</th>
                                    <th class="text-center">امتیاز</th>
                                    <th class="text-center">مدیریت</th>
                                </tr>
                                </thead>

                                <tbody class="text-center">
                                <? 
                                $counter = 1;
                                $result = $action->vip_marketer_list();
                                while ($row = $result->fetch_object()) { ?>
                                    <tr class="text-center">
                                        <td class="text-center"><?= $counter++ ?></td>
                                        <td class="text-center"><?= $action->marketer_get($row->marketer_id)->first_name." ".$action->marketer_get($row->marketer_id)->last_name?></td>
                                        <td class="text-center"><?= $row->score ?></td>
                                        <td class="text-center">
                                            <a href="<?= $main_url ?>?edit=<?= $action->marketer_get($row->marketer_id)->id ?>">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            |
                                            <a href="<?= $main_url ?>?remove=<?= $action->marketer_get($row->marketer_id)->id ?>">
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
    </div>
    <!-- ----------- end main container ------------------------------------------------------------------------ -->

</div>
<? include('footer.php'); ?>

