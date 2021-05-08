<? require_once "functions/database.php";

$database = new DB();
$connection = $database->connect();
$action = new Action();

// ----------- urls ----------------------------------------------------------------------------------------------------
// main url for remove , change status
$list_url = "admin-list.php";
// ----------- urls ----------------------------------------------------------------------------------------------------

// ----------- get data ------------------------------------------------------------------------------------------------
$counter = 1;
$result = $action->guild_list();
// ----------- get data ------------------------------------------------------------------------------------------------

// ----------- start html :) ------------------------------------------------------------------------------------------
include('header.php'); ?>

    <div class="page-wrapper">

        <div class="row page-titles">
            <!-- ----------- start breadcrumb ---------------------------------------------------------------------- -->
            <div class="col-md-12 align-self-center text-right">
                <h3 class="text-primary">مدیران</h3></div>
            <div class="col-md-12 align-self-center text-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="panel.php">
                            <i class="fa fa-dashboard"></i>
                            خانه
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">مدیران</a></li>
                </ol>
            </div>
            <!-- ----------- end breadcrumb ------------------------------------------------------------------------ -->

        </div>

        <div class="container-fluid">

            <!-- ----------- start row of table -------------------------------------------------------------------- -->
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive m-t-5">
                                <table id="example23" class="display nowrap table table-hover table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ردیف</th>
                                        <th class="text-center">نام</th>
                                        <th class="text-center">نام خانوادگی</th>
                                        <th class="text-center">نام کاربری</th>
                                        <th class="text-center">آخرین بازدید</th>
                                       
                                    </tr>
                                    </thead>

                                    <tbody class="text-center">
                                    <? while ($row = $result->fetch_object()) { ?>
                                        <tr class="text-center">

                                            <td class="text-center"><?= $counter++ ?></td>
                                            <td class="text-center"><?= $row->first_name ?></td>
                                            <td class="text-center"><?= $row->last_name ?></td>
                                            <td class="text-center"><?= $row->username ?></td>

                                           
                                            <td class="text-center">
                                                <?= ($row->last_login) ? $action->time_to_shamsi($row->last_login) : "عدم ورود" ?>
                                            </td>
                                        </tr>
                                    <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ----------- end row of table ---------------------------------------------------------------------- -->

        </div>
    </div>

<? include('footer.php'); ?>