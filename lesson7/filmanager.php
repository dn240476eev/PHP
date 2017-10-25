<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filemanager</title>
</head>

<body>

<div style="max-width: 100%; margin: 0 auto">
    <h1 style="text-align: center">Файл-менеджер загрузки изображений</h1>
    <div style="max-width: 100%; margin: 0 auto; border: 3px solid #333">
        <div style="width: calc(40% - 30px - 6px); min-height: 80vh; float: left; padding: 15px">
            <form method="post" enctype="multipart/form-data" style="margin-bottom: 30px">
                <h2>Загрузка изображений</h2>
                <div style="height: 1px; background: #C0C0C0; width: 85%; margin-bottom: 25px"></div>
                <input type="text" name="name" value="" placeholder="Выберите файл">
                <input type="file" name="files[]" multiple="">

                <input style="display: block; margin-top: 30px" type="submit" name="multipart" value="Загрузить">
            </form>

            <?php loadFile() ?>

        </div>
        <div style="width: calc(60% - 30px - 6px); min-height: 80vh; border-left: 3px solid #333; float:left; padding: 15px">
            <h2>Загруженные изображения</h2>
            <div style="height: 1px; background: #C0C0C0; width: 85%; margin-bottom: 25px"></div>
            <?php viewImg() ?>
        </div>
        <div style="clear: both"></div>
    </div>
</div>

<?php
echo __FILE__;
echo $_SERVER['PHP_SELF'];
  // Мультизагрузка файлов:

function loadFile() {
     if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES) && $_POST['multipart']) {
         $array_ext = array('jpg', 'jpeg', 'png', 'gif');
         $files =  $_FILES['files'];
         $cnt = count($files['name']);

//         print_r($files);

     for ($i=0; $i<$cnt; $i++) {
         $name = pathinfo($files['name'][$i], PATHINFO_FILENAME);
         $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);

         if (in_array($ext, $array_ext)) {
             $hash = substr(md5($name.date('Y-m-d-H-i-s').rand(1,1000)),0,10);
             $filename = str2url($name)."_".$hash.".".$ext;
             if(move_uploaded_file($files['tmp_name'][$i], 'files/'.$filename)) {
                 echo "'" . $_SERVER['DOCUMENT_ROOT'] . "files/" . $files['name'][$i] . "'" . " - OK <br>";

             } else {
                 echo "'" . $files['name'][$i] . "'" . " - ERROR<br>";
             }
         } else {
             echo "'" . $files['name'][$i] . "'" . " - не верный формат файла - возможные расширения jpg, jpeg, png, gif<br>";
         }

         }
     }
}

// Мультизагрузка файлов END


// Транслит:

function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}

function str2url($str) {
    // переводим в транслит
    $str = rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
}

// Транслит END


// Вывод изображений

function viewImg()
{
    $dir = 'files/'; // Папка с изображениями
    $cols = 1; // Количество столбцов в будущей таблице с картинками
    $files = scandir($dir, 1); // Берём всё содержимое директории
    $array_ext = array('jpg', 'jpeg', 'png', 'gif');

    echo "<table>"; // Начинаем таблицу
    $k = 0; // Вспомогательный счётчик для перехода на новые строки
    if (count($files)>2) {
        for ($i = 0; $i < count($files); $i++) { // Перебираем все файлы
            $ext = pathinfo($files[$i], PATHINFO_EXTENSION);
            if (in_array($ext, $array_ext)) {
                if (($files[$i] != ".") && ($files[$i] != "..")) { // Текущий каталог и родительский пропускаем
                    if ($k % $cols == 0) echo "<tr>"; // Добавляем новую строку
                    $path = $dir . $files[$i]; // Получаем путь к картинке
                    echo "<td>"; // Начинаем столбец
                    echo "<a href='$path'>" . $_SERVER['DOCUMENT_ROOT'] . "/" . $path . "</a>" ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo "</td>"; // Закрываем столбец
                    echo "<td>"; // Начинаем столбец
                    echo "<a href='$path'>";
                    echo "<img src='$path' alt='' width='100' />"; // Вывод превью картинки
                    echo "</a>";
                    echo "</td>"; // Закрываем столбец
                    /* Закрываем строку, если необходимое количество было выведено, либо данная итерация последняя */
                    if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
                    $k++; // Увеличиваем вспомогательный счётчик
                }
            }
        }
        echo "</table>"; // Закрываем таблицу
    } else echo 'Папка пуста';
}

// Вывод изображений END

?>


</body>
</html>
