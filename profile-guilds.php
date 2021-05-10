<?
    require_once "functions/database.php";
    $action = new Action();

    $error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}

    if(isset($_POST['submit'])){
        $name  = $action->request('name');
        $owner = $action->request('owner');
        $address = $action->request('address');
        $category = $action->request('category');

        if($action->user()){
            $access = 0;
        }else if($action->marketer()){
            $access = 1;
        }
        $command = $action->shop_request_add($id,$category,$reference_id,$name,$owner,$address,$access);
        if ($command) {
            $_SESSION['error'] = 0;
        } else {
            $_SESSION['error'] = 1;
        }

        echo '<script>window.location="?guilds"</script>';
    }
?>
<? if ($error) {
            if ($error_val) { ?>

                 <div class="modal">
                    <div class="alert alert-fail">
                        <span class="close_alart">×</span>
                        <p>
                            عملیات ناموفق بود!
                        </p>
                    </div>
                </div>
                <script src="assets/js/alert.js"></script>
                
            <? } else { ?>
                <div class="modal">
                    <div class="alert alert-suc">
                        <span class="close_alart">×</span>
                        <p>
                            عملیات موفق بود!
                        </p>
                    </div>
                </div>
                <script src="assets/js/alert.js"></script>
                
            <? }
} ?>


<div class="edit_profile_div">

    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img"><img src="assets/images/Group 499@2x.png">
            </div>
        </div>
    <form action="" method="post">
    </div>
    <div class="profile_left">
    <div class="form-group">
            <label for="name">نام صنف</label>
            <input type="text" name="name" placeholder="فقط حروف فارسی">
        </div>
        <div class="form-group">
            <label for="owner">نام صاحب کسب و کار</label>
            <input type="text" name="owner" placeholder="فقط حروف فارسی">
        </div>
        <div class="form-group">
            <label for="category">دسته بندی</label>
            <select name="category">
            <option>دسته بندی را انتخاب فرمایید .</option>
                    <?
                    $option_result = $action->category_list();
                    while ($option = $option_result->fetch_object()) {
                        echo '<option value="';
                        echo $option->id;
                        echo '"';
                        echo '>';
                        echo $option->title;
                        echo '</option>';
                    }
                    ?>
            </select>
        </div>
        <div class="form-group">
            <label for="address">نشانی</label>
            <textarea name="address"></textarea>
        </div>
        <input name="submit" type="submit" class="main_btn" value="ثبت درخواست">

        </form>
    </div>
</div>