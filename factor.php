<?
require_once "functions/database.php";
$action = new Action();
$title = "فاکتور خرید" ;
require_once "header.php";
?>
    <section class="container">
        <div class="container">
    
            <div class="shop_list_header">
                  <div class="cat_shop">
                      <h3>فاکتور خرید</h3>
                  </div>
            </div>
        </div>

        <div class="container payment_container">
            <div class="container">
                <div class="payment">
                    <img src="assets/images/Basic_Element_15-30_(806).jpg">
                    <!-- unsuccessfull payment? Dont worry honey just add this class: fail_payment -->
                    <div <?if(isset($_SESSION['successful_pay']) && $_SESSION['successful_pay'] == 'true'){ echo'class="suc_payment';}?> "
                    <?if(isset($_SESSION['successful_pay']) && $_SESSION['successful_pay'] == 'false'){ echo'class="fail_payment';}?> "
                    >
                        <p>
                            پرداخت شما به موفقیت انجام شد
                        </p>
                        <p>
                            رسید پرداخت شما ..... میباشد.
                        </p>

                    <div class="notif_table payment_table">
                        <table>
                            <tr>
                                <td >ردیف</td>
                                <td>اسم محصول</td>
                                <td>نام فروشگاه</td>
                                <td>تعداد</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td><a >فرشگاه 1</a></td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td><a >فرشگاه 1</a></td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td><a >فرشگاه 1</a></td>
                                <td>2</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? 
unset($_SESSION['successful_pay']);
include('footer.php') ?>