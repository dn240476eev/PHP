<?php
    $product = getProduct($products, $_GET['id']);
//    print_r($product);
?>

<div class="product-page">
    <h1><?php echo $product->name ?></h1>
    <!--Изображение товара-->
    <div class="img-prod-page">
        <img src="http://dummyimage.com/350x350.png/C9E7FC&text=The+image! 350x350" />
    </div>
    <div class="info-product-page">
        <!--Артикул товара-->
        <div class="sku-product_page">
            <p>Артикул: <span><?php echo $product->variant->sku ?></span></p>
        </div>
        <!--Наличие на складе товара-->
        <div class="stock-product_page">
            <?php if($product->variant->stock > 0) :?>
                <p>Есть на складе</p>
            <?php endif;?>
        </div>

        <form method="post">
            <!--Цена товара-->
            <div class="price-product_page">
                <h3>Цена:</h3>
                <?php if(count($product->variants) > 1) :?>
                    <select>
                        <?foreach ($product->variants as $variant) :?>
                            <?php if(!empty($variant->stock)) :?>
                                <option><?php echo $variant->name ?> <?php echo $variant->price ?> грн</option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                <?php else:?>
                    <p><?php echo $product->variant->price ?> грн</p>
                <?php endif;?>
            </div>
            <!--Заказ товара-->
            <div class="zakaz-product_page">
                <h3>Количество:</h3>
                <input type="hidden" name="id" value="<?php echo $product->id ?>">
                <input type="number" name="amount" value="1" min="1" max="50">
            </div>
            <div class="clear"></div>
            <div class="line"></div>
            <button type="submit">Купить</button>
        </form>

        <!--Цена & заказ товара-->
<!--        <div class="price-zakaz">-->
<!--            <h3>Цена:</h3>-->
<!--            --><?php //if(count($product->variants) > 1) :?>
<!--                <select>-->
<!--                    --><?//foreach ($product->variants as $variant) :?>
<!--                        <option>--><?php //echo $variant->name ?><!-- --><?php //echo $variant->price ?><!-- грн</option>-->
<!--                        <h3>Количество:</h3>-->
<!--                        <form method="post">-->
<!--                            <input type="hidden" name="id" value="--><?php //echo $product->id ?><!--">-->
<!--                            <input type="number" name="amount" value="1" min="1" max="--><?php //echo $product->variants->stock ?><!--">-->
<!--                            <div class="line"></div>-->
<!--                            <button type="submit">Купить</button>-->
<!--                        </form>-->
<!--                    --><?php //endforeach;?>
<!--                </select>-->
<!--            --><?php //else:?>
<!--                <p>--><?php //echo $product->variant->price ?><!-- грн</p>-->
<!--                <h3>Количество:</h3>-->
<!--                <form method="post">-->
<!--                    <input type="hidden" name="id" value="--><?php //echo $product->id ?><!--">-->
<!--                    <input type="number" name="amount" value="1" min="1" max="--><?php //echo $product->variant->stock ?><!--">-->
<!--                    <div class="line"></div>-->
<!--                    <button type="submit">Купить</button>-->
<!--                </form>-->
<!--            --><?php //endif;?>
<!--        </div>-->
    </div>
    <div class="clear"></div>
    <div class="description-prod-page">
        <h3>Описание:</h3>
        <?php echo $product->description ?>
    </div>
</div>
