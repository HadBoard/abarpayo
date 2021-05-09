<style>
    .panel-group .panel{
    background-color: #fff;
    border:none;
    box-shadow:none;
    border-radius: 10px;
    margin-bottom:11px;
}
.panel .panel-heading{
    padding: 0;
    border-radius:10px;
    border: none;
}
.panel-heading a{
    color:#fff !important;
    display: block;
    border:none;
    padding:13px 35px 15px;
    font-size: 17px;
    background-image:linear-gradient(99deg, rgb(255, 142, 10) 8%, rgb(253, 118, 0) 90%);
    font-weight:600;
    position: relative;
    color:#fff;
    box-shadow:none;
    transition:all 0.1s ease 0;
}
.panel-heading a:after, .panel-heading a.collapsed:after{
    content: "\f068";
    font-family: fontawesome;
    text-align: center;
    position: absolute;
    left:-20px;
    top: 10px;
    color:#fff;
    background-color:rgb(236, 87, 102);
    border: 5px solid #fff;
    font-size: 15px;
    width: 40px;
    height:40px;
    line-height: 30px;
    border-radius: 50%;
    transition:all 0.3s ease 0s;
}
.panel-heading:hover a:after,
.panel-heading:hover a.collapsed:after{
    transform:rotate(360deg);
}
.panel-heading a.collapsed:after{
    content: "\f067";
}
#accordion .panel-body{
    background-color:#Fff;
    color:#8C8C8C;
    line-height: 25px;
    padding: 10px 25px 20px 35px ;
    border-top:none;
    font-size:14px;
    position: relative;
}
.questions {
    width: 85%;
    margin: auto;
    display: table;
    margin: 52px auto;
}

.panel-heading a:focus ,.panel-heading a:hover {
    text-decoration: none;
}
.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 16px;
    color: inherit;
}
.collapse.in {
    display: block;
}
.panel-default > .panel-heading {
    color: #333;
    background-color: #f5f5f5;
    border-color: #ddd;
}
.collapse {
    display: none;
}
.fade {
	 opacity: 0;
}
 .fade.in {
	 opacity: 1;
}
 .collapse {
	 display: none;
}
 .collapse.in {
	 display: block;
}
 tr.collapse.in {
	 display: table-row;
}
 tbody.collapse.in {
	 display: table-row-group;
}
 .collapsing {
	 position: relative;
	 height: 0;
	 overflow: hidden;
}
.questions_profile .panel-heading a {
    background-image: linear-gradient(45deg , rgb(226, 226, 226), #bbb);
}

.questions_profile .panel-heading a::after, .questions_profile .panel-heading a.collapsed::after {
    background: var(--yellow_a);
}
.pq_title {
    margin-bottom: 20px;
}
</style>
<?

$messages = $action->message_list($id);
$support_id = $action->marketer_get($id)->support_id;

$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}
 
if(isset($_POST['submit'])){
    $text = $action->request('text');
    $command= $action->message_add($id,$support_id,$parent,$text,$status);
    if ($command) {
        $_SESSION['error'] = 0;
    } else {
        $_SESSION['error'] = 1;
    }

    echo '<script>window.location="?communicate"</script>';
}
?>

<div class="edit_profile_div">

    <div class="profile_header">
        <div class="profile_heade_inn">
            <div class="profile_header_img_2"><img src="assets/images/call.png"></div></div>
            
    </div>
    <div class="row profile_title">
        <!-- <a class="profile_title_icon"><img src="assets/images/006-right-arrow.svg"></a> -->
    
        <h3 style="width: 50%;float: right;">ارتباط با حامی</h3>

        <img src="assets/images/Group 523@2x.png">
        
    </div>
    <div class="profile_left profile_left2" style="padding-top: 0;">
        <div class="questions_profile">
            <div class="container">
                <h4 class="pq_title">سوالات</h4>
                <div class="row">
                    <div class="">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <?
                              while ($row = $messages->fetch_object()) { 
                                $message_replys = $action->message_reply_list($row->id);
                                $reply = $message_replys->fetch_object();
                            ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading<?= $row->id?>">
                                        <h4 class="panel-title">
                                            <a class="first" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $row->id ?>" aria-expanded="false" aria-controls="collapse<?= $row->id ?>">
                                                <?= $row->text ?>
                                                <span> </span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?= $row->id ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?= $row->id?>">
                                        <div class="panel-body">
                                        <p><?= $reply->text ?></p>
                                         </div>
                                    </div>
                                </div>
                            <?if($row->status == 1){$action->setMessageView($row->id);} } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <form  action="" method="post">
            <h4 class="pq_title">سوال جدید بپرسید</h4>
            <div class="form-group">
                <label for="text">متن سوال</label>
                <textarea name="text"></textarea>
            </div>
            <input name="submit" type="submit" class="main_btn" value="ارسال ">
            
        </form>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript"  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<??>