<?
require_once "../functions/database.php";
$action = new Action();

$city_id = $_POST['city_id'];
$province_id = $action->city_get($city_id)->province_id;
$_SESSION['default_city'] = $city_id;
$_SESSION['default_province'] = $province_id;
echo 1;