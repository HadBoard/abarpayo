<?
require_once "functions/database.php";
$action = new Action();
$title = "ابر پایو";
include_once "header.php";
?>
<?
    if($action->user()){
        $result = $action->user_log_list();
    }else if($action->marketer()){
        $result = $action->marketer_log_list();
    }

    $count = 0;
?>
  <!-- notifiction -->
    <section class="container">

        <div class="container">
    
            <div class="shop_list_header">
                  <div class="cat_shop">
                      <h3>اعلانات</h3>
                  </div>
            </div>
        </div>

        <div class="container">
            <div class="notif_table">
                <table>
                    <tr>
                        <td >ردیف</td>
                        <td>متن اعلان</td>
                        <td>تاریخ</td>
                        <td>حذف همه</td>
                    </tr>
                    <?while($row = $result->fetch_object()){ ?>
                    <tr>
                        <td><?= $count?></td>
                        <td> <?= $action->action_log_get($row->id)?> </td>
                        <td><?= $action->time_to_shamsi($row->created_at)?></td>
                        <td><button class="delete_row"><i class="fa fa-trash-o"></i></button></td>
                    </tr>
                    <?}?>
                </table>
            </div>
        </div>
    </section>
    <? include_once "footer.php" ?>