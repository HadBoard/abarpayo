<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

$cur_index = $_POST['cur_index'];
$title = $_POST['title'];

$result = $action->shop_search($title,$cur_index);

while ($shop = $result->fetch_object()) {
    echo  '<div class="index_shop">
    <div class="index_shop_inner">
        <div style="width: 100%;position: relative;">
        <a href="shop.php?id=';
    echo $shop->id;
    echo '"><img src="admin/images/shops/';
    echo $shop->image;
    echo  '"><div class="shop_off">23%</div>
        </a>
        </div>
        <div class="shop_content">
        <a href="shop.php?id=';
    echo $shop->id;
    echo  'class="shop_content">
            <h4>';
    echo $shop->title;
    echo '</h4>
            <h6>
                <i class="fa fa-map"></i>';
    echo $shop->address;
    echo  '</h6>
        </a>
        </div>
        <div class="shop_star">
            <div class="row">
                <div class="col-3">
                    <div class="star_card"><i class="fa fa-star"></i> 3.8</div>
                </div>
                <div class="col-9 sell_card">
                    <i class="fas fa-shopping-cart"></i>

                    <p>
                        <span>256</span>
                        خرید
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>';  
}
?>
