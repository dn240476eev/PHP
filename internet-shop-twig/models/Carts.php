<?php
class Carts extends Database
{

// ДОБАВЛЕНИЕ товара в корзину COOKIE

    public function addCard($id, $amount) {
        if(isset($_COOKIE['cart'])){
            $cart = unserialize($_COOKIE['cart']);
            if (isset($cart[$id])) {
                $cart[$id] += $amount;
            } else  $cart[$id] = $amount;
        } else {
            $cart[$id] = $amount;
        }
        setcookie('cart', serialize($cart),time()+3600*24*30, '/', '', false, true);
    }


//ОБНОВЛЕНИЕ КОРЗИНЫ

    public function refreshCard($cart_item) {
        if(isset($_COOKIE['cart'])){
            $cart = unserialize($_COOKIE['cart']);
            $cart = array_replace($cart,  $cart_item);
        } else {
            $cart = $cart_item;
        }
        setcookie('cart', serialize($cart),time()+3600*24*30, '/', '', false, true);
    }


// Вывод корзины с суммой в корзине

    public function getCard() {

        $cart_items['summ_price'] = 0;
        $cart_items['summ_prod'] = 0;

        if(isset($_COOKIE['cart'])) {
            $products = new Products(); // подключаем модель Товары
            $cart = unserialize($_COOKIE['cart']);
            foreach ($cart as $id => $amount) {
                $product = $products->getProduct($id); // объект
                $product['cart_amount'] = $amount; // создаем поле объекта
                $cart_items['products'][] = $product;
                $cart_items['summ_price'] += $product['price'] * $amount;
                $cart_items['summ_prod'] += $amount;

            }
            return $cart_items;
        } else return 0;
    }


//// Удаление товара из корзины COOKIE

    public function delCartProd($operations)
    {
        if(empty($operations)) {
            return false;
        }

        if(isset($_COOKIE['cart'])) {
            $cart = unserialize($_COOKIE['cart']);
            foreach ($cart as $id => $amount) {
                foreach ($operations as $key => $id_del) {
                    if($id = $id_del) unset($cart[$id]);
                }
            }
            setcookie('cart', serialize($cart), time() + 3600 * 24 * 30, '/', '', false, true);
            if (!$cart) {
                $this->delCart();
            }
        }
    }

//// Удаление корзины COOKIE

    public function delCart()
    {
        if(isset($_COOKIE['cart'])) {
            setcookie("cart", '', time() - 3600, '/', '', false, true );
            $URL = $_SERVER['HTTP_REFERER'];
            header ("Location: $URL");
            print_r($_COOKIE['cart']);
        }
    }

}
