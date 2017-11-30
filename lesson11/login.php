<?php
    session_start();
    require_once 'functions.php';
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
    <ul>
        <li style="display: inline-block"><a style="font-size: 1.5em; padding-right: 15px" href=index.php>Главная</a></li>
        <li style="display: inline-block"><a style="font-size: 1.5em; padding-right: 15px" href=register.php>Регистрация</a></li>
        <li style="display: inline-block"><a style="font-size: 1.5em; padding-right: 15px" href=login.php>Авторизация</a></li>
    </ul>

    <div class="login_form" style="text-align: center; margin: 0 auto">
        <h1>Вход в личный кабинет:</h1>
        <form method="post">
            <h3>Введите email:</h3>
            <input type="text" name="email" value="" placeholder="введите email" required>
            <br>
            <h3>Введите пароль: </h3>
            <input type="password" name="password" value="" placeholder="введите пароль" required>
            <br>
            <input style="margin-top: 25px"type="submit" name="login" value="Войти" required>
        </form>
        <?php
            $link = connect("localhost", "root", "", "lesson11");
            $flag = 0;
            if (isset($_POST['login'])) {
                    $email = strip_tags(trim($_POST['email']));
                    $pass = strip_tags(trim($_POST['password']));
                    // только латинские буквы, цифры, знаки .-
                    $match_email = preg_match("/^([a-z0-9\-?\.?]+@[a-z\-?\.?]+\.[a-z]{2,6}+)$/ui", $email);
                    if (!empty($email) && !empty($pass)) {
                        if ($match_email) {
                            $query = "SELECT id, name, email, pass FROM users WHERE email = '$email' LIMIT 1";
                            if ($res = query($link, $query)) {
                                $array = fetch_assoc($res);
                                if (isset($array) && is_array($array) && count($array) > 0) {
                                    if ($email == $array['email'] && password_verify($pass, $array['pass'])) {
                                        $_SESSION['id'] = $array['id'];
                                        $flag = 1;
                                    } else  echo "<p style='color: red'>Не верно введен логин или пароль</p>";
                                    // print_r($array);
                                }
                            }
                        } else echo "<p style='color: red'>Email адрес не существует, введите правильный email</p>";
                     } else echo "<p style='color: red'>Введите логин и пароль</p>";
                }
            ?>

            <?php if ($flag) : ?>
                <p>Добро пожаловать,  <?php echo $array['email'] ?> !</p>
                <h2 style="text-align: center">Ваши зарегистрированные данные:</h2>
                <table border="1px solid #f03f03" style="min-width: 350px; margin: 0 auto">
                    <tr>
                        <td>id</td>
                        <td>name</td>
                        <td>email</td>
                    </tr>
                        <tr>
                            <td><?php echo $array['id'] ?></td>
                            <td><?php echo $array['name'] ?></td>
                            <td><?php echo $array['email'] ?></td>
                        </tr>
                    <!-- print_r($array); -->
                </table>
                <p>$_SESSION['id'] = <?php echo $_SESSION['id'] ?></p>
            <?php endif ?>
            <?php close($link); ?>


    </div>
</body>
</html>
