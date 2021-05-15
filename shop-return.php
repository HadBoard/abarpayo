<?
    require_once "functions/database.php";
    $action = new Action();
   $id = $action->request('id');
   $title = $action->shop_get($id)->title;

    if($_SESSION['app-wallet'] == 'success'){
        ?>
        <input style="margin:auto; vertical-align:middle;" type="button" onclick="location.href='https://abarpayo.com/abarpayo/app/shop/<?=$title?>/success';" value="بازگشت یه برنامه" />
        <?
    }else if($_SESSION['app-wallet'] == 'fail'){
        ?>
            <input style="margin:auto; vertical-align:middle;" type="button" onclick="location.href='https://abarpayo.com/abarpayo/app/shop/<?= $title?>/fail';" value="بازگشت یه برنامه" />
        <?
    }else if($_SESSION['app-wallet'] == 'cancel'){
        ?>
            <input style="margin:auto; vertical-align:middle;" type="button" onclick="location.href='https://abarpayo.com/abarpayo/app/shop/<?= $title ?>/cancel';" value="بازگشت یه برنامه" />
        <?
    }

?>