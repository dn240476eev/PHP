<?php require_once 'functions.php' ?>
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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>PHP урок 11</title>
</head>
<body>
    <h1 style="text-align: center">Урок №11 MYSQL и PHP</h1>
    <ul>
        <li style="display: inline-block"><a style="font-size: 1.5em; padding-right: 15px" href=index.php>Главная</a></li>
        <li style="display: inline-block"><a style="font-size: 1.5em; padding-right: 15px" href=register.php>Регистрация</a></li>
        <li style="display: inline-block"><a style="font-size: 1.5em; padding-right: 15px" href=login.php>Авторизация</a></li>
    </ul>
    <?php
        $link = connect("localhost", "root", "", "lesson11");
        $query = "SELECT id, name, email FROM users";
        if($res = query ($link, $query)){
            $array = fetch_assoc_all($res);
        }
        close($link);
    ?>
    <?php if (isset($array) && is_array($array) && count($array) > 0) : ?>
        <h2 style="text-align: center">Перечень пользователей базы users</h2>
        <table border="1px solid #f03f03" style="min-width: 350px; margin: 0 auto">
            <tr>
                <td>id</td>
                <td>name</td>
                <td>email</td>
            </tr>
        <?php foreach ($array as $user) : ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['name'] ?></td>
                <td><?php echo $user['email'] ?></td>
            </tr>
        <?php endforeach ?>
        <!-- print_r($array); -->
        </table>
    <?php endif ?>

</body>

</html>
