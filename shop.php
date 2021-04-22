<?
require_once "functions/database.php";
$action = new Action();
$title = "فروشگاه ها" ;
include_once "header.php";
$id = $_GET['id'];
$shop  = $action-> shop_get($id);
?>

  <!-- shop first-container -->
  <div class="shop_container">
      <div class="container" style="border-bottom:1px solid #1a1a1a70;    padding-bottom: 30px;
      ">
          <div class="row">
              <div class="col-md-1">      
                  <img class="shop_img_icon" src="assets/images/shop@2x.png">
              </div>
              <div class="col-md-6">
                  <div class="shop_right">
                      <h2><?= $shop->title ?></h2>
                      <p><?= $shop->address?></p>
                  </div>
              </div>
              <div class="col-md-5">
                  <div class="shop_left">
                        <h3>
                            % <span>14</span>تخفیف
                        </h3>
                        <div class="star_card star_card_shop">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            عملکرد : <span>3.8</span> از 5
                        </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- sof first container -->


  <section class="main_slider">
        <div class="carousel"
            data-flickity='{ "wrapAround": true }'>
            <?
                $result = $action->slider_list();
                while ($shop = $result->fetch_object()) {
             ?>
                <img class="carousel-cell" src="admin/images/sliders/<?= $shop->image ?> ">
            <?
                }
            ?>
        </div>
    </section>
  <!-- eof slider -->


    <!-- main -->
    <div class="container">
        <div class="main_shop">
            <div class="container">
                <div class="row">
                    <!-- main content -->
                    <div class="col-md-6">
                        <div class="main_shop_right">
                            <div class="shop_content_header">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="assets/images/sort-descending (1).png">
                                    </div>
                                    <div class="col-10">
                                        <h4>ویژگی ها</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <p>برترین نوشیدنی های سرد و گرم</p>
                                <ul>
                                    <li>
                                        <img src="assets/images/checkmark.png">
                                        <span>کارت خوان : </span>
                                        <span>دارد</span>
                                    </li>
                                    <li>
                                        <img src="assets/images/checkmark.png">
                                        <span>جای پارک آسان : </span>
                                        <span>دارد</span>
                                    </li>
                                    <li>
                                        <img src="assets/images/checkmark.png">
                                        <span>پذیرایی در محل :  </span>
                                        <span>دارد</span>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <img src="assets/images/button.png">
                                        <span>محیطی شیک و زیبا</span>
                                        <span>دارد</span>
                                    </li>
                                    <li>
                                        <img src="assets/images/button.png">
                                        <span>محیطی شیک و زیبا</span>
                                        <span>دارد</span>
                                    </li>
                                    <li>
                                        <img src="assets/images/button.png">
                                        <span>محیطی شیک و زیبا</span>
                                        <span>دارد</span>
                                    </li>
                                    <li>
                                        <img src="assets/images/button.png">
                                        <span>محیطی شیک و زیبا</span>
                                        <span>دارد</span>
                                    </li>
                                    <li>
                                        <img src="assets/images/button.png">
                                        <span>محیطی شیک و زیبا</span>
                                        <span>دارد</span>
                                    </li>
                                   
                                </ul>
                            </div>
    
                        </div>
                    </div>
                    <!--  -->
                    <div class="col-md-6">
                        <div class="main_shop_left">
                            <div class="shop_content_header">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="assets/images/audit.png">
                                    </div>
                                    <div class="col-10">
                                        <h4>شرایط استفاده</h4>
                                    </div>
                                </div>
    
                            </div>
                            <!--  -->
                            <div class="row ">
                                <ul>
                                    <li>
                                        <img src="assets/images/Path 662.png">
                                        <p>
                                            هنگام استفاده از خدمات باشگاه مشتریان ابر پایو همراه داشتن
    .کارت بانکی رجیستر شده در شبکه ابر پایو الزامی می باشد
                                        </p> 
                                    </li>
                                    <li>
                                        <img src="assets/images/Path 662.png">
                                        <p>
                                            ارایه خدمات به مشتریانابر پایو فقط با دستگاه کارت خوان باشگاه
    .مشتریان ابر پایو انجام می شود 
                                        </p>
                                    </li>
                                    
                                </ul>
                                <ul class="address_shop">
                                    <li>
                                        <img src="assets/images/clock.png">
                                        <h6> : ساعت پاسخگویی و سرویس دهی : </h6>
                                        <span>از 9 صبح یکسره تا 11 شب</span>
                                    </li>
                                    <li>
                                        <img src="assets/images/sunny-day.png">
                                        <h6>روز های سرویس دهی:</h6>
                                        <span> همه روزه</span>
                                    </li>
                                    <li>
                                        <img src="assets/images/sign (1).png">
                                        <h6>آدرس : </h6>
                                        <span><?= $shop->address?></span>
                                    </li>
                                    
                                    <li>
                                        <img src="assets/images/call.png">
                                        <h6>تلفن : </h6>
                                        <span><?= $shop->phone?></span>
                                    </li>
                                   
                                </ul>
                            </div>
                            <!--  -->
    
    
                            
    
                        </div>
                    </div>
                    <!--  -->
                    <div class="shop_map">
                        <iframe src="https://maps.google.com/maps?q=31.890901,54.354093&amp;hl=fa&amp;z=15&amp;output=embed" width="600" height="400" frameborder="0" style="border-radius: 5px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
    
                    <div class="row">
                        <a href="" class="main_btn middle_btn shop_btn_way">
                            <!-- <img src="../assets/images/way.png"> -->
                            <i class="fa fa-map"></i>
                            مسیریابی    
                        </a>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>

       <!-- stores -->
       <section class="container shop_extra">
        <h3 class="index_title">فروشگاه های طرف قراداد</h3>

        <!-- buttons -->
        <div class="tab_index">
        <?
            $result = $action->category_ordered_list_limited();
            while($row = $result->fetch_object()){
        ?>
            <button class="tablinks"><?= $row->title ?></button>
        <?  } ?>
    </div>
        <!-- eof btns -->
        <!--tabs content  -->
        <?
        $result = $action->category_ordered_list();
        while($row = $result->fetch_object()){
            $shops = $action->category_shops_list($row->id)
    ?>
        <div  class="tabcontent">
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
<? include_once "footer.php" ;?>
