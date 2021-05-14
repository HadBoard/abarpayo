<?
require_once "functions/database.php";
$action = new Action();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>2</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>
<div id="tree" style="height:1000px;"></div>

<script type="text/javascript" src="assets/js/diagram2.js"></script>
</body>
<script>

    var data = [ <? $action -> diagram2(); ?> ];

    var myTree = Treeviz.create({
        htmlId: "tree",
        idKey: "id",
        hasFlatData: true,
        relationnalField: "father",
        nodeWidth: 120,
        hasPan: true,
        hasZoom: true,
        nodeHeight: 80,
        mainAxisNodeSpacing: 2,
        isHorizontal: false,
        renderNode: function renderNode(node) {
            return result = "<div class='box' style='cursor:pointer;height:" + node.settings.nodeHeight + "px; width:" + node.settings.nodeWidth + "px;display:flex;flex-direction:column;justify-content:center;align-items:center;background-color:" + node.data.color + ";border-radius:5px;'><div><strong>" + node.data.text_1 + "</strong></div><div> : </div><div><i>" + node.data.text_2 + "</i></div></div>";
        },
        linkWidth: function linkWidth(nodeData) {
            return 5;
        },
        linkShape: "curve",
        linkColor: function linkColor(nodeData) {
            return nodeData.linkColor || "#B0BEC5";
        },
        onNodeClick: function onNodeClick(nodeData) {
            return console.log(nodeData);
            return alert(nodeData);
        }
    });
    myTree.refresh(data);
</script>

<style>
    * {
        font-family: "Roboto";
    }

    .graph-svg-component {
        background-color: rebeccapurple;
    }
</style>

</html>