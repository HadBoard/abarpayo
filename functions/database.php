<?
// ----------- start config methods ------------------------------------------------------------------------------------
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

session_start();
include('admin/functions/jdf.php');
date_default_timezone_set("Asia/Tehran");
// ----------- end config methods --------------------------------------------------------------------------------------

// ----------- start DB class ------------------------------------------------------------------------------------------
class DB
{

    // ----------- properties
    protected $_DB_HOST = 'localhost';
    protected $_DB_USER = 'root';
    protected $_DB_PASS = '';
    protected $_DB_NAME = 'hamitech';
    protected $connection;

    // ----------- constructor
    public function __construct()
    {
        $this->connection = mysqli_connect($this->_DB_HOST, $this->_DB_USER, $this->_DB_PASS, $this->_DB_NAME);
        if ($this->connection) {
            $this->connection->query("SET NAMES 'utf8'");
            $this->connection->query("SET CHARACTER SET 'utf8'");
            $this->connection->query("SET character_setconnectionection = 'utf8'");
        }
    }

    // ----------- for return connection
    public function connect()
    {
        return $this->connection;
    }

}

// ----------- end DB class --------------------------------------------------------------------------------------------

// ----------- start Action class --------------------------------------------------------------------------------------
class Action
{

    // ----------- properties
    public $connection;
    //public $city = 426;
    // ----------- constructor
    public function __construct()
    {
        $db = new DB();
        $this->connection = $db->connect();
        
    }

    // ----------- start main methods ----------------------------------------------------------------------------------

    // ----------- for check result of query
    public function result($result)
    {
        if (!$result) {
            $errorno = mysqli_errno($this->connection);
            $error = mysqli_error($this->connection);
            echo "Error NO : $errorno";
            echo "<br>";
            echo "Error Message : $error";
            echo "<hr>";
            return false;
        }
        return true;
    }

    // ----------- count of table's field
    public function table_counter($table)
    {
        $result = $this->connection->query("SELECT * FROM `$table` ");
        if (!$this->result($result)) return false;
        return $result->num_rows;
    }

    // ----------- get all fields in table
    public function table_list($table)
    {
        $result = $this->connection->query("SELECT * FROM `$table` ORDER BY `id` DESC");
        if (!$this->result($result)) return false;
        return $result;
    }

    // ----------- get all fields in table other than one :)
    public function table_option($table, $id)
    {
        $id = $this->admin()->id;
        $result = $this->connection->query("SELECT * FROM `$table` WHERE NOT `id`='$id' ORDER BY `id` DESC");
        if (!$this->result($result)) return false;
        return $result;
    }

    // ----------- change status of field
    public function change_status($table, $id)
    {
        $status = $this->get_data($table, $id)->status;
        $status = !$status;

        $now = time();
        $result = $this->connection->query("UPDATE `$table` SET 
        `status`='$status',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    // ----------- get data from table
    public function get_data($table, $id)
    {
        $result = $this->connection->query("SELECT * FROM `$table` WHERE id='$id'");
        if (!$this->result($result)) return false;
        $row = $result->fetch_object();
        return $row;
    }

    // ----------- remove data from table
    public function remove_data($table, $id)
    {
        $result = $this->connection->query("DELETE FROM `$table` WHERE id='$id'");
        if (!$this->result($result)) return false;
        return true;
    }

    // ----------- clean strings (to prevent sql injection attacks)
    public function clean($string, $status = true)
    {
        if ($status)
            $string = htmlspecialchars($string);
        $string = stripslashes($string);
        $string = strip_tags($string);
        $string = mysqli_real_escape_string($this->connection, $string);
        return $string;
    }

    // ----------- for clean and get requests
    public function request($name, $status = true)
    {
        return $this->clean($_REQUEST[$name], $status);
    }

    // ----------- for get and convert date
    public function request_date($name)
    {
        $name = $this->request('birthday', false);
        if(!$name) return 0;
        $name = $this->shamsi_to_miladi($name);
        return strtotime($name);
    }

    // ----------- convert timestamp to shamsi date
    public function time_to_shamsi($timestamp)
    {
        return $this->miladi_to_shamsi(date('Y-m-d', $timestamp));
    }

    // ----------- convert shamsi date to miladi date
    public function shamsi_to_miladi($date)
    {
        $pieces = explode("/", $date);
        $day = $pieces[2];
        $month = $pieces[1];
        $year = $pieces[0];
        $b = jalali_to_gregorian($year, $month, $day, $mod = '-');
        $f = $b[0] . '-' . $b[1] . '-' . $b[2];
        return $f;
    }

    // ----------- convert miladi date to shamsi date
    public function miladi_to_shamsi($date)
    {
        $pieces = explode("-", $date);
        $year = $pieces[0];
        $month = $pieces[1];
        $day = $pieces[2];
        $b = gregorian_to_jalali($year, $month, $day, $mod = '-');
        $f = $b[0] . '/' . $b[1] . '/' . $b[2];
        return $f;
    }

    // ----------- for send sms to mobile number
   
    public function send_sms($mobile,$textMessage){
	    
		$webServiceURL  = "http://login.parsgreen.com/Api/SendSMS.asmx?WSDL";  
		$webServiceSignature = "86D08235-C008-4C53-8EEA-CE2284FD66F4";  

		 $textMessage= mb_convert_encoding($textMessage,"UTF-8"); // encoding to utf-8
		

		     $parameters['signature'] = $webServiceSignature;
		     $parameters['toMobile' ]  = $mobile;
		     $parameters['smsBody' ]=$textMessage;
		     $parameters[ 'retStr'] = ""; // return refrence send status and mobile and report code for delivery
		  
		 
		try 
		{
		    $con = new SoapClient($webServiceURL);  

		    $responseSTD = (array) $con ->Send($parameters); 
		 
		    $responseSTD['retStr'] = (array) $responseSTD['retStr'];
		    
		 
		}
		catch (SoapFault $ex) 
		{
		    echo $ex->faultstring;  
		}

	}

    // ----------- create random token
    public function get_token($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet);
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[rand(0, $max - 1)];
        }
        return $token;
    }

    // ----------- end main methods ------------------------------------------------------------------------------------

    // ----------- start USERS ----------------------------------------------------------------------------------------
    // ----------- for login admin
    public function user_login($user, $pass)
    {
        $result = $this->connection->query("SELECT * FROM `tbl_user` WHERE `username`='$user' AND status=1");
        if (!$this->result($result)) return false;
        $rowcount = mysqli_num_rows($result);
        $row = $result->fetch_object();
        if ($rowcount) {
            $this->user_update_last_login();
            $_SESSION['user_id'] = $row->id;
            $this->log_action(1,0);
            return true;
        }
        return false;
    }

    // ----------- for check access (admin access)
    public function auth()
    {
        if (isset($_SESSION['user_id']) || isset($_SESSION['marketer_id']))
            return true;
        return false;
    }

    // ----------- for check access (guest access)
    public function guest()
    {
        if (isset($_SESSION['user_id']) || isset($_SESSION['marketer_id']))
            return false;
        return true;
    }

    // ----------- update last login of admin (logged)
    public function user_update_last_login()
    {
        $id = $this->user()->id;
        $now = strtotime(date('Y-m-d H:i:s'));
        $result = $this->connection->query("UPDATE `tbl_user_id` SET `last_login`='$now' WHERE `id`='$id'");
        if (!$this->result($result)) return false;
        return true;
    }

    // ----------- update profile (logged admin)
    public function profile_edit($first_name, $last_name, $phone, $password)
    {
        $id = $this->admin()->id;
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_admin` SET 
        `first_name`='$first_name',
        `last_name`='$last_name',
        `phone`='$phone',
        `password`='$password',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        $this->log_action(2,0);
        return $id;
    }

    // ----------- get admin's data
    public function user_get($id)
    {
        return $this->get_data("tbl_user", $id);
    }

    // ----------- get admin's data (logged)
    public function user()
    {
        $id = $_SESSION['user_id'];
        return $this->user_get($id);
    }

    public function marketer()
    {
        $id = $_SESSION['marketer_id'];
        return $this->marketer_get($id);
    }

    public function marketer_get($id)
    {
        return $this->get_data("tbl_marketer", $id);
    }

    public function hasUnpaidPackage($marketer_id){
        return $this->marketer_get($marketer_id)->payment_type == 2 && $this->marketer_get($marketer_id)->payment_id == 0;
        
    }
    public function user_get_phone($phone){
        return $this->connection->query("SELECT * FROM `tbl_user` WHERE `phone` = '$phone'");
    }
    public function user_get_payment(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_payment` WHERE `user_id` = '$id'");
    }

    public function app_get_payment($id){
        return $this->connection->query("SELECT * FROM `tbl_payment` WHERE `user_id` = '$id'");
    }

    public function payment_get_action($payment_id){
        return $this->connection->query("SELECT * FROM `tbl_wallet_log` WHERE `payment_id` = '$payment_id'");
    }

    public function score_log_add($id,$score,$action,$type){
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_score_log`
        (`user_id`,`score`,`action`,`type`,`created_at`) 
        VALUES
        ('$id','$score','$action','$type','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function score_edit($id,$amount,$type){
        $prev_score = $this->user_get($id)->score;
        if($type == 1){
            $score = $prev_score + $amount;
        }else if($type == 0){
            $score = $prev_score - $amount;
        }
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user` SET 
        `score` = '$score',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }
    
    public function marketer_score_log_add($id,$score,$action,$type){
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_marketer_score_log`
        (`marketer_id`,`score`,`action`,`type`,`created_at`) 
        VALUES
        ('$id','$score','$action','$type','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function marketer_score_edit($id,$amount,$type){
        $prev_score = $this->marketer_get($id)->score;
        if($type == 1){
            $score = $prev_score + $amount;
        }else if($type == 0){
            $score = $prev_score - $amount;
        }
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_marketer` SET 
        `score` = '$score',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function score_logs_list($id){
        return $this->connection->query("SELECT * FROM `tbl_score_log` WHERE `user_id` = '$id'");
    }

    public function marketer_score_logs_list($id){
        return $this->connection->query("SELECT * FROM `tbl_marketer_score_log` WHERE `marketer_id` = '$id'");
    }

    public function marketer_payment_get_action($payment_id){
        return $this->connection->query("SELECT * FROM `tbl_marketer_wallet_log` WHERE `payment_id` = '$payment_id'");
    }

    public function user_get_payment_limited(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_payment` WHERE `user_id` = '$id' LIMIT 2");
    }

    public function marketer_get_payment_limited($id){
        return $this->connection->query("SELECT * FROM `tbl_marketer_payment` WHERE `marketer_id` = '$id' LIMIT 2");
    }

    public function marketer_get_payment($id){
        return $this->connection->query("SELECT * FROM `tbl_marketer_payment` WHERE `marketer_id` = '$id'");
    }

    public function user_get_requests(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_request` WHERE `user_id` = '$id' AND `status` = 1");
    }

    public function app_get_requests($user_id){
        return $this->connection->query("SELECT * FROM `tbl_request` WHERE `user_id` = '$user_id' AND `status` = 1 ORDER BY id DESC");
    }

    public function user_get_requests_limited(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_request` WHERE `user_id` = '$id' AND `status` = 1 LIMIT 2");
    }

    public function marketer_get_requests_limited(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_marketer_request` WHERE `marketer_id` = '$id' AND `status` = 1 LIMIT 2");
    }

    public function marketer_get_requests(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_marketer_request` WHERE `marketer_id` = '$id' AND `status` = 1");
    }

    public function user_add($first_name,$last_name,$phone,$reference_id,$platform)
    {
        $now = time();
        $reference_code = $this->get_token(6);
        $result = $this->connection->query("INSERT INTO `tbl_user`
        (`first_name`,`last_name`,`phone`,`reference_code`,`reference_id`,`platform`,`created_at`) 
        VALUES
        ('$first_name','$last_name','$phone','$reference_code','$reference_id','$platform','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function user_profile_edit($first_name, $last_name,$national_code,$birthday,$icon)
    {
        $id = $this->user()->id;
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user` SET 
        `first_name`='$first_name',
        `last_name`='$last_name',
        `national_code`='$national_code',
        `birthday` = '$birthday',
        `profile`='$icon',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function user_invitations_list($id){
        return $this->connection->query("SELECT * FROM `tbl_user` WHERE `reference_id` = '$id'");
    }

    public function app_profile_edit($user_id,$first_name, $last_name,$national_code,$birthday,$address,$postal_code,$city_id)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user` SET 
        `first_name`='$first_name',
        `last_name`='$last_name',
        `national_code`='$national_code',
        `birthday` = '$birthday',
        `address`='$address',
        `postal_code` = '$postal_code',
        `city_id` = '$city_id',
        `updated_at`='$now'
        WHERE `id` ='$user_id'");
        if (!$this->result($result)) return false;
        return $user_id;
    }



    public function user_phone_edit($first_name,$last_name,$national_code,$phone,$birthday)
    {
        $id = $this->user()->id;
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user` SET 
        `first_name`='$first_name',
        `last_name`='$last_name',
        `national_code`='$national_code',
        `phone`='$phone',
        `birthday` = '$birthday',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }
    public function marketer_address_edit($id,$city_id,$postal_code,$address)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_marketer` SET 
        `postal_code`='$postal_code',
        `address`='$address',
        `city_id` = '$city_id',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function user_address_edit($city_id,$postal_code,$address)
    {
        $id = $this->user()->id;
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user` SET 
        `postal_code`='$postal_code',
        `address`='$address',
        `city_id` = '$city_id',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function cart_add($bank_id,$title,$cart_number,$account_number,$iban,$validation)
    {
        $user_id = $this->user()->id; 
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_user_cart`
        (`user_id`,`bank_id`,`title`,`cart_number`,`account_number`,`iban`,`validation`,`created_at`) 
        VALUES
        ('$user_id','$bank_id','$title','$cart_number','$account_number','$iban','$validation','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function marketer_cart_add($id,$bank_id,$title,$cart_number,$account_number,$iban,$validation)
    { 
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_marketer_cart`
        (`marketer_id`,`bank_id`,`title`,`cart_number`,`account_number`,`iban`,`validation`,`created_at`) 
        VALUES
        ('$id','$bank_id','$title','$cart_number','$account_number','$iban','$validation','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function app_cart_add($user_id,$bank_id,$title,$cart_number,$account_number,$iban,$validation)
    {
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_user_cart`
        (`user_id`,`bank_id`,`title`,`cart_number`,`account_number`,`iban`,`validation`,`created_at`) 
        VALUES
        ('$user_id','$bank_id','$title','$cart_number','$account_number','$iban','$validation','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function cart_edit($id,$bank_id,$title,$cart_number,$account_number,$iban,$validation)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user_cart` SET 
        `bank_id` = '$bank_id',
        `title`='$title',
        `cart_number`='$cart_number',
        `account_number`='$account_number',
        `iban`='$iban',
        `validation`='$validation',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function marketer_cart_edit($cart_id,$bank_id,$name,$cart_number,$account_number,$iban,$validation)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_marketer_cart` SET 
        `bank_id` = '$bank_id',
        `title`='$name',
        `cart_number`='$cart_number',
        `account_number`='$account_number',
        `iban`='$iban',
        `validation`='$validation',
        `updated_at`='$now'
        WHERE `id` ='$cart_id'");
        if (!$this->result($result)) return false;
        return $cart_id;
    }

    public function admin_get($id)
    {
        return $this->get_data("tbl_admin", $id);
    }

    public function cart_get($id)
    {
        return $this->get_data("tbl_user_cart", $id);
    }

    public function marketer_cart_get($id)
    {
        return $this->get_data("tbl_marketer_cart", $id);
    }

    public function user_cart_list(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_user_cart` WHERE `user_id` = '$id'");
    }

    public function user_get_cart_limited(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_user_cart` WHERE `user_id` = '$id' LIMIT 2");
    }

    public function marketer_get_cart_limited($id){
        return $this->connection->query("SELECT * FROM `tbl_marketer_cart` WHERE `marketer_id` = '$id' LIMIT 2");
    }

    public function user_get_cart(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_user_cart` WHERE `user_id` = '$id'");
    }

    public function marketer_cart_list($id){
        return $this->connection->query("SELECT * FROM `tbl_marketer_cart` WHERE `marketer_id` = '$id'");
    }

    public function user_reference_code($reference_code){
        return $this->connection->query("SELECT * FROM `tbl_user` WHERE `reference_code` = '$reference_code'");
    }

    public function user_wallet_edit($amount,$type){
        $id = $this->user()->id;
        $prev_wallet = $this->user_get($id)->wallet;
        if($type == 1){
            $wallet = $prev_wallet + $amount;
        }else if($type == 0){
            $wallet = $prev_wallet - $amount;
        }
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user` SET 
        `wallet` = '$wallet',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;

    }

    public function marketer_wallet_edit($id,$amount,$type){
        $prev_wallet = $this->marketer_get($id)->wallet;
        if($type == 1){
            $wallet = $prev_wallet + $amount;
        }else if($type == 0){
            $wallet = $prev_wallet - $amount;
        }
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_marketer` SET 
        `wallet` = '$wallet',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;

    }

    public function app_user_wallet_edit($id,$amount,$type){
        $prev_wallet = $this->user_get($id)->wallet;
        if($type == 1){
            $wallet = $prev_wallet + $amount;
        }else if($type == 0){
            $wallet = $prev_wallet - $amount;
        }
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user` SET 
        `wallet` = '$wallet',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;

    }


    // ----------- end USERS ------------------------------------------------------------------------------------------
    // MESSAGES----------------------------------------------------------------------------------------------------------------------------
    
    public function message_add($from_id,$to_id,$parent,$text,$status){
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_message`
        (`from_id`,`to_id`,`parent`,`text`,`status`,`created_at`) 
        VALUES
        ('$from_id','$to_id','$parent','$text','$status','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function message_status($id){
        $result = $this->connection->query("UPDATE `tbl_message` SET 
        `status`= 1
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function supporter_message_list($id){
 
        return $this->connection->query("SELECT * FROM `tbl_message` WHERE `to_id` = '$id' AND `parent` = 0"); 
    }

    public function message_list($from_id){
        return $this->connection->query("SELECT * FROM `tbl_message` WHERE `from_id` = '$from_id' AND `parent` = 0 "); 
    }

    public function message_reply_list($parent){
        return $this->connection->query("SELECT * FROM `tbl_message` WHERE `parent` = '$parent' "); 
    }

    public function ticket_replys($user_id){
        return $this->connection->query("SELECT * FROM `tbl_ticket` WHERE `user_id` = '$user_id' AND `admin_id` IS NOT NULL ");
    }

    public function new_message_counter($marketer_id){

        $from =$this->connection->query("SELECT * FROM `tbl_message` WHERE `from_id` = '$marketer_id' AND `user_view`='0' AND `status` = '1'");
        return $from->num_rows;
    }

    public function notification_counter($id,$isUser){
        if($isUser == 1){
            $result =$this->connection->query("SELECT * FROM `tbl_user_log` WHERE `user_id` = '$id' AND `view` = '0' ");
        }else{
            $result =$this->connection->query("SELECT * FROM `tbl_marketer_log` WHERE `marketer_id` = '$id' AND `view`='0'");
        }
        return $result->num_rows;
    }

    public function setMessageView($id){
        $result = $this->connection->query("UPDATE `tbl_message` SET 
        `user_view`= 1
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }
    
    // ----------- start VALIDATION_CODE ------------------------------------------------------------------------------------------
     public function validation_code_add($user_id,$phone, $code)
     {
         $now = time();
         $result = $this->connection->query("INSERT INTO `tbl_validation_code`
         (`user_id`,`phone`,`code`,`created_at`) 
         VALUES
         ('$user_id','$phone','$code','$now')");
         if (!$this->result($result)) return false;
         return $this->connection->insert_id;
     }
 
     public function validate_code($phone,$code){
         $dt = new DateTime("-3 minutes");
         $dt = $dt->format("Y-m-d h:i:s"); 
         $dt = strtotime($dt);
         return $this->connection->query("SELECT * FROM `tbl_validation_code` WHERE `code` = '$code' AND `phone` = '$phone' AND
            `created_at`> '$dt' ");
     }

     public function validation_code_remove($id)
    {
        return $this->remove_data("tbl_validation_code", $id);
    }
     
   // ----------- end VALIDATION_CODE ------------------------------------------------------------------------------------------
   
   // ----------- start CATEGORIES ------------------------------------------------------------------------------------------
    public function category_ordered_list(){
        return $this->connection->query("SELECT * FROM `tbl_category` ORDER BY ord ASC ");
    }
    public function category_ordered_list_limited(){
        return $this->connection->query("SELECT * FROM `tbl_category` ORDER BY ord ASC LIMIT 7 ");
    }

    public function category_get($id)
    {
        return $this->get_data("tbl_category", $id);
    }
    public function category_shops_list($category_id){
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `category_id` = '$category_id' ");
    }
    
    public function shop_pics_get($shop_id)
    {
        return $this->connection->query("SELECT * FROM `tbl_shop_pics` WHERE `shop_id` = '$shop_id'");
    }
    public function shop_search($title,$cur_index){
        if(isset($_SESSION['default_city'])){
            $city_id = $_SESSION['default_city'];
        }else{
            $city_id = 426;
        }
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `title` like '%".$title."%' AND `city_id` = '$city_id'  ORDER BY id LIMIT $cur_index,8 ");
    }

    public function advance_search($input,$category,$city,$cur_index){
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE  `category_id` = '$category' AND `city_id` = '$city' AND `title` like '%".$input."%' LIMIT $cur_index,8 ");
    }

    public function advance_search_not_city($input,$category,$cur_index){
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE  `category_id` = '$category' AND `title` like '%".$input."%' LIMIT $cur_index,8 ");
    }

    public function advance_search_not_input($city,$category,$cur_index){
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `category_id` = '$category' AND `city_id` = '$city' LIMIT $cur_index,8 ");
    }
    public function advance_search_not_category($input,$city,$cur_index){
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE  `city` = '$city' AND `title` like '%".$input."%' LIMIT $cur_index,8 ");
    }

    public function category_shops_list_limited($category_id){
        if(isset($_SESSION['default_city'])){
            $city_id = $_SESSION['default_city'];
        }else{
            $city_id = 426;
        }
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `category_id` = '$category_id'AND `city_id` = '$city_id' LIMIT 4 ");
    }
   
   // ----------- end CATEGORIES ------------------------------------------------------------------------------------------

    // ----------- start REQUEST ------------------------------------------------------------------------------------------
    public function request_add($cart_id,$amount){
        $user_id = $this->user()->id;
        $now  = time();
        $result = $this->connection->query("INSERT INTO `tbl_request`
        (`user_id`,`cart_id`,`amount`,`created_at`) 
        VALUES
        ('$user_id','$cart_id','$amount','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function marketer_request_add($id,$cart_id,$amount){
        $now  = time();
        $result = $this->connection->query("INSERT INTO `tbl_marketer_request`
        (`marketer_id`,`cart_id`,`amount`,`created_at`) 
        VALUES
        ('$id','$cart_id','$amount','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;

    }

    public function app_request_add($user_id,$cart,$amount){
        $now  = time();
        $result = $this->connection->query("INSERT INTO `tbl_request`
        (`user_id`,`cart_id`,`amount`,`created_at`) 
        VALUES
        ('$user_id','$cart','$amount','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function last_request($user_id){
        return $this->connection->query("SELECT * FROM `tbl_request` WHERE `user_id` = '$user_id' ORDER BY id DESC LIMIT 1");
    }
     // ----------- end REQUEST ------------------------------------------------------------------------------------------
    // ----------- start PROVINCE ------------------------------------------------------------------------------------------
    public function province_list()
    {
        return $this->table_list("tbl_province");
        // return $this->connection->query("SELECT * FROM `tbl_province` ORDER BY id DESC");

    }

    public function province_get($id)
    {
        return $this->get_data("tbl_province", $id);
    }

    public function city_list()
    {
        return $this->table_list("tbl_city");

    }

    public function province_city_list($province_id)
    {
    return $this->connection->query("SELECT * FROM `tbl_city` WHERE `province_id` = '$province_id' ORDER BY id DESC");
    }

    public function city_get($id)
    {
        return $this->get_data("tbl_city", $id);
    }

    public function shop_get($id)
    {
        return $this->get_data("tbl_shop", $id);
    }

    public function shop_request_get($id)
    {
        return $this->get_data("tbl_shop_request", $id);
    }


    public function shop_request_add($id,$category,$name,$owner,$address,$access){
        $now = time();
        $status = 0;
        $result = $this->connection->query("INSERT INTO `tbl_shop_request`
        (`user_id`,`category_id`,`title`,`owner`,`address`,`access`,`created_at`,`status`) 
        VALUES
        ('$id','$category','$name','$owner','$address','$access','$now','$status')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }


    // ----------- end PROVINCE ------------------------------------------------------------------------------------------

     // ----------- start SLIDER ------------------------------------------------------------------------------------------
    public function slider_get($id)
    {
        return $this->get_data("tbl_slider", $id);
    }

    public function slider_list()
    {
        return $this->connection->query("SELECT * FROM `tbl_slider` WHERE `status` = 1 ");
    }
    // ----------- end SLIDER ------------------------------------------------------------------------------------------
 
    // ----------- start WALLETlOG ------------------------------------------------------------------------------------------
    public function wallet_log_add($action,$amount,$type,$payment_id)
    {
        $user_id = $this->user()->id;
        $result = $this->connection->query("INSERT INTO `tbl_wallet_log`
        (`user_id`,`action`,`amount`,`type`,`payment_id`) 
        VALUES
        ('$user_id','$action','$amount','$type','$payment_id')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function marketer_wallet_log_add($marketer_id,$action,$amount,$type,$payment_id)
    {
        $result = $this->connection->query("INSERT INTO `tbl_marketer_wallet_log`
        (`marketer_id`,`action`,`amount`,`type`,`payment_id`) 
        VALUES
        ('$marketer_id','$action','$amount','$type','$payment_id')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function app_wallet_log_add($user_id,$action,$amount,$type,$payment_id)
    {
        $result = $this->connection->query("INSERT INTO `tbl_wallet_log`
        (`user_id`,`action`,`amount`,`type`,`payment_id`) 
        VALUES
        ('$user_id','$action','$amount','$type','$payment_id')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function wallet_log_increase($user_id){
        return $this->connection->query("SELECT * FROM `tbl_wallet_log` WHERE `user_id` = '$user_id' AND `type` = 1  ORDER BY id DESC");
    }

    public function wallet_log_get_payment($id){
        return $this->connection->query("SELECT * FROM `tbl_payment` WHERE `id` = '$id'");
    }


    // ----------- end WALLETLOG------------------------------------------------------------------------------------------

    // ----------- start PAYMENT ------------------------------------------------------------------------------------------
    public function payment_add($amount,$cart_number,$reference_code,$status)
    {
        $now = time();
        $user_id = $this->user()->id;
        $result = $this->connection->query("INSERT INTO `tbl_payment`
        (`user_id`,`amount`,`cart_number`,`refrence_code`,`date`,`status`) 
        VALUES
        ('$user_id','$amount','$cart_number','$reference_code','$now','$status')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function app_payment_add($user_id,$amount,$cart_number,$reference_code,$status)
    {
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_payment`
        (`user_id`,`amount`,`cart_number`,`refrence_code`,`date`,`status`) 
        VALUES
        ('$user_id','$amount','$cart_number','$reference_code','$now','$status')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function bank_list()
    {
        return $this->table_list("tbl_bank");
    }

    public function bank_get($id)
    {
        return $this->get_data("tbl_bank", $id);
    }

    public function lazyLoad($category_id,$cur_index){
        if(isset($_SESSION['default_city'])){
            $city_id = $_SESSION['default_city'];
        }else{
            //$city_id = $GLOBALS['city'];
            $city_id = 426;
        }
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `category_id` = '$category_id'AND `city_id` = '$city_id' ORDER BY id LIMIT $cur_index,8 ");
    }
    // ----------- end PAYMENT ------------------------------------------------------------------------------------------
    public function shop_comment_add($shop_id,$user_id,$text,$score){
        if($user_id == 0) return;
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_shop_comment`
        (`shop_id`,`user_id`,`parent`,`text`,`score`,`created_at`,`confirm`) 
        VALUES
        ('$shop_id','$user_id', 0 ,'$text','$score','$now',0 )");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function shop_comments_list($id){
        // $user_id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_shop_comment` WHERE `shop_id` = '$id' AND `confirm` = 1");
    }

    public function shop_comments_replys_list($comment_id){
        return $this->connection->query("SELECT * FROM `tbl_shop_comment` WHERE `parent` = '$comment_id' ");
        
    }

    public function marketer_get_phone($phone){
        return $this->connection->query("SELECT * FROM `tbl_marketer` WHERE `phone` = '$phone'");
    }

    public function marketer_add($first_name,$last_name,$phone,$package_id,$payment_type,$national_code,$reference_id,$support_id)
    {
        $now = time();
        $reference_code = $this->get_token(6);
        $result = $this->connection->query("INSERT INTO `tbl_marketer`
        (`first_name`,`last_name`,`phone`,`reference_code`,`reference_id`,`support_id`,`national_code`,`package_id`,`payment_type`,`created_at`,`status`) 
        VALUES
        ('$first_name','$last_name','$phone','$reference_code','$reference_id','$support_id','$national_code','$package_id','$payment_type','$now',0)");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    

    public function has_sub_marketer($id){
        $result =  $this->connection->query("SELECT * FROM `tbl_marketer` WHERE `support_id` = '$id' ");
        if($result->num_rows > 0) return true;
    }

    public function marketer_profile_edit($id,$first_name, $last_name,$national_code,$birthday,$icon){
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_marketer` SET 
        `first_name`= '$first_name',
        `last_name` = '$last_name',
        `national_code`= '$national_code',
        `birthday`= '$birthday',
        `profile`='$icon',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function marketer_change_status($id){
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_marketer` SET 
        `status` =  1,
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;

    }
    public function marketer_payment_add($marketer_id,$amount,$cart_number,$reference_code,$status){
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_marketer_payment`
        (`marketer_id`,`amount`,`cart_number`,`reference_code`,`date`,`status`) 
        VALUES
        ('$marketer_id','$amount','$cart_number','$reference_code','$now','$status')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }
    public function marketer_paymentid_add($marketer_id,$payment_id){
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_marketer` SET 
        `payment_id` = '$payment_id',
        `updated_at`='$now'
        WHERE `id` ='$marketer_id'");
        if (!$this->result($result)) return false;
        return $marketer_id;

    }
    public function marketer_reference_code($reference_code){
        return $this->connection->query("SELECT * FROM `tbl_marketer` WHERE `reference_code` = '$reference_code'");
    }

    public function marketer_invitations_list($id){
        return $this->connection->query("SELECT * FROM `tbl_marketer` WHERE `reference_id` = '$id'");
    }

    public function app_token_list($user_id){
        return $this->connection->query("SELECT * FROM `tbl_app_token` WHERE `user_id` = '$user_id'");
    }
    
    public function app_token_add($user_id,$token){
        $result = $this->connection->query("INSERT INTO `tbl_app_token`
        (`user_id`,`token`) 
        VALUES
        ('$user_id','$token')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }
    
    public function app_user_cart_list($id){
        return $this->connection->query("SELECT * FROM `tbl_user_cart` WHERE `user_id` = '$id'");
    }
    
    public function app_token_remove($id){
         return $this->remove_data("tbl_app_token", $id);
    }

    public function package_list()
    {
        return $this->table_list("tbl_package");
    }
    public function package_get($id)
    {
          return $this->get_data("tbl_package", $id);
    }

    public function category_list()
    {
        return $this->table_list("tbl_category");

    }

    public function get_system($key){
        $result = $this->connection->query("SELECT * FROM tbl_app WHERE `app_key` = '$key'");
        if (!$this->result($result)) return false;
        $row  = $result->fetch_object(); 
        return $row->value;
    }

   // question
   public function frequently_asked_question_list()
   {
       return $this->table_list("tbl_asked_question");
   }

   public function contact_add($name,$phone,$title,$description)
   {
    $now = time();
    $result = $this->connection->query("INSERT INTO `tbl_contact`
    (`fullname`,`phone`,`title`,`description`,`created_at`,`status`) 
    VALUES
    ('$name','$phone','$title','$description','$now',1)");
    if (!$this->result($result)) return false;
    return $this->connection->insert_id;
   }

   //VALIDATE CART-----------------------------------------------------------------------------------------
   
   public function iban_validate($code){
    $shaba=substr($code,2)."1827".$code[0].$code[1];
    return bcmod($shaba, '97');
}

public function iban_unique($iban,$isUser){
    if($isUser == 1){
        $result = $this->cart_list();
    }else{
        $result = $this->marketer_carts();
    }
    
    while($row = $result->fetch_object()){
        if($row->iban == $iban){
            return false;
        }
    }
   
    return true;
}

public function account_number_validate($account_number,$isUser){

    if($isUser == 1){
        $result = $this->cart_list();
    }else{
        $result = $this->marketer_carts();
    }
    
    while($row = $result->fetch_object()){
        if($row->account_number == $account_number){
            return false;
        }
    }

    return true;
    
}

public function cart_number_validate($cart_number,$isUser){

    if($isUser == 1){
        $result = $this->cart_list();
    }else{
        $result = $this->marketer_carts();
    }
    $result = $this->cart_list();
    while($row = $result->fetch_object()){
        if($row->cart_number == $cart_number){
            return false;
        }
    }

    $length = strlen($cart_number);

    if($length != 16){
        return false;
    }
    
    return true;
}

public function ticket_add($user_id,$title,$text,$type,$view,$status){
    $now = time();
    $result = $this->connection->query("INSERT INTO `tbl_ticket`
    (`user_id`,`subject`,`text`,`type`,`view`,`status`,`created_at`) 
    VALUES
    ('$user_id','$title','$text','$type','$view','$status','$now')");
    if (!$this->result($result)) return false;
    return $this->connection->insert_id;
}
// ----------- start log ----------------------------------------------------------------------------
public function log_action($action_id,$type){
    if($type==0){
        $this->user_log($action_id);
    }

    if($type==2){
        $this->marketer_log($action_id);
    }
   
}
public function user_log($action_id){
    $now = time();
    $user_id=$_SESSION['user_id'];
    $ip=$_SERVER['REMOTE_ADDER'];
    $result= $this->connection->query("INSERT INTO tbl_user_log (`user_id`,`action_id`,`ip`,`created_at`)VALUES('$user_id','$action_id','$ip','$now')");  
    if (!$this->result($result)) return false;
    return $this->connection->insert_id;
}


public function marketer_log($action_id){
    $now = time();
    $marketer_id=$_SESSION['marketer_id'];
    $ip=$_SERVER['REMOTE_ADDER'];
    $result= $this->connection->query("INSERT INTO tbl_marketer_log (`marketer_id`,`action_id`,`ip`,`created_at`)VALUES('$marketer_id','$action_id','$ip','$now')");  
    if (!$this->result($result)) return false;
    return $this->connection->insert_id;
}

public function user_log_list(){
    $user_id=$_SESSION['user_id'];
     return $this->connection->query("SELECT * FROM `tbl_user_log` WHERE `user_id` = '$user_id' AND `view`=0 ORDER BY `id` DESC");
}

public function marketer_log_list(){
    $marketer_id=$_SESSION['marketre_id'];
     return $this->connection->query("SELECT * FROM `tbl_marketer_log` WHERE `marketer_id` = '$marketer_id' AND `view`=0 ORDER BY `id` DESC");
}

public function action_log_get($id){
    return $this->get_data("tbl_action_log", $id);
}
public function change_view($id,$type){
    if($type==0){
        $result= $this->connection->query("UPDATE tbl_user_log SET `view`='1' WHERE id='$id'");  
        if (!$this->result($result)) return false;
        return true;
    }
    if($type==2){
        $result= $this->connection->query("UPDATE tbl_marketer_log SET `view`='1'WHERE id='$id'");  
        if (!$this->result($result)) return false;
        return true;
    }  
}



// ----------- end log ----------------------------------------------------------------------------



}

// ----------- end Action class ----------------------------------------------------------------------------------------


