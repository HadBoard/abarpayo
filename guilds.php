<?
    require_once "functions/database.php";
    $action = new Action();
    if(isset($_POST['submit'])){
        $name  = $action->request('name');
        $owner = $action->request('owner');
        $address = $action->request('address');
        $category = $action->request('category');
    }
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>ابرپایو</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">  
    <link rel="stylesheet" href="assets/css/swiper.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/fontiran.css">
    <link rel="stylesheet" href="assets/css/fontAswome.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <script src='assets/js/swiper.js'></script>
    <script src='assets/js/jquery.js'></script>
    <script src='assets/js/fontAwsome.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
</head>
<body>
    <div class="background_page">
        <div class="container">
            <div class="center_form">
                <div class="row">
                    <div class="col-md-5 right-form">
                        <div class="form_top">
                            <img src="assets/images/logo.png">
                            <h4>معرفی کسب و کار</h4>
                        </div>
                        
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="name">نام صنف</label>
                                <input type="text" name="name" placeholder="فقط حروف فارسی">
                            </div>
                            <div class="form-group">
                                <label for="owner">نام صاحب کسب و کار</label>
                                <input type="text" name="owner" placeholder="فقط حروف فارسی">
                            </div>
                            <div class="form-group">
                                <label for="category">دسته بندی</label>
                                <select name="category">
                                    <option>یزد-یزد</option>
                                    <option>یزد-یزد</option>
                                    <option>یزد-یزد</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">نشانی</label>
                                <textarea name="address"></textarea>
                            </div>
                            <input name="submit" type="submit" class="main_btn" value="ثبت درخواست">
                            
                        </form>
                    </div>
                    <div class="col-md-7 left-form">
                        <img src="assets/images/Group 499@2x.png">
                    </div>
                </div>
                <p>با ورود یا ثبت نام در ابرپایو <a>شرایط و قوانین </a> را میپذیرید.</p>
            </div>
        </div>
    </div>
</body>
</html>