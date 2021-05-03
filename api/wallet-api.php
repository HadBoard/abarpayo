<? 
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

if(isset($_GET['f'])) {

    if($_GET['f'] == "w") {
        
        $user_id = $_GET['u'];
        $amount = $_GET['a'];
        $token = $_GET['t'];
     
        $_SESSION['user_id'] = $user_id;
        $_SESSION['amount'] = $amount;
        $_SESSION['app'] = true;
        
        $result = $action->app_token_list($user_id);
        $row = $result->fetch_object();
    
        if($token == $row->token){
            $action->app_token_remove($row->id);
            echo "<script type='text/javascript'>window.location.href = 'http://abarpayo.com/abarpayo/wallet-request.php';</script>";
        }else{
            echo "<script type='text/javascript'>window.location.href = 'http://abarpayo.com/abarpayo/index.php';</script>"; 
        }
       
    }
}