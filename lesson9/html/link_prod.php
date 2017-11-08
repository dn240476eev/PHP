<div class="link-prod-form">
    <h2>Форма ввода ссылки на товар:</h2>
    <form method="post">
        <h3>Введите ссылку на товар:</h3>
        <input type="text" name="link_prod" value="" placeholder="ссылка на товар">
        <br>
        <div class="center">
            <input type="submit" name="link" value="Обработать">
        </div>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['link']) : ?>
            <h3>Вот что получилось:</h3>
            <output name="result"><?php echo validLinkProd($_POST['link_prod']) ?></output>
        <?php endif ?>

    </form>

<!--    --><?php
//    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['login']) {
//        if (isset($_POST['id']) && isset($_POST['password'])) {
//            outputLogin($_POST['id'], $_POST['password']);
//        }
//    }
//    ?>
</div>