<?
require_once "functions/database.php";
$action = new Action();
$title = "اعلانات";
include_once "header.php";
?>
<?
    if($action->user()){
        $result = $action->user_log_list();
        $id = $action->user()->id;
        $type = 1;
    }else if($action->marketer()){
        $result = $action->marketer_log_list();
        $id = $action->marketer()->id;
        $type = 0;
    }

    $count = 0;

    if(isset($_POST['delete_row'])){
        $delete_id = $action->request('delete_item');
        $command = $action->change_view($delete_id,$type);
        if($command){
            echo '<script>window.location="notification.php"</script>';
        }
    }

    if(isset($_POST['delete_all'])){
        $command = $action->change_view_all($id,$type);
        if($command){
            echo '<script>window.location="notification.php"</script>';
        }
    }

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
        <?if($result->num_rows > 0 ){?>
            <form action="" method="post">
            <button name="delete_all" type="submit" class="main_btn middle_btn notif_all_btn">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        حذف همه
            </button>
            </form>
        <?}?>
            <div class="notif_table">
                <table>
                    <tr>
                        <td >ردیف</td>
                        <td>متن اعلان</td>
                        <td>تاریخ</td>
                        <td>حذف </td>
                    </tr>
                    <?while($row = $result->fetch_object()){ ?>
                    <tr>
                        <td><?= ++$count ?></td>
                        <td><?= $action->action_log_get($row->id)->text?> </td>
                        <td><?= $action->time_to_shamsi($row->created_at)?></td>
                        <td>
                            <form action="" method="post">
                            <input type="hidden" name="delete_item" value="<?= $row->id ?>">
                            <button type="submit" name="delete_row" class="delete_row"><i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?}?>
                </table>
            </div>
        </div>
    </section>
    <? include_once "footer.php" ?>