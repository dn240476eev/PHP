<div class="login_form">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login']) {
        if (isset($_POST['id']) && isset($_POST['password'])) {
            outputLogin($_POST['id'], $_POST['password']);
        }
    }
    ?>
    <h2>Вход в личный кабинет:</h2>
    <form method="post">
        <h3>Введите логин:</h3>
        <input type="text" name="id" value="" placeholder="введите логин">
        <br>
        <h3>Введите пароль: </h3>
        <input type="password" name="password" value="" placeholder="введите пароль">
        <br>
        <div class="center">
            <input type="submit" name="login" value="Войти">
        </div>
    </form>
</div>