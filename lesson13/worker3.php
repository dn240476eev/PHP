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
<h2 style="text-align: center; color: green;">1.3. Класс Worker - private поля, private метод checkAge</h2>

<?php

class Worker
{
    private $name;
    private $age;
    private $salary;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAge($age)
    {
        $this->age = $this->checkAge($age);
    }

    public function getAge()
    {
        return $this->age;
    }

    private function checkAge($age)
    {
        $this->age = $age;
        if ($this->age < 100 && $this->age > 1){
            return $this->age;
        } else {
            return 0;
        }
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }


}

$name1 = strip_tags(trim('Иван'));
$age1 = strip_tags(trim(25));
$salary1 = strip_tags(trim(1000));

$name2 = strip_tags(trim('Вася'));
$age2 = strip_tags(trim(260));
$salary2 = strip_tags(trim(2000));

if (!empty($name1) && !empty($name2) && !empty($age1) && !empty($age2) && !empty($salary1) && !empty($salary1)) {

    $worker1 = new Worker();
    $worker1->setName($name1);
    $worker1->setAge($age1);
    $worker1->setSalary($salary1);

    $worker2 = $worker2 = new Worker();
    $worker2->setName($name2);
    $worker2->setAge($age2);
    $worker2->setSalary($salary2);

    $summ_salary = $worker1->getSalary() + $worker2->getSalary();
    echo '<h4>Сумма зарплат работников ', $worker1->getName(), ', ', $worker2->getName(), ': </h4>', $summ_salary, PHP_EOL;

    echo '<h4>Сумма возрастов работников ', $worker1->getName(), ', ', $worker2->getName(), ': </h4>';
    if ($worker1->getAge() || $worker2->getAge()) {
        if ($worker1->getAge()) {
            if ($worker2->getAge()) {
                $summ_age = $worker1->getAge() + $worker2->getAge();
                echo $summ_age . PHP_EOL;
            } else  echo 'Возраст работника ', $worker2->getName(), ' не корректный, укажите, пожалуйста корректный возраст';
        } else  echo 'Возраст работника ', $worker1->getName(), ' не корректный, укажите, пожалуйста корректный возраст';
    } else  echo 'Возраст работников ', $worker1->getName(), ', ', $worker2->getName(), ' не корректный, укажите, пожалуйста корректный возраст';

} else echo '<p>Заполните, пожалуйста, данные</p>';

?>

</body>

</html>
