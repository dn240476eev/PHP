<?php
class Product extends Core
{
    public function fetch()
    {

        $products = new Products(); // подключаем модель Товары
        $product = new stdClass();

        $pages = new Pages();
        $all_pages = $pages->getPages();
//print_r($all_pages);

        $request = new Request(); // подключаем модель Запрос

        $carts = new Carts(); // подключаем модель Товары

        $categories = new Categories(); // подключаем модель Товары
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $carts = new Carts();
        $cart_catalog = $carts->getCard();

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
        if (isset($parts[1])) {
            $product = $products->getProduct($parts[2], 'url');
        }
//print_r($product);
        if($request->method() == 'POST' && isset($_POST['cart'])) {
            $id = $product['id'];
            $amount = $request->post('amount', 'integer');
//            print_r($product['id']);
//            print_r($request->post('amount', 'integer'));
            if (!empty($id) && !empty($amount)) {
                $carts->addCard($id, $amount);
                $URL = $_SERVER['HTTP_REFERER'];
                header ("Location: $URL");
            }
//            unset($_SESSION['order_id']);
        }
//        print_r($_COOKIE['cart']);


            $array_vars = array(
            'pages' => $all_pages,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
            'product' => $product,
            'carts' => $cart_catalog,
            );

//        $page = $pages->getPage($parts[1], 'url');

        return $this->view->render('product.html',$array_vars);
    }
}