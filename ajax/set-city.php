<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$city_id = $_POST['city_id'];
$province_id = $_POST['province_id'];
$_SESSION['default_city'] = $city_id;
$_SESSION['default_province'] = $province_id;