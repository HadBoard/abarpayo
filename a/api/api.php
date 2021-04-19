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
        $command = $action->user_add($first_name,$last_name,$phone,$reference_id);
        if($command){
            $obj -> result = 1;
            $obj -> user_id = $command;
        }
        $json = json_encode($obj);
        echo $json;
    }

    if($_POST['function'] == 'dashboard'){
        $obj = null;
        $categories = [];
        $sliders = [];
        $shops = [];
        
        $result = $action->slider_list();
        while ($row = $result->fetch_object()) {
            $obj_in -> title = $row -> title;
            $obj_in -> link = "http://abarpayo.com/site/admin/images/slider/$row->image";
            $sliders[] = $obj_in;
            $obj_in = null;
        }

        $categories_list = $action -> category_ordered_list();
        while ($category = $categories_list->fetch_object()) {
            $obj_in -> c_id = $category->id;
            $obj_in -> title = $category->title;
            
            $shops_list = $action->category_shops_list($category->id);
            while ($shop = $shops_list->fetch_object()) {
                $obj_inner -> s_id = $shop -> id;
                $obj_inner -> name = $shop -> title;
                $obj_inner -> address = $shop -> address;
                $shops[] = $obj_inner;
                $obj_inner = null;
            }

            $obj_in -> shops = $shops;
            $categories[] = $obj_in;
            $obj_in = null;
            $shops = [];
        }

        $obj -> categories = $categories;
        $obj -> sliders = $sliders;
        $json = json_encode($obj);
        echo $json;
    }
}

