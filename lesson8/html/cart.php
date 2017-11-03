<?php
    $cart = getCard($products);
//    print_r($cart);
?>

<div class="cart-page">
    <h1>Корзина</h1>
    <?php if (is_array($cart['products'])) : ?>
        <form method="post">
            <table border="1" bordercolor="#B9BEC2" width="99%" cellspacing="0" cellpadding="10">
                <tr>
                    <th>№</th>
                    <th>Название товара</th>
                    <th>Цена за шт</th>
                    <th>Количество</th>
                    <th>Сумма, грн</th>
                </tr>
                <?php
                    $i = 1;
                    foreach ($cart['products'] as $value):
                ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><output name="name"><a href=<?php echo "?route=product&id=$value->id" ?>><?php echo $value->name ?></a></output></td>
                    <td><output name="price"><?php echo $value->variant->price ?></output></td>
                    <td><input type="number" name="cart_item[<?php echo $value->id ?>]" value="<?php echo $value->cart_amount ?>" min="1" max="50"></td>
    <!--                <td><input type="number" name="amount" value="--><?php //echo $value->cart_amount ?><!--" min="1" max="50"></td>-->
                    <td><output name="summ"><?php echo $value->variant->price * $value->cart_amount ?></output></td>
                </tr>
                <?php endforeach ?>
                <tr>
                    <th colspan="4">ИТОГО: </th>
                    <th><output name="summ_price"><?php echo  $cart['summ_price'] ?></output></th>
                </tr>
            </table>
            <div class="koord-button">
                <button class="button color-blue" type="submit" name="refresh" value="1">Пересчитать сумму</button>
                <button class="button" type="submit" name="buy" value="1">Оформить заказ</button>
            </div>

        </form>
    <?php else :?>
        <p>Корзина пуста</p>
    <?php endif ?>
</div>

<?php
//foreach ($_POST['cart_item'] as $key => $value) {
//    echo $key .' '.$value."<br/>";
//}

if (isset($_POST['cart_item'])) {
    buy($products);
}

//if (buy($products) == 1) echo "<p class='ok'>Заказ успешно отправлен !</p>";

?>
