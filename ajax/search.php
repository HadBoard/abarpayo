<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$title = $_POST['search'];
$shops = $action->shop_search($title);
while ($shop = $shops->fetch_object()) {
  echo $shop->title;
}
?>
