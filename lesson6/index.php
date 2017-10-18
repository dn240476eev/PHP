<?php require_once 'functions/functions.php' ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>PHP ДЗ урок 6</title>
</head>

<body >

<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>

<header>
    <nav>
        <div class="wrap_body">
            <?php makeMenu($pages); ?>
        </div>
    </nav>
</header>

<section class="all wrap_body">
    <div class="clearfix">
        <!-- SIDEBAR (CATALOG)-->
        <div class="categories">
            <h3>Категории</h3>
            <div class="category">
                <?php makeCategories($categories)?>
            </div>
        </div>
        <!--Content-->
        <div class="content">
            <?php include 'html/content.php' ?>
        </div>
</section>

<footer>
    <div class="wrap_body">
        <?php makeMenu($pages); ?>
    </div>
</footer>

</body>

</html>
