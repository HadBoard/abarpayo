<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$province_id=$_POST['province_id'];
?>
<select class="form-control select2" name="city" id="city">
    <!-- <option>شهرستان را انتخاب فرمایید .</option> -->
    <? 
    $option_result = $action->province_city_list($province_id);
    while ($option = $option_result->fetch_object()) {
        echo '<option value="';
        echo $option->id;
        echo '"';
        if ($option->id == $province_id) echo "selected";
        echo '>';
        echo $option->name;
        echo '</option>';
    }
    ?>
</select>