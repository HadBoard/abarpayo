<? require_once "functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for add , edit
$main_url = "product.php";
// main url for remove , change status
$list_url = "product-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data from database when action is edit --------------------------------------------------------------
$edit = false;
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $action->request('edit');
    $row = $action->product_get($id);
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
    $description = $action->request('description');
    $price = $action->request('price');
    $status = $action->request('status');

    // send query
    if ($edit) {
        $command = $action->product_edit($id, $title, $description, $price,$status);
    } else {
        $command = $action->product_add($title, $description, $price, $status);
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
                <h3 class="text-primary">ثبت محصول </h3>
            <?php } else { ?>
                <h3 class="text-primary">ویرایش محصول </h3>
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
                <li class="breadcrumb-item"><a href="<?= $list_url ?>">محصولات</a></li>
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
                                    <select class="form-control" name="category_id">
                                        <?
                                        $categories = $action -> category_list();
                                        while ($category = $categories->fetch_object()) { 
                                        ?>
                                    
                                        <option 
                                        <?
                                        // if($edit && $category->id==$row->id)
                                        // echo 'selected="selected"';
                                        ?>
                                        value="<?= $category->id ?>"><?= $category->title ?></option>
                                        <?
                                        }
                                        ?>
                                   </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="shop_id">
                                        <?
                                        $shops = $action -> shop_list();
                                        while ($shop = $shops->fetch_object()) { 
                                        ?>
                                        <option 
                                        <?
                                        // if($edit && $shop->id==$row->id)
                                        // echo 'selected="selected"';
                                        ?>
                                        value="<?= $shop->id ?>"><?= $shop->title ?></option>
                                        <?
                                        }
                                        ?>
                                   </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control input-default "
                                           placeholder="عنوان"
                                           value="<?= ($edit) ? $row->title : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <textarea type="text" name="description" class="form-control input-default "
                                           placeholder="توضیحات"
                                            ><?= ($edit) ? $row->description : "" ?></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="price" class="form-control input-default "
                                           placeholder="قیمت"
                                           value="<?= ($edit) ? $row->price : "" ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="discount" class="form-control input-default "
                                           placeholder="تخفیف"
                                           value="<?= ($edit) ? $row->discount : "" ?>" >
                                </div>

                                <div class="form-group">
                                    <input type="text" name="score" class="form-control input-default "
                                           placeholder="امتیاز"
                                           value="<?= ($edit) ? $row->score : "" ?>" >
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
// ----------- end html :) ---------------------------------------------------------------------------------------------

