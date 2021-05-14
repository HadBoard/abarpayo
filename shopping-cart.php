<?
require_once "functions/database.php";
$action = new Action();
$title = "سبد خرید" ;

if(!$action->auth()){
    header("Location: phone.php");
}

if($action->user()){
    $id = $action->user()->id;
    $access = 1;
}else if($action->marketer()){
    $id = $action->marketer()->id;
    $access = 0;
}

// if(isset($_POST['cart_pay'])){
//     if(isset($_SESSION['already_in_gateway'])){
//         unset($_SESSION['already_in_gateway']);
//     }
//     $_SESSION['cart_cost'] = $total_cost;
//     header("Location: shop-request.php");
// }

if(isset($_POST['delete_row'])){
    $item_id = $action->request('delete_item');
    $action->cart_item_remove($item_id);
    header("Location: shopping-cart.php");
}

if(isset($_POST['cart_cancel'])){

    $command = $action->remove_cart($id,$access);
    if($command){
        if(isset($_SESSION['already_in_gateway'])){
            unset($_SESSION['already_in_gateway']);
        }
        header("Location: index.php");
    }
}

include_once "header.php";

if(isset($_SESSION['successful_pay']) && $_SESSION['successful_pay'] == 'true'){
    ?>
        <div class="modal">
                <div class="alert alert-suc">
                    <span class="close_alart">×</span>
                    <p>
                        پرداخت موفق بود!
                    </p>
                </div>
            </div>
            <script src="assets/js/alert.js"></script>
    <?
    unset($_SESSION['successful_pay']);
}

if(isset($_SESSION['successful_pay']) && $_SESSION['successful_pay'] == 'false'){
    ?>
        <div class="modal">
                <div class="alert alert-fail">
                    <span class="close_alart">×</span>
                    <p>
                        پرداخت ناموفق بود!
                    </p>
                </div>
            </div>
            <script src="assets/js/alert.js"></script>
    <?
    unset($_SESSION['successful_pay']);
}
if(isset($_SESSION['already_in_gateway']) && $_SESSION['already_in_gateway'] == 'true'){
    ?>
        <div class="modal">
                <div class="alert alert-fail">
                    <span class="close_alart">×</span>
                    <p>
                        لطفا ابتدا وضعیت سبد فعلی خود را مشخص کنید.  !
                    </p>
                </div>
            </div>
            <script src="assets/js/alert.js"></script>
    <?
    $_SESSION['already_in_gateway'] = 'false';
    }
?>
    <section class="container">

        <div class="container">
    
            <div class="shop_list_header">
                  <div class="cat_shop">
                      <h3>سبد خرید</h3>
                  </div>
            </div>
        </div>

        <div class="container">
           <div class="row">
            <div class="col-md-8">
                <div class="notif_table cart_table">
                    <table>
                        <tr>
                            <th >ردیف</th>
                            <th>اسم محصول</th>
                            <th>نام فروشگاه</th>
                            <th>تعداد</th>
                            <th>حذف </th>
                        </tr>
                        <?
                            $counter = 1;
                            $cost =  floatval(0);
                            $total_off =  floatval(0);
                            $total_cost = floatval(0);
                            $items = $action->cart_items($id,$access);

                            while($item = $items->fetch_object()){

                                $price = $action->product_get($item->product_id)->price;
                                $off = $action->product_get($item->product_id)->discount;
                                $cost += $item->count * $price;
                                $total_off += $item->count *($price*$off/100);
                                $final = $item->count * (floatval($price) - floatval($price*$off/100));
                                $total_cost +=  $final;
                        ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= $action->product_get($item->product_id)->title ?></td>
                            <td><a href="shop.php?id=<?= $item->shop_id ?>"><?= $action->shop_get($item->shop_id)->title ?></a></td>
                            <td><?= $item->count ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="delete_item" value="<?= $item->id ?>">
                                    <button name="delete_row" type="submit" class="delete_row"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <?}?>
                       
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cart_card">
                    <div class="cart_inner">
                        <p>مبلغ خرید : 
                            <span><?= $cost?> تومان</span>
                        </p>
                        <p>
                            مقدار تخفیف:
                            <span>
                                <?= $total_off?> تومان
                            </span>
                        </p>
                        <p>
                             مبلغ قابل پرداخت:
                             <span class="final_price">
                                 <?= $total_cost ?> تومان
                             </span>
                         </p>
                         <div class="row">
                            <div class="col-lg-6">
                                <!-- <form action="" method="post"> -->
                                <button id="cart_pay" class="suc_button">پرداخت</button>
                                <!-- </form> -->
                            </div>
                            <div class="col-lg-6">
                                <form action="" method="post">
                                <button name="cart_cancel" type="submit" class="suc_button">انصراف</button>
                                </form>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            
           </div>
        </div>
    </section>
    <script>
 $('#cart_pay').click(function(){
    console.log('in');
     var total_cost = <?= $total_cost ?>
    $.ajax({
        url: "ajax/set-price.php",
        type:'post',
        data:{total_cost:total_cost},
        success: function(response){
            console.log(response)
            location.href = "shop-request.php"
        }
    });
});
</script>
    <? include('footer.php') ?>
