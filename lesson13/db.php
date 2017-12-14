<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP урок 13</title>
</head>
<body>
<h1 style="text-align: center">Урок №13 ООП</h1>
<ul>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=worker1.php>1.1. Класс Worker - public поля </a></li>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=worker2.php>1.2. Класс Worker - private поля </a></li>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=worker3.php>1.3. Класс Worker - private поля, private метод checkAge </a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=worker4.php>2. На __construct </a></li>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=user.php>3.1. Наследование - классы  User, Worker</a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=cookie.php>3.2. Наследование - класс  Cookie</a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=session.php>3.3. Наследование - класс  Session</a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=flash.php>4. Класс Flash - использование класса  Session</a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=db.php>5. Класс-оболочка Db над базами данных</a>

</ul>
<h2 style="text-align: center; color: #ce8483">5. Класс-оболочка Db над базами данных</h2>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "lesson11";
$table = 'users';
$id = strip_tags(trim('2'));
$field = strip_tags(trim('name'));
$fieldrepl = strip_tags(trim('Custom name +++'));

class Db
{
    private $link;
    private $host;
    private $user;
    private $pass;
    private $db;
    private $table;

//    Соединение с БД
    public function  __construct($host, $user, $pass, $db, $table)
    {
        $this->link = mysqli_connect($host, $user, $pass, $db) or ('Database Connection Error: '.mysqli_connect_error());
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->table = $table;
    }

//     Запрос к БД
    private function makeQuery($query)
    {
        if(!empty($this->link) && !empty($query)) {
            $res_query = mysqli_query($this->link, $query);
            return $res_query;
        } else return false;
    }

//    Получение данных из БД
    public function getDb($id, $field)
    {
        $table = $this->table;
        $query = "SELECT $field FROM $table WHERE id=$id";
        $result = mysqli_fetch_assoc($this->makeQuery($query));
        return $result[$field];
    }

//    Редактирование данных БД
    public function upDb($id, $field, $fieldrepl)
    {
        $table = $this->table;
        $query = "UPDATE $table SET $field = '$fieldrepl' WHERE id=$id";
        $this->makeQuery($query);
    }

//      Подсчет данных из БД
    public function calcDb($field)
    {
        $i = 0;
        $users_name = array();
        $table = $this->table;
        $query = "SELECT $field FROM $table";
        $result = $this->makeQuery($query);
        while ($row = mysqli_fetch_assoc($result)) {
            $users_name[] = $row;
            $i++;
        }
        return $i;
    }

//      Удаление данных из БД
    public function delDb($id)
    {
        $table = $this->table;
        $query = "DELETE FROM $table WHERE id=$id";
        $this->makeQuery($query);
    }

//      Очистка 1 таблицы БД
    public function delTablDb()
    {
        $table = $this->table;
        $query = "TRUNCATE TABLE $table";
        $this->makeQuery($query);
    }


//      Очистка всех таблиц БД
    public function delAllTablDb()
    {
        $tables_db = array();
        $query = "SHOW TABLES";
        $result = $this->makeQuery($query);
        while ($row = mysqli_fetch_assoc($result)) {
            $tables_db[] = $row;
        }
        foreach ($tables_db as $table) {
            foreach ($table as $table_name) {
                $query = "TRUNCATE TABLE $table_name";
                $this->makeQuery($query);
            }
        }

    }

    public function __destruct() {
        if (empty(mysqli_connect_errno ())) mysqli_close($this->link);
    }

}
$db = new Db($host, $user, $pass, $db, $table);
$updb = $db->upDb($id, $field, $fieldrepl);
$gdb = $db->getDb($id, $field);
$calcdb = $db->calcDb($field);
//$delltable = $db->delTablDb();
//$dellalltable = $db->delAllTablDb();

?>
<h4>Вывод по Select после Update:</h4>
<?php var_dump($gdb); ?>
<h4>Количество пользователей в БД:</h4>
<?php  echo $calcdb; ?>

</body>
</html>
