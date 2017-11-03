<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP ДЗ урок 7</title>
</head>

<body>

<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>

<h1>PHP Урок 7 Домашнее задание</h1>

<!-- Задача 1.  -->
<h3>Задача 1. Создать текстовую гостевую книгу</h3>
<p>Сделать на страничке форму, в которой будет одно поле для ввода имени. После ввода имени и нажатия кнопки Ок, в файл (название произвольное)
    Записать имя, дату и посещенную страницу в файл.
</p>
<div>
    <form method="post">
        <h4 style="display: inline-block">Введите Ваше имя:</h4>
        <input type="text" name="name" value="" placeholder="имя" >

        <input type="submit" name="register" value="OK">
    </form>

    <?php
        if (isset($_POST['name'])) {
            Guest($_POST['name']);
        }
    ?>
</div>

<?php
    function Guest($name)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['register']) {
            $name = $_POST['name'];
            $flag = 1;
            $ext = '&, ", \, \', <, >,';

            if (!empty($name)) {
//                if (strip_tags($name) !== $name || trim($name) !== $name) {
//                    $flag = 0;
//                }
                if (htmlspecialchars($name, ENT_QUOTES) !== $name || trim($name) !== $name) {
                    $flag = 0;
                }

                if ($flag) {
                    $f = fopen('files/guests.txt', 'a+');
                    fwrite($f, $name . '::' . date('d m Y H:i:s') . '::' . __FILE__ . "\n");
                    //            echo __FILE__;
                    //            echo $_SERVER['PHP_SELF'];
                    rewind($f);
                    echo "<h4>Гостевая книга:</h4>";
                    while (!feof($f)) {
                        echo htmlspecialchars(fgets($f)) . "<br/>";
                    }

                    fclose($f);
                } else echo 'Вводимые данные не должны содержать символов ' . $ext . ' пробелов';
            } else echo 'Введите Ваше имя';
        }
    }

?>


<br>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!-- Задача 2.  -->
<h3>Задача 2. Запись/чтение из файла </h3>
<p>Создать текстовый файл, записать в него 1000 случайных чисел в диапазоне от 1 до 500(столбиком).
    Прочитать файл в массив и записать два разных файла.
    В одном файле записать только парные числа
    В другом файле записать тольно непарные числа
    Писать в формате ключ массива => число.
</p>

<div>
    <?php file_chois('rand.txt', 'even.txt', 'odd.txt' ) ?>
</div>

<?php

function file_chois($r, $e, $o) {
    $r = 'rand.txt';
    $e = 'even.txt';
    $o = 'odd.txt';

        $file = fopen("files/$r", 'w+');
        $file_even = fopen("files/$e", 'w+');
        $file_odd = fopen("files/$o", 'w+');

        for ($i = 1; $i <= 1000; $i++) {
            fwrite($file, mt_rand(1, 500) . "\n");
        }

        if (!empty($file)) {
            $file = fopen("files/$r", 'r');

            $tmp = array();
            while ($line = fgets($file)) {
                $tmp[] = $line; // Записали в элемент массива строку из файла
            }
            foreach ($tmp as $key => $numb) {
                if (!(trim($numb) % 2)) {
                    fwrite($file_even, $key . '=>' . trim($numb) . "\n");
                } else {
                    fwrite($file_odd, $key . '=>' . trim($numb) . "\n");

                }
            }

        rewind($file); // сброс файлового указателя на начало файла
        rewind($file_even);
        rewind($file_odd);

        echo "<div style='float: left; margin: 0 10px'>";
        echo "<h4>Исходный файл</h4>";
        while(!feof($file)) {
            echo htmlspecialchars(fgets($file)) . "<br/>";
        }
        echo "</div >";

        echo "<div style='float: left; margin: 0 10px'>";
        echo "<h4>Файл парных чисел</h4>";
        while(!feof($file_even)) {
            echo fgets($file_even) . "<br/>";
        }
        echo "</div >";

        echo "<div style='float: left; margin: 0 10px'>";
        echo "<h4>Файл непарных чисел</h4>";
        while(!feof($file_odd)) {
            echo fgets($file_odd) . "<br/>";
        }
        echo "</div >";
        echo "<div style='clear: both'></div >";

        fclose($file);
        fclose($file_even);
        fclose($file_odd);

    }
}

?>

<br>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!-- Задача 3.   -->
<h3>Задача 3. Форма для загрузки изображений к товару</h3>
<p>Создать форму для загрузки изображений к товару.
    Сделать отдельный файл filemanager.php который должен иметь следующий функционал:
    Левая часть страницы:
    1.	Форма с полей для прикрепления фото (мультизагрузка)
    2.	Вывод сообщения о том был ли загружен файл и в какую папку
    Правая часть страницы:
    1.Окно с отображением содержимого папки, куда загружалось фото. Отображать нужно только графические файлы.
</p>

<div>
    <a href="filmanager.php" style="text-transform: uppercase; font-size: 1.2em; font-weight: bold">Файл менеджер загрузки изображений</a>
</div>
<br>

</body>
</html>
