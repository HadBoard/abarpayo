<? 
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

if(isset($_GET['function'])) {

    if($_GET['function'] == "wallet") {
        
        $user_id = $_GET['user_id'];
        $amount = $_GET['amount'];
        $token = $_GET['token'];
     
        $_SESSION['user_id'] = $user_id;
        $_SESSION['amount'] = $amount;
        $_SESSION['app'] = true;
        
        $result = $action->app_token_list($user_id);
        $row = $result->fetch_object();
    
        if($token == $row->token){
            $action->app_token_remove($row->id);
            echo "<script type='text/javascript'>window.location.href = 'http://abarpayo.com/site/wallet-request.php';</script>";
        }else{
            echo "<script type='text/javascript'>window.location.href = 'http://abarpayo.com/site/index.php';</script>"; 
        }
       
    }
}