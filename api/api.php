<?
require_once "../functions/database.php";
$database = new DB();
$connection = $database->connect();
$action = new Action();

if(isset($_POST['function'])) {
    if($_POST['function'] == 'sendCode'){

        $obj = null;
        $obj -> result = 0;
        $phone = $action->request('phone');
        $code=rand(100000,999999);
        $result = $action->user_get_phone($phone);
        $user = $result->fetch_object();
        $user_id = $user ? $user->id : 0;
        //$action->send_sms($phone,$code);
        $command = $action->validation_code_add($user_id,$code);
        if($command){
            $obj->result = $code;
        }
        $json = json_encode($obj);
        echo $json;
    }

    if($_POST['function'] == 'checkCode'){
        $obj = null;
        $obj -> result = 0;
        $phone = $action->request('phone');
        $code = $action->request('code');
        $result = $action->validate_code($code);
        $validated_code = $result->fetch_object();
        if($validated_code){
            if($validated_code->user_id == 0){
                $obj -> result  = 0;
                $action->validation_code_remove($validated_code->id);
            }
            else{
                $obj->result = 1;
                $obj->user_id = $validated_code->user_id;
                $action->validation_code_remove($validated_code->id);
            } 
        }else{
            $obj -> result = -1; 
        }
        $json = json_encode($obj);
        echo $json;
    }

    if($_POST['function'] == 'register'){
        $obj = null;
        $obj -> result = 0;
        $phone = $action->request('phone');
        $first_name = $action->request('name');
        $last_name = $action->request('lastname');
        $reference_code = $action->request('invitation_code');
        if($reference_code){
            $result = $action->user_reference_code($reference_code);
            $reference = $result->fetch_object();
            $reference_id = $reference->id;
        }
        $platform = 2;
        $command = $action->user_add($first_name,$last_name,$phone,$reference_id,$platform);
        if($command){
            $obj -> result = 1;
            $obj -> user_id = $command;
        }
        $json = json_encode($obj);
        echo $json;
    }

    if($_POST['function'] == 'sliders'){
        $obj = null;
        $sliders = [];
        $result = $action->slider_list();
        while ($row = $result->fetch_object()) {
            $obj_in -> sendLink = "http://abarpayo.com/site/$row->link";
            $obj_in -> link = "http://abarpayo.com/site/admin/images/sliders/$row->image";
            $sliders[] = $obj_in;
            $obj_in = null;
        }
        $obj -> sliders = $sliders;
        $json = json_encode($obj);
        echo $json;
    }
        
    
    if($_POST['function'] == 'categories'){
        $obj = null;
        $categories = [];
        $categories_list = $action -> category_ordered_list();
        while ($category = $categories_list->fetch_object()) {
            $obj_in -> c_id = $category->id;
            $obj_in -> c_text = $category->title;
            $obj_in -> c_image = "http://abarpayo.com/site/admin/images/categoryIcons/$row->icon";
            $categories[] = $obj_in;
            $obj_in = null;
        }

        $obj -> categories = $categories;
        $json = json_encode($obj);
        echo $json;
    }
    
    if($_POST['function'] == 'shops' ){
        $obj = null;
        $obj -> shops = [];
        $shops=[];
        $category_id = $action->request('category_id');
        $count = $action->request('count');
        $result = $action->app_lazyLoad($category_id,$count);
        while ($shop = $result->fetch_object()) {
            $obj_inner -> s_id = $shop -> id;
            $obj_inner -> name = $shop -> title;
            $obj_inner -> img = "http://abarpayo.com/site/admin/images/shops/$shop->image";
            $obj_inner -> address = $shop -> address;
            $obj_inner -> off = "off";
            $obj_inner -> rate = "rate";
            $obj_inner -> buy_counter = "buy_counter";
            $shops[] = $obj_inner;
            $obj_inner = null;
        }
         $obj -> shops = $shops;
        $json = json_encode($obj);
        echo $json;
        
    }

    if($_POST['function'] == 'cities'){
        $result = $action->province_list();
        while($row = $result->fetch_object()){
            $id = $row->id;
            $name = $row->name;
            $city=[];
            $cresult = $action->province_city_list($row->id);
            while($crow = $cresult->fetch_object()){
              $cid = $crow->id;
              $cname = $crow->name;
                $city[] = [
                    c_id=> $cid,
                    text => $cname
               ];
            }
            $province[] = [
                p_id => $id ,
                text => $name,
                cities=>$city
           ];
        }
        $obj -> province = $province;
        $json = json_encode($obj);
        echo $json;
        
    }
    
    if($_POST['function'] == 'userInfo'){
        $id = $action->request('user_id');
        $obj -> first_name = $action->user_get($id)->first_name;
        $obj -> last_name = $action->user_get($id)->last_name;
        $obj -> phone = $action->user_get($id)->phone;
        $obj -> national_code = $action->user_get($id)->national_code;
        $obj -> address = $action->user_get($id)->address;
        $obj -> postal_code = $action->user_get($id)->postal_code;
        $obj -> city_id = $action->user_get($id)->city_id;
        $obj ->province_id = $action->city_get($action->user_get($id)->city_id)->province_id;
        $timestamp = $action->user_get($id)->birthday;
        $obj -> birthday = $timestamp;
        $json = json_encode($obj);
        echo $json;
    }
    
    if($_POST['function'] == 'userEdit'){
        $obj = null;
        $obj->result = 0;
        $id = $action->request('user_id');
        $first_name = $action->request('first_name');
        $last_name = $action->request('last_name');
        $national_code = $action->request('national_code');
        $address = $action->request('address');
        $postal_code = $action->request('postal_code');
        $city_id = $action->request('city_id');
        // $birthday = $action->request_date('birthday');
        $command = $action->app_profile_edit($id,$first_name, $last_name,$national_code,$birthday,$address,$postal_code,$city_id);
        if($command){
            $obj->result = 1;
        }
        $json = json_encode($obj);
        echo $json;
    }

    if($_POST['function'] == 'token'){
        $user_id = $action->request('user_id');
        $token = rand(100000,999999);
        $result = $action->app_token_list($user_id);
        while($row = $result->fetch_object()){
            $id = $row->id;
            $action->app_token_remove($id);
        }
        $command = $action->app_token_add($user_id,$token);
        if($command){
           $obj -> token = $token; 
        }
         $json = json_encode($obj);
        echo $json; 
    }
    
    if($_POST['function'] == 'userWallet'){
        $user_id = $action->request('user_id');
        $wallet = $action->user_get($user_id)->wallet;
        $obj->wallet = (int) $wallet;
        $obj->arr = [];

        $withdraws = $action->app_get_requests($user_id);
        while($withdraw = $withdraws->fetch_object()){
            //$obj_in -> wallet_date = $withdraw->paymented_at;
            $obj_in -> amount = $withdraw->amount;
            $obj_in -> type = 0;
            $arr[] = $obj_in;
            $obj_in = null;
        }
        $logs = $action->wallet_log_increase($user_id);
        while($log = $logs->fetch_object()){
            //$obj_inner -> wallet_date = $action->wallet_log_get_payment($log->payment_id)->date;
            $obj_inner -> amount = $log->amount;
            $obj_inner -> type = 1;
            $arr[] = $obj_inner;
            $obj_in = null;
        }
        $obj -> arr = $arr;
        $json = json_encode($obj);
        echo $json; 
    }
    
    if($_POST['function'] == 'userCarts'){
         $user_id = $action->request('user_id');
         $result = $action->app_user_cart_list($user_id);
         while($row = $result->fetch_object()){
             $obj_in -> id = $row->id;
             $obj_in -> bank_name = $action->bank_get($row->bank_id)->name;
             $obj_in -> cart_number = $row->cart_number;
             $obj_in -> iban = $row->iban;
             $obj_in -> account_number = $row->account_number;
             $carts[] = $obj_in;
             $obj_in = null;
         }
        $obj->carts = $carts;
        $json = json_encode($obj);
        echo $json; 
    }

 
    if($_POST['function'] == 'transactions'){
        $obj -> arr = [];
        $user_id = $action->request('user_id');
        $transactions = $action->app_get_payment($user_id);
        while($transaction = $transactions->fetch_object()){
            $payments = $action->payment_get_action($transaction->id);
            $payment = $payments->fetch_object();
            $obj_in -> cost = $transaction->amount;
            $obj_in -> action = $payment->action;
            //$obj_in -> pay_date = $action->time_to_shamsi($transaction->date);
            $obj_in -> type = 1;
            $out[] = $obj_in;
            $obj_in = null;
        }
        
        $withdraws = $action->app_get_requests($user_id);
        while($withdraw = $withdraws->fetch_object()){
            $obj_in -> cost = $withdraw->amount;
            //$obj_in -> pay_date  = $action->time_to_shamsi($withdraw->created_at);
            $obj_in -> action = "برداشت از کیف پول";
            $obj_in -> type = 0;
            $out[] = $obj_in;
            $obj_in = null;
        }

        $obj-> arr = $out;
        $json = json_encode($obj);
        echo $json; 
    }
    
    if($_POST['function'] == 'banks'){
        $obj -> banks = [];
        $banks = $action->bank_list();
        while($bank = $banks->fetch_object()){
            $obj_in -> id = $bank->id;
            $obj_in -> name = $bank -> name;
            $banks_list[] = $obj_in;
            $obj_in = null;
        }
        $obj->banks = $banks_list;
        $json = json_encode($obj);
        echo $json; 
    }
    
    if($_POST['function'] == 'addCart'){
        $obj=null;
        $obj -> result= 0;
        $user_id = $action->request('user_id');
        $bank_id = $action->request('bank_id');
        $iban = $action->request('iban');
        $owner = $action->request('owner');
        $account_number = $action->request('account_number');
        $cart_number = $action->request('cart_number');
        $validation = 0;
        $command = $action->app_cart_add($user_id,$bank_id,$owner,$cart_number,$account_number,$iban,$validation);
        if($command){
            $obj -> result = 1;
        }
        $json = json_encode($obj);
        echo $json; 
    }
    
    if($_POST['function'] == 'withdraw'){
        $obj = null;
        $obj -> result = 0;
        $user_id = $action->request('user_id');
        $amount = $action->request('amount');
        $cart = $action->request('cart');
        $command   = $action->app_request_add($user_id,$cart,$amount);
        if($command){
            $obj -> result = 1;
        }
        $json = json_encode($obj);
        echo $json; 
    }

    if($_POST['function'] == 'lastWithdraw'){
        $obj = null;
        $obj -> result = 0;
        $user_id = $action->request('user_id');
        $requests  = $action->last_request($user_id);
        $request = $requests->fetch_object();
        $obj -> cart_number  = $action->cart_get($request->cart_id)->cart_number;
        $obj -> request_date = $request->created_at;
        $obj -> status = $request->status;
        $obj -> amount = $request->amount;
        $json = json_encode($obj);
        echo $json; 
    }

    if($_POST['function'] == 'userCity'){
        $obj = null;
        $user_id = $action->request('user_id');
        $obj -> city_id = $action->user_get($user_id)->city_id;
        $obj ->province_id = $action->city_get($action->user_get($user_id)->city_id)->province_id;
        $json = json_encode($obj);
        echo $json; 
    }
}

