<div class="login_form">
    <h2>Вход в личный кабинет:</h2>
    <form method="post">
        <h3>Введите логин</h3>
        <input type="email" name="email" value="" placeholder="введите Ваш e-mail">
        <br>
        <h3>Введите пароль</h3>
        <input type="password" name="password" value="" placeholder="введите пароль">
        <br>

        <input type="submit" name="login" value="Войти">

    </form>

    <?php
    if (isset($_POST['email']) && isset($_POST['password'])) {
        login($_POST['email'], $_POST['password']);
    }
    ?>
</div>