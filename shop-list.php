<?
require_once "functions/database.php";
$action = new Action();
$title = "فروشگاه ها" ;
include_once "header.php"
?>
  <!-- main part of shop list page -->
  <div class="container">
      <div class="shop_list_header">
            <div class="row">
                <div class="col-3">
                    <div class="city_header shop_list_select">
                        <select>
                            <option>همه استان ها</option>
                            <option>یزد-یزد</option>
                            <option>یزد-یزد</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="city_header shop_list_select">
                        <select>
                            <option>همه شهر ها</option>
                            <option>یزد-یزد</option>
                            <option>یزد-یزد</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="city_header shop_list_select">
                        <select>
                            <option>همه دسته بندی ها</option>
                            <option>یزد-یزد</option>
                            <option>یزد-یزد</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 search_header shop_list_search">
                    <input placeholder="جستجو : باشگاه ها ، کافه ها">
                    <button><span class="material-icons">
                      search
                      </span></button>
                </div>
            </div>
            <div class="row">
                <button class="main_btn middle_btn shop_list_btn">
                    <i class="fa fa-play"></i>
                    فروشگاه های نزدیک من
                </button>
            </div>
      </div>
  </div>

  <!-- stores -->
    <section class="container">

        <!-- buttons -->
    <div class="tab_index">
        <button class="tablinks active_tablink">رستوران و کافی شاپ</button>
        <button class="tablinks" >تفریحی ورزشی</button>
        <button class="tablinks" >آرایشی  و بهداشتی</button>
        <button class="tablinks" >پزشکی و سلامتی</button>
        <button class="tablinks" >فرهنگی و هنری</button>
        <button class="tablinks" >کالا و خدمات</button>
    </div>
        <!-- eof btns -->
        <!--tabs content  -->
    <div  class="tabcontent">
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
    
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
        <div class="index_shop">
            <div class="index_shop_inner">
                <div style="width: 100%;position: relative;">
                    <img src="assets/images/26409.png">
                    <div class="shop_off">23%</div>
                </div>
                <div class="shop_content">
                    <h4>دندان پزشکی اسمایل سنتر</h4>
                    <h6>
                        <i class="fa fa-map"></i>
                        میدان اطلسی
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
    <!--  -->
    <!--  -->
        <div class="index_shop">
            <div class="index_shop_inner">
                <div style="width: 100%;position: relative;">
                    <img src="assets/images/26409.png">
                    <div class="shop_off">23%</div>
                </div>
                <div class="shop_content">
                    <h4>دندان پزشکی اسمایل سنتر</h4>
                    <h6>
                        <i class="fa fa-map"></i>
                        میدان اطلسی
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
    <!--  -->

    <!--  -->
        <div class="index_shop">
            <div class="index_shop_inner">
                <div style="width: 100%;position: relative;">
                    <img src="assets/images/26409.png">
                    <div class="shop_off">23%</div>
                </div>
                <div class="shop_content">
                    <h4>دندان پزشکی اسمایل سنتر</h4>
                    <h6>
                        <i class="fa fa-map"></i>
                        میدان اطلسی
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
    <!--  -->
    <!--  -->
        <div class="index_shop">
            <div class="index_shop_inner">
                <div style="width: 100%;position: relative;">
                    <img src="assets/images/26409.png">
                    <div class="shop_off">23%</div>
                </div>
                <div class="shop_content">
                    <h4>دندان پزشکی اسمایل سنتر</h4>
                    <h6>
                        <i class="fa fa-map"></i>
                        میدان اطلسی
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
    <!--  -->
    <!--  -->
        <div class="index_shop">
            <div class="index_shop_inner">
                <div style="width: 100%;position: relative;">
                    <img src="assets/images/26409.png">
                    <div class="shop_off">23%</div>
                </div>
                <div class="shop_content">
                    <h4>دندان پزشکی اسمایل سنتر</h4>
                    <h6>
                        <i class="fa fa-map"></i>
                        میدان اطلسی
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
    <!--  -->
            <button class="main_btn">
                
                 <a>
                     <i class="fa fa-reply"></i>
                 </a>
                 بیشتر
            </button>

    </div>

    <div  class="tabcontent">
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
            <button class="main_btn">
                
                 <a>
                     <i class="fa fa-reply"></i>
                 </a>
                 بیشتر
            </button>

    </div>

    <div  class="tabcontent">
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
            <button class="main_btn">
                
                 <a>
                     <i class="fa fa-reply"></i>
                 </a>
                 بیشتر
            </button>

    </div>

    <div  class="tabcontent">
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
            <button class="main_btn">
                
                 <a>
                     <i class="fa fa-reply"></i>
                 </a>
                 بیشتر
            </button>

    </div>

    <div  class="tabcontent">
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
            <button class="main_btn">
                
                 <a>
                     <i class="fa fa-reply"></i>
                 </a>
                 بیشتر
            </button>

    </div>

    <div  class="tabcontent">
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
            <button class="main_btn">
                
                 <a>
                     <i class="fa fa-reply"></i>
                 </a>
                 بیشتر
            </button>

    </div>

    <div  class="tabcontent">
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
            <button class="main_btn">
                
                 <a>
                     <i class="fa fa-reply"></i>
                 </a>
                 بیشتر
            </button>

    </div>

    <div  class="tabcontent">
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
        <!--  -->
            <div class="index_shop">
                <div class="index_shop_inner">
                    <div style="width: 100%;position: relative;">
                        <img src="assets/images/26409.png">
                        <div class="shop_off">23%</div>
                    </div>
                    <div class="shop_content">
                        <h4>دندان پزشکی اسمایل سنتر</h4>
                        <h6>
                            <i class="fa fa-map"></i>
                            میدان اطلسی
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
        <!--  -->
            <button class="main_btn">
                
                 <a>
                     <i class="fa fa-reply"></i>
                 </a>
                 بیشتر
            </button>

    </div>
        <!-- eof tabs -->
    </section>

    <!-- eof stores -->
    <? include_once "footer.php" ?>  