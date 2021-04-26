<?
// ----------- start config methods ------------------------------------------------------------------------------------
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

session_start();
include('jdf.php');
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

    // ----------- get current page url
    public function url()
    {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $url;
    }

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
        $id = $this->admin()->id;
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
    public function send_sms($mobile, $textMessage)
    {
        $webServiceURL = "";
        $webServiceSignature = "";
        $webServiceNumber = "";
        $textMessage = mb_convert_encoding($textMessage, "UTF-8");
        $parameters['signature'] = $webServiceSignature;
        $parameters['toMobile'] = $mobile;
        $parameters['smsBody'] = $textMessage;
        $parameters['retStr'] = ""; // return reference send status and mobile and report code for delivery
        try {
            $con = new SoapClient($webServiceURL);
            $responseSTD = (array)$con->Send($parameters);
            $responseSTD['retStr'] = (array)$responseSTD['retStr'];
        } catch (SoapFault $ex) {
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

    // ----------- start ADMINS ----------------------------------------------------------------------------------------
    // ----------- for login admin
    public function admin_login($user, $pass)
    {
        $result = $this->connection->query("SELECT * FROM `tbl_admin` WHERE `username`='$user' AND `password`='$pass' AND status=1");
        if (!$this->result($result)) return false;
        $rowcount = mysqli_num_rows($result);
        $row = $result->fetch_object();
        if ($rowcount) {
            $this->admin_update_last_login();
            $_SESSION['admin_id'] = $row->id;
            $_SESSION['admin_access'] = $row->access;
            return true;
        }
        return false;
    }

    // ----------- for check access (admin access)
    public function auth()
    {
        if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_access']))
            return true;
        return false;
    }

    // ----------- for check access (guest access)
    public function guest()
    {
        if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_access']))
            return false;
        return true;
    }

    // ----------- update last login of admin (logged)
    public function admin_update_last_login()
    {
        $id = $this->admin()->id;
        $now = strtotime(date('Y-m-d H:i:s'));
        $result = $this->connection->query("UPDATE `tbl_admin` SET `last_login`='$now' WHERE `id`='$id'");
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

    // ----------- for show all admins
    public function admin_list()
    {
        $id = $this->admin()->id;
        $result = $this->connection->query("SELECT * FROM `tbl_admin` WHERE NOT `id`='$id' ORDER BY `id` DESC");
        if (!$this->result($result)) return false;
        return $result;
    }

    // ----------- add an admin
    public function admin_add($first_name, $last_name, $phone, $username, $password, $status, $access)
    {
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_admin`
        (`first_name`,`last_name`,`phone`,`username`,`password`,`access`,`status`,`created_at`) 
        VALUES
        ('$first_name','$last_name','$phone','$username','$password','$access','$status','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    // ----------- update admin's detail
    public function admin_edit($id, $first_name, $last_name, $phone, $username, $password, $status, $access)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_admin` SET 
        `first_name`='$first_name',
        `last_name`='$last_name',
        `phone`='$phone',
        `username`='$username',
        `password`='$password',
        `access`='$access',
        `status`='$status',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    // ----------- remove admin
    public function admin_remove($id)
    {
        if ($this->admin_get($id)->access) return false;
        return $this->remove_data("tbl_admin", $id);
    }

    // ----------- change admin's status
    public function admin_status($id)
    {
        return $this->change_status('tbl_admin', $id);
    }

    // ----------- get admin's data
    public function admin_get($id)
    {
        return $this->get_data("tbl_admin", $id);
    }

    // ----------- get admin's data (logged)
    public function admin()
    {
        $id = $_SESSION['admin_id'];
        return $this->admin_get($id);
    }

    // ----------- count of admin
    public function admin_counter()
    {
        return $this->table_counter("tbl_admin");
    }

    // ----------- end ADMINS ------------------------------------------------------------------------------------------

    // ----------- start USERS -----------------------------------------------------------------------------------------

    public function user_list()
    {
        return $this->table_list("tbl_user");
    }

    public function user_add($first_name, $last_name, $national_code, $phone,$city_id,$address,$postal_code,$birthday,$icon,$score,$wallet,$iban,$status,$platform)
    {
        $now = time();
        $reference_code = $this->get_token(6);
        $result = $this->connection->query("INSERT INTO `tbl_user`
        (`first_name`,`last_name`,`national_code`,`phone`,`city_id`,`address`,`postal_code`,`reference_code`,`birthday`,`profile`,`score`,`wallet`,`iban`,`status`,`created_at`,`platform`) 
        VALUES
        ('$first_name','$last_name','$national_code','$phone','$city_id','$address','$postal_code','$reference_code','$birthday','$icon','$score','$wallet','$iban','$status','$now','$platform')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }


    public function user_edit($id, $first_name, $last_name, $national_code, $phone,$city_id,$address,$postal_code,$birthday,$icon,$score,$wallet,$iban,$status)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user` SET 
        `first_name`='$first_name',
        `last_name`='$last_name',
        `national_code`='$national_code',
        `phone`='$phone',
        `city_id`='$city_id',
        `address` = '$address',
        `postal_code` = '$postal_code',
        `birthday`='$birthday',
        `profile`='$icon',
        `score` = '$score',
        `wallet`= '$wallet',
        `iban` = '$iban',
        `status`='$status',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function user_remove($id)
    {
        return $this->remove_data("tbl_user", $id);
    }

    public function user_status($id)
    {
        return $this->change_status('tbl_user', $id);
    }

    public function user_get($id)
    {
        return $this->get_data("tbl_user", $id);
    }

    public function user_counter()
    {
        return $this->table_counter("tbl_user");
    }

    public function wallet_withdraw($user_id,$amount){
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user` SET 
        `wallet` = '$amount',
        `updated_at`='$now'
        WHERE `id` ='$user_id'");
        if (!$this->result($result)) return false;
        return $user_id;
    }

    public function wallet_log_add($user_id,$action,$amount,$type,$payment_id)
    {
        $result = $this->connection->query("INSERT INTO `tbl_wallet_log`
        (`user_id`,`action`,`amount`,`type`,`payment_id`) 
        VALUES
        ('$user_id','$action','$amount','$type','$payment_id')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    // ----------- end USERS -------------------------------------------------------------------------------------------

    // ----------- start CATEGORIES -----------------------------------------------------------------------------------------

    public function category_list()
    {
        return $this->table_list("tbl_category");
    }

    public function category_option($id)
    {
        return $this->table_option("tbl_category", $id);
    }

    public function category_add($title,$icon,$ord,$slag,$status)
    {
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_category`
        (`title`,`icon`,`ord`,`slag`,`status`,`created_at`) 
        VALUES
        ('$title','$icon','$ord','$slag','$status','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function category_edit($id, $title,$icon,$ord,$slag,$status)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_category` SET 
        `title`='$title',
        `icon` = '$icon',
        `ord` = '$ord',
        `slag`='$slag',
        `status`='$status',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function category_remove($id)
    {
        return $this->remove_data("tbl_category", $id);
    }

    public function category_status($id)
    {
        return $this->change_status('tbl_category', $id);
    }

    public function category_get($id)
    {
        return $this->get_data("tbl_category", $id);
    }

    // ----------- end CATEGORIES -------------------------------------------------------------------------------------------
    // ----------- start CARD -----------------------------------------------------------------------------------------

    public function cart_list()
    {
        return $this->table_list("tbl_user_cart");
    }

    public function user_get_cart($user_id){
        return $this->connection->query("SELECT * FROM `tbl_user_cart` WHERE `user_id` = '$user_id'");
    }

    public function cart_add($user_id,$bank_id,$title,$cart_number,$account_number,$iban,$validation)
    {
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_user_cart`
        (`user_id`,`bank_id`,`title`,`cart_number`,`account_number`,`iban`,`validation`,`created_at`) 
        VALUES
        ('$user_id','$bank_id','$title','$cart_number','$account_number','$iban','$validation','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function cart_edit($id,$user_id,$bank_id,$title,$cart_number,$account_number,$iban,$validation)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_user_cart` SET 
        `user_id`='$user_id',
        `bank_id`='$bank_id',
        `title`='$title',
        `cart_number`='$cart_number',
        `account_number`= '$account_number',
        `iban`= '$iban',
        `validation`='$validation',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function cart_remove($id)
    {
        return $this->remove_data("tbl_user_cart", $id);
    }


    public function cart_get($id)
    {
        return $this->get_data("tbl_user_cart", $id);
    }

    // ----------- end CATEGORIES -------------------------------------------------------------------------------------------
    // ----------- start SHOPS -----------------------------------------------------------------------------------------

    public function shop_list()
    {
        return $this->table_list("tbl_shop");
    }

    public function shop_option($id)
    {
        return $this->table_option("tbl_shop", $id);
    }

    public function shop_add($category_id,$title,$icon,$phone, $fax, $city_id, $address, $longitude, $latitude, $status)
    {
        
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_shop`
        (`category_id`,`title`,`image`,`phone`,`fax`,`city_id`,`address`,`longitude`,`latitude`,`status`,`created_at`) 
        VALUES
        ('$category_id','$title','$icon','$phone','$fax','$city_id','$address','$longitude','$latitude','$status','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function shop_pics_add($shop_id,$pic)
    {
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_shop_pics`
        (`shop_id`,`image`,`created_at`) 
        VALUES
        ('$shop_id','$pic','$now')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function shop_pics_get($shop_id)
    {
        return $this->connection->query("SELECT * FROM `tbl_shop_pics` WHERE `shop_id` = '$shop_id'");
    }

    public function shop_edit($id,$category_id,$title,$icon, $phone, $fax, $city_id, $address, $longitude, $latitude, $status)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_shop` SET 
        `category_id`= '$category_id',
        `title`='$title',
        `image`='$icon',
        `phone`='$phone',
        `fax`='$fax',
        `city_id`='$city_id',
        `address`='$address',
        `longitude`='$longitude',
        `latitude`='$latitude',
        `status`='$status',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function shop_remove($id)
    {
        return $this->remove_data("tbl_shop", $id);
    }

    public function shop_status($id)
    {
        return $this->change_status('tbl_shop', $id);
    }

    public function shop_get($id)
    {
        return $this->get_data("tbl_shop", $id);
    }

    // ----------- end SHOPS -------------------------------------------------------------------------------------------

     // ----------- start PRODUCT -----------------------------------------------------------------------------------------

     public function product_list()
     {
         return $this->table_list("tbl_product");
     }

     public function product_option($id)
    {
        return $this->table_option("tbl_product", $id);
    }
 
     public function product_add($category_id,$shop_id,$title,$description,$price,$discount,$score,$status)
     {
         $now = time();
         $result = $this->connection->query("INSERT INTO `tbl_product`
         (`category_id`,`shop_id`,`title`,`discription`,`price`,`discount`,`score`,`status`,`created_at`) 
         VALUES
         ('$category_id','$shop_id','$title','$description','$price','$discount','$score','$status','$now')");
         if (!$this->result($result)) return false;
         return $this->connection->insert_id;
     }
 
     public function product_edit($id,$category_id,$shop_id,$title,$description,$price,$discount,$score,$status)
     {
         $now = time();
         $result = $this->connection->query("UPDATE `tbl_product` SET 
         `category_id` = '$category_id',
         `shop_id`='$shop_id',
         `title`='$title',
         `discription`='$description',
         `price` = '$price',
         `discount`= '$discount',
         `score` = '$score',
         `status`='$status',
         `updated_at`='$now'
         WHERE `id` ='$id'");
         if (!$this->result($result)) return false;
         return $id;
     }
 
     public function product_remove($id)
     {
         return $this->remove_data("tbl_product", $id);
     }
 
     public function product_status($id)
     {
         return $this->change_status('tbl_product', $id);
     }
 
     public function product_get($id)
     {
         return $this->get_data("tbl_product", $id);
     }
 
     // ----------- end PRODUCT -------------------------------------------------------------------------------------------
    // ----------- start PROVINCE -----------------------------------------------------------------------------------------

         public function province_list()
         {
             return $this->table_list("tbl_province");
         }

         public function province_city_list($province_id)
         {
           return $this->connection->query("SELECT * FROM `tbl_city` WHERE `province_id` = '$province_id'");
         }

        public function province_option($id)
        {
            return $this->table_option("tbl_province", $id);
        }
     
         public function province_add($name,$status)
         {
             $now = time();
             $result = $this->connection->query("INSERT INTO `tbl_province`
             (`name`,`status`,`created_at`) 
             VALUES
             ('$name','$status','$now')");
             if (!$this->result($result)) return false;
             return $this->connection->insert_id;
         }
     
         public function province_edit($id,$name,$status)
         {
             $now = time();
             $result = $this->connection->query("UPDATE `tbl_province` SET 
             `name` = '$name',
             `status`='$status',
             `updated_at`='$now'
             WHERE `id` ='$id'");
             if (!$this->result($result)) return false;
             return $id;
         }
     
         public function province_remove($id)
         {
             return $this->remove_data("tbl_province", $id);
         }
     
         public function province_status($id)
         {
             return $this->change_status('tbl_province', $id);
         }
     
         public function province_get($id)
         {
             return $this->get_data("tbl_province", $id);
         }
     
         // ----------- end PROVINCE -------------------------------------------------------------------------------------------
         // ----------- start CITY -----------------------------------------------------------------------------------------

        public function city_list()
        {
            return $this->table_list("tbl_city");
        }
        
        public function city_option($id)
        {
            return $this->table_option("tbl_city", $id);
        }

        public function city_add($province_id,$name,$status)
        {
            $now = time();
            $result = $this->connection->query("INSERT INTO `tbl_city`
            (`province_id`,`name`,`status`,`created_at`) 
            VALUES
            ('$province_id','$name','$status','$now')");
            if (!$this->result($result)) return false;
            return $this->connection->insert_id;
        }
    
        public function city_edit($id,$province_id,$name,$status)
        {
            $now = time();
            $result = $this->connection->query("UPDATE `tbl_product` SET 
            `province_id` = '$province_id',
            `name`='$name',
            `status`='$status',
            `updated_at`='$now'
            WHERE `id` ='$id'");
            if (!$this->result($result)) return false;
            return $id;
        }
    
        public function city_remove($id)
        {
            return $this->remove_data("tbl_city", $id);
        }
    
        public function city_status($id)
        {
            return $this->change_status('tbl_city', $id);
        }
    
        public function city_get($id)
        {
            return $this->get_data("tbl_city", $id);
        }
     // ----------- end CITY -------------------------------------------------------------------------------------------
     // ----------- start TICKETS -----------------------------------------------------------------------------------------

     public function solved_ticket_list()
     {
        return $this->connection->query("SELECT * FROM `tbl_ticket` WHERE `status` = 3 ORDER BY id DESC ");
     }
 
     public function not_solved_ticket_list()
     {
        return $this->connection->query("SELECT * FROM `tbl_ticket` WHERE `status` = 0 ORDER BY id DESC ");
     }

     public function in_queue_ticket_list()
     {
        return $this->connection->query("SELECT * FROM `tbl_ticket` WHERE `status` = 1 ORDER BY id DESC ");
     }

     public function solving_ticket_list(){
        return $this->connection->query("SELECT * FROM `tbl_ticket` WHERE `status` = 2 ORDER BY id DESC ");
     }

     public function ticket_set_status($id,$status)
     {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_ticket` SET 
        `status`='$status',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
     }
 
     public function ticket_add($user_id,$subject,$text)
     {
         $now = time();
         $result = $this->connection->query("INSERT INTO `tbl_ticket`
         (`user_id`,`subject`,`text`,`created_at`) 
         VALUES
         ('$user_id','$subject','$text','$now')");
         if (!$this->result($result)) return false;
         return $this->connection->insert_id;
     }

     public function ticket_edit($id,$admin_id,$solve)
     {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_ticket` SET 
        `admin_id`= '$admin_id',
        `solve`='$solve',
        `updated_at`='$now'
        WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
     }

     public function ticket_solve($id,$admin_id,$solve)
     {
         $now = time();
         $status = 3;
         $result = $this->connection->query("UPDATE `tbl_ticket` SET 
         `admin_id` = '$admin_id',
         `solve`='$solve',
         `status`='$status',
         `solved_at`='$now'
         WHERE `id` ='$id'");
         if (!$this->result($result)) return false;
         return $id;
     }
 
     public function ticket_get($id)
     {
         return $this->get_data("tbl_ticket", $id);
     }
 
     // ----------- end TICKET -------------------------------------------------------------------------------------------
      // ----------- start PRODCT_COMMENT -----------------------------------------------------------------------------------------

      public function product_comment_list($product_id)
      {
         return $this->connection->query("SELECT * FROM `tbl_product_comment` WHERE `product_id` = $product_id");
      }
  
      public function product_comment_status($id,$old_status)
      {
        $status = !$old_status;
        $result = $this->connection->query("UPDATE `tbl_product_comment` SET 
         `status`='$status'
         WHERE `id` ='$id'");
         if (!$this->result($result)) return false;
         return $id;
      }

      public function product_comment_remove($id)
      {
        return $this->remove_data("tbl_product_comment", $id);
      }
  
      public function product_comment_get($id)
      {
          return $this->get_data("tbl_product_comment", $id);
      }
  
      // ----------- end PRODUCT_COMMENT -------------------------------------------------------------------------------------------
      // ----------- start SHOP_COMMENT -----------------------------------------------------------------------------------------

      public function shop_comment_list($shop_id)
      {
        return $this->connection->query("SELECT * FROM `tbl_shop_comment` WHERE `shop_id` = '$shop_id' AND `parent` = 0");
      }
  
      public function shop_comment_confirm($id)
      {
        $result = $this->connection->query("UPDATE `tbl_shop_comment` SET 
         `confirm`= 1
         WHERE `id` ='$id'");
         if (!$this->result($result)) return false;
         return $id;
      }

    public function shop_comment_add($shop_id,$user_id,$parent,$text){
        $now = time();
        $result = $this->connection->query("INSERT INTO `tbl_shop_comment`
        (`shop_id`,`user_id`,`parent`,`text`,`score`,`created_at`,`confirm`) 
        VALUES
        ('$shop_id','$user_id', $parent ,'$text', 0 ,'$now', 0 )");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function shop_comment_reply($id){
        return $this->connection->query("SELECT * FROM `tbl_shop_comment` WHERE `parent` = $id");
    }

      public function shop_comment_remove($id)
      {
        return $this->remove_data("tbl_shop_comment", $id);
      }
  
      public function shop_comment_get($id)
      {
          return $this->get_data("tbl_shop_comment", $id);
      }
  

      // ----------- end SHOP_COMMENT ----------------------------------------------------------------------------
    
    // ----------- start BANK ----------------------------------------------------------------------------
    public function bank_list()
    {
        return $this->table_list("tbl_bank");
    }
    public function bank_get($id)
    {
        return $this->get_data("tbl_bank", $id);
    }
    // ----------- end BANK ----------------------------------------------------------------------------

     // ----------- start SLIDERS -----------------------------------------------------------------------------------------

     public function slider_list()
     {
         return $this->table_list("tbl_slider");
     }
     public function slider_add($title,$link,$image,$status)
     {
         $now = time();
         $result = $this->connection->query("INSERT INTO `tbl_slider`
         (`title`,`link`,`image`,`status`,`created_at`) 
         VALUES
         ('$title','$link','$image','$status','$now')");
         if (!$this->result($result)) return false;
         return $this->connection->insert_id;
     }
 
     public function slider_edit($id, $title,$link,$image, $status)
     {
         $now = time();
         $result = $this->connection->query("UPDATE `tbl_slider` SET 
         `title`='$title',
         `link` = '$link',
         `image` = '$image',
         `status`='$status',
         `updated_at`='$now'
         WHERE `id` ='$id'");
         if (!$this->result($result)) return false;
         return $id;
     }
 
     public function slider_remove($id)
     {
         return $this->remove_data("tbl_slider", $id);
     }
 
     public function slider_status($id)
     {
         return $this->change_status('tbl_slider', $id);
     }
 
     public function slider_get($id)
     {
         return $this->get_data("tbl_slider", $id);
     }
 
     // ----------- end SLIDERS -------------------------------------------------------------------------------------------
      // ----------- start PACKAGE -----------------------------------------------------------------------------------------

      public function package_list()
      {
          return $this->table_list("tbl_package");
      }
      public function package_add($name,$price,$discount,$status)
      {
          $now = time();
          $result = $this->connection->query("INSERT INTO `tbl_package`
          (`name`,`price`,`discount`,`status`,`created_at`) 
          VALUES
          ('$name','$price','$discount','$status','$now')");
          if (!$this->result($result)) return false;
          return $this->connection->insert_id;
      }
  
      public function package_edit($id, $name,$price,$discount,$status)
      {
          $now = time();
          $result = $this->connection->query("UPDATE `tbl_package` SET 
          `name`='$name',
          `price` = '$price',
          `discount` = '$discount',
          `status`='$status',
          `updated_at`='$now'
          WHERE `id` ='$id'");
          if (!$this->result($result)) return false;
          return $id;
      }
  
      public function package_remove($id)
      {
          return $this->remove_data("tbl_package", $id);
      }
  
      public function package_status($id)
      {
          return $this->change_status('tbl_package', $id);
      }
  
      public function package_get($id)
      {
          return $this->get_data("tbl_package", $id);
      }
  
      // ----------- end PACKAGES -------------------------------------------------------------------------------------------
     
     public function request_edit($id, $description,$birthday){
        $now = time();
        $status = 1;
        $result = $this->connection->query("UPDATE `tbl_request` SET 
        `description` = '$description',
        `status` = '$status',
        `paymented_at` = '$birthday',
        `updated_at` = '$now'
        WHERE `id` ='$id'");

        if (!$this->result($result)) return false;
        return $id;
     }

     public function request_list(){
        return $this->table_list("tbl_request");
     }

     public function request_get($id)
     {
         return $this->get_data("tbl_request", $id);
     }

     public function request_remove($id)
     {
         return $this->remove_data("tbl_request", $id);
     }

    // ----------- start MARKETER -----------------------------------------------------------------------------------------

    public function marketer_list()
    {
        return $this->table_list("tbl_marketer");
    }
    public function marketer_add($first_name, $last_name,$phone, $national_code,$package_id ,$payment_type,$reference_id,$status)
    {
        $now = time();
        $reference_code = $this->get_token(6);
        $result = $this->connection->query("INSERT INTO `tbl_marketer`
        (`first_name`,`last_name`,`phone`,`reference_code`,`reference_id`,`national_code`,`package_id`,`payment_type`,`created_at`,`status`) 
        VALUES
        ('$first_name','$last_name','$phone','$reference_code','$reference_id','$national_code','$package_id','$payment_type','$now','$status')");
        if (!$this->result($result)) return false;
        return $this->connection->insert_id;
    }

    public function marketer_edit($id,$first_name, $last_name,$phone, $national_code,$package_id ,$payment_type,$reference_id,$status)
    {
        $now = time();
        $result = $this->connection->query("UPDATE `tbl_marketer` SET 
         `first_name`='$first_name',
         `last_name` = '$last_name',
         `phone` = '$phone',
         `national_code` = '$national_code',
         `package_id`='$package_id',
         `payment_type` ='$payment_type',
         `reference_id` = '$reference_id',
         `status` = '$status',
         `updated_at`='$now'
         WHERE `id` ='$id'");
        if (!$this->result($result)) return false;
        return $id;
    }

    public function marketer_remove($id)
    {
        return $this->remove_data("tbl_marketer", $id);
    }

    public function marketer_status($id)
    {
        return $this->change_status('tbl_marketer', $id);
    }

    public function marketer_get($id)
    {
        return $this->get_data("tbl_marketer", $id);
    }

    // ----------- end MARKETER -------------------------------------------------------------------------------------------
    public function update_system($key,$value){
        $result = $this->connection->query("UPDATE `tbl_app` SET `value`='$value' WHERE `app_key`='$key'");
        if (!$this->result($result)) return 0;
        return 1;
    }

    public function get_system($key){
        $result = $this->connection->query("SELECT * FROM tbl_app WHERE `app_key` = '$key'");
        if (!$this->result($result)) return false;
        $row  = $result->fetch_object(); 
        return $row->value;
    }

}

// ----------- end Action class ----------------------------------------------------------------------------------------


