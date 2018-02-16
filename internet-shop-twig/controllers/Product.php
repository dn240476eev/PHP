<?php
class Product extends Core
{
    public function fetch()
    {

        $products = new Products();
        $product = new stdClass();

        $pages = new Pages();
        $all_pages = $pages->getPages();

        $request = new Request();

        $categories = new Categories();
        $categories_catalog = $categories->getCategories();
        $categories_catalog_tree = $categories->GetCategoriesTree();

        $carts = new Carts();
        $cart_catalog = $carts->getCard();

        $uri = parse_url($_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri['path']);
        if (isset($parts[1])) {
            $product = $products->getProduct($parts[2], 'url');
        }
        if($request->method() == 'POST' && isset($_POST['cart'])) {
            $id = $product['id'];
            $amount = $request->post('amount', 'integer');
            if (!empty($id) && !empty($amount)) {
                $carts->addCard($id, $amount);
                $URL = $_SERVER['HTTP_REFERER'];
                header ("Location: $URL");
            }
        }

            $array_vars = array(
            'pages' => $all_pages,
            'categories_catalog' => $categories_catalog,
            'categories' => $categories_catalog_tree,
            'product' => $product,
            'carts' => $cart_catalog,
            );

        if(isset($product['url']) && empty($parts[3])) {
            echo '1111';
            return $this->view->render('product.html',$array_vars);
        } else {
            header("http/1.0 404 not found");
            $page = $pages->getPage('404', 'url');
            $array_vars = array(
                'page' => $page,
                'pages' => $all_pages,
                'categories' => $categories_catalog_tree,
                'carts' => $cart_catalog,
            );
            return $this->view->render('page.html', $array_vars);
        }


    }
}