<?php
    require_once 'functions.php';
    if (isset($_POST['register'])) {
        $post_array = array($_POST['name'], $_POST['email'], $_POST['password']);
    }
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
<body >
    <ul>
        <li style="display: inline-block"><a style="font-size: 1.5em; padding-right: 15px" href=index.php>Главная</a></li>
        <li style="display: inline-block"><a style="font-size: 1.5em; padding-right: 15px" href=register.php>Регистрация</a></li>
        <li style="display: inline-block"><a style="font-size: 1.5em; padding-right: 15px" href=login.php>Авторизация</a></li>
    </ul>
    <div class="register_form" style="text-align: center; margin: 0 auto">
        <h1>Регистрация:</h1>
        <form  method="post">
            <h3>Введите Ваше имя *:</h3>
            <input style="width: 350px" type="text" name="name" value="<?= (isset($post_array) ? $post_array[0] : '') ?>" title="только кирилические буквы, символ дефиз, без цифр" placeholder="только кирилические буквы, символ дефиз, без цифр" required>
            <br>
            <h3>Введите Ваш e-mail *:</h3>
            <input style="width: 350px" ype="text" name="email" value="<?= (isset($post_array) ? $post_array[1] : '') ?>" title="только латинские буквы, знаки .-" placeholder="только латинские буквы, знаки .-" required>
            <br>
            <h3>Введите пароль *:</h3>
            <input style="width: 350px" type="password" name="password" value="<?= (isset($post_array) ? $post_array[2] : '') ?>" title="не менее 4-х символов из латинских букв, цифр, знаков /-*?" placeholder="не менее 4-х символов из латинских букв, цифр, знаков /-*?" required>
            <br>
                <input style="margin-top: 25px" type="submit" name="register" value="Зарегистрироваться" required>
            <p>* обязательные поля</p>
        </form>
<?php
    $link = connect("localhost", "root", "", "lesson11");
    if (isset($_POST['register'])) {
        $name = strip_tags(trim($_POST['name']));
        $email = strip_tags(trim($_POST['email']));
        $pass = strip_tags(trim($_POST['password']));
        // только кирилические буквы, символ дефиз, без цифр
        $match_name = preg_match('/^[а-я-?]+$/ui', $name);
        // только латинские буквы, цифры, знаки .-
        $match_email = preg_match("/^([a-z0-9\-?\.?]+@[a-z\-?\.?]+\.[a-z]{2,6}+)$/ui", $email);
        //не менее 4-х символов из латинских букв, цифр, знаков /-*?
        $match_password = preg_match('/^[a-z0-9-?\/?\*?\??]{4,16}+$/ui', $pass);
        $flag = 1;
        if (!empty($name) && !empty($email) && !empty($pass)) {
            if ($match_name) {
                if ($match_email) {
                    if ($match_password) {
                        $query = "SELECT email FROM users";
                        if ($res = query($link, $query)) {
                            $array = fetch_assoc_all($res);
                        }
                        if (isset($array) && is_array($array) && count($array) > 0) {
                            foreach ($array as $user) {
                                if ($user['email'] == $email) {
                                    $flag = 0;
                                }
                            }
                        }
                        if ($flag == 1) {
                            $pass = password_hash($pass, PASSWORD_DEFAULT);
                            $query = "INSERT INTO users(name, email, pass) VALUES ('$name', '$email', '$pass')";
                            query($link, $query);
                            echo "<p style='color: green'>Регистрация прошла успешно !</p>";
                        } else echo "<p style='color: red'>Пользователь с таким email существует</p>";
                    } else echo "<p style='color: red'>Ведите правильный пароль - не менее 4-х символов из латинских букв, цифр, разрешены знаки /-*</p>";
                } else echo "<p style='color: red'>Email адрес не существует, введите правильный email</p>";
            } else echo "<p style='color: red'>Заполните верно имя - только кирилические буквы, символ дефиз, без цифр</p>";
        } else echo "<p style='color: red'>Заполните поля формы</p>";
    }
    close($link);
?>
    </div>
</body>
</html>
