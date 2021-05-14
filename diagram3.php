<?
require_once "functions/database.php";
$action = new Action();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>3</title>
    <script type="text/javascript" src="assets/js/diagram3.js"></script>
    <script type="text/javascript" src="assets/codebase/diagram.js"></script>
    <link rel="stylesheet" href="assets/codebase/diagram.css">
    <link rel="stylesheet" href="assets/css/diagram3.css">
    <link href="https://cdn.materialdesignicons.com/4.5.95/css/materialdesignicons.min.css?v=3.0.2" media="all" rel="stylesheet" type="text/css">
</head>
<body>

<div id="diagram"></div>
<script>
    const diagram = new dhx.Diagram("diagram", {
        type: "org",
        defaultShapeType: "template"
    });
    diagram.addShape("template", {
        template,
        defaults
    });

    const data = [
        <? $action->diagram3() ?>
        //
        // {
        //     id: "0",
        //     name: "Kristin Mccoy",
        //     post: "Medical director",
        //     phone: "(405) 555-0128",
        //     mail: "kmccoy@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-1.jpg",
        // },
        // {
        //     id: "1",
        //     name: "Theo Fisher",
        //     post: "Head of department",
        //     phone: "(405) 632-1372",
        //     mail: "tfisher@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-2.jpg",
        //     parent: "0"
        // },
        // {
        //     id: "2",
        //     name: "Alisha Hall",
        //     post: "Head of department",
        //     phone: "(405) 372-9756",
        //     mail: "ahall@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-4.jpg",
        //     parent: "0"
        // },
        // {
        //     id: "100",
        //     name: "Milena Hunter",
        //     post: "Attending physician",
        //     phone: "(124) 622-1256",
        //     mail: "mhunter@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-25.jpg",
        //     parent: "2",
        //     dir: "vertical",
        // },
        // {
        //     id: "2.2",
        //     name: "Maximus Dixon",
        //     post: "Medical director",
        //     phone: "(264) 684-4373",
        //     mail: "mdixon@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-29.jpg",
        //     parent: "2",
        //     dir: "vertical",
        // },
        // {
        //     id: "3",
        //     name: "Edward Sharp",
        //     post: "Head of department",
        //     phone: "(451) 251-2578",
        //     mail: "esharp@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-6.jpg",
        //     parent: "0",
        //     dir: "vertical",
        // },
        // {
        //     id: "3.1",
        //     name: "Cruz Burke",
        //     post: "Attending physician",
        //     phone: "(587) 234-8975",
        //     mail: "cburke@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-7.jpg",
        //     parent: "3",
        // },
        // {
        //     id: "3.2",
        //     name: "Eloise Saunders",
        //     post: "Attending physician",
        //     phone: "(875) 231-5332",
        //     mail: "esaunders@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-8.jpg",
        //     parent: "3",
        // },
        // {
        //     id: "3.3",
        //     name: "Sophia Matthews",
        //     post: "Attending physician",
        //     phone: "(361) 423-7234",
        //     mail: "smatthews@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-9.jpg",
        //     parent: "3",
        // },
        // {
        //     id: "3.4",
        //     name: "Kara Foster",
        //     post: "Attending physician",
        //     phone: "(565) 525-0672",
        //     mail: "kfoster@gmail.com",
        //     photo: "https://docs.dhtmlx.com/diagram/samples/common/big_img/big-avatar-10.jpg",
        //     parent: "3",
        // },
        //
    ];

    diagram.data.parse(data);

</script>
</body>
</html>