<?
require_once "functions/database.php";
$action = new Action();
$title = "ابر پایو";
include_once "header.php"
?>

    <section class="main_slider">
        <div class="carousel"
             data-flickity='{ "wrapAround": true }'>
             <?
                $result = $action->slider_list();
                while ($row = $result->fetch_object()) {
             ?>
                <a class="carousel-cell"><img src="admin/images/sliders/<?= $row->image ?>"></a>
            <?
                }
            ?>

        </div>
    </section>
    <!-- eof slider -->


    <!-- features -->
    <div class="container index_features">
        <h3 style="font-size: 26px;">ابرپایو چه میکند؟</h3>
        <div class="index_features_row">
            <div class="feature_cell">
                <div class="feature_inner">
                    <img src="assets/images/Group 297@2x.png">
                    <h3>ثبت کارت بانکی در اپلیکیشن ابرپویه</h3>
                    <p>همه ی کارت های عضو شتاب قابل قبوله</p>
                </div>
            </div>
            <div class="feature_cell">
                <div class="feature_inner">
                    <img src="assets/images/Group 298@2x.png">
                    <h3>خرید با کارت بانکی و اعتبار نقدی</h3>
                    <p style="margin-bottom: 0;">فروشگاه ها و کسب و کارهای ابر پایو بسیار زیادی در
                        سراسر کشور هستن</p>
                </div>
            </div>
            <div class="feature_cell">
                <div class="feature_inner">
                    <img src="assets/images/Group 301@2x.png">
                    <h3>از ۴ تا ۱۴ درصد پاداش نقدی بگیر</h3>
                    <p>پاداش نقدی خرید هر روز ۹ صبح تو کیف پولته</p>
                </div>
            </div>

        </div>
        <div class="index_features_row">
            <div class="feature_cell">
                <div class="feature_inner">
                    <img src="assets/images/Group 302@2x.png">
                    <h3>تجارت الکترونیک</h3>
                    <p>آشنا کردن مردم با دنیای دیجیتال و صنعت
                        تجارت الکترونیک با اجرای طرح های دانش بنیانی</p>
                </div>
            </div>
            <div class="feature_cell">
                <div class="feature_inner">
                    <img src="assets/images/Group 306@2x.png">
                    <h3>تخفیفات ارزشمند</h3>
                    <p>ارائه خدمات متنوع و کالاهای ایرانی با حداقل
                        هزینه و بدون واسطه</p>
                </div>
            </div>
            <div class="feature_cell">
                <div class="feature_inner">
                    <img src="assets/images/Group 307@2x.png">
                    <h3>ایجاد منبع درآمدی </h3>
                    <p>ایجاد اشتغال زایی و ایجاد منبع درآمدی ایمن و
                        مناسب برای آحاد جامعه ، بالاخص اقشار کم درآمد</p>
                </div>
            </div>
        </div>
    </div>
    <!--eof features -->
    <div class="row">
        <button class="main_btn middle_btn">
            <i class="fa fa-play"></i>
            ویدیو آموزشی
        </button>
    </div>


    <!-- stores -->
    <section class="container">
        <h3 class="index_title">فروشگاه های روز</h3>

        <!-- buttons -->
        <div class="tab_index">
        <?
            $result = $action->category_ordered_list_limited();
            while($row = $result->fetch_object()){
        ?>
            <button class="tablinks"><?= $row->title ?></button>
        <?
            }
        ?>
        </div>
        <?
            $result = $action->category_ordered_list();
            while($row = $result->fetch_object()){
                $shops = $action->category_shops_list_limited($row->id)

        ?>
        <div class="tabcontent">
            <!--  -->
            <?
            while($shop = $shops->fetch_object()){
            ?>
            <div class="index_shop">
                <div class="index_shop_inner">
                    <a href="shop.php?id=<?=$shop->id ?>" >
                        <img src="admin/images/shops/<?= $shop->image?>">
                        <div class="shop_off">23%</div>
                     </a>
                    <a href="shop.php?id=<?=$shop->id?>" class="shop_content">
                        <h4><?= $shop->title ?></h4>
                        <h6>
                            <i class="fa fa-map"></i>
                             <?= $shop->address?>
                        </h6>
                    </a>
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
            </div>
            <?
            }
            ?>

            <!--  -->
            <a href="shop-list.php?category=<?= $row->id ?>" class="main_btn">
                 
                <i class="fa fa-reply"></i>
               
                بیشتر
            </a>

        </div>
        <?
            }
        ?>

    
        <!-- eof tabs -->
    </section>
    <script>
        let tab_btns = document.querySelectorAll('.tablinks')
        let tab_content = document.querySelectorAll('.tabcontent')
        tab_content[0].style.display='block';
        tab_btns[0].classList.add('active_tablink');
        for (let index = 0; index < tab_btns.length; index++) {
            tab_btns[index].addEventListener('click' , function(){
                $('.tablinks').removeClass('active_tablink');
                $('.tabcontent').hide();
                tab_content[index].style.display = 'block';
                tab_btns[index].classList.add('active_tablink');
            })

        }

    </script>
<? include_once "footer.php" ?>