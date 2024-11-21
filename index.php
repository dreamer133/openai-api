<?php
    $mainPath = __DIR__.'/';
    $classesDir = $mainPath . 'classes/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once($classesDir . 'main.php');?>   

    <div id="container">
        <div id="answer">

        </div>
        <p>Write yout question to openAI</p>
        <textarea name="main" id="question" cols="30" rows="5"></textarea>
    </div>
</body>
</html>