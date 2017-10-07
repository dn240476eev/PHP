<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP ДЗ урок 1</title>
</head>

<body>

<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>

<h1>PHP Домашнее задание Урок 1 </h1>
<h2>Задача 1. Калькуляторы перевода</h2>

<!-- Дюймы в сантиметры -->
<h3>1.1. Дюймы в сантиметры</h3>
<h4>Исходные данные:</h4>
<?php
$var_inch_cm = 1;
$koef_inch_cm = 2.54;
echo 'дюймы: ', $var_inch_cm, '; коэффициент перевода: ', $koef_inch_cm;
?>
<h4>Результат:</h4>
<?php
$res_inch_cm = $var_inch_cm * $koef_inch_cm;
echo $res_inch_cm, ' сантиметров';
?>
<br> <br>

<!-- Дюймы в метры -->
<h3>1.2. Дюймы в метры</h3>
<h4>Исходные данные:</h4>
<?php
$var_inch_m = 1;
$koef_inch_m = 0.0254;
echo 'дюймы: ', $var_inch_m, '; коэффициент перевода: ', $koef_inch_m;
?>
<h4>Результат:</h4>
<?php
$res_inch_m = $var_inch_m * $koef_inch_m;
echo $res_inch_m, ' метров';
?>
<br> <br>

<!-- Мили в километры -->
<h3>1.3. Мили в километры</h3>
<h4>Исходные данные:</h4>
<?php
$var_mile_km = 1;
$koef_mile_km = 1.609344;
echo 'мили: ', $var_mile_km, '; коэффициент перевода: ', $koef_mile_km;
?>
<h4>Результат:</h4>
<?php
$res_mile_km = $var_mile_km * $koef_mile_km;
echo $res_mile_km, ' километров';
?>
<br> <br>

<!-- Мили в метры -->
<h3>1.4. Мили в метры</h3>
<h4>Исходные данные:</h4>
<?php
$var_mile_m = 1;
$koef_mile_m = 1609.344;
echo 'мили: ', $var_mile_m, '; коэффициент перевода: ', $koef_mile_m;
?>
<h4>Результат:</h4>
<?php
$res_mile_m = $var_mile_m * $koef_mile_m;
echo $res_mile_m, ' метров';
?>
<br> <br>

<!-- Градусы Цельсия в Фаренгейты -->
<h3>1.5. Градусы Цельсия в Фаренгейты</h3>
<h4>Исходные данные:</h4>
<?php
$var_cels_fahr = 1;
$koef_cels_fahr1 = 32;
$koef_cels_fahr2 = 9;
$koef_cels_fahr3 = 5;
echo 'градусы Цельсия: ', $var_cels_fahr, '; коэффициент 1: ', $koef_cels_fahr1, '; коэффициент 2: ', $koef_cels_fahr2, '; коэффициент 3: ', $koef_cels_fahr3;
?>
<h4>Результат:</h4>
<?php
$res_cels_fahr = $koef_cels_fahr2 / $koef_cels_fahr3 * $var_cels_fahr + $koef_cels_fahr1;
echo $res_cels_fahr, ' градусов Фаренгейта';
?>
<br> <br>

<!-- Фаренгейты в градусы Цельсия -->
<h3>1.6. Фаренгейты в градусы Цельсия</h3>
<h4>Исходные данные:</h4>
<?php
$var_fahr_cels = 1;
$koef_fahr_cels1 = 32;
$koef_fahr_cels2 = 5;
$koef_fahr_cels3 = 9;
echo 'градусы Фаренгейта: ', $var_fahr_cels, '; коэффициент 1: ', $koef_fahr_cels1, '; коэффициент 2: ', $koef_fahr_cels2, '; коэффициент 3: ', $koef_fahr_cels3;
?>
<h4>Результат:</h4>
<?php
$res_fahr_cels = ($var_fahr_cels - $koef_fahr_cels1) * $koef_fahr_cels2 / $koef_fahr_cels3;
echo $res_fahr_cels, ' градусов Цельсия';
?>
<br> <br>

<!-- Морские мили в километры -->
<h3>1.7. Морские мили в километры</h3>
<h4>Исходные данные:</h4>
<?php
$var_nmiles_km = 1;
$koef_nmiles_km = 1.852;
echo 'морские мили: ', $var_nmiles_km, '; коэффициент перевода: ', $koef_nmiles_km;
?>
<h4>Результат:</h4>
<?php
$res_nmiles_km = $var_nmiles_km * $koef_nmiles_km;
echo $res_nmiles_km, ' километров';
?>
<br> <br>

<!-- Километры в сантиметры -->
<h3>1.8. Километры в сантиметры</h3>
<h4>Исходные данные:</h4>
<?php
$var_km_cm = 1;
$koef_km_cm = 100000;
echo 'километры: ', $var_km_cm, '; коэффициент перевода: ', $koef_km_cm;
?>
<h4>Результат:</h4>
<?php
$res_km_cm = $var_km_cm * $koef_km_cm;
echo $res_km_cm, ' сантиметров';
?>
<br> <br>

<!-- Футы в метры -->
<h3>1.9. Футы в метры</h3>
<h4>Исходные данные:</h4>
<?php
$var_feet_m = 1;
$koef_feet_m = 0.3048;
echo 'футы: ', $var_feet_m, '; коэффициент перевода: ', $koef_feet_m;
?>
<h4>Результат:</h4>
<?php
$res_feet_m = $var_feet_m * $koef_feet_m;
echo $res_feet_m , ' метров';
?>
<br> <br>

<!-- Английские галлоны в литры -->
<h3>1.10. Английские галлоны в литры</h3>
<h4>Исходные данные:</h4>
<?php
$var_gallon_liter = 1;
$koef_gallon_liter = 4.54609;
echo 'английские галлоны: ', $var_gallon_liter, '; коэффициент перевода: ', $koef_gallon_liter;
?>
<h4>Результат:</h4>
<?php
$res_gallon_liter = $var_gallon_liter * $koef_gallon_liter;
echo $res_gallon_liter, ' литров';
?>
<br> <br>


<h2>Задача 2. Расчет скорости движения машины</h2>
<h4>Исходные данные:</h4>
<?php
$input_way = 1;
$input_time_hour = 1;
$input_time_min = 1;
echo 'скорость, км: ', $input_way, '; время движения, часы: ', $input_time_hour, ', минуты: ', $input_time_min;
?>
<h4>Результат:</h4>
<?php
$speed_min = $input_way / ($input_time_hour + $input_time_min / 60);
$speed_sec = ($input_way * 1000) / (($input_time_hour * 3600) + ($input_time_min * 60));
echo 'Скорость движения машины: ';
echo round($speed_min, 2), ' км/час ';
echo 'или ', round($speed_sec, 2), ' м/сек';
?>
<br> <br>

<h2>Задача 3. Остаток от деления</h2>
<h4>Исходные данные:</h4>
<?php
$a = 10;
$b = 3;
echo 'a=', $a, ' b=', $b;
?>
<br>
<h3>Результат:</h3>
<p>Остаток от деления:</p>
<?php
echo $a % $b;
?>
<br> <br>

<h2>Задача 4. Возведение в степень</h2>
<h4>Исходные данные:</h4>
<p>Возвести 2 в 10 степень</p>
<?php
$numb = 2;
$deg = 10;
?>
<h3>Результат:</h3>
<p>Степень числа</p>
<?php
echo pow($numb, $deg);
?>
<br> <br>

<h2>Задача 5. Вывод текущей даты</h2>
<h4>Сегодня:</h4>
<?php
echo date("d.m.Y");
?>
<br> <br>

<h2>Задача 6. Сумма процентов</h2>
<h4>Исходные данные:</h4>
<?php
$perc1 = 100;
$perc2 = 200;
$perc3 = 300;
$perc4 = 400;
$perc5 = 500;
echo $perc1, ' ', $perc2, ' ', $perc3, ' ', $perc4, ' ', $perc5;
?>
<h4>Результат:</h4>
<p>Сумма процентов чисел </p>
<?php
$perc = ($perc1+$perc2+$perc3+$perc4+$perc5) * 0.1;
echo $perc;
?>
<br> <br>

<h2>Задача 7. Перевод числа в коэффициент, обратное действие</h2>

<!-- Перевод числа в коэффициент -->
<h3>7.1. Перевод числа в коэффициент</h3>
<h4>Исходные данные:</h4>
<?php
$var_num = 20;
echo 'число: ', $var_num;
?>
<h4>Результат:</h4>
<?php
function Num($num)
{
    $num = $num / 100 + 1;
    return $num;
} 
$res_num = Num($var_num);
echo $res_num;
?>
<br> <br>

<!-- Перевод коэффициента в число  -->
<h3>7.2. Перевод коэффициента в число</h3>
<h4>Исходные данные:</h4>
<?php
$var_koef = 1.3;
echo 'коэффициент: ', $var_koef;
?>
<h4>Результат:</h4>
<?php
function Koef($koef)
{
    $koef = ($koef - 1) * 100;
    return $koef;
} 
$res_koef = Koef($var_koef);
echo $res_koef;
?>
<br> <br>

</body>
</html>
