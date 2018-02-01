<?php
class Category extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $all_pages = $pages->getPages();

        $products = new Products();
        $product = new stdClass();
        $products_catalog = $products->getProducts();

        $request = new Request(); // подключаем модель Запрос

        $categories = new Categories(); // подключаем модель Товары
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $category = new stdClass();

        $carts = new Carts();
        $cart_catalog = $carts->getCard();

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
//        print_r($parts[2]);
        if (isset($parts[2])) {
//            $category = $categories->getCategory($request->get('url', 'string'), 'url');
            $category = $categories->getCategory($parts[2], 'url');
        }
//        print_r($category['id']);
        $category_id = $categories->GetCategoriesId($category['id']);
//        print_r($category_id);

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
            'category' => $category_id,
            'category1' => $category,
            'carts' => $cart_catalog,
        );

        return $this->view->render('category.html',$array_vars);
    }
}
