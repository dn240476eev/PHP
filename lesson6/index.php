<?php require_once 'functions/functions.php' ?>


<html>
     <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--     <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>PHP ДЗ урок 4</title> -->
     </head>

<body>
    
    <div class="header">
        <?php makeMenu($pages); ?>
    </div>

    <div class="sidebar">
        SIDEBAR (CATALOG)
    </div>

    <div >
        <h1>Content</h1>
        <?php include 'html/content.php' ?>

    </div>

    <div class="header">
        <h1>FOOTER</h1>
        <?php makeMenu($pages); ?>
    </div>

</body>

</html>
