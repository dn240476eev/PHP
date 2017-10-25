<div class="regisr_form">
    <h2>Регистрация:</h2>
    <form  method="post">
        <h3>Введите логин</h3>
        <input type="email" name="email" value="" placeholder="введите Ваш e-mail">
        <br>
        <h3>Введите пароль</h3>
        <input type="password" name="password" value="" placeholder="введите пароль">
        <br>

        <input type="submit" name="register" value="Зарегистрироваться">

    </form>

    <?php
    if (isset($_POST['email']) && $_POST['password']) {
        register($_POST['email'], $_POST['password']);
    }
    ?>
</div>

