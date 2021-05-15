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
                            <th>تعداد</th>
                            <th>قیمت اصلی</th>
                            <th> قیمت پس از تخفیف</th>
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
                                if($action->user()){
                                    $off = $action->product_get($item->product_id)->discount;
                                }else if($action->marketer()){
                                    switch($action->marketer($id)->package_id){
                                        case 1: 
                                            $off = $action->product_get($item->product_id)->discount1;
                                            break;
                                        case 2 :
                                            $off = $action->product_get($item->product_id)->discount2;
                                            break;
                                        case 3 :
                                            $off = $action->product_get($item->product_id)->discount3;
                                            break;
                                        case 4 :
                                            $off = $action->product_get($item->product_id)->discount4;
                                    }
                                }
                                $cost += $item->count * $price;
                                $total_off += $item->count *($price*$off/100);
                                $final = $item->count * (floatval($price) - floatval($price*$off/100));
                                $total_cost +=  $final;
                        ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= $action->product_get($item->product_id)->title ?></td>
                            <td><?= $item->count ?></td>
                            <? if($cost != $final){?>
                            <td><?= $cost ?></td>
                            <td><?= $final ?></td>
                            <?}else{?>
                                <td><?= $cost ?></td>
                                <td></td>
                            <?}?>
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
                                <form action="shop-request.php" method="post">
                                <input type="hidden" name="price" value="<?= $total_cost?>">
                                <button type="submit" name="cart_pay" id="cart_pay" class="suc_button">پرداخت</button>
                                </form>
                    
                                <form action="" method="post">
                                <button name="cart_cancel" type="submit" class="suc_button">انصراف</button>
                                </form>
                    
                    
                    </div>
                </div>
            </div>
            
           </div>
        </div>
    </section>
    <script>
    <? 
    $_SESSION['cart_cost'] = $total_cost;
    include('footer.php') ?>
