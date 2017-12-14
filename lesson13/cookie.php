<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

$name = strip_tags(trim('name'));
$value = strip_tags(trim('test'));
$time = strip_tags(trim(3600));
$path = '/';
$domain = '';
$secure = strip_tags(trim(false));
$httponly = strip_tags(trim(true));

class Cookie
{
    private $name;
    private $value;
    private $time;
    private $path;
    private $domain;
    private $secure;
    private $httponly;

    public function __construct($name, $value, $time, $path, $domain, $secure, $httponly)
    {
        $this->name = $name;
        $this->value = $value;
        $this->time = $time;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->httponly = $httponly;
    }

    public function setCook()
    {
        setcookie($this->name, $this->value, time() + $this->time, $this->path, $this->domain, $this->secure, $this->httponly);
    }

    public function getCook()
    {
        return (isset($_COOKIE[$this->name])) ? $_COOKIE[$this->name] : null;
    }

    public function delCook()
    {
        $this->time = -3600;
        $this->setCook();
        unset($_COOKIE[$this->name]);
    }

}
$cookie = new Cookie($name, $value, $time, $path, $domain, $secure, $httponly);
$cookie->setCook();
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
<h2 style="text-align: center; color: #4aae00">3.2. Наследование - класс  Cookie</h2>
<h4>Вывод куки:</h4>

<?php
if (isset($name) && isset($value) && isset($time) && isset($path) && isset($domain) && isset($secure) && isset($httponly)) {
    $gcook = $cookie->getCook();
    var_dump($gcook);
} else echo '<p>Заполните, пожалуйста, данные</p>';
?>

</body>
</html>
