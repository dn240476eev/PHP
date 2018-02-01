<?php
class Cart extends Core
{
    public function fetch()
    {
        session_start();

        $carts = new Carts(); // подключаем модель Товары

        $pages = new Pages();
        $all_pages = $pages->getPages();
//print_r($all_pages);

        $request = new Request(); // подключаем модель Запрос

        $categories = new Categories(); // подключаем модель Товары
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        if($request->method() == 'POST' && isset($_POST['refresh'])) {
            $cart_item = array();
            foreach ($_POST['cart_item'] as $id => $amount) {
                $id = trim(strip_tags($id));
                $amount = trim(strip_tags($amount));
                $cart_item[$id] = $amount;
            }
            foreach ($cart_item as $id => $amount) {
                if (!empty($id) && !empty($amount)) {
                    $carts->refreshCard($cart_item);
                }
            }
            $URL = $_SERVER['HTTP_REFERER'];
            header ("Location: $URL");

        }

        if($request->method() == 'POST' && isset($_POST['del'])) {
//            print_r($_COOKIE['cart']);
            if(isset($_POST['operations'])) {
                $operations = $_POST['operations'];
                $carts->delCart($operations);
            $URL = $_SERVER['HTTP_REFERER'];
            header ("Location: $URL");
            }
        }

        $cart_catalog = $carts->getCard();

        $array_vars = array(
            'pages' => $all_pages,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
            'carts' => $cart_catalog,
        );

//        $page = $pages->getPage($parts[1], 'url');

        return $this->view->render('cart.html',$array_vars);
    }
}