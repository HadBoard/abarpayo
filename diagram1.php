<?
require_once "functions/database.php";
$action = new Action();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>1</title>
    <link rel="stylesheet" href="assets/css/diagram1.css">

</head>
<body>


<div class="tree">
    <? $action->diagram(); ?>
</div>

</body>
</html>