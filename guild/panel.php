<?
require_once "functions/database.php";
$action = new Action();

include('header.php');
?>

    <div class="page-wrapper">

    <div class="row page-titles">

        <!-- ----------- start breadcrumb ---------------------------------------------------------------------- -->
        <div class="col-md-12 align-self-center text-right">
            <h3 class="text-primary">داشبورد</h3></div>
        <div class="col-md-12 align-self-center text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="fa fa-dashboard"></i>
                        خانه
                    </a>
                </li>
            </ol>
        </div>
        <!-- ----------- end breadcrumb ------------------------------------------------------------------------ -->

    </div>


    <div class="container-fluid">

        <!-- ----------- start row of cards -------------------------------------------------------------------- -->
        <div class="row">

            <div class="col-md-3">
                <a href="admin-list.php">
                    <div class="card p-30 bg-warning">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-usd f-s-80 color-white"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <span class="text-white f-s-30"><?= $action->guild_counter() ?></span>
                                <br>
                                <span class="text-white f-s-20">مدیران</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            
            <div class="col-md-3">
                <a href="product-list.php" target="_blank">
                    <div class="card p-30 bg-info">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-archive f-s-80 color-white"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <span class="text-white f-s-30"><?=$action->product_counter();?></span>
                                <br>
                                <span class="text-white f-s-20">محصولات</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                
                    <div class="card p-30 bg-danger">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-user f-s-80 color-white"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <span class="text-white f-s-30">100</span>
                                <br>
                                <span class="text-white f-s-20">کارمندان</span>
                            </div>
                        </div>
                    </div>
                
            </div>

        </div>
        <!-- ----------- end row of cards ---------------------------------------------------------------------- -->

    </div>

<? include('footer.php') ?>