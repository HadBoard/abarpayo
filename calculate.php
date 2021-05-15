<?
require_once "functions/database.php";
$action = new Action();
 if(isset($_SESSION['refrence_id'])){
    $parent_id=$_SESSION['refrence_id'];
    $marketer_id=$_POST['id'];
    $max_step=6;
    $step=1;
    $pack_id=$action->marketer_get($marketer_id)->package_id;  
    $package=$action->package_get($pack_id); 
    $DC1=$package->DC1;
    $DC2=$package->DC2;
    $pack_price=$package->price; 
    $marketer_package=$package->packege_id;
    $today=strtotime(date('Y-m-d'));
    while($step<=$max_step=6){     
        if($parent_id==0){
            break;
        }else{
            $amount=0;
            $parent=$action->marketer_get($parent_id);
            $parent_package=$parent->package_id;           
            $packages=$action->package_get($parent_package);
            $max_income=$packages->max;          
            $parent_today_income=$action->marketer_today_income($parent_id);          
            if($parent_today_income<$max_income){
               if($parent_package< $marketer_package){
                   if($step==1){
                       $amount=($packages->price)*$DC1/100;
                     
                   }else{
                       $amount=($packages->price)*$DC2/100;
                       
                   }
               }
               else{
                    if($step==1){
                        $amount= $pack_price*$DC1/100;                      
                    }else{
                        $amount= $pack_price*$DC1/100;                      
                    }
               }
               if($max_income-$parent_today_income<$amount){
                   $amount=$max_income-$parent_today_income;
               }             
               $action->marketer_wallet_log_add($parent_id,4,$amount,1,0);
               $step++;
               $parent_id=$parent->reference_id;             
            }else{
                $parent_id=$parent->reference_id;              
                $step++;              
                continue;
            }
        }
    }
 }
?>