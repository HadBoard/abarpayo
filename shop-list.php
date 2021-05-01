<?
require_once "functions/database.php";
$action = new Action();
$title = "فروشگاه ها" ;
include_once "header.php";
if(isset($_GET['category'])){
    $id = $action->request('category');
}
?>
  <!-- main part of shop list page -->
  <div class="container">
    
      <div class="shop_list_header">
            <div class="cat_shop">
                <h3><?= $action->category_get($id)->title ?></h3>
            </div>
      </div>
  </div>

  <!-- stores -->
    <section class="container">
        <!-- buttons -->
    <div class="tab_index" style="border-bottom:none;">
    <?
        $shops = $action->category_shops_list_limited($id);
    ?>
        <div  class="tabcontent">
        <?
            while($shop = $shops->fetch_object()){
        ?>
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                    <a href="shop.php?id=<?=$shop->id?>" >
                        <img src="admin/images/shops/<?= $shop->image?>">
                        <div class="shop_off">23%</div>
                    </a>
                    </div>
                    <div class="shop_content">
                    <a href="shop.php?id=<?=$shop->id?>" class="shop_content">
                        <h4><?= $shop->title ?></h4>
                        <h6>
                            <i class="fa fa-map"></i>
                             <?= $shop->address?>
                        </h6>
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
            </div>  
            <?
            }
            ?>
        </div>
        <?
            $count = $shops->num_rows;
            if($count){
        ?>
        <button id="lazyload" class="main_btn">      
                    <!-- <a> -->
                        <i class="fa fa-reply"></i>
                    <!-- </a> -->
                    بیشتر
        </button>
        <?
            }
        ?>
        <div class="row more-item" style="display: none;">
            <div class="nomore-item">      
                    
                    <p>مورد دیگری برای نمایش موجود نمی باشد . </p>
            </div>
        </div>
        
        <!-- eof tabs -->
    </section>
<script>
 var cur_index = 4;
 var id = "<?= $id ?>";
 $('#lazyload').click(function(){
     console.log("id",id);
     console.log("index",cur_index);
    $.ajax({
        url: "ajax/lazyLoader.php",
        type:'post',
        data: {cur_index:cur_index,category_id:id},
        success: function(response){
            cur_index += 8;
            if(response){
                $(".tabcontent").append(response);
                $('.more-item').hide();
            }else{
                $('.more-item').show();
                $('#lazyload').hide();
            }
        }
    });
});
</script>
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