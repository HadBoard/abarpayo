<?
if(isset($_POST['wallet_increase'])){
    include('functions/database.php'); 
    $user_id = $action->user()->id; 
    $increase_amount = $_POST['amount'];
    $_SESSION['increase_amount'] = $increase_amount;
    
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
//$Amount = $_SESSION['cost']/1000; //Amount will be based on Toman - Required
$Amount = $increase_amount;
$Description = 'افزایش موجودی'; // Required
$Email = 'UserEmail@Mail.Com'; // Optional
$Mobile = "0000"; // Optional
$CallbackURL = 'http://abarpaya.com/site/wallet-verify.php'; // Required
// $CallbackURL = 'http://parsinsu.com/profile.php';
$client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentRequest(
    [
        'MerchantID' => $MerchantID,
        'Amount' => $Amount,
        'Description' => $Description,
        'Email' => $Email,
        'Mobile' => $Mobile,
        'CallbackURL' => $CallbackURL,
    ]
);

}//Redirect to URL You can do it also by creating a form
if ($result->Status == 100) {
    Header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
} else {
  
}


