<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "category.php";
// main url for remove , change status
$list_url = "category-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->category_get($id);
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
    $title = $action->request('title');
    $status = $action->request('status');
    $ord = $action->request('ord');
    $slag = $action->request('slag');
    $icon = ($edit ? $row->icon : "");
    
    if($_FILES["icon"]["name"]){
        unlink("images/categoryIcons/$icon");
        $target_dir = "images/categoryIcons/";
        $target_file = $target_dir . basename($_FILES["icon"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            $name = $action -> get_token(10) . "." . $imageFileType;
            // Upload file
            move_uploaded_file($_FILES['icon']['tmp_name'],$target_dir.$name);
            $icon = $name;
        } 
    }

    // send query
    if ($edit) {
        $command = $action->category_edit($id, $title,$icon,$ord,$slag,$status);
    } else {
        $command = $action->category_add($title,$icon,$ord,$slag,$status);
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
                <h3 class="text-primary">ثبت دسته بندی</h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش دسته بندی</h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">دسته بندی ها</a></li>
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
                                    <input type="text" name="title" class="form-control input-default "
                                           placeholder="عنوان"
                                           value="<?= ($edit) ? $row->title : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="ord" class="form-control input-default "
                                           placeholder="ترتیب"
                                           value="<?= ($edit) ? $row->ord : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="slag" class="form-control input-default "
                                           placeholder="slag"
                                           value="<?= ($edit) ? $row->slag : "" ?>" required>
                                </div>

                                <div>
                                    <label for="icon" class="btn btn-dark btn-block m-0">انتخاب آیکون</label>
                                    <input type="file" name="icon" id="icon" style="visibility:hidden;">
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

                                    <a href="<?= $list_url ?>"><span name="back"
                                                                     class="btn btn-inverse">بازگشت به لیست</span></a>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- ----------- end row of fields ----------------------------------------------------------- -->
            </div>
            <? if($edit && $row->icon) { ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <img src="images/categoryIcons/<?= $row->icon ?>">
                        </div>
                    </div>
            <? } ?>
        </div>
    </div>
    <!-- ----------- end main container ------------------------------------------------------------------------ -->

</div>
<? include('footer.php'); ?>

