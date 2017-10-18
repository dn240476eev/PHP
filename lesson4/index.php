<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>PHP ДЗ урок 4</title>
</head>

<body>

<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>

<h1>PHP Урок 4 Домашнее задание</h1>

<!-- Задача 1.  -->
<h3>Задача 1. Таблица умножения</h3>
<p>Отрисуйте таблицу умножения 3 раза с разным цветом, вызывая свою функцию с произвольными параметрами.</p>

<div>
    <?php
//    $color = '#80FF00';
    drawTable(10, 10, '80FF00');
    drawTable(rand(5, 10), rand(5, 10), substr(md5(rand(1, 10000)), 1, 6));
    drawTable(rand(5, 10), rand(5, 10), substr(md5(rand(1, 10000)), 1, 6));
        function drawTable($col, $row, $color) {
            echo "<table style='float: left; padding-right: 35px'>";
            for ($i = 1; $i <= $row; $i++) {
                echo "<tr style='width: 20px;'>";
                for ($j = 1; $j <= $col; $j++) {
                    echo "<td style=\"width: 20px; color:#" . $color . "\">" . $j * $i . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";

        }
    echo "<br style='clear: both;'>";
     ?>
<!--    <table>-->
<!--        --><?php //for ($i=1; $i <= 10; $i++) :?>
<!--            <tr>-->
<!--                --><?php //for ($j=1; $j <= 10; $j++) :?>
<!--                    <td style="color:--><?//=$color?><!--">--><?php //echo $j*$i ?><!--</td>-->
<!--                --><?// endfor; ?>
<!--            </tr>-->
<!--        --><?// endfor; ?>
<!--    </table>-->
</div>
<br>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<?php
include 'data_pages.php';
include 'data_products.php';
include 'data_categories.php';

$pages = unserialize($data_pages);
$products = unserialize($data_products);
$categories = unserialize($data_categories);

echo "Массив страниц";
echo "<br>";
echo "<br>";
print_r($pages);

echo "<br>";
echo "<br>";

echo "Массив товаров";
echo "<br>";
echo "<br>";
print_r($products);

//echo "<br>";
//echo "<br>";

//echo "Массив категорий";
//echo "<br>";
//echo "<br>";
//var_dump($categories);

//echo "<br>";
//echo "<br>";
?>

<!-- Задача 2.  -->
<h3>Задача 2. Построение динамического меню </h3>
<p>Измените код таким образом, чтобы меню отрисовывалось в зависимости от ходящего параметра $type - либо вертикально, либо горизонтально.</p>

<div style="max-width: 100%">
    <?php


    MainMenu($pages);
    echo "<br>";
    MainMenu($pages, false);

    function MainMenu ($menu, $type = true) {
        if(is_array($menu)) {
            foreach ($menu as $page) {
                if ($page->visible && $page->menu_id == 1) {
                    if ($type) {
                        echo "<a style=\"text-transform: uppercase; padding-left: 5%;  text-decoration: none\" href=$page->url>$page->name</a>".' ';
                    } else {
                        echo "<br><a style=\"text-transform: uppercase; text-decoration: none\"href=$page->url>$page->name</a>";

                    }
                }
            }
        }
    }
    ?>
</div>
<br>


<!-- Задача 3.   -->
<h3>Задача 3. Постоить дерево категорий</h3>
<div>
    <p>Результат - дерево категорий</p>
    <?php
    $categor_res = GetCategoriesTree($categories);
    print_r($categor_res);

    function GetCategoriesTree($categories,$parent_id=0) {
        $results=array();
        if ($categories) {
            foreach ($categories as $category) {
                if ($category->parent_id==$parent_id) {
                    if ($category->id!=$parent_id) {
                        $subcategories = GetCategoriesTree($categories,$category->id);
                        if(!empty($subcategories))
                            $category->subcategories = $subcategories ;
                    };
                    $results[]=$category;
                    unset($category);
                }
            }
        }
        return $results;
    }
    ?>
</div>
<br>

<!-- Задача 4.   -->
<h3>Задача 4. Построить рекурсивное дерево категорий</h3>
<?php

function getCategories($categories) {
    if($categories) { // проверка лишней не бывает
        echo "<ul>";
        foreach ($categories as $category) {
            if($category->visible) { //важная проверка, которая позволит выводит только включенные категории на сайте
                echo "<li><a href='#'>$category->name</a>";
                if(!empty($category->subcategories)) {
                    // проверяем есть ли подкатегории и вызываем заново функцию для вывода
                    getCategories($category->subcategories); // передаем в функцию уже массив обьектов покатегорий
                }
                echo "</li>";
            }
        }
        echo "</ul>";
    }
}

$categories = GetCategoriesTree($categor_res);
//getCategories($categories);
?>

<div class="wrap_body, clearfix">
    <div class="categories">
        <h3>Категории</h3>
        <div class="category"><?php getCategories($categories)?></div>
    </div>
    <div class="products">
        <ul class="products_ul">
            <?php foreach ($products as $product) :?>
                <?php if (($product->visible) && (!empty($product->variant->stock))) :?>
                    <li class="product">
                        <div class="wrap_product"
                            <!--Дата товара-->
                            <div class="product_data">
                                <?php $temp_data = $product->created;
                                $temp_data = date("m.d.y", strtotime($temp_data));?>
                                <p><? echo $temp_data ?></p>
                            </div>
                            <!--Изображение товара-->
                            <div>
                                <img src="http://dummyimage.com/150x150.png/E2DFDE&text=The+image! 150x150" />
                            </div>
                            <!--Название товара-->
                            <div class="product_name">
                                <h3><?=$product->name?></h3>
                            </div>
                            <!--Цена товара-->
                            <div class="price">
                                <p><?=$product->variant->price?> грн</p>
                            </div>
                            <!--Количество товара-->
                            <div class="stock">
                                <p>На складе: <?=$product->variant->stock?> штук</p>
                            </div>
                        </div>
                    </li>
                <? endif; ?>
            <? endforeach; ?>
        </ul>
    </div>
</div>

<!--Функция mail-->
<?php
//// Сообщение
//$to = 'mihaskep@gmail.com';
//$subject = 'Тест Open server function mail()';
//$message = "Саша, привет !\r\nНаправляю тестовое письмо через функцию mail().\r\n\r\nС уважением, Лена Евтушенко";
//
//
//// Отправляем
//$mail = mail($to, $subject, $message);
//
//var_dump($mail);
function makecoffee($types = array("капуччино"), $coffeeMaker = NULL)
{
    $device = is_null($coffeeMaker) ? "вручную" : $coffeeMaker;
    return "Готовлю чашку ".join(", ", $types)." $device.\n";
}
echo makecoffee();
echo makecoffee(array("капуччино", "лавацца"), "в чайнике");
echo "<br>";
echo "test GIT";
echo "<br>";
echo "test GIT";
?>

</body>
</html>
