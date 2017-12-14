<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP урок 13</title>
</head>
<body>
<h1 style="text-align: center">Урок №13 ООП</h1>
<ul>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=worker1.php>1.1. Класс Worker - public поля </a></li>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=worker2.php>1.2. Класс Worker - private поля </a>
    </li>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=worker3.php>1.3. Класс Worker - private поля, private метод checkAge </a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=worker4.php>2. На __construct </a></li>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=user.php>3.1. Наследование - классы  User, Worker</a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=cookie.php>3.2. Наследование - класс  Cookie</a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=session.php>3.3. Наследование - класс  Session</a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=flash.php>4. Класс Flash - использование класса  Session</a>
    <li style="list-style-type: none"><a style="font-size: 1.5em; padding-right: 15px" href=db.php>5. Класс-оболочка Db над базами данных</a>

</ul>
<h2 style="text-align: center; color: #d9534f">2. На __construct</h2>

<?php

class Worker
{
    private $name;
    private $salary;

    public function __construct($name, $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getAgeSalary($age)
    {
        return $age * $this->getSalary();
    }

}

$name = strip_tags(trim('Дима'));
$salary = strip_tags(trim(1000));
$age = strip_tags(trim(25));

if (!empty($name) && !empty($name) && !empty($age)) {

    $worker = new Worker($name, $salary);
    $worker->age = $age;

    echo '<h4>Произведение возраста и зарплаты работника ', $worker->getName(), ': </h4>', $worker->getAgeSalary($age), PHP_EOL;

} else echo '<p>Заполните, пожалуйста, данные</p>';

?>

</body>

</html>
