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
        // $id = $this->admin()->id;
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

    public function user_get_payment_limited(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_payment` WHERE `user_id` = '$id' LIMIT 2");
    }

    public function user_get_requests(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_request` WHERE `user_id` = '$id' AND `status` = 1");
    }

    public function app_get_requests($user_id){
        return $this->connection->query("SELECT * FROM `tbl_request` WHERE `user_id` = '$user_id' AND `status` = 1");
    }

    public function user_get_requests_limited(){
        $id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_request` WHERE `user_id` = '$id' AND `status` = 1 LIMIT 2");
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

    public function marketer_cart_add($id,$bank_id,$name,$cart_number,$account_number,$iban,$validation)
    {
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_marketer_cart`
        (`marketer_id`,`bank_id`,`title`,`cart_number`,`account_number`,`iban`,`validation`,`created_at`) 
        VALUES
        ('$id','$bank_id','$name','$cart_number','$account_number','$iban','$validation','$now')");
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
     // ----------- start VALIDATION_CODE ------------------------------------------------------------------------------------------
     public function validation_code_add($user_id, $code)
     {
         $now = time();
         $result = $this->connection->query("INSERT INTO `tbl_validation_code`
         (`user_id`,`code`,`created_at`) 
         VALUES
         ('$user_id','$code','$now')");
         if (!$this->result($result)) return false;
         return $this->connection->insert_id;
     }
 
     public function validate_code($code){
         $dt = new DateTime("-3 minutes");
         $dt = $dt->format("Y-m-d h:i:s"); 
         $dt = strtotime($dt);
         return $this->connection->query("SELECT * FROM `tbl_validation_code` WHERE `code` = '$code' AND
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
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `title` like '%".$title."%' ORDER BY id LIMIT $cur_index,8 ");
    }

    public function advance_search($input,$category,$city){
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `city_id` = '$city' AND `category_id` = '$category' AND `title` like '%".$input."%'");

    }

    public function shop_search_counter($title)
    {
        $result = $this->connection->query("SELECT * FROM `tbl_shop` WHERE `title` like '%".$title."%' ");
        if (!$this->result($result)) return false;
        return $result->num_rows;
    }

    public function category_shops_list_limited($category_id){
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `category_id` = '$category_id' LIMIT 4 ");
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

    }

    public function province_city_list($province_id)
    {
    return $this->connection->query("SELECT * FROM `tbl_city` WHERE `province_id` = '$province_id'");
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


    public function shop_request_add($category,$name,$owner,$address){
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_shop_request`
        (`category_id`,`title`,`owner`,`address`,`created_at`,`status`) 
        VALUES
        ('$category','$name','$owner','$address','$now',0)");
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
        return $this->table_list("tbl_slider");
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
        return $this->connection->query("SELECT * FROM `tbl_wallet_log` WHERE `user_id` = '$user_id' AND `type` = 1");
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
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `category_id` = '$category_id' ORDER BY id LIMIT $cur_index,8 ");
    }
    public function app_lazyLoad($category_id,$cur_index){
        return $this->connection->query("SELECT * FROM `tbl_shop` WHERE `category_id` = '$category_id' ORDER BY id LIMIT $cur_index,10 ");
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
        $user_id = $this->user()->id;
        return $this->connection->query("SELECT * FROM `tbl_shop_comment` WHERE `shop_id` = '$id' AND `confirm` = 1");
    }

    public function shop_comments_replys_list($comment_id){
        return $this->connection->query("SELECT * FROM `tbl_shop_comment` WHERE `parent` = '$comment_id' ");
        
    }

    public function marketer_get_phone($phone){
        return $this->connection->query("SELECT * FROM `tbl_marketer` WHERE `phone` = '$phone'");
    }

    public function marketer_add($first_name,$last_name,$phone,$package_id,$payment_type,$national_code,$reference_id)
    {
        $now = time();
        $reference_code = $this->get_token(6);
        $result = $this->connection->query("INSERT INTO `tbl_marketer`
        (`first_name`,`last_name`,`phone`,`reference_code`,`reference_id`,`national_code`,`package_id`,`payment_type`,`created_at`,`status`) 
        VALUES
        ('$first_name','$last_name','$phone','$reference_code','$reference_id','$national_code','$package_id','$payment_type','$now',0)");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
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
    public function marketer_payment_add($marketer_id,$amount,$reference_code,$status){
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_marketer_payment`
        (`marketer_id`,`amount`,`reference_code`,`date`,`status`) 
        VALUES
        ('$marketer_id','$amount','$reference_code','$now','$status')");
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

}

// ----------- end Action class ----------------------------------------------------------------------------------------


