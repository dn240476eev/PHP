<?php
require_once 'session.php';
ini_set('display_errors', true);
error_reporting(E_ALL);

$key = strip_tags(trim('message'));
$value = strip_tags(trim('message for session_test'));

class Flash
{
    private $key;
    private $value;
    private $sess;

//    public function __construct()
//    {
//        session_start();
//    }

    public function __construct($key, $value){
        $this->sess = new Session($key, $value);
        $this->key = $key;
        $this->value = $value;
    }

    public function setMessage()
    {
        $this->sess->setSess();
    }

    public function getMessage()
    {
        return $this->sess->getSess();
    }

}
$flash = new Flash($key, $value);
$flash->setMessage();
?>

<h2 style="text-align: center">4. Класс Flash - использование класса  Session</h2>
<h4>Вывод сессии сообщения пользователя:</h4>

<?php
$gmess = $flash->getMessage();
var_dump($gmess);
?>

