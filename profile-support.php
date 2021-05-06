<?

$messages = $action->supporter_message_list($id);

$error = false;
if (isset($_SESSION['error'])) {
    $error = true;
    $error_val = $_SESSION['error'];
    unset($_SESSION['error']);
}
// GET PARENT ?????????????????
if(isset($_POST['submit'])){
    $text = $action->request('text');
    $command= $action->message_add($user_id,$parent,$text,$status);
    $command1 = $action->message_status($parent);
    if ($command) {
        $_SESSION['error'] = 0;
    } else {
        $_SESSION['error'] = 1;
    }

    echo '<script>window.location="?support"</script>';
}
?>

<? if ($error) {
if ($error_val) { ?>

        <div class="modal">
        <div class="alert alert-fail">
            <span class="close_alart">×</span>
            <p>
                عملیات ناموفق بود!
            </p>
        </div>
    </div>
    <script src="assets/js/alert.js"></script>
    
<? } else { ?>
    <div class="modal">
        <div class="alert alert-suc">
            <span class="close_alart">×</span>
            <p>
                عملیات موفق بود!
            </p>
        </div>
    </div>
    <script src="assets/js/alert.js"></script>
    
<? }
} ?>
