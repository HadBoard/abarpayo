<?
require_once "functions/database.php";
$action = new Action();
$title = "نتایج جستجو";
include_once "header.php";

if(isset($_POST['advanced_search'])){
    $search = $action->request('input');
    $city = $action->request('city');
    $category = $action->request($category);
    
    if(!$city){
        $result = $action->advance_search_not_city($search,$category,0);
    }else if(!$category){
        $result = $action->advance_search_not_category($search,$city,0);
    }else if(!$input){
        $result = $action->advance_search_not_input($search,$category,0);
    }else{
        $result = $action->advance_search($search,$category,$city,0);
    }
}

if(isset($_POST['search_button'])){
    $search = $action->request('search');
}
$count = $result->num_rows;
$result = $action->shop_search($search,0);

?>
 <div class="container">
      <div class="shop_list_header">

        <form action="" method="post">
            <div class="row">
                <div class="col-3">
                    <div class="city_header shop_list_select">
                    <select name="province" id="province">
                    <option>استان</option>
                        <?
                        $option_result =  $action->province_list();
                        while ($option = $option_result->fetch_object()) {
                            echo '<option value="';
                            echo $option->id;
                            echo '"';
                            if ($option->id == $province) echo "selected";
                            echo '>';
                            echo $option->name;
                            echo '</option>';
                        }
                        ?>
                    </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="city_header shop_list_select">
                    <select name="city" id="city">
                    <option>شهرستان </option>
                    <?
                    $option_result =  $action->province_city_list($province);
                    while ($option = $option_result->fetch_object()) {
                        echo '<option value="';
                        echo $option->id;
                        echo '"';
                        if ($option->id == $city) echo "selected";
                        echo '>';
                        echo $option->name;
                        echo '</option>';
                    }
                    ?>
                </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="city_header shop_list_select">
                    <select name="category">
                        <option>دسته بندی</option>
                        <?
                        $option_result = $action->category_list();
                        while ($option = $option_result->fetch_object()) {
                            echo '<option value="';
                            echo $option->id;
                            echo '"';
                            if ($option->id == $row->category_id) echo "selected";
                            echo '>';
                            echo $option->title;
                            echo '</option>';
                        }
                        ?>
                    </select>
                    </div>
                </div>
                <div class="col-md-3 search_header shop_list_search">
                    <input name="input" placeholder="جستجو : باشگاه ها ، کافه ها">
                    <button><span class="material-icons">
                      search
                      </span></button>
                </div>
            </div>
            <div class="row">
                <button name="advanced_search" type="submit" class="main_btn middle_btn shop_list_btn">
                    <i class="fa fa-search"></i>
                    جستجو
                </button>
            </div>
        </form>
      </div>
  </div>

  <!-- stores -->
    <section class="container">
        <div class="row">
            <? if($count){?>
            <div class="search_title">
                <p>جستجو برای </p><h2><?= $search ?> </h2> 
            </div>
            <?}else{?>
            <div class="search_title">
                <p>جستجو برای </p><h2><?= $search ?> </h2> <p>نتیجه ای در برنداشت.</p>
            </div>
            <?}?>
        </div>
 
        <!-- eof btns -->
        <!--tabs content  -->
    <div  class="tabcontent" style="display: block;">
<?
while ($shop = $result->fetch_object()) {
?>
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4> <?= $shop->title ?></h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            <?= $shop->address ?>
                       </h6>
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
<? } ?>           
     
    </div>
    <?
        if($count){
    ?>
    <button id="lazyload"class="main_btn">
                
                <a>
                    <i class="fa fa-reply"></i>
                </a>
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
 var cur_index = 8;
 var title = "<?= $search ?>";
 $('#lazyload').click(function(){
    // console.log("id",id);
     console.log("index",cur_index);
    $.ajax({
        url: "ajax/search-lazyLoader.php",
        type:'post',
        data: {cur_index:cur_index,title:title},
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
 document.getElementById('province').onchange=function(){
       var province_id=document.getElementById('province').value;
       console.log(province_id);
       $.ajax({
            url:'admin/ajax/get_city.php',
            type:'post',
            data:{province_id:province_id},
            success:function(response){
        		$("#city").html(response);
            }
       })
   }
</script>
<?include('footer.php');?>