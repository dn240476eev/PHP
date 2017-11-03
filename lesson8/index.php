<?php require_once 'functions/functions.php' ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>PHP ДЗ урок 8</title>
</head>

<body >

<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>

<header>
    <nav>
        <div class="regisr">
            <div class="wrap_body">
                <p><?php echo ((isset($_COOKIE['name'])) ? $_COOKIE['name'] : '') ?></p>
                <p><a href=<?php echo "?route=login" ?>>Вход</a></p>
                <span>/</span>
                <p><a href=<?php echo "?route=register" ?>>Регистрация</a></p>
            </div>
        </div>

        <div class="menu">
            <div class="wrap_body">
                <div class="cart">
                    <?php $cart = getCard($products); ?>
                    <a href=<?php echo "?route=cart" ?>>
                        <img src="assets/image/cart.png" />
                        <?php if (!empty($cart['summ_prod'])) : ?>
                            <span>(<?php echo $cart['summ_prod']; ?> ед)</span>
                        <?php endif ?>
                    </a>

                </div>
                <?php   makeMenu($pages); ?>
            </div>
        <div>
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
            <?php $fav_products = getFavorProduct($products); ?>
            <div class="favor">
                <a href=<?php echo "?route=wishlist" ?>>В избранном</a>
                <?php if (!empty($fav_products['summ_prod'])) : ?>
                    <span>(<?php echo $fav_products['summ_prod']; ?> ед)</span>
                <?php endif ?>
            </div>
            <?php include 'html/content.php' ?>
        </div>
</section>

<footer>
    <div class="wrap_body">
        <?php makeMenu($pages); ?>
        <div class="last_page">
            <?php $lp = lastPage(); ?>
            <p>Последняя посещенная страница</p>
            <p><a href=<?php echo $lp[1] ?>><?php echo $lp[0],$lp[1] ?></a><span><?php echo $lp[2] ?></span></p>
        </div>
    </div>
</footer>

</body>

</html>
