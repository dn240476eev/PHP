<?php
class Files extends Database
{

    private $filename;
    // Транслит:

    public function rusTranslit($string) {
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

    public function strFile($str) {
        // переводим в транслит
        $str = $this->rusTranslit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }

// Транслит END


    public function addFile($id, $bd, $field, $file)
    {
        // В простом варианте загрузка файлов из формы:

        if(empty($id) || empty($file['name'])){
            return false;
        }
        print_r($id);
        print_r($bd);
        print_r($field);
        $array_ext = array('jpg', 'jpeg', 'png', 'gif');

        $files =  $_FILES['files'];
        $name = pathinfo($files['name'], PATHINFO_FILENAME);
        $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
        if (in_array($ext, $array_ext)) {
            $hash = substr(md5($name.date('Y-m-d-H-i-s').rand(1,1000)),0,10);
            $this->filename = $this->strFile($name)."_".$hash.".".$ext;
            if(move_uploaded_file($files['tmp_name'], '../uploads/'.$this->filename)) {
                $query = "UPDATE $bd SET `$field[0]` = '$this->filename' WHERE id = $id";
                $this->query($query);
                return $this->resId();
            } else {
                return false;
            }
        } else {
            return false;
        }

    }


    public function addFiles($id, $bd, $field, $file)
    {
        // В простом варианте загрузка файлов из формы:

        if(empty($id)|| empty($file['name'])) {
            return false;
        }
         $array_ext = array('jpg', 'jpeg', 'png', 'gif');

         $files =  $_FILES['files'];
         $name = pathinfo($files['name'], PATHINFO_FILENAME);
         $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
         $colum_sql = implode(',',$field);
        if (in_array($ext, $array_ext)) {
             $hash = substr(md5($name.date('Y-m-d-H-i-s').rand(1,1000)),0,10);
             $this->filename = $this->strFile($name)."_".$hash.".".$ext;
             if(move_uploaded_file($files['tmp_name'], '../uploads/'.$this->filename)) {
                 $query = "INSERT INTO $bd ($colum_sql) VALUES ('$this->filename', '$id')";
                 $this->query($query);
                 return $this->resId();
             } else {
                 return false;
             }
         } else {
             return false;
         }


// В простом варианте загрузка файлов: END//////////////////////////////////////////

    }


    function updateFile($id, $bd, $field, $file)
    {
        if(empty($file['name'])) {
            return false;
        }
        $query = "SELECT $field[0] FROM $bd WHERE id = $id LIMIT 1";
        $this->query($query);

        if (isset($file_res)) {

            $dir = '../uploads/'; // Папка с изображениями
            $files_old = scandir($dir, 1); // Берём всё содержимое директории
            $flag = 0;
            if (count($files_old) > 2) {
                for ($i = 0; $i < count($files_old); $i++) { // Перебираем все файлы
                    $ext = pathinfo($files_old[$i], PATHINFO_EXTENSION);
                    if (($files_old[$i] != ".") && ($files_old[$i] != "..")) { // Текущий каталог и родительский пропускаем

                        if ($files_old[$i] = $file_res[$field[0]]) {
                            $flag = 1;
                            $path = $dir . $files_old[$i]; // Получаем путь к картинке
                            if (file_exists($path)) {
                                unlink($path);
                            }

                            $array_ext = array('jpg', 'jpeg', 'png', 'gif');

                            $files =  $_FILES['files'];
                            $name = pathinfo($files['name'], PATHINFO_FILENAME);
                            $ext = pathinfo($files['name'], PATHINFO_EXTENSION);

                            if (in_array($ext, $array_ext)) {
                                $hash = substr(md5($name.date('Y-m-d-H-i-s').rand(1,1000)),0,10);
                                $this->filename = $this->strFile($name)."_".$hash.".".$ext;
                                if(move_uploaded_file($files['tmp_name'], '../uploads/'.$this->filename)) {
                                    $query = "UPDATE $bd SET `$field[0]` = '$this->filename' WHERE id = $id";
                                    $this->query($query);
                                    return $this->resId();
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        }
                    }
                }

                if ($flag == 0) {
                    $this->addFile($id, $bd, $field, $file);
                }

            } else {
                $this->addFile($id, $bd, $field, $file);
            }
        } else {
            $this->addFile($id, $bd, $field, $file);
        }
    }


    function updateFiles($id, $bd, $field, $file)
    {
        if(empty($file['name'])) {
            return false;
        }
        $colum_sql = implode(',',$field);
        $query = "SELECT $field[0] FROM $bd WHERE $field[1] = $id LIMIT 1";
        $this->query($query);
        $file_res = $this->result();

        if (isset($file_res)) {

            $dir = '../uploads/'; // Папка с изображениями
            $files_old = scandir($dir, 1); // Берём всё содержимое директории
            $flag = 0;
            if (count($files_old) > 2) {
                for ($i = 0; $i < count($files_old); $i++) { // Перебираем все файлы
                    $ext = pathinfo($files_old[$i], PATHINFO_EXTENSION);
                    if (($files_old[$i] != ".") && ($files_old[$i] != "..")) { // Текущий каталог и родительский пропускаем

                        if ($files_old[$i] = $file_res[$field[0]]) {
                            $flag = 1;
                            $path = $dir . $files_old[$i]; // Получаем путь к картинке
                            if (file_exists($path)) {
                                unlink($path);
                            }

                            $array_ext = array('jpg', 'jpeg', 'png', 'gif');

                            $files =  $_FILES['files'];
                            $name = pathinfo($files['name'], PATHINFO_FILENAME);
                            $ext = pathinfo($files['name'], PATHINFO_EXTENSION);

                            if (in_array($ext, $array_ext)) {
                                $hash = substr(md5($name.date('Y-m-d-H-i-s').rand(1,1000)),0,10);
                                $this->filename = $this->strFile($name)."_".$hash.".".$ext;
                                if(move_uploaded_file($files['tmp_name'], '../uploads/'.$this->filename)) {
                                    $query = "UPDATE $bd SET `$field[0]` = '$this->filename' WHERE $field[1] = $id";
                                    $this->query($query);
                                    return $this->resId();
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        }
                    }
                }
                if ($flag == 0) {
                    $this->delBlankFile($id, $bd, $field);
                    $this->addFiles($id, $bd, $field, $file);
                }

            } else {
                $this->delBlankFile($id, $bd, $field);
                $this->addFiles($id, $bd, $field, $file);
            }
        } else {
            $this->addFiles($id, $bd, $field, $file);
        }
    }


    public function delBlankFile($id, $bd, $field)
    {
        if(empty($id)) {
            return false;
        }
        $query = "DELETE FROM $bd WHERE $field[1] = $id LIMIT 1";
        $this->query($query);
    }

    public function delBlankFiles($bd, $field, $operation)
    {
        foreach ($operation as $key => $id) {
            $this->delBlankFile($id, $bd, $field);
        }
    }


    public function delFile($id, $bd, $field)
    {
        if(empty($id)) {
            return false;
        }
        $query = "SELECT $field[0] FROM $bd WHERE $field[1] = $id LIMIT 1";
        $this->query($query);
        $file_res = $this->result();
        print_r($file_res[$field[0]]);

        if (isset($file_res)) {
            $dir = '../uploads/'; // Папка с изображениями
            $files_old = scandir($dir, 1); // Берём всё содержимое директории
            $flag = 0;
            if (count($files_old) > 2) {
                for ($i = 0; $i < count($files_old); $i++) { // Перебираем все файлы
                    $ext = pathinfo($files_old[$i], PATHINFO_EXTENSION);
                    if (($files_old[$i] != ".") && ($files_old[$i] != "..")) { // Текущий каталог и родительский пропускаем

                        if ($files_old[$i] = $file_res[$field[0]]) {
                            $flag = 1;
                            $path = $dir . $files_old[$i]; // Получаем путь к картинке
                            if (file_exists($path)) {
                                unlink($path);
                            }
                        }
                    }
                }
            }
        }
    }


    public function delFiles($bd, $field, $operation)
    {
        foreach ($operation as $key => $id) {
                $this->delFile($id, $bd, $field);
        }
    }

}