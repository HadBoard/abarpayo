<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$search = $_POST['search'];

$result = $action->shop_search($search);
while ($shop = $result->fetch_object()) {
  echo $shop->title;
}

?>
