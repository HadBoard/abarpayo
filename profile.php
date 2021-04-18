<?
require_once "functions/database.php";
$action = new Action();
$title = "پروفایل";
if(!$action->auth()){
    header("Location: phone.php");
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
                else
                    include_once "profile-edit.php";
                ?>
            </div>

        </div>
    </div>

</main>

<? include_once "footer.php" ?>

