<?php
    $products = getProducts($data_products);
?>

<div class="products">
    <ul class="products_ul">
        <?php if($products) :?>
            <?php foreach ($products as $product) :?>
                <?php if (($product->visible) && (!empty($product->variant->stock))) :?>
                    <li class="product">
                        <div class="wrap_product">
                            <a href=<?php echo "?route=product&id=$product->id" ?>>
                                <!--Дата товара-->
                                <div class="product_data">
                                    <?php $temp_data = $product->created;
                                    $temp_data = date("m.d.y", strtotime($temp_data)); ?>
                                    <p><?php echo  $temp_data ?></p>
                                </div>
                                <!--Изображение товара-->
                                <div>
                                    <img src="http://dummyimage.com/150x150.png/C9E7FC&text=The+image! 150x150" />
                                </div>
                                <!--Название товара-->
                                <div class="product_name">
                                    <h3> <?php echo $product->name; ?></h3>
                                </div>
                                <!--Цена товара-->
                                <div class="price">
                                    <?php if(count($product->variants) > 1) :?>
                                        <select>
                                            <?foreach ($product->variants as $variant) :?>
                                                <option><?php echo $variant->name ?> <?php echo $variant->price ?> грн.</option>
                                            <?php endforeach;?>
                                        </select>
                                    <?php else:?>
                                        <p><?php echo $product->variant->price ?> грн</p>
                                    <?php endif;?>
                                </div>
                                <!--Количество товара-->
                                <div class="stock">
                                    <p>На складе: <?php echo $product->variant->stock ?> штук</p>
                                </div>
                            </a>
                        </div>
                    </li>
                <? endif; ?>
            <? endforeach; ?>
        <?php endif;?>
    </ul>
</div>
<div class="clear"></div>

<?php
    $page = getPage($pages,1);
?>

<div>
    <?php echo $page->description; ?>
</div>