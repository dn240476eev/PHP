<?php
class Main extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $all_pages = $pages->getPages();
//print_r($all_pages);
        $products = new Products();
        $product = new stdClass();
        $products_catalog = $products->getProducts();

        $request = new Request(); // подключаем модель Запрос

        $categories = new Categories(); // подключаем модель Товары
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();
//        print_r($categories_catalog_tree);
//        $categories_make_catalog = $categories->makeCategories($categories_catalog_tree);
//        print_r($categories_make_catalog);

        $carts = new Carts();
        $cart_catalog = $carts->getCard();

        if($request->method() == 'POST' && isset($_POST['cart'])) {
            $id =  $request->post('id', 'integer');
            $amount = 1;
//            print_r($product['id']);
//            print_r($request->post('amount', 'integer'));
            if (!empty($id) && !empty($amount)) {
                $carts->addCard($id, $amount);
                $URL = $_SERVER['HTTP_REFERER'];
                header ("Location: $URL");
            }
//            unset($_SESSION['order_id']);
        }

        $array_vars = array(
            'pages' => $all_pages,
            'products' => $products_catalog,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
            'carts' => $cart_catalog,
        );

        return $this->view->render('main.html',$array_vars);
    }
}