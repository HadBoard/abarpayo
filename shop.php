<?
require_once "functions/database.php";
$action = new Action();
$title = "فروشگاه ها" ;
include_once "header.php";
if(isset($_GET['id'])){
    $id = $action->request('id');
}

$shop  = $action-> shop_get($id);
$user_id = $action->user()->id;
$name = $action->user_get($user_id)->first_name." ".$action->user_get($user_id)->last_name;

    if(isset($_POST['submit'])){
        $mycomment  = $action->request('mycomment');
        $score = $action->request('rate');
        $command  = $action->shop_comment_add($id,$user_id,$mycomment,$score);

        if($command){
            ?> 
            <div class="modal">
                <div class="alert alert-suc">
                    <span class="close_alart">×</span>
                    <p>
                          کامنت شما با موفقیت ثبت شد!
                    </p>
                </div>
            </div>
            <script src="assets/js/alert.js"></script>
        <?
        }
    }
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
                      <h2><?= $shop->title?></h2>
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
                $pics = $action->shop_pics_get($id);
                while ($pic = $pics->fetch_object()) {
             ?>
                <img class="carousel-cell" src="admin/images/shops/<?= $pic->image ?> ">
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
            $shops = $action->category_shops_list_limited($row->id)
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

      <!-- comment -->
    <?
    if($action->auth()){
    ?>
      <div class="container comment_container">
        <div class="comment_area">
            <h3>نظر دهید</h6>
            <div class="comment_top">
                <div class="row">
                    <div class="col-6">
                        <div class="info_comment">
                            <div class="avatar"><img></div>
                            <h5><?= $name ?></h6>
                        </div>
                    </div>
                    <div class="col-6">
                    <form action="" method="post">
                        <div class="stars">
                            <div class="container-x">
                                <div class="star-widget">
                                    <input type="radio" name="rate" id="rate-5" value=1>
                                    <label for="rate-5" class="fas fa-star" aria-hidden="true"></label>
                                    <input type="radio" name="rate" id="rate-4"  value=2>
                                    <label for="rate-4" class="fas fa-star" aria-hidden="true"></label>
                                    <input type="radio" name="rate" id="rate-3" checked=""  value=3>
                                    <label for="rate-3" class="fas fa-star" aria-hidden="true"></label>
                                    <input type="radio" name="rate" id="rate-2" checked=""  value=4>
                                    <label for="rate-2" class="fas fa-star" aria-hidden="true"></label>
                                    <input type="radio" name="rate" id="rate-1" checked=""  value=5>
                                    <label for="rate-1" class="fas fa-star" aria-hidden="true"></label>
                                </div>
                            </div>
                                       
                        </div>
                    </div> 
                </div>
                
                    <textarea name="mycomment"></textarea>
                    <input name="submit" type="submit" class="main_btn middle_btn " value="ارسال نظر">
                </form>
            </div><!-- end of write comment -->
            <div class="comment_bottom">
                <h3>نظرات</h6>
                    <!--  -->
                <div class="comment_info ">
                    <?
                    $comments = $action->shop_comments_list($id);
                    while($comment = $comments->fetch_object()){
                    ?>
                    <div class="row">
                        <div class="col-1">
                            <div class="avatar"></div>
                        </div>
                        <div class="col-11">
                            <div class="comment_item">
                                <div class="comment_item_info">
                                    <h4><?= $action->user_get($comment->user_id)->first_name." ".$action->user_get($comment->user_id)->last_name?></h4>
                                    <div class="date">
                                        <p><?= $action->time_to_shamsi($comment->created_at)?></p>
                                    </div>
                                </div>
                                <div class="commentp">
                                    <p>
                                        <?= $comment->text ?>
                                    </p>
                                </div>
                                <a href="#" class="comment_reply_icon">
                                    <i class="fa fa-reply"></i>
                                </a>
                                
                            </div>
                        

                        </div>
                    </div>
                    <? } ?>
                </div>
                    <!--  -->
                    <div class="comment_info comment_reply">
                    <?
                        $replys = $action->shop_comments_replys_list($comment->id);
                        while($reply = $replys->fetch_object()){
                    ?>
                        <div class="row">
                            <div class="col-1">
                                <div class="avatar"></div>
                            </div>
                            <div class="col-11">
                                <div class="comment_item">
                                    <div class="comment_item_info">
                                        <h4> علوی</h4>
                                        <div class="date">
                                            <p><?= $action->time_to_shamsi($reply->created_at);?></p>
                                        </div>
                                    </div>
                                    <div class="commentp">
                                        <p>
                                            <?= $reply->text ?>                             
                                        </p>
                                    </div>
                                    <!-- <div class="comment_reply_icon">
                                        <i class="fa fa-reply"></i>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    <? } ?>
                    </div>
            </div>
        </div>
    </div>
    <?}?>

    <!-- comment -->

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
