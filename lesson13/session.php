<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

$key = strip_tags(trim('id'));
$value = strip_tags(trim('session_test'));

class Session
{
    private $key;
    private $value;

//    public function __construct()
//    {
//        session_start();
//    }

    public function __construct($key, $value){
        if( !isset($_SESSION) ){
            $this->init_session();
        }
        $this->key = $key;
        $this->value = $value;
    }

    public function init_session(){
        session_start();
    }

    public function sess_exist(){
        if( isset($_SESSION[$this->key]) ){
            return true;
        }
        else{
            return false;
        }
    }

    public function setSess()
    {
        $this->sess_exist();
        $_SESSION[$this->key] = $this->value;
    }

    public function getSess()
    {
        $this->sess_exist();
        return (!empty($_SESSION[$this->key])) ? $_SESSION[$this->key] : false;
    }

    public function delSess()
    {
        if (isset($_SESSION[$this->key])) {
            unset($_SESSION[$this->key]);
            return true;
        }
        return false;
    }

}
$session = new Session($key, $value);
$session->setSess();
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
<h2 style="text-align: center; color: #ce8483">3.3. Наследование - класс  Session</h2>
<h4>Вывод сессии:</h4>

<?php
$gsess = $session->getSess();
var_dump($gsess);
?>

</body>
</html>
