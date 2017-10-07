<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>PHP ДЗ урок 3</title>
</head>

<body>

<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>

<h1>PHP Урок 3 Домашнее задание (циклы и массивы)</h1>
<br>


<!-- Задача 1.  -->
<h3>Задача 1. Сформировать шахматную доску размером 10 на 10 (используя цикл for) и закрасить в ней черным все четные ячейки.</h3>
<div>
  <table border="5" bordercolor="#27408b" width="300px" cellspacing="0" cellpadding="3">
    <?php for ($i=1; $i <= 10; $i++) :?>
        <tr height="30px">
            <?php for ($j=1; $j <= 10; $j++) :?>
              <?php if (($j%2 == 0 and $i%2 !== 0) or ($i%2 == 0 and $j%2 !== 0)) :?>
                <td width="10%" bgcolor="#000" ></td>
              <?php elseif ($j%2 == 0 and $i%2 !== 0) :?>
              <?php else :?>
                <td width="10%"></td>
              <? endif; ?>
            <? endfor; ?>
        </tr>
    <? endfor; ?>
  </table>
</div>
<br>

<!-- Задача 2.  -->
<h3>Задача 2. Используя функцию rand создать массив из 10-ти случайных чисел в диапазоне от 1 до 10, и найти сумму каждого третьего значения в массиве.</h3>
  <?php
  $ar_rand1 = array();
  $temp1_ar = array();
  $sum_ar1 = 0;
  for ($i = 0; $i < 10; $i++) {
    $ar_rand1[] = rand(1, 10);
  }
  ?>
<div>
  <p>Исходный массив: <? print_r($ar_rand1) ?></p>
  <?php
  foreach ($ar_rand1 as $key => $value) {
    if (($key+1)%3 == 0) {
      $sum_ar1 = $ar_rand1[$key] + $sum_ar1;
      $temp1_ar[$key] = $value;
     }
  }
  ?>
  <p>Выходной массив: <? print_r($temp1_ar) ?></p>
  <h4>Сумма значений каждого третьего элемента: <? echo $sum_ar1 ?>.</h4>
</div>
<br>

<!-- Задача 3.   -->
<h3>Задача 3. Используя функцию rand создать массив из 10-ти случайных чисел в диапазоне от 1 до 10. Генерируя случайное число, проверять функцией in_array, входит ли оно в созданный массив.</h3>
  <?php
  $ar_rand2 = array();
  $temp2_ar = array();
  for ($i = 0; $i < 10; $i++) {
    $temp2 = rand(1, 10);
    if (in_array($temp2, $ar_rand2) and !in_array($temp2, $temp2_ar)) {
      $temp2_ar[] = $temp2;
    }
    $ar_rand2[$i] = $temp2;
  }
  ?>
<div>
  <p>Массив: <? print_r($ar_rand2) ?></p>
  <h4 style="display: inline;">Числа, несколько раз входящие в массив: </h4>
  <?php foreach ($temp2_ar as $value) :?>
    <h4 style="display: inline;"><? echo $value?></h4>
  <? endforeach; ?>
  <h4 style="display: inline;">.</h4>
</div>
<br>

<!-- Задача 4.  -->
<h3>Задача 4. Используя функцию rand создать 2 массива из 20-ти случайных чисел в диапазоне от 1 до 20. После чего выполнить сравнение массивов функцией array_diff и получить массив из элементов, которых нет в массиве 2.</h3>

  <?php
  $ar_rand3 = array();
  $ar_rand4 = array();
  $temp2_ar = array();
  for ($i = 0; $i < 20; $i++) {
    $ar_rand3[] = rand(1, 20);
    $ar_rand4[] = rand(1, 20);
  }
  $array_res =  array_diff($ar_rand3, $ar_rand4);
  ?>
<div>
  <p>Массив 1: <? print_r($ar_rand3) ?></p>
  <p>Массив 2: <? print_r($ar_rand4) ?></p>
  <h4>Массив из элементов, которых нет в массиве 2: <? print_r($array_res) ?></h4>
</div>
<br>

<!-- Задача 5.  -->
<h3>Задача 5. Построение динамического меню сайта.</h3>
<?PHP // header("Content-Type: text/html; charset=utf-8");?>
<?php
include 'data_pages.php';
$pages = unserialize($data_pages);
//print_r($test);
?>
<div style="max-width: 100%; text-align: right">
    <?php foreach ($pages as $page) :?>
        <?php if (($page->visible == 1) && ($page->menu_id == 1)) :?>
            <a style="text-transform: uppercase; padding-left: 7%; text-decoration: none" href='<?=$page->url?>'><?=$page->name?></a>
        <? endif; ?>
    <? endforeach; ?>

</div>
<p><?echo $pages[1]->description?></p>
<br>

<!-- Задача 6.   -->
<h3>Задача 6. Построить вывод списка товаров из заданного массива обьектов.</h3>
<?php
include 'data_products.php';
$products = unserialize($data_products);

//echo "Массив товаров";
echo "<br>";
print_r($products);
echo "<br>";
//
//echo "<br>";
//echo "Массив категорий";
//echo "<br>";

include 'data_categories.php';
$test2 = unserialize($data_categories);
//var_dump($test2);
?>
<div class="wrap_body">
<div class="categories">
    <h3>Категории</h3>
</div>
<div class="products">
    <ul class="products_ul">
        <?php foreach ($products as $product) :?>
            <?php if (($product->visible == 1) and ($product->variant->stock != 0)) :?>
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
                            <img src="http://dummyimage.com/150x150.png/E2DFDE&text=The+image!" />
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
</body>
</html>
