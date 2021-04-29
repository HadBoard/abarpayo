<?
require_once "functions/database.php";
$action = new Action();
$title = "پروفایل";
if(!$action->auth()){
    header("Location: phone.php");
}
if($action->user()){
    $id = $action->user()->id;
}else if($action->marketer()){
    $id = $action->marketer()->id;
}
include_once "header.php";
?>

<main>
    <div class="container">
        <div class="row">

            <div class="col-md-4 profile_col">
                <? include_once "profile-sidebar.php" ?>
            </div>

            <div class="col-md-8 profile_col">
                <?
                if (isset($_GET['address']))
                    include_once "profile-address.php";
                else if(isset($_GET['edit']))
                    include_once "profile-edit.php";
                else if(isset($_GET['wallet']))
                    include_once "profile-wallet.php";
                else if(isset($_GET['wallet-increase']))
                    include_once "wallet-increase.php";
                else if(isset($_GET['transactions']))
                    include_once "profile-transactions.php";
                else if(isset($_GET['wallet-withdraw']))
                    include_once "wallet-withdraw.php";
                else if(isset($_GET['carts']))
                    include_once "profile-carts.php";
                else if(isset($_GET['add-cart']))
                    include_once "add-cart.php";
                else if(isset($_GET['package']))
                    include_once "package.php";
                else
                   include_once "profile-edit.php";
                ?>
            </div>

        </div>
    </div>

</main>

<? include_once "footer.php" ?>

