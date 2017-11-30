<div class="regisr_form">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['register']) {
        $post_array = postArray($_POST['id'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['password1']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['register']) {
        if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password1'])) {
            register($_POST['id'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['password1']);
        }
    }
    ?>
    <h2>Регистрация:</h2>
    <form  method="post">
        <h3>Введите логин *:</h3>
        <input type="text" name="id" value="<?= (isset($post_array) ? $post_array[0] : '') ?>" title="не менее 4-х латинских букв и цифры" placeholder="не менее 4-х латинских букв и цифры">
        <br>
        <h3>Введите Ваше имя *:</h3>
        <input type="text" name="name" value="<?= (isset($post_array) ? $post_array[1] : '') ?>" title="только кирилические буквы, символ дефиз, без цифр" placeholder="только кирилические буквы, символ дефиз, без цифр">
        <br>
        <h3>Введите Ваш e-mail *:</h3>
        <input type="text" name="email" value="<?= (isset($post_array) ? $post_array[2] : '') ?>" title="только латинские буквы, знаки .-" placeholder="только латинские буквы, знаки .-">
        <br>
        <h3>Введите пароль *:</h3>
        <input type="password" name="password" value="<?= (isset($post_array) ? $post_array[3] : '') ?>" title="не менее 4-х символов из латинских букв, цифр, знаков /-*?" placeholder="не менее 4-х символов из латинских букв, цифр, знаков /-*?">
        <br>
        <h3>Введите подтверждение пароля *:</h3>
        <input type="password" name="password1" value="<?= (isset($post_array) ? $post_array[4] : '') ?>" title="пароль должен совпадать" placeholder="повтор пароля">
        <br>
        <div class="clear"></div>
        <div class="center">
            <input type="submit" name="register" value="Зарегистрироваться">
        </div>

        <p>* обязательные поля</p>

    </form>
</div>
