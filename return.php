<?
   session_start();
    if($_SESSION['app-wallet'] == 'success'){
        ?>
        <input style="margin:auto; vertical-align:middle;" type="button" onclick="location.href='https://abarpayo.com/site/app/wallet/success';" value="بازگشت یه برنامه" />
        <?
    }else if($_SESSION['app-wallet'] == 'fail'){
        ?>
            <input style="margin:auto; vertical-align:middle;" type="button" onclick="location.href='https://abarpayo.com/site/app/wallet/fail';" value="بازگشت یه برنامه" />
        <?
    }else if($_SESSION['app-wallet'] == 'cancel'){
        ?>
            <input style="margin:auto; vertical-align:middle;" type="button" onclick="location.href='https://abarpayo.com/site/app/wallet/cancel';" value="بازگشت یه برنامه" />
        <?
    }

?>

