<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP ДЗ урок 2</title>
</head>

<body>
<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>

<h1>PHP Урок 2 Домашнее задание (типы данных, операторы, условия)</h1>
<br>

<!-- Задача 1.  -->
<h3>Задача 1. Определение времени суток</h3>
<?php
$hour = (int)(strftime('%H'));
echo "Сейчас $hour ч";
echo '<br>';
if ($hour > 0 and $hour < 6) {
  $welcome = "Доброй ночи";
} elseif ($hour >= 6 and $hour < 12) {
  $welcome = "Доброе утро";
} elseif ($hour >= 12 and $hour < 18) {
  $welcome = "Добрый день";
} else {
  $welcome = "Добрый вечер";
}
?>
<h3><?php echo $welcome?>, Гость!</h3>
<br>

<!-- Задача 2.  -->
<h3>Задача 2. Динамическое меню</h3>
<?php
$leftMenu = array(
'home'=>'index.php',
'about'=>'about.php',
'contacts'=>'contact.php',
'table'=>'table.php',
'calc'=>'calc.php'
);
?>
<ul>
  <li><a href='<?=$leftMenu['home']?>'>Домой</a></li>
  <li><a href='<?=$leftMenu['about']?>'>О нас</a></li>
  <li><a href='<?=$leftMenu['contacts']?>'>Контакты</a></li>
  <li><a href='<?=$leftMenu['table']?>'>Таблица</a></li>
  <li><a href='<?=$leftMenu['calc']?>'>Калькулятор</a></li>
</ul>
<br>

<!-- Задача 3. Конструкция Switch  -->
<h3>Задача 3. Конструкция Switch</h3>
<?php
$day = mt_rand(1, 7);
echo "Случайный день недели $day - ";
switch ($day) {
  case '1':
    echo 'понедельник';
    break;
  case '2':
    echo 'вторник';
    break;
  case '3':
    echo 'среда';
    break;
  case '4':
    echo 'четверг';
    break;
  case '5':
    echo 'пятница';
    break;
  case '6':
    echo 'суббота';
    break;
  default:
    echo 'воскресенье';
    break;
}
echo '<br>';
switch ($day) {
  case '1':
  case '2':
  case '3':
  case '4':
  case '5':
    echo 'Это рабочий день';
    break;
  default:
    echo 'Это выходной день';
    break;
}
?>
<br>
<br>

<!-- Задача 4.  -->
<h3>Задача 4. Вычисления</h3>

<h4>Задача 4.1.</h4>
<?php
$numb1 = mt_rand(0, 1000);
echo "Натуральное число: $numb1";
echo '<br>';
$ost1 = $numb1 % 3;
$ost2 = $numb1 % 5;
echo "Остаток от деления числа на 3 = $ost1";
echo '<br>';
echo "Остаток от деления числа на 5 = $ost2";
?>
<br>

<h4>Задача 4.2.</h4>
<?php
$numb2 = rand(0, 1000) / 10;
echo "Число: $numb2";
echo '<br>';
$pcoc1 = $numb2 * 1.3;
$pcoc2 = $numb2 * 2.2;
echo "Число, увеличенное на 30% = $pcoc1";
echo '<br>';
echo "Число, увеличенное на 120% = $pcoc2";
?>
<br>

<h4>Задача 4.3.</h4>
<?php
$numb3 = rand(0, 1000) / 10;
$numb4 = rand(0, 1000) / 10;
echo "Число 1: $numb3";
echo '<br>';
echo "Число 2: $numb4";
echo '<br>';
$sum_pcoc = $numb3 * 0.4 + $numb4 * 0.84;
echo "Cумма 40% от первого числа и 84% от второго числа = $sum_pcoc";
?>
<br>
<br>

<!-- Задача 5.  -->
<h3>Задача 5. Вычисления</h3>

<h4>Задача 5.1.</h4>
<?php
$numb5 = rand(0, 1000) / 10;
echo "Дано число : $numb5. <br>Если оно больше 10, то увеличьте его на 100, иначе уменьшите на 30.";
echo '<br>';
if ($numb5 > 10){
  $numb5 = $numb5 + 100;
  echo "Ответ: $numb5";
} else {
  $numb5 = $numb5 - 30;
  echo "Ответ: $numb5";
}
echo '<br>';
echo '<br>';

$numb6 = mt_rand(0, 1000);
echo "Дано натуральное число: $numb6. <br> Если оно четное, то уменьшите его в 2 раза, иначе увеличьте в 3 раза.";
echo '<br>';
if ($numb6 % 2 == 0){
  $numb6 = $numb6 / 2;
  echo "Ответ: $numb6";
} else {
  $numb6 = $numb6 * 3;
  echo "Ответ: $numb6";
}
?>
<br>

<h4>Задача 5.2.</h4>
<?php
$numb7 = rand(0, 1000) / 10;
echo "Дано число : $numb7. <br> Если оно не меньше 50, то выведите квадрат этого числа, если же это число больше 10 и меньше 30, то выведите ноль, в остальных случаях выведите слово 'Ошибка'.";
echo '<br>';
if ($numb7 >= 50) {
  $numb8 = pow($numb7, 2);
  echo "Ответ: $numb8";
} elseif ($numb7 > 10 and $numb7 < 30) {
  echo "Ответ: 0";
} else {
  echo "Ответ: Ошибка";
}
?>
<br>

<h4>Задача 5.3.</h4>
<?php
$numb9 = rand(0, 1000) / 10;
$numb10 = rand(0, 1000) / 10;
echo "Дано два числа : $numb9 и $numb10. <br>Вывести наибольшее из них.";
echo '<br>';
if ($numb9 > $numb10) {
  echo "Ответ: $numb9";
} elseif ($numb9 < $numb10) {
  echo "Ответ: $numb10";
} else {
  echo "Ответ: Числа равны";
}
?>
<br>

<h4>Задача 5.4.</h4>
<?php
$numb11 = rand(0, 1000) / 10;
$numb12 = rand(0, 1000) / 10;
echo "Дано два числа: $numb11 и $numb12. <br> Вывести 'Да', если они отличаются на 100, иначе вывести 'Нет'.";
echo '<br>';
if ($numb11 - $numb12 === 100 or $numb11 - $numb12 === -100) {
  echo "Ответ: Да";
} else {
  echo "Ответ: Нет";
}
echo '<br>';
echo '<br>';

$numb13 = rand(0, 1000) / 10;
$numb14 = rand(0, 1000) / 10;
echo "Дано два числа $numb13 и $numb14. <br> Вывести 'Да', если они отличаются не более чем на 20, иначе вывести 'Нет'.";
echo '<br>';
if ($numb13 - $numb14 > 20 or $numb14 - $numb13 > 20) {
  echo "Ответ: Да";
} else {
  echo "Ответ: Нет";
}
?>

<br>

<h4>Задача 5.5.</h4>
<?php
$mon = mt_rand(0, 10);
echo "Дан номер месяца : $mon. <br> Вывести название поры года (весна, лето и так далее) или слово 'Ошибка', если месяца с таким номером не существует.";
echo '<br>';
switch ($mon) {
  case '9':
  case '10':
  case '11':
    $seas = 'Осень';
    break;
  case '1':
  case '2':
  case '12':
    $seas = 'Зима';
    break;
  case '3':
  case '4':
  case '5':
    $seas = 'Весна';
    break;
  case '6':
  case '7':
  case '8':
    $seas = 'Лето';
    break;
  default:
    $seas = 'Ошибка. Такого месяца не существует.';
    break;
}
?>
<p>Пора года: <?php echo $seas?> </p>

<h4>Задача 5.6.</h4>
<?php
$x = mt_rand(-100, 100);
$y = mt_rand(-100, 100);
echo "Переменные: x = $x, y = $y. <br>Вычислить значение выражения. Перед вычислением проверить корректность значений переменных.";
echo '<br>';
if((strval((int)$x)==$x or strval((float)$x)==$x) and (strval((int)$y)==$y or strval((float)$y)==$y)) {
  if ($y > 0) {
  $rez = (pow($x, 2) - 4 * sqrt($y - 1)) / (sin(2 * $x) + abs($x));
  echo "Ответ: $rez";
  } else {
  echo "Надопустимое значение. Переменная 'у' должна быть больше нуля.";
  }
} else {
  echo "Введите число";
}
?>
<br>
<br>

<!-- Задача 6. -->
<h3>Задача 6. Составить таблицу сравнения типов данных</h3>
<?php
$x1 = "";
$x2 = null;
$x3 = "";
$x4 = array();
$x5 = false;
$x6 = true;
$x7 = 1;
$x8 = 42;
$x9 = 0;
$x10 = -1;
$x11 = "1";
$x12 = "0";
$x13 = "-1";
$x14 = "php";
$x15 = "true";
$x16 = "false";
?>

<table border="5" bordercolor="#27408b" width="70%" cellspacing="0" cellpadding="3">

<!-- №1 -->
  <tr>
   <th width="30%">Выражение</th>
   <th width="17.5%">gettype()</th>
   <th width="17.5%">empty()</th>
   <th width="17.5%">isset()</th>
   <th width="17.5%">boolean: <br>if($x)</th>
  </tr>

<!-- №2 -->
  <tr>
   <th width="30%" align="left">$x = ""</th>
   <td width="17.5%"><?php echo gettype($x1)?></td>
   <td width="17.5%"><?php echo var_export(empty($x1))?></td>
   <td width="17.5%"><?php echo var_export(isset($x1))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x1))?></td>
  </tr>

<!-- №3 -->
  <tr>
   <th width="30%" align="left">$x = null</th>
   <td width="17.5%"><?php echo gettype($x2)?></td>
   <td width="17.5%"><?php echo var_export(empty($x2))?></td>
   <td width="17.5%"><?php echo var_export(isset($x2))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x2))?></td>
  </tr>

<!-- №4 -->
  <tr>
   <th width="30%" align="left">$x неопределена</th>
   <td width="17.5%"></td>
   <td width="17.5%"></td>
   <td width="17.5%"></td>
   <td width="17.5%"></td>
  </tr>

<!-- №5 -->
  <tr>
   <th width="30%" align="left">$x = array()</th>
   <td width="17.5%"><?php echo gettype($x4)?></td>
   <td width="17.5%"><?php echo var_export(empty($x4))?></td>
   <td width="17.5%"><?php echo var_export(isset($x4))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x4))?></td>
  </tr>

<!-- №6 -->
  <tr>
   <th width="30%" align="left">$x = false</th>
   <td width="17.5%"><?php echo gettype($x5)?></td>
   <td width="17.5%"><?php echo var_export(empty($x5))?></td>
   <td width="17.5%"><?php echo var_export(isset($x5))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x5))?></td>
  </tr>

<!-- №7 -->
  <tr>
   <th width="30%" align="left">$x = true</th>
   <td width="17.5%"><?php echo gettype($x6)?></td>
   <td width="17.5%"><?php echo var_export(empty($x6))?></td>
   <td width="17.5%"><?php echo var_export(isset($x6))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x6))?></td>
  </tr>

<!-- №8 -->
  <tr>
   <th width="30%" align="left">$x = 1</th>
   <td width="17.5%"><?php echo gettype($x7)?></td>
   <td width="17.5%"><?php echo var_export(empty($x7))?></td>
   <td width="17.5%"><?php echo var_export(isset($x7))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x7))?></td>
  </tr>

<!-- №9 -->
  <tr>
   <th width="30%" align="left">$x = 42</th>
   <td width="17.5%"><?php echo gettype($x8)?></td>
   <td width="17.5%"><?php echo var_export(empty($x8))?></td>
   <td width="17.5%"><?php echo var_export(isset($x8))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x8))?></td>
  </tr>

<!-- №10 -->
  <tr>
   <th width="30%" align="left">$x = 0</th>
   <td width="17.5%"><?php echo gettype($x9)?></td>
   <td width="17.5%"><?php echo var_export(empty($x9))?></td>
   <td width="17.5%"><?php echo var_export(isset($x9))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x9))?></td>
  </tr>

<!-- №11 -->
  <tr>
   <th width="30%" align="left">$x = -1</th>
   <td width="17.5%"><?php echo gettype($x10)?></td>
   <td width="17.5%"><?php echo var_export(empty($x10))?></td>
   <td width="17.5%"><?php echo var_export(isset($x10))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x10))?></td>
  </tr>

<!-- №12 -->
  <tr>
   <th width="30%" align="left">$x = "1"</th>
   <td width="17.5%"><?php echo gettype($x11)?></td>
   <td width="17.5%"><?php echo var_export(empty($x11))?></td>
   <td width="17.5%"><?php echo var_export(isset($x11))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x11))?></td>
  </tr>

<!-- №13 -->
  <tr>
   <th width="30%" align="left">$x = "0"</th>
   <td width="17.5%"><?php echo gettype($x12)?></td>
   <td width="17.5%"><?php echo var_export(empty($x12))?></td>
   <td width="17.5%"><?php echo var_export(isset($x12))?></td>
   <td  width="17.5%"><?php echo var_export((bool)($x12))?></td>
  </tr>

<!-- №14 -->
  <tr>
   <th width="30%" align="left">$x = "-1"</th>
   <td width="17.5%"><?php echo gettype($x13)?></td>
   <td width="17.5%"><?php echo var_export(empty($x13))?></td>
   <td width="17.5%"><?php echo var_export(isset($x13))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x13))?></td>
  </tr>

<!-- №15 -->
  <tr>
   <th width="30%" align="left">$x = "php"</th>
   <td width="17.5%"><?php echo gettype($x14)?></td>
   <td width="17.5%"><?php echo var_export(empty($x14))?></td>
   <td width="17.5%"><?php echo var_export(isset($x14))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x14))?></td>
  </tr>

<!-- №16 -->
  <tr>
   <th width="30%" align="left">$x = "true"</th>
   <td width="17.5%"><?php echo gettype($x15)?></td>
   <td width="17.5%"><?php echo var_export(empty($x15))?></td>
   <td width="17.5%"><?php echo var_export(isset($x15))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x15))?></td>
  </tr>

<!-- №17 -->
  <tr>
   <th width="30%" align="left">$x = "false"</th>
   <td width="17.5%"><?php echo gettype($x16)?></td>
   <td width="17.5%"><?php echo var_export(empty($x16))?></td>
   <td width="17.5%"><?php echo var_export(isset($x16))?></td>
   <td width="17.5%"><?php echo var_export((bool)($x16))?></td>
  </tr>

</table>
<br>

<!-- Задача 7.  -->
<h3>Задача 7. Выбор из трех чисел</h3>
<?php
$numb01 = mt_rand(100, 999);
$numb02 = mt_rand(100, 999);
$numb03 = mt_rand(100, 999);
echo "Числа: $numb01, $numb02, $numb03. <br> Написать код, который выбирает из трех чисел то, которое находится между двумя другими.";
echo '<br>';
$max = max ($numb01, $numb02, $numb03);
$min = min ($numb01, $numb02, $numb03);

if ($numb01 > $min and $numb01 < $max) {
  echo "Ответ: число по середине " . $numb01 . ".";
} elseif ($numb02 > $min and $numb02 < $max) {
  echo "Ответ: число по середине " . $numb02 . ".";
}  elseif ($numb03 > $min and $numb03 < $max) {
  echo "Ответ: число между двумя другими " . $numb03 . ".";
} else {
  echo "Ответ: два числа равны";
}
?>
<br>
<br>

<!-- Дополнительно.  -->
<h3>Дополнительно</h3>
<h3>Доп. 1</h3>
<?php
$str = md5(uniqid(rand(), true));
$str1 = mb_substr(($str), 1, 9);
echo "Строка: $str1. <br> Cоздать произвольную строку из одного или двух слов и выполнить её переворот (поменять все символы местами в словах).";
echo '<br>';
$str1= strrev($str1);
echo "Ответ: $str1.";
?>
<br>

<h3>Доп. 2</h3>
<?php
$dec1 = mt_rand(-100, 100);
echo "Десятичное число: $dec1. <br>Реализовать функцию перевода 10-го числа в двоичное.";
echo '<br>';
$dec1 = decbin($dec1);
echo "Ответ: $dec1.";
?>
<br>

<h3>Доп. 3</h3>
<?php
$str_arr = mt_rand();
echo "Дана строка: $str_arr. <br>разбить эту строку в массив таким образом: array('1', '23', '456', '7890') и так далее пока символы в строке не закончатся.";
echo '<br>';
echo '<br>';

$arr = array();
$lng_arr = 0;
$lng_str = mb_strlen($str_arr);

for($i = 0; $i < $lng_str - $lng_arr; ++$i){
  $el1 = mb_substr(($str_arr), $lng_arr, 1 + $i);
  $lng_arr = $lng_arr + mb_strlen($el1);
  $arr[] = $el1;
}

echo "Ответ: ";
if ($lng_str > 0) {
  for($i = 0; $i < count($arr); $i++){
    echo $arr[$i] . "  ";
  }
  if ($lng_str > ($lng_arr)) {
    echo "Остаток строки " . mb_substr(($str_arr), $lng_arr, $lng_str - $lng_arr) . ".";
  }
} else {
  echo "Строка пустая.";
}
echo '<br>';
echo '<br>';
if ($lng_str > 0) {
// Альтернатива for
  foreach ($arr as $value) {
    echo $value . "  ";
  }
  if ($lng_str > ($lng_arr)) {
    echo "Остаток строки " . mb_substr(($str_arr), $lng_arr, $lng_str - $lng_arr) . ".";
  }
} else {
  echo "Строка пустая.";
}
unset($value);
?>
<br>
<br>
</body>
</html>
