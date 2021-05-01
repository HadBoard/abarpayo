<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$city_id = $_POST['city_id'];
$_SESSION['default_city'] = $city_id;