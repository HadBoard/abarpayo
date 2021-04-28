<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$search = $_POST['search'];

$shops = $action->shop_search($search);
while ($shop = $shops->fetch_object()) {
  echo $shop->title;
}
?>
